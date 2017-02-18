<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 12/02/17
 * Time: 13:14
 */

namespace Slx\Application\CommandHandler\User;

use Slx\Application\Command\User\SignInUserCommand;
use Slx\Domain\Entity\User\UserRepositoryInterface;

class SignInUserCommandHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Sign in user in web app
     *
     * @param SignInUserCommand $userRequest
     * @return bool
     */
    public function execute(SignInUserCommand $userRequest)
    {
        //TODO build authencitacion service!!
        if (null != $userRequest->email() && null != $userRequest->password()) {
            return true;
        }


        return false;
    }
}
