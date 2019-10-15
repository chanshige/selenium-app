<?php

use Selenium\Command\Checker;
use Selenium\Driver\Chrome;
use Selenium\Service\AnalyzeMixedContent;
use Symfony\Component\Console\Application;

/**
 * @param Application $app
 */
return function ($app) {
    $app->add(new Checker(new AnalyzeMixedContent(new Chrome)));
};
