<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 10/02/17
 * Time: 19:28
 */

namespace Slx\Domain\Entity\User;

use Slx\Domain\ValueObject\Email\Email;
use Slx\Domain\ValueObject\Password\Password;

class User
{
    /**
     * @var UserId $uid
     */
    private $uid;

    /**
     * @var string
     */
    private $username;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \DateTime
     */
    protected $createdOn;
    /**
     * @var \DateTime
     */
    protected $updatedOn;


    /**
     * User constructor.
     *
     * @param UserId $userId
     * @param string $userName
     * @param string $email
     * @param string $passwd
     */
    public function __construct(UserId $userId, string $userName, string $email, string $passwd)
    {
        $this->uid = $userId;
        $this->username = $userName;
        $this->email = Email::fromString($email);
        $this->password = Password::fromString($passwd);
        $this->createdOn = new \DateTime();
        $this->updatedOn = new \DateTime();
    }

    public function id(): UserId
    {
        $this->uid;
    }
}
