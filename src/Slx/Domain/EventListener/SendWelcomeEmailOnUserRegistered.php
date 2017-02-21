<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 19:37
 */

namespace Slx\Domain\EventListener;

use Slx\Domain\Event\DomainEvent;

class SendWelcomeEmailOnUserRegistered implements Listener
{

    /**
     * Deal with domain event
     *
     * @param DomainEvent $domainEvent
     *
     * @return mixed
     */
    public function handle(DomainEvent $domainEvent)
    {
        dump('mail to....', $domainEvent);
    }
}
