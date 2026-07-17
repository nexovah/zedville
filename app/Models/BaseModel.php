<?php
// app/Models/BaseModel.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BaseModel extends Model
{
    protected static function booted()
    {
        static::addGlobalScope('sid', function (Builder $builder) {
            if (session()->has('selected_school')) {
                $builder->where(
                    $builder->getModel()->getTable() . '.sid',
                    session('selected_school')
                );
            }
        });

        static::creating(function ($model) {
            if (session()->has('selected_school') && empty($model->sid)) {
                $model->sid = session('selected_school');
            }
        });
    }
}

?>