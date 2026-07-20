# Zedville — Project Architecture (Controllers / Services / Providers / Kernel)

Scope of this doc: `app/Http/Controllers/**`, `app/Services/**`, `app/Providers/**`, `app/Http/Kernel.php`, `app/Console/Kernel.php` only. No other folders were reviewed. This is a snapshot for a new developer or AI agent joining cold — read this before touching any of the above.

## 1. What the app is

Zedville is a dummy-finance learning platform for students. Each student is a "virtual citizen" who receives a virtual monthly salary, pays virtual expenses (rent, school fees, utilities, groceries, shopping), and learns budgeting through simulated banking, a supermarket, a closet/shop, quizzes, and gamified badges.

## 2. Layering (as it actually exists, not as it should be)

```
Route (routes/*.php)
   -> Controller (fat — validation + business rules + persistence + view assembly, mostly in one method)
        -> Service (only 6 exist; most controllers skip this layer entirely)
             -> Eloquent Model  (mostly)
             -> DB::table() / DB::raw()  (ClosetController, a few Admin controllers — bypasses ORM)
```

Only 6 real services exist:
- `BadgeCalculatorService` — "Engagement Badge" system
- `FinheroBadgeCalculatorService` — "FinHero Badge" system (parallel, independent duplicate of the above concept)
- `FinheroPointService`
- `ParticipationService` — awards/dedupes gamification points, called from `EFDController`, `OrderController`
- `StatementGenerator` — monthly salary credit, emergency-fund transfer, fixed-needs debits, generates `BankStatement` records
- `CitizenActivationService` — small state machine for the onboarding/activation flow

Everything else (survey logic, mailbox composition, mood tracking, badge admin overrides, civic chamber referendums) lives directly inside controllers.

## 3. The two ledgers — read this before touching any balance code

There are two transaction models: `Transaction` and `Transaction1`.

- **`Transaction1` is the real, live ledger.** Every controller that reads/writes a student's balance uses it: `OrderController`, `SupermarketController`, `SpendingActivitiesController`, `ProfileController::storesurvey`, `EFDController::storeDonation`, `CitizenActivationController`, `AuthenticatedSessionController::ensureMonthlyBills`, `StatementGenerator`, and the bank views/statements.
- **`Transaction` is dead/orphaned everywhere except `BankController::creditMonthlySalary`**, which writes salary credits into `Transaction` — a table nothing else reads from. See `bugs.md` #1 for the fallout.

**Rule for any future work touching balances: use `Transaction1`. Never `Transaction`.**

## 4. Balance-read pattern (used 13+ places, no shared helper)

```php
$latestTxn = Transaction1::where('user_id', $userId)->latest('id')->first();
$lastBalance = $latestTxn ? $latestTxn->balance : 0;
```

There is no `bank_accounts.current_balance` column being trusted, no ledger service, no cache. Every balance check re-derives the balance by finding the latest row. This is both a duplication problem and a concurrency risk (see `bugs.md`).

## 5. Parallel/duplicate subsystems

Two pairs of features were built twice, independently, and never merged:

| Feature | Implementation A | Implementation B |
|---|---|---|
| Gamification badges | `BadgeCalculatorService` + `BadgeAdminController` + `BadgeStudentController` (Engagement Badge) | `FinheroBadgeCalculatorService` + `FinheroAdminController` + `FinheroStudentController` (FinHero Badge) |
| Civic Chamber (referendum/petition) | `EFDController.php:618-772` (student-facing) | `Admin/CivicChamberController.php:334-573` |

