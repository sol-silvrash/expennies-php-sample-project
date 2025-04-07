<?php
declare(strict_types=1);

namespace App\DTO\Money;

use App\Config;
use App\Contracts\MoneyInterface;
use App\Exception\MoneyFormatException;
use Exchanger\Service\ApiLayer\Fixer;
use Http\Client\Curl\Client;
use Money\Converter;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Exchange\ExchangerExchange;
use Money\Exchange\FixedExchange;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Money\Parser\IntlMoneyParser;
use Money\Teller;
use NumberFormatter;
class MoneyFactory
{
    public static function make(string $value, string $currency, bool $fromDB = false): Money
    {
        if ($value = filter_var($value, FILTER_VALIDATE_FLOAT)) {
            $value = round($value, 2);

            if (!$fromDB)
                $value = (string) ($value * 100);

            if ($value = filter_var($value, FILTER_VALIDATE_INT))
                return new Money((string) abs($value), new Currency($currency));
            throw new MoneyFormatException('String value must be of cents.');
        }
        throw new MoneyFormatException('String value cannot be converted to monetization value.');
    }

    public static function getAmount(Money $money, Teller $teller): string
    {
        return $teller->divide($money->getAmount(), 100);
    }

    public static function format(MoneyInterface $money): string
    {
        $nf = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        return new IntlMoneyFormatter($nf, new ISOCurrencies())->format($money->getMoney());
    }

    public static function parse(string $moneyStr): Money
    {
        $nf = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        return new IntlMoneyParser($nf, new ISOCurrencies())->parse($moneyStr);
    }

    public static function convert(Money $money, Currency $currency, Config $config)
    {
        $exchange = new FixedExchange($config->get('converter.currency'));
        $converter = new Converter(new ISOCurrencies(), $exchange);
        return $converter->convert($money, $currency);
    }

}