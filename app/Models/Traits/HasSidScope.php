<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSidScope
{
    protected static function bootHasSidScope()
    {
        // 🔍 Global filter
        static::addGlobalScope('sid', function (Builder $builder) {
            if (session()->has('selected_school')) {
                $builder->where(
                    $builder->getModel()->getTable() . '.sid',
                    session('selected_school')
                );
            }
        });

        // 📝 Auto-attach sid on insert
        static::creating(function ($model) {
            if (session()->has('selected_school') && empty($model->sid)) {
                $model->sid = session('selected_school');
            }
        });
    }
}
