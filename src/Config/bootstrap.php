<?php

use Silex\Application;
use Model\App;
use Symfony\Component\HttpFoundation\Request;

$app = new Application();

require_once "routes.php";

$app->before(function () use ($app) {
    $appInstance = App::getInstance();
    $appInstance->setup($app);
});

$app->register(new DerAlex\Silex\YamlConfigServiceProvider(__DIR__ . "/default.yml"));
$app->register(new DerAlex\Silex\YamlConfigServiceProvider(__DIR__ . "/dev.yml"));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../View',
    'debug' => $app['config']['debug_mode']
));

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => $app['config']['database']['driver'],
        'host' => $app['config']['database']['host'],
        'dbname' => $app['config']['database']['dbname'],
        'user' => $app['config']['database']['username'],
        'password' => $app['config']['database']['password']
    ),
));

$app->error(function (Exception $e, $code) use ($app) {
    switch ($code) {
        case '404':
            return $app['twig']->render('404.twig');
            break;
        default:
            return $app['twig']->render('500.twig', array('error_message' => $e->getMessage()));
            break;
    }
});

return $app;