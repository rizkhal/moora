<?php

namespace App\Datatable\Concerns;

interface FilterInterface
{
    /**
     * Datatable filters
     *
     * @return array
     */
    public function filters(): array;
}