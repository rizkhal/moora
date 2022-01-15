<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Interface\HasColor;
use App\Enums\Interface\HasLabel;

enum PermissionType: int implements HasLabel, HasColor
{
    case CREATE = 1;
    case READ = 2;
    case UPDATE = 3;
    case DELETE = 4;

    public function color(): string
    {
        return match($this) 
        {
            self::CREATE => 'indigo-500',
            self::READ => 'green-500',
            self::UPDATE => 'blue-500',
            self::DELETE => 'red-500',
        };
    }

    public function label(): string
    {
        return match($this) 
        {
            self::CREATE => __('Tambah'),
            self::READ => __('Lihat'),
            self::UPDATE => __('Ubah'),
            self::DELETE => __('Hapus'),
        };
    }
}