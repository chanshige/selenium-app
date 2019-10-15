<?php
namespace Selenium;

use Symfony\Component\Console\Application;

/**
 * Class App (師匠ベースクラス)
 *
 * @package Selenium
 */
class App
{
    private $app;

    /**
     * App constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $settings = require_once BASE_DIR . 'config/settings.php';
        $settings($app);

        $this->app = $app;
    }

    /**
     * Return Console Object.
     *
     * @return Application
     */
    public function get()
    {
        return $this->app;
    }
}
