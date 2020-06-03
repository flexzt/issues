<?php

namespace App\System\base;

use App\System\base\Exception\BadMethodCallException;
use App\System\Context;
use ReflectionClass;

/**
 * Class Controller
 *
 * @package App\System\base
 */
class Controller
{
    /**
     * @var string
     */
    public $template = null;
    /**
     * @var string
     */
    public $layout;
    /**
     * @var array
     */
    public $templateData = [];
    /**
     * @var array
     */
    protected $config;
    /**
     * @var string
     */
    protected $module;
    /**
     * @var string
     */
    protected $basePath;
    /**
     * @var mixed
     */
    protected $model;

    /**
     * Class construct
     *
     * @param array $config
     */
    public function __construct()
    {
        $this->config   = Context::App()->config;
        $this->model    = $this->getModel();
        $this->request  = Context::App()->request;
        $this->response = Context::App()->response;

        $this->layout = 'layouts/app';
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    protected function getModel()
    {
        $model = ClassFactory::getClassNamespace((new ReflectionClass(get_called_class()))->getShortName(), ClassFactory::MODEL);

        return new $model;
    }

    /**
     * Execute an action on the controller.
     *
     * @param string $action
     * @param array  $parameters
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($action, $parameters)
    {
        return call_user_func_array([$this, $action], $parameters);
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param string $action
     * @param array  $parameters
     *
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($action, $parameters)
    {
        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.', static::class, $action
        ));
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function getName()
    {
        if (empty($this->_name)) {
            $this->_name = (new ReflectionClass($this))->getShortName();
        }

        return $this->_name;
    }
}
