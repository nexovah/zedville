<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMba extends Model
{
    protected $table = 'user_mba';

    protected $fillable = [
        'user_id',
        'sid',
        'budget',
    ];

    protected $casts = [
        'budget' => 'array', // Automatically converts JSON <-> array
    ];

    // If you want to link to user model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
