<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 0:37
 */

namespace Slx\Infrastructure\Persistence\Doctrine\Repository;

use Slx\Domain\Entity\EntityRepository;

class AbstractEntityRepository extends \Doctrine\ORM\EntityRepository implements EntityRepository
{

    /**
     * @param $id
     *
     * @return mixed
     */
    public function fetchById($id)
    {
        return parent::find($id);
    }

    /**
     * @param $entity
     *
     * @return mixed
     */
    public function save($entity)
    {
       $this->getEntityManager()->persist($entity);
       $this->getEntityManager()->flush($entity);
    }

    /**
     * @param array $options
     *
     * @return mixed
     */
    public function fetchBy(array $options)
    {
        return parent::findBy($options);
    }
}