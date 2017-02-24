<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 19:37
 */

namespace Slx\Domain\EventListener;

use Slx\Application\EmailTemplate\User\RegisterUserEmail;
use Slx\Domain\Event\DomainEvent;
use Slx\Infrastructure\Service\Mail\Mailer;

class SendWelcomeEmailOnUserRegistered implements Listener
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
            new RegisterUserEmail(
                $domainEvent->userEmail()->email(),
                $domainEvent->username()
            )
        );
    }
}
