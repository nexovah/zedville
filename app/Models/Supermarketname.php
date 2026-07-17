<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supermarketname extends Model
{
    use HasFactory;

    // Table name (optional if Laravel naming conventions are followed)
    protected $table = 'supermarketname';

    // Fillable fields
    protected $fillable = [
        'sid',
        'name',
        'image',
    ];

    // Optional: if you want timestamps to be automatically handled
    public $timestamps = true;
}
