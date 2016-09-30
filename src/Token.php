<?php

namespace Macghriogair\Support;

use Macghriogair\Support\String;

class Token
{
    /**
     * Generate a random token intended to be handled by a human.
     *
     * @return string
     */
    public static function humanReadableToken()
    {
        return bin2hex(openssl_random_pseudo_bytes(4));
    }

    /**
     * Generate a random string, e.g. for web api access.
     * @param  integer $length
     * @return string
     */
    public static function apiToken($length = 60)
    {
        return String::random($length);
    }
}
