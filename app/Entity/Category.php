<?php
declare(strict_types=1);

namespace App\Entity;

use App\Contracts\OwnableInterface;
use App\Entity\Traits\EntityTimestamp;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Doctrine\UuidV7Generator;
use Ramsey\Uuid\UuidInterface;

#[Entity, Table('categories')]
#[HasLifecycleCallbacks]
class Category implements OwnableInterface
{
    /* -------------------------------------------------------------------------- */
    /*                                 Attributes                                 */
    /* -------------------------------------------------------------------------- */

    use EntityTimestamp;

    #[Id, Column(type: "uuid_binary", unique: true)]
    #[GeneratedValue(strategy: "CUSTOM")]
    #[CustomIdGenerator(class: UuidV7Generator::class)]
    private UuidInterface $id;

    #[Column]
    private string $name;

    #[ManyToOne(inversedBy: 'categories')]
    private User $user;

    #[OneToMany(mappedBy: 'category', targetEntity: Transaction::class)]
    private Collection $transactions;

    /* -------------------------------------------------------------------------- */
    /*                                 Constructor                                */
    /* -------------------------------------------------------------------------- */

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    /* -------------------------------------------------------------------------- */
    /*                             Getters and Setters                            */
    /* -------------------------------------------------------------------------- */

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $user->addCategory($this);
        $this->user = $user;

        return $this;
    }

    public function getTransactions(): ArrayCollection|Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        $this->transactions->add($transaction);

        return $this;
    }
}