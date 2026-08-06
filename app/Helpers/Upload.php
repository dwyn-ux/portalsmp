<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * Upload helper.
 */
class Upload
{
    /**
     * Handle file upload.
     */
    public static function handle(array $file, string $subfolder = ''): ?string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $config = require dirname(__DIR__, 2) . '/config/upload.php';

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $config['allowed_types'], true)) {
            return null;
        }

        if ($file['size'] > $config['max_size']) {
            return null;
        }

        $filename = bin2hex(random_bytes(16)) . '.' . $ext;
        $destination = $config['upload_path'];

        if ($subfolder) {
            $destination .= rtrim($subfolder, '/') . '/';
        }

        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $fullPath = $destination . $filename;

        if (!move_uploaded_file($file['tmp_name'], $fullPath)) {
            return null;
        }

        return $config['public_path'] . ($subfolder ? rtrim($subfolder, '/') . '/' : '') . $filename;
    }

    /**
     * Delete file.
     */
    public static function delete(string $path): bool
    {
        $fullPath = dirname(__DIR__, 2) . '/public' . $path;

        if (file_exists($fullPath) && is_file($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }
}
