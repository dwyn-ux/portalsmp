<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Core\Database;
use App\Helpers\Url;

class SupervisiAuthController
{
    public function showLogin(): void
    {
        if (!empty($_SESSION['supervisi_user'])) {
            Url::redirect('/supervisi');
        }
        View::render('supervisi.login', [
            'title' => 'Login Supervisi',
        ]);
    }

    public function login(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $_SESSION['flash_error'] = 'Username dan password wajib diisi.';
            Url::redirect('/supervisi/login');
        }

        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM supervisi_users WHERE username = ? AND is_active = 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['flash_error'] = 'Username atau password salah.';
            Url::redirect('/supervisi/login');
        }

        session_regenerate_id(true);
        $_SESSION['supervisi_user'] = [
            'id' => (int) $user['id'],
            'username' => $user['username'],
            'name' => $user['name'],
            'role' => $user['role'],
        ];

        $stmt2 = $db->prepare('UPDATE supervisi_users SET last_login_at = NOW() WHERE id = ?');
        $stmt2->execute([$user['id']]);

        Url::redirect('/supervisi');
    }

    public function logout(): void
    {
        unset($_SESSION['supervisi_user']);
        session_regenerate_id(true);
        Url::redirect('/supervisi/login');
    }
}
