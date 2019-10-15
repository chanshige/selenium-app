<?php

use Selenium\App;
use Symfony\Component\Console\Application;

require_once __DIR__ . "/define.php";
require_once __DIR__ . "/vendor/autoload.php";

$app = (new App(new Application(NAME, VERSION)))->get();
try {
    $app->run();
} catch (Exception $e) {
    exit(1);
}
