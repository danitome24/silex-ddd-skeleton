<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 17/02/17
 * Time: 20:05
 */

namespace Slx\Infrastructure\Persistence\Doctrine\Repository\User;

use Slx\Domain\Entity\User\UserRepositoryInterface;

class UserDoctrineRepository extends \Doctrine\ORM\EntityRepository implements UserRepositoryInterface
{
}
