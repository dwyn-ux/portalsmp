<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Application model.
 */
class ApplicationModel extends Model
{
    protected string $table = 'applications';

    /**
     * Find by slug.
     */
    public function findBySlug(string $slug): ?array
    {
        $stmt = self::db()->prepare(
            "SELECT a.*, c.name as category_name, c.slug as category_slug, c.icon as category_icon, c.color as category_color
             FROM `applications` a
             JOIN `categories` c ON a.category_id = c.id
             WHERE a.slug = :slug AND a.deleted_at IS NULL"
        );
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Get active applications.
     */
    public function getActive(string $category = '', string $target = ''): array
    {
        $sql = "SELECT a.*, c.name as category_name, c.slug as category_slug, c.icon as category_icon, c.color as category_color
                FROM `applications` a
                JOIN `categories` c ON a.category_id = c.id
                WHERE a.status = 'active' AND a.deleted_at IS NULL";

        $params = [];

        if ($category) {
            $sql .= " AND c.slug = :category";
            $params['category'] = $category;
        }

        if ($target) {
            $sql .= " AND (a.target_user = 'semua' OR a.target_user = :target)";
            $params['target'] = $target;
        }

        $sql .= " ORDER BY a.sort_order ASC, a.name ASC";

        $stmt = self::db()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Create application.
     */
    public function create(array $data): int
    {
        $stmt = self::db()->prepare(
            "INSERT INTO `applications` (`name`, `slug`, `description`, `short_description`, `logo`, `url`,
             `category_id`, `target_user`, `icon_color`, `sort_order`, `status`, `version`, `developer`,
             `features`, `is_featured`, `created_at`, `updated_at`)
             VALUES (:name, :slug, :description, :short_description, :logo, :url,
             :category_id, :target_user, :icon_color, :sort_order, :status, :version, :developer,
             :features, :is_featured, NOW(), NOW())"
        );

        $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null,
            'short_description' => $data['short_description'] ?? null,
            'logo' => $data['logo'] ?? null,
            'url' => $data['url'] ?? '#',
            'category_id' => $data['category_id'],
            'target_user' => $data['target_user'] ?? 'semua',
            'icon_color' => $data['icon_color'] ?? 'emerald',
            'sort_order' => $data['sort_order'] ?? 0,
            'status' => $data['status'] ?? 'active',
            'version' => $data['version'] ?? '1.0.0',
            'developer' => $data['developer'] ?? null,
            'features' => !empty($data['features']) ? json_encode($data['features']) : null,
            'is_featured' => $data['is_featured'] ?? 0,
        ]);

        return (int) self::db()->lastInsertId();
    }

    /**
     * Update application.
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
            "UPDATE `applications` SET " . implode(', ', $fields) . " WHERE `id` = :id AND `deleted_at` IS NULL"
        );

        return $stmt->execute($params);
    }

    /**
     * Paginate applications.
     */
    public function paginate(int $page = 1, int $perPage = 10, string $search = '', string $category = ''): array
    {
        $offset = ($page - 1) * $perPage;
        $where = ["a.deleted_at IS NULL"];
        $params = [];

        if ($search) {
            $where[] = "(a.name LIKE :search OR a.description LIKE :search2)";
            $params['search'] = "%{$search}%";
            $params['search2'] = "%{$search}%";
        }

        if ($category) {
            $where[] = "c.slug = :category";
            $params['category'] = $category;
        }

        $whereClause = implode(' AND ', $where);

        $countStmt = self::db()->prepare(
            "SELECT COUNT(*) as total FROM `applications` a
             JOIN `categories` c ON a.category_id = c.id
             WHERE {$whereClause}"
        );
        $countStmt->execute($params);
        $total = (int) $countStmt->fetch()['total'];

        $stmt = self::db()->prepare(
            "SELECT a.*, c.name as category_name, c.slug as category_slug
             FROM `applications` a
             JOIN `categories` c ON a.category_id = c.id
             WHERE {$whereClause}
             ORDER BY a.sort_order ASC, a.name ASC
             LIMIT :limit OFFSET :offset"
        );

        foreach ($params as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        $stmt->bindValue(':limit', $perPage, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        return [
            'data' => $stmt->fetchAll(),
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'total_pages' => (int) ceil($total / $perPage),
        ];
    }

    /**
     * Increment access count.
     */
    public function incrementAccess(int $id): bool
    {
        $stmt = self::db()->prepare(
            "UPDATE `applications` SET `access_count` = `access_count` + 1 WHERE `id` = :id"
        );
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Search applications.
     */
    public function search(string $query): array
    {
        $stmt = self::db()->prepare(
            "SELECT a.*, c.name as category_name, c.slug as category_slug
             FROM `applications` a
             JOIN `categories` c ON a.category_id = c.id
             WHERE a.deleted_at IS NULL AND a.status = 'active'
             AND (a.name LIKE :q OR a.description LIKE :q2 OR c.name LIKE :q3)
             ORDER BY a.sort_order ASC
             LIMIT 20"
        );
        $stmt->execute(['q' => "%{$query}%", 'q2' => "%{$query}%", 'q3' => "%{$query}%"]);
        return $stmt->fetchAll();
    }
}
