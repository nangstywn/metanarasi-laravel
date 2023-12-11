<?php

namespace App\Repositories\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait WithUuid
{
    public function scopeFindByUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid)->first();
    }

    public function scopeFindOrFailByUuid($query, $uuid)
    {
        $model =  $query->where('uuid', $uuid)->first();
        if (empty($model)) {
            throw new ModelNotFoundException;
        }
        return $model;
    }
    protected static function bootWithUuid()
    {
        self::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
