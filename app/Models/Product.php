<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'sid',
        'product_name',
        'type',
        'category',
        'goods_type',
        'price',
        'image',
    ];
}
