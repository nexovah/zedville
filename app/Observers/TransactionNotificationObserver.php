<?php

namespace App\Observers;

use App\Models\Transaction1;
use App\Services\NotificationService;

class TransactionNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created(Transaction1 $txn): void
    {
        if (! $txn->user_id) {
            return;
        }

        $amount = number_format((float) $txn->amount, 2);
        $isCredit = strtolower((string) $txn->type) === 'credit';
        $largeThreshold = 500;

        if ($isCredit) {
            $title = 'Direct Deposit Received';
            $body = "{$txn->description}: +Ƶ{$amount} has been added to your account.";
            $icon = 'dollar-sign';
            $color = 'green';
        } elseif ((float) $txn->amount >= $largeThreshold) {
            $title = 'Large Transaction Alert';
            $body = "A transaction of Ƶ{$amount} was processed for {$txn->description}.";
            $icon = 'credit-card';
            $color = 'blue';
        } else {
            $title = 'Transaction Alert';
            $body = "{$txn->description}: -Ƶ{$amount} from your account.";
            $icon = 'credit-card';
            $color = 'blue';
        }

        $this->notifications->log(
            (int) $txn->user_id,
            'Bank Account',
            'transaction',
            $title,
            $body,
            $icon,
            $color,
            $txn
        );
    }
}
