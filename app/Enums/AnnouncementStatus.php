<?php

namespace App\Enums;

enum AnnouncementStatus: int
{
    case DEFAULT = 0;
    case STARED = 1;
    case DRAFT = 2;
    case TRASH = 3;
}
