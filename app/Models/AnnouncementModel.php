<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Announcement model.
 */
class AnnouncementModel extends Model
{
    protected string $table = 'announcements';

    /**
     * Get active running announcements.
     */
    public function getRunning(): array
    {
        $stmt = self::db()->query(
            "SELECT * FROM `announcements`
             WHERE `is_active` = 1 AND `is_running` = 1 AND `deleted_at` IS NULL
             AND (`starts_at` IS NULL OR `starts_at` <= NOW())
             AND (`expires_at` IS NULL OR `expires_at` >= NOW())
             ORDER BY `created_at` DESC"
        );
        return $stmt->fetchAll();
    }

    /**
     * Get all announcements with creator name.
     */
    public function getAllWithCreator(): array
    {
        $stmt = self::db()->query(
            "SELECT a.*, u.name as creator_name
             FROM `announcements` a
             LEFT JOIN `users` u ON a.created_by = u.id
             WHERE a.deleted_at IS NULL
             ORDER BY a.created_at DESC"
        );
        return $stmt->fetchAll();
    }

    /**
     * Create announcement.
     */
    public function create(array $data): int
    {
        $stmt = self::db()->prepare(
            "INSERT INTO `announcements` (`title`, `content`, `is_active`, `is_running`, `priority`, `starts_at`, `expires_at`, `created_by`, `created_at`, `updated_at`)
             VALUES (:title, :content, :is_active, :is_running, :priority, :starts_at, :expires_at, :created_by, NOW(), NOW())"
        );

        $stmt->execute([
            'title' => $data['title'],
            'content' => $data['content'],
            'is_active' => $data['is_active'] ?? 1,
            'is_running' => $data['is_running'] ?? 0,
            'priority' => $data['priority'] ?? 'medium',
            'starts_at' => $data['starts_at'] ?? null,
            'expires_at' => $data['expires_at'] ?? null,
            'created_by' => $data['created_by'] ?? null,
        ]);

        return (int) self::db()->lastInsertId();
    }

    /**
     * Update announcement.
     */
    public function update(int $id, array $data): bool
    {
        $fields = [];
        $params = ['id' => $id];

        foreach ($data as $key => $value) {
            $fields[] = "`{$key}` = :{$key}";
            $params[$key] = $value;
        }

        $fields[] = "`updated_at` = NOW()";

        $stmt = self::db()->prepare(
            "UPDATE `announcements` SET " . implode(', ', $fields) . " WHERE `id` = :id AND `deleted_at` IS NULL"
        );

        return $stmt->execute($params);
    }

    /**
     * Count active announcements.
     */
    public function countActive(): int
    {
        $stmt = self::db()->query(
            "SELECT COUNT(*) as total FROM `announcements` WHERE `is_active` = 1 AND `deleted_at` IS NULL"
        );
        return (int) $stmt->fetch()['total'];
    }
}
