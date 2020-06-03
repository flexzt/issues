<?php

namespace App\System\base\Exception;

use \Exception;

/**
 * Class RouteNotFoundException
 *
 * @package App\System\base\Exception
 */
class RouteNotFoundException extends Exception
{
    protected $exceptionData = [];

    /**
     * RouteNotFoundException constructor.
     *
     * @param       $message
     * @param int   $code
     * @param array $exceptionData
     */
    public function __construct($message, $code = 404, $exceptionData = [])
    {
        parent::__construct($message, $code);
        $this->exceptionData = $exceptionData;
    }

    /**
     * @return array
     */
    public function getExceptionData()
    {
        return $this->exceptionData;
    }
}
