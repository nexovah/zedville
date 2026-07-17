<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellbeingPost extends Model
{
    use HasFactory;

    protected $table = 'wellbeing_posts';

    protected $fillable = [
        'title',
        'short_description',
        'content',
        'type',
        'category',
        'youtube_url',
        'read_time',
        'featured',
        'status',
        'published_at',
        'created_by'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'status' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}