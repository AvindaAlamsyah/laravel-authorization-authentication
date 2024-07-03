<?php

namespace App\Enums;

enum UserType: string
{
    case INTERNAL = 'INTERNAL';
    case EXTERNAL = 'EXTERNAL';
}
