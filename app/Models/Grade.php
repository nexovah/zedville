<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    // Optional: specify the table if it doesn't follow Laravel's naming convention
    protected $table = 'classes';

    // Define which fields are mass assignable
    protected $fillable = [
        'sid',
        'name',
        'classCode',
        'section',
        'description',
        'status',
        'status',
        'created_at',
        'updated_at',
    ];

    // Optional: If you don't want timestamps, set this to false
    // public $timestamps = false;
}
