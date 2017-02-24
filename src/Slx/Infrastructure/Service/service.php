<?php

use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Slx\Application\CommandHandler\User\SignUpUserCommandHandler;
use Slx\Application\UseCase\User\SignOutUserUseCase;
use Slx\Infrastructure\Service\Mail\Mailer;
use Slx\UserInterface\Controllers\User\SignInController;
use Slx\UserInterface\Controllers\User\SignOutController;
use Symfony\Component\HttpFoundation\Request;
use Slx\Application\CommandHandler\User\SignInUserCommandHandler;
use Slx\Infrastructure\Service\User\PasswordHashingService;
use Slx\Infrastructure\Service\User\AuthenticateUserService;
use Slx\UserInterface\Controllers\User\SignUpController;
use Slx\UserInterface\Controllers\Home\HomeController;

/**
 * Controllers
 */
$app['signin.controller'] = function () use ($app) {
    return new SignInController($app);
};
$app['signup.controller'] = function () use ($app) {
    return new SignUpController($app);
};
$app['home.controller'] = function () use ($app) {
    return new HomeController($app);
};
$app['signout.controller'] = function () use ($app) {
    return new SignOutController($app);
};

/**
 * Services
 */
$app['haspassword.service'] = function () use ($app) {
    return new PasswordHashingService();
};
$app['signin.service'] = function () use ($app) {
    return new SignInUserCommandHandler($app['user_repository'], $app['haspassword.service']);
};
$app['signup.service'] = function () use ($app) {
    return new SignUpUserCommandHandler($app['user_repository'], $app['haspassword.service']);
};
$app['signout.service'] = function () use ($app) {
    return new SignOutUserUseCase($app);
};
//$app['authentication.service'] = function () use ($app) {
//    return new AuthenticateUserService();
//};
$app['mailer.service'] = function () use ($app) {
    return new Mailer(
        $app['twig']
    );
};

/**
 * Repositories
 */
$app['user_repository'] = function () use ($app) {
    return $app['em']->getRepository('Slx\Domain\Entity\User\User');
};


