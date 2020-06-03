<?php

namespace App\System;

use App\System\base\ArrayMethods;
use App\System\base\traits\PropertyModelTrait;

class Configuration
{
    use PropertyModelTrait;

    public function __construct($config = [])
    {
        foreach ($config as $key => $configSection) {
            $this->{$key} = is_array($configSection) ? ArrayMethods::toObject($configSection) : $configSection;
        }
    }
}
