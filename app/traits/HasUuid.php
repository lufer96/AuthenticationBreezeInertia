<?php

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * Adds functionalities to models whose are using uuid
 */
trait HasUuid
{
    public function getRouteKeyName()
    {
        return self::getUuidKeyName();
    }

    public static function getUuidKeyName()
    {
        return 'uuid_key';
    }

    public static function bootHasUuid()
    {
        static::creating(function ($model) {
            $propertyName = static::getUuidKeyName();
            if (!$model->{$propertyName}) {
                $model->{$propertyName} = static::generateUuid();
            }
        });
    }

    public static function generateUuid()
    {
        return Str::uuid();
    }

    public static function getByUuid(string $uuid): ?self
    {
        return self::where(self::getUuidKeyName(), $uuid)->first() ?? null;
    }

}
