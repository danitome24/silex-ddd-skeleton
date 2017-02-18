<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 18/02/17
 * Time: 18:24
 */

namespace Slx\UserInterface\Controllers\User;

use Silex\Application;

class SignOutController
{
    /**
     * @var Application
     */
    private $application;

    /**
     * SignOutController constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction()
    {
        $this->application['signout.service']->execute();

        return $this->application->redirect($this->application['url_generator']->generate('signin'));
    }
}
