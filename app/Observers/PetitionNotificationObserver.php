<?php

namespace App\Observers;

use App\Models\Petition;
use App\Services\NotificationService;

class PetitionNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created(Petition $petition): void
    {
        if (! $petition->created_by) {
            return;
        }

        $this->notifications->log(
            (int) $petition->created_by,
            'City Hall',
            'petition_submitted',
            'Petition Submitted',
            "Your petition \"{$petition->title}\" has been submitted for review.",
            'file-signature',
            'purple',
            $petition
        );
    }
}
