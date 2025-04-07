<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\UserInterface;
class ProfileService
{
    public function __construct(private readonly HashService $hashService)
    {
    }

    public function verifyPassword(UserInterface $user, array $data)
    {
        return password_verify($data['currentPassword'], $user->getPassword());
    }

    public function updatePassword(UserInterface $user, array $data)
    {
        $user->setPassword($this->hashService->hashPassword($data['newPassword']));

        return $user;
    }
}