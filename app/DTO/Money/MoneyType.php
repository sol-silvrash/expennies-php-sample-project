<?php
declare(strict_types=1);

namespace App\DTO\Money;

use App\Contracts\MoneyInterface;
use App\Exception\MoneyTypeDBException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
class MoneyType extends Type
{
    public const NAME = 'money_php';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getIntegerTypeDeclarationSQL([
            'fixed' => false
        ]);
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return new MoneyPHP((string) $value, true);
    }

    /**
     * @param MoneyInterface $value
     */
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value instanceof MoneyInterface)
            return ($value->isInversed() ? '-' : '') . $value->getMoney()->getAmount();
        return new MoneyTypeDBException('Value is not an instance of ' . MoneyInterface::class);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}