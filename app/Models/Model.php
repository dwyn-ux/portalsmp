<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Base model.
 */
abstract class Model
{
    protected string $table = '';
    protected string $primaryKey = 'id';

    /**
     * Get PDO instance.
     */
    protected static function db(): \PDO
    {
        return \App\Core\Database::getInstance();
    }

    /**
     * Find by primary key.
     */
    public function find(int $id): ?array
    {
        $stmt = self::db()->prepare("SELECT * FROM `{$this->table}` WHERE `{$this->primaryKey}` = :id AND `deleted_at` IS NULL");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Find all records.
     */
    public function all(): array
    {
        $stmt = self::db()->query("SELECT * FROM `{$this->table}` WHERE `deleted_at` IS NULL ORDER BY `created_at` DESC");
        return $stmt->fetchAll();
    }

    /**
     * Find with conditions.
     */
    public function where(string $column, mixed $value): self
    {
        // Simple inline approach
        return $this;
    }

    /**
     * Count all records.
     */
    public function count(): int
    {
        $stmt = self::db()->query("SELECT COUNT(*) as total FROM `{$this->table}` WHERE `deleted_at` IS NULL");
        return (int) $stmt->fetch()['total'];
    }

    /**
     * Soft delete.
     */
    public function softDelete(int $id): bool
    {
        $stmt = self::db()->prepare("UPDATE `{$this->table}` SET `deleted_at` = NOW() WHERE `{$this->primaryKey}` = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Convert to array.
     */
    public function toArray(array $row): array
    {
        return $row;
    }
}
