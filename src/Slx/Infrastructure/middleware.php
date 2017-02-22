<?php

use Silex\Application;
use Slx\Domain\Event\DomainEventDispatcher;
use Slx\Domain\Event\User\UserRegistered;
use Slx\Domain\EventListener\LogNewUserOnUserRegistered;
use Slx\Domain\EventListener\SendWelcomeEmailOnUserRegistered;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->before(function (Request $request, Application $app) {
    DomainEventDispatcher::instance()->addListener(UserRegistered::EVENT_NAME, new SendWelcomeEmailOnUserRegistered());
    DomainEventDispatcher::instance()->addListener(UserRegistered::EVENT_NAME, new LogNewUserOnUserRegistered($app['monolog']));
});

