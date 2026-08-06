<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * Validation helper.
 */
class Validator
{
    private array $errors = [];

    /**
     * Validate required fields.
     */
    public function required(array $data, array $rules): self
    {
        foreach ($rules as $field => $rule) {
            $label = ucwords(str_replace('_', ' ', $field));

            if (str_contains($rule, 'required') && empty($data[$field]) && $data[$field] !== '0') {
                $this->errors[$field] = "{$label} wajib diisi.";
            }
        }

        return $this;
    }

    /**
     * Validate email format.
     */
    public function email(string $value, string $field = 'email'): self
    {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = 'Format email tidak valid.';
        }

        return $this;
    }

    /**
     * Validate string length.
     */
    public function maxLength(string $value, int $max, string $field): self
    {
        if (strlen($value) > $max) {
            $this->errors[$field] = "{$field} maksimal {$max} karakter.";
        }

        return $this;
    }

    /**
     * Validate MIME type.
     */
    public function mime(array $file, array $allowed, string $field = 'file'): self
    {
        if (!empty($file['tmp_name']) && $file['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed, true)) {
                $this->errors[$field] = 'Tipe file tidak diizinkan.';
            }
        }

        return $this;
    }

    /**
     * Check if validation passed.
     */
    public function passes(): bool
    {
        return empty($this->errors);
    }

    /**
     * Get all errors.
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Get first error.
     */
    public function firstError(): string
    {
        return reset($this->errors) ?: '';
    }
}
