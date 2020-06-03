<?php

namespace App\System\Database;

use App\System\Configuration;
use \PDO;

/**
 * Class Connection
 *
 * @package App\System\Database
 */
class Connection
{
    /**
     * @var Configuration
     */
    private $config;

    /**
     * Class construct
     *
     * @param $config $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config->database;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return
            new PDO(
                $this->config->dsn,
                $this->config->username,
                $this->config->password,
                (array)$this->config->options
            );
    }
}
