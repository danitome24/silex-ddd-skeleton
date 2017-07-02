<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '172.20.1.1', 'fe80::1', '::1'))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check ' . basename(__FILE__) . ' for more information.');
}

require_once __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$app = require __DIR__ . '/../src/Slx/Infrastructure/app.php';
Request::enableHttpMethodParameterOverride();
require __DIR__ . '/../config/dev.php';
require __DIR__ . '/../src/Slx/UserInterface/Form/form.php';
require __DIR__ . '/../src/Slx/Infrastructure/Service/service.php';
require __DIR__ . '/../src/Slx/Infrastructure/middleware.php';
require __DIR__ . '/../src/Slx/UserInterface/Controllers/controllers.php';
$app->run();
