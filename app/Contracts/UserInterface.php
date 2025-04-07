<?php
declare(strict_types=1);

namespace App\Contracts;

use App\Entity\User;
use Ramsey\Uuid\UuidInterface;

/**
 * @mixin User
 */
interface UserInterface
{
    public function getId(): UuidInterface;

    public function getPassword(): string;

    public function getName(): string;

}