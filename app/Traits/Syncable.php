<?php

namespace App\Traits;

trait Syncable
{
    public static function bootSyncable(): void
    {
        static::creating(function ($model) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($model->getTable(), 'synced_at')) {
                $model->synced_at = null;
            }
        });

        static::updating(function ($model) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($model->getTable(), 'synced_at')) {
                $model->synced_at = null;
            }
        });
    }
}
