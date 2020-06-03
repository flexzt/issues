<?php

namespace App\System\base;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

/**
 * Class Request
 *
 * @package App\System\base
 */
class Request extends SymfonyRequest
{
    const GET    = 'GET';
    const POST   = 'POST';
    const PUT    = 'PUT';
    const DELETE = 'DELETE';
    const UPDATE = 'UPDATE';
}
