<?php

namespace Macghriogair\Support;

class Str
{
    /**
     * Determine if a given string contains a given substring.
     *
     * from https://github.com/illuminate/support/blob/master/Str.php
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    public static function contains($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle != '' && mb_strpos($haystack, $needle) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * from https://github.com/illuminate/support/blob/master/Str.php
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    public static function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle != '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if a given string ends with a given substring.
     *
     * from https://github.com/illuminate/support/blob/master/Str.php
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    public static function endsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if (substr($haystack, -strlen($needle)) === (string) $needle) {
                return true;
            }
        }
        return false;
    }


    /**
     * Return the length of the given string.
     *
     * from https://github.com/illuminate/support/blob/master/Str.php
     *
     * @param  string  $value
     * @return int
     */
    public static function length($value)
    {
        return mb_strlen($value);
    }

    /**
     * Generate a more truly "random" alpha-numeric string.
     *
     * from https://github.com/illuminate/support/blob/master/Str.php
     *
     * @param  int  $length
     * @return string
     */
    public static function random($length = 16)
    {
        $string = '';
        while (($len = strlen($string)) < $length) {
            $size = $length - $len;
            $bytes = random_bytes($size);
            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }
        return $string;
    }

    /**
     * Run multiple sanitizations on user input string, e.g. for save filenames.
     *
     * @param  string $str
     * @return string
     */
    public static function sanitize($str = '')
    {
        $str = strip_tags($str);
        $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
        $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
        $str = strtolower($str);
        $str = html_entity_decode($str, ENT_QUOTES, "utf-8");
        $str = htmlentities($str, ENT_QUOTES, "utf-8");
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = str_replace(' ', '-', $str);
        $str = rawurlencode($str);
        $str = str_replace('%', '-', $str);
        return $str;
    }

    public static function replaceUmlauts($str = '')
    {
        $umlauts = ['/ä/', '/ö/', '/ü/', '/Ä/', '/Ö/', '/Ü/', '/ß/'];
        $replace = ['ae', 'oe', 'ue', 'Ae', 'Oe', 'Ue', 'ss'];
        return preg_replace($umlauts, $replace, $str);
    }

    /**
     * Determine whether a string can be interpreted as date
     *
     * Currently only d.m.Y, but can be extended easily.
     *
     * @param  string $dateString
     * @return boolean
     */
    public static function isDateParseable($dateString)
    {
        // i.e. "21.07.1998"
        return preg_match('/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/', $dateString);
    }

    /**
     * Determine whether a string contaoins only UTF-8 chars.
     *
     * @param  string $str
     * @return boolean
     */
    public static function isUTF8($str)
    {
        return mb_detect_encoding($str, 'UTF-8,ISO-8859-1,WINDOWS-1252', true) === 'UTF-8';
    }
}
