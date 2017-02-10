<?php

use UserInterface\Controllers\User\SignInController;

$app['signin.controller'] = function () use ($app) {
    return new SignInController($app);
};
