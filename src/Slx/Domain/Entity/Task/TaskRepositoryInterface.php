<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 11/03/17
 * Time: 23:23
 */

namespace Slx\Domain\Entity\Task;

interface TaskRepositoryInterface
{
    /**
     * @param $taskId
     * @return Task
     */
    public function fetchById($taskId);
}