Also near-duplicated three times: the supermarket/spending-tracker product-listing controller logic (`SupermarketController`, `SpendingActivitiesController`, and a self-flagged-obsolete triplicate inside `EFDController.php:307-441` — the author's own comment says "Remove Belo[w] 3 later," never done).

## 6. Multi-tenancy / school scoping

There's no middleware or global scope for "which school." Instead, ~40+ individual controller methods (mostly in `AdminEducationController.php`) manually read `session('selected_school')` and branch on it inline. No `SetSelectedSchool` middleware exists. This is the single biggest missed abstraction in the Admin layer — see `planning.md` Phase 2.

## 7. Auth/authorization model

- `AuthServiceProvider::$policies` is empty. No Laravel policies/gates are used anywhere.
- Role checks are done ad hoc per-controller: `$user->role == 4`, `ClosetController::requireAdmin()`, a custom `IsAdmin` route middleware registered in `Http/Kernel.php:66` as `'admin'`.
- **`RouteServiceProvider::boot()` (lines 39-43) applies only `['web','auth']` to the `admin.php` route group — the `admin` middleware is never attached.** The code literally has the comment `// Add 'admin' middleware if needed` next to it, unaddressed. Any authenticated user may be able to reach admin routes unless `routes/admin.php` itself adds the middleware per-route (not reviewed — out of scope, flagged for verification).

## 8. Scheduling — what's actually cron-driven vs login-driven

`app/Console/Kernel.php` `schedule()` has exactly 3 entries:

1. `everyMinute()` — loops **every** user (`User::all()`, no chunking) and calls `MailboxScheduler::scheduleForEvent('login', ...)` for each, every minute, regardless of whether they logged in.
2. `everyMinute()` — processes due `Transfer` records (`type=later`/`recurring`) and dispatches `ProcessScheduledTransfer` jobs. **This is the only properly queued scheduled work in the app.**
3. `monthlyOn(31, '23:59')` — runs `badges:calculate-monthly` artisan command. Using day 31 means this **silently skips** in Feb/Apr/Jun/Sep/Nov (Laravel scheduler does not clamp to month-end unless `lastDayOfMonth()` is used).

**Monthly salary and monthly fixed bills (rent/school/electricity/water/internet) are NOT scheduled at all.** They only fire from `AuthenticatedSessionController::store()` on login, gated by day-of-month checks (`>=6` for salary via `StatementGenerator`, `>=7` for bills via `ensureMonthlyBills`). A student who doesn't log in during the eligible window that month gets nothing, with no backfill/catch-up job. This is the root timing mechanism behind the original reported bug (expenses "not deducting" — see `bugs.md` #1 and #2).

## 9. Kernel middleware summary

`app/Http/Kernel.php`:
- Global: TrustProxies, HandleCors, PreventRequestsDuringMaintenance, ValidatePostSize, TrimStrings, ConvertEmptyStringsToNull. `TrustHosts` is commented out.
- `web` group: standard Breeze stack, no custom school/tenant middleware.
- `api` group: `throttle:api` + SubstituteBindings only — Sanctum is commented out, so API auth posture is unclear (flagged for verification).
- Route middleware includes `admin => IsAdmin::class` but (per §7) it's not wired into the admin route group at the provider level.

## 10. Config values that are NOT centralized

These are hardcoded independently in multiple files instead of one config file (`config/zedville.php` or similar does not exist for this):

- Monthly salary `3952.40` / `4250` — `CitizenActivationController.php:132`, `EFDController.php:163`, `StatementGenerator.php:70`, `BankController.php` (multiple, differing values — see `bugs.md`).
- Emergency fund % (`20`) — `CitizenActivationController.php:52`, `EFDController.php:164`, `StatementGenerator.php:138`.
- Rent (`300`) / School Fees (`1000`) — `CitizenActivationController.php:239,261,278-279`, `AuthenticatedSessionController.php:186,189-190`, and again in `BankController.php`.
- Academic-year start month — inconsistently `9` in three files, `8` (0-based) in a fourth, and `4` in `FinheroPointService.php:21` — a genuine cross-module inconsistency, not just duplication.

## 11. LOC map (Controllers/Services/Providers/Kernel only)

| File | LOC |
|---|---|
| app/Http/Controllers/BankController.php | 2377 |
| app/Http/Controllers/ProfileController.php | 1324 |
| app/Http/Controllers/Admin/AdminEducationController.php | 1114 |
| app/Http/Controllers/EFDController.php | 794 |
| app/Http/Controllers/Admin/AdminDashboardController.php | 582 |
| app/Http/Controllers/Admin/CivicChamberController.php | 573 |
| app/Http/Controllers/Admin/FinheroAdminController.php | 533 |
| app/Http/Controllers/CitizenActivationController.php | 401 |
| app/Http/Controllers/Admin/BadgeAdminController.php | 344 |
| app/Services/BadgeCalculatorService.php | 321 |
| app/Http/Controllers/OrderController.php | 303 |
| app/Http/Controllers/ClosetController.php | 286 |
| app/Services/FinheroBadgeCalculatorService.php | 276 |
| app/Services/ParticipationService.php | 273 |
| app/Http/Controllers/SpendingActivitiesController.php | 273 |
| app/Services/StatementGenerator.php | 269 |
| app/Http/Controllers/Auth/AuthenticatedSessionController.php | 243 |
| app/Http/Controllers/Student/FinheroStudentController.php | 203 |
| app/Http/Controllers/SupermarketController.php | 186 |
| app/Http/Controllers/Admin/CalendarEventController.php | 171 |
| app/Http/Controllers/LoginQuizController.php | 170 |
| app/Http/Controllers/Admin/WellbeingController.php | 170 |
| app/Http/Controllers/Auth/RegisteredUserController.php | 125 |
| app/Http/Controllers/Admin/AdminStudentController.php | 120 |
| app/Http/Controllers/Admin/AdminEmailTemplateController.php | 117 |
| app/Providers/RouteServiceProvider.php | 93 |
| app/Http/Controllers/CartController.php | 77 |
| app/Http/Controllers/Student/BadgeStudentController.php | 74 |
| app/Console/Kernel.php | 73 |
| app/Http/Kernel.php | 68 |
| app/Http/Controllers/QuizController.php | 64 |
| app/Http/Controllers/Auth/NewPasswordController.php | 61 |
| app/Services/FinheroPointService.php | 48 |
| app/Http/Controllers/Auth/PasswordResetLinkController.php | 44 |
| app/Providers/EventServiceProvider.php | 42 |
| app/Services/CitizenActivationService.php | 41 |
| app/Http/Controllers/Auth/ConfirmablePasswordController.php | 41 |
| app/Http/Controllers/CMSController.php | 33 |
| app/Providers/AuthServiceProvider.php | 30 |
| app/Http/Controllers/Auth/PasswordController.php | 29 |
| app/Providers/AppServiceProvider.php | 28 |
| app/Http/Controllers/Auth/VerifyEmailController.php | 28 |
| app/Http/Controllers/Auth/EmailVerificationNotificationController.php | 25 |
| app/Http/Controllers/Auth/EmailVerificationPromptController.php | 22 |
| app/Providers/BroadcastServiceProvider.php | 21 |
| app/Http/Controllers/StatementController.php | 18 |
| app/Http/Controllers/Controller.php | 13 |
| **TOTAL** | **12521** |

## 12. What's already good (use these as the template for refactors)

- `CitizenActivationService::getNextRoute` — small, pure, single-responsibility state machine.
- `ParticipationService::award`/`alreadyEarned` — clean dedup logic, monthly cap in one place, best-documented service in the codebase.
- `OrderController::placeOrder` — the only balance-mutating flow wrapped in `DB::beginTransaction()/commit()/rollBack()` with a real try/catch. Needs `lockForUpdate()` added, but structurally it's the right shape.
- `Auth/*` controllers (Breeze scaffolding) — small, single-purpose, framework-idiomatic.
- `ClosetController` — has consistent `requireAuth`/`requireAdmin`/`requireAdminOrTutor` guards and private formatter methods for JSON shaping, despite bypassing Eloquent.

See `bugs.md` for the full defect list and `planning.md` for the fix sequencing.
