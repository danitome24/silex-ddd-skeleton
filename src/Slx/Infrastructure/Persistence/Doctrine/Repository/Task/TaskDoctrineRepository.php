<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 11/03/17
 * Time: 23:22
 */

namespace Slx\Infrastructure\Persistence\Doctrine\Repository\Task;

use Doctrine\ORM\EntityRepository;
use Slx\Domain\Entity\Task\Task;
use Slx\Domain\Entity\Task\TaskRepositoryInterface;

class TaskDoctrineRepository extends EntityRepository implements TaskRepositoryInterface
{
    /**
     * @param Task $task
     * @return mixed|void
     */
    public function add(Task $task)
    {
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
    }
}
