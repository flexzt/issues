<?php

namespace App\System\base;

use stdClass;

/**
 * Class ArrayMethods
 *
 * @package App\System\base
 */
class ArrayMethods
{
    /**
     * @param array $array
     *
     * @return stdClass
     */
    public static function toObject(array $array)
    {
        $result = new stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result->{$key} = self::toObject($value);
            } else {
                $result->{$key} = $value;
            }
        }

        return $result;
    }
}
