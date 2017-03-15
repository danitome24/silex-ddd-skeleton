<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 15/03/17
 * Time: 12:57
 */

namespace Slx\Application\EmailTemplate\User;

use Slx\Domain\Entity\Email\EmailTemplateInterface;
use Slx\Domain\Entity\User\User;

class TaskCreatedUserEmail implements EmailTemplateInterface
{
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;
    /**
     * @var User
     */
    private $user;

    public function __construct(string $title, string $description, User $user)
    {

        $this->title = $title;
        $this->description = $description;
        $this->user = $user;
    }

    /**
     * Path to email template
     *
     * @return string
     */
    public function templatePath(): string
    {
        return 'emails/user/newtask.html.twig';
    }

    /**
     * Parameters to twig templateemail
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'taskTitle' => $this->title,
        ];
    }

    /**
     * @return string
     */
    public function emailTo(): string
    {
        return $this->user->email();
    }
}