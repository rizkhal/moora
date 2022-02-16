<?php

namespace App\Enums;

use App\Enums\Interface\HasLabel;

enum ReqruitmentStatus: int implements HasLabel
{
    case OPEN = 0;
    case CLOSED = 1;

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Buka',
            self::CLOSED => 'Tutup',
        };
    }
}
