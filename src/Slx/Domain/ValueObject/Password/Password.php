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
     * @throws PasswordIsNotValidException
     */
    private function __construct(string $pwd)
    {
        $this->checkIfPasswordIsValid($pwd);
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

    /**
     * Get password.
     *
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * Check if password is valid
     *
     * @param $pwd
     * @throws PasswordIsNotValidException
     */
    private function checkIfPasswordIsValid($pwd)
    {
        if (strlen($pwd) < self::MIN_LENGTH) {
            throw new PasswordIsNotValidException('Password must be at least of 8 characters');
        }

        if (!(preg_match('/^[0-9a-zA-Z]+$/', $pwd))) {
            throw new PasswordIsNotValidException('Password must contain at least one number');
        }
    }
}
