<?php
namespace Selenium\Support;

use Exception\FileException;
use SimpleXMLElement;

/**
 * Class File
 *
 * @package Selenium\Util
 */
class File
{
    /**
     * @param string $filename
     * @return string
     * @throws FileException
     */
    public static function read($filename)
    {
        $contents = @file_get_contents($filename);
        if (!$contents) {
            throw new FileException('Failed to get file contents.');
        }

        return $contents;
    }

    /**
     * @param string $data
     * @return SimpleXMLElement
     * @throws FileException
     */
    public static function loadXml(string $data)
    {
        $xmlObject = @simplexml_load_string($data);
        if (!$xmlObject) {
            throw new FileException('Failed to load xml data.');
        }

        return $xmlObject;
    }
}
