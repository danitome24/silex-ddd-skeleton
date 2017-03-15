<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 11/03/17
 * Time: 17:09
 */

namespace Slx\Domain\Event\Task;

use Slx\Domain\Entity\User\User;
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
     * @var User
     */
    private $userAssigned;
    /**
     * @var string
     */
    private $taskDescription;

    /**
     * TaskWasCreated constructor.
     * @param string $taskId
     * @param string $taskTitle
     * @param string $taskDescription
     * @param User $userAssigned
     */
    public function __construct(
        string $taskId,
        string $taskTitle,
        string $taskDescription,
        User $userAssigned
    )
    {
        $this->taskId = $taskId;
        $this->taskTitle = $taskTitle;
        $this->ocurredOn = new \DateTimeImmutable();
        $this->userAssigned = $userAssigned;
        $this->taskDescription = $taskDescription;
    }

    /**
     * @return User
     */
    public function userAssigned()
    {
        return $this->userAssigned;
    }

    /**
     * @return string
     */
    public function taskId(): string
    {
        return $this->taskId;
    }

    /**
     * @return string
     */
    public function taskTitle(): string
    {
        return $this->taskTitle;
    }

    /**
     * @return string
     */
    public function taskDescription(): string
    {
        return $this->taskDescription;
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