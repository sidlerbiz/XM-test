<?php

declare(strict_types=1);

namespace App\XM\Domain\Interfaces;

interface YhFinanceApiInterface
{
    public function historicalData(string $symbol): array;
}