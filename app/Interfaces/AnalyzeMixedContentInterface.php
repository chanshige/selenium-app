<?php
namespace Selenium\Interfaces;

/**
 * Interface AnalyzeMixedContentInterface
 *
 * @package Selenium\Interfaces
 */
interface AnalyzeMixedContentInterface
{
    /**
     * @param string   $xmlUri
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(string $xmlUri, callable $callback);
}
