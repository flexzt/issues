<?php

namespace App\Models;

use App\System\base\SystemModel;

/**
 * Class Auth
 *
 * @package App\Models
 */
class Auth extends SystemModel
{
    /**
     * Login a admin
     *
     * @param string $login
     * @param string $password
     *
     */
    public function logIn(string $login, string $password)
    {
        $query = $this->db->prepare(
            "SELECT * FROM admin 

                    WHERE login = :login 
                      AND password = SHA2(password(:password), 512) 
                    LIMIT 1"
        );
        $query->execute([
            ':login'    => $login,
            ':password' => $password,
        ]);

        $result = $query->fetch();

        return $result ? $this->makeSingle($result) : [];
    }
}
