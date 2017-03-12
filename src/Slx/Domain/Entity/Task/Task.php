<?php

namespace Slx\Domain\Entity\Task;

use DateTime;
use Slx\Domain\Entity\Task\Exception\TaskStatusDoesNotExistsException;
use Slx\Domain\Entity\User\User;
use Slx\Domain\Event\DomainEventDispatcher;
use Slx\Domain\Event\Task\TaskWasCreated;
use Slx\Domain\ValueObject\Task\TaskId;

class Task
{
    const OPEN = 'open';
    const CLOSED = 'closed';

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var User $userAssigned
     */
    private $userAssigned;

    /**
     * @var string $status
     */
    private $status;

    /**
     * @var string
     */
    private $description;

    /**
     * @var datetime
     */
    private $createdOn;

    /**
     * @var datetime
     */
    private $updatedOn;

    /**
     * Task constructor.
     *
     * @param string $title
     * @param User $user
     * @param string $status
     * @param string $description
     */
    private function __construct(string $title, User $user, string $status, string $description)
    {
        $this->id = TaskId::generate();
        $this->title = $title;
        $this->userAssigned = $user;
        $this->setStatus($status);
        $this->description = $description;
        $this->createdOn = new \DateTimeImmutable();
        $this->updatedOn = new \DateTimeImmutable();
//        DomainEventDispatcher::instance()->dispatch(
//            new TaskWasCreated(
//                $this->id,
//                $this->title()
//            )
//        );
    }

    /**
     * Build new Task instance
     *
     * @param string $title
     * @param User $user
     * @param string $status
     * @param string $description
     * @return Task
     */
    public static function build(string $title, User $user, string $status, string $description)
    {
        return new self($title, $user, $status, $description);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return User
     */
    public function userAssigned(): User
    {
        return $this->userAssigned;
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function createdOn(): \DateTimeImmutable
    {
        return $this->createdOn;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function updatedOn(): \DateTimeImmutable
    {
        return $this->updatedOn;
    }

    /**
     * @param string $status
     * @throws TaskStatusDoesNotExistsException
     */
    public function setStatus(string $status)
    {
        if ($status !== self::OPEN && $status !== self::CLOSED) {
            throw new TaskStatusDoesNotExistsException();
        }

        $this->status = $status;
    }
}
