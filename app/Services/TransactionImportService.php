<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\UserInterface;
use App\Entity\Transaction;
use App\Services\CategoryService;
use App\Services\TransactionService;
use App\Utils\NumberUtil;
use Clockwork\Clockwork;
use League\Csv\Reader;
use Psr\Http\Message\UploadedFileInterface;
class TransactionImportService
{
    public function __construct(
        private readonly CategoryService $categoryService,
        private readonly TransactionService $transactionService,
        private readonly Clockwork $clockwork,
        private readonly BaseEntityManagerServiceInterface $entityManagerService,
    ) {
    }

    public function importFromFile(UploadedFileInterface $file, UserInterface $user): void
    {
        $reader = Reader::createFromString($file->getStream()->getContents());
        $reader->setHeaderOffset(0);
        $transactionRecords = $reader->getRecords();

        $categories = $this->categoryService->fetchAllKeyedByName($user);

        $count = 1;
        $batchSize = 250;
        foreach ($transactionRecords as $record) {
            $category = $categories[strtoLower($record['Category'])] ??
                $this->categoryService->create($record['Category'], $user);

            $this->transactionService->create($user, [
                'date' => $record['Date'],
                'description' => $record['Description'],
                'category' => $category->getId()->toString(),
                'amount' => NumberUtil::numRegex($record['Amount']),
            ]);

            if ($count % $batchSize === 0) {
                $this->entityManagerService->sync();
                $this->entityManagerService->clear(Transaction::class);

                $count = 1;
            } else
                $count++;
        }

        if ($count > 1) {
            $this->entityManagerService->sync();
            $this->entityManagerService->clear();
        }
    }
}