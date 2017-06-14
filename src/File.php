<?php

namespace Macghriogair\Support;

use Macghriogair\Support\Str;

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
            if (! Str::isUTF8($line)) {
                fclose($handle);
                return false;
            }
        }
        fclose($handle);
        return true;
    }
}
