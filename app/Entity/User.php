<?php
declare(strict_types=1);

namespace App\Entity;

use App\Contracts\OwnableInterface;
use App\Contracts\UserInterface;
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
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Doctrine\UuidV7Generator;
use Ramsey\Uuid\UuidInterface;

#[Entity, Table('users')]
#[HasLifecycleCallbacks]
class User implements UserInterface
{
    /* -------------------------------------------------------------------------- */
    /*                                 Attributes                                 */
    /* -------------------------------------------------------------------------- */

    use EntityTimestamp;

    #[Id, Column(type: "uuid_binary", unique: true)]
    #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidV7Generator::class)]
    private UuidInterface $id;

    #[Column]
    private string $email;

    #[Column]
    private string $password;

    #[Column(name: 'verified_at', nullable: true)]
    private ?DateTime $verifiedAt;

    #[Column]
    private string $name;

    #[Column('has_2fa_auth_enabled', options: ['default' => false])]
    private bool $hasTwoFactorAuthEnabled;

    #[OneToMany(mappedBy: 'user', targetEntity: Category::class)]
    private Collection $categories;

    #[OneToMany(mappedBy: 'user', targetEntity: Transaction::class)]
    private Collection $transactions;

    /* -------------------------------------------------------------------------- */
    /*                                 Constructor                                */
    /* -------------------------------------------------------------------------- */

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->transactions = new ArrayCollection();
        $this->hasTwoFactorAuthEnabled = false;
    }

    /* -------------------------------------------------------------------------- */
    /*                             Getters and Setters                            */
    /* -------------------------------------------------------------------------- */

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getCategories(): ArrayCollection|Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        $this->categories->add($category);

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

    public function canManage(OwnableInterface $entity): bool
    {
        return $this->getId() === $entity->getUser()->getId();
    }

    public function getVerifiedAt(): ?DateTime
    {
        return $this->verifiedAt;
    }

    public function setVerifiedAt(DateTime $verifiedAt): self
    {
        $this->verifiedAt = $verifiedAt;
        return $this;
    }

    public function hasTwoFactorAuthEnabled(): bool
    {
        return $this->hasTwoFactorAuthEnabled;
    }

    public function setHasTwoFactorAuthEnabled(bool $hasTwoFactorAuthEnabled): self
    {
        $this->hasTwoFactorAuthEnabled = $hasTwoFactorAuthEnabled;

        return $this;
    }
}