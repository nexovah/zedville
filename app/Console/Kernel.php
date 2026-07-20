<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\User;
use App\Helpers\MailboxScheduler;
use App\Models\Transfer;
use App\Jobs\ProcessScheduledTransfer;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Example: Run MailboxScheduler tasks
        $schedule->call(function () {
            $users = User::all();
            foreach ($users as $user) {
               MailboxScheduler::scheduleForEvent('login', $user->id);
            }
        })->everyMinute();

        // ----- Scheduled Transfers -----
        $schedule->call(function () {
            // Process "Later" transfers (scheduled_at <= now)
            $laterTransfers = Transfer::where('type', 'later')
                ->where('scheduled_at', '<=', now())
                ->get();

            foreach ($laterTransfers as $transfer) {
                ProcessScheduledTransfer::dispatch($transfer->id);
            }

            // Process "Recurring" transfers
            $recurringTransfers = Transfer::where('type', 'recurring')
                ->where(function ($query) {
                    $query->where('start_date', '<=', now())
                          ->where('end_date', '>=', now());
                })
                ->get();

            foreach ($recurringTransfers as $transfer) {
                ProcessScheduledTransfer::dispatch($transfer->id);
            }
        })->everyMinute(); // check every minute
        // ✅ ADD THIS (Badge Calculation)
    $schedule->command('badges:calculate-monthly')
        ->monthlyOn(31, '23:59')
        ->withoutOverlapping()
        ->runInBackground();

        // ----- Monthly Salary & Bills Backfill -----
        // Salary is credited on/after the 6th, fixed bills (rent/school/electricity/
        // water/internet) on/after the 7th of every month. Previously this only ran
        // when a student logged in during that window, so a student who didn't log in
        // never received that month's salary/bills. This runs daily so every eligible
        // student gets processed regardless of login. Both StatementGenerator::generateForUser()
        // and ensureMonthlyBills() already guard against duplicate credits/debits for
        // the same month, so running this daily (or re-running after a login-triggered
        // call) is safe and will not double-credit.
        $schedule->call(function () {
            $now = now();

            \App\Models\User::where('role', 4)
                ->chunkById(100, function ($students) use ($now) {
                    $statementGenerator = app(\App\Services\StatementGenerator::class);
                    $sessionController = app(\App\Http\Controllers\Auth\AuthenticatedSessionController::class);

                    foreach ($students as $student) {
                        $accountCreatedAt = \Carbon\Carbon::parse($student->created_at);

                        // Same eligibility rule used at login: skip students whose
                        // account was created this same month (their first statement
                        // is generated separately via the activation flow).
                        $isEligible = !(
                            $accountCreatedAt->year === $now->year &&
                            $accountCreatedAt->month === $now->month
                        );

                        if (!$isEligible) {
                            continue;
                        }

                        try {
                            if ($now->day >= 6) {
                                $statementGenerator->generateForUser($student->id);
                            }

                            if ($now->day >= 7) {
                                $sessionController->ensureMonthlyBills($student);
                            }
                        } catch (\Throwable $e) {
                            \Illuminate\Support\Facades\Log::error('Monthly finance backfill failed for user', [
                                'user_id' => $student->id,
                                'error'   => $e->getMessage(),
                            ]);
                        }
                    }
                });
        })->dailyAt('00:15')
            ->withoutOverlapping()
            ->name('monthly-finance-backfill');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    
}
