<?php

declare(strict_types=1);

namespace App\XM\Domain;

use App\XM\Domain\Dto\HistoricalDataRequestDto;
use App\XM\Domain\Interfaces\YhFinanceApiInterface;

class HistoricalDataService
{
    private YhFinanceApiInterface $yhFinanceApi;

    public function __construct(YhFinanceApiInterface $yhFinanceApi)
    {
        $this->yhFinanceApi = $yhFinanceApi;
    }

    public function fetchHistoricalData(HistoricalDataRequestDto $dto): array
    {
        return $this->yhFinanceApi->historicalData($dto->getCompanySymbol());
    }
}