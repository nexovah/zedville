<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sid',
        'name',
        'email',
        'password',
        'citizenId',
        'avatar',
        'age',
        'grade',
        'address',
        'mascot',
        'role',
        'loginTime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function avatar()
    {
    return $this->belongsTo(\App\Models\Avatar::class, 'avatar'); // avatar is the foreign key in users table
    }
    public function gradeRelation()
    {
        return $this->belongsTo(\App\Models\Grade::class, 'grade', 'id');
    }

    public function mascotRelation()
    {
        return $this->belongsTo(\App\Models\Mascot::class, 'mascot', 'id');
    }

    public function avatarRelation()
    {
        return $this->belongsTo(\App\Models\Avatar::class, 'avatar', 'id');
    }
    public function schoolRelation()
    {
        return $this->belongsTo(\App\Models\SchoolDomain::class, 'sid', 'id');
    }
}
