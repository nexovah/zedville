<?php

namespace App\Observers;

use App\Models\MoodLog;
use App\Services\NotificationService;

class MoodLogNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created(MoodLog $log): void
    {
        if (! $log->user_id) {
            return;
        }

        $this->notifications->log(
            (int) $log->user_id,
            'City Mood',
            'mood_logged',
            'Mood Logged',
            'Your mood for today has been recorded: ' . ucfirst((string) $log->mood) . '.',
            'smile',
            'green',
            $log
        );
    }
}
