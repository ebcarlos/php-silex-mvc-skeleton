<?php

require_once(__DIR__ . '/../vendor/autoload.php');

$app = require_once(__DIR__ . '/../src/Config/bootstrap.php');

if ($app['config']['debug_mode']) {
    error_reporting(E_ALL);
    ini_set('display_errors', true);
}

$app->run();