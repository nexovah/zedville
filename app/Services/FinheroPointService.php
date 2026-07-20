<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class FinheroPointService
{
    public function addPoints(
        int $studentId,
        string $sourceType,   // quiz | library | activity
        string $sourceKey,    // daily_quiz, module_id, activity_key
        int $points = 1,
        ?string $academicYear = null
    ): void {
        $now = now();

        // Auto academic year if not passed
        if (!$academicYear) {
            $year = $now->year;
            $startMonth = config('zedville.academic_year_start_month', 4);
            $academicYear = ($now->month >= $startMonth)
                ? $year . '-' . ($year + 1)
                : ($year - 1) . '-' . $year;
        }
        // ✅ CHECK: already inserted today?
        $alreadyExists = DB::table('finhero_student_points')
            ->where('student_id', $studentId)
            ->where('source_type', $sourceType)
            ->where('source_key', $sourceKey)
            ->whereDate('earned_at', $now->toDateString())
            ->exists();

        if ($alreadyExists) {
            return; // ❌ stop duplicate
        }
        DB::table('finhero_student_points')->insert([
            'student_id'    => $studentId,
            'month'         => $now->month,
            'year'          => $now->year,
            'academic_year' => $academicYear,
            'source_type'   => $sourceType,
            'source_key'    => $sourceKey,
            'points_earned' => $points,
            'earned_at'     => $now,
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);
    }
}