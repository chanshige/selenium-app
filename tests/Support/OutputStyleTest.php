<?php
namespace Selenium\Support;

use Selenium\BaseTestCase;

/**
 * Class OutputStyleTest
 *
 * @package Selenium\Support
 */
class OutputStyleTest extends BaseTestCase
{
    /**
     * @param string $name
     * @param string $message
     * @param string $expected
     * @dataProvider dataProvider
     */
    public function testStyles($name, $message, $expected)
    {
        $this->assertSame($expected, OutputStyle::{$name}($message));
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                'comment',
                'comment',
                '<comment>comment</comment>'
            ],
            [
                'info',
                'info',
                '<info>info</info>'
            ],
            [
                'error',
                'error',
                '<error>error</error>'
            ],
            [
                'question',
                '',
                '<question></question>'
            ]
        ];
    }
}
