<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetitionSignature extends Model
{
    protected $table = 'petition_signatures';

    public $timestamps = false;

    protected $fillable = [

        'petition_id',

        'student_id',

        'created_at',

    ];

    public function petition()
    {
        return $this->belongsTo(Petition::class);
    }

}