<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'sid',
        'type',
        'txn_date',
        'value_date',
        'description',
        'ref_no',
        'debit',
        'credit',
        'balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'txn_date'  => 'datetime',
        'value_date'=> 'datetime',
    ];
}

?>