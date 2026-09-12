<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Named AppNotification (table app_notifications) rather than Notification
 * (notifications) deliberately — User already uses Laravel's Notifiable
 * trait, which owns the "notifications" table name and a different schema.
 */
class AppNotification extends Model
{
    protected $table = 'app_notifications';

    protected $fillable = [
        'user_id', 'category', 'type', 'title', 'body', 'icon', 'color',
        'source_type', 'source_id', 'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function source()
    {
        return $this->morphTo();
    }
}
