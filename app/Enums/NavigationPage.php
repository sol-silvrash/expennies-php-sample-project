<?php
declare(strict_types=1);

namespace App\Enums;
enum NavigationPage: string
{
    case INDEX = "OVERVIEW";
    case TRANSACTIONS = "TRANSACTION";
    case CATEGORIES = "CATEGORY";
}