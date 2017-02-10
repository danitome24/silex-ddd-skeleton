<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 10/02/17
 * Time: 19:58
 */

namespace Domain\ValueObject\Password;


class Password
{
    /**
     * @var
     */
    private $password;

    /**
     * Password constructor.
     *
     * @param string $pwd
     */
    private function __construct(string $pwd)
    {

        $this->password = $pwd;
    }

    /**
     * @param string $pwd
     *
     * @return Password
     */
    public static function fromString(string $pwd): self
    {
        return new self($pwd);
    }
}
