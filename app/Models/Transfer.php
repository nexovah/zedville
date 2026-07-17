<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sid',
        'from_account',
        'account_number',
        'sort_code',
        'beneficiary_name',
        'amount',
        'memo',
        'type',
        'scheduled_at',
        'start_date',
        'end_date',
        'frequency',
    ];

    // If you want date casting for scheduled_at
    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
