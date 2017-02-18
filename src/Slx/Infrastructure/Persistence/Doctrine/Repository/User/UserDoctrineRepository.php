<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 17/02/17
 * Time: 20:05
 */

namespace Slx\Infrastructure\Persistence\Doctrine\Repository\User;

use Doctrine\ORM\EntityRepository;
use Slx\Domain\Entity\User\User;
use Slx\Domain\Entity\User\UserRepositoryInterface;
use Slx\Infrastructure\Persistence\Doctrine\Repository\AbstractEntityRepository;

class UserDoctrineRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     * @return mixed|void
     */
    public function add(User $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * @param $email
     *
     * @return array
     */
    public function fetchByEmail($email)
    {
        return parent::findOneBy(['email.email' => $email]);
    }
}
