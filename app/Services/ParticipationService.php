<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ParticipationService
{
    /**
     * Award 1 participation point to a student for an action.
     * Handles deduplication automatically.
     *
     * @param int    $studentId   The logged-in student's ID
     * @param string $actionType  e.g. 'shopping', 'voting', 'building_enter'
     * @param string|null $detail  Optional: shop_id, building_id, sign_id etc.
     * @return bool  true if point was awarded, false if already earned
     */
    public function award(int $studentId, string $actionType, ?string $detail = null): bool
    {
        $now   = Carbon::now();
        $month = $now->month;
        $year  = $now->year;
        $today = $now->toDateString(); // 'YYYY-MM-DD'


        // Check deduplication rule for this action type
        if ($this->alreadyEarned($studentId, $actionType, $detail, $month, $year, $today)) {
            return false; // Point already earned — do not insert
        }


        // Check monthly cap (15 points max)
        $totalThisMonth = DB::table('participation_logs')
            ->where('student_id', $studentId)
            ->where('month', $month)
            ->where('year', $year)
            ->sum('points_earned');


        if ($totalThisMonth >= 15) {
            return false; // Monthly cap reached
        }


        // Insert participation point
        DB::table('participation_logs')->insert([
            'student_id'    => $studentId,
            'action_type'   => $actionType,
            'action_detail' => $detail,
            'points_earned' => 1,
            'month'         => $month,
            'year'          => $year,
            'academic_year' => $this->academicYear($month, $year),
            'earned_at'     => $now,
        ]);


        return true;
    }


    private function alreadyEarned(
        int $studentId, string $type, ?string $detail,
        int $month, int $year, string $today
    ): bool {
        $q = DB::table('participation_logs')
            ->where('student_id', $studentId)
            ->where('action_type', $type);


        switch ($type) {
            // Once per shop per day
            case 'shopping':
                return $q->where('action_detail', $detail)
                         ->whereDate('earned_at', $today)->exists();


            // Unique events — never deduplicate
            case 'voting':
                return false;
            case 'donation':
            /* return $q->where('action_detail', $detail)
             ->whereDate('earned_at', $today)
             ->exists(); */
              return $q->whereDate('earned_at', $today)->exists();
            case 'transfer':
                return false;


            // Once per month
            case 'emergency_fund_open':
            case 'money_market_open':
                return $q->where('month', $month)->where('year', $year)->exists();


            // Once per day (session)
            case 'poster_room_enter':
            case 'closet_enter':
                return $q->whereDate('earned_at', $today)->exists();


            // Once per building per day
            case 'building_enter':
                return $q->where('action_detail', $detail)
                         ->whereDate('earned_at', $today)->exists();


            // Once per sign per month
            case 'street_sign_press':
                return $q->where('action_detail', $detail)
                         ->where('month', $month)->where('year', $year)->exists();


            default:
                return false;
        }
    }


    private function academicYear(int $month, int $year): string
    {
        return $month >= 9 ? "{$year}-" . ($year+1) : ($year-1) . "-{$year}";
    }
    /*public function handleActivity($studentId, $activityKey, $refId = null)
{
    $month = now()->month;
    $year  = now()->year;

    // ✅ STEP 1: Get config using activity_key
    $config = DB::table('mba_position')
        ->where('activity_key', $activityKey)
        ->first();

    if (!$config) {
        return [
            'status' => false,
            'message' => 'Activity config not found'
        ];
    }

    // ✅ STEP 2: Decide type safely
    if ((int)$config->required === 1 && (int)$config->optional === 0) {
        $type = 'required';
    } elseif ((int)$config->optional === 1 && (int)$config->required === 0) {
        $type = 'optional';
    } else {
        return [
            'status' => false,
            'message' => 'Invalid config: must be either required OR optional'
        ];
    }

    // ✅ STEP 3: Get points (from DB, fallback 1)
    $points = isset($config->points) ? (int)$config->points : 1;

    // ✅ STEP 4: Prevent duplicate ONLY for required
    if ($type === 'required') {
        $exists = DB::table('participation_logs')
            ->where([
                'student_id'    => $studentId,
                'action_type'   => 'required',
                'action_detail' => $activityKey,
                'month'         => $month,
                'year'          => $year
            ])
            ->exists();

        if ($exists) {
            return [
                'status' => true,
                'message' => 'Already completed (required)'
            ];
        }
    }

    // ✅ STEP 5: Insert log
    DB::table('participation_logs')->insert([
        'student_id'    => $studentId,
        'action_type'   => $type,
        'action_detail' => $activityKey,
        'points_earned' => $points,
        'month'         => $month,
        'year'          => $year,
        'academic_year' => '2025-26',
        'earned_at'     => now(),
    ]);

    return [
        'status' => true,
        'message' => 'Activity logged successfully'
    ];
}*/
public function handleActivity($studentId, $activityKey, $eventId = null)
{
    $month = now()->month;
    $year  = now()->year;

    // ✅ STEP 1: Get config
    $config = DB::table('mba_position')
        ->where('activity_key', $activityKey)
        ->first();

    if (!$config) {
        return [
            'status' => false,
            'message' => 'Activity config not found'
        ];
    }

    // ✅ STEP 2: Decide type
    if ((int)$config->required === 1 && (int)$config->optional === 0) {
        $type = 'required';
    } elseif ((int)$config->optional === 1 && (int)$config->required === 0) {
        $type = 'optional';
    } else {
        return [
            'status' => false,
            'message' => 'Invalid config'
        ];
    }

    // ✅ STEP 3: Points
    $points = isset($config->points) ? (int)$config->points : 1;

    // ✅ STEP 4: Prevent duplicate (for required)
    if ($type === 'required') {
        $exists = DB::table('activity_completions')
            ->where('student_id', $studentId)
            ->where('activity_id', $eventId)
            ->whereMonth('completed_at', $month)
            ->whereYear('completed_at', $year)
            ->exists();

        if ($exists) {
            return [
                'status' => true,
                'message' => 'Already completed (required)'
            ];
        }
    }

    // ✅ STEP 5: Insert into activity_completions (IMPORTANT)
    if ($eventId) {
        DB::table('activity_completions')->insert([
            'student_id'   => $studentId,
            'activity_id'  => $eventId, // MUST be calendar_events.id
            'activity_type'  => $activityKey, // MUST be calendar_events.id
            'completed_at' => now(),
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }

$academicYear = app(\App\Services\BadgeCalculatorService::class)
    ->getAcademicYear($month, $year);
    // ✅ STEP 6: Insert into participation_logs (for points)
    DB::table('participation_logs')->insert([
        'student_id'    => $studentId,
        'action_type'   => $type,
        'action_detail' => $activityKey,
        'points_earned' => $points,
        'month'         => $month,
        'year'          => $year,
        'academic_year' => $academicYear,
        'earned_at'     => now(),
    ]);

    return [
        'status' => true,
        'message' => 'Activity logged successfully'
    ];
}
}
