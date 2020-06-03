<?php

namespace App\System\base\Exception;

use App\System\base\Response;
use Exception;

/**
 * Class Argument
 *
 * @package App\System\base\Exception
 */
class Argument extends Exception
{
    public function __construct($message = "Argument was not found for request", $code = Response::HTTP_FORBIDDEN)
    {
        $this->message = $message;
        $this->code    = $code;

        parent::__construct($this->message, $this->code);
    }
}
