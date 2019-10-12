<?php
/** SSL Check */
$app->add(new \Selenium\Command\SSLChecker(new Selenium\Driver\Chrome()));
