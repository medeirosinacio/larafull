<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . "/../docker");
$dotenv->load();

if (env('APP_ENV') != 'local') {
    header('HTTP/2 404 Not Found');
    $_GET['e'] = 404;
    exit;
}

phpinfo();
