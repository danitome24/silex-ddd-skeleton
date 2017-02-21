<?php

ini_set('display_errors', 0);

require_once __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../src/Slx/Infrastructure/app.php';
require __DIR__ . '/../src/Slx/Infrastructure/middleware.php';
require __DIR__ . '/../config/prod.php';
require __DIR__ . '/../src/Slx/UserInterface/Form/form.php';
require __DIR__ . '/../src/Slx/Infrastructure/Service/service.php';
require __DIR__ . '/../src/Slx/UserInterface/Controllers/controllers.php';
$app->run();
