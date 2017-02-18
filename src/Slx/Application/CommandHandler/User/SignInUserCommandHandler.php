<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 12/02/17
 * Time: 13:14
 */

namespace Slx\Application\CommandHandler\User;

use Slx\Application\Command\User\SignInUserCommand;
use Slx\Domain\Entity\User\User;
use Slx\Domain\Entity\User\UserDoesNotExistsException;
use Slx\Domain\Entity\User\UserPasswordDoesNotMatchException;
use Slx\Domain\Entity\User\UserRepositoryInterface;
use Slx\Domain\Service\User\PasswordHashingService;
use Slx\Domain\Service\User\UserAuthentifierService;
use Symfony\Component\Config\Definition\Exception\Exception;

class SignInUserCommandHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var PasswordHashingService
     */
    private $hashingService;
    /**
     * @var UserAuthentifierService
     */
    private $authentifierService;

    /**
     * SignInUserCommandHandler constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param PasswordHashingService $hashingService
     * @param UserAuthentifierService $authentifierService
     */
    public function __construct(UserRepositoryInterface $userRepository, PasswordHashingService $hashingService,
                                UserAuthentifierService $authentifierService)
    {
        $this->userRepository = $userRepository;
        $this->hashingService = $hashingService;
        $this->authentifierService = $authentifierService;
    }

    /**
     * Sign in user in web app
     *
     * @param SignInUserCommand $userRequest
     * @return bool
     * @throws UserDoesNotExistsException
     * @throws UserPasswordDoesNotMatchException
     */
    public function execute(SignInUserCommand $userRequest)
    {
        /** @var User $user */
        $user = $this->userRepository->fetchByEmail($userRequest->email());
        if (null == $user) {
            throw new UserDoesNotExistsException();
        }
        $isVerified = $this->hashingService->verifyPassword($user->password(), $userRequest->password());
        if (!$isVerified) {
            throw new UserPasswordDoesNotMatchException();
        }

        $this->authentifierService->authenticate($user);
        return true;
    }
}
