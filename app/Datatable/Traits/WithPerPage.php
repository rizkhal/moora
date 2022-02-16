<?php

namespace App\Datatable\Traits;

/**
 * With PerPage
 */
trait WithPerPage
{
    public function perPage(): int
    {
        return request()->get('perpage', property_exists($this, 'perPage') ? (int)$this->perPage : 15);
    }
}
