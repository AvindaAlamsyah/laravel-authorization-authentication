<?php

namespace App\Enums;

enum UserStatus: string
{
    case PENDING = 'PENDING';
    case ACTIVATED = 'ACTIVATED';
    case SUSPENDED = 'SUSPENDED';

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'secondary',
            self::ACTIVATED => 'primary',
            self::SUSPENDED => 'danger',
        };
    }
}
