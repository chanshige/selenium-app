<?php

use Selenium\Command\SSLChecker;
use Selenium\Driver\Chrome;
use Selenium\Service\AnalyzeMixedContent;
use Symfony\Component\Console\Application;

/**
 * @param Application $app
 */
return function ($app) {
    $app->add(new SSLChecker(new AnalyzeMixedContent(new Chrome)));
};
