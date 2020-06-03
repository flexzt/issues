<?php

namespace App\System\Http;

use App\System\base\ClassFactory;
use App\System\base\HandlerBase;
use App\System\base\RendererFactory;
use App\System\base\Response;
use App\System\Context;

/**
 * Class PageHandler
 *
 * @package App\System\Http
 */
class PageHandler extends HandlerBase
{
    protected $router;
    protected $response;

    /**
     * @return $this
     */
    public function prepare()
    {
        $this->router   = new HttpRouter;
        Context::App()->response = new Response(
            'Content',
            Response::HTTP_OK);

        return $this;
    }

    /**
     * @return mixed|string
     */
    public function run()
    {
        parent::run();

        return $this->dispatch();
    }

    /**
     * @return mixed|string
     */
    protected function dispatch()
    {
        $controller = ClassFactory::getClassNamespace(
            $this->router->getController(),
            ClassFactory::CONTROLLER
        );

        return RendererFactory::getRenderer(
            new $controller(Context::App()->config)
        )->render($this->router->getAction(), $this->router->getParameters());
    }
}
