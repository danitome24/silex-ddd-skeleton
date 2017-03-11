<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 25/02/17
 * Time: 12:16
 */

namespace Application\CommandHandler\User;

use Slx\Application\Command\User\SignInUserCommand;
use Slx\Application\CommandHandler\User\SignInUserCommandHandler;
use Slx\Domain\Entity\User\Exception\UserDoesNotExistsException;
use Slx\Domain\Entity\User\Exception\UserPasswordDoesNotMatchException;
use Slx\Domain\Entity\User\User;
use Slx\Domain\Entity\ValueObject\UserId;
use Slx\Domain\Entity\User\UserRepositoryInterface;
use Slx\Domain\Service\User\PasswordHashingService;
use Slx\Domain\ValueObject\Email\Email;
use Slx\Domain\ValueObject\Password\Password;

class SignInUserCommandHandlerTest extends \PHPUnit_Framework_TestCase
{

    public function testUserDoesNotExists()
    {
        $this->expectException(UserDoesNotExistsException::class);
        $commandHandler = new SignInUserCommandHandler(
            new FakeEmptyUserRepository(),
            new FakePasswordHashService()
        );

        $commandHandler->execute(new SignInUserCommand('email', 'password'));
    }

    public function testUserExists()
    {
        $commandHandler = new SignInUserCommandHandler(
            new FakeUserRepository(),
            new FakePasswordHashService()
        );

        $user = $commandHandler->execute(
            new SignInUserCommand(
                'thebestemail@domain.com',
                'password'
            )
        );

        $this->assertEquals('thebestemail@domain.com', $user->email()->email());
        $this->assertEquals('password', $user->password()->password());
    }

    public function testPasswordNotVerified()
    {
        $this->expectException(UserPasswordDoesNotMatchException::class);
        $commandHandler = new SignInUserCommandHandler(
            new FakeUserRepository(),
            new FakePasswordHashService()
        );

        $user = $commandHandler->execute(
            new SignInUserCommand(
                'thebestemail@domain.com',
                'badPassword'
            )
        );

    }
}

class FakeEmptyUserRepository implements UserRepositoryInterface
{

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function add(User $user)
    {
        return null;
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

class FakeUserRepository implements UserRepositoryInterface
{

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function add(User $user)
    {
        return null;
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function fetchByEmail($email)
    {
        return new UserTesting();
    }
}

class FakePasswordHashService implements PasswordHashingService
{

    /**
     * @param Password $password
     *
     * @return mixed
     */
    public function hash(Password $password)
    {
        return 'hashedPassword';
    }

    /**
     * @param Password $userPassword
     * @param string $passwordToVerify
     *
     * @return mixed
     */
    public function verifyPassword(Password $userPassword, string $passwordToVerify)
    {
        return $userPassword->password() == $passwordToVerify;
    }
}

class UserTesting extends User
{
    public function __construct()
    {
    }

    public function email(): Email
    {
        return Email::fromString('thebestemail@domain.com');
    }

    public function username(): string
    {
        return 'amaizingUsername';
    }

    public function password(): Password
    {
        return Password::fromString('password');
    }

    public function dispatchUserWasRegisteredEvent()
    {
    }
}
