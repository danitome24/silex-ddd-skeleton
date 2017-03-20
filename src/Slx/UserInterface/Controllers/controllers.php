<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})->bind('homepage');

$app->match('/signin', "signin.controller:indexAction")->bind('signin');
$app->match('/signup', 'signup.controller:indexAction')->bind('signup');
$app->match('/signout', 'signout.controller:indexAction')->bind('signout')->before($isUserLoggedCallback);
$app->get('/home', 'home.controller:indexAction')->bind('home')->before($isUserLoggedCallback);
$app->match('/task/add', 'createtask.controller:indexAction')->bind('createtask')->before($isUserLoggedCallback);
$app->get('/task', 'listtask.controller:indexAction')->bind('listtask')->before($isUserLoggedCallback);
$app->delete('/task/delete', 'removetask.controller:indexAction')->bind('removetask')->before($isUserLoggedCallback);


$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    switch ($code) {
        case 500:
            return new Response($app['twig']->render('errors/5xx.html.twig'), 404);
    }
});
