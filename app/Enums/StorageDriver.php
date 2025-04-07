<?php
declare(strict_types=1);

namespace App\Enums;
enum StorageDriver
{
    case LOCAL;
    case REMOTE_DO;
    case S3;
}