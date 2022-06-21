<?php

declare(strict_types=1);

namespace XM\Domain;

use App\XM\Domain\Dto\HistoricalDataRequestDto;
use App\XM\Domain\HistoricalDataService;
use App\XM\Domain\Interfaces\YhFinanceApiInterface;
use PHPUnit\Framework\TestCase;

class HistoricalDataServiceTest extends TestCase
{
    public function testFetchHistoricalData(): void
    {
        $expectedResult = [
            "prices" => [
                 [
                     "date" => 1655826861,
                     "open" => 2194.0400390625,
                     "high" => 2253.4599609375,
                     "low" => 2185.8701171875,
                     "close" => 2243.2700195312,
                     "volume" => 959832,
                     "adjclose" => 2243.27001953125
                 ]
            ],
            "isPending" => false,
            "firstTradeDate" => 1092922200,
            "id" => "",
            "timeZone" => [
                "gmtOffset" => -14400
             ] ,
            "eventsData" => []
        ];

        $historicalDataRequestDto = new HistoricalDataRequestDto(
            'GOOG',
            'test@mail.vh',
            1655826861,
            1655472600
        );

        $yhFinanceApi = $this->createMock(YhFinanceApiInterface::class);
        $yhFinanceApi->expects($this->once())
            ->method('historicalData')
            ->with($historicalDataRequestDto->getCompanySymbol())
            ->willReturn($expectedResult)
       ;


        $historicalDataService = new HistoricalDataService($yhFinanceApi);

        self::assertEquals($expectedResult, $historicalDataService->fetchHistoricalData($historicalDataRequestDto));
    }
}
