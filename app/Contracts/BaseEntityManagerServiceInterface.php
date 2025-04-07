<?php
declare(strict_types=1);

namespace App\Contracts;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @mixin EntityManagerInterface
 */
interface BaseEntityManagerServiceInterface
{
    public function __call($name, $args);

    public function sync($entity = null): void;

    public function delete($entity, bool $sync = false): void;

    public function clear(?string $entityName = null): void;

    public function enableUserAuthFilter(UserInterface $user): void;
}