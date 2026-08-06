<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * URL helper functions.
 */
class Url
{
    /**
     * Generate URL with base.
     */
    public static function to(string $path = ''): string
    {
        $config = require dirname(__DIR__, 2) . '/config/app.php';
        return rtrim($config['url'], '/') . '/' . ltrim($path, '/');
    }

    /**
     * Generate asset URL.
     */
    public static function asset(string $path): string
    {
        return '/assets/' . ltrim($path, '/');
    }

    /**
     * Generate upload URL.
     */
    public static function upload(string $path): string
    {
        return '/uploads/' . ltrim($path, '/');
    }

    /**
     * Redirect to URL.
     */
    public static function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    /**
     * Redirect back.
     */
    public static function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        header('Location: ' . $referer);
        exit;
    }

    /**
     * Check if current path matches.
     */
    public static function isActive(string $path): string
    {
        $current = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
        $current = rtrim($current, '/') ?: '/';
        $path = rtrim($path, '/') ?: '/';

        return $current === $path ? 'active' : '';
    }
}
