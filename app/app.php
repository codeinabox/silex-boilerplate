<?php

if (!defined('APP_ENV')) {
    switch ($_SERVER['SERVER_NAME']) {
        case '10.11.12.14': // TODO put development server name here
            define('APP_ENV', 'development');
            break;
        case '': // TODO put staging server name here
            define('APP_ENV', 'staging');
            break;
        default:
            define('APP_ENV', 'product');
    }
}

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

$app = new \MyApp\Application();
$app->run();