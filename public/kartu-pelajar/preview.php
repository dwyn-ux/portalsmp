<?php
include 'db.php';

$kp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kp_pengaturan LIMIT 1"));

$siswa = null;
$q = mysqli_query($conn, "SELECT * FROM kp_siswa LIMIT 1");
if ($q && mysqli_num_rows($q) > 0) {
    $siswa = mysqli_fetch_assoc($q);
}

if (!$siswa) {
    $siswa = [
        'nama' => 'Ahmad Rizky',
        'nis' => '1001',
        'nisn' => '0081234567',
        'kelas' => '7A',
        'jenis_kelamin' => 'L',
        'tempat_lahir' => 'Jakarta',
        'tanggal_lahir' => '2012-05-15',
    ];
}

$bulan = [1=>'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
$tgl_lahir = '-';
if ($siswa['tanggal_lahir'] && $siswa['tanggal_lahir'] !== '0000-00-00') {
    $t = strtotime($siswa['tanggal_lahir']);
    $tgl_lahir = date('d',$t).' '.$bulan[date('n',$t)].' '.date('Y',$t);
}
$jk = $siswa['jenis_kelamin'] === 'L' ? 'L' : 'P';

$tgl_ttd = '-';
if ($kp['tanggal_ttd'] && $kp['tanggal_ttd'] !== '0000-00-00') {
    $t2 = strtotime($kp['tanggal_ttd']);
    $tgl_ttd = date('d',$t2).' '.$bulan[date('n',$t2)].' '.date('Y',$t2);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview - Kartu Pelajar</title>
    <style>
        body { font-family: Arial; background: #e0e0e0; padding: 30px; }
        h2 { text-align: center; color: #003366; margin-bottom: 20px; }
        .card-row { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-bottom: 30px; }
        .card { width: 340px; height: 212px; border-radius: 8px; overflow: hidden; position: relative; box-shadow: 0 4px 12px rgba(0,0,0,0.3); font-size: 10px; }
        .card-depan { background: linear-gradient(135deg,#1a3a5c,#0d2240); color: #fff; padding: 0; }
        .card-depan .content { position: relative; z-index: 1; padding: 8px 10px; height: 100%; }
        .header-bar { display: flex; align-items: center; gap: 6px; margin-bottom: 6px; }
        .header-bar img.logo { width: 28px; height: 28px; border-radius: 50%; background: #fff; padding: 2px; }
        .school-name { font-weight: bold; font-size: 11px; flex: 1; }
        .foto-box { position: absolute; left: 8px; top: 42px; width: 44px; height: 54px; background: #ccc; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #666; font-size: 9px; }
        .info-col { position: absolute; left: 60px; top: 42px; }
        .info-col p { margin: 2px 0; }
        .qr-box { position: absolute; right: 8px; top: 80px; width: 42px; height: 42px; background: #fff; display: flex; align-items: center; justify-content: center; padding: 2px; }
        .qr-box img { width: 38px; height: 38px; }
        .card-belakang { background: linear-gradient(135deg,#0d2240,#1a3a5c); color: #fff; padding: 12px; height: 100%; }
        .card-belakang .watermark {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-size: 48px; color: rgba(255,255,255,0.08);
            font-weight: bold; z-index: 0;
        }
        .card-belakang .content { position: relative; z-index: 1; height: 100%; display: flex; flex-direction: column; }
        .info-box { background: rgba(255,255,255,0.15); border-radius: 6px; padding: 8px; margin-bottom: 8px; font-size: 9px; line-height: 1.4; }
        .ttd-section { margin-top: auto; text-align: right; }
        .ttd-section .tgl { font-size: 8px; margin-bottom: 2px; }
        .ttd-section .label { font-size: 8px; }
        .ttd-section .ttd-img { width: 48px; height: 22px; margin: 4px auto 0 auto; background: #aaa; }
        .ttd-section .name { font-weight: bold; font-size: 9px; margin-top: 2px; }
        .ttd-section .nip { font-size: 7px; opacity: 0.8; }
        .actions { text-align: center; margin-top: 20px; }
        .actions a { display: inline-block; background: #003366; color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 13px; }
        .actions a:hover { background: #002244; }
    </style>
</head>
<body>
    <h2>Preview Kartu Pelajar</h2>

    <div class="card-row">
        <!-- DEPAN -->
        <div class="card card-depan">
            <div class="content">
                <div class="header-bar">
                    <img src="assets/logo/<?= $kp['logo'] ?: '' ?>" class="logo" onerror="this.style.display='none'">
                    <span class="school-name"><?= htmlspecialchars(strtoupper($kp['nama_sekolah'] ?: 'SMP MUHAMMADIYAH UNGGUlAN ASHIDIQ')) ?></span>
                </div>
                <div class="foto-box">
                    FOTO<br>SISWA
                </div>
                <div class="info-col">
                    <p><strong>Nama:</strong> <?= htmlspecialchars($siswa['nama']) ?></p>
                    <p><strong>NISN:</strong> <?= $siswa['nisn'] ?></p>
                    <p><strong>NIS:</strong> <?= $siswa['nis'] ?></p>
                    <p><strong>TL:</strong> <?= htmlspecialchars($siswa['tempat_lahir']) ?></p>
                    <p><strong>Tgl:</strong> <?= $tgl_lahir ?></p>
                    <p><strong>JK:</strong> <?= $jk ?></p>
                </div>
                <div class="qr-box">
                    <img src="https://api.qrserver.com/v1/png-2d-qr/?size=38x38&data=<?= $siswa['nisn'] ?>" alt="QR">
                </div>
            </div>
        </div>

        <!-- BELAKANG -->
        <div class="card card-belakang">
            <div class="watermark">SMPMU</div>
            <div class="content">
                <div class="info-box">
                    Pemegang kartu ini adalah peserta didik.<br>
                    Jika menemukan, mohon dikembalikan ke:<br>
                    <strong><?= htmlspecialchars($kp['nama_sekolah']) ?></strong><br>
                    <?= htmlspecialchars($kp['alamat']) ?>
                </div>
                <div class="ttd-section">
                    <div class="tgl"><?= $tgl_ttd ?></div>
                    <div class="label">Kepala Sekolah,</div>
                    <div class="ttd-img"></div>
                    <div class="name"><?= htmlspecialchars($kp['kepala_sekolah']) ?></div>
                    <div class="nip">NIP <?= $kp['nip_kepala_sekolah'] ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="actions">
        <a href="cetak_kartu.php?kelas=<?= $siswa['kelas'] ?>" target="_blank">Cetak PDF Kartu Ini</a>
    </div>
</body>
</html>
