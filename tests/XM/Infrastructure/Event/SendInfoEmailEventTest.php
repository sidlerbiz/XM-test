<?php

declare(strict_types=1);

namespace XM\Infrastructure\Event;

use App\XM\Domain\Dto\InfoEmailDto;
use App\XM\Infrastructure\Event\SendInfoEmailEvent;
use PHPUnit\Framework\TestCase;

class SendInfoEmailEventTest extends TestCase
{
    public function testGetDto(): void
    {
        $infoEmailDto = $this->createMock(InfoEmailDto::class);
        $event = new SendInfoEmailEvent($infoEmailDto);

        self::assertEquals($infoEmailDto, $event->getDto());
    }
}
