<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    protected $table = 'petitions';

    protected $fillable = [

        'title',

        'description',

        'created_by',

        'status',

        'tutor_feedback',

    ];

    public function signatures()
    {
        return $this->hasMany(PetitionSignature::class);
    }

    public function signatureCount()
    {
        return $this->signatures()->count();
    }

}