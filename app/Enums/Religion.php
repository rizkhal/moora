<?php

namespace App\Enums;

use App\Enums\Interface\HasLabel;

enum Religion: int implements HasLabel
{
    case ISLAM = 0;
    case KRISTEN = 1;
    case HINDU = 2;

    public function label(): string
    {
        return match($this) 
        {
            self::ISLAM => 'Islam',   
            self::KRISTEN => 'Kristen',
            self::HINDU => 'Hindu',
        };
    }
}