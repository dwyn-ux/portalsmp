<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

require 'db.php';

$success = 0;
$fail = 0;
$errors = [];

if (isset($_POST['upload'])) {
    $file = $_FILES['file']['tmp_name'];
    $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

    if ($ext !== 'csv') {
        $errors[] = "Format file harus .csv. Export Excel ke CSV terlebih dahulu.";
    } else {
        $handle = fopen($file, 'r');
        if ($handle) {
            $i = 0;
            while (($row = fgetcsv($handle, 0, ',')) !== false) {
                $i++;
                if ($i == 1) continue; // skip header

                if (count($row) < 7) { $fail++; continue; }

                $nama   = mysqli_real_escape_string($conn, trim($row[0]));
                $nis    = mysqli_real_escape_string($conn, trim($row[1]));
                $nisn   = mysqli_real_escape_string($conn, trim($row[2]));
                $kelas  = mysqli_real_escape_string($conn, trim($row[3]));
                $jk     = mysqli_real_escape_string($conn, trim($row[4]));
                $tempat = mysqli_real_escape_string($conn, trim($row[5]));
                $tgl    = mysqli_real_escape_string($conn, trim($row[6]));

                if (empty($nisn)) { $fail++; continue; }

                $cek = mysqli_query($conn, "SELECT 1 FROM kp_users WHERE username='$nisn' LIMIT 1");
                if (mysqli_num_rows($cek) > 0) { $fail++; continue; }

                $password = md5($nisn);
                mysqli_query($conn, "INSERT INTO kp_users (username, password, role) VALUES ('$nisn', '$password', 'siswa')");
                $user_id = mysqli_insert_id($conn);

                $insert = mysqli_query($conn, "INSERT INTO kp_siswa (nama, nis, nisn, kelas, jenis_kelamin, tempat_lahir, tanggal_lahir, user_id)
                VALUES ('$nama', '$nis', '$nisn', '$kelas', '$jk', '$tempat', '$tgl', '$user_id')");

                $insert ? $success++ : $fail++;
            }
            fclose($handle);
        } else {
            $errors[] = "Gagal membaca file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Data Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #182c47;
            color: #fff;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #f5f5f5;
            text-align: center;
        }

        form {
            background-color: #243b5e;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background: #f0f0f0;
            border-radius: 5px;
            border: none;
            color: #000; /* tambahkan ini agar teks terlihat */
        }

        button {
            width: 100%;
            background-color: #4267B2;
            color: white;
            padding: 12px;
            border: none;
            margin-top: 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #365899;
        }

        .info, .link {
            max-width: 400px;
            margin: 10px auto;
            text-align: center;
        }

        .info p {
            font-size: 16px;
        }

        .link a {
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }

        .warning {
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
            font-size: 14px;
            background-color: #ffcc00;
            color: #000;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }

        @media (max-width: 500px) {
            form, .info, .link, .warning {
                width: 90%;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<h2>Upload Data Siswa (CSV)</h2>

<?php if (!empty($errors)): ?>
    <div class="info" style="background:#ff4444;border-radius:8px;padding:15px;">
        <p><?= implode('<br>', $errors) ?></p>
    </div>
<?php endif; ?>

<?php if (isset($_POST['upload']) && empty($errors)): ?>
    <div class="info">
        <p>✅ Berhasil: <?= $success ?> | ❌ Gagal: <?= $fail ?></p>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="file" accept=".csv" required>
    <button name="upload">Upload</button>
</form>

<div class="warning">
    ⚠️ Format kolom: Nama, NIS, NISN, Kelas, Jenis Kelamin, Tempat Lahir, Tanggal Lahir (satu baris header, koma sebagai pemisah)
</div>

<div class="link">
    <p>📥 <a href="format_data_siswa.csv" download>Unduh Format CSV</a></p>
    <p><a href="daftar_siswa.php">Lihat daftar siswa</a></p>
    <p><a href="dashboard.php">← Kembali ke Dashboard</a></p>
</div>

</body>
</html>
