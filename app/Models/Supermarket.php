<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supermarket extends Model
{
    use HasFactory;

    // Table name (optional if following Laravel convention)
    protected $table = 'supermarkets';

    // Mass assignable fields
    protected $fillable = [
        'sid',
        'product_name',
        'type',
        'category',
        'price',
        'quantity',
        'image',
    ];
}
