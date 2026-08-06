<?php

declare(strict_types=1);

/**
 * Database connection singleton using PDO.
 */

namespace App\Core;

use PDO;
use PDOException;

final class Database
{
    private static ?PDO $instance = null;

    private function __construct()
    {
    }

    /**
     * Get PDO instance.
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/database.php';

            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['port'],
                $config['database'],
                $config['charset']
            );

            try {
                self::$instance = new PDO($dsn, $config['username'], $config['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$config['charset']}",
                ]);
            } catch (PDOException $e) {
                error_log('Database connection failed: ' . $e->getMessage());
                throw new \RuntimeException('Terjadi kesalahan koneksi database.');
            }
        }

        return self::$instance;
    }
}
