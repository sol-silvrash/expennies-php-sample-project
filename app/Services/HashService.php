<?php
declare(strict_types=1);

namespace App\Services;
class HashService
{
    public function hashPassword(string $password, string $algo = PASSWORD_BCRYPT, int $cost = 12): string
    {
        return password_hash($password, $algo, ['cost' => $cost]);
    }
}