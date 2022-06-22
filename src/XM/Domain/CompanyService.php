<?php

declare(strict_types=1);

namespace App\XM\Domain;

use App\XM\Domain\Entity\Company;
use App\XM\Domain\Interfaces\CompanyRepositoryInterface;

class CompanyService
{
    private CompanyRepositoryInterface $companyRepository;
    private string $yhCompanySourceUrl;

    public function __construct(
        string $yhCompanySourceUrl,
        CompanyRepositoryInterface $companyRepository
    )
    {
        $this->companyRepository = $companyRepository;
        $this->yhCompanySourceUrl = $yhCompanySourceUrl;
    }

    public function storeCompaniesToDb(): void
    {
        $companies = $this->fetchCompaniesFromUrl();
        foreach ($companies as $company) {
            $this->companyRepository->add(
                $this->createCompanyFromRawData($company)
            );
        }

        $this->companyRepository->flush();
    }

    public function getSymbols(): array
    {
        return $this->companyRepository->getSymbols();
    }

    public function findBySymbol(string $symbol): ?Company
    {
        return $this->companyRepository->findBySymbol($symbol);
    }

    private function fetchCompaniesFromUrl(): array
    {
        return json_decode(
            file_get_contents(
                $this->yhCompanySourceUrl,
                false,
                stream_context_create([
                    'ssl'  => [
                        'verify_peer'      => false,
                        'verify_peer_name' => false,
                    ]
                ])
            ),
            true
        );
    }

    private function createCompanyFromRawData(array $rawData): Company
    {
        return (new Company())
            ->setName($rawData['Company Name'])
            ->setFinancialStatus($rawData['Financial Status'])
            ->setMarketCategory($rawData['Market Category'])
            ->setRoundLotSize($rawData['Round Lot Size'])
            ->setSecurityName($rawData['Security Name'])
            ->setSymbol($rawData['Symbol'])
            ->setTestIssue($rawData['Test Issue'])
        ;
    }
}