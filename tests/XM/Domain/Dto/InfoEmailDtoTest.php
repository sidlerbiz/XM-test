<?php

declare(strict_types=1);

namespace XM\Domain\Dto;

use App\XM\Domain\Dto\InfoEmailDto;
use Error;
use PHPUnit\Framework\TestCase;

class InfoEmailDtoTest extends TestCase
{
    public function throwErrorDataProvider(): array
    {
        return [
            'getEmailThrowError' => [
                'action' => 'getEmail'
            ],
            'getCompanyNameThrowError' => [
                'action' => 'getCompanyName'
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

        $dto = new InfoEmailDto();

        $dto->$action();
    }

    public function testValidGetters(): void
    {
        $email = 'some@mail.vh';
        $companyName = 'ComPanyName';
        $startDate = '2022-04-01';
        $endDate = '2022-06-20';

        $dto = new InfoEmailDto($email, $companyName, $startDate, $endDate);

        self::assertEquals($email, $dto->getEmail());
        self::assertEquals($companyName, $dto->getCompanyName());
        self::assertEquals($startDate, $dto->getStartDate());
        self::assertEquals($endDate, $dto->getEndDate());
    }
}
