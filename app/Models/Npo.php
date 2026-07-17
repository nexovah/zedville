<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Npo extends Model
{
    use HasFactory;

    protected $table = 'npos';

    protected $fillable = [
        'category',
        'name',
        'slug',
        'content',
        'image',
        'account_number',
        'bank_name',
        'status',
        'sort_order'
    ];
}