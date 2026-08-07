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
        }

        if ($method === 'PUT') {
            $id = (int) ($data['id'] ?? 0);
            if ($id <= 0) { $this->json(['error' => 'id wajib'], 422); }
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
        }

        if ($method === 'DELETE') {
            $id = (int) ($data['id'] ?? 0);
            if ($id <= 0) { $this->json(['error' => 'id wajib'], 422); }
            $this->model->deleteGuru($id);
            $this->json(['ok' => true]);
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
