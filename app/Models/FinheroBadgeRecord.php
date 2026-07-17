<?php
// ============================================================
// FILE: app/Models/FinheroBadgeRecord.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinheroBadgeRecord extends Model
{
    protected $table = 'finhero_badge_records';

    protected $fillable = [
        'student_id','month','year','academic_year',
        'quiz_pts','library_pts','activity_pts',
        'total_earned','total_available','monthly_pct',
        'monthly_badge','monthly_badge_points',
        'accumulated_points','accumulated_badge',
        'is_overridden','override_badge','overridden_at',
    ];

    protected $casts = [
        'is_overridden' => 'boolean',
        'overridden_at' => 'datetime',
        'monthly_pct'   => 'decimal:2',
    ];

    // Points awarded per monthly badge level
    public const BADGE_POINTS = [
        'LEGEND'   => 4,
        'CHAMPION' => 3,
        'FINHERO'  => 2,
        'ROOKIE'   => 1,
        'NONE'     => 0,
    ];

    // Accumulated badge thresholds (out of max 40)
    public const ACCUMULATED_THRESHOLDS = [
        'LEGEND'   => 32,
        'CHAMPION' => 24,
        'FINHERO'  => 16,
        'ROOKIE'   => 8,
    ];

    // Display metadata (emoji, label, colours) for frontend
    public const BADGE_META = [
        'LEGEND'   => ['label_en' => 'FinHero Legend',   'label_es' => 'Leyenda FinHero',  'emoji' => '🏆', 'color' => '#FFF9E6', 'text' => '#7A5C00'],
        'CHAMPION' => ['label_en' => 'FinHero Champion', 'label_es' => 'Campeón FinHero',  'emoji' => '⭐', 'color' => '#F0F8FF', 'text' => '#1F3864'],
        'FINHERO'  => ['label_en' => 'FinHero',          'label_es' => 'FinHero',           'emoji' => '💪', 'color' => '#E8F5EE', 'text' => '#1B6B3A'],
        'ROOKIE'   => ['label_en' => 'FinHero Rookie',   'label_es' => 'Novato FinHero',    'emoji' => '🌱', 'color' => '#F5F5F5', 'text' => '#555555'],
        'NONE'     => ['label_en' => 'No Badge',         'label_es' => 'Sin Badge',         'emoji' => '—',  'color' => '#FFE8E8', 'text' => '#AA0000'],
    ];

    // Returns the effective badge (uses override if set)
    public function getEffectiveMonthlyBadgeAttribute(): string
    {
        return $this->is_overridden && $this->override_badge
            ? $this->override_badge
            : $this->monthly_badge;
    }

    public function scopeForStudent($q, int $id)   { return $q->where('student_id', $id); }
    public function scopeForYear($q, string $year)  { return $q->where('academic_year', $year); }
    public function scopeForMonth($q, int $m, int $y) { return $q->where('month', $m)->where('year', $y); }
}
