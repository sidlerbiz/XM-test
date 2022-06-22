<?php

declare(strict_types=1);

namespace App\XM\Domain\Dto;

class InfoEmailDto
{
    private string $email;
    private string $companyName;
    private string $startDate;
    private string $endDate;

    public function __construct(string $email, string $companyName, string $startDate, string $endDate)
    {
        $this->email = $email;
        $this->companyName = $companyName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }
}