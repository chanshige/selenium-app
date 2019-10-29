<?php
declare(strict_types=1);

namespace Selenium\Service;

use Exception\ExecutionException;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy as By;
use Facebook\WebDriver\WebDriverExpectedCondition as ExpectedCondition;
use Selenium\Driver\DriverInterface;
use Selenium\Interfaces\NowInterface;

/**
 * Class EsmcService
 *
 * @package Selenium\Service
 */
class EsmcService
{
    /** @var DriverInterface */
    private $driver;

    /** @var NowInterface */
    private $dateTime;

    /** @var array */
    private $config = [
        'esmc_url' => '',
        'username' => '',
        'password' => ''
    ];

    /**
     * EsmcCommand constructor.
     *
     * @param DriverInterface $driver
     * @param NowInterface    $dateTime
     * @param array           $config
     */
    public function __construct(DriverInterface $driver, NowInterface $dateTime, array $config = [])
    {
        $this->driver = $driver;
        $this->dateTime = $dateTime;
        $this->checkConfigKeys($config);
    }

    public function __invoke(int $mode = 0)
    {
        $driver = $this->driver->create();
        $this->login($driver);
        $this->viewDashboard($driver);

        $driver->findElement(By::id('i782-1'))->click();
        $driver->wait(20, 5000);

        $driver->manage()->window()->maximize();
        $driver->takeScreenshot(APP_DIR . 'var/esmc_webconsole' . (string)$this->dateTime . '.png');

        $driver->quit();
    }

    private function login(WebDriver $driver)
    {
        $driver->get($this->config['esmc_url'])
            ->wait()
            ->until(ExpectedCondition::visibilityOfElementLocated(By::xpath("//div[@title='Eset']")));

        $driver->findElement(By::xpath("//input[@type='text']"))->clear()
            ->sendKeys($this->config['username']);
        $driver->findElement(By::xpath("//input[@type='password']"))->clear()
            ->sendKeys($this->config['password']);
        $driver->findElement(By::xpath("//button[text()=\"ログイン\"]"))->click();
    }

    private function viewDashboard(WebDriver $driver)
    {
        $driver->get($this->config['esmc_url'] . '#id=DASHBOARDS')
            ->wait()
            ->until(ExpectedCondition::invisibilityOfElementLocated(By::xpath("//div[@id='login_container']")));
    }

    /**
     * Check configuration keys.
     *
     * @param array $config
     */
    private function checkConfigKeys(array $config)
    {
        foreach ($config as $key => $value) {
            if (array_key_exists($key, $this->config)) {
                $this->config[$key] = $value;
                continue;
            }
            throw new ExecutionException(
                'Key:' . $key . ' is either not part of the configuration or has incorrect Key name.'
            );
        }
    }
}
