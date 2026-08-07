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

    public function changePassword(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        if (empty($_SESSION['supervisi_user'])) {
            http_response_code(403);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }

        $data = $_POST;
        $lama = $data['password_lama'] ?? '';
        $baru = $data['password_baru'] ?? '';

        if ($lama === '' || $baru === '') {
            http_response_code(422);
            echo json_encode(['error' => 'Semua field wajib diisi']);
            exit;
        }

        if (strlen($baru) < 6) {
            http_response_code(422);
            echo json_encode(['error' => 'Password minimal 6 karakter']);
            exit;
        }

        $db = Database::getInstance();
        $userId = (int) $_SESSION['supervisi_user']['id'];

        $stmt = $db->prepare('SELECT password FROM supervisi_users WHERE id = ?');
        $stmt->execute([$userId]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user || !password_verify($lama, $user['password'])) {
            http_response_code(422);
            echo json_encode(['error' => 'Password lama salah']);
            exit;
        }

        $hash = password_hash($baru, PASSWORD_DEFAULT);
        $stmt2 = $db->prepare('UPDATE supervisi_users SET password = ? WHERE id = ?');
        $stmt2->execute([$hash, $userId]);

        echo json_encode(['ok' => true]);
        exit;
    }
}
