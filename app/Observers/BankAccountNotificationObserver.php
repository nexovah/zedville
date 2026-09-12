<?php

namespace App\Observers;

use App\Models\BankAccount;
use App\Services\NotificationService;

class BankAccountNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created(BankAccount $account): void
    {
        if (! $account->student_id) {
            return;
        }

        $this->notifications->log(
            (int) $account->student_id,
            'Bank Account',
            'account_opened',
            'Bank Account Opened',
            'Your Zedville bank account has been opened successfully. Welcome to the city!',
            'landmark',
            'green',
            $account
        );
    }
}
