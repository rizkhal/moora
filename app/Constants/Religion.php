<?php

namespace App\Constants;

use App\Constants\BaseConstant;

class Religion extends BaseConstant
{
    public const ISLAM = 0;
    public const KRISTEN = 1;
    public const HINDU = 2;

    public static function labels(): array
    {
        return ['Islam', 'Kristen', 'Hindu'];
    }
}
