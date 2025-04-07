<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\UserInterface;
use App\Entity\User;
use App\Entity\UserLoginCode;
use DateTime;
use Ramsey\Uuid\Uuid;
class UserLoginCodeService
{
    public function __construct(
        private readonly BaseEntityManagerServiceInterface $entityManagerService
    ) {
    }

    public function generate(User $user): UserLoginCode
    {
        $userLoginCode = new UserLoginCode();

        $code = strtoupper(trim(substr((string) Uuid::uuid4(), -6)));

        $userLoginCode->setCode($code);
        $userLoginCode->setExpiration(new DateTime('+10 minutes'));
        $userLoginCode->setUser($user);

        $this->entityManagerService->sync($userLoginCode);

        return $userLoginCode;
    }

    public function verify(UserInterface $user, string $code)
    {
        $userLoginCode = $this->entityManagerService
            ->getRepository(UserLoginCode::class)
            ->findOneBy([
                'user' => $user,
                'code' => $code,
                'isActive' => true,
            ]);

        if (!$userLoginCode)
            return false;

        if ($userLoginCode->getExpiration() <= new DateTime())
            return false;

        return true;
    }

    public function deactivateAllActiveCodes(User $user)
    {
        $this->entityManagerService->getRepository(UserLoginCode::class)
            ->createQueryBuilder('c')
            ->update()
            ->set('c.isActive', value: '0')
            ->where('c.user = :user')
            ->andWhere('c.isActive = 1')
            ->setParameter('user', $user->getId(), 'uuid_binary')
            ->getQuery()
            ->execute();
    }
}