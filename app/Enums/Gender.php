<?php

namespace App\Enums;

use App\Enums\Interface\HasLabel;

enum Gender: int implements HasLabel {
    case MALE = 0;
    case FEMALE = 1;

    public function label(): string
    {
        return match($this) 
        {
            self::MALE => 'Pria',   
            self::FEMALE => 'Wanita',
        };
    }
}