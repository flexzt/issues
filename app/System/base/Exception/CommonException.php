<?php

namespace App\System\base\Exception;

use Exception;

/**
 * Class CommonException
 *
 * @package App\System\base\Exception
 */
class CommonException extends Exception
{
    protected $exceptionData = [];

    /**
     * CommonException constructor.
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
