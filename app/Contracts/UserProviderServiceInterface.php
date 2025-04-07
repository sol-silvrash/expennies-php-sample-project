<?php
declare(strict_types=1);

namespace App\Contracts;

use App\Contracts\UserInterface;
use App\DTO\RegisterUserData;
use App\Entity\User;
use Ramsey\Uuid\UuidInterface;


interface UserProviderServiceInterface
{
    public function getById(UuidInterface $user): ?UserInterface;

    public function getByCredentials(array $credentials): ?UserInterface;

    public function createUser(RegisterUserData $data): UserInterface;

    public function verifyUser(User $user): void;

    public function saveUserChanges(User $user, string $name, bool $has2FA): void;
}