<?php

namespace App\Enums;

use App\Enums\Interface\HasLabel;

enum Status: int implements HasLabel
{
    case ACTIVE = 1;
    case INACTIVE = 2;

    public function label(): string
    {
        return match($this) 
        {
            self::ACTIVE => 'Active',   
            self::INACTIVE => 'Inactive',
        };
    }
}