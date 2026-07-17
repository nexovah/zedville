<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectDeposite extends Model
{
    use HasFactory;

    protected $table = 'direct_deposite';

    // Auto timestamp is enabled by default
    public $timestamps = true;
    
    protected $fillable = [
        'student_id',      // <-- added
        'sid',      // <-- added
        'empname',
        'empphone',
        'empemail',
        'empid',
        'bankname',
        'bankaccountiban',
        'banknumber',
        'bankdeposite',
        'empsignature',
        'empdate',
        'empreceived',
        'empreceiveddate',
        'empeffectivedate',
        'note',
    ];
}
