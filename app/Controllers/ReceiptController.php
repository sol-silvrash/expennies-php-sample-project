<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\Entity\Receipt;
use App\Entity\Transaction;
use App\RequestValidator\UploadReceiptRequestValidator;
use App\Services\FileService;
use App\Services\ReceiptService;
use App\Services\TransactionService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use League\Flysystem\Filesystem;
use Psr\Http\Message\UploadedFileInterface;
use Ramsey\Uuid\Uuid;
use Slim\Psr7\Stream;
class ReceiptController
{
    public function __construct(
        private readonly Filesystem $filesystem,
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        private readonly ReceiptService $receiptService,
        private readonly TransactionService $transactionService,
        private readonly FileService $fileService,
        private readonly BaseEntityManagerServiceInterface $entityManagerService
    ) {
    }

    public function store(Request $request, Response $response, Transaction $transaction): Response
    {
        /**
         * @var UploadedFileInterface $file
         */
        $file = $this->requestValidatorFactory->make(UploadReceiptRequestValidator::class)
            ->validate(
                $request->getUploadedFiles()
            )['receipt'];
        $filename = $file->getClientFilename();

        $user_id = $request->getAttribute('user')->getId()->toString();

        $randomFilename = bin2hex(random_bytes(25));

        $this->fileService->write("receipts/$user_id/", $randomFilename, $file);

        $receipt = $this->receiptService->create(
            $transaction,
            $filename,
            $randomFilename,
            $file->getClientMediaType()
        );

        $this->entityManagerService->sync($receipt);

        return $response;
    }

    public function download(Request $request, Response $response, Transaction $transaction, Receipt $receipt): Response
    {
        $user = $request->getAttribute('user');
        if (!$receipt->getTransaction()->getId()->equals($transaction->getId()))
            return $response->withStatus(401);

        $file = $this->fileService->read("receipts/" . $user->getId() . "/", $receipt->getStorageFilename());

        $response = $response
            ->withHeader(
                'Content-Disposition',
                'inline; filename="' . $receipt->getFilename() . '"',
            )
            ->withHeader(
                'Content-Type',
                $receipt->getMediaType(),
            );

        return $response->withBody(new Stream($file));
    }

    public function delete(Request $request, Response $response, Transaction $transaction, Receipt $receipt): Response
    {
        $user = $request->getAttribute('user');
        if (!$receipt->getTransaction()->getId()->equals($transaction->getId()))
            return $response->withStatus(401);

        $this->filesystem->delete("receipts/" . $user->getId() . "/" . $receipt->getStorageFilename());

        $this->entityManagerService->delete($receipt, true);

        return $response;
    }
}