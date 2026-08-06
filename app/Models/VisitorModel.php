<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Visitor log model.
 */
class VisitorModel extends Model
{
    protected string $table = 'visitor_logs';

    /**
     * Log visitor.
     */
    public function log(string $ip, string $url, ?int $userId = null): bool
    {
        $stmt = self::db()->prepare(
            "INSERT INTO `visitor_logs` (`ip_address`, `user_agent`, `url`, `user_id`, `created_at`)
             VALUES (:ip, :ua, :url, :uid, NOW())"
        );

        return $stmt->execute([
            'ip' => $ip,
            'ua' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 500),
            'url' => $url,
            'uid' => $userId,
        ]);
    }

    /**
     * Count today's visitors.
     */
    public function countToday(): int
    {
        $stmt = self::db()->query(
            "SELECT COUNT(DISTINCT ip_address) as total FROM `visitor_logs` WHERE DATE(created_at) = CURDATE()"
        );
        return (int) $stmt->fetch()['total'];
    }

    /**
     * Count this month visitors.
     */
    public function countThisMonth(): int
    {
        $stmt = self::db()->query(
            "SELECT COUNT(DISTINCT ip_address) as total FROM `visitor_logs`
             WHERE MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW())"
        );
        return (int) $stmt->fetch()['total'];
    }

    /**
     * Get visitor chart data (last 7 days).
     */
    public function getChart(int $days = 7): array
    {
        $stmt = self::db()->prepare(
            "SELECT DATE(created_at) as date, COUNT(DISTINCT ip_address) as visitors
             FROM `visitor_logs`
             WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL :days DAY)
             GROUP BY DATE(created_at)
             ORDER BY date ASC"
        );
        $stmt->execute(['days' => $days]);
        return $stmt->fetchAll();
    }
}
