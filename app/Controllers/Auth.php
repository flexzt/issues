<?php

namespace App\Controllers;

use App\System\base\Controller;
use App\System\Services\AuthService;

/**
 * Class Auth
 *
 * @package App\Controllers
 */
class Auth extends Controller
{
    /**
     * Login admin page action
     */
    public function login()
    {
        if (!AuthService::isLoggedIn()) {
            if ($this->request->request->has('login')) {

                if ($admin = $this->model->logIn(
                    $this->request->request->get('login'),
                    $this->request->request->get('password')
                )) {
                    AuthService::createAuth($admin);
                    $this->templateData['success'] = 'Your have been successfully logged in!';
                } else {
                    $this->templateData['errors'][] = 'Incorrect login or password';
                }
            }
        } else {
            header('location: ' . '/');
        }
    }

    /**
     * Logout admin page action
     */
    public function logout()
    {
        if (AuthService::isLoggedIn()) {
            AuthService::deleteAuth();
        }

        header('location: ' . '/');
    }
}
