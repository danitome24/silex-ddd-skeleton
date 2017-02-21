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
use Slx\Domain\Entity\User\Exception\UserAlreadyExistsException;
use Slx\Domain\Entity\User\UserId;
use Slx\Domain\Entity\User\UserRepositoryInterface;
use Slx\Domain\Service\User\PasswordHashingService;

class SignUpUserCommandHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var PasswordHashingService
     */
    private $hashingService;

    public function __construct(UserRepositoryInterface $userRepository, PasswordHashingService $hashingService)
    {
        $this->userRepository = $userRepository;
        $this->hashingService = $hashingService;
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
            $this->hashingService->hash($userRequest->password())
        );

        $this->userRepository->add($user);

        return true;
    }
}