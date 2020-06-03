<?php

namespace App\System\base;

use App\System\Http\PageHandler;

/**
 * Class HandlerBase
 *
 * @package SM\HTTP\Contracts
 */
abstract class HandlerBase
{
    /**
     * @return PageHandler
     */
    public static function getHandler()
    {
        return new PageHandler();
    }

    /**
     * @return mixed
     */
    public function run()
    {
        return $this->router->dispatch();
    }
}
