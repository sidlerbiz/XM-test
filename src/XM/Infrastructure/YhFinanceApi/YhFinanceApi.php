<?php

declare(strict_types=1);

namespace App\XM\Infrastructure\YhFinanceApi;

use App\XM\Domain\Interfaces\YhFinanceApiInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class YhFinanceApi implements YhFinanceApiInterface
{
    private string $yhApiUrl;
    private string $yhApiKey;
    private HttpClientInterface $httpClient;

    public function __construct(
        string $yhApiUrl,
        string $yhApiKey,
        HttpClientInterface $httpClient
    )
    {
        $this->yhApiUrl = $yhApiUrl;
        $this->yhApiKey = $yhApiKey;
        $this->httpClient = $httpClient;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function historicalData(string $symbol): array
    {
        $historicalDataUri = '/stock/v3/get-historical-data';
        $headers = [
            'Content-Type' => 'application/json',
            'x-rapidapi-key' => $this->yhApiKey
        ];

        $query = ['symbol' => $symbol];

        $response = $this->httpClient->request(
                'GET',
                sprintf('%s%s', $this->yhApiUrl, $historicalDataUri),
                [
                    'headers' => $headers,
                    'query' => $query
                ]
        );

        return $response->toArray();
    }
}