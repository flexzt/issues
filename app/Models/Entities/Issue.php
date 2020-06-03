<?php

namespace App\Models\Entities;

use App\System\base\EntityBase;

/**
 * Class Issue
 *
 * @property $id       int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT
 * @property $username varchar(255) NOT NULL DEFAULT ''
 * @property $email    varchar(255) NOT NULL default ''
 * @property $comments varchar(255) NOT NULL default ''
 * @package App\Models\Entities
 */
class Issue extends EntityBase
{
    public static $statuses = [
        0 => 'Uncompleted',
        1 => 'Completed',
        2 => 'Uncompleted, Edited by Admin',
        3 => 'Completed, Edited by Admin',
    ];

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status       = $status;
        $this->statusString = static::$statuses[$status];
    }
}
