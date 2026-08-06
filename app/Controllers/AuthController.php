<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Csrf;
use App\Core\View;
use App\Helpers\Url;
use App\Models\UserModel;

/**
 * Authentication controller.
 */
class AuthController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Show login page.
     */
    public function showLogin(): void
    {
        if (!empty($_SESSION['user'])) {
            Url::redirect('/admin');
        }

        View::render('auth.login', [
            'title' => 'Login - Portal Digital',
        ]);
    }

    /**
     * Handle login.
     */
    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $token = $_POST['_token'] ?? '';

        if (!Csrf::verify($token)) {
            Url::redirect('/login');
        }

        if (empty($email) || empty($password)) {
            $_SESSION['flash_error'] = 'Email dan password wajib diisi.';
            Url::redirect('/login');
        }

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['flash_error'] = 'Email atau password salah.';
            Url::redirect('/login');
        }

        if (!$user['is_active']) {
            $_SESSION['flash_error'] = 'Akun Anda tidak aktif.';
            Url::redirect('/login');
        }

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'avatar' => $user['avatar'],
        ];

        $this->userModel->update((int) $user['id'], ['last_login_at' => date('Y-m-d H:i:s')]);

        Url::redirect('/admin');
    }

    /**
     * Handle logout.
     */
    public function logout(): void
    {
        session_destroy();
        session_start();
        Url::redirect('/login');
    }
}
