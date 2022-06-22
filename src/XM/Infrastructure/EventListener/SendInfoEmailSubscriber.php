<?php

declare(strict_types=1);

namespace App\XM\Infrastructure\EventListener;

use App\XM\Infrastructure\Event\SendInfoEmailEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SendInfoEmailSubscriber implements EventSubscriberInterface
{
    private MailerInterface $mailer;
    private string $from;

    public function __construct(
        MailerInterface $mailer,
        string $from
    )
    {
        $this->mailer = $mailer;
        $this->from = $from;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            SendInfoEmailEvent::NAME => 'onSendInfoEmail'
        ];
    }

    public function onSendInfoEmail(SendInfoEmailEvent $event): void
    {
       $dto = $event->getDto();
        $email = (new Email())
            ->to($dto->getEmail())
            ->from($this->from)
            ->subject($dto->getCompanyName())
            ->text(
                sprintf('From %s to %s', $dto->getStartDate(), $dto->getEndDate())
            )
        ;

        $this->mailer->send($email);
    }
}