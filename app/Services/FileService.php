<?php
declare(strict_types=1);

namespace App\Services;

use League\Flysystem\Filesystem;
use Psr\Http\Message\UploadedFileInterface;
class FileService
{
    public function __construct(private readonly Filesystem $filesystem)
    {
    }

    public function write(string $directory, string $filename, UploadedFileInterface $file): void
    {
        $this->filesystem->write("$directory$filename", $file->getStream()->getContents());
    }

    public function read(string $directory, string $filename): mixed
    {
        return $this->filesystem->readStream("$directory$filename");
    }
}