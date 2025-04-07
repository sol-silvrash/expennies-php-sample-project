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

#[Entity, Table('user_login_codes')]
class UserLoginCode
{
    #[Id, Column(type: "uuid_binary", unique: true)]
    #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidV7Generator::class)]
    private UuidInterface $id;

    #[Column]
    private string $code;

    #[Column('is_active', options: ['default' => true])]
    private bool $isActive;

    #[Column]
    private DateTime $expiration;

    #[ManyToOne]
    private User $user;

    public function __construct()
    {
        $this->isActive = true;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getExpiration(): DateTime
    {
        return $this->expiration;
    }

    public function setExpiration(DateTime $expiration): self
    {
        $this->expiration = $expiration;
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
}