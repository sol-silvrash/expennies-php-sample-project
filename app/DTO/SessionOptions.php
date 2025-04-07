<?php
declare(strict_types=1);

namespace App\DTO;

use App\Enums\CookieSameSite;

class SessionOptions
{
    public function __construct(
        public readonly string $name,
        public readonly string $flashkey,
        public readonly bool $secure,
        public readonly bool $httpOnly,
        public readonly CookieSameSite $sameSite
    ) {
    }
}