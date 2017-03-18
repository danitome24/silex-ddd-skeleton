<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 16/03/17
 * Time: 16:41
 */

namespace Slx\Application\CommandHandler\Task;


use Slx\Application\Command\CommandInterface;
use Slx\Application\Command\Task\RemoveTaskCommand;
use Slx\Application\CommandHandler\CommandHandlerInterface;
use Slx\Domain\Entity\Task\Exception\TaskNotFoundException;
use Slx\Domain\Entity\Task\TaskRepositoryInterface;

class RemoveTaskCommandHandler implements CommandHandlerInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     *  Remove task
     *
     * @param CommandInterface|RemoveTaskCommand $command
     * @return mixed
     * @throws TaskNotFoundException
     */
    public function execute(CommandInterface $command)
    {
        $taskId = $command->taskId();
        if (null == $task = $this->taskRepository->fetchById($taskId)) {
            throw new TaskNotFoundException();
        }

        $task->remove();
        $this->taskRepository->save($task);
    }
}