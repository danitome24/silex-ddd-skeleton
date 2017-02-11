<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 11/02/17
 * Time: 0:27
 */

namespace UserInterface\Controllers\User;

use Silex\Application;

class SignInController
{
    /**
     * @var Application
     */
    private $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function indexAction()
    {
        return $this->application['twig']->render('views/user/login.html.twig',
            [
                'form' => $this->application['sign_in_form']->createView()
            ]
        );
    }
}