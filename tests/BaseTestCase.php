<?php
namespace Selenium;

use PHPUnit\Framework\TestCase;

/**
 * Class BaseTestCase
 *
 * @package Selenium
 */
abstract class BaseTestCase extends TestCase
{
    protected $actual;

    protected $expected;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
    }

    /**
     * @param string $message
     */
    protected function verify($message = '')
    {
        $this->assertSame($this->expected, $this->actual, $message);
    }
}
