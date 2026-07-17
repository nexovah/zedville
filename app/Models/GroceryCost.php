<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroceryCost extends Model
{
    protected $table = 'grocery_costs';
    public $incrementing = false; // diet_type is PK if you used migration above
    protected $primaryKey = 'diet_type';
    protected $keyType = 'string';
    protected $fillable = ['diet_type','sid','monthly_cost','bank_statement_tag'];
}
