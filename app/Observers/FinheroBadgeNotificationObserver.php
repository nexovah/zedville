<?php

namespace App\Observers;

use App\Models\FinheroBadgeRecord;
use App\Services\NotificationService;

class FinheroBadgeNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function saved(FinheroBadgeRecord $record): void
    {
        if (! $record->wasChanged('monthly_badge')) {
            return;
        }

        $badge = strtoupper((string) $record->monthly_badge);
        if ($badge === '' || $badge === 'NONE') {
            return;
        }

        $this->notifications->log(
            (int) $record->student_id,
            'Education Finance Department',
            'badge_earned',
            'FinHero Badge Earned',
            "You earned the {$record->monthly_badge} FinHero badge this month!",
            'shield-check',
            'amber',
            $record
        );
    }
}
