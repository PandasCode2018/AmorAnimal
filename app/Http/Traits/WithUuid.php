<?php

namespace App\Http\Traits;

use Ramsey\Uuid\Uuid;

trait WithUuid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function scopeUuid($query, $uuid)
    {
        if (is_array($uuid)) {
            return $query->whereIn('uuid', $uuid);
        }

        return $query->where('uuid', $uuid);
    }
}
