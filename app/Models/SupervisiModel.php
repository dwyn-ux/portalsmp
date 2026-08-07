<?php

declare(strict_types=1);

namespace App\Models;

class SupervisiModel extends Model
{
    // ─── Settings ───────────────────────────────────────

    public function getSettings(): array
    {
        $stmt = self::db()->query('SELECT setting_key, setting_value FROM supervisi_settings');
        $result = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $result[$row['setting_key']] = $row['setting_value'];
        }
        return $result;
    }

    public function saveSettings(array $data): void
    {
        $sql = 'INSERT INTO supervisi_settings (setting_key, setting_value) VALUES (?, ?)
                ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)';
        $stmt = self::db()->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->execute([$key, $value]);
        }
    }

    // ─── Guru ───────────────────────────────────────────

    public function getGuruAll(): array
    {
        $stmt = self::db()->query('SELECT * FROM supervisi_guru WHERE deleted_at IS NULL ORDER BY created_at DESC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getGuruById(int $id): ?array
    {
        $stmt = self::db()->prepare('SELECT * FROM supervisi_guru WHERE id = ? AND deleted_at IS NULL');
        $stmt->execute([$id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function createGuru(array $data): int
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO supervisi_guru ($columns) VALUES ($placeholders)";
        $stmt = self::db()->prepare($sql);
        $stmt->execute(array_values($data));
        return (int) self::db()->lastInsertId();
    }

    public function updateGuru(int $id, array $data): bool
    {
        $set = implode(', ', array_map(fn($k) => "$k = ?", array_keys($data)));
        $sql = "UPDATE supervisi_guru SET $set WHERE id = ? AND deleted_at IS NULL";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([...array_values($data), $id]);
        return $stmt->rowCount() > 0;
    }

    public function deleteGuru(int $id): bool
    {
        $stmt = self::db()->prepare('UPDATE supervisi_guru SET deleted_at = NOW() WHERE id = ? AND deleted_at IS NULL');
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function countGuru(): int
    {
        $stmt = self::db()->query('SELECT COUNT(*) FROM supervisi_guru WHERE deleted_at IS NULL');
        return (int) $stmt->fetchColumn();
    }

    // ─── Penilaian ──────────────────────────────────────

    public function getPenilaianByGuru(int $guruId): array
    {
        $stmt = self::db()->prepare(
            'SELECT * FROM supervisi_penilaian WHERE guru_id = ?'
        );
        $stmt->execute([$guruId]);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $result[$row['instrumen']] = $row;
        }
        return $result;
    }

    public function getPenilaian(int $guruId, string $instrumen): ?array
    {
        $stmt = self::db()->prepare(
            'SELECT * FROM supervisi_penilaian WHERE guru_id = ? AND instrumen = ?'
        );
        $stmt->execute([$guruId, $instrumen]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function savePenilaian(array $data): void
    {
        $guruId = $data['guru_id'];
        $instrumen = $data['instrumen'];
        $aspekValues = is_array($data['aspek_values']) ? json_encode($data['aspek_values']) : ($data['aspek_values'] ?? '{}');

        $sql = 'INSERT INTO supervisi_penilaian
                    (guru_id, instrumen, aspek_values, score, max_score, predicate, tindak_lanjut, is_saved, saved_at, created_by)
                VALUES (?, ?, ?, ?, ?, ?, ?, 1, NOW(), ?)
                ON DUPLICATE KEY UPDATE
                    aspek_values = VALUES(aspek_values),
                    score = VALUES(score),
                    max_score = VALUES(max_score),
                    predicate = VALUES(predicate),
                    tindak_lanjut = VALUES(tindak_lanjut),
                    is_saved = 1,
                    saved_at = NOW()';
        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            $guruId,
            $instrumen,
            $aspekValues,
            $data['score'] ?? 0,
            $data['max_score'] ?? 0,
            $data['predicate'] ?? '',
            $data['tindak_lanjut'] ?? '',
            $data['created_by'] ?? null,
        ]);
    }

    public function getRekap(): array
    {
        $sql = 'SELECT
                    g.id,
                    g.nama,
                    g.sekolah,
                    g.mapel,
                    p.instrumen,
                    p.score,
                    p.max_score,
                    p.predicate
                FROM supervisi_guru g
                LEFT JOIN supervisi_penilaian p ON p.guru_id = g.id
                WHERE g.deleted_at IS NULL
                ORDER BY g.nama ASC';
        $stmt = self::db()->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getStats(): array
    {
        $db = self::db();

        $totalGuru = (int) $db->query('SELECT COUNT(*) FROM supervisi_guru WHERE deleted_at IS NULL')->fetchColumn();

        $sudahDinilai = (int) $db->query(
            'SELECT COUNT(DISTINCT guru_id) FROM supervisi_penilaian WHERE is_saved = 1'
        )->fetchColumn();

        $rataRata = $db->query(
            'SELECT AVG(score) FROM supervisi_penilaian WHERE is_saved = 1'
        )->fetchColumn();

        $perluPembinaan = (int) $db->query(
            'SELECT COUNT(DISTINCT guru_id) FROM supervisi_penilaian WHERE is_saved = 1 AND score < (SELECT AVG(score) FROM supervisi_penilaian WHERE is_saved = 1)'
        )->fetchColumn();

        return [
            'total_guru' => $totalGuru,
            'sudah_dinilai' => $sudahDinilai,
            'rata_rata' => $rataRata !== null ? round((float) $rataRata, 2) : 0,
            'perlu_pembinaan' => $perluPembinaan,
        ];
    }
}
