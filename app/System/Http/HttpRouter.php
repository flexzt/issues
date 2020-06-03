<?php

namespace App\System\Http;

use App\System\base\Exception\RouteNotFoundException;
use App\System\Http\Routing\DefaultRouting;
use App\System\base\RouterBase;
use App\System\Context;
use App\System\Contracts\Http\RouterInterface;

/**
 * Class HttpRouter
 *
 * @package App\System\base\Http
 */
class HttpRouter extends RouterBase implements RouterInterface
{
    /**
     * @var string[]
     */
    protected static $_routingRegistry = [
        DefaultRouting::class,
    ];
    /**
     * @var null
     */
    public $controller = null;
    /**
     * @var null
     */
    public $action     = null;
    /**
     * @var array
     */
    public $parameters = [];

    /**
     * @param null $url
     *
     * @return mixed|void
     * @throws RouteNotFoundException
     */
    public function dispatch($url = null)
    {
        $this->parseURL($url ?? Context::Request()->getRequestUri());
        $this->doRoute();
    }

    /**
     * @return bool
     * @throws RouteNotFoundException
     */
    protected function doRoute()
    {
        foreach (static::$_routingRegistry as $route) {
            if ((new $route($this))->route()) {
                return true;
            }
        }

        throw new RouteNotFoundException('Requested URL can not be despatched');
    }
}
