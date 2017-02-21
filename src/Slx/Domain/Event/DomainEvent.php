<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 19:00
 */

namespace Slx\Domain\Event;

interface DomainEvent
{
    /**
     * When occurred the event
     *
     * @return mixed
     */
    public function occurredOn();

    /**
     * name event to listen
     *
     * @return mixed
     */
    public function eventName();
}
