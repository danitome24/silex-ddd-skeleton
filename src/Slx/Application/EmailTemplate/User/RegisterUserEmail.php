<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 24/02/17
 * Time: 23:41
 */

namespace Slx\Application\EmailTemplate\User;

use Slx\Domain\Entity\Email\EmailTemplateInterface;

class RegisterUserEmail implements EmailTemplateInterface
{
    /**
     * @var string
     */
    private $userEmail;

    /**
     * @var string
     */
    private $username;

    /**
     * RegisterUserEmail constructor.
     *
     * @param string $userEmail
     * @param string $username
     */
    public function __construct(string $userEmail, string $username)
    {
        $this->userEmail = $userEmail;
        $this->username = $username;
    }

    /**
     * Path to email template
     *
     * @return string
     */
    public function templatePath(): string
    {
        return 'emails/user/register.html.twig';
    }

    /**
     * Parameters to twig template email
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'email' => $this->userEmail,
            'username' => $this->username,
        ];
    }

    /**
     * User email to send email
     *
     * @return string
     */
    public function emailTo(): string
    {
        return $this->userEmail;
    }
}
