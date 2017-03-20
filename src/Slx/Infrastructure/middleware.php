<?php

use Silex\Application;
use Slx\Domain\Entity\User\UserSessionNotFoundException;
use Slx\Domain\Event\DomainEventDispatcher;
use Slx\Domain\Event\Task\TaskWasCreated;
use Slx\Domain\Event\User\UserRegistered;
use Slx\Domain\EventListener\LogNewUserOnUserRegistered;
use Slx\Domain\EventListener\SendWelcomeEmailOnUserRegistered;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$isUserLoggedCallback = function (Request $request, Application $app) {
    if (empty($app['session']->get('user'))) {
        throw new UserSessionNotFoundException();
    }
};
$app->before(function (Request $request, Application $app) {
    DomainEventDispatcher::instance()->addListener(UserRegistered::EVENT_NAME, new SendWelcomeEmailOnUserRegistered($app['mailer.service']));
    DomainEventDispatcher::instance()->addListener(UserRegistered::EVENT_NAME, new LogNewUserOnUserRegistered($app['monolog']));
    DomainEventDispatcher::instance()->addListener(TaskWasCreated::EVENT_NAME, new \Slx\Domain\EventListener\SendNoticeEmailOnTaskCreated($app['mailer.service']));
});

