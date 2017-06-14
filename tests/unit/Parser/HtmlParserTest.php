<?php
/**
 * @date    2016-10-04
 * @file    HtmlParserTest.php
 * @author  Patrick Mac Gregor <pmacgregor@3pc.de>
 */

namespace Tests;

use Macghriogair\Support\Parser\HtmlParser;

class HtmlParserTest extends \PHPUnit\Framework\TestCase
{

    /** @test */
    public function testMethod()
    {
        $expected = [
            'Acme / Offers',
            'Acme / Clients',
            'Acme / Products'
        ];

        $input = file_get_contents(DATA_DIR . '/html-stub.txt');

        $this->assertEquals(
            $expected,
            HtmlParser::byXPath($input, "//a[@class='name']")
        );

    }
}
