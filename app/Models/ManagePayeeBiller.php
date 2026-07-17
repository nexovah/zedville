<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagePayeeBiller extends Model
{
    use HasFactory;

    // Specify table name
    protected $table = 'manage_payees_biller'; // or 'manage_payee_billers' if your table name matches

    // Mass assignable fields
    protected $fillable = [
        'sid',
        'name',
        'account_number',
        'amount',
        'status',
    ];

    // Cast amount to decimal, status to integer
    protected $casts = [
        'amount' => 'decimal:2',
        'status' => 'integer',
    ];

    // Enable timestamps
    public $timestamps = true;

    /**
     * Scope to filter active billers/payees
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
