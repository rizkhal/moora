<?php

namespace App\Enums;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

enum WeightType: int
{
    case COST = 1;
    case BENEFIT = 2;

    public static function labels(): Collection
    {
        return collect(self::cases())->mapWithKeys(fn ($object) => [$object->value => Str::title($object->name)]);
    }
}