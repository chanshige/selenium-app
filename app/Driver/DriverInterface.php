<?php
namespace Selenium\Driver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriver;

/**
 * Interface DriverInterface
 *
 * @package Selenium\Driver
 */
interface DriverInterface
{
    /**
     * Return create driver.
     *
     * @return WebDriver
     */
    public function create();

    /**
     * @return DesiredCapabilities
     */
    public function capabilities();
}
