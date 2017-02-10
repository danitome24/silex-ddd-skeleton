<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 11/02/17
 * Time: 0:00
 */

namespace Domain\Service\User;

use Domain\ValueObject\Password\Password;

interface PasswordHashingService
{
    /**
     * @param Password $password
     *
     * @return mixed
     */
    public function hash(Password $password);
}
