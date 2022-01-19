<?php

namespace App\Enums;

enum CriteriaType: int
{
    case Text = 1;
    case Option = 2;
    case File = 3;
}