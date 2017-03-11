<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 11/03/17
 * Time: 13:54
 */

namespace Application\CommandHandler;


use Application\Command\User\SignUpUserCommandTest;
use Application\CommandHandler\User\FakePasswordHashService;
use Application\CommandHandler\User\FakeUserRepository;
use Application\CommandHandler\User\SignUpUserCommandHandlerTest;
use Silex\Application;
use Slx\Application\Command\CommandInterface;
use Slx\Application\CommandHandler\CommandHandler;
use Slx\Application\CommandHandler\CommandHandlerInterface;
use Slx\Application\CommandHandler\CommandHandlerNotFoundException;
use Slx\Application\CommandHandler\User\SignUpUserCommandHandler;


class CommandHandlerTest extends \PHPUnit_Framework_TestCase
{

    public function testExecuteCommandHandler()
    {
        $commandHandler = new CommandHandler(new FakeApplication());
        $commandHandler->execute(new FakeSignUpUserCommand());
    }

    public function testCommandHandlerWasNotFoundException()
    {
        $this->expectException(CommandHandlerNotFoundException::class);
        $commandHandler = new CommandHandler(new FakeApplication());
        $commandHandler->execute(new FakeCommandWithNoCommandHandler());
    }
}

class FakeApplication extends Application
{
    public function __construct(array $values = array())
    {
        $this['customHandler'] = new FakeCustomCommandHandler();
    }
}

class FakeSignUpUserCommand implements CommandInterface
{
    /**
     * @return string
     */
    public function commandHandler(): string
    {
        return 'customHandler';
    }
}

class FakeCommandWithNoCommandHandler implements CommandInterface
{

    /**
     * @return string
     */
    public function commandHandler(): string
    {
        return 'notexists';
    }
}

class FakeCustomCommandHandler implements CommandHandlerInterface
{
    /**
     *
     *
     * @param $command
     * @return mixed
     */
    public function execute(CommandInterface $command)
    {
        return true;
    }
}
