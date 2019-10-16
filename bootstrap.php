<?php
date_default_timezone_set('Asia/Tokyo');
require_once __DIR__ . "/vendor/autoload.php";

const APP_DIR = __DIR__ . '/';

use Dotenv\Dotenv;
use Selenium\App;
use Symfony\Component\Console\Application;

/** load.env */
(new Dotenv(APP_DIR))->load();

$app = (new App(new Application(env('APP_NAME'), env('APP_VERSION'))))->get();
try {
    $app->run();
} catch (Exception $e) {
    echo 'Application Error.' . PHP_EOL;
    exit(1);
}
