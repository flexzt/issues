<?php

namespace App\System\base;

use App\System\Context;

/**
 * Class RouterBase
 *
 * @property  _routingRegistry
 * @property  action
 * @property  parameters
 * @property  controller
 * @package App\System\base\Http
 */
abstract class RouterBase
{
    /**
     * @return mixed
     */
    abstract function dispatch($url = null);

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Get the key / value list of parameters without null values.
     *
     * @return array
     */
    public function parametersWithoutNulls()
    {
        return array_filter($this->queryParamsArray, function ($p) {
            return !is_null($p);
        });
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    protected function parseURL($url = null)
    {
        $this->setURI($url);
        $this->setHttpMethod($url);
        $this->setRequestUrl($url);
        $this->setCurrentUrl($url);
        $this->setQueryParams($url);

        return $this;
    }

    /**
     * @param $url
     */
    protected function setURI($url)
    {
        $this->uri = $url;
    }

    /**
     * @param null $url
     */
    protected function setHttpMethod($url = null)
    {
        $this->httpMethod = Context::Request()->getMethod();
    }

    /**
     * @param $url
     */
    protected function setRequestUrl($url)
    {
        $this->requestUrl = parse_url($url, PHP_URL_PATH);
    }

    /**
     * @param $url
     */
    protected function setCurrentUrl($url)
    {
        $this->currentUrl = $this->requestUrl;

        if ($this->currentUrl === '/') {
            $this->currentUrl = parse_url(Context::App()->config->siteUrl, PHP_URL_PATH);
        }
    }

    /**
     * @param $url
     */
    protected function setQueryParams($url)
    {
        $this->queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($this->queryString, $this->queryParamsArray);
    }
}
