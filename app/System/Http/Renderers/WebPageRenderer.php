<?php

namespace App\System\Http\Renderers;

use App\System\base\Controller;
use App\System\base\Exception\BadMethodCallException;
use App\System\base\RendererFactory;
use App\System\base\Response;
use App\System\Services\AuthService;
use App\System\View\Blade\Blade;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class WebPageRenderer
 *
 * @package App\System\base\Http\Renderers
 */
class WebPageRenderer extends RendererFactory
{
    /**
     * @var Blade
     */
    protected $view;

    /**
     * WebPageRenderer constructor.
     *
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        parent::__construct($controller);

        $this->view = new Blade();
    }

    /**
     * @param $action
     *
     * @return mixed
     */
    public function render($action, $parameters)
    {
        if (method_exists($this->controller, 'callAction')) {
            try {
                $this->controller->callAction($action, $parameters);
            } catch (BadMethodCallException $e) {
                $this->response = new RedirectResponse('/error', Response::HTTP_PERMANENTLY_REDIRECT);
            }
        }

        if (!$this->controller->template) {
            $this->controller->template = $this->controller->getName() . "/$action";
        }

        $this->view->viewData['title']      = 'Title';
        $this->view->viewData['isLoggedIn'] = AuthService::isLoggedIn();
        $this->view->viewData['layout']     = $this->controller->layout;
        $this->view->viewData['view']       = $this->controller->getName() . "/$action";
        $this->view->viewData['controller'] = $this->controller->getName();
        $this->view->viewData['action']     = $action;

        return $this->renderOutput();
    }

    /**
     * @return string
     */
    protected function renderOutput()
    {
        return $this->view->fetch($this->controller->template, array_merge($this->view->viewData, $this->controller->templateData));
    }
}
