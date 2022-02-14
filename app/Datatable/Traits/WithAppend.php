<?php

namespace App\Datatable\Traits;

/**
 * With Append
 */
trait WithAppend
{
    public function appends(): array
    {
        return [];
    }

    public function hasAppends(): bool
    {
        return count($this->appends()) > 0 ? true : false;
    }
}
