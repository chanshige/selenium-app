<?php
namespace Selenium\Support;

/**
 * Class OutputStyle
 *
 * @method static OutputStyle comment($val);
 * @method static OutputStyle info($val);
 * @method static OutputStyle error($val);
 *
 * @package Selenium\Support
 */
final class OutputStyle
{
    /**
     * @param string $name
     * @param array  $args
     * @return string
     */
    public static function __callStatic(string $name, array $args)
    {
        return "<{$name}>" . ($args[0] ?? '') . "</{$name}>";
    }
}
