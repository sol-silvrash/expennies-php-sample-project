<?php
declare(strict_types=1);

namespace App\Utils;
class NumberUtil
{
    public static function numRegex(string $numStr): string
    {
        return preg_replace('/[^0-9 .-]/', '', $numStr);
    }
}