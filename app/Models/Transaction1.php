<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction1 extends Model
{
    protected $table = 'transactions1'; // <-- add this line
    protected $fillable = [
        'user_id','sid','bank_account_id','transaction_date','description','type',
        'category','amount','balance','is_penalty','meta'
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'is_penalty' => 'boolean',
        'meta' => 'array',
    ];
}
