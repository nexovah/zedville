<?php
// ============================================================
// FILE: app/Http/Controllers/Student/FinheroStudentController.php
// ============================================================
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\FinheroBadgeRecord;
use App\Services\FinheroBadgeCalculatorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinheroStudentController extends Controller
{
    public function __construct(private FinheroBadgeCalculatorService $calculator) {}

    /** GET /finhero-badge — renders the student FinHero badge page */
    public function index()
    {
        return view('finhero.index');
    }

    /** GET /finhero-badge/data — JSON badge data for the logged-in student */
    public function data(): JsonResponse
    {
        // TODO: confirm how to get the logged-in student ID
        $studentId    = Auth::id();
        $academicYear = $this->calculator->getAcademicYear(now()->month, now()->year);

        $records = FinheroBadgeRecord::where('student_id', $studentId)
            ->where('academic_year', $academicYear)
            ->orderBy('year')->orderBy('month')
            ->get()
            ->map(fn($r) => [
                'month'               => $r->month,
                'year'                => $r->year,
                'quiz_pts'            => $r->quiz_pts,
                'library_pts'         => $r->library_pts,
                'activity_pts'        => $r->activity_pts,
                'total_earned'        => $r->total_earned,
                'total_available'     => $r->total_available,
                'monthly_pct'         => $r->monthly_pct,
                'monthly_badge'       => $r->effective_monthly_badge,
                'monthly_badge_points'=> $r->monthly_badge_points,
                'accumulated_points'  => $r->accumulated_points,
                'accumulated_badge'   => $r->accumulated_badge,
                'is_overridden'       => $r->is_overridden,
                'badge_meta'          => FinheroBadgeRecord::BADGE_META[$r->effective_monthly_badge],
            ]);

        $current = $records->last();

        return response()->json([
            'student_id'         => $studentId,
            'academic_year'      => $academicYear,
            'current_month'      => $current,
            'accumulated_badge'  => $current['accumulated_badge']  ?? 'NONE',
            'accumulated_points' => $current['accumulated_points'] ?? 0,
            'history'            => $records,
            'badge_meta'         => FinheroBadgeRecord::BADGE_META,
        ]);
    }

    /**
     * POST /finhero/award-points
     * Called by IT from within any activity when a student earns points.
     * Body: { activity_key: 'task_1', points: 1 }
     *
     * This is the INTEGRATION POINT for every new activity IT builds.
     * When a student completes an activity, IT calls this endpoint.
     * The badge calculator picks it up on the next monthly run.
     */
    public function awardPoints(Request $request): JsonResponse
    {
        $v = $request->validate([
            'activity_key' => 'required|string|exists:finhero_activity_registry,activity_key',
            'points'       => 'required|integer|min:1',
        ]);

        $studentId    = Auth::id();
        $now          = now();
        $academicYear = $this->calculator->getAcademicYear($now->month, $now->year);

        // Get max points for this activity
        $activity = DB::table('finhero_activity_registry')
            ->where('activity_key', $v['activity_key'])
            ->where('is_active', true)
            ->first();

        if (!$activity) {
            return response()->json(['error' => 'Activity not active this month.'], 422);
        }

        // Check if student already earned max points for this activity this month
        $alreadyEarned = DB::table('finhero_student_points')
            ->where('student_id', $studentId)
            ->where('source_type', 'activity')
            ->where('source_key', $v['activity_key'])
            ->whereMonth('earned_at', $now->month)
            ->whereYear('earned_at', $now->year)
            ->sum('points_earned');

        if ($alreadyEarned >= $activity->max_points) {
            return response()->json(['success' => false, 'message' => 'Max points already earned for this activity.']);
        }

        // Award points (capped at max)
        $toAward = min($v['points'], $activity->max_points - $alreadyEarned);

        DB::table('finhero_student_points')->insert([
            'student_id'    => $studentId,
            'month'         => $now->month,
            'year'          => $now->year,
            'academic_year' => $academicYear,
            'source_type'   => 'activity',
            'source_key'    => $v['activity_key'],
            'points_earned' => $toAward,
            'earned_at'     => $now,
            'created_at'    => $now,   // ✅ add this
            'updated_at'    => $now,   // ✅ add this
        ]);

        return response()->json([
            'success'      => true,
            'points_awarded' => $toAward,
            'message'      => "{$toAward} FinHero point(s) awarded for {$v['activity_key']}.",
        ]);
    }
    /*public function taskPage($task)
{
    // Load:
    // resources/views/finhero/task-1.blade.php
    // resources/views/finhero/task-2.blade.php

    $viewPath = 'finhero.' . $task;

    if (view()->exists($viewPath)) {
        return view($viewPath);
    }

    abort(404);
}*/
public function taskPage($task)
{
    $viewPath = 'finhero.' . $task;

    if (!view()->exists($viewPath)) {
        abort(404);
    }

    // Convert task-1 => task_1
    $activityKey = str_replace('-', '_', $task);

    // Get salary from DB
    $activity = DB::table('finhero_activity_registry')
        ->where('activity_key', $activityKey)
        ->where('type', 'task')
        ->first();

    $salary = $activity->salary ?? 0;

    return view($viewPath, compact('salary', 'activityKey'));
}
public function savePoints(Request $request)
{
    $studentId = auth()->id();

    $sourceKey = $request->source_key;

    // Check already earned or not
    $exists = DB::table('finhero_student_points')
        ->where('student_id', $studentId)
        ->where('source_type', 'task')
        ->where('source_key', $sourceKey)
        ->exists();

    if ($exists) {
        return response()->json([
            'success' => false,
            'message' => 'Points already earned.'
        ]);
    }

    DB::table('finhero_student_points')->insert([
        'student_id'    => $studentId,
        'month'         => now()->month,
        'year'          => now()->year,
        'academic_year' => now()->year . '-' . (now()->year + 1),
        'source_type'   => 'task',
        'source_key'    => $sourceKey,
        'points_earned' => 1,
        'earned_at'     => now(),
        'created_at'    => now(),
        'updated_at'    => now(),
    ]);

    return response()->json([
        'success' => true,
        'status'  => 'saved'
    ]);
}
}