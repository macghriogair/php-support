<?php

namespace Macghriogair\Support\Parser;

class TextParser
{
    public static function parseWords($text)
    {
        $words = [];
        $matches = preg_split("/(,|\s+)/", $text);
        foreach ($matches as $m) {
            if ('' === $m) {
                continue;
            }
            $words[] = $m;
        }
        return $words;
    }
}
