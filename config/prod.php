<?php

// configure your app for the production environment

$app['twig.path'] = array(__DIR__ . '/../src/Slx/UserInterface/Twig/Views/templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');
