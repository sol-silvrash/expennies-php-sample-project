<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\BaseEntityManagerServiceInterface;
use App\DTO\DataTableQueryParams;
use App\DTO\Money\MoneyPHP;
use App\Entity\Receipt;
use App\Entity\Transaction;
use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
class TransactionService
{
    public function __construct(
        protected readonly BaseEntityManagerServiceInterface $entityManager,
        protected readonly CategoryService $categoryService,
        protected readonly ReceiptService $receiptService
    ) {
    }

    public function create(User $user, array $params): Transaction
    {
        $transaction = new Transaction();

        $transaction->setUser($user);
        $transaction->setDescription($params['description']);
        $transaction->setDate(new DateTime($params['date']));
        $transaction->setAmount(new MoneyPHP($params['amount']));
        if (!empty($params['category']))
            $transaction->setCategory($this->categoryService->getById(Uuid::fromString($params['category'])));

        return $transaction;
    }

    public function update(Transaction $transaction, array $params): Transaction
    {
        $transaction->setDescription($params['description']);
        $transaction->setDate(new DateTime($params['date']));
        $transaction->setAmount(new MoneyPHP($params['amount']));
        if (!empty($params['category']))
            $transaction->setCategory($this->categoryService->getById(Uuid::fromString($params['category'])));
        return $transaction;
    }

    public function toggleReviewed(Transaction $transaction): Transaction
    {
        $transaction->setReviewed(!$transaction->wasReviewed());
        return $transaction;
    }

    public function fetch(UuidInterface $id): ?Transaction
    {
        $query = $this->entityManager->getRepository(Transaction::class)
            ->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter('id', $id, 'uuid_binary');

        return $query->getQuery()->execute()[0];
    }

    public function fetchTableData(DataTableQueryParams $params, User $user): Paginator
    {
        $query = $this->entityManager
            ->getRepository(Transaction::class)
            ->createQueryBuilder('t')
            ->select('t', 'c', 'r')
            ->leftJoin('t.category', 'c')
            ->leftJoin('t.receipts', 'r')
            ->setFirstResult($params->start)
            ->setMaxResults($params->length)
            ->where('t.user = :user')
            ->setParameter('user', $user->getId(), 'uuid_binary');

        $orderBy = in_array($params->orderBy, ['description', 'amount', 'category', 'date']) ? $params->orderBy : 'date';
        $orderDir = strtolower($params->orderDir) === 'asc' ? 'asc' : 'desc';

        if (!empty($param->searchTerm)) {
            $query->andWhere('t.description LIKE :description')
                ->setParameter('description', '%' . addcslashes($params->searchTerm, '%_') . '%');
        }

        if ($orderBy === 'category')
            $query->orderBy('c.name', $orderDir);
        else
            $query->orderBy("t.$orderBy", $orderDir);

        return new Paginator($query);
    }

}