<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 15/02/17
 * Time: 17:08
 */

namespace Slx\Domain\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     *
     * @return mixed
     */
    public function add(User $user);

    /**
     * @param $email
     *
     * @return mixed
     */
    public function fetchByEmail($email);
}
