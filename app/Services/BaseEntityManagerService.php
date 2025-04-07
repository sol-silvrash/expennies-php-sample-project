<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\UserInterface;
use BadMethodCallException;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @mixin EntityManagerInterface
 */
class BaseEntityManagerService implements BaseEntityManagerServiceInterface
{
    public function __construct(protected readonly EntityManagerInterface $entityManager)
    {
    }

    public function __call($name, $args)
    {
        if (method_exists($this->entityManager, $name))
            return call_user_func_array([$this->entityManager, $name], $args);

        throw new BadMethodCallException('Call to undefined method');
    }

    public function sync($entity = null): void
    {
        if ($entity)
            $this->entityManager->persist($entity);

        $this->entityManager->flush();
    }

    public function delete($entity, bool $sync = false): void
    {
        $this->entityManager->remove($entity);

        if ($sync)
            $this->sync();
    }

    public function clear(?string $entityName = null): void
    {
        if ($entityName === null) {
            $this->entityManager->clear();
            return;
        }

        $unitOfWork = $this->entityManager->getUnitOfWork();
        $entities = $unitOfWork->getIdentityMap()[$entityName] ?? [];

        foreach ($entities as $entity) {
            $this->entityManager->detach($entity);
        }
    }

    public function enableUserAuthFilter(UserInterface $user): void
    {
        $this->getFilters()
            ->enable('user')
            ->setParameter('user_id', $user->getId()->getBytes());
    }
}