<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 11/02/17
 * Time: 0:02
 */

namespace Slx\Infrastructure\Service\User;

use Slx\Domain\Entity\User\User;
use Slx\Domain\Service\User\PasswordHashingService as PasswordHashingServiceInterface;
use Slx\Domain\ValueObject\Password\Password;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class PasswordHashingService implements PasswordHashingServiceInterface
{

    /**
     * @var PasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var User
     */
    private $user;

    /**
     * PasswordHashingService constructor.
     *
     * @param User $user
     * @param PasswordEncoderInterface $passwordEncoder
     */
    public function __construct(User $user, PasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->user = $user;
    }

    /**
     * @param Password $password
     *
     * @return mixed
     */
    public function hash(Password $password)
    {
        return $this->passwordEncoder->encodePassword($this->user, $password);
    }
}