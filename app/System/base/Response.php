<?php

namespace App\System\base;

use RuntimeException;
use stdClass;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class Response
 *
 * @package App\System\base
 */
class Response extends SymfonyResponse
{

    /** @var string[] */
    public $mimeTypes = [
        'html' => 'text/html',
        'json' => 'application/json',
        'js'   => 'application/javascript',
        'xml'  => 'application/xml',
        'rss'  => 'application/rss+xml',
        'atom' => 'application/atom+xml',
        'txt'  => 'text/plain',
        'css'  => 'text/css',
    ];
    /** @var int */
    protected $code = self::HTTP_OK;
    protected $error;
    protected $data;
    protected $exception;

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    public function __isset($key)
    {
        return isset($this->data->$key);
    }

    public function __unset($key)
    {
        unset($this->data->$key);
    }

    public function __get($key)
    {
        return $this->data->$key;
    }

    public function __set($key, $value)
    {
        $this->assign($key, $value);
    }

    public function assign($key, $value)
    {
        if (!is_string($key)) {
            throw new RuntimeException(__METHOD__ . ': expects parameter 1 to be a string');
        }

        if ($this->data === null) {
            $this->data = new stdClass();
        }

        $this->data->$key = $value;

        return $this;
    }
}