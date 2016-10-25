<?php
/**
 * @date    2016-10-04
 * @file    HtmlParser.php
 * @author  Patrick Mac Gregor <macgregor.porta@gmail.com>
 */

namespace Macghriogair\Support\Parser;

use Macghriogair\Support\Str;

class HtmlParser
{
    public static function byXpath($htmlString, $query)
    {
        if (! Str::isUTF8($htmlString)) {
            $htmlString = utf8_encode($htmlString);
        }
        $matches = [];
        $dom = new \DOMDocument();
        $dom->loadHTML(mb_convert_encoding($htmlString, 'HTML-ENTITIES', 'UTF-8'));
        $xpath = new \DOMXpath($dom);
        $domeNodeList = $xpath->query($query);

        foreach ($domeNodeList as $node) {
            $matches[] = trim($node->nodeValue);
        }
        return $matches;
    }
}
