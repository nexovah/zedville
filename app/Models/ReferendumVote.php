<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferendumVote extends Model
{
    protected $table = 'referendum_votes';

    public $timestamps = false;

    protected $fillable = [

        'referendum_id',

        'student_id',

        'vote',

        'created_at',

    ];

    public function referendum()
    {
        return $this->belongsTo(Referendum::class);
    }

}