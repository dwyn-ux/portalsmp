<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Helpers\Url;

/**
 * Role-based middleware.
 */
class RoleMiddleware
{
    /**
     * Check if user has required role.
     */
    public static function handle(): void
    {
        if (empty($_SESSION['user'])) {
            Url::redirect('/login');
        }

        $allowedRoles = func_get_args();
        $allowedRoles = $allowedRoles[0] ?? [];

        $userRole = $_SESSION['user']['role'] ?? '';

        if (!empty($allowedRoles) && !in_array($userRole, $allowedRoles, true)) {
            http_response_code(403);
            echo 'Anda tidak memiliki akses ke halaman ini.';
            exit;
        }
    }
}
