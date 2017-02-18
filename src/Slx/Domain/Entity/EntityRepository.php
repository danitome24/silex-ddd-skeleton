<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 0:35
 */

namespace Slx\Domain\Entity;

interface EntityRepository
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function fetchById($id);

    /**
     * @param array $options
     *
     * @return mixed
     */
    public function fetchBy(array $options);

    /**
     * @param $entity
     *
     * @return mixed
     */
    public function save($entity);
}
