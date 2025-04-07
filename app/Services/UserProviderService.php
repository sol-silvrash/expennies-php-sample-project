<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\UserInterface;
use App\Contracts\UserProviderServiceInterface;
use App\DTO\RegisterUserData;
use App\Entity\User;
use DateTime;
use Ramsey\Uuid\UuidInterface;

class UserProviderService implements UserProviderServiceInterface
{
    public function __construct(
        private readonly BaseEntityManagerService $entityManager,
        private readonly HashService $hashService
    ) {
    }

    public function getById(UuidInterface $user): ?UserInterface
    {
        return $this->entityManager->find(User::class, $user);
    }

    public function getByCredentials(array $credentials): ?UserInterface
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $credentials['email']]);
    }

    public function createUser(RegisterUserData $data): UserInterface
    {
        $user = new User();

        $user->setName($data->name);
        $user->setEmail($data->email);
        $user->setPassword($this->hashService->hashPassword($data->password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function verifyUser(User $user): void
    {
        $user->setVerifiedAt(new DateTime());

        $this->entityManager->sync($user);
    }

    public function saveUserChanges(User $user, string $name, bool $has2FA): void
    {
        $user->setName($name);
        $user->setHasTwoFactorAuthEnabled($has2FA);

        $this->entityManager->sync($user);
    }
}