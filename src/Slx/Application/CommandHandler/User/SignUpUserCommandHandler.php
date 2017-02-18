<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 0:32
 */

namespace Slx\Application\CommandHandler\User;

use Slx\Application\Command\User\SignUpUserCommand;
use Slx\Domain\Entity\User\User;
use Slx\Domain\Entity\User\UserAlreadyExistsException;
use Slx\Domain\Entity\User\UserId;
use Slx\Domain\Entity\User\UserRepositoryInterface;

class SignUpUserCommandHandler
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
     * @param SignUpUserCommand $userRequest
     * @return bool
     * @throws UserAlreadyExistsException
     */
    public function execute(SignUpUserCommand $userRequest)
    {
        $user = $this->userRepository->fetchByEmail($userRequest->email());
        if (null != $user) {
            throw new UserAlreadyExistsException();
        }

        $user = new User(
            UserId::generateUserId(),
            $userRequest->username(),
            $userRequest->email(),
            $userRequest->password()
        );

        $this->userRepository->add($user);

        return 'OK';
    }
}