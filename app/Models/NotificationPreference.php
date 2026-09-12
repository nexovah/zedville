<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationPreference extends Model
{
    protected $fillable = ['user_id', 'category', 'enabled'];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    /**
     * The full list of categories the Settings > Notifications tab shows.
     * Every category defaults to enabled when no row exists yet for a user.
     */
    public const CATEGORIES = [
        'Bank Account',
        'Calendar',
        'Mailbox',
        'City Hall',
        'Education Finance Department',
        'City Mood',
        'Settings',
    ];
}
