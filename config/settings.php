<?php

use Selenium\Command\EsmcCommand;
use Selenium\Command\MixedContentCheck;
use Selenium\Driver\Chrome;
use Selenium\Service\AnalyzeMixedContent;
use Selenium\Service\EsmcService;
use Selenium\Support\Now;
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
        new EsmcCommand(
            new EsmcService(
                new Chrome,
                new Now(new DateTimeImmutable, 'YmdHis'),
                [
                    'esmc_url' => env('ESMC_URL'),
                    'username' => env('ESMC_USER'),
                    'password' => env('ESMC_PASS')
                ]
            )
        )
    );
};
