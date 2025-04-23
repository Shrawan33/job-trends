<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait NextNumber
{
    public static function getCounter()
    {
        return self::getModel()->withTrashed()->max(self::getModel()->getTable() . '.id') + 1;
    }

    public static function bootNextNumber()
    {
        static::creating(function ($model) {
            if (!empty($model->next_number_fields)) {
                foreach ($model->next_number_fields as $field) {
                    if (!empty($model->$field)) {
                        continue;
                    }
                    $next_id = $model->getCounter();
                    $model->$field = Str::getNextNumber($field, $next_id, null);
                }
            }
        });
    }
}
