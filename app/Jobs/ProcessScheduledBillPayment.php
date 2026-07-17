<?php
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction1;
use App\Models\BankAccount;

class ProcessScheduledBillPayment implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $transferId;

    public function __construct($transferId)
    {
        $this->transferId = $transferId;
    }

    public function handle()
    {
        $transfer = \App\Models\Transfer::find($this->transferId);
        if (!$transfer) return;

        $userId = $transfer->user_id;
        $amount = $transfer->amount;
        $beneficiaryName = $transfer->beneficiary_name;
        $accountNumber = $transfer->account_number;

        $senderBank = BankAccount::where('student_id', $userId)->first();
        if (!$senderBank) return;

        $latestTxn = Transaction1::where('user_id', $userId)
            ->latest('transaction_date')->first();
        $balance = $latestTxn?->balance ?? 0;
        $newBalance = $balance - $amount;

        Transaction1::create([
            'user_id' => $userId,
            'bank_account_id' => $senderBank->id,
            'transaction_date' => now(),
            'description' => "Bill payment to {$beneficiaryName} ({$accountNumber})",
            'type' => 'debit',
            'category' => 'Bill Payment',
            'amount' => $amount,
            'balance' => $newBalance,
            'is_penalty' => 0,
        ]);
    }
}
