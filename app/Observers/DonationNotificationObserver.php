<?php

namespace App\Observers;

use App\Models\Donation;
use App\Services\NotificationService;

class DonationNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created(Donation $donation): void
    {
        if (! $donation->user_id) {
            return;
        }

        $amount = number_format((float) $donation->amount, 2);

        $this->notifications->log(
            (int) $donation->user_id,
            'Education Finance Department',
            'donation_sent',
            'Donation Sent',
            "You donated Ƶ{$amount} to {$donation->npo_name}. Thank you for giving back!",
            'heart',
            'green',
            $donation
        );
    }
}
