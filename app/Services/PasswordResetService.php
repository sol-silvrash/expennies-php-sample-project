<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\UserInterface;
use App\Entity\PasswordReset;
use DateTime;
class PasswordResetService
{
    public function __construct(
        private readonly BaseEntityManagerServiceInterface $entityManager,
        private readonly HashService $hashService,
    ) {
    }

    public function generate(string $email): PasswordReset
    {
        $passwordReset = new PasswordReset();

        $passwordReset->setToken(bin2hex(random_bytes(32)));
        $passwordReset->setExpiration(new DateTime('+30 minutes'));
        $passwordReset->setEmail($email);

        $this->entityManager->sync($passwordReset);

        return $passwordReset;
    }

    public function deactivateAllPasswordResets(string $email)
    {
        $this->entityManager->getRepository(PasswordReset::class)
            ->createQueryBuilder('pr')
            ->update()
            ->set('pr.isActive', '0')
            ->where('pr.email = :email')
            ->andWhere('pr.isActive = 1')
            ->setParameter('email', $email)
            ->getQuery()
            ->execute();
    }

    public function fetchByToken(string $token): ?PasswordReset
    {
        return $this->entityManager->getRepository(PasswordReset::class)
            ->createQueryBuilder('pr')
            ->select('pr')
            ->where('pr.token = :token')
            ->andWhere('pr.isActive = :active')
            ->andWhere('pr.expiration > :now')
            ->setParameter('token', $token)
            ->setParameter('active', true)
            ->setParameter('now', new DateTime())
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function updatePassword(UserInterface $user, string $password)
    {
        $this->entityManager->wrapInTransaction(function () use ($user, $password) {
            $this->deactivateAllPasswordResets($user->getEmail());
            $user->setPassword($this->hashService->hashPassword($password));

            $this->entityManager->sync($user);
        });
    }
}