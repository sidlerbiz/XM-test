<?php

declare(strict_types=1);

namespace App\XM\Infrastructure\Helpers;

class ArrayHelper
{
    public static function isArrayEmpty(array $array): bool
    {
        foreach ($array as $key => $val) {
            if ($val !== '' || $val !== null) {
                return false;
            }
        }
        return true;
    }
}