<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Setting model.
 */
class SettingModel extends Model
{
    protected string $table = 'settings';

    /**
     * Get all settings as key-value array.
     */
    public function getAll(): array
    {
        $stmt = self::db()->query("SELECT `key`, `value` FROM `settings`");
        $settings = [];
        while ($row = $stmt->fetch()) {
            $settings[$row['key']] = $row['value'];
        }
        return $settings;
    }

    /**
     * Get setting by key.
     */
    public function get(string $key): ?string
    {
        $stmt = self::db()->prepare("SELECT `value` FROM `settings` WHERE `key` = :key");
        $stmt->execute(['key' => $key]);
        $row = $stmt->fetch();
        return $row ? $row['value'] : null;
    }

    /**
     * Set setting value (insert or update).
     */
    public function set(string $key, ?string $value): bool
    {
        $stmt = self::db()->prepare(
            "INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`)
             VALUES (:key, :value, NOW(), NOW())
             ON DUPLICATE KEY UPDATE `value` = :value2, `updated_at` = NOW()"
        );

        return $stmt->execute([
            'key' => $key,
            'value' => $value,
            'value2' => $value,
        ]);
    }

    /**
     * Bulk update settings.
     */
    public function updateMany(array $settings): bool
    {
        $pdo = self::db();
        $pdo->beginTransaction();

        try {
            foreach ($settings as $key => $value) {
                $this->set($key, $value);
            }

            $pdo->commit();
            return true;
        } catch (\Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }
}
