<?php

namespace App\System\Services;

use App\Models\Entities\Auth;
use App\System\Context;

/**
 * Class AuthService
 *
 * @package App\System\Services
 */
class AuthService
{
    /**
     * Returns is admin logged in
     *
     * @return boolean
     */
    public static function isLoggedIn()
    {
        return self::getActiveSession();
    }

    /**
     * Returns current authentication session
     *
     * @return string $session
     */
    private static function getActiveSession()
    {
        return Context::Session()->has('auth');
    }

    /**
     * Sets all needed data to authenticate a admin
     *
     * @param integer $adminId Id a admin
     *
     */
    public static function createAuth(Auth $admin)
    {
        Context::Session()->set('auth', ['admin_id' => $admin->id]);
    }

    /**
     * Removes all session's components
     */
    public static function deleteAuth()
    {
        Context::Session()->remove('auth');
    }
}
