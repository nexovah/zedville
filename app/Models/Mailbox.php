<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    protected $table = 'mailbox';

    protected $fillable = [
        'student_id', 'sid', 'subject', 'content', 'type', 'read', 'adminemail', 'created_at', 'updated_at'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}

