<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenaltyWant extends Model
{
    protected $table = 'penalty_wants_items';
    protected $fillable = ['sid','item_name','price','category'];
}
