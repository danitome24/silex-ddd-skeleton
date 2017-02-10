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

    public function indexAction(Application $application)
    {

        return $application['twig']->render('views/user/login.html.twig', []);
    }
}