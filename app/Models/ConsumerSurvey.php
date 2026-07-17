<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsumerSurvey extends Model
{
    protected $fillable = [
        'user_id',
        'sid',
        'diet',
        'groceries',
        'basket_cost',
        'lunch',
        'transport',
        'activities',
        'restaurants',
        'total_cost',
        'survey_month',
    ];

    protected $casts = [
        'groceries' => 'array',
    ];
}
