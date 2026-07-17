<?php

namespace App\Jobs;

use App\Models\Transfer;
use App\Http\Controllers\BankController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class ProcessScheduledTransfer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $transferId;

    public function __construct($transferId)
    {
        $this->transferId = $transferId;
    }

    public function handle()
    {
        $transfer = Transfer::find($this->transferId);
        if (!$transfer) return;

        // ✅ Use the correct controller where processTransfer() actually exists
        $controller = new BankController();
        $controller->processTransfer($transfer->id, now());

        // ✅ If recurring, schedule next transfer
        if ($transfer->type === 'recurring' && $transfer->frequency && $transfer->start_date) {
            $lastDate = $transfer->last_processed_at
                ? Carbon::parse($transfer->last_processed_at)
                : Carbon::parse($transfer->start_date);

            $nextDate = match ($transfer->frequency) {
                'weekly' => $lastDate->addWeek(),
                'monthly' => $lastDate->addMonth(),
                'yearly' => $lastDate->addYear(),
                default => null,
            };

            if ($nextDate && (!$transfer->end_date || $nextDate->lte(Carbon::parse($transfer->end_date)))) {
                $transfer->update(['last_processed_at' => $nextDate]);
                self::dispatch($transfer->id)->delay($nextDate->diffInSeconds(now()));
            }
        }
    }
}
