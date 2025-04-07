<?php
declare(strict_types=1);

namespace App\Enums;
enum CookieSameSite: string
{
    case NONE = "none";
    case LAX = "lax";
    case STRICT = "strict";
}