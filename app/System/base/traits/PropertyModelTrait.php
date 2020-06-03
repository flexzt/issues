<?php

namespace App\System\base\traits;

use App\System\base\Exception\Argument;

/**
 * Trait PropertyModelTrait
 *
 * @package App\System\base\traits
 */
trait PropertyModelTrait
{

    /**
     * @param $name
     * @param $value
     *
     * @return $this
     * @throws Argument
     */
    public function __call($name, $value)
    {
        $property = lcfirst($name);
        if (property_exists($this, $property)) {
            $this->$property = $value;

            return $this;
        }
        throw $this->_getExceptionForImplementation($name);
    }

    /**
     * @param $method
     *
     * @return Argument
     */
    protected function _getExceptionForImplementation($method)
    {
        return new Argument("{$method} method not implemented");
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            return $this->$name ?? null;
        }
    }

    /**
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    public function __set($name, $value)
    {
        try {
            $method = 'set' . ucfirst($name);
            $this->$method($value);
        } catch (Argument $e) {
            $this->$name = $value;
        }
    }

    /**
     * @param $array
     *
     * @return \stdClass
     */
    public function toQbject($array)
    {
        $result = new \stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result->{$key} = self::toObject($value);
            } else {
                $result->{$key} = $value;
            }
        }

        return $result;
    }

    public function toArray($object)
    {
        return (array)$object;
    }
}
