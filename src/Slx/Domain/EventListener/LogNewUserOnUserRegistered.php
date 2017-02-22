<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 21/02/17
 * Time: 23:04
 */

namespace Slx\Domain\EventListener;

use Monolog\Logger;
use Slx\Domain\Event\DomainEvent;

class LogNewUserOnUserRegistered implements Listener
{
    /**
     * @var
     */
    private $monolog;

    /**
     * LogNewUserOnUserRegistered constructor.
     * @param $monolog
     */
    public function __construct($monolog)
    {
        $this->monolog = $monolog;
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
        $this->monolog->info('New user was registered: ' . $domainEvent->userEmail()->email());
    }
}