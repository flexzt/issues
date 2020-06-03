<?php

namespace App\System\base;

use App\System\base\traits\PropertyModelTrait;

/**
 * Class PropertyModel
 *
 * @package App\System\base
 */
class PropertyModel
{
    use PropertyModelTrait;

    /**
     * PropertyModel constructor.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        if ((is_array($options) && !empty($options)) || is_object($options)) {
            foreach ($options as $key => $value) {
                $this->$key = $value;
            }
        } else {
            preg_match_all("|(@property\s*)([a-zA-Z0-9$]*)|", (new \ReflectionClass($this))->getDocComment(), $matches);
            foreach ($matches[2] as $key => $value) {
                $propertyName = rtrim($value, '$');
                $this->$propertyName = '';
            }
        }
    }
}
