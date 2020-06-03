<?php

namespace App\System\base;

use App\System\Http\Renderers\WebPageRenderer;

/**
 * Class RendererFactory
 *
 * @package App\System\base
 */
abstract class RendererFactory
{
    protected $page;

    /**
     * @var Controller
     */
    protected $controller;

    /**
     * RendererFactory constructor.
     *
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @param $controller
     *
     * @return WebPageRenderer
     */
    public static function getRenderer($controller)
    {
        return new WebPageRenderer($controller);
    }

    /**
     * @param $action
     * @param $parameters
     *
     * @return mixed
     */
    abstract function render($action, $parameters);
}
