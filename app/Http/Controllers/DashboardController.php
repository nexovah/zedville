<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\CalendarEvent;
use App\Models\FinheroBadgeRecord;
use App\Models\Mailbox;
use App\Models\MoodLog;
use App\Models\StudentBadgeRecord;
use App\Models\Transaction1;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * ZEDVILLE — Student home / dashboard.
 *
 * Server-rendered summary shown when a citizen clicks "Home" in the
 * left sidebar. Every widget degrades gracefully (empty state) when the
 * underlying data is missing, so this never fatals for a half-onboarded
 * student. No existing controller/service behaviour is changed here.
 */
class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $data = [
            'studentName' => $user->name,
            'className'   => optional($user->gradeRelation)->name ?? 'Citizen of Zedville',
            'activities'  => $this->activities($user),
            'bank'        => $this->bankSummary($user),
            'badges'      => $this->badges($user),
            'mood'        => $this->moodSummary($user),
            'mailbox'     => $this->mailbox($user),
            'months'      => $this->recentMonths(),
        ];

        return view('dashboard.home', $data);
    }

    /* ---------------------------------------------------------------- */

    private function activities($user): array
    {
        try {
            $today = Carbon::today();

            return CalendarEvent::whereDate('end', '>=', $today)
                ->when($user->grade, fn ($q) => $q->where('classId', $user->grade))
                ->orderBy('start')
                ->limit(6)
                ->get()
                ->map(fn ($e) => [
                    'title' => $e->title,
                    'date'  => optional($e->start)->toDateString(),
                ])
                ->all();
        } catch (\Throwable $e) {
            return [];
        }
    }

    private function bankSummary($user): array
    {
        $account = BankAccount::where('student_id', $user->id)->first();

        if (! $account) {
            return ['has_account' => false];
        }

        $latestTxn = Transaction1::where('user_id', $user->id)->latest('id')->first();

        $balance = $latestTxn
            ? (float) $latestTxn->balance
            : (float) ($account->primary_savings_account_amount ?? 0);

        $savings = (float) ($account->emergency_fund_account_amount ?? 0);

        return [
            'has_account'  => true,
            'balance'      => $balance,
            'savings'      => $savings,
            // No monthly savings-goal figure is stored yet; the view hides
            // the progress bar when this is null.
            'savings_goal' => null,
        ];
    }

    private function badges($user): array
    {
        $praise = [
            'engagement' => 'You showed up for your city, week after week.',
            'finhero'    => 'You kept your needs, wants and savings in balance.',
        ];

        $out = [];

        try {
            $eng = StudentBadgeRecord::where('student_id', $user->id)
                ->orderBy('year')->orderBy('month')->get()->last();

            if ($eng && $eng->monthly_badge && strtoupper($eng->monthly_badge) !== 'NONE') {
                $out[] = [
                    'type'    => 'engagement',
                    'name'    => 'Engagement',
                    'icon'    => '🏅',
                    'message' => $praise['engagement'],
                ];
            }
        } catch (\Throwable $e) {
            // table not present yet — skip
        }

        try {
            $fin = FinheroBadgeRecord::where('student_id', $user->id)
                ->orderBy('year')->orderBy('month')->get()->last();

            if ($fin && $fin->monthly_badge && strtoupper($fin->monthly_badge) !== 'NONE') {
                $out[] = [
                    'type'    => 'finhero',
                    'name'    => 'FinHero',
                    'icon'    => '🛡️',
                    'message' => $praise['finhero'],
                ];
            }
        } catch (\Throwable $e) {
            // skip
        }

        return $out;
    }

    private function moodSummary($user): ?array
    {
        try {
            $start = Carbon::now()->startOfMonth();

            $mine = MoodLog::where('user_id', $user->id)
                ->where('created_at', '>=', $start)
                ->get();

            if ($mine->isEmpty()) {
                return null;
            }

            $classIds = $user->grade
                ? \App\Models\User::where('grade', $user->grade)->pluck('id')
                : collect([$user->id]);

            $city = MoodLog::whereIn('user_id', $classIds)
                ->where('created_at', '>=', $start)
                ->get();

            return [
                'my_mood'   => $this->moodLabel($mine),
                'city_mood' => $this->moodLabel($city),
            ];
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function moodLabel($logs): array
    {
        // Most frequently logged mood string wins; energy / pleasantness
        // shown as the averaged quadrant beneath it.
        $label = $logs->groupBy('mood')->sortByDesc->count()->keys()->first() ?: '—';

        $energyAvg = $logs->avg('energy');
        $pleasantAvg = $logs->avg('pleasantness');

        $energy = $energyAvg === null ? '' : ($energyAvg >= 3 ? 'High energy' : 'Low energy');
        $comfort = $pleasantAvg === null ? '' : ($pleasantAvg >= 3 ? 'comfortable' : 'uncomfortable');

        return [
            'label'  => ucfirst((string) $label),
            'detail' => trim($energy . ($energy && $comfort ? ' · ' : '') . $comfort, ' ·'),
        ];
    }

    private function mailbox($user): array
    {
        try {
            $unread = Mailbox::where('student_id', $user->id)->where('read', 0)->count();
            $latest = Mailbox::where('student_id', $user->id)->latest('id')->value('subject');

            return ['unread' => $unread, 'latest' => $latest];
        } catch (\Throwable $e) {
            return ['unread' => 0, 'latest' => null];
        }
    }

    private function recentMonths(): array
    {
        $out = [];
        $now = Carbon::now()->startOfMonth();

        for ($i = 0; $i < 6; $i++) {
            $m = (clone $now)->subMonths($i);
            $out[] = ['value' => $m->format('Y-m'), 'label' => $m->format('F Y')];
        }

        return $out;
    }
}
