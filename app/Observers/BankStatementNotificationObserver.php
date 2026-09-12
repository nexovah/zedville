<?php

namespace App\Observers;

use App\Models\BankStatement;
use App\Services\NotificationService;
use Carbon\Carbon;

class BankStatementNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created(BankStatement $statement): void
    {
        if (! $statement->user_id) {
            return;
        }

        $label = Carbon::createFromDate($statement->year, $statement->month, 1)->format('F Y');

        $this->notifications->log(
            (int) $statement->user_id,
            'Bank Account',
            'statement_ready',
            'Monthly Statement Ready',
            "Your {$label} account statement is now available.",
            'file-text',
            'purple',
            $statement
        );
    }
}
