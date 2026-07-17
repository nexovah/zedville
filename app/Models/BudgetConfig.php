<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetConfig extends Model
{
    protected $table = 'budget_config'; // <-- add this line
    protected $fillable = ['sid','monthly_salary','needs_percentage','wants_percentage','savings_percentage','effective_date'];
    protected $dates = ['effective_date'];
}
