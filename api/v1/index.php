<?php
require '../../vendor/autoload.php';

/* App Config */
$config['displayErrorDetails'] = true;

// Initialize Slim
$app = new \Slim\App(["settings" => $config]);

/* Set up Logging to /logs/app.log with Monolog */
$container = $app->getContainer();
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('HAMS REST');
    $file_handler = new \Monolog\Handler\StreamHandler('./logs/'.date('Y-m-d').'.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

//include database connection
require_once 'database/connection.php';

//include the routes
require_once 'routes/student.php';
require_once 'routes/cwarden.php';

/* Kickstart App */
$app->run();
