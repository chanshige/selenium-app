<?php
namespace Selenium\Support;

use DateTimeInterface;
use Selenium\Interfaces\NowInterface;

/**
 * Class Now
 *
 * @package Selenium\Support
 */
final class Now implements NowInterface
{
    private $dateTime;

    private $format;

    /**
     * Now constructor.
     *
     * @param DateTimeInterface $dateTime
     * @param string            $format
     */
    public function __construct(DateTimeInterface $dateTime, string $format = 'Y-m-d H:i:s')
    {
        $this->dateTime = $dateTime;
        $this->format = $format;
    }

    /**
     * Return an instance with the dateTime format.
     *
     * @param string $format
     * @return NowInterface
     */
    public function withFormat(string $format): NowInterface
    {
        $clone = clone $this;
        $clone->format = $format;

        return $clone;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->dateTime->format($this->format);
    }
}
