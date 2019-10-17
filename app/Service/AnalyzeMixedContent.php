<?php
declare(strict_types=1);

namespace Selenium\Service;

use Selenium\Driver\DriverInterface;
use Selenium\Interfaces\AnalyzeMixedContentInterface;
use Selenium\Support\File;
use stdClass;

/**
 * Class AnalyzeMixedContent
 *
 * @package Selenium\Service
 */
class AnalyzeMixedContent implements AnalyzeMixedContentInterface
{
    /** @var DriverInterface */
    private $driver;

    /**
     * AnalyzeMixedContent constructor.
     *
     * @param DriverInterface $driver
     */
    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Invoke.
     *
     * @param string   $xmlUri
     * @param callable $callback
     * @return int
     */
    public function __invoke(string $xmlUri, callable $callback)
    {
        $xmlObject = File::loadXml(File::read($xmlUri));
        // Create browser driver.
        $driver = $this->driver->create();
        // Analyze
        $count = 1;
        /** @var object $item */
        foreach ($xmlObject as $item) {
            $driver->get($item->loc);
            $content = $this->extractMixedContent($driver->manage()->getLog('browser'));
            $res = call_user_func($callback, function () use ($item, $content) {
                $object = new stdClass();
                $object->url = $item->loc;
                $object->isSSL = count($content) === 0;
                $object->content = $content;
                return $object;
            });
            if ($res === false) {
                break;
            }
            $count++;
        }
        // Quits browser driver.
        $driver->quit();

        return $count;
    }

    /**
     * Extract Mixed Content message from browser.
     *
     * @param array $array
     * @return array
     */
    private function extractMixedContent($array)
    {
        return preg_grep('/.*Mixed Content.*/i', array_column($array, 'message'));
    }
}
