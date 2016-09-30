<?php

namespace Macghriogair\Support\Parser;

class KeywordParser
{
    protected static $shouldReplace = array(
        '/\$g|\$b/' => ' ',
        '/\$x|\$c|\$d/' => ' / ',
        '/\$T01 \$U[A-Z,a-z]{4}/' => '',
        '/\$P|@/' => '',
        '/\s\%/' => ' ',
        '/\s\$q,/' => ',',
        '/%/' => ' ',
        '/\$.*/' => ''
    );

    protected static $shouldAppend = array(
       '/\$n[^\$]*|\$l[^\$]*/'
    );

    public static function translate($rawString)
    {
        $appendix = self::buildAppendix($rawString);

        $keyword = self::applyReplacements($rawString);

        return $keyword.$appendix;
    }

    private static function applyReplacements($rawString)
    {
        foreach (self::$shouldReplace as $regex => $replace) {
            $rawString = trim(preg_replace($regex, $replace, $rawString));
        }
        return $rawString;
    }

    private static function buildAppendix($rawString)
    {
        $appendix = "";
        foreach (self::$shouldAppend as $match) {
            if (preg_match($match, $rawString)) {
                $appendix .= " <".self::extractAppendix($rawString, $match, '\$').">";
            }
        }
        return $appendix;
    }

    private static function extractAppendix($text, $start, $end)
    {
        $appendix = "";

        preg_match_all($start, $text, $matches);
        for ($a = 0; $a < count($matches); $a++) {
            for ($b = 0; $b < count($matches[$a]); $b++) {
                $appendix .= $b > 0 ? ", " : "";
                $appendix .= trim(substr($matches[$a][$b], 2));
                if (strpos($appendix, $end)) {
                    $appendix = preg_replace('/'.$end.'.*/', "", $appendix);
                }
            }
        }
        return $appendix;
    }
}
