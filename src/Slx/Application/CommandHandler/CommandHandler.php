<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 26/02/17
 * Time: 21:02
 */

namespace Slx\Application\CommandHandler;

use Silex\Application;
use Slx\Application\Command\CommandInterface;

class CommandHandler implements CommandHandlerInterface
{
    /**
     * @var Application
     */
    private $application;

    /**
     * CommandHandler constructor.
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     *
     * @param CommandInterface $command
     * @return mixed
     * @throws CommandHandlerNotFoundException
     */
    public function execute(CommandInterface $command)
    {
        if (!isset($this->application[$command->commandHandler()])) {
            throw new CommandHandlerNotFoundException();
        }
        return $this->application[$command->commandHandler()]->execute($command);
    }
}
