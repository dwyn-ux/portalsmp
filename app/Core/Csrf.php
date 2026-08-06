<?php

declare(strict_types=1);

/**
 * CSRF Protection helper.
 */

namespace App\Core;

class Csrf
{
    /**
     * Generate CSRF token.
     */
    public static function generate(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            self::initSession();
        }

        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    /**
     * Get current CSRF token, generate if not exists.
     */
    public static function token(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            self::initSession();
        }

        if (empty($_SESSION['csrf_token'])) {
            return self::generate();
        }

        return $_SESSION['csrf_token'];
    }

    /**
     * Validate CSRF token.
     */
    public static function verify(string $token): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            self::initSession();
        }

        if (empty($_SESSION['csrf_token']) || empty($token)) {
            return false;
        }

        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Get hidden input field.
     */
    public static function field(): string
    {
        return '<input type="hidden" name="_token" value="' . htmlspecialchars(self::token(), ENT_QUOTES, 'UTF-8') . '">';
    }

    /**
     * Initialize session if not active.
     */
    private static function initSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
