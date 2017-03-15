<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 15/03/17
 * Time: 12:56
 */

namespace Slx\Domain\EventListener;

use Slx\Application\EmailTemplate\User\TaskCreatedUserEmail;
use Slx\Domain\Event\DomainEvent;
use Slx\Domain\Event\Task\TaskWasCreated;
use Slx\Infrastructure\Service\Mail\Mailer;

class SendNoticeEmailOnTaskCreated implements Listener
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * SendWelcomeEmailOnUserRegistered constructor.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Deal with domain event
     *
     * @param DomainEvent $domainEvent
     *
     * @return mixed
     */
    public function handle(DomainEvent $domainEvent)
    {
        $this->mailer->send(
            new TaskCreatedUserEmail(
                $domainEvent->taskTitle(),
                $domainEvent->taskDescription(),
                $domainEvent->userAssigned()
            )
        );
    }
}