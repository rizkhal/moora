<?php

namespace App\Datatable\Exceptions;

use App\Datatable\Datatable;
use InvalidArgumentException;

class InvalidDatatable extends InvalidArgumentException
{
    public static function create()
    {
        return new static("The given datatable is not instance of " . Datatable::class . " class.");
    }
}
