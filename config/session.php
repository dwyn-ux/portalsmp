<?php

declare(strict_types=1);

return [
    'lifetime' => (int) ($_ENV['SESSION_LIFETIME'] ?? 120),
    'name' => $_ENV['SESSION_NAME'] ?? 'portal_smpmu',
    'secure' => ($_ENV['APP_ENV'] ?? '') === 'production',
    'httponly' => true,
    'samesite' => 'Lax',
];
