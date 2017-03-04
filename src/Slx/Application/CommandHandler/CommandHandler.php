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
     * @param $command
     * @return mixed
     */
    public function execute(CommandInterface $command)
    {
        return $this->application[$command->commandHandler()]->execute($command);
    }
}
