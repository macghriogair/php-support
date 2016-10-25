<?php
/**
 * @date    2016-10-18
 * @file    JsonableTrait.php
 * @author  Patrick Mac Gregor <macgregor.porta@gmail.com>
 */

namespace Macghriogair\Support\Traits;

trait JsonableTrait
{

    public function jsonSerialize()
    {
        $json = [];
        foreach ($this as $key => $value) {
            $getter = $this->toGetter($key);
            if (method_exists($this, $getter)) {
                $json[$key] = $this->$getter($key);
            } else {
                $json[$key] = $value;
            }
        }
        return $json;
    }

    private function toGetter($key)
    {
        return 'get' . ucfirst($key);
    }
}
