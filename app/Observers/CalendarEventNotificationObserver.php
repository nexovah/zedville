<?php

namespace App\Observers;

use App\Models\CalendarEvent;
use App\Models\User;
use App\Services\NotificationService;

class CalendarEventNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created(CalendarEvent $event): void
    {
        if (! $event->classId) {
            return;
        }

        $studentIds = User::where('role', 4)
            ->where('grade', $event->classId)
            ->when($event->sid, fn ($q) => $q->where('sid', $event->sid))
            ->pluck('id');

        if ($studentIds->isEmpty()) {
            return;
        }

        $this->notifications->logForUsers(
            $studentIds,
            'Calendar',
            'activity_assigned',
            'New Activity Assigned',
            $event->title . (($event->position ?? null) ? " ({$event->position})" : ''),
            'calendar-plus',
            'orange',
            $event
        );
    }
}
