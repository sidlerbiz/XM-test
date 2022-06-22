<?php

declare(strict_types=1);

namespace App\XM\Domain\Interfaces;

interface RequestDtoInterface
{
    public function getSymbol(): string;
}