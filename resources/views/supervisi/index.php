<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Supervisi Akademik Guru</title>
<style>
:root{--pr:#1e3a5f;--pl:#2d5a9e;--ac:#f0a500;--ok:#15803d;--er:#dc2626;--wn:#b45309;--bg:#edf1f7;--cd:#fff;--tx:#1e2d3d;--mu:#64748b;--br:#dde3ec;--sw:265px}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Segoe UI',system-ui,-apple-system,sans-serif;background:var(--bg);color:var(--tx);display:flex;min-height:100vh}
::-webkit-scrollbar{width:6px}::-webkit-scrollbar-track{background:transparent}::-webkit-scrollbar-thumb{background:#bbb;border-radius:3px}

.sidebar{width:var(--sw);min-height:100vh;background:linear-gradient(180deg,var(--pr),#152d4a);color:#fff;display:flex;flex-direction:column;position:fixed;left:0;top:0;bottom:0;z-index:100;overflow-y:auto}
.sidebar .logo{padding:20px 18px;border-bottom:1px solid rgba(255,255,255,.08)}
.sidebar .logo h2{font-size:15px;font-weight:700;letter-spacing:.3px;color:var(--ac)}
.sidebar .logo small{display:block;font-size:10px;color:rgba(255,255,255,.45);margin-top:3px}
.sidebar nav{flex:1;padding:12px 0}
.sidebar nav a{display:flex;align-items:center;gap:10px;padding:10px 18px;color:rgba(255,255,255,.65);text-decoration:none;font-size:13px;transition:.15s;cursor:pointer;border-left:3px solid transparent}
.sidebar nav a:hover{background:rgba(255,255,255,.06);color:#fff}
.sidebar nav a.on{background:rgba(255,255,255,.1);color:var(--ac);border-left-color:var(--ac)}
.sidebar nav a svg{width:16px;height:16px;flex-shrink:0}
.sidebar .sfoot{padding:14px 18px;border-top:1px solid rgba(255,255,255,.08)}

.main{margin-left:var(--sw);flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{background:var(--cd);border-bottom:1px solid var(--br);padding:14px 24px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50}
.topbar h1{font-size:16px;font-weight:600;color:var(--pr)}
.topbar .actions{display:flex;gap:10px}
.content{padding:24px;flex:1}

.card{background:var(--cd);border-radius:10px;border:1px solid var(--br);padding:20px;margin-bottom:16px}
.card h3{font-size:14px;font-weight:600;margin-bottom:12px;color:var(--pr)}

.btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:7px;border:none;font-size:13px;font-weight:500;cursor:pointer;transition:.15s;text-decoration:none}
.btn-primary{background:var(--pl);color:#fff}.btn-primary:hover{background:var(--pr)}
.btn-success{background:var(--ok);color:#fff}.btn-success:hover{opacity:.9}
.btn-warning{background:var(--ac);color:#fff}.btn-warning:hover{opacity:.9}
.btn-danger{background:var(--er);color:#fff}.btn-danger:hover{opacity:.9}
.btn-ghost{background:transparent;color:var(--mu);border:1px solid var(--br)}.btn-ghost:hover{background:#f5f5f5}
.btn-sm{padding:5px 10px;font-size:12px}
.btn-icon{padding:6px;border-radius:6px;background:transparent;border:1px solid var(--br);cursor:pointer;transition:.15s}
.btn-icon:hover{background:#f0f0f0}

.form-group{margin-bottom:14px}
.form-group label{display:block;font-size:12px;font-weight:500;color:var(--mu);margin-bottom:4px}
.form-group input,.form-group select,.form-group textarea{width:100%;padding:8px 12px;border:1px solid var(--br);border-radius:6px;font-size:13px;transition:.15s}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{outline:none;border-color:var(--pl);box-shadow:0 0 0 3px rgba(45,90,158,.1)}

.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
.grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}

.stat-card{background:var(--cd);border-radius:10px;border:1px solid var(--br);padding:18px;text-align:center}
.stat-card .num{font-size:28px;font-weight:700;color:var(--pr);line-height:1.1}
.stat-card .lbl{font-size:11px;color:var(--mu);margin-top:4px}
.stat-card.ok .num{color:var(--ok)}.stat-card.wn .num{color:var(--wn)}.stat-card.er .num{color:var(--er)}

table{width:100%;border-collapse:collapse;font-size:13px}
table th{text-align:left;padding:10px 12px;background:#f8f9fc;font-weight:600;color:var(--pr);border-bottom:2px solid var(--br);font-size:12px;white-space:nowrap}
table td{padding:9px 12px;border-bottom:1px solid #f0f0f0}
table tr:hover td{background:#fafbfe}

.badge{display:inline-block;padding:3px 8px;border-radius:4px;font-size:11px;font-weight:600}
.badge-ok{background:#dcfce7;color:var(--ok)}.badge-wn{background:#fef3c7;color:var(--wn)}.badge-er{background:#fee2e2;color:var(--er)}.badge-bl{background:#e0e7ff;color:#4f46e5}

.toast-wrap{position:fixed;top:16px;right:16px;z-index:9999;display:flex;flex-direction:column;gap:8px}
.toast{padding:12px 18px;border-radius:8px;color:#fff;font-size:13px;font-weight:500;box-shadow:0 4px 12px rgba(0,0,0,.15);animation:tsIn .3s;max-width:340px}
.toast.ok{background:var(--ok)}.toast.er{background:var(--er)}.toast.wn{background:var(--wn)}
@keyframes tsIn{from{opacity:0;transform:translateX(30px)}to{opacity:1;transform:translateX(0)}}

.modal-bg{position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:200;display:none;align-items:center;justify-content:center}
.modal-bg.show{display:flex}
.modal{background:var(--cd);border-radius:12px;padding:24px;width:90%;max-width:520px;max-height:85vh;overflow-y:auto;box-shadow:0 8px 30px rgba(0,0,0,.2)}
.modal h3{font-size:16px;font-weight:600;margin-bottom:16px;color:var(--pr)}
.modal-foot{display:flex;justify-content:flex-end;gap:8px;margin-top:18px;padding-top:14px;border-top:1px solid var(--br)}

.inst-header{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:16px}
.inst-sel{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.inst-sel label{font-size:12px;color:var(--mu)}
.inst-sel select{padding:7px 10px;border:1px solid var(--br);border-radius:6px;font-size:13px}

.checklist{border:1px solid var(--br);border-radius:8px;overflow:hidden}
.checklist .cl-row{display:flex;align-items:center;padding:10px 14px;border-bottom:1px solid #f0f0f0;gap:10px}
.checklist .cl-row:last-child{border-bottom:none}
.checklist .cl-row.group{background:#f8f9fc;font-weight:600;font-size:12px;color:var(--pr);padding:8px 14px}
.checklist .cl-row.group2{background:#f0f3f8;font-weight:600;font-size:12px;color:var(--pl);padding:7px 14px 7px 32px}
.checklist .cl-row.ind{padding-left:32px}
.checklist .cl-no{width:36px;font-size:12px;color:var(--mu);flex-shrink:0}
.checklist .cl-lbl{flex:1;font-size:13px}
.rad-grp{display:flex;gap:6px;flex-shrink:0}
.rad-grp label{display:flex;align-items:center;gap:4px;cursor:pointer;font-size:11px;font-weight:600;padding:4px 8px;border-radius:5px;border:1.5px solid var(--br);transition:.15s;user-select:none}
.rad-grp label:hover{border-color:#94a3b8;background:#f8fafc}
.rad-grp label.ada{background:#dcfce7;border-color:#4ade80;color:var(--ok)}
.rad-grp label.tdk{background:#fee2e2;border-color:#f87171;color:var(--er)}
.rad-grp input[type=radio]{display:none}

.score-bar{display:flex;align-items:center;gap:14px;margin-top:14px;padding:14px;background:#f8f9fc;border-radius:8px;flex-wrap:wrap}
.score-bar .sb-item{font-size:13px}.score-bar .sb-val{font-weight:700;color:var(--pr)}
.score-bar .pred{padding:4px 12px;border-radius:5px;font-size:12px;font-weight:600}

.tl-box{margin-top:12px}
.tl-box label{display:block;font-size:12px;color:var(--mu);margin-bottom:4px}
.tl-box textarea{width:100%;padding:8px 12px;border:1px solid var(--br);border-radius:6px;font-size:12px;resize:vertical;min-height:60px}

.page{display:none}.page.on{display:block}

.empty{text-align:center;padding:40px 20px;color:var(--mu)}
.empty svg{width:48px;height:48px;margin:0 auto 12px;opacity:.3}
.empty p{font-size:13px}

.loading{display:flex;align-items:center;justify-content:center;padding:40px}
.spinner{width:32px;height:32px;border:3px solid var(--br);border-top-color:var(--pl);border-radius:50%;animation:spin .6s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}

.search-box{position:relative;margin-bottom:14px}
.search-box input{width:100%;padding:9px 12px 9px 36px;border:1px solid var(--br);border-radius:7px;font-size:13px}
.search-box input:focus{outline:none;border-color:var(--pl);box-shadow:0 0 0 3px rgba(45,90,158,.1)}
.search-box svg{position:absolute;left:10px;top:50%;transform:translateY(-50%);width:16px;height:16px;color:var(--mu)}

.progress-bar{height:4px;background:var(--br);border-radius:2px;overflow:hidden;margin-top:6px}
.progress-bar .fill{height:100%;background:var(--ok);border-radius:2px;transition:width .3s}

.tooltip{position:relative;cursor:help}
.tooltip::after{content:attr(data-tip);position:absolute;bottom:120%;left:50%;transform:translateX(-50%);background:#333;color:#fff;font-size:11px;padding:4px 8px;border-radius:4px;white-space:nowrap;opacity:0;pointer-events:none;transition:.15s}
.tooltip:hover::after{opacity:1}

.alert{padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:14px;display:flex;align-items:center;gap:8px}
.alert-info{background:#e0f2fe;color:#0369a1;border:1px solid #bae6fd}
.alert-warn{background:#fef3c7;color:var(--wn);border:1px solid #fde68a}
.alert-err{background:#fee2e2;color:var(--er);border:1px solid #fecaca}

.kop-print{display:none}
.score-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:14px}
.score-grid .sg-item{text-align:center;padding:10px;background:#f8f9fc;border-radius:8px;border:1px solid var(--br)}
.score-grid .sg-key{font-size:11px;color:var(--mu);margin-bottom:2px}
.score-grid .sg-val{font-size:18px;font-weight:700;color:var(--pr)}
.score-grid .sg-pred{font-size:11px;margin-top:2px}

.table-wrap{overflow-x:auto}

@media print{
*{-webkit-print-color-adjust:exact!important;print-color-adjust:exact!important}
body{background:#fff!important;font-size:11px}
.sidebar,.topbar,.btn,.toast-wrap,.modal-bg,.inst-sel,.tl-box,.btn-sm,.actions,.search-box{display:none!important}
.main{margin:0!important}
.content{padding:10px!important}
.page{display:block!important}
.card{border:none!important;box-shadow:none!important;padding:10px 0!important}
table{font-size:10px}table th{background:#e2e8f0!important}
.checklist .cl-row{padding:4px 8px;font-size:10px}
.checklist .cl-row.group{padding:6px 8px;font-size:10px}
.checklist .cl-row.group2{padding:5px 8px 5px 24px;font-size:10px}
.checklist .cl-row.ind{padding-left:24px}
.score-bar{padding:8px;background:#f1f5f9!important}
.kop-print{display:block!important;text-align:center;margin-bottom:16px;padding-bottom:12px;border-bottom:2px solid #000}
.kop-print h2{font-size:14px;margin-bottom:2px}
.kop-print p{font-size:11px;color:#333}
@page{margin:1.5cm;size:A4}
}

@media(max-width:768px){
.sidebar{display:none}.main{margin-left:0}
.grid-4{grid-template-columns:1fr 1fr}
.grid-3{grid-template-columns:1fr 1fr}
.grid-2{grid-template-columns:1fr}
.topbar{padding:12px 16px}.content{padding:16px}
.score-grid{grid-template-columns:1fr 1fr}
.inst-header{flex-direction:column;align-items:flex-start}
}
</style>
</head>
<body>

<aside class="sidebar">
<div class="logo">
<div id="sbLogo" style="width:48px;height:48px;background:rgba(255,255,255,.1);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:10px;overflow:hidden">
<span style="font-size:20px;font-weight:900;color:var(--ac)">S</span>
</div>
<h2>SUPERVISI AKADEMIK</h2>
<small>Pengawasan Pembelajaran Guru</small>
</div>
<nav id="snav">
<a class="on" data-p="dash" onclick="go('dash')">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
Dashboard
</a>
<a data-p="guru" onclick="go('guru')">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
Guru Binaan
</a>
<a data-p="g1" onclick="go('g1')">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
G1 Perencanaan
</a>
<a data-p="g2" onclick="go('g2')">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
G2 Pelaksanaan
</a>
<a data-p="g3" onclick="go('g3')">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
G3 Evaluasi
</a>
<a data-p="g4" onclick="go('g4')">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
G4 Pengembangan
</a>
<a data-p="rekap" onclick="go('rekap')">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
Rekapitulasi
</a>
<a data-p="sett" onclick="go('sett')">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
Pengaturan
</a>
</nav>
<div class="sfoot">
<a href="/supervisi/logout" style="color:rgba(255,255,255,.5);text-decoration:none;font-size:11px">🚪 Logout</a>
<br>
<a href="/" style="color:rgba(255,255,255,.5);text-decoration:none;font-size:11px">&larr; Kembali ke Portal</a>
</div>
</aside>

<div class="main">
<div class="topbar">
<h1 id="pageTitle">Dashboard</h1>
<div class="actions" id="topActions"></div>
</div>
<div class="content">

<div class="page on" id="p-dash">
<div class="grid-4" id="dashStats"></div>
<div class="card" style="margin-top:16px">
<h3>Ringkasan Penilaian per Instrumen</h3>
<div id="dashRingkasan" class="score-grid"></div>
</div>
<div class="card">
<h3>Aktivitas Terbaru</h3>
<div id="dashRecent" style="font-size:13px;color:var(--mu)">Memuat data...</div>
</div>
</div>

<div class="page" id="p-guru">
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
<h3 style="font-size:15px">Daftar Guru Binaan</h3>
<button class="btn btn-primary" onclick="openMG()">+ Tambah Guru</button>
</div>
<div class="search-box">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
<input type="text" id="guruSearch" placeholder="Cari nama, sekolah, atau mapel..." oninput="filterGuru()">
</div>
<div class="card" style="padding:0;overflow:hidden">
<div class="table-wrap">
<table>
<thead><tr><th>No</th><th>Nama</th><th>Sekolah</th><th>Mapel</th><th>JTM</th><th>Tanggal</th><th>Aksi</th></tr></thead>
<tbody id="guruTbody"><tr><td colspan="7" style="text-align:center;color:var(--mu);padding:30px">Memuat...</td></tr></tbody>
</table>
</div>
</div>
</div>

<div class="page" id="p-g1"></div>
<div class="page" id="p-g2"></div>
<div class="page" id="p-g3"></div>
<div class="page" id="p-g4"></div>

<div class="page" id="p-rekap">
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
<h3 style="font-size:15px">Rekapitulasi Penilaian</h3>
<button class="btn btn-sm btn-ghost" onclick="ctkG()">Cetak Semua</button>
</div>
<div class="search-box">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
<input type="text" id="rekapSearch" placeholder="Cari nama, sekolah, atau mapel..." oninput="filterRekap()">
</div>
<div class="card" style="padding:0;overflow:hidden">
<div class="table-wrap">
<table>
<thead><tr><th>No</th><th>Nama</th><th>Sekolah</th><th>Mapel</th><th>Instrumen</th><th>Skor</th><th>Predikat</th><th>Aksi</th></tr></thead>
<tbody id="rekapTbody"><tr><td colspan="8" style="text-align:center;color:var(--mu);padding:30px">Memuat...</td></tr></tbody>
</table>
</div>
</div>
</div>

<div class="page" id="p-sett">
<div class="card" style="max-width:520px">
<h3>Logo Supervisi</h3>
<div id="logoPreview" style="margin-bottom:12px"></div>
<input type="file" id="sLogo" accept="image/*" style="margin-bottom:12px">
<br>
<button class="btn btn-primary" onclick="simpanLogo()">💾 Simpan Logo</button>
</div>
<div class="card" style="max-width:520px;margin-top:16px">
<h3>Pengaturan Kepala Sekolah</h3>
<div class="form-group"><label>Nama Kepala Sekolah</label><input id="sNama" placeholder="Nama lengkap"></div>
<div class="form-group"><label>NIP</label><input id="sNip" placeholder="NIP"></div>
<div class="form-group"><label>Unit Kerja</label><input id="sUnit" placeholder="Nama sekolah / unit"></div>
<div class="form-group"><label>Kota/Kabupaten</label><input id="sKota" placeholder="Kota"></div>
<button class="btn btn-primary" onclick="simpanSett()">Simpan Pengaturan</button>
</div>
<div class="card" style="max-width:520px;margin-top:16px">
<h3>Ganti Password</h3>
<div class="form-group"><label>Password Lama</label><input id="pwLama" type="password" placeholder="Masukkan password lama"></div>
<div class="form-group"><label>Password Baru</label><input id="pwBaru" type="password" placeholder="Masukkan password baru"></div>
<div class="form-group"><label>Konfirmasi Password Baru</label><input id="pwKonf" type="password" placeholder="Ulangi password baru"></div>
<button class="btn btn-primary" onclick="gantiPw()">💾 Ganti Password</button>
</div>
</div>

</div>
</div>

<div class="modal-bg" id="mGuru">
<div class="modal">
<h3 id="mGuruTitle">Tambah Guru</h3>
<input type="hidden" id="mgId">
<div class="grid-2">
<div class="form-group"><label>Nama Guru *</label><input id="mgNama"></div>
<div class="form-group"><label>Sekolah *</label><input id="mgSekolah"></div>
</div>
<div class="grid-2">
<div class="form-group"><label>Mata Pelajaran *</label><input id="mgMapel"></div>
<div class="form-group"><label>Jam Tatap Muka</label><input id="mgJtm" type="number" min="0"></div>
</div>
<div class="grid-2">
<div class="form-group"><label>Nama Kepsek</label><input id="mgKpNama"></div>
<div class="form-group"><label>NIP Kepsek</label><input id="mgKpNip"></div>
</div>
<div class="grid-2">
<div class="form-group"><label>Tanggal Supervisi</label><input id="mgTgl" type="date"></div>
<div class="form-group"><label>Keterangan</label><input id="mgKet"></div>
</div>
<div class="modal-foot">
<button class="btn btn-ghost" onclick="closeMG()">Batal</button>
<button class="btn btn-primary" onclick="simpanGuru()">Simpan</button>
</div>
</div>
</div>

<div class="modal-bg" id="mHapus">
<div class="modal" style="max-width:380px;text-align:center">
<h3 style="color:var(--er)">Konfirmasi Hapus</h3>
<p style="font-size:13px;color:var(--mu);margin:10px 0 18px">Data yang dihapus tidak dapat dikembalikan.</p>
<input type="hidden" id="mhId">
<div class="modal-foot" style="justify-content:center">
<button class="btn btn-ghost" onclick="closeMH()">Batal</button>
<button class="btn btn-danger" onclick="confirmHapus()">Hapus</button>
</div>
</div>
</div>

<div class="toast-wrap" id="toastWrap"></div>

<div class="kop-print" id="kopPrint">
<h2>LAPORAN SUPERVISI AKADEMIK GURU</h2>
<p id="kopInfo">Sekolah: - | Kepala Sekolah: - | NIP: -</p>
</div>

<script>
const API = '/supervisi/api';

const DEF = {
g1:{judul:'Administrasi Perencanaan Pembelajaran',maks:12,aspek:[
{id:'a1',no:'1',label:'Kalender Pendidikan'},
{id:'a2',no:'2',label:'Program Tahunan (Prota)'},
{id:'a3',no:'3',label:'Program Semester (Prosem)'},
{id:'a4',no:'4',label:'Silabus'},
{id:'a5',no:'5',label:'Rencana Pelaksanaan Pembelajaran (RPP)'},
{id:'a6',no:'6',label:'Pemetaan Kompetensi Dasar'},
{id:'a7',no:'7',label:'Program Pengayaan'},
{id:'a8',no:'8',label:'Program Remedial'},
{id:'a9',no:'9',label:'Jadwal Pelajaran'},
{id:'a10',no:'10',label:'Data Peserta Didik'},
{id:'a11',no:'11',label:'Administrasi Laboratorium/Praktikum'},
{id:'a12',no:'12',label:'Program Tindak Lanjut Pembelajaran'}
]},
g2:{judul:'Administrasi Pelaksanaan Pembelajaran',maks:25,aspek:[
{g:'Melakukan Tes:'},
{id:'a1',no:'1',label:'Guru melakukan tes diagnostik awal untuk mengetahui kemampuan awal peserta didik'},
{id:'a2',no:'2',label:'Guru melakukan tes hasil belajar akhir untuk mengukur ketercapaian indikator'},
{id:'a3',no:'3',label:'Guru melakukan tindak lanjut hasil tes'},
{g2:'B.1 Guru Menguasai Materi:'},
{id:'a4',no:'4a',label:'Guru menguasai materi pelajaran secara mendalam',ind:1},
{id:'a5',no:'4b',label:'Guru menghubungkan materi pelajaran dengan mata pelajaran lain',ind:1},
{id:'a6',no:'4c',label:'Guru menerapkan pendekatan konstruktivisme dalam pembelajaran',ind:1},
{g2:'B.2 Guru Mampu Menyampaikan Materi:'},
{id:'a7',no:'5a',label:'Guru menyampaikan materi secara sistematis dan logis',ind:1},
{id:'a8',no:'5b',label:'Guru menggunakan bahasa yang benar dan komunikatif',ind:1},
{id:'a9',no:'5c',label:'Guru memberikan contoh yang relevan dan mudah dipahami',ind:1},
{g2:'B.3 Guru Mampu Membimbing Peserta Didik:'},
{id:'a10',no:'6a',label:'Guru memberikan kesempatan kepada peserta didik untuk bertanya',ind:1},
{id:'a11',no:'6b',label:'Guru membimbing peserta didik agar aktif dalam pembelajaran',ind:1},
{id:'a12',no:'6c',label:'Guru memberikan penguatan terhadap jawaban peserta didik',ind:1},
{g2:'B.4 Guru Mampu Memanfaatkan Waktu:'},
{id:'a13',no:'7a',label:'Guru memanfaatkan waktu belajar secara efektif',ind:1},
{id:'a14',no:'7b',label:'Guru melakukan kegiatan pendahuluan yang menarik perhatian',ind:1},
{g2:'B.5 Guru Mampu Memberikan Tugas:'},
{id:'a15',no:'8a',label:'Tugas yang diberikan sesuai dengan KD dan indikator yang ditetapkan',ind:1},
{id:'a16',no:'8b',label:'Tugas diberikan secara merata kepada seluruh peserta didik',ind:1},
{g2:'B.6 Guru Mampu Mengelola Kelas:'},
{id:'a17',no:'9a',label:'Guru mampu menciptakan suasana belajar yang kondusif',ind:1},
{id:'a18',no:'9b',label:'Guru mampu mengelola peserta didik dengan baik selama pembelajaran',ind:1},
{id:'a19',no:'9c',label:'Guru memanfaatkan media pembelajaran yang relevan',ind:1},
{id:'a20',no:'9d',label:'Guru menggunakan metode pembelajaran yang bervariasi',ind:1},
{id:'a21',no:'9e',label:'Guru mampu mengelola waktu kegiatan belajar mengajar dengan baik',ind:1},
{id:'a22',no:'9f',label:'Guru melaksanakan penugasan secara profesional',ind:1},
{id:'a23',no:'9g',label:'Guru mampu menggunakan teknologi informasi dalam pembelajaran',ind:1},
{id:'a24',no:'10',label:'Guru melaksanakan program pengayaan dan remedial'},
{id:'a25',no:'11',label:'Guru melaksanakan administrasi pelaksanaan pembelajaran dengan baik'}
]},
g3:{judul:'Administrasi Evaluasi Pembelajaran',maks:16,aspek:[
{g:'C.1 Rencana Evaluasi:'},
{id:'a1',no:'1a',label:'Guru merencanakan instrumen evaluasi sesuai indikator ketercapaian',ind:1},
{id:'a2',no:'1b',label:'Guru merencanakan butir soal evaluasi dengan baik dan benar',ind:1},
{id:'a3',no:'1c',label:'Guru merencanakan bentuk instrumen evaluasi yang sesuai',ind:1},
{g:'C.2 Pelaksanaan Evaluasi:'},
{id:'a4',no:'2a',label:'Guru melaksanakan evaluasi secara objektif dan adil',ind:1},
{id:'a5',no:'2b',label:'Guru melaksanakan evaluasi sesuai dengan jadwal yang direncanakan',ind:1},
{id:'a6',no:'2c',label:'Guru menggunakan alat penilaian yang tepat',ind:1},
{g:'C.3 Pengolahan Hasil Evaluasi:'},
{id:'a7',no:'3a',label:'Guru mengolah hasil evaluasi dengan benar',ind:1},
{id:'a8',no:'3b',label:'Guru menganalisis hasil evaluasi secara komprehensif',ind:1},
{g:'C.4 Pelaporan Hasil Evaluasi:'},
{id:'a9',no:'4a',label:'Guru melaporkan hasil evaluasi kepada peserta didik',ind:1},
{id:'a10',no:'4b',label:'Guru melaporkan hasil evaluasi kepada orang tua/wali peserta didik',ind:1},
{id:'a11',no:'4c',label:'Guru melaporkan hasil evaluasi kepada pimpinan sekolah',ind:1},
{g:'C.5 Tindak Lanjut:'},
{id:'a12',no:'5a',label:'Guru melakukan program remedial bagi peserta didik yang belum tuntas',ind:1},
{id:'a13',no:'5b',label:'Guru melakukan program pengayaan bagi peserta didik yang sudah tuntas',ind:1},
{id:'a14',no:'5c',label:'Guru memanfaatkan hasil evaluasi untuk perbaikan pembelajaran',ind:1},
{id:'a15',no:'6',label:'Guru menyimpan hasil evaluasi dengan baik dan benar'},
{id:'a16',no:'7',label:'Guru menggunakan hasil evaluasi sebagai bahan refleksi pembelajaran'}
]},
g4:{judul:'Pelaksanaan Program Pembelajaran dan Pengembangan Diri',maks:44,aspek:[
{g:'D.1 Pengenalan dan Pemahaman Peserta Didik:'},
{id:'a1',no:'1a',label:'Guru mengenal dan memahami karakteristik peserta didik',ind:1},
{id:'a2',no:'1b',label:'Guru mengenal dan memahami kemampuan awal peserta didik',ind:1},
{id:'a3',no:'1c',label:'Guru mengenal minat dan bakat peserta didik',ind:1},
{id:'a4',no:'1d',label:'Guru mengenal latar belakang sosial ekonomi peserta didik',ind:1},
{g:'D.2 Perencanaan Pembelajaran yang Menyenangkan:'},
{id:'a5',no:'2a',label:'Guru merencanakan pembelajaran yang menyenangkan dan menarik',ind:1},
{id:'a6',no:'2b',label:'Guru merencanakan kegiatan pembelajaran yang variatif',ind:1},
{id:'a7',no:'2c',label:'Guru merencanakan penggunaan media dan sumber belajar',ind:1},
{id:'a8',no:'2d',label:'Guru merencanakan penilaian autentik',ind:1},
{g:'D.3 Pelaksanaan Pembelajaran yang Efektif:'},
{id:'a9',no:'3a',label:'Guru melaksanakan pembelajaran dengan pendekatan yang tepat',ind:1},
{id:'a10',no:'3b',label:'Guru melaksanakan pembelajaran dengan metode yang bervariasi',ind:1},
{id:'a11',no:'3c',label:'Guru melaksanakan pembelajaran dengan menggunakan media yang tepat',ind:1},
{id:'a12',no:'3d',label:'Guru melaksanakan pembelajaran dengan memanfaatkan lingkungan',ind:1},
{g:'D.4 Evaluasi dan Umpan Balik yang Konstruktif:'},
{id:'a13',no:'4a',label:'Guru melakukan evaluasi secara berkala dan terencana',ind:1},
{id:'a14',no:'4b',label:'Guru memberikan umpan balik yang konstruktif',ind:1},
{id:'a15',no:'4c',label:'Guru menggunakan hasil evaluasi untuk perbaikan',ind:1},
{id:'a16',no:'4d',label:'Guru mendokumentasikan hasil evaluasi dengan baik',ind:1},
{g:'D.5 Pengelolaan Kelas yang Kondusif:'},
{id:'a17',no:'5a',label:'Guru mampu menciptakan iklim kelas yang menyenangkan',ind:1},
{id:'a18',no:'5b',label:'Guru mampu mengatur dan mengelola kelas dengan baik',ind:1},
{id:'a19',no:'5c',label:'Guru mampu menyelesaikan masalah di kelas secara tepat',ind:1},
{g:'D.6 Pemberian Penguatan dan Motivasi:'},
{id:'a20',no:'6a',label:'Guru memberikan penguatan positif kepada peserta didik',ind:1},
{id:'a21',no:'6b',label:'Guru memberikan motivasi kepada peserta didik',ind:1},
{id:'a22',no:'6c',label:'Guru memberikan reward dan punishment secara tepat',ind:1},
{g:'D.7 Penggunaan Media dan Sumber Belajar:'},
{id:'a23',no:'7a',label:'Guru mampu memilih media pembelajaran yang tepat',ind:1},
{id:'a24',no:'7b',label:'Guru mampu memanfaatkan sumber belajar yang tersedia',ind:1},
{id:'a25',no:'7c',label:'Guru mampu menggunakan teknologi informasi dalam pembelajaran',ind:1},
{g:'D.8 Pengembangan Profesionalisme Guru:'},
{id:'a26',no:'8a',label:'Guru aktif mengikuti kegiatan pelatihan dan workshop',ind:1},
{id:'a27',no:'8b',label:'Guru aktif mengikuti kegiatan MGMP/KKG',ind:1},
{id:'a28',no:'8c',label:'Guru melakukan penelitian tindakan kelas',ind:1},
{id:'a29',no:'8d',label:'Guru mengikuti seminar dan forum ilmiah',ind:1},
{g:'D.9 Kerjasama dengan Orang Tua dan Masyarakat:'},
{id:'a30',no:'9a',label:'Guru melakukan komunikasi dengan orang tua peserta didik',ind:1},
{id:'a31',no:'9b',label:'Guru melibatkan orang tua dalam kegiatan pembelajaran',ind:1},
{id:'a32',no:'9c',label:'Guru menjalin kerjasama dengan masyarakat',ind:1},
{g:'D.10 Pelaksanaan Tugas dan Tanggung Jawab:'},
{id:'a33',no:'10a',label:'Guru melaksanakan tugas tambahan dengan baik',ind:1},
{id:'a34',no:'10b',label:'Guru melaksanakan tugas pokok dengan profesional',ind:1},
{id:'a35',no:'10c',label:'Guru memenuhi tanggung jawab sebagai pendidik',ind:1},
{g:'D.11 Pengembangan Kreativitas dan Inovasi:'},
{id:'a36',no:'11a',label:'Guru mengembangkan kreativitas dalam pembelajaran',ind:1},
{id:'a37',no:'11b',label:'Guru melakukan inovasi dalam metode pembelajaran',ind:1},
{id:'a38',no:'11c',label:'Guru mengembangkan bahan ajar yang inovatif',ind:1},
{g:'D.12 Sikap dan Prilaku Profesional:'},
{id:'a39',no:'12a',label:'Guru menunjukkan sikap profesional dalam bertugas',ind:1},
{id:'a40',no:'12b',label:'Guru menunjukkan sikap teladan bagi peserta didik',ind:1},
{id:'a41',no:'12c',label:'Guru menunjukkan komitmen terhadap profesi',ind:1},
{g:'D.13 Penunjang Pelaksanaan Tugas:'},
{id:'a42',no:'13a',label:'Guru memanfaatkan fasilitas pembelajaran yang ada',ind:1},
{id:'a43',no:'13b',label:'Guru menggunakan buku referensi dan literatur terbaru',ind:1},
{id:'a44',no:'13c',label:'Guru memanfaatkan teknologi informasi untuk mendukung tugas',ind:1}
]}
};

const INAME = {g1:'G1 - Administrasi Perencanaan Pembelajaran',g2:'G2 - Administrasi Pelaksanaan Pembelajaran',g3:'G3 - Administrasi Evaluasi Pembelajaran',g4:'G4 - Program Pembelajaran dan Pengembangan Diri'};
const PRED = [{min:.8,label:'Baik Sekali',cls:'badge-ok'},{min:.6,label:'Baik',cls:'badge-bl'},{min:.4,label:'Cukup',cls:'badge-wn'},{min:0,label:'Kurang',cls:'badge-er'}];

let guruList = [], settings = {}, curGuru = null, curPage = 'dash', rekapData = [];

function toast(msg, type = 'ok') {
const t = document.createElement('div');
t.className = 'toast ' + type;
t.textContent = msg;
document.getElementById('toastWrap').appendChild(t);
setTimeout(() => t.remove(), 3000);
}

async function api(path, opts = {}) {
try {
const r = await fetch(API + path, opts);
const j = await r.json();
if (!r.ok) throw new Error(j.error || 'Gagal');
return j;
} catch (e) {
toast(e.message, 'er');
throw e;
}
}

function go(page) {
curPage = page;
document.querySelectorAll('.page').forEach(p => p.classList.remove('on'));
const el = document.getElementById('p-' + page);
if (el) el.classList.add('on');
document.querySelectorAll('#snav a').forEach(a => {
a.classList.toggle('on', a.dataset.p === page);
});
const titles = {dash:'Dashboard',guru:'Guru Binaan',g1:INAME.g1,g2:INAME.g2,g3:INAME.g3,g4:INAME.g4,rekap:'Rekapitulasi',sett:'Pengaturan'};
document.getElementById('pageTitle').textContent = titles[page] || 'Supervisi';
document.getElementById('topActions').innerHTML = '';
if (page === 'dash') rdash();
else if (page === 'guru') rguru();
else if (['g1','g2','g3','g4'].includes(page)) loadI(page);
else if (page === 'rekap') rrekap();
else if (page === 'sett') loadSett();
}

function pred(score, max) {
if (!max) return PRED[3];
const r = score / max;
for (const p of PRED) if (r >= p.min) return p;
return PRED[3];
}

function getTL(score, max) {
if (!max) return '';
const r = score / max;
if (r >= .8) return 'Melanjutkan dan meningkatkan kualitas pembelajaran yang sudah baik.';
if (r >= .6) return 'Melanjutkan dengan melakukan perbaikan pada aspek yang masih rendah.';
if (r >= .4) return 'Perlu pembinaan dan bimbingan pada aspek yang belum tercapai.';
return 'Perlu bimbingan intensif dan supervisi lanjutan secara berkala.';
}

function fmtDate(d) {
if (!d) return '-';
const dt = new Date(d);
return dt.toLocaleDateString('id-ID', {day:'numeric',month:'short',year:'numeric'});
}

function fmtScore(s) {
return s != null ? parseFloat(s).toFixed(2) : '-';
}

async function init() {
const [gRes, sRes] = await Promise.all([
api('/guru'),
api('/settings')
]);
guruList = gRes.data || [];
settings = sRes.data || {};
if (settings.logo) {
document.getElementById('sbLogo').innerHTML = '<img src="' + settings.logo + '" alt="Logo" style="width:100%;height:100%;object-fit:contain;border-radius:8px">';
}
rdash();
}

async function rdash() {
const [gRes, statsRes, rekapRes] = await Promise.all([
api('/guru'),
api('/stats'),
api('/rekap')
]);
guruList = gRes.data || [];
const s = statsRes.data || {};
const rekap = rekapRes.data || [];

document.getElementById('dashStats').innerHTML = `
<div class="stat-card"><div class="num">${s.total_guru || 0}</div><div class="lbl">Total Guru</div></div>
<div class="stat-card ok"><div class="num">${s.sudah_dinilai || 0}</div><div class="lbl">Sudah Dinilai</div></div>
<div class="stat-card wn"><div class="num">${s.rata_rata ? parseFloat(s.rata_rata).toFixed(2) : '-'}</div><div class="lbl">Rata-rata Skor</div></div>
<div class="stat-card er"><div class="num">${s.perlu_pembinaan || 0}</div><div class="lbl">Perlu Pembinaan</div></div>
`;

document.getElementById('dashRingkasan').innerHTML = '';
['G1','G2','G3','G4'].forEach(k => {
const rows = rekap.filter(r => r.instrumen === k);
const def = DEF[k.toLowerCase()];
const total = rows.length;
const avg = total ? (rows.reduce((a, r) => a + parseFloat(r.score || 0), 0) / total).toFixed(2) : '-';
const best = total ? Math.max(...rows.map(r => parseFloat(r.score || 0))) : '-';
document.getElementById('dashRingkasan').innerHTML += `
<div class="sg-item">
<div class="sg-key">${k}</div>
<div class="sg-val">${total}</div>
<div class="sg-pred">Rata: ${avg}</div>
</div>`;
});

document.getElementById('dashRecent').innerHTML = guruList.length
? guruList.slice(0, 5).map((g, i) => `<div style="padding:8px 0;border-bottom:1px solid #f0f0f0;display:flex;justify-content:space-between"><div><strong>${g.nama}</strong> &mdash; ${g.sekolah} &mdash; ${g.mapel}</div><div style="font-size:11px;color:var(--mu)">${fmtDate(g.tanggal_supervisi)}</div></div>`).join('')
: '<div style="padding:16px 0">Belum ada data guru. Tambahkan guru binaan terlebih dahulu.</div>';

document.getElementById('kopInfo').textContent =
`Sekolah: ${settings.kepsek_unit || '-'} | Kepala Sekolah: ${settings.kepsek_nama || '-'} | NIP: ${settings.kepsek_nip || '-'}`;
}

function rguru() {
filterGuru();
}

function filterGuru() {
const q = (document.getElementById('guruSearch')?.value || '').toLowerCase();
const filtered = guruList.filter(g => !q || g.nama.toLowerCase().includes(q) || g.sekolah.toLowerCase().includes(q) || g.mapel.toLowerCase().includes(q));
const tb = document.getElementById('guruTbody');
if (!filtered.length) {
tb.innerHTML = `<tr><td colspan="7" style="text-align:center;color:var(--mu);padding:30px">${q ? 'Tidak ada guru yang cocok dengan pencarian.' : 'Belum ada data guru. Klik "Tambah Guru" untuk menambah.'}</td></tr>`;
return;
}
tb.innerHTML = filtered.map((g, i) => `<tr>
<td>${i + 1}</td>
<td><strong>${g.nama}</strong></td>
<td>${g.sekolah}</td>
<td>${g.mapel}</td>
<td>${g.jam_tatap_muka || '-'}</td>
<td>${fmtDate(g.tanggal_supervisi)}</td>
<td style="white-space:nowrap">
<button class="btn btn-sm btn-ghost" onclick="editGuru(${g.id})">Edit</button>
<button class="btn btn-sm btn-danger" onclick="openMH(${g.id})">Hapus</button>
</td>
</tr>`).join('');
}

function rSels(selectedId) {
return guruList.map(g =>
`<option value="${g.id}" ${g.id == selectedId ? 'selected' : ''}>${g.nama} - ${g.mapel} (${g.sekolah})</option>`
).join('');
}

async function loadI(key) {
const def = DEF[key];
const selOpts = guruList.length
? '<option value="">-- Pilih Guru --</option>' + rSels(curGuru)
: '<option value="">-- Belum ada guru --</option>';

document.getElementById('p-' + key).innerHTML = `
<div class="inst-header">
<div class="inst-sel">
<label>Guru:</label>
<select id="selGuru_${key}" onchange="onChGuru('${key}')">${selOpts}</select>
</div>
<div class="actions">
<button class="btn btn-sm btn-ghost" onclick="resetI('${key}')">Reset</button>
<button class="btn btn-sm btn-success" onclick="simpan('${key}')">Simpan</button>
<button class="btn btn-sm btn-ghost" onclick="ctkI('${key}')">Cetak</button>
</div>
</div>
<div class="card">
<h3>${def.judul} (${def.maks} butir)</h3>
<div class="checklist" id="cklist_${key}">
${def.aspek.map(a => {
if (a.g) return `<div class="cl-row group"><span class="cl-no"></span><span class="cl-lbl">${a.g}</span></div>`;
if (a.g2) return `<div class="cl-row group2"><span class="cl-no"></span><span class="cl-lbl">${a.g2}</span></div>`;
return `<div class="cl-row${a.ind ? ' ind' : ''}">
<span class="cl-no">${a.no}</span>
<span class="cl-lbl">${a.label}</span>
<div class="rad-grp">
<label class="" id="rl_ada_${key}_${a.id}">
<input type="radio" name="r_${key}_${a.id}" value="1" onchange="onChRad('${key}','${a.id}',1)"> ✓ Ada
</label>
<label class="" id="rl_tdk_${key}_${a.id}">
<input type="radio" name="r_${key}_${a.id}" value="0" onchange="onChRad('${key}','${a.id}',0)"> ✗ Tidak
</label>
</div>
</div>`;
}).join('')}
</div>
</div>
<div class="score-bar" id="sbar_${key}">
<span class="sb-item">Skor: <span class="sb-val" id="sk_${key}">0</span> / ${def.maks}</span>
<span class="sb-item">Predikat: <span class="pred badge-bl" id="pd_${key}">-</span></span>
</div>
<div class="tl-box">
<label>Tindak Lanjut:</label>
<textarea id="tl_${key}" placeholder="Tindak lanjut akan terisi otomatis..."></textarea>
</div>
`;

if (curGuru) {
try {
const res = await api('/penilaian?guru_id=' + curGuru);
const d = res.data || {};
if (d[key.toUpperCase()] || d[key]) {
const pen = d[key.toUpperCase()] || d[key];
const av = typeof pen.aspek_values === 'object' ? pen.aspek_values : JSON.parse(pen.aspek_values || '{}');
Object.entries(av).forEach(([k, v]) => {
const val = parseInt(v);
const radio = document.querySelector(`input[name="r_${key}_${k}"][value="${val}"]`);
if (radio) {
radio.checked = true;
const lbl = document.getElementById('rl_ada_' + key + '_' + k);
const tl = document.getElementById('rl_tdk_' + key + '_' + k);
if (lbl) lbl.className = val === 1 ? 'ada' : '';
if (tl) tl.className = val === 0 ? 'tdk' : '';
}
});
onCh(key);
}
} catch (e) {}
}
}

function onChGuru(key) {
const sel = document.getElementById('selGuru_' + key);
curGuru = sel.value || null;
loadI(key);
}

function onCh(key) {
const def = DEF[key];
let score = 0;
def.aspek.forEach(a => {
if (a.g || a.g2) return;
const checked = document.querySelector(`input[name="r_${key}_${a.id}"]:checked`);
if (checked) score += parseInt(checked.value);
});
const p = pred(score, def.maks);
document.getElementById('sk_' + key).textContent = score;
const pd = document.getElementById('pd_' + key);
pd.textContent = p.label;
pd.className = 'pred badge ' + p.cls;
document.getElementById('tl_' + key).value = getTL(score, def.maks);
}

function onChRad(key, aid, val) {
// Update label styles
const adaLabel = document.getElementById('rl_ada_' + key + '_' + aid);
const tdkLabel = document.getElementById('rl_tdk_' + key + '_' + aid);
if (adaLabel) adaLabel.className = val === 1 ? 'ada' : '';
if (tdkLabel) tdkLabel.className = val === 0 ? 'tdk' : '';
onCh(key);
}

function resetI(key) {
const def = DEF[key];
def.aspek.forEach(a => {
if (a.g || a.g2) return;
document.querySelectorAll(`input[name="r_${key}_${a.id}"]`).forEach(r => r.checked = false);
const al = document.getElementById('rl_ada_' + key + '_' + a.id);
const tl = document.getElementById('rl_tdk_' + key + '_' + a.id);
if (al) al.className = '';
if (tl) tl.className = '';
});
onCh(key);
}

async function simpan(key) {
if (!curGuru) { toast('Pilih guru terlebih dahulu!', 'wn'); return; }
const def = DEF[key];
const av = {};
let score = 0;
def.aspek.forEach(a => {
if (a.g || a.g2) return;
const checked = document.querySelector(`input[name="r_${key}_${a.id}"]:checked`);
if (checked) {
av[a.id] = parseInt(checked.value);
score += parseInt(checked.value);
}
});
if (Object.keys(av).length < def.aspek.filter(a => !a.g && !a.g2).length) {
toast('Masih ada aspek yang belum diisi!', 'wn'); return;
}
const p = pred(score, def.maks);
const fd = new FormData();
fd.append('guru_id', curGuru);
fd.append('instrumen', key.toUpperCase());
fd.append('aspek_values', JSON.stringify(av));
fd.append('score', score);
fd.append('max_score', def.maks);
fd.append('predicate', p.label);
fd.append('tindak_lanjut', getTL(score, def.maks));
const r = await api('/penilaian', { method: 'POST', body: fd });
if (r.ok) { toast('Penilaian tersimpan!', 'ok'); onCh(key); } else { toast(r.error || 'Gagal menyimpan', 'er'); }
}

async function rrekap() {
try {
const res = await api('/rekap');
rekapData = res.data || [];
filterRekap();
} catch (e) {}
}

function filterRekap() {
const q = (document.getElementById('rekapSearch')?.value || '').toLowerCase();
const filtered = rekapData.filter(r => !q || (r.nama||'').toLowerCase().includes(q) || (r.sekolah||'').toLowerCase().includes(q) || (r.mapel||'').toLowerCase().includes(q));
const tb = document.getElementById('rekapTbody');
if (!filtered.length) {
tb.innerHTML = `<tr><td colspan="8" style="text-align:center;color:var(--mu);padding:30px">${q ? 'Tidak ada data yang cocok.' : 'Belum ada data rekap.'}</td></tr>`;
return;
}
tb.innerHTML = filtered.map((r, i) => {
const p = pred(r.score, r.max_score);
return `<tr>
<td>${i + 1}</td>
<td><strong>${r.nama}</strong></td>
<td>${r.sekolah}</td>
<td>${r.mapel}</td>
<td>${INAME[r.instrumen.toLowerCase()] || r.instrumen}</td>
<td><strong>${fmtScore(r.score)}</strong> / ${r.max_score}</td>
<td><span class="badge ${p.cls}">${r.predicate || p.label}</span></td>
<td><button class="btn btn-sm btn-ghost" onclick="ctkI('${r.instrumen.toLowerCase()}',${r.guru_id})">Cetak</button></td>
</tr>`;
}).join('');
}

function openMG(id) {
const m = document.getElementById('mGuru');
if (id) {
const g = guruList.find(x => x.id === id);
if (!g) return;
document.getElementById('mGuruTitle').textContent = 'Edit Guru';
document.getElementById('mgId').value = g.id;
document.getElementById('mgNama').value = g.nama || '';
document.getElementById('mgSekolah').value = g.sekolah || '';
document.getElementById('mgMapel').value = g.mapel || '';
document.getElementById('mgJtm').value = g.jam_tatap_muka || '';
document.getElementById('mgKpNama').value = g.kepsek_nama || settings.kepsek_nama || '';
document.getElementById('mgKpNip').value = g.kepsek_nip || settings.kepsek_nip || '';
document.getElementById('mgTgl').value = g.tanggal_supervisi || '';
document.getElementById('mgKet').value = g.keterangan || '';
} else {
document.getElementById('mGuruTitle').textContent = 'Tambah Guru';
document.getElementById('mgId').value = '';
document.getElementById('mgNama').value = '';
document.getElementById('mgSekolah').value = '';
document.getElementById('mgMapel').value = '';
document.getElementById('mgJtm').value = '';
document.getElementById('mgKpNama').value = settings.kepsek_nama || '';
document.getElementById('mgKpNip').value = settings.kepsek_nip || '';
document.getElementById('mgTgl').value = '';
document.getElementById('mgKet').value = '';
}
m.classList.add('show');
}

function closeMG() { document.getElementById('mGuru').classList.remove('show'); }

function editGuru(id) { openMG(id); }

async function simpanGuru() {
const id = document.getElementById('mgId').value;
const fd = {
nama: document.getElementById('mgNama').value.trim(),
sekolah: document.getElementById('mgSekolah').value.trim(),
mapel: document.getElementById('mgMapel').value.trim(),
jam_tatap_muka: document.getElementById('mgJtm').value || '0',
kepsek_nama: document.getElementById('mgKpNama').value.trim(),
kepsek_nip: document.getElementById('mgKpNip').value.trim(),
tanggal_supervisi: document.getElementById('mgTgl').value,
keterangan: document.getElementById('mgKet').value.trim()
};
if (!fd.nama || !fd.sekolah || !fd.mapel) { toast('Nama, Sekolah, dan Mapel wajib diisi!', 'wn'); return; }
try {
if (id) {
fd.id = id;
await api('/guru', {
method: 'POST',
headers: {'Content-Type': 'application/x-www-form-urlencoded'},
body: new URLSearchParams({...fd, _method: 'PUT'}).toString()
});
toast('Data guru berhasil diperbarui!');
} else {
await api('/guru', {
method: 'POST',
headers: {'Content-Type': 'application/x-www-form-urlencoded'},
body: new URLSearchParams(fd).toString()
});
toast('Guru berhasil ditambahkan!');
}
closeMG();
const res = await api('/guru');
guruList = res.data || [];
rguru();
} catch (e) {}
}

function openMH(id) {
document.getElementById('mhId').value = id;
document.getElementById('mHapus').classList.add('show');
}
function closeMH() { document.getElementById('mHapus').classList.remove('show'); }

async function confirmHapus() {
const id = document.getElementById('mhId').value;
try {
await api('/guru', {
method: 'POST',
headers: {'Content-Type': 'application/x-www-form-urlencoded'},
body: new URLSearchParams({id, _method: 'DELETE'}).toString()
});
toast('Guru berhasil dihapus!');
closeMH();
const res = await api('/guru');
guruList = res.data || [];
rguru();
} catch (e) {}
}

async function loadSett() {
try {
const res = await api('/settings');
settings = res.data || {};
document.getElementById('sNama').value = settings.kepsek_nama || '';
document.getElementById('sNip').value = settings.kepsek_nip || '';
document.getElementById('sUnit').value = settings.kepsek_unit || '';
document.getElementById('sKota').value = settings.kepsek_kota || '';
if (settings.logo) {
document.getElementById('logoPreview').innerHTML = '<img src="' + settings.logo + '" alt="Logo" style="width:80px;height:80px;object-fit:contain;border-radius:8px;border:1px solid var(--br)">';
}
} catch (e) {}
}

async function simpanLogo() {
const file = document.getElementById('sLogo').files[0];
if (!file) { toast('Pilih file logo terlebih dahulu!', 'wn'); return; }
const fd = new FormData();
fd.append('logo', file);
try {
const r = await api('/settings/upload-logo', { method: 'POST', body: fd });
if (r.ok) {
toast('Logo berhasil diunggah!');
if (r.url) {
settings.logo = r.url;
document.getElementById('sbLogo').innerHTML = '<img src="' + r.url + '" alt="Logo" style="width:100%;height:100%;object-fit:contain;border-radius:8px">';
document.getElementById('logoPreview').innerHTML = '<img src="' + r.url + '" alt="Logo" style="width:80px;height:80px;object-fit:contain;border-radius:8px;border:1px solid var(--br)">';
}
} else { toast(r.error || 'Gagal mengunggah logo', 'er'); }
} catch (e) { toast('Gagal mengunggah logo', 'er'); }
}

async function simpanSett() {
try {
await api('/settings', {
method: 'POST',
headers: {'Content-Type': 'application/x-www-form-urlencoded'},
body: new URLSearchParams({
kepsek_nama: document.getElementById('sNama').value.trim(),
kepsek_nip: document.getElementById('sNip').value.trim(),
kepsek_unit: document.getElementById('sUnit').value.trim(),
kepsek_kota: document.getElementById('sKota').value.trim()
}).toString()
});
toast('Pengaturan berhasil disimpan!');
} catch (e) {}
}

async function gantiPw() {
const lama = document.getElementById('pwLama').value;
const baru = document.getElementById('pwBaru').value;
const konf = document.getElementById('pwKonf').value;
if (!lama || !baru || !konf) { toast('Semua field wajib diisi!', 'wn'); return; }
if (baru.length < 6) { toast('Password baru minimal 6 karakter!', 'wn'); return; }
if (baru !== konf) { toast('Konfirmasi password tidak cocok!', 'wn'); return; }
try {
const r = await api('/auth/change-password', {
method: 'POST',
headers: {'Content-Type': 'application/x-www-form-urlencoded'},
body: new URLSearchParams({ password_lama: lama, password_baru: baru }).toString()
});
if (r.ok) {
toast('Password berhasil diganti!');
document.getElementById('pwLama').value = '';
document.getElementById('pwBaru').value = '';
document.getElementById('pwKonf').value = '';
} else {
toast(r.error || 'Gagal mengganti password', 'er');
}
} catch (e) { toast('Gagal mengganti password', 'er'); }
}

async function ctkI(key, guruId) {
const gid = guruId || curGuru;
if (!gid) { toast('Pilih guru terlebih dahulu!', 'wn'); return; }
toast('Menyiapkan cetak...', 'wn');
window.print();
}

function ctkG() {
toast('Menyiapkan cetak...', 'wn');
window.print();
}

document.addEventListener('DOMContentLoaded', init);
</script>
</body>
</html>