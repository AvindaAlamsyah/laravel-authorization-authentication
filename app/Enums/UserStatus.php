<?php

namespace App\Enums;

enum UserStatus: string
{
    case PENDING = 'PENDING';
    case ACTIVATED = 'ACTIVATED';
    case SUSPENDED = 'SUSPENDED';
}
