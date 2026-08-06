<?php

declare(strict_types=1);

namespace App\Models;

/**
 * User model.
 */
class UserModel extends Model
{
    protected string $table = 'users';

    /**
     * Find user by email.
     */
    public function findByEmail(string $email): ?array
    {
        $stmt = self::db()->prepare("SELECT * FROM `users` WHERE `email` = :email AND `deleted_at` IS NULL");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Create new user.
     */
    public function create(array $data): int
    {
        $stmt = self::db()->prepare(
            "INSERT INTO `users` (`name`, `email`, `password`, `role`, `is_active`, `created_at`, `updated_at`)
             VALUES (:name, :email, :password, :role, :is_active, NOW(), NOW())"
        );

        $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'role' => $data['role'] ?? 'siswa',
            'is_active' => $data['is_active'] ?? 1,
        ]);

        return (int) self::db()->lastInsertId();
    }

    /**
     * Update user.
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
            "UPDATE `users` SET " . implode(', ', $fields) . " WHERE `id` = :id AND `deleted_at` IS NULL"
        );

        return $stmt->execute($params);
    }

    /**
     * Paginate users.
     */
    public function paginate(int $page = 1, int $perPage = 10, string $search = ''): array
    {
        $offset = ($page - 1) * $perPage;

        if ($search) {
            $countStmt = self::db()->prepare(
                "SELECT COUNT(*) as total FROM `users` WHERE `deleted_at` IS NULL AND (`name` LIKE :search OR `email` LIKE :search2)"
            );
            $countStmt->execute(['search' => "%{$search}%", 'search2' => "%{$search}%"]);
            $total = (int) $countStmt->fetch()['total'];

            $stmt = self::db()->prepare(
                "SELECT * FROM `users` WHERE `deleted_at` IS NULL AND (`name` LIKE :search OR `email` LIKE :search2)
                 ORDER BY `created_at` DESC LIMIT :limit OFFSET :offset"
            );
            $stmt->bindValue(':search', "%{$search}%", \PDO::PARAM_STR);
            $stmt->bindValue(':search2', "%{$search}%", \PDO::PARAM_STR);
        } else {
            $total = $this->count();
            $stmt = self::db()->prepare(
                "SELECT * FROM `users` WHERE `deleted_at` IS NULL ORDER BY `created_at` DESC LIMIT :limit OFFSET :offset"
            );
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
}
