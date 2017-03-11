<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 11/03/17
 * Time: 17:14
 */

namespace Slx\Domain\ValueObject\Task;

use Ramsey\Uuid\Uuid;

class TaskId
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
     * @return TaskId
     */
    public static function generate(): TaskId
    {
        return new self();
    }

    /**
     * @param TaskId $taskId
     * @return bool
     */
    public function equals(TaskId $taskId)
    {
        return ($this->id === $taskId->id);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id;
    }
}