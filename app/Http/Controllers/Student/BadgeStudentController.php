<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentBadgeRecord;
use App\Services\BadgeCalculatorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * ZEDVILLE — Engagement Badge
 * Controller: BadgeStudentController
 *
 * INSTRUCTIONS FOR IT:
 * Place this file in: app/Http/Controllers/Student/BadgeStudentController.php
 */
class BadgeStudentController extends Controller
{
    public function __construct(private BadgeCalculatorService $calculator) {}

    /**
     * GET /badges
     * Renders the student badges page.
     */
    public function index()
    {
        return view('badges.index');
    }

    /**
     * GET /badges/data
     * Returns JSON badge data for the logged-in student.
     * Called by the frontend JS on page load.
     */
    public function data(): JsonResponse
    {
        // TODO: confirm how to get the logged-in student's ID
        // Replace Auth::id() if your auth works differently
        $studentId = Auth::id();

        $academicYear = $this->calculator->getAcademicYear(now()->month, now()->year);

        $records = StudentBadgeRecord::where('student_id', $studentId)
            ->where('academic_year', $academicYear)
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(fn($r) => [
                'month'                => $r->month,
                'year'                 => $r->year,
                'required_assigned'    => $r->required_assigned,
                'required_completed'   => $r->required_completed,
                'optional_completed'   => $r->optional_completed,
                'participation_points' => $r->participation_points,
                'monthly_badge'        => $r->effective_monthly_badge,
                'monthly_badge_points' => $r->monthly_badge_points,
                'accumulated_points'   => $r->accumulated_points,
                'accumulated_badge'    => $r->accumulated_badge,
                'is_overridden'        => $r->is_overridden,
            ]);

        $current = $records->last();

        return response()->json([
            'student_id'         => $studentId,
            'academic_year'      => $academicYear,
            'current_month'      => $current,
            'accumulated_badge'  => $current['accumulated_badge'] ?? 'NONE',
            'accumulated_points' => $current['accumulated_points'] ?? 0,
            'history'            => $records,
        ]);
    }
}
