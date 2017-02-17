<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 10/02/17
 * Time: 19:58
 */

namespace Slx\Domain\ValueObject\Password;


class Password
{
    const MAX_LENGTH = 20;
    const MIN_LENGTH = 8;

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
