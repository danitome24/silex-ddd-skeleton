<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 12/03/17
 * Time: 0:44
 */

namespace Slx\Application\CommandHandler\Task;


use Slx\Application\Command\CommandInterface;
use Slx\Application\Command\Task\CreateTaskCommand;
use Slx\Application\CommandHandler\CommandHandlerInterface;
use Slx\Domain\Entity\Task\Task;
use Slx\Domain\Entity\Task\TaskRepositoryInterface;
use Slx\Domain\Entity\User\Exception\UserDoesNotExistsException;
use Slx\Domain\Entity\User\User;
use Slx\Domain\Entity\User\UserRepositoryInterface;

class CreateTaskCommandHandler implements CommandHandlerInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    /**
     * CreateTaskCommandHandler constructor.
     * @param UserRepositoryInterface $userRepository
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(UserRepositoryInterface $userRepository,
                                TaskRepositoryInterface $taskRepository)
    {
        $this->userRepository = $userRepository;
        $this->taskRepository = $taskRepository;
    }

    /**
     *
     * @param CommandInterface|CreateTaskCommand $command
     * @return mixed
     * @throws UserDoesNotExistsException
     */
    public function execute(CommandInterface $command)
    {
        /** @var User $user */
        $user = $this->userRepository->find($command->user());
        if (null == $user) {
            throw new UserDoesNotExistsException();
        }
        $task = Task::build($command->title(), $user, Task::OPEN, $command->description());
        $this->taskRepository->add($task);
    }
}