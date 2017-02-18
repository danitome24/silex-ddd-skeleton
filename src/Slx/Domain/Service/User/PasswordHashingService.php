<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 11/02/17
 * Time: 0:00
 */

namespace Slx\Domain\Service\User;

use Slx\Domain\ValueObject\Password\Password;

interface PasswordHashingService
{
    /**
     * @param string $password
     *
     * @return mixed
     */
    public function hash(string $password);

    /**
     * @param Password $userPassword
     * @param string $passwordToVerify
     *
     * @return mixed
     */
    public function verifyPassword(Password $userPassword, string $passwordToVerify);
}
