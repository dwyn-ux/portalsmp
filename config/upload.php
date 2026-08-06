<?php

declare(strict_types=1);

return [
    'max_size' => (int) (getenv('UPLOAD_MAX_SIZE') ?: 5242880),
    'allowed_types' => array_map('trim', explode(',', getenv('UPLOAD_ALLOWED_TYPES') ?: 'jpg,jpeg,png,gif,svg,webp')),
    'upload_path' => __DIR__ . '/../public/uploads/',
    'public_path' => '/uploads/',
];
