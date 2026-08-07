<?php
/**
 * Landing page — inspired by SIT Nassadepok portal.
 * Two-column: welcome card left + app grid right.
 */
$heroBg = isset($settings['hero_bg']) ? $settings['hero_bg'] : '';
$heroLogo = isset($settings['hero_logos']) ? $settings['hero_logos'] : '';
$catColors = [
    'emerald' => ['#0f766e','rgba(15,118,110,.10)'],
    'teal'    => ['#0d9488','rgba(13,148,136,.12)'],
    'sky'     => ['#0284c7','rgba(2,132,199,.12)'],
    'blue'    => ['#2563eb','rgba(37,99,235,.12)'],
    'indigo'  => ['#4f46e5','rgba(79,70,229,.12)'],
    'violet'  => ['#7c3aed','rgba(124,58,237,.12)'],
    'amber'   => ['#d97706','rgba(217,119,6,.12)'],
    'rose'    => ['#e11d48','rgba(225,29,72,.12)'],
    'pink'    => ['#db2777','rgba(219,39,119,.12)'],
];
?>
<style>
*{box-sizing:border-box}
.portal-page{width:100%;min-height:100vh;padding:32px 18px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,rgba(240,253,250,.92),rgba(239,246,255,.88)<?= !empty($heroBg) ? '' : '' ?>)<?= !empty($heroBg) ? ",url('".\App\Helpers\H::e($heroBg)."')" : '' ?>;background-size:cover;background-position:center;background-attachment:fixed}
.portal-shell{width:100%;max-width:1120px;margin:0 auto}
.portal-header{display:flex;align-items:center;justify-content:space-between;gap:18px;margin-bottom:18px}
.portal-brand{display:flex;align-items:center;gap:13px;min-width:0}
.portal-logo{width:58px;height:58px;border-radius:18px;background:#fff;box-shadow:0 12px 30px rgba(15,23,42,.10);border:1px solid rgba(255,255,255,.80);object-fit:contain;padding:8px}
.portal-brand-title{margin:0;font-size:24px;line-height:1.15;font-weight:900;letter-spacing:-.03em;color:#0f172a}
.portal-brand-subtitle{margin:4px 0 0;font-size:13px;color:#64748b}
.portal-year{padding:9px 13px;border-radius:999px;background:rgba(255,255,255,.70);border:1px solid rgba(255,255,255,.85);color:#334155;font-size:13px;font-weight:800;box-shadow:0 10px 24px rgba(15,23,42,.06);white-space:nowrap}
.portal-layout{display:grid;grid-template-columns:.9fr 1.1fr;gap:18px;align-items:stretch}
.portal-welcome{position:relative;border-radius:30px;background:linear-gradient(135deg,rgba(15,118,110,.96),rgba(20,184,166,.90));color:#fff;padding:32px;overflow:hidden;box-shadow:0 24px 60px rgba(15,118,110,.24);display:flex;align-items:center}
.portal-welcome::before{content:"";position:absolute;width:220px;height:220px;right:-80px;top:-80px;border-radius:999px;background:rgba(255,255,255,.16)}
.portal-welcome::after{content:"";position:absolute;width:150px;height:150px;left:-50px;bottom:-60px;border-radius:999px;background:rgba(255,255,255,.10)}
.portal-welcome-inner{position:relative;z-index:1;width:100%}
.portal-badge{display:inline-flex;align-items:center;padding:7px 11px;border-radius:999px;background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.24);font-size:12px;font-weight:800;margin-bottom:16px}
.portal-welcome h1{margin:0;font-size:40px;line-height:1.08;font-weight:950;letter-spacing:-.045em}
.portal-welcome p{margin:15px 0 0;font-size:15px;line-height:1.7;opacity:.93;max-width:520px}
.portal-panel{border-radius:30px;padding:20px;background:rgba(255,255,255,.58);border:1px solid rgba(255,255,255,.70);box-shadow:0 24px 60px rgba(15,23,42,.10);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px)}
.portal-panel-title{margin-bottom:16px}
.portal-panel-title h2{margin:0;font-size:22px;font-weight:950;letter-spacing:-.03em}
.portal-panel-title p{margin:5px 0 0;color:#64748b;font-size:13px}
.portal-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}
.portal-card{--accent:#0f766e;--accent-soft:rgba(15,118,110,.10);position:relative;min-height:138px;border-radius:22px;padding:16px;background:rgba(255,255,255,.90);border:1px solid rgba(255,255,255,.86);box-shadow:0 14px 32px rgba(15,23,42,.08);color:#0f172a;text-decoration:none;display:flex;gap:14px;align-items:center;overflow:hidden;transition:.20s ease}
.portal-card:hover{transform:translateY(-3px);box-shadow:0 20px 42px rgba(15,23,42,.13);color:#0f172a;text-decoration:none}
.portal-card::before{content:"";position:absolute;inset:0;background:radial-gradient(circle at 96% 6%,var(--accent-soft),transparent 36%),linear-gradient(90deg,var(--accent-soft),transparent 34%);pointer-events:none}
.portal-card-media{position:relative;z-index:1;width:72px;height:72px;border-radius:21px;background:#fff;border:1px solid rgba(15,23,42,.06);box-shadow:0 12px 24px rgba(15,23,42,.08);display:flex;align-items:center;justify-content:center;flex:0 0 auto;overflow:hidden}
.portal-card-media::before{content:"";position:absolute;inset:7px;border-radius:17px;background:var(--accent-soft)}
.portal-card-media img{position:relative;z-index:1;width:58px;height:58px;object-fit:contain;display:block;transition:.20s ease}
.portal-card:hover .portal-card-media img{transform:scale(1.08)}
.portal-card-letter{position:relative;z-index:1;width:48px;height:48px;border-radius:16px;display:none;align-items:center;justify-content:center;color:#fff;background:var(--accent);font-size:23px;font-weight:950}
.portal-card-content{position:relative;z-index:1;min-width:0;flex:1}
.portal-card-content h3{margin:0;font-size:17px;line-height:1.2;font-weight:950;letter-spacing:-.02em}
.portal-card-content p{margin:6px 0 0;color:#64748b;font-size:12.5px;line-height:1.45}
.portal-card-action{position:relative;z-index:1;margin-top:11px;display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:900}
.portal-card-action span{transition:.18s ease}
.portal-card:hover .portal-card-action span{transform:translateX(3px)}
.portal-footer{margin-top:18px;display:flex;align-items:center;justify-content:space-between;gap:14px;color:#475569;font-size:13px}
.portal-footer a{color:#0f5f59;text-decoration:none;font-weight:850}
.portal-footer a:hover{text-decoration:underline}
@media(max-width:980px){.portal-layout{grid-template-columns:1fr}.portal-welcome{min-height:360px}.portal-grid{grid-template-columns:repeat(3,minmax(0,1fr))}.portal-card{flex-direction:column;text-align:center;min-height:170px;justify-content:center}}
@media(max-width:760px){.portal-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:680px){.portal-page{padding:22px 12px;align-items:flex-start}.portal-header{align-items:flex-start;flex-direction:column}.portal-brand-title{font-size:21px}.portal-welcome{border-radius:25px;padding:24px;min-height:auto}.portal-welcome h1{font-size:30px}.portal-panel{border-radius:25px;padding:14px}.portal-card{min-height:160px;border-radius:20px;padding:14px}.portal-footer{flex-direction:column;align-items:center}}
@media(max-width:430px){.portal-grid{grid-template-columns:1fr}.portal-card{min-height:132px;flex-direction:row;text-align:left;justify-content:flex-start}}
</style>

<main class="portal-page">
    <div class="portal-shell">
        <!-- Header -->
        <header class="portal-header">
            <div class="portal-brand">
                <?php if (!empty($heroLogo)): ?>
                    <img class="portal-logo" src="<?= \App\Helpers\H::e($heroLogo) ?>" alt="Logo">
                <?php else: ?>
                    <div class="portal-logo" style="display:flex;align-items:center;justify-content:center;color:#0f766e;font-size:26px;font-weight:900">P</div>
                <?php endif; ?>
                <div>
                    <h2 class="portal-brand-title"><?= \App\Helpers\H::e(isset($settings['school_name']) ? $settings['school_name'] : 'Portal Digital') ?></h2>
                    <p class="portal-brand-subtitle">Satu pintu layanan digital sekolah</p>
                </div>
            </div>
            <div class="portal-year">PORTAL · <?= date('Y') ?></div>
        </header>

        <section class="portal-layout">
            <!-- Left: Welcome -->
            <aside class="portal-welcome">
                <div class="portal-welcome-inner">
                    <div class="portal-badge">Portal Sekolah Digital</div>
                    <h1>Selamat Datang di <?= \App\Helpers\H::e(isset($settings['school_name']) ? $settings['school_name'] : 'Portal Digital') ?></h1>
                    <p>Akses layanan sekolah lebih mudah dalam satu halaman. Pilih portal sesuai kebutuhan untuk masuk ke layanan digital sekolah.</p>
                    <?php if (!empty($announcements)): ?>
                    <div style="margin-top:20px;padding:12px 16px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);border-radius:14px">
                        <p style="margin:0;font-size:12px;font-weight:700;color:#fbbf24">📢 <?= \App\Helpers\H::e($announcements[0]['title']) ?></p>
                        <?php if (!empty($announcements[0]['content'])): ?>
                        <p style="margin:4px 0 0;font-size:11px;opacity:.8;line-height:1.4"><?= \App\Helpers\H::e(mb_strimwidth($announcements[0]['content'], 0, 120, '...')) ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </aside>

            <!-- Right: App Grid -->
            <section class="portal-panel">
                <div class="portal-panel-title">
                    <h2>Pilih Layanan</h2>
                    <p>Masuk ke aplikasi sekolah yang tersedia.</p>
                </div>
                <div class="portal-grid">
                    <?php if (!empty($apps)): ?>
                    <?php foreach ($apps as $app):
                        $catColorKey = isset($app['category_color']) ? $app['category_color'] : 'emerald';
                        $cc = isset($catColors[$catColorKey]) ? $catColors[$catColorKey] : ['#0f766e','rgba(15,118,110,.10)'];
                        $accent = $cc[0]; $accentSoft = $cc[1];
                        $initial = strtoupper(substr($app['name'], 0, 1));
                        $hasLogo = !empty($app['logo']);
                    ?>
                    <a href="/app/<?= \App\Helpers\H::e($app['slug']) ?>" class="portal-card" style="--accent:<?= $accent ?>;--accent-soft:<?= $accentSoft ?>">
                        <div class="portal-card-media">
                            <?php if ($hasLogo): ?>
                                <img src="<?= \App\Helpers\H::e($app['logo']) ?>" alt="<?= \App\Helpers\H::e($app['name']) ?>" onerror="this.style.display='none';this.parentNode.querySelector('.portal-card-letter').style.display='flex'">
                            <?php endif; ?>
                            <span class="portal-card-letter"<?= $hasLogo ? ' style="display:none"' : '' ?>><?= $initial ?></span>
                        </div>
                        <div class="portal-card-content">
                            <h3><?= \App\Helpers\H::e($app['name']) ?></h3>
                            <p><?= \App\Helpers\H::e(!empty($app['short_description']) ? $app['short_description'] : (!empty($app['description']) ? $app['description'] : '')) ?></p>
                            <div class="portal-card-action" style="color:<?= $accent ?>">Masuk <span>›</span></div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p style="grid-column:1/-1;text-align:center;color:#94a3b8;padding:40px 0;font-size:13px">Belum ada aplikasi</p>
                    <?php endif; ?>
                </div>
            </section>
        </section>

        <!-- Footer -->
        <footer class="portal-footer">
            <div><?= \App\Helpers\H::e(!empty($settings['footer_text']) ? $settings['footer_text'] : '© 2025 SMP Muhammadiyah Unggulan Ashidiq.') ?></div>
            <?php if (!empty($settings['school_email'])): ?>
            <a href="mailto:<?= \App\Helpers\H::e($settings['school_email']) ?>"><?= \App\Helpers\H::e($settings['school_email']) ?></a>
            <?php endif; ?>
        </footer>
    </div>
</main>
