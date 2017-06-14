<?php

namespace Macghriogair\Support;

class Token
{
    /**
     * Generate a random token intended to be handled by a human.
     *
     * @return string
     */
    public static function humanReadableToken(int $length = 4)
    {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }

    /**
     * Generate a random string, e.g. for web api access.
     * @param  integer $length
     * @return string
     */
    public static function apiToken($length = 60)
    {
        return Str::random($length);
    }
}
