<?php

define('ENVIRONMENT', 'dev');

return [

    'siteUrl'  => 'beejeetest.com',
    'basePath' => dirname(__DIR__),

    'database' => [
        'driver'   => 'Pdo',
        'dsn'      => 'mysql:host=localhost;dbname=beejeetest;',
        'username' => 'root',
        'password' => 'root',
        'options'  => [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4;',
        ],

    ],
    'routes'   => [
        '/^\/$/m'                  => [
            'controller' => 'issue',
            'action'     => 'list',
            'parameters' => [],
        ],
        '/^\/logout\/$/m'          => [
            'controller' => 'auth',
            'action'     => 'logout',
            'parameters' => [],
        ],
        '/^\/login\/$/m'           => [
            'controller' => 'auth',
            'action'     => 'login',
            'parameters' => [],
        ],
        '/\/(.+)\/(.+)\/(\d*)\//m' => ['controller', 'action', 'parameters'],
        '/\/(.+)\/(.+)\//m'        => ['controller', 'action'],
    ],
];