<?php

namespace App\Constants;

use App\Constants\BaseConstant;

class Gender extends BaseConstant
{
    public const MALE = 0;
    public const FEMALE = 1;

    public static function labels(): array
    {
        return ['Pria', 'Wanita'];
    }
}
