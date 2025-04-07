<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\SessionInterface;
use App\Enums\NavigationPage;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
class HomeController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly SessionInterface $session,
    ) {
    }

    public function index(Response $response): Response
    {
        // $money = new Money('1000', new Currency('EUR'));
        // $money2 = new Money('-5000', new Currency('PHP'));

        // $nf = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        // $format = new IntlMoneyFormatter($nf, new ISOCurrencies())->format($money);
        // $parse = new IntlMoneyParser($nf, new ISOCurrencies())->parse($format);

        // $format2 = new IntlMoneyFormatter($nf, new ISOCurrencies())->format($money2);
        // $parse2 = new IntlMoneyParser($nf, new ISOCurrencies())->parse($format2);

        // var_dump($format, $parse);
        // var_dump($format2, $parse2);

        // $money = new Money('1000000000.5656565', new Currency('PHP'));
        // var_dump($money);

        // $money = new MoneyWrapper('20000000');
        // var_dump($money->getFormattedString());

        return $this->twig->render(
            $response,
            'home/dashboard/dashboard.twig',
            [
                'page' => NavigationPage::INDEX->value
            ]
        );
    }

    public function test(Request $request, Response $response)
    {
        return $this->twig->render($response, 'auth/reset.password.twig');
    }
}