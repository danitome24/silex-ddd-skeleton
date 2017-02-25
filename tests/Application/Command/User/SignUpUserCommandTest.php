<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 25/02/17
 * Time: 11:16
 */

namespace Application\Command\User;

use PHPUnit\Framework\TestCase;
use Slx\Application\Command\User\SignInUserCommand;

class SignUpUserCommandTest extends \PHPUnit_Framework_TestCase
{

    public function testSignInUserCommandIsBuildCorrect()
    {
        $email = 'test@domain.com';
        $password = 'aSimplePass';
        $signInUserCommand = new SignInUserCommand(
            $email,
            $password
        );

        $this->assertEquals($email, $signInUserCommand->email());
        $this->assertEquals($password, $signInUserCommand->password());
    }
}