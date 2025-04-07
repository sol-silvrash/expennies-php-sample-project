<?php
declare(strict_types=1);

namespace App\Entity;

use App\Contracts\MoneyInterface;
use App\Contracts\OwnableInterface;
use App\DTO\Money\MoneyPHP;
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
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Doctrine\UuidV7Generator;
use Ramsey\Uuid\UuidInterface;

#[Entity, Table('transactions')]
#[HasLifecycleCallbacks]
class Transaction implements OwnableInterface
{
    /* -------------------------------------------------------------------------- */
    /*                                 Attributes                                 */
    /* -------------------------------------------------------------------------- */

    use EntityTimestamp;

    #[Id, Column(type: "uuid_binary", unique: true)]
    #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidV7Generator::class)]
    private UuidInterface $id;

    #[Column('was_reviewed', options: ['default' => 0])]
    private bool $wasReviewed;

    #[Column]
    private string $description;

    #[Column]
    private DateTime $date;

    #[Column(type: 'money_php')]
    private MoneyPHP $amount;

    #[Column(name: 'created_at')]
    private DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private DateTime $updatedAt;

    #[ManyToOne(inversedBy: 'transactions')]
    private User $user;

    #[ManyToOne(inversedBy: 'transactions')]
    #[JoinColumn(nullable: true)]
    private Category $category;

    #[OneToMany(mappedBy: 'transaction', targetEntity: Receipt::class, cascade: ['remove'])]
    private Collection $receipts;

    /* -------------------------------------------------------------------------- */
    /*                                 Constructor                                */
    /* -------------------------------------------------------------------------- */

    public function __construct()
    {
        $this->receipts = new ArrayCollection();
        $this->wasReviewed = false;
    }

    /* -------------------------------------------------------------------------- */
    /*                             Getters and Setters                            */
    /* -------------------------------------------------------------------------- */

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function wasReviewed(): bool
    {
        return $this->wasReviewed;
    }

    public function setReviewed(bool $wasReviewed): self
    {
        $this->wasReviewed = $wasReviewed;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAmount(): MoneyInterface
    {
        return $this->amount;
    }

    public function setAmount(MoneyInterface $amount): self
    {
        $this->amount = $amount;
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
        $this->user = $user;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        // $category?->addTransaction($this);
        $this->category = $category;

        return $this;
    }

    public function getReceipts(): ArrayCollection|Collection
    {
        return $this->receipts;
    }

    public function addReceipt(Receipt $receipt): self
    {
        $this->receipts->add($receipt);

        return $this;
    }

}