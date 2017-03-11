<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 19:01
 */

namespace Slx\Domain\Event\User;

use Slx\Domain\ValueObject\User\UserId;
use Slx\Domain\Event\DomainEvent;
use Slx\Domain\ValueObject\Email\Email;

class UserRegistered implements DomainEvent
{
    const EVENT_NAME = 'UserRegistered';
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var Email
     */
    private $userEmail;

    /**
     * @var string
     */
    private $username;

    /**
     * @var \DateTimeImmutable
     */
    private $occurredOn;

    /**
     * UserRegistered constructor.
     *
     * @param UserId $userId
     * @param Email $email
     * @param string $username
     */
    public function __construct(UserId $userId, Email $email, string $username)
    {
        $this->occurredOn = new \DateTimeImmutable();
        $this->userId = $userId;
        $this->userEmail = $email;
        $this->username = $username;
    }

    /**
     * @return Email
     */
    public function userEmail(): Email
    {
        return $this->userEmail;
    }

    /**
     * Username
     *
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * When occurred the event
     *
     * @return mixed
     */
    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }

    /**
     * @return string
     */
    public function eventName(): string
    {
        return self::EVENT_NAME;
    }
}