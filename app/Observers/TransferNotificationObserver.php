<?php

namespace App\Observers;

use App\Models\Transfer;
use App\Services\NotificationService;

class TransferNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created(Transfer $transfer): void
    {
        if (! $transfer->user_id) {
            return;
        }

        $amount = number_format((float) $transfer->amount, 2);
        $to = $transfer->beneficiary_name ?: 'the recipient';

        if (in_array($transfer->type, ['later', 'recurring'], true)) {
            $this->notifications->log(
                (int) $transfer->user_id,
                'Bank Account',
                'transfer_scheduled',
                'Scheduled Transfer Reminder',
                "Your {$transfer->type} transfer of Ƶ{$amount} to {$to} has been scheduled.",
                'calendar',
                'blue',
                $transfer
            );
            return;
        }

        $this->notifications->log(
            (int) $transfer->user_id,
            'Bank Account',
            'transfer_completed',
            'Transfer Completed',
            "Your transfer of Ƶ{$amount} to {$to} has been completed successfully.",
            'arrow-left-right',
            'green',
            $transfer
        );
    }
}
