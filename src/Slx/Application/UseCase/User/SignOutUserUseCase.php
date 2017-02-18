<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 18:35
 */

namespace Slx\Application\UseCase\User;

use Slx\Domain\Service\User\UserAuthentifierService;

class SignOutUserUseCase
{

    /**
     * @var UserAuthentifierService
     */
    private $authentifierService;

    /**
     * SignOutUserUseCase constructor.
     *
     * @param UserAuthentifierService $authentifierService
     */
    public function __construct(UserAuthentifierService $authentifierService)
    {
        $this->authentifierService = $authentifierService;
    }

    /**
     * Remove session use case
     */
    public function execute()
    {
       $this->authentifierService->removeSession();
    }
}
