<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 25/02/17
 * Time: 12:16
 */

namespace Application\CommandHandler\User;

use Slx\Application\Command\User\SignInUserCommand;
use Slx\Application\Command\User\SignUpUserCommand;
use Slx\Application\CommandHandler\User\SignInUserCommandHandler;
use Slx\Application\CommandHandler\User\SignUpUserCommandHandler;
use Slx\Domain\Entity\User\Exception\UserAlreadyExistsException;
use Slx\Domain\Entity\User\Exception\UserDoesNotExistsException;
use Slx\Domain\Entity\User\Exception\UserPasswordDoesNotMatchException;
use Slx\Domain\Entity\User\User;
use Slx\Domain\ValueObject\User\UserId;
use Slx\Domain\Entity\User\UserRepositoryInterface;
use Slx\Domain\Service\User\PasswordHashingService;
use Slx\Domain\ValueObject\Email\Email;
use Slx\Domain\ValueObject\Password\Password;

class SignUpUserCommandHandlerTest extends \PHPUnit_Framework_TestCase
{

    public function testUserAlreadyExists()
    {
        $this->expectException(UserAlreadyExistsException::class);
        $command = new SignUpUserCommand(
            'mongufi',
            'specialOne@mongufi.com',
            'easyPass'
        );
        (new SignUpUserCommandHandler(
            new FakeUserRepository(),
            new FakePasswordHashService()
        ))->execute($command);
    }

    public function testUserRegister()
    {
        $command = new SignUpUserCommand(
            'mongufi',
            'specialOne@mongufi.com',
            'easyPass'
        );
        (new FakeSignUpUserCommand(
            new FakeEmptyUserRepo(),
            new FakePasswordHashService()
        ))->execute($command);

    }
}

class FakeSignUpUserCommand extends SignUpUserCommandHandler
{
    protected function buildNewUser($username, $email, $password): UserTesting
    {
        return new UserTesting();
    }
}

class FakeEmptyUserRepo implements UserRepositoryInterface
{

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function add(User $user)
    {
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function fetchByEmail($email)
    {
        return null;
    }
}
