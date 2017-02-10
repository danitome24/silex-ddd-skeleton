<?php

ini_set('display_errors', 0);

require_once __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../src/Infrastructure/app.php';
require __DIR__ . '/../config/prod.php';
require __DIR__ . '/../src/Infrastructure/Service/service.php';
require __DIR__ . '/../src/UserInterface/Controllers/controllers.php';
$app->run();
