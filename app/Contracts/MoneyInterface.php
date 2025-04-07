<?php
declare(strict_types=1);

namespace App\Contracts;

use Money\Money;
interface MoneyInterface
{
    public function getMoney(): Money;
    public function getValue(): string;
    public function setInverse(bool $inverse): void;
    public function isInversed(): bool;
}