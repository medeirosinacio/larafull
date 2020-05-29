<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . "/../docker");
$dotenv->load();

if (env('APP_ENV') != 'local') {
    header('HTTP/2 404 Not Found'); //This may be put inside err.php instead
    $_GET['e'] = 404; //Set the variable for the error code (you cannot have a
    exit; //Do not do any more work in this script.
}

phpinfo();
