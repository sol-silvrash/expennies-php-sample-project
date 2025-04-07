<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\Receipt;
use App\Entity\Transaction;
use DateTime;
use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\UuidInterface;
class ReceiptService extends BaseEntityManagerService
{
    public function create(Transaction $transaction, string $filename, string $storageFilename, string $mediaType): Receipt
    {
        $receipt = new Receipt();
        $receipt->setTransaction($transaction);
        $receipt->setFilename($filename);
        $receipt->setStorageFilename($storageFilename);
        $receipt->setMediaType($mediaType);
        $receipt->setCreatedAt(new DateTime());

        $this->entityManager->persist($receipt);

        return $receipt;
    }

    public function fetch(UuidInterface $id): ?Receipt
    {
        $query = $this->entityManager->getRepository(Receipt::class)
            ->createQueryBuilder('r')
            ->where('r.id = :id')
            ->setParameter('id', $id, 'uuid_binary');

        return $query->getQuery()->execute()[0];
    }
}