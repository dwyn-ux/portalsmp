<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Category model.
 */
class CategoryModel extends Model
{
    protected string $table = 'categories';

    /**
     * Find by slug.
     */
    public function findBySlug(string $slug): ?array
    {
        $stmt = self::db()->prepare("SELECT * FROM `categories` WHERE `slug` = :slug AND `deleted_at` IS NULL");
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Get active categories ordered.
     */
    public function getActive(): array
    {
        $stmt = self::db()->query(
            "SELECT * FROM `categories` WHERE `is_active` = 1 AND `deleted_at` IS NULL ORDER BY `sort_order` ASC"
        );
        return $stmt->fetchAll();
    }

    /**
     * Create category.
     */
    public function create(array $data): int
    {
        $stmt = self::db()->prepare(
            "INSERT INTO `categories` (`name`, `slug`, `icon`, `color`, `sort_order`, `is_active`, `created_at`, `updated_at`)
             VALUES (:name, :slug, :icon, :color, :sort_order, :is_active, NOW(), NOW())"
        );

        $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'icon' => $data['icon'] ?? 'academic-cap',
            'color' => $data['color'] ?? 'emerald',
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $data['is_active'] ?? 1,
        ]);

        return (int) self::db()->lastInsertId();
    }

    /**
     * Update category.
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
            "UPDATE `categories` SET " . implode(', ', $fields) . " WHERE `id` = :id AND `deleted_at` IS NULL"
        );

        return $stmt->execute($params);
    }

    /**
     * Get all with app count.
     */
    public function getAllWithCount(): array
    {
        $stmt = self::db()->query(
            "SELECT c.*, COUNT(a.id) as app_count
             FROM `categories` c
             LEFT JOIN `applications` a ON c.id = a.category_id AND a.deleted_at IS NULL
             WHERE c.deleted_at IS NULL
             GROUP BY c.id
             ORDER BY c.sort_order ASC"
        );
        return $stmt->fetchAll();
    }
}
