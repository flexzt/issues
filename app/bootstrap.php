<?php

if (isset($_SERVER) && isset($_SERVER['REMOTE_ADDR']))
{
    $configPHP   = __DIR__ . '/../config/local.php';
    $localConfig = file_exists($configPHP) ? require_once($configPHP) : [];
}

require_once __DIR__ . '/../vendor/autoload.php';