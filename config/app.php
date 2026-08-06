<?php

declare(strict_types=1);

return [
    'name' => getenv('APP_NAME') ?: 'Portal Digital',
    'url' => getenv('APP_URL') ?: 'http://localhost',
    'env' => getenv('APP_ENV') ?: 'production',
    'key' => getenv('APP_KEY') ?: '',
    'debug' => filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN) ?: false,
    'timezone' => getenv('TIMEZONE') ?: 'Asia/Jakarta',
];
