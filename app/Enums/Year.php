<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Year: string implements HasLabel
{
    case FIRSTYEAR = '1';
    case SECONDYEAR = '2';
    case THIRDYEAR = '3';
    case FOURTHYEAR = '4';

    public function getLabel(): string
    {
        return match ($this) {
            self::FIRSTYEAR => '1st Year',
            self::SECONDYEAR => '2nd Year',
            self::THIRDYEAR => '3rd Year',
            self::FOURTHYEAR => '4th Year',
        };
    }
}
