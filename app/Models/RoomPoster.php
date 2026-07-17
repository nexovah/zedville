<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPoster extends Model
{
    use HasFactory;

    protected $table = 'room_poster';   // your table name
    
    protected $fillable = [
        'sid',
        'poster_name',
        'poster_image',
    ];
}
