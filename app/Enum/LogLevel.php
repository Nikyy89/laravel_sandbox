<?php

namespace App\Enum;

enum LogLevel:string
{
    case INFO = 'INFO';
    case WARNING = 'WARNING';
    case ERROR = 'ERROR';

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }
}
