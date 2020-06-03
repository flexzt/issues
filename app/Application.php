<?php

namespace App;

use App\System\base\HandlerBase;
use App\System\base\Request;
use App\System\base\traits\PropertyModelTrait;
use App\System\Configuration;
use App\System\Context;
use App\System\Database\Connection;
use \PDOException;

/**
 * Class Application
 *
 * @property mixed|\PDO db
 * @property mixed|\App\System\base\Request request
 * @property mixed|\App\System\base\Response response
 * @package App
 */
class Application
{
    use PropertyModelTrait;

    /**
     * @var HandlerBase
     */
    protected $handler = null;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * Application constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        Context::Session()->start();

        $this->prepareConfig($config);
        $this->prepareDbConnection();
        $this->prepareRequest();
        $this->prepareHandler();
    }

    /**
     * @param $config
     */
    protected function prepareConfig($config)
    {
        $this->config = new Configuration($config);
    }

    protected function prepareDbConnection()
    {
        try {
            Context::Db($this->db = (new Connection($this->config))->getConnection());
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    protected function prepareRequest()
    {
        $this->request = Request::createFromGlobals();
        Context::Request($this->request);
    }

    protected function prepareHandler()
    {
        $this->handler = HandlerBase::getHandler();
    }

    public function run()
    {
        /** PageHandler handler */
        echo $this->handler->prepare()->run();

        exit();
    }
}
