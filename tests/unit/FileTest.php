<?php

namespace Macghriogair\Support\Tests;

use Macghriogair\Support\File;

class FileTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function it_detects_utf8()
    {
        $this->assertFalse(File::isUTF8(DATA_DIR . 'windows1252.txt'));
        $this->assertTrue(File::isUTF8(DATA_DIR . 'utf8.txt'));
        $this->assertTrue(File::isUTF8(DATA_DIR . 'utf8-2.txt'));
    }
}
