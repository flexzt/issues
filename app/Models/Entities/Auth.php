<?php

namespace App\Models\Entities;

use App\System\base\EntityBase;

/**
 * Class Auth
 *
 * @property $id       int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT
 * @property $login    varchar(255) NOT NULL DEFAULT ''
 * @property $email    varchar(255) NOT NULL default ''
 * @property $password varchar(255) NOT NULL default ''
 * @package App\Models\Entities
 */
class Auth extends EntityBase
{
}
