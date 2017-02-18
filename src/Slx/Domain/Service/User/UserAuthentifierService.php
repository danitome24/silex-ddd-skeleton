<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 13:36
 */

namespace Slx\Domain\Service\User;

use Slx\Domain\Entity\User\User;

interface UserAuthentifierService
{
    /**
     * Authenticate an user and store session.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function authenticate(User $user);

    /**
     * Remove session
     *
     * @return mixed
     */
    public function removeSession();
}
