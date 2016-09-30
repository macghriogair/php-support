<?php

namespace Macghriogair\Support;

class File
{
    /**
     * Detect whether file encoding is UTF-8
     * @param  string  $file
     *
     * @return boolean
     */
    public static function isUTF8($file)
    {
        $handle = fopen($file, 'r');
        if (! $handle) {
            throw new \Exception('Invalid file handle!');
        }
        while (($line = fgets($handle, 4096)) !== false) {
            if (mb_detect_encoding($line, 'UTF-8,ISO-8859-1,WINDOWS-1252', true) !== 'UTF-8') {
                fclose($handle);
                return false;
            }
        }
        fclose($handle);
        return true;
    }
}
