<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Csrf;
use App\Helpers\Url;

/**
 * CSRF verification middleware.
 */
class CsrfMiddleware
{
    /**
     * Handle CSRF check.
     */
    public static function handle(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';

            if (!Csrf::verify($token)) {
                http_response_code(403);
                echo 'CSRF token tidak valid.';
                exit;
            }
        }
    }
}
