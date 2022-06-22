<?php

declare(strict_types=1);

namespace App\XM\Domain\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class HistoricalDataRequestDto
{
    /**
     * @Assert\NotBlank()
     */
    private string $companySymbol;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private string $email;

    /**
     * @Assert\NotBlank()
     * @Assert\LessThan(
     *     propertyPath="endDate",
     *     message="startDate cannot be greater than endDate"
     * )
     */
    private ?int $startDate;

    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan(
     *     propertyPath="startDate",
     *     message="endDate cannot be less than startDate"
     * )
     */
    private ?int $endDate;

    public function __construct(string $companySymbol, string $email, ?int $startDate, ?int $endDate)
    {
        $this->companySymbol = $companySymbol;
        $this->email = $email;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getCompanySymbol(): string
    {
        return $this->companySymbol;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStartDate(): ?int
    {
        return $this->startDate;
    }

    public function getEndDate(): ?int
    {
        return $this->endDate;
    }
}