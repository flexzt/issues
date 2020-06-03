<?php

namespace App\System\Http\Routing;

use App\System\Context;
use App\System\Contracts\Http\RouterInterface;
use App\System\Contracts\Http\Routing\RoutingInterface;

/**
 * Class DefaultRouting
 *
 * @package App\System\Http\Routing
 */
class DefaultRouting implements RoutingInterface
{
    /**
     * @var array
     */
    protected $routes;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * DefaultRouting constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
        $this->loadRoutes();
    }

    protected function loadRoutes()
    {
        $this->routes = Context::App()->config->routes;
    }

    /**
     * @return bool|mixed
     */
    public function route()
    {
        foreach ($this->routes as $pattern => $routeMap) {
            if (preg_match($pattern, $this->router->requestUrl, $matches)) {
                if (isset($routeMap->controller)) {
                    $this->router->controller = $routeMap->controller;
                    $this->router->action     = $routeMap->action;
                } else {
                    foreach ($routeMap as $key => $identifier) {
                        if ($identifier === 'parameters') {
                            $this->router->{$identifier} = [$matches[$key + 1]] ?? [];
                        } else {
                            $this->router->{$identifier} = $matches[$key + 1] ?? '';
                        }
                    }
                }

                return true;
            };
        }

        return false;
    }
}
