<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class SchoolMonthSetting extends Model
{
    protected $table = 'school_month_settings';

    protected $fillable = [
        'school_id',
        'start_month'
    ];
}
