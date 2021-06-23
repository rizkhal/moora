<?php

namespace App\Constants;

class Attribute extends BaseConstant
{
    const COST = 0;
    const BENEFIT = 1;
    
    public static function labels(): array
    {
        return ['Cost', 'Benefit'];
    }
}