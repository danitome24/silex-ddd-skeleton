<?php

use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Slx\Application\CommandHandler\User\SignUpUserCommandHandler;
use Slx\UserInterface\Controllers\User\SignInController;
use Symfony\Component\HttpFoundation\Request;
use Slx\Application\CommandHandler\User\SignInUserCommandHandler;

/**
 * Controllers
 */
$app['signin.controller'] = function () use ($app) {
    return new SignInController($app);
};
$app['signup.controller'] = function () use ($app) {
    return new \Slx\UserInterface\Controllers\User\SignUpController($app);
};

/**
 * Services
 */
$app['signin.service'] = function () use ($app) {
    return new SignInUserCommandHandler($app['user_repository']);
};
$app['signup.service'] = function () use ($app) {
    return new SignUpUserCommandHandler($app['user_repository']);
};

/**
 * Repositories
 */
$app['user_repository'] = function () use ($app) {
    return $app['em']->getRepository('Slx\Domain\Entity\User\User');
};


