<?php

namespace Macghriogair\Support\Tests;

use Macghriogair\Support\Parser\TextParser;

class TextParserTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_parses_comma_separated_words()
    {
        $this->assertEquals(
            ['one'],
            TextParser::parseWords("one")
        );

        $this->assertEquals(
            ['one', '123', 'ab2de'],
            TextParser::parseWords("one,123,ab2de")
        );
    }

    /** @test */
    public function it_parses_comma_separated_words_with_spaces()
    {
        $this->assertEquals(
            ['one', '123', 'ab2de'],
            TextParser::parseWords("one, 123, ab2de")
        );

        $this->assertEquals(
            ['one', '123', 'ab2de'],
            TextParser::parseWords("one , 123, ab2de ")
        );
    }

    /** @test */
    public function it_parses_space_separated_words()
    {
        $this->assertEquals(
            ['one', '123', 'ab2de'],
            TextParser::parseWords("one 123 ab2de")
        );

        $this->assertEquals(
            ['two', '456', 'ab2de'],
            TextParser::parseWords("two  456 ab2de")
        );
    }

    /** @test */
    public function it_parses_mixed_spaces_and_comma_separated_words()
    {
        $this->assertEquals(
            ['m1x3d', '0123', 'abdef', 'ghijkl'],
            TextParser::parseWords(", m1x3d  123  , abdef,,,ghijkl  ")
        );
    }
}
