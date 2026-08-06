<?php

declare(strict_types=1);

return [
    'name' => $_ENV['APP_NAME'] ?? 'Portal Digital',
    'url' => $_ENV['APP_URL'] ?? 'http://localhost',
    'env' => $_ENV['APP_ENV'] ?? 'production',
    'key' => $_ENV['APP_KEY'] ?? '',
    'debug' => filter_var($_ENV['APP_DEBUG'] ?? '', FILTER_VALIDATE_BOOLEAN) ?: false,
    'timezone' => $_ENV['TIMEZONE'] ?? 'Asia/Jakarta',
];
