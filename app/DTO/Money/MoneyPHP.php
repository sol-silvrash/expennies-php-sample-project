<?php
declare(strict_types=1);

namespace App\DTO\Money;

use App\Contracts\MoneyInterface;
use BadMethodCallException;
use Money\Money;
use Money\Teller;
class MoneyPHP implements MoneyInterface
{
    private const CURRENCY = 'PHP';

    private Money $money;
    private bool $inversed;

    public function __construct(
        private readonly string $value,
        private readonly bool $fromDB = false,
    ) {
        $this->inversed = filter_var($value, FILTER_VALIDATE_FLOAT) < 0;
        $this->money = MoneyFactory::make($value, self::CURRENCY, $fromDB);
    }

    public function __call($method, $args)
    {
        if (method_exists($this->money, $method))
            return call_user_func_array([$this->money, $method], $args);

        throw new BadMethodCallException('Call to undefined method');
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getValue(): string
    {
        return (($this->isInversed()) ? '-' : '') . MoneyFactory::getAmount($this->money, Teller::PHP());
    }

    public function isInversed(): bool
    {
        return $this->inversed;
    }

    public function setInverse(bool $inverse): void
    {
        $this->inversed = $inverse;
    }
}