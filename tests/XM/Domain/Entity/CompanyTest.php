<?php

declare(strict_types=1);

namespace XM\Domain\Entity;

use App\XM\Domain\Entity\Company;
use Error;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    public function throwErrorDataProvider(): array
    {
        return [
            'getIdThrowError' => [
                'action' => 'getId'
            ],
            'getNameThrowError' => [
                'action' => 'getName'
            ],
            'getSymbolThrowError' => [
                'action' => 'getSymbol'
            ],
            'getFinancialStatusThrowError' => [
                'action' => 'getFinancialStatus'
            ],
            'getMarketCategoryThrowError' => [
                'action' => 'getMarketCategory'
            ],
            'getRoundLotSizeThrowError' => [
                'action' => 'getRoundLotSize'
            ],
            'getSecurityNameThrowError' => [
                'action' => 'getSecurityName'
            ],
            'getTestIssueThrowError' => [
                'action' => 'getTestIssueThrowError'
            ]
        ];
    }

    /**
     * @dataProvider throwErrorDataProvider
     */
    public function testThrowError(string $action): void
    {
        $this->expectException(Error::class);

        (new Company())->$action();
    }

    public function testCompanyObject(): void
    {
        $companyName = 'someCompanyName';
        $symbol = 'GOOG';
        $financialStatus = 'N';
        $marketCategory = 'G';
        $roundLotSize = 100;
        $securityName = 'Name';
        $testIssue = 'N';

        $company = new Company();

        $company->setName(null);
        self::assertNull($company->getName());

        $company->setName($companyName);
        self::assertEquals($companyName, $company->getName());

        $company->setSymbol(null);
        self::assertNull($company->getSymbol());

        $company->setSymbol($symbol);
        self::assertEquals($symbol, $company->getSymbol());

        $company->setFinancialStatus(null);
        self::assertNull($company->getFinancialStatus());

        $company->setFinancialStatus($financialStatus);
        self::assertEquals($financialStatus, $company->getFinancialStatus());

        $company->setMarketCategory(null);
        self::assertNull($company->getMarketCategory());

        $company->setMarketCategory($marketCategory);
        self::assertEquals($marketCategory, $company->getMarketCategory());

        $company->setRoundLotSize(null);
        self::assertNull($company->getRoundLotSize());

        $company->setRoundLotSize($roundLotSize);
        self::assertEquals($roundLotSize, $company->getRoundLotSize());

        $company->setSecurityName(null);
        self::assertNull($company->getSecurityName());

        $company->setSecurityName($securityName);
        self::assertEquals($securityName, $company->getSecurityName());

        $company->setTestIssue(null);
        self::assertNull($company->getTestIssue());

        $company->setTestIssue($testIssue);
        self::assertEquals($testIssue, $company->getTestIssue());
    }
}
