<?php

namespace App\System\base;

/**
 * Class ClassFactory
 *
 * @package App\System\base
 */
class ClassFactory
{
    public const CONTROLLER = 'Controller';
    public const MODEL      = 'Model';
    public const ENTITIES   = 'Entities';

    /**
     * @param string $class
     * @param string $type
     *
     * @return string
     */
    public static function getClassNamespace(string $class, string $type = 'Controller')
    {
        $class = ucfirst($class);

        switch ($type) {
            case static::MODEL:
                return "App\Models\\$class";
                break;
            case static::ENTITIES:
                return "App\Models\Entities\\$class";
                break;
            case static::CONTROLLER:
            default:
                return "App\Controllers\\$class";
                break;
        }
    }
}
