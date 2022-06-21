<?php

declare(strict_types=1);

namespace XM\Domain\Dto;

use App\XM\Domain\Dto\HistoricalDataRequestDto;
use Error;
use PHPUnit\Framework\TestCase;

class HistoricalDataRequestDtoTest extends TestCase
{
    public function throwErrorDataProvider(): array
    {
        return [
            'getCompanySymbolThrowError' => [
                'action' => 'getCompanySymbol'
            ],
            'getEmailThrowError' => [
                'action' => 'getEmail'
            ],
            'getStartDateThrowError' => [
                'action' => 'getStartDate'
            ],
            'getEndDateThrowError' => [
                'action' => 'getEndDate'
            ]
        ];
    }

    /**
     * @dataProvider throwErrorDataProvider
     */
    public function testThrowError(string $action): void
    {
        $this->expectException(Error::class);

        $dto = new HistoricalDataRequestDto();

        $dto->$action();
    }

    public function testValidGetters(): void
    {
        $companySymbol = "GOOG";
        $email = "test@mail.vh";
        $startDate = 1655826861;
        $endDate = 1655472600;

        $nullStartEndDateDto = new HistoricalDataRequestDto($companySymbol, $email, null, null);

        self::assertNull($nullStartEndDateDto->getStartDate());
        self::assertNull($nullStartEndDateDto->getEndDate());

        $dto = new HistoricalDataRequestDto($companySymbol, $email, $startDate, $endDate);

        self::assertEquals($companySymbol, $dto->getCompanySymbol());
        self::assertEquals($email, $dto->getEmail());
        self::assertEquals($startDate, $dto->getStartDate());
        self::assertEquals($endDate, $dto->getEndDate());
    }
}
