<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 10/02/17
 * Time: 19:29
 */

namespace Domain\Entity\User;

use Ramsey\Uuid\Uuid;

class UserId
{
    /**
     * @var string
     */
    private $id;

    /**
     * UserId constructor.
     */
    private function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    /**
     * Generate user id
     *
     * @return UserId
     */
    public static function generateUserId(): UserId
    {
        return new self();
    }
}
