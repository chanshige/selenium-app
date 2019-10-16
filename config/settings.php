<?php

use Selenium\Command\Esmc;
use Selenium\Command\MixedContentCheck;
use Selenium\Driver\Chrome;
use Selenium\Service\AnalyzeMixedContent;
use Symfony\Component\Console\Application;

/**
 * @param Application $app
 */
return function ($app) {
    $app->add(
        new MixedContentCheck(
            new AnalyzeMixedContent(
                new Chrome
            )
        )
    );

    $app->add(
        new Esmc(
            new \Selenium\Service\Esmc(
                new Chrome,
                [
                    'esmc_url' => env('ESMC_URL'),
                    'username' => env('ESMC_USER'),
                    'password' => env('ESMC_PASS')
                ]
            )
        )
    );
};
