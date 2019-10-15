<?php
namespace Selenium\Support;

use Selenium\BaseTestCase;

/**
 * Class FileTest
 *
 * @package Selenium\Support
 */
class FileTest extends BaseTestCase
{
    /**
     * file_get_contents test.
     */
    public function testRead()
    {
        $expected = /** @lang xml */
            <<< EOF
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://localhost.test/</loc>
        <lastmod>2019-10-01T00:00:00+09:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://localhost.test/rss/</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://localhost.test/abouts/</loc>
        <lastmod>2019-10-01T00:00:00+09:00</lastmod>
    </url>
    <url>
        <loc>https://localhost.test/cart/</loc>
        <lastmod>2019-10-01T00:00:00+09:00</lastmod>
    </url>
</urlset>

EOF;

        $this->assertEquals($expected, File::read(TEST_DIR . 'Fake/dummy_file.xml'));
    }

    /**
     * simplexml_load_string test.
     */
    public function testLoadXml()
    {
        $xml = /** @lang xml */
            <<< EOF
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://localhost.test/</loc>
        <lastmod>2019-10-01T00:00:00+09:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://localhost.test/rss/</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://localhost.test/abouts/</loc>
        <lastmod>2019-10-01T00:00:00+09:00</lastmod>
    </url>
    <url>
        <loc>https://localhost.test/cart/</loc>
        <lastmod>2019-10-01T00:00:00+09:00</lastmod>
    </url>
</urlset>

EOF;

        $this->assertInstanceOf('SimpleXMLElement', File::loadXml($xml));
    }

    /**
     * @expectedException \Exception\FileException
     * @expectedExceptionMessage Failed to get file contents.
     */
    public function testReadFailure()
    {
        File::read(TEST_DIR);
    }

    /**
     * @expectedException \Exception\FileException
     * @expectedExceptionMessage Failed to load xml data.
     */
    public function testLoadXmlFailure()
    {
        File::loadXml('aaa');
    }
}
