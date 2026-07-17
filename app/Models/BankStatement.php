<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankStatement extends Model
{
    protected $fillable = ['user_id','sid','month','year','statement_data','penalty_applied'];

    protected $casts = [
        'statement_data' => 'array',
        'penalty_applied' => 'boolean',
    ];
}
