<?php
declare(strict_types=1);

namespace Selenium\Service;

use Exception\ExecutionException;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeOutException;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy as By;
use Facebook\WebDriver\WebDriverExpectedCondition as ExpectedCondition;
use Selenium\Driver\DriverInterface;

/**
 * Class Esmc
 *
 * @package Selenium\Service
 */
class Esmc
{
    /** @var DriverInterface */
    private $driver;

    /** @var array */
    private $config = [
        'esmc_url' => '',
        'username' => '',
        'password' => ''
    ];

    /**
     * Esmc constructor.
     *
     * @param DriverInterface $driver
     * @param array           $config
     */
    public function __construct(DriverInterface $driver, array $config = [])
    {
        $this->driver = $driver;
        $this->checkConfigKeys($config);
    }

    /**
     * @param int $mode
     * @throws NoSuchElementException
     * @throws TimeOutException
     */
    public function __invoke(int $mode = 0)
    {
        $driver = $this->driver->create();
        $driver->get($this->config['esmc_url'])
            ->wait()
            ->until(ExpectedCondition::visibilityOfElementLocated(By::xpath("//div[@title='Eset']")));

        $this->login($driver);
        // 脅威
        $driver->get($this->config['esmc_url'] . '#id=THREATS');

        //$driver->quit();
    }

    /**
     * TOP Login.
     *
     * @param WebDriver $driver
     */
    private function login(WebDriver $driver)
    {
        $driver->findElement(By::xpath("//input[@type='text']"))->clear()
            ->sendKeys($this->config['username']);
        $driver->findElement(By::xpath("//input[@type='password']"))->clear()
            ->sendKeys($this->config['password']);
        $driver->findElement(By::xpath("//button[text()=\"ログイン\"]"))->click();
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
