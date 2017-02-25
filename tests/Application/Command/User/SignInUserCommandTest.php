<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 25/02/17
 * Time: 11:16
 */

namespace Application\Command\User;

use Slx\Application\Command\User\SignUpUserCommand;

class SignInUserCommandTest extends \PHPUnit_Framework_TestCase
{

    public function testSignInUserCommandIsBuildCorrect()
    {
        $username = 'darkSide';
        $email = 'test@domain.com';
        $password = 'aSimplePass';
        $signInUserCommand = new SignUpUserCommand(
            $username,
            $email,
            $password
        );

        $this->assertEquals($username, $signInUserCommand->username());
        $this->assertEquals($email, $signInUserCommand->email());
        $this->assertEquals($password, $signInUserCommand->password());
    }
}