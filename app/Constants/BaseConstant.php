<?php

declare(strict_types=1);

namespace App\Constants;

abstract class BaseConstant
{
    /**
     * Abstract labels
     *
     * @return array
     */
    abstract static public function labels(): array;

    /**
     * Get label using key
     *
     * @param integer $key
     * @return string
     */
    public function label(int $key): string
    {
        return static::labels()[$key];
    }
}