<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $table = 'calendar_events';

    protected $fillable = [
        'sid',
        'title',
        'activitys',
        'activityType',
        'classId',
        'position',
        'repeatActivity',
        'start',
        'end',
        'description',
        'backgroundColor',
        'borderColor',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime',
    ];
}
