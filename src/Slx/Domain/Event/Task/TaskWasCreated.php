<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 11/03/17
 * Time: 17:09
 */

namespace Slx\Domain\Event\Task;

use Slx\Domain\Event\DomainEvent;

class TaskWasCreated implements DomainEvent
{
    const EVENT_NAME = 'TaskWasCreated';

    /**
     * @var string $taskId
     */
    private $taskId;

    /**
     * @var string $taskTitle
     */
    private $taskTitle;

    /**
     * @var \DateTimeImmutable $ocurredOn
     */
    private $ocurredOn;

    /**
     * TaskWasCreated constructor.
     * @param string $taskId
     * @param string $taskTitle
     */
    public function __construct(string $taskId, string $taskTitle)
    {
        $this->taskId = $taskId;
        $this->taskTitle = $taskTitle;
        $this->ocurredOn = new \DateTimeImmutable();
    }

    /**
     * When occurred the event
     *
     * @return mixed
     */
    public function occurredOn(): \DateTimeImmutable
    {
        return $this->ocurredOn;
    }

    /**
     * name event to listen
     *
     * @return mixed
     */
    public function eventName(): string
    {
        return self::EVENT_NAME;
    }
}