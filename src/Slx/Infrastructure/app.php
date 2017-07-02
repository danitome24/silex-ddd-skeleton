<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

$app = new Application();
$app->register(new FormServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale' => 'en',
));
$app->extend('translator', function ($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());
    $translator->addResource('yaml', __DIR__ . '/Resources/Translations/en.yml', 'en');

    return $translator;
});
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});
//$app->register(new MonologServiceProvider(), array(
//    'monolog.logfile' => __DIR__.'/development.log',
//));
$app['database_config'] = parse_ini_file(__DIR__ . '/../../../config/config.ini');
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => $app['database_config']['driver'],
        'host' => $app['database_config']['host'],
        'dbname' => $app['database_config']['dbname'],
        'user' => $app['database_config']['user'],
        'password' => $app['database_config']['password'],
        'charset' => $app['database_config']['charset'],
        'driverOptions' => array(1002 => 'SET NAMES utf8',),
    ),
));

$app->register(new DoctrineOrmServiceProvider, array(
    "orm.proxies_dir" => __DIR__ . "/../../../var/cache/doctrine/proxy",
    'orm.em.options' => array(
        'mappings' => array(
            array(
                'type' => 'simple_yml',
                'namespace' => 'Slx\Domain\Entity',
                'path' => __DIR__ . '/../Infrastructure/Persistence/Doctrine/Mapping/Entity',
            ),
            array(
                'type' => 'simple_yml',
                'namespace' => 'Slx\Domain\ValueObject',
                'path' => __DIR__ . '/../Infrastructure/Persistence/Doctrine/Mapping/ValueObject',
            ),
        ),
    ),
));
$app['em'] = $app["orm.em"];

return $app;
