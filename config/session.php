<?php

declare(strict_types=1);

return [
    'lifetime' => (int) (getenv('SESSION_LIFETIME') ?: 120),
    'name' => getenv('SESSION_NAME') ?: 'portal_smpmu',
    'secure' => getenv('APP_ENV') === 'production',
    'httponly' => true,
    'samesite' => 'Lax',
];
