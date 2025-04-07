<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Config;
use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\Contracts\SessionInterface;
use App\DTO\Money\MoneyFactory;
use App\Entity\Receipt;
use App\Entity\Transaction;
use App\Enums\NavigationPage;
use App\RequestValidator\TransactionRequestValidator;
use App\RequestValidator\UploadTransactionCSVRequestValidator;
use App\Services\CategoryService;
use App\Services\RequestService;
use App\ResponseFormatter;
use App\Services\TransactionImportService;
use App\Services\TransactionService;
use League\Flysystem\Filesystem;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UploadedFileInterface;
use Ramsey\Uuid\Uuid;
use Slim\Views\Twig;
class TransactionController
{
    public function __construct(
        private readonly Config $config,
        private readonly Twig $twig,
        private readonly RequestService $requestService,
        private readonly TransactionService $transactionsService,
        private readonly ResponseFormatter $responseFormatter,
        private readonly CategoryService $categoryService,
        private readonly SessionInterface $session,
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        private readonly Filesystem $filesystem,
        private readonly TransactionImportService $transactionImportService,
        private readonly BaseEntityManagerServiceInterface $entityManagerService,
    ) {
    }

    public function index(Response $response)
    {
        // $str = '-₹650.00';
        // var_dump(NumberUtil::numRegex($str));
        // try {
        //     $moneySample = MoneyFactory::parse($str);
        //     $moneyPHP = MoneyFactory::convert($moneySample, new Currency('PHP'), $this->config);
        //     var_dump($moneyPHP);
        // } catch (Exception $e) {
        //     var_dump(MoneyFactory::make($str, 'PHP'));
        // }

        return $this->twig->render(
            $response,
            'home/transactions/index.twig',
            [
                'page' => NavigationPage::TRANSACTIONS->value,
                'categories' => $this->categoryService->fetchAllByUser($this->session->get('user'))
            ]
        );
    }

    public function load(Request $request, Response $response)
    {
        $params = $this->requestService->getDataTableQueryParameters($request);
        $transactions = $this->transactionsService->fetchTableData($params, $request->getAttribute('user'));

        $transformer = fn(Transaction $transaction) => [
            'id' => $transaction->getId(),
            'description' => $transaction->getDescription(),
            'amount' => MoneyFactory::format($transaction->getAmount()),
            'amount_inversed' => $transaction->getAmount()->isInversed(),
            'date' => $transaction->getDate()->format('m/d/Y g:i A'),
            'category' => $transaction->getCategory() !== null ? $transaction->getCategory()->getName() : '',
            'wasReviewed' => $transaction->wasReviewed(),
            'receipts' => $transaction->getReceipts()->map(function (Receipt $receipt) {
                return [
                    'name' => $receipt->getFilename(),
                    'id' => $receipt->getId(),
                ];
            })->toArray(),
        ];

        $totalTransactions = count($transactions);
        return $this->responseFormatter->asDataTable(
            $response,
            array_map($transformer, (array) $transactions->getIterator()),
            $params->draw,
            $totalTransactions
        );
    }

    public function store(Request $request, Response $response)
    {
        $data = $this->requestValidatorFactory->make(TransactionRequestValidator::class)->validate($request->getParsedBody());

        $transaction = $this->transactionsService->create(
            $request->getAttribute('user'),
            $data
        );

        $this->entityManagerService->sync($transaction);
        return $response;
    }

    public function get(Response $response, Transaction $transaction): Response
    {

        $data = [
            'id' => $transaction->getId(),
            'description' => $transaction->getDescription(),
            'category' => ($transaction->getCategory() !== null) ? $transaction->getCategory()->getId()->toString() : '',
            'date' => $transaction->getDate()->format('Y-m-d') . 'T' . $transaction->getDate()->format('H:i'),
            'amount' => $transaction->getAmount()->getValue(),
        ];

        return $this->responseFormatter->asJson($response, $data);
    }

    public function update(Request $request, Response $response, Transaction $transaction): Response
    {
        $data = $this->requestValidatorFactory->make(TransactionRequestValidator::class)->validate(
            $request->getParsedBody()
        );

        $transaction = $this->transactionsService->update($transaction, $data);
        $this->entityManagerService->sync($transaction);

        return $response;
    }

    public function delete(Response $response, Transaction $transaction): Response
    {
        // if (!empty($transaction->getReceipts())) {
        //     foreach ($transaction->getReceipts() as $receipt)
        //         $this->entityManagerService->delete($receipt, true);
        // }

        $this->entityManagerService->delete($transaction, true);
        return $response;
    }

    public function uploadCSV(Request $request, Response $response): Response
    {
        /**
         * @var UploadedFileInterface $file
         */
        $file = $this->requestValidatorFactory->make(UploadTransactionCSVRequestValidator::class)->validate(
            $request->getUploadedFiles()
        )['csv'];
        $this->transactionImportService->importFromFile($file, $request->getAttribute('user'));

        return $response;
    }

    public function toggleReviewed(Response $response, Transaction $transaction): Response
    {
        $this->transactionsService->toggleReviewed($transaction);
        $this->entityManagerService->sync();

        return $response;
    }
}