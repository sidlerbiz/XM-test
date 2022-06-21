<?php

declare(strict_types=1);

namespace XM\Infrastructure\YhFinanceApi;

use App\XM\Infrastructure\YhFinanceApi\YhFinanceApi;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class YhFinanceApiTest extends TestCase
{
    public function testHistoricalData(): void
    {
        $yhApiUrl = 'http://test.url';
        $symbol = 'GOOG';
        $httpMethod = 'GET';
        $historicalDataUrl = 'http://test.url/stock/v3/get-historical-data';
        $yhApiKey = 'someApiKey';
        $params = [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-rapidapi-key' => $yhApiKey
            ],
            'query' => [
                'symbol' => $symbol
            ]
        ];

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

        $response = $this->createMock(ResponseInterface::class);
        $response->expects($this->once())
            ->method('toArray')
            ->willReturn($expectedResult)
        ;

        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient->expects($this->once())
            ->method('request')
            ->with($httpMethod, $historicalDataUrl, $params)
            ->willReturn($response)
        ;

        $yhFinanceApi = new YhFinanceApi($yhApiUrl, $yhApiKey, $httpClient);

        self::assertEquals($expectedResult, $yhFinanceApi->historicalData($symbol));
    }
}
