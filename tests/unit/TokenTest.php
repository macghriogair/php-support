<?php

namespace Macghriogair\Support\Tests;

use Macghriogair\Support\Token;

class TokenTest extends \PHPUnit\Framework\TestCase
{

    /** @test */
    public function it_creates_a_token()
    {
        $this->assertEquals(60, strlen(Token::apiToken()));
    }

    /** @test */
    public function it_creates_a_human_readable_token()
    {
        $this->assertEquals(8, strlen(Token::humanReadableToken()));
    }
}
