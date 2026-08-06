<?php

declare(strict_types=1);

/**
 * Application bootstrap.
 */

namespace App\Core;

use Dotenv\Dotenv;

class App
{
    /**
     * Bootstrap the application.
     */
    public static function init(): void
    {
        $baseDir = dirname(__DIR__, 2);

        if (file_exists($baseDir . '/.env')) {
            $dotenv = Dotenv::createImmutable($baseDir);
            $dotenv->safeLoad();
        }

        $appConfig = require $baseDir . '/config/app.php';

        if (!empty($appConfig['timezone'])) {
            date_default_timezone_set($appConfig['timezone']);
        }

        if (session_status() === PHP_SESSION_NONE) {
            $sessionConfig = require $baseDir . '/config/session.php';

            ini_set('session.cookie_lifetime', (string) ($sessionConfig['lifetime'] * 60));
            ini_set('session.cookie_httponly', $sessionConfig['httponly'] ? '1' : '0');
            ini_set('session.cookie_samesite', $sessionConfig['samesite']);
            ini_set('session.use_strict_mode', '1');

            if ($sessionConfig['secure']) {
                ini_set('session.cookie_secure', '1');
            }

            session_name($sessionConfig['name']);
            session_start();
        }

        spl_autoload_register(function (string $class): void {
            $prefix = 'App\\';
            if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
                return;
            }

            $relative = substr($class, strlen($prefix));
            $file = dirname(__DIR__, 2) . '/app/' . str_replace('\\', '/', $relative) . '.php';

            if (file_exists($file)) {
                require_once $file;
            }
        });
    }

    /**
     * Run the application.
     */
    public static function run(): void
    {
        self::init();

        $config = require dirname(__DIR__, 2) . '/config/paths.php';
        $router = require $config['routes'];

        $router->dispatch();
    }
}
