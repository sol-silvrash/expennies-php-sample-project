<?php
declare(strict_types=1);

namespace App\Enums;

enum AppEnvironment: string
{
    case DEVELOPMENT = 'development';
    case PRODUCTION = 'production';

    public static function isProduction(string $appEnvironment): bool
    {
        return self::tryFrom($appEnvironment) === self::PRODUCTION;
    }

    public static function isDevelopment(string $appEnvironment): bool
    {
        return self::tryFrom($appEnvironment) === self::DEVELOPMENT;
    }
}