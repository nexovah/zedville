<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayBill extends Model
{
    use HasFactory;

    protected $table = 'pay_bills';

    protected $fillable = [
        'user_id',
        'sid',
        'account_id',     // varchar: can hold text or ID
        'biller_id',      // varchar: can hold text or ID
        'account_number',
        'amount',
        'payment_type',
        'schedule_date',
        'frequency',
        'start_date',
        'end_date',
    ];
}
