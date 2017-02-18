<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 0:29
 */

namespace Slx\Application\Command\User;

class SignUpUserCommand
{
    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * SignUpUserCommand constructor.
     *
     * @param string $email
     * @param $password
     */
    public function __construct(string $userName, string $email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function userName()
    {
        return $this->userName;
    }

}
