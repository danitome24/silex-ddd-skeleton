<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 20:48
 */

namespace Slx\Domain\Event;


use Slx\Domain\EventListener\Listener;

class DomainEventDispatcher
{
    /**
     * @var array
     */
    private $listeners;

    /**
     * @var static
     */
    private static $selfInstance;

    /**
     * DomainEventDispatcher constructor.
     */
    private function __construct()
    {
        $this->listeners = [];
    }

    /**
     * @return DomainEventDispatcher|static
     */
    public static function instance()
    {
        if (null === static::$selfInstance) {
            static::$selfInstance = new self();
        }

        return static::$selfInstance;
    }

    public function addListener(string $domainEventName, Listener $listener)
    {
        $this->listeners[$domainEventName][] = $listener;
    }

    public function dispatch(DomainEvent $event)
    {
        foreach ($this->listeners[$event->eventName()] as $listener) {
            $listener->handle($event);
        }
    }
}