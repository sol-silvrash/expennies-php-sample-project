<?php
declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\EntityTimestamp;
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Doctrine\UuidV7Generator;
use Ramsey\Uuid\UuidInterface;

#[Entity, Table('password_resets')]
#[HasLifecycleCallbacks]
class PasswordReset
{
    use EntityTimestamp;

    #[Id, Column(type: "uuid_binary", unique: true)]
    #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidV7Generator::class)]
    private UuidInterface $id;

    #[Column]
    private string $email;

    #[Column(unique: true)]
    private string $token;

    #[Column('is_active', options: ['default' => true])]
    private bool $isActive;

    #[Column]
    private DateTime $expiration;

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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;
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
}