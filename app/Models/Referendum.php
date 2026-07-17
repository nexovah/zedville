<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referendum extends Model
{
    protected $table = 'referendums';

    protected $fillable = [

        'question',

        'description',

        'status',

        'start_date',

        'end_date',

        'created_by',

    ];

    protected $casts = [

        'start_date' => 'date',

        'end_date' => 'date',

    ];

    public function votes()
    {
        return $this->hasMany(ReferendumVote::class);
    }

    public function yesVotes()
    {
        return $this->hasMany(ReferendumVote::class)
                    ->where('vote','yes');
    }

    public function noVotes()
    {
        return $this->hasMany(ReferendumVote::class)
                    ->where('vote','no');
    }

}