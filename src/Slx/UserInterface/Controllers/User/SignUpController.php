<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 0:46
 */

namespace Slx\UserInterface\Controllers\User;

use Silex\Application;
use Slx\Application\Command\User\SignUpUserCommand;
use Slx\Domain\Entity\User\UserAlreadyExistsException;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;

class SignUpController
{
    /**
     * @var Application
     */
    private $application;

    /**
     * SignInController constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function indexAction()
    {
        /** @var Form $form */
        $form = $this->application['sign_up_form'];
        $form->handleRequest($this->application['request_stack']->getCurrentRequest());
        try {
            if ($form->isValid()) {
                $this->application['signup.service']->execute(
                    new SignUpUserCommand(
                        $form->get('userName')->getData(),
                        $form->get('email')->getData(),
                        $form->get('password')->getData()
                    )
                );
            }
        } catch (UserAlreadyExistsException $exception) {
            $form->get('email')->addError(new FormError('Email is already registered by another user'));
        }

        return $this->application['twig']->render('views/user/signup.html.twig',
            [
                'form' => $this->application['sign_up_form']->createView()
            ]
        );
    }

}
