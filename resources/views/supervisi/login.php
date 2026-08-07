<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= \App\Helpers\H::e($title ?? 'Login Supervisi') ?></title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%231e3a5f'/><text y='.9em' x='50' text-anchor='middle' font-size='65' fill='white'>S</text></svg>">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Segoe UI',Arial,sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#1e3a5f 0%,#2d5a9e 100%);padding:20px}
        .login-card{background:#fff;border-radius:16px;padding:40px 36px;width:100%;max-width:400px;box-shadow:0 25px 60px rgba(0,0,0,.25)}
        .login-logo{text-align:center;margin-bottom:24px}
        .login-logo .icon{width:64px;height:64px;background:#1e3a5f;border-radius:16px;display:inline-flex;align-items:center;justify-content:center;color:#f0a500;font-size:28px;font-weight:900;margin-bottom:12px}
        .login-logo h1{font-size:20px;font-weight:800;color:#1e3a5f;margin-bottom:4px}
        .login-logo p{font-size:12px;color:#64748b}
        .form-group{margin-bottom:16px}
        .form-group label{display:block;font-size:12px;font-weight:600;color:#64748b;margin-bottom:6px}
        .form-group input{width:100%;padding:10px 14px;border:1.5px solid #dde3ec;border-radius:8px;font-size:14px;color:#1e2d3d;transition:.18s;background:#fff;font-family:inherit}
        .form-group input:focus{outline:none;border-color:#2d5a9e;box-shadow:0 0 0 3px rgba(45,90,158,.1)}
        .btn-login{width:100%;padding:11px;border:none;border-radius:8px;background:#1e3a5f;color:#fff;font-size:14px;font-weight:700;cursor:pointer;transition:.18s;font-family:inherit}
        .btn-login:hover{background:#2d5a9e}
        .error{background:#fee2e2;color:#991b1b;border:1px solid #fca5a5;border-radius:8px;padding:10px 14px;font-size:13px;margin-bottom:16px}
        .footer-link{text-align:center;margin-top:20px;font-size:12px;color:#94a3b8}
        .footer-link a{color:#1e3a5f;text-decoration:none;font-weight:600}
        .footer-link a:hover{text-decoration:underline}
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <div class="icon">S</div>
            <h1>Supervisi Akademik</h1>
            <p>SMP Muhammadiyah Unggulan Ashidiq</p>
        </div>

        <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="error"><?= \App\Helpers\H::e($_SESSION['flash_error']) ?></div>
        <?php unset($_SESSION['flash_error']); endif; ?>

        <form method="POST" action="/supervisi/login">
            <?= \App\Core\Csrf::field() ?>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required autofocus placeholder="Masukkan username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Masukkan password">
            </div>
            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <div class="footer-link">
            <a href="/">← Kembali ke Portal</a>
        </div>
    </div>
</body>
</html>
