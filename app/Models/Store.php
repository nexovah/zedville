<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $fillable = [
        'sid',
        'store_name',
        'store_image',
        // 'user_id', // uncomment if you added user_id column
    ];
}
