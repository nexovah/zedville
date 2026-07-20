<?php

namespace App\Services;

use App\Models\Transaction1;

class BalanceService
{
    /**
     * Read a user's current balance with a row lock (SELECT ... FOR UPDATE).
     * Must be called from inside an open DB transaction (DB::transaction()
     * or DB::beginTransaction()) — the lock has no protective effect if
     * called outside one, since it's released as soon as the query completes.
     */
    public static function lockedBalance(int $userId): float
    {
        $latestTxn = Transaction1::where('user_id', $userId)
            ->latest('id')
            ->lockForUpdate()
            ->first();

        return $latestTxn ? (float) $latestTxn->balance : 0.0;
    }
}
