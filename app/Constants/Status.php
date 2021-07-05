<?php

namespace App\Constants;

class Status extends BaseConstant
{
    const INACTIVE = 0;
    const ACTIVE = 1;

    public static function labels(): array
    {
        return [
            self::ACTIVE => 'Aktif',
            self::INACTIVE => 'Tidak Aktif',
        ];
    }

    public static function key($key): int
    {
        return array_search(static::labels()[$key], static::labels());
    }
}
