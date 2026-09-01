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

        $headers = [
            'Nama Guru *',
            'Sekolah *',
            'Mata Pelajaran *',
            'Jam Tatap Muka *',
            'Nama Kepsek *',
            'NIP Kepsek *',
            'Tanggal Supervisi (YYYY-MM-DD) *',
            'Keterangan',
        ];

        $samples = [
            ['Ahmad Fauzi, S.Pd.', 'SMP Muhammadiyah 1', 'Matematika', '24', 'Dr. H. Bambang S., M.Pd.', '196805151993011001', '2026-09-15', 'Supervisi Rutin'],
            ['Siti Nurhaliza, S.Pd.', 'SMP Muhammadiyah 2', 'Bahasa Indonesia', '18', 'Dr. H. Ahmad Ridwan, M.Pd.', '196703121992031002', '2026-09-20', 'Supervisi Kelas X'],
        ];

        $this->sendXlsx('template_guru_binaan', $headers, $samples);
    }

    private function sendXlsx(string $filename, array $headers, array $rows): void
    {
        $tmpFile = tempnam(sys_get_temp_dir(), 'xlsx_');
        $zip = new \ZipArchive();
        $zip->open($tmpFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Shared strings
        $strings = array_merge($headers, ...array_map(fn($r) => $r, $rows));
        $stringMap = [];
        $stringXml = '<si>';
        $idx = 0;
        foreach ($strings as $s) {
            $key = (string) $s;
            if (!isset($stringMap[$key])) {
                $stringMap[$key] = $idx++;
                $stringXml .= '<t>' . htmlspecialchars($key, ENT_XML1) . '</t></si><si>';
            }
        }
        $stringXml = substr($stringXml, 0, -4) . '</sst>';
        $stringXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<sst xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" count="' . $idx . '" uniqueCount="' . $idx . '">'
            . $stringXml;

        // Build sheet rows XML
        $sheetXml = '<sheetData>';
        $rowNum = 1;

        // Header row
        $sheetXml .= '<row r="' . $rowNum . '" spans="1:' . count($headers) . '">';
        $col = 'A';
        foreach ($headers as $h) {
            $sheetXml .= '<c r="' . $col . $rowNum . '" t="s" s="1"><v>' . $stringMap[$h] . '</v></c>';
            $col++;
        }
        $sheetXml .= '</row>';
        $rowNum++;

        // Data rows
        foreach ($rows as $row) {
            $sheetXml .= '<row r="' . $rowNum . '" spans="1:' . count($row) . '">';
            $col = 'A';
            foreach ($row as $cell) {
                $sheetXml .= '<c r="' . $col . $rowNum . '" t="s"><v>' . $stringMap[(string) $cell] . '</v></c>';
                $col++;
            }
            $sheetXml .= '</row>';
            $rowNum++;
        }
        $sheetXml .= '</sheetData>';

        // Column widths
        $colCount = count($headers);
        $cols = '';
        $widths = [22, 25, 20, 14, 25, 20, 24, 18];
        for ($i = 0; $i < $colCount; $i++) {
            $w = $widths[$i] ?? 16;
            $cols .= '<col min="' . ($i + 1) . '" max="' . ($i + 1) . '" width="' . $w . '" customWidth="1"/>';
        }

        // Sheet1.xml
        $sheet = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
            . '<cols>' . $cols . '</cols>'
            . $sheetXml
            . '<autoFilter ref="A1:H' . ($rowNum - 1) . '"/>'
            . '</worksheet>';

        // [Content_Types].xml
        $contentTypes = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
            . '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
            . '<Default Extension="xml" ContentType="application/xml"/>'
            . '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
            . '<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'
            . '<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
            . '<Override PartName="/xl/sharedStrings.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sharedStrings+xml"/>'
            . '</Types>';

        // _rels/.rels
        $rels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
            . '</Relationships>';

        // xl/_rels/workbook.xml.rels
        $wbRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
            . '<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>'
            . '<Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/sharedStrings" Target="sharedStrings.xml"/>'
            . '</Relationships>';

        // xl/workbook.xml
        $workbook = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
            . '<sheets><sheet name="Template Guru" sheetId="1" r:id="rId1"/></sheets>'
            . '</workbook>';

        // xl/styles.xml - minimal with bold header style
        $styles = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            . '<fonts count="2">'
            . '<font><sz val="11"/><name val="Calibri"/></font>'
            . '<font><b/><sz val="11"/><name val="Calibri"/></font>'
            . '</fonts>'
            . '<fills count="3">'
            . '<fill><patternFill patternType="none"/></fill>'
            . '<fill><patternFill patternType="gray125"/></fill>'
            . '<fill><patternFill patternType="solid"><fgColor rgb="FF1E3A5F"/></patternFill></fill>'
            . '</fills>'
            . '<borders count="1"><border><left/><right/><top/><bottom/><diagonal/></border></borders>'
            . '<cellStyleXfs count="1"><xf/></cellStyleXfs>'
            . '<cellXfs count="2">'
            . '<xf/><xf fontId="1" fillId="2" borderId="0" applyFont="1" applyFill="1"/>'
            . '</cellXfs>'
            . '</styleSheet>';

        $zip->addFromString('[Content_Types].xml', $contentTypes);
        $zip->addFromString('_rels/.rels', $rels);
        $zip->addFromString('xl/workbook.xml', $workbook);
        $zip->addFromString('xl/_rels/workbook.xml.rels', $wbRels);
        $zip->addFromString('xl/worksheets/sheet1.xml', $sheet);
        $zip->addFromString('xl/sharedStrings.xml', $stringXml);
        $zip->addFromString('xl/styles.xml', $styles);
        $zip->close();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        header('Content-Length: ' . filesize($tmpFile));
        readfile($tmpFile);
        unlink($tmpFile);
        exit;
    }

    public function apiGuruBulk(): void
    {
        if (!$this->requireRole()) { $this->deny(); }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['error' => 'Method not allowed'], 405);
        }

        if (empty($_FILES['file']['name'])) {
            $this->json(['error' => 'Pilih file XLSX'], 422);
        }

        $file = $_FILES['file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if ($ext !== 'xlsx') {
            $this->json(['error' => 'Format file tidak didukung. Gunakan file .xlsx'], 422);
        }

        try {
            $rows = $this->parseXlsx($file['tmp_name']);

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
                $jtm = trim($row[3] ?? '');
                $kepsekNama = trim($row[4] ?? '');
                $kepsekNip = trim($row[5] ?? '');
                $tglSupervisi = trim($row[6] ?? '');
                $keterangan = trim($row[7] ?? '');

                if ($nama === '' || $sekolah === '' || $mapel === '' || $jtm === '' || $kepsekNama === '' || $kepsekNip === '' || $tglSupervisi === '') {
                    $errors[] = 'Baris ' . ($i + 2) . ': Semua kolom wajib diisi (Nama, Sekolah, Mapel, JTM, Nama Kepsek, NIP Kepsek, Tanggal Supervisi)';
                    continue;
                }

                try {
                    $this->model->createGuru([
                        'nama' => $nama,
                        'sekolah' => $sekolah,
                        'mapel' => $mapel,
                        'jam_tatap_muka' => (int) $jtm,
                        'kepsek_nama' => $kepsekNama,
                        'kepsek_nip' => $kepsekNip,
                        'tanggal_supervisi' => $tglSupervisi,
                        'keterangan' => $keterangan,
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

        // Fallback: parse XLSX manual via ZipArchive + XML
        $zip = new \ZipArchive();
        if ($zip->open($tmpPath) === true) {
            // 1) Load shared strings table
            $sharedStrings = [];
            $ssXml = $zip->getFromName('xl/sharedStrings.xml');
            if ($ssXml) {
                $ssDoc = new \DOMDocument();
                $ssDoc->loadXML($ssXml);
                $siNodes = $ssDoc->getElementsByTagNameNS('http://schemas.openxmlformats.org/spreadsheetml/2006/main', 'si');
                foreach ($siNodes as $si) {
                    // Each <si> may contain one <t> or multiple <r><t> (rich text)
                    $text = '';
                    $tNodes = $si->getElementsByTagNameNS('http://schemas.openxmlformats.org/spreadsheetml/2006/main', 't');
                    foreach ($tNodes as $t) {
                        $text .= $t->textContent;
                    }
                    $sharedStrings[] = $text;
                }
            }

            // 2) Parse sheet rows
            $xml = $zip->getFromName('xl/worksheets/sheet1.xml');
            $zip->close();

            if ($xml) {
                $rows = [];
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
                        // Baca referensi kolom (A1, B2, dst) lalu convert ke index
                        $ref = $cell->getAttribute('r'); // e.g. "C3"
                        preg_match('/^([A-Z]+)/', $ref, $m);
                        $colIdx = 0;
                        if (isset($m[1])) {
                            foreach (str_split($m[1]) as $ch) {
                                $colIdx = $colIdx * 26 + (ord($ch) - 64);
                            }
                            $colIdx--; // 0-based
                        }

                        $val = '';
                        $type = $cell->getAttribute('t');

                        if ($type === 'inlineStr') {
                            // Inline string: <is><t>text</t></is>
                            $isNodes = $cell->getElementsByTagNameNS('http://schemas.openxmlformats.org/spreadsheetml/2006/main', 't');
                            foreach ($isNodes as $t) {
                                $val .= $t->textContent;
                            }
                        } else {
                            $vNodes = $cell->getElementsByTagNameNS('http://schemas.openxmlformats.org/spreadsheetml/2006/main', 'v');
                            if ($vNodes->length > 0) {
                                $raw = $vNodes->item(0)->textContent;
                                if ($type === 's' && isset($sharedStrings[(int) $raw])) {
                                    $val = $sharedStrings[(int) $raw];
                                } else {
                                    $val = $raw;
                                }
                            }
                        }

                        $cells[$colIdx] = $val;
                    }
                    // Re-index: isi cell kosong yang tidak ada di XML
                    if (!empty($cells)) {
                        $maxCol = max(array_keys($cells));
                        $row = [];
                        for ($c = 0; $c <= $maxCol; $c++) {
                            $row[] = $cells[$c] ?? '';
                        }
                        if (!empty(array_filter($row))) {
                            $rows[] = $row;
                        }
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
