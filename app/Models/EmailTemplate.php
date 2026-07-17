<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    // Table name (optional if it follows Laravel naming conventions)
    protected $table = 'email_templates';

    // Fillable fields for mass assignment
    protected $fillable = [
        'sid',
        'store_name',
        'subTitle',
        'subject',
        'content',
    ];

    // Optional: timestamps are enabled by default
    public $timestamps = true;
}
