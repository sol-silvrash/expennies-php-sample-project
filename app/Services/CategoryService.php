<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\UserInterface;
use App\DTO\DataTableQueryParams;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Ramsey\Uuid\UuidInterface;
class CategoryService
{
    public function __construct(
        private readonly BaseEntityManagerServiceInterface $entityManager
    ) {
    }

    public function create(string $name, User $user): Category
    {
        $category = new Category();

        $category->setUser($user);
        $category->setName($name);

        return $category;
    }

    public function fetchAll(): array
    {
        return $this->entityManager->getRepository(Category::class)->findAll();
    }

    public function fetchAllKeyedByName(UserInterface $user): array
    {
        $categories = $this->fetchAllByUser($user->getId());
        $categoriesMap = [];

        /**
         * @var Category $category
         */
        foreach ($categories as $category) {
            $categoriesMap[strtolower($category->getName())] = $category;
        }
        return $categoriesMap;
    }

    public function fetchAllByUser(UuidInterface $userId): array
    {
        return $this->entityManager
            ->getRepository(Category::class)
            ->createQueryBuilder('c')
            ->where('c.user = :user')
            ->setParameter('user', $userId, 'uuid_binary')
            ->orderBy('c.name', 'asc')
            ->getQuery()
            ->getResult();
    }

    public function fetchByName(string $categoryName, User $user): Category
    {
        $query = $this->entityManager
            ->getRepository(Category::class)
            ->createQueryBuilder('c')
            ->where('c.user = :user')
            ->andWhere('c.name = :name')
            ->setParameter('user', $user->getId(), 'uuid_binary')
            ->setParameter('name', $categoryName);

        $category = $query->getQuery()->getResult();

        if (empty($category))
            return $this->create($categoryName, $user);
        return $category[0];
    }

    public function getPaginatedCategories(DataTableQueryParams $params): Paginator
    {
        $query = $this->entityManager
            ->getRepository(Category::class)
            ->createQueryBuilder('c')
            ->setFirstResult($params->start)
            ->setMaxResults($params->length);

        $orderBy = in_array($params->orderBy, ['name', 'createdAt', 'updatedAt']) ? $params->orderBy : 'updatedAt';
        $orderDir = strtolower($params->orderDir) === 'asc' ? 'asc' : 'desc';

        if (!empty($params->searchTerm)) {
            $query->andWhere('c.name LIKE :name')
                ->setParameter('name', '%' . addcslashes($params->searchTerm, '%_') . '%');
        }

        $query->orderBy("c.$orderBy", $orderDir);

        return new Paginator($query);
    }

    public function getById(UuidInterface $id): ?Category
    {
        return $this->entityManager->find(Category::class, $id);
    }

    public function update(Category $category, string $name)
    {
        $category->setName($name);
    }

}