<?php

namespace App\Observers;

use App\Models\PetitionSignature;
use App\Services\NotificationService;

class PetitionSignatureNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created(PetitionSignature $signature): void
    {
        if (! $signature->student_id) {
            return;
        }

        $title = optional($signature->petition)->title ?? 'a petition';

        $this->notifications->log(
            (int) $signature->student_id,
            'City Hall',
            'petition_signed',
            'Petition Signed',
            "You signed \"{$title}\".",
            'pencil',
            'purple',
            $signature
        );
    }
}
