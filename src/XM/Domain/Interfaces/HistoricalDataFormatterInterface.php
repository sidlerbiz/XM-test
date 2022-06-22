<?php

declare(strict_types=1);

namespace App\XM\Domain\Interfaces;

use App\XM\Domain\Dto\HistoricalDataRequestDto;

interface HistoricalDataFormatterInterface
{
    public function format(array $historicalData, HistoricalDataRequestDto $dto): array;
}