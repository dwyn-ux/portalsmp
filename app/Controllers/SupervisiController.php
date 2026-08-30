<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Helpers\H;
use App\Helpers\Url;
use App\Models\SupervisiModel;

class SupervisiController
{
    private SupervisiModel $model;

    public function __construct()
    {
        $this->model = new SupervisiModel();
    }

    private function requireRole(): bool
    {
        $user = $_SESSION['supervisi_user'] ?? null;
        return $user !== null;
    }

    private function deny(): void
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) || str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json')) {
            http_response_code(403);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['error' => 'Forbidden']);
            exit;
        }
        Url::redirect('/supervisi/login');
    }

    private function json(mixed $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    private function input(): array
    {
        $ct = $_SERVER['CONTENT_TYPE'] ?? '';
        if (str_contains($ct, 'application/json')) {
            return json_decode(file_get_contents('php://input'), true) ?? [];
        }
        return $_POST;
    }

    public function index(): void
    {
        if (!$this->requireRole()) {
            Url::redirect('/supervisi/login');
        }
        View::render('supervisi.index', [
            'title' => 'Supervisi Akademik Guru',
        ]);
    }

    public function apiGuru(): void
    {
        if (!$this->requireRole()) { $this->deny(); }

        $method = $_GET['_method'] ?? $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
        $data = $this->input();

        if ($method === 'GET') {
            $this->json(['data' => $this->model->getGuruAll()]);
        }

        if ($method === 'POST') {
            $nama = trim($data['nama'] ?? '');
            $sekolah = trim($data['sekolah'] ?? '');
            $mapel = trim($data['mapel'] ?? '');
            if ($nama === '' || $sekolah === '' || $mapel === '') {
                $this->json(['error' => 'nama, sekolah, mapel wajib'], 422);
            }
            try {
                $id = $this->model->createGuru([
                    'nama' => $nama, 'sekolah' => $sekolah, 'mapel' => $mapel,
                    'jam_tatap_muka' => (int) ($data['jam_tatap_muka'] ?? 0),
                    'kepsek_nama' => trim($data['kepsek_nama'] ?? ''),
                    'kepsek_nip' => trim($data['kepsek_nip'] ?? ''),
                    'tanggal_supervisi' => $data['tanggal_supervisi'] ?? null,
                    'keterangan' => trim($data['keterangan'] ?? ''),
                    'created_by' => $_SESSION['supervisi_user']['id'] ?? null,
                ]);
                $this->json(['ok' => true, 'id' => $id]);
            } catch (\Throwable $e) {
                error_log('apiGuru POST error: ' . $e->getMessage());
                $this->json(['error' => 'Gagal menyimpan data guru: ' . $e->getMessage()], 500);
            }
        }

        if ($method === 'PUT') {
            $id = (int) ($data['id'] ?? 0);
            if ($id <= 0) { $this->json(['error' => 'id wajib'], 422); }
            try {
                $this->model->updateGuru($id, [
                    'nama' => trim($data['nama'] ?? ''),
                    'sekolah' => trim($data['sekolah'] ?? ''),
                    'mapel' => trim($data['mapel'] ?? ''),
                    'jam_tatap_muka' => (int) ($data['jam_tatap_muka'] ?? 0),
                    'kepsek_nama' => trim($data['kepsek_nama'] ?? ''),
                    'kepsek_nip' => trim($data['kepsek_nip'] ?? ''),
                    'tanggal_supervisi' => $data['tanggal_supervisi'] ?? null,
                    'keterangan' => trim($data['keterangan'] ?? ''),
                ]);
                $this->json(['ok' => true]);
            } catch (\Throwable $e) {
                error_log('apiGuru PUT error: ' . $e->getMessage());
                $this->json(['error' => 'Gagal memperbarui data guru: ' . $e->getMessage()], 500);
            }
        }

        if ($method === 'DELETE') {
            $id = (int) ($data['id'] ?? 0);
            if ($id <= 0) { $this->json(['error' => 'id wajib'], 422); }
            try {
                $this->model->deleteGuru($id);
                $this->json(['ok' => true]);
            } catch (\Throwable $e) {
                error_log('apiGuru DELETE error: ' . $e->getMessage());
                $this->json(['error' => 'Gagal menghapus data guru: ' . $e->getMessage()], 500);
            }
        }

        $this->json(['error' => 'Method not allowed'], 405);
    }

    public function apiPenilaian(): void
    {
        if (!$this->requireRole()) { $this->deny(); }

        $method = $_GET['_method'] ?? $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $guruId = (int) ($_GET['guru_id'] ?? 0);
            if ($guruId <= 0) { $this->json(['error' => 'guru_id wajib'], 422); }
            $rows = $this->model->getPenilaianByGuru($guruId);
            $grouped = [];
            foreach ($rows as $row) {
                $row['aspek_values'] = json_decode($row['aspek_values'] ?? '{}', true);
                $grouped[$row['instrumen']] = $row;
            }
            $this->json(['data' => $grouped]);
        }

        if ($method === 'POST') {
            $data = $this->input();
            $guruId = (int) ($data['guru_id'] ?? 0);
            $instrumen = trim($data['instrumen'] ?? '');
            if ($guruId <= 0 || $instrumen === '') {
                $this->json(['error' => 'guru_id dan instrumen wajib'], 422);
            }
            try {
                $aspekValues = $data['aspek_values'] ?? '{}';
                if (is_array($aspekValues)) {
                    $aspekValues = json_encode($aspekValues);
                }
                $this->model->savePenilaian([
                    'guru_id' => $guruId,
                    'instrumen' => $instrumen,
                    'aspek_values' => $aspekValues,
                    'score' => (float) ($data['score'] ?? 0),
                    'max_score' => (int) ($data['max_score'] ?? 0),
                    'predicate' => trim($data['predicate'] ?? ''),
                    'tindak_lanjut' => trim($data['tindak_lanjut'] ?? ''),
                    'created_by' => $_SESSION['supervisi_user']['id'] ?? null,
                ]);
                $this->json(['ok' => true]);
            } catch (\Throwable $e) {
                error_log('apiPenilaian POST error: ' . $e->getMessage());
                $this->json(['error' => 'Gagal menyimpan penilaian: ' . $e->getMessage()], 500);
            }
        }

        $this->json(['error' => 'Method not allowed'], 405);
    }

    public function apiSettings(): void
    {
        if (!$this->requireRole()) { $this->deny(); }

        $method = $_GET['_method'] ?? $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $this->json(['data' => $this->model->getSettings()]);
        }

        if ($method === 'POST') {
            $data = $this->input();
            unset($data['_token']);
            $this->model->saveSettings($data);
            $this->json(['ok' => true]);
        }

        $this->json(['error' => 'Method not allowed'], 405);
    }

    public function apiStats(): void
    {
        if (!$this->requireRole()) { $this->deny(); }
        $this->json(['data' => $this->model->getStats()]);
    }

    public function apiRekap(): void
    {
        if (!$this->requireRole()) { $this->deny(); }
        $this->json(['data' => $this->model->getRekap()]);
    }

    public function downloadTemplate(): void
    {
        if (!$this->requireRole()) { $this->deny(); }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="template_guru_binaan.csv"');

        $output = fopen('php://output', 'w');
        // BOM supaya Excel baca UTF-8
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($output, [
            'Nama Guru',
            'Sekolah',
            'Mata Pelajaran',
            'Jam Tatap Muka',
            'Nama Kepsek',
            'NIP Kepsek',
            'Tanggal Supervisi (YYYY-MM-DD)',
            'Keterangan',
        ], ';');
        // Contoh baris
        fputcsv($output, [
            'Ahmad Fauzi, S.Pd.',
            'SMP Muhammadiyah 1',
            'Matematika',
            '24',
            'Dr. H. Bambang S., M.Pd.',
            '196805151993011001',
            '2026-09-15',
            '',
        ], ';');
        fputcsv($output, [
            'Siti Nurhaliza, S.Pd.',
            'SMP Muhammadiyah 2',
            'Bahasa Indonesia',
            '18',
            '',
            '',
            '',
            '',
        ], ';');
        fclose($output);
        exit;
    }

    public function apiGuruBulk(): void
    {
        if (!$this->requireRole()) { $this->deny(); }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['error' => 'Method not allowed'], 405);
        }

        if (empty($_FILES['file']['name'])) {
            $this->json(['error' => 'Pilih file CSV/XLSX'], 422);
        }

        $file = $_FILES['file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, ['csv', 'xlsx', 'xls'])) {
            $this->json(['error' => 'Format file tidak didukung. Gunakan CSV atau XLSX'], 422);
        }

        try {
            $rows = [];

            if ($ext === 'csv') {
                $handle = fopen($file['tmp_name'], 'r');
                if (!$handle) {
                    $this->json(['error' => 'Gagal membuka file'], 500);
                }
                // Skip header
                fgetcsv($handle, 0, ';');
                while (($row = fgetcsv($handle, 0, ';')) !== false) {
                    if (count($row) >= 3 && trim($row[0]) !== '') {
                        $rows[] = $row;
                    }
                }
                fclose($handle);
            } else {
                // XLSX - baca dengan PhpSpreadsheet atau fallback ke simple parser
                $rows = $this->parseXlsx($file['tmp_name']);
            }

            if (empty($rows)) {
                $this->json(['error' => 'File kosong atau format tidak sesuai'], 422);
            }

            $created = 0;
            $errors = [];
            $userId = $_SESSION['supervisi_user']['id'] ?? null;

            foreach ($rows as $i => $row) {
                $nama = trim($row[0] ?? '');
                $sekolah = trim($row[1] ?? '');
                $mapel = trim($row[2] ?? '');

                if ($nama === '' || $sekolah === '' || $mapel === '') {
                    $errors[] = 'Baris ' . ($i + 2) . ': Nama, Sekolah, dan Mapel wajib diisi';
                    continue;
                }

                try {
                    $this->model->createGuru([
                        'nama' => $nama,
                        'sekolah' => $sekolah,
                        'mapel' => $mapel,
                        'jam_tatap_muka' => (int) ($row[3] ?? 0),
                        'kepsek_nama' => trim($row[4] ?? ''),
                        'kepsek_nip' => trim($row[5] ?? ''),
                        'tanggal_supervisi' => !empty($row[6]) ? $row[6] : null,
                        'keterangan' => trim($row[7] ?? ''),
                        'created_by' => $userId,
                    ]);
                    $created++;
                } catch (\Throwable $e) {
                    $errors[] = 'Baris ' . ($i + 2) . ' (' . $nama . '): ' . $e->getMessage();
                }
            }

            $this->json([
                'ok' => true,
                'created' => $created,
                'errors' => $errors,
                'total_rows' => count($rows),
            ]);
        } catch (\Throwable $e) {
            error_log('apiGuruBulk error: ' . $e->getMessage());
            $this->json(['error' => 'Gagal memproses file: ' . $e->getMessage()], 500);
        }
    }

    private function parseXlsx(string $tmpPath): array
    {
        // Coba pakai PhpSpreadsheet kalau ada
        if (class_exists('PhpOffice\PhpSpreadsheet\IOFactory')) {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($tmpPath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = [];
            $started = false;
            foreach ($sheet->getRowIterator() as $row) {
                $cells = [];
                foreach ($row->getCellIterator() as $cell) {
                    $cells[] = (string) $cell->getValue();
                }
                if (!$started) {
                    $started = true;
                    continue; // skip header
                }
                if (!empty(array_filter($cells))) {
                    $rows[] = $cells;
                }
            }
            return $rows;
        }

        // Fallback: konversi XLSX ke CSV pakai temporary
        $zip = new \ZipArchive();
        if ($zip->open($tmpPath) === true) {
            $xml = $zip->getFromName('xl/worksheets/sheet1.xml');
            $zip->close();

            if ($xml) {
                $rows = [];
                // Simple XML parser untuk XLSX
                libxml_use_internal_errors(true);
                $doc = new \DOMDocument();
                $doc->loadXML($xml);
                $ns = $doc->getElementsByTagNameNS('http://schemas.openxmlformats.org/spreadsheetml/2006/main', 'row');

                $started = false;
                foreach ($ns as $row) {
                    if (!$started) {
                        $started = true;
                        continue; // skip header
                    }
                    $cells = [];
                    $cellNodes = $row->getElementsByTagNameNS('http://schemas.openxmlformats.org/spreadsheetml/2006/main', 'c');
                    foreach ($cellNodes as $cell) {
                        $val = '';
                        $vNodes = $cell->getElementsByTagNameNS('http://schemas.openxmlformats.org/spreadsheetml/2006/main', 'v');
                        if ($vNodes->length > 0) {
                            $val = $vNodes->item(0)->textContent;
                        }
                        $cells[] = $val;
                    }
                    if (!empty(array_filter($cells))) {
                        $rows[] = $cells;
                    }
                }
                return $rows;
            }
        }

        return [];
    }

    public function apiUploadLogo(): void
    {
        if (!$this->requireRole()) { $this->deny(); }

        if (empty($_FILES['logo']['name'])) {
            $this->json(['error' => 'Pilih file logo'], 422);
        }

        $logoPath = \App\Helpers\Upload::handle($_FILES['logo'], 'supervisi');
        if (!$logoPath) {
            $this->json(['error' => 'Gagal mengunggah file'], 500);
        }

        // Hapus logo lama
        $old = $this->model->getSettings()['logo'] ?? '';
        if ($old) {
            \App\Helpers\Upload::delete($old);
        }

        $this->model->saveSettings(['logo' => $logoPath]);
        $this->json(['ok' => true, 'url' => $logoPath]);
    }
}
