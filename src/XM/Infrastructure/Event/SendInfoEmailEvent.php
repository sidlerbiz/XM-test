<?php

declare(strict_types=1);

namespace App\XM\Infrastructure\Event;

use App\XM\Domain\Dto\InfoEmailDto;
use Symfony\Contracts\EventDispatcher\Event;

class SendInfoEmailEvent extends Event
{
    public const NAME = 'info.email';

    private InfoEmailDto $dto;

    public function __construct(InfoEmailDto $dto)
    {
        $this->dto = $dto;
    }

    public function getDto(): InfoEmailDto
    {
        return $this->dto;
    }
}