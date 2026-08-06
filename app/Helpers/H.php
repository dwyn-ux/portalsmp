<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * HTML escape helper.
 */
class H
{
    /**
     * Escape HTML output.
     */
    public static function e(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }

    /**
     * Escape and echo.
     */
    public static function ee(?string $value): void
    {
        echo self::e($value);
    }
}
