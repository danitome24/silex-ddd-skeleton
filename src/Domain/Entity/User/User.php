<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 10/02/17
 * Time: 19:28
 */

namespace Domain\Entity\User;

use Domain\ValueObject\Email\Email;

class User
{
    /**
     * @var UserId $uid
     */
    private $uid;

    /**
     * @var string
     */
    private $userName;

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
        $this->userName = $userName;
        $this->email = Email::fromString($email);
        $this->password = $passwd;
        $this->createdOn = new \DateTime();
        $this->updatedOn = new \DateTime();
    }

    public function id(): UserId
    {
        $this->uid;
    }
}
