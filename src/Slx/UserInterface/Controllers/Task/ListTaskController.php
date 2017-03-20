<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 12/03/17
 * Time: 12:08
 */

namespace Slx\UserInterface\Controllers\Task;


use Silex\Application;
use Slx\Domain\Entity\User\User;

class ListTaskController
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
        $userFromSession = $this->application['session']->get('user');
        $user = $this->application['user_repository']->findOneBy(['username' => $userFromSession['username']]);

        return $this->application['twig']->render('views/task/list.html.twig',
            [
                'tasks' => $this->application['task_repository']->fetchAvailable($user->id()),
            ]
        );
    }
}
