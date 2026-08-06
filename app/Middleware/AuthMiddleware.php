<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Helpers\Url;

/**
 * Authentication middleware.
 */
class AuthMiddleware
{
    /**
     * Check if user is authenticated.
     */
    public static function handle(): void
    {
        if (empty($_SESSION['user'])) {
            Url::redirect('/login');
        }
    }
}
