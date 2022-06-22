<?php

declare(strict_types=1);

namespace App\XM\Presentation\Http\Formatter;

use App\XM\Domain\Dto\HistoricalDataRequestDto;
use App\XM\Domain\Interfaces\HistoricalDataFormatterInterface;

class HistoricalDataFormatter implements HistoricalDataFormatterInterface
{
    public function format(array $historicalData, HistoricalDataRequestDto $dto): array
    {
        $formattedData = [];
        foreach ($historicalData as $item) {
            if ($item['date'] >= $dto->getStartDate() && $item['date'] <= $dto->getEndDate()) {
               $item['date'] =  date('Y-m-d', $item['date']);
               $formattedData[] = $item;
            }
        }

        return $formattedData;
    }
}