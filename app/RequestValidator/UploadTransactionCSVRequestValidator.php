<?php
declare(strict_types=1);

namespace App\RequestValidator;

use App\Contracts\RequestValidatorInterface;
use App\Exception\ValidationException;
use League\MimeTypeDetection\FinfoMimeTypeDetector;
use Psr\Http\Message\UploadedFileInterface;
class UploadTransactionCSVRequestValidator implements RequestValidatorInterface
{
    public function validate(array $data): array
    {
        /**
         * @var UploadedFileInterface $uploadedFile
         */
        $uploadedFile = $data['csv'] ?? null;

        if (!$uploadedFile)
            throw new ValidationException(['csv' => ['Please select a (.csv) file']]);

        if ($uploadedFile->getError() !== UPLOAD_ERR_OK)
            throw new ValidationException(['csv' => ['Failed to upload (.csv) file']]);

        $maxFilesize = 5 * 1024 * 1024;
        if ($uploadedFile->getSize() > $maxFilesize)
            throw new ValidationException(['csv' => ['Maximum allowed size is 5mb']]);

        $filename = $uploadedFile->getClientFilename();
        if (!preg_match('/^[a-zA-Z0-9\s._-]+$/', $filename))
            throw new ValidationException(['csv' => ['Invalid filename']]);

        $allowedMimeTypes = [
            'text/csv'
        ];
        $tmpFilepath = $uploadedFile->getStream()->getMetadata('uri');
        if (!in_array($uploadedFile->getClientMediaType(), $allowedMimeTypes))
            throw new ValidationException(['csv' => ['Please select a (.csv) file']]);

        $detector = new FinfoMimeTypeDetector();
        $mimeType = $detector->detectMimeTypeFromFile($tmpFilepath);

        if (!in_array($mimeType, $allowedMimeTypes))
            throw new ValidationException(['csv' => ['Invalid file type']]);

        return $data;
    }
}