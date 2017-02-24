<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 24/02/17
 * Time: 23:35
 */

namespace Slx\Domain\Entity\Email;


interface EmailTemplateInterface
{
    /**
     * Path to email template
     *
     * @return string
     */
    public function templatePath(): string;

    /**
     * Parameters to twig templateemail
     *
     * @return array
     */
    public function parameters(): array;

    /**
     * @return string
     */
    public function emailTo(): string;
}
