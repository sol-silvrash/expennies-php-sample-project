<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Doctrine\UuidV7Generator;
use Ramsey\Uuid\UuidInterface;

#[Entity, Table('receipts')]
class Receipt
{
    /* -------------------------------------------------------------------------- */
    /*                                 Attributes                                 */
    /* -------------------------------------------------------------------------- */

    #[Id, Column(type: "uuid_binary", unique: true)]
    #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidV7Generator::class)]
    private UuidInterface $id;

    #[Column]
    private string $filename;

    #[Column('storage_filename')]
    private string $storageFilename;

    #[Column('media_type')]
    private string $mediaType;

    #[Column(name: 'created_at')]
    private DateTime $createdAt;

    #[ManyToOne(inversedBy: 'receipts')]
    private Transaction $transaction;

    /* -------------------------------------------------------------------------- */
    /*                                 Constructor                                */
    /* -------------------------------------------------------------------------- */

    public function __construct()
    {

    }

    /* -------------------------------------------------------------------------- */
    /*                             Getters and Setters                            */
    /* -------------------------------------------------------------------------- */

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getStorageFilename(): string
    {
        return $this->storageFilename;
    }

    public function setStorageFilename(string $storageFilename): self
    {
        $this->storageFilename = $storageFilename;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTransaction(): Transaction
    {
        return $this->transaction;
    }

    public function setTransaction(Transaction $transaction): self
    {
        $transaction->addReceipt($this);
        $this->transaction = $transaction;

        return $this;
    }

    public function getMediaType(): string
    {
        return $this->mediaType;
    }

    public function setMediaType(string $mediaType): self
    {
        $this->mediaType = $mediaType;
        return $this;
    }
}