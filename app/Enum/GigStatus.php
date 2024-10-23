<?php

namespace App\Enum;

enum GigStatus: int
{
    case Draft = 0;
    case Posted = 1;

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Posted => 'Posted',
        };
    }
}
