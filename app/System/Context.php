<?php

namespace App\System;

use App\System\base\Exception\CommonException;
use App\System\base\Response;
use App\Application;
use App\System\Database\Connection;
use PDO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class Context
 *
 * @method static Session Session(Session $instance = null)
 * @method static Request
 * @method static DiContainer()
 */
class Context
{
    /** @var array Registered system entities and their Default classes */
    protected static $registry = [
        'Config'   => Configuration::class,
        'Request'  => [Request::class, 'createFromGlobals'],
        'Response' => [Response::class, 'createFromGlobals'],
        'Session'  => Session::class,
        'Admin'    => null,
    ];

    /** @var array Collection of instances */
    protected static $instances = [];

    /**
     * Magic method is triggered when invoking inaccessible methods in a static context
     *
     * @param $name
     * @param $args
     *
     * @return mixed
     * @throws CommonException
     */
    public static function __callStatic($name, $args)
    {
        if (array_key_exists($name, static::$registry)) {
            return static::getInstance($name, static::$registry[$name], $args[0] ?? null);
        }

        throw new CommonException("'$name' not found in Context class");
    }

    /**
     * Check whether $instance isn't null and returns new instance of $class otherwise
     *
     * @param string       $name
     * @param string|array $class
     * @param mixed        $instance
     *
     * @return mixed
     */
    protected static function getInstance($name, $class, $instance)
    {
        return $instance
            ? static::$instances[$name] = $instance
            : isset(static::$instances[$name])
                ? static::$instances[$name]
                : static::$instances[$name] = static::createInstance($class);
    }

    /**
     * Creates an instance of class or calls factory method if callable
     *
     * @param $class
     *
     * @return mixed|null
     */
    protected static function createInstance($class)
    {
        if (!$class) {
            return null;
        }

        if (is_callable($class)) {
            return call_user_func($class);
        }

        return new $class();
    }

    /**
     * Check whether instance already initialized
     *
     * @param string $name
     *
     * @return bool
     */
    public static function hasInstance(string $name)
    {
        if (empty(static::$instances[$name])) {
            return false;
        }

        return true;
    }

    /**
     * Clear all instances
     */
    public static function clearAll(): void
    {
        foreach (static::$instances as $name => $instance) {
            static::clearInstance($name);
        }
    }

    /**
     * @param string $name
     */
    public static function clearInstance(string $name): void
    {
        static::$instances[$name] = null;
        unset(static::$instances[$name]);
    }

    #region [custom]

    /**
     * @param Application|null $instance
     *
     * @return Application
     * @property config;
     */
    public static function App(Application $instance = null): Application
    {
        if ($instance) {
            return static::$instances[__FUNCTION__] = $instance;
        }

        if (!isset(static::$instances[__FUNCTION__])) {
            static::$instances[__FUNCTION__] = new Application(new Configuration([]));
        }

        return static::$instances[__FUNCTION__];
    }

    /**
     * @param Connection|null $instance
     *
     * @return Connection
     */
    public static function DB(PDO $instance = null)
    {
        if (isset($instance)) {
            static::$instances[__FUNCTION__] = $instance;
        }

        if (!isset(static::$instances[__FUNCTION__])) {
            throw new \PDOException('DB connection does not set');
        }

        return static::$instances[__FUNCTION__];
    }

    #endregion
}
