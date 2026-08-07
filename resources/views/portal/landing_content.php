<?php
/**
 * Landing page — smpam-inspired, unique version.
 * Category-colored tiles + admin logo upload + clean dark bg.
 */
?>
<style>
.portal-bg {
    min-height:100vh;
    background: linear-gradient(170deg, #111318 0%, #1a1d24 40%, #15181e 100%);
    position:relative;
}
.portal-bg::before {
    content:'';
    position:fixed;
    top:0;left:0;right:0;bottom:0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
    background-size:200px 200px;
    pointer-events:none;
    z-index:0;
}
.portal-bg > * { position:relative; z-index:1; }
/* Subtle color accents */
.portal-bg::after {
    content:'';
    position:fixed;
    top:-20%;right:-10%;
    width:600px;height:600px;
    background:radial-gradient(circle, rgba(16,185,129,0.06) 0%, transparent 70%);
    pointer-events:none;
    z-index:0;
}
.app-tile {
    width:105px;
    height:112px;
    border-radius:14px;
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.08);
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    transition:all 0.3s cubic-bezier(0.4,0,0.2,1);
    cursor:pointer;
    position:relative;
    overflow:hidden;
}
/* Category color top bar */
.app-tile::before {
    content:'';
    position:absolute;
    top:0;left:0;right:0;
    height:3px;
    opacity:0.8;
    transition:opacity 0.3s;
}
.app-tile:hover {
    background:rgba(255,255,255,0.12);
    border-color:rgba(255,255,255,0.15);
    transform:translateY(-6px);
    box-shadow:0 12px 32px rgba(0,0,0,0.3);
}
.app-tile:hover::before { opacity:1; height:3px; }
.app-tile .tile-icon {
    width:40px;
    height:40px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:8px;
    transition:transform 0.3s;
}
.app-tile:hover .tile-icon { transform:scale(1.1); }
.app-tile .tile-name {
    font-size:11px;
    font-weight:700;
    color:rgba(255,255,255,0.85);
    text-align:center;
    line-height:1.2;
    transition:color 0.3s;
}
.app-tile:hover .tile-name { color:#fff; }
.app-tile .tile-sub {
    font-size:9px;
    color:rgba(255,255,255,0.3);
    text-align:center;
    line-height:1.3;
    margin-top:2px;
    transition:color 0.3s;
}
.app-tile:hover .tile-sub { color:rgba(255,255,255,0.5); }
/* Logo scroll */
.logo-strip {
    display:flex;
    align-items:center;
    justify-content:center;
    gap:24px;
    opacity:0.4;
    transition:opacity 0.3s;
}
.logo-strip:hover { opacity:0.7; }
.logo-strip img {
    height:32px;
    width:auto;
    filter:brightness(0) invert(1);
    opacity:0.7;
}
</style>

<div class="portal-bg">
    <div style="max-width:780px;margin:0 auto;padding:40px 16px 20px">

        <!-- Header -->
        <div style="text-align:center;margin-bottom:12px">
            <div style="width:64px;height:64px;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);border-radius:16px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:14px">
                <svg width="28" height="28" fill="none" stroke="#fbbf24" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h1 style="margin:0 0 4px;font-size:20px;font-weight:800;color:rgba(255,255,255,0.9);letter-spacing:-0.01em">
                Portal Digital
            </h1>
            <p style="margin:0;font-size:11px;color:rgba(255,255,255,0.35);letter-spacing:0.1em;text-transform:uppercase;font-weight:500">
                SMP Muhammadiyah Unggulan Ashidiq
            </p>
        </div>

        <!-- Partner logos strip (from admin settings: hero_logos JSON) -->
        <?php
        $heroLogos = [];
        if (!empty($settings['hero_logos'])) {
            $heroLogos = json_decode($settings['hero_logos'], true) ?? [];
        }
        ?>
        <?php if (!empty($heroLogos)): ?>
        <div class="logo-strip" style="margin:16px 0 20px">
            <?php foreach ($heroLogos as $logo): ?>
                <img src="<?= \App\Helpers\H::e($logo) ?>" alt="Logo">
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Announcement -->
        <?php if (!empty($announcements)): ?>
        <div x-data="{ open: true }" x-show="open" x-cloak style="margin-bottom:22px">
            <div style="background:rgba(251,191,36,0.08);border:1px solid rgba(251,191,36,0.15);border-radius:12px;padding:12px 16px;display:flex;align-items:flex-start;gap:10px">
                <span style="width:6px;height:6px;border-radius:50%;background:#fbbf24;margin-top:6px;flex-shrink:0"></span>
                <div style="flex:1;min-width:0">
                    <p style="margin:0;font-size:12px;font-weight:700;color:rgba(255,255,255,0.8)">
                        <?= \App\Helpers\H::e($announcements[0]['title']) ?>
                    </p>
                    <?php if (!empty($announcements[0]['content'])): ?>
                    <p style="margin:3px 0 0;font-size:11px;color:rgba(255,255,255,0.35);line-height:1.4">
                        <?= \App\Helpers\H::e(mb_strimwidth($announcements[0]['content'], 0, 140, '...')) ?>
                    </p>
                    <?php endif; ?>
                </div>
                <button @click="open = false" style="background:none;border:none;cursor:pointer;color:rgba(255,255,255,0.3);font-size:18px;line-height:1;padding:0">&times;</button>
            </div>
        </div>
        <?php endif; ?>

        <!-- App Tiles Grid -->
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:12px">
            <?php if (!empty($apps)): ?>
            <?php
            $catColors = [];
            foreach ($categories as $cat) {
                $catColors[$cat['id']] = $cat['color'] ?? 'emerald';
            }
            $colorHex = [
                'emerald' => '#10b981', 'teal' => '#14b8a6', 'sky' => '#0ea5e9',
                'blue' => '#3b82f6', 'indigo' => '#6366f1', 'violet' => '#8b5cf6',
                'amber' => '#f59e0b', 'rose' => '#f43f5e', 'pink' => '#ec4899',
            ];
            ?>
            <?php foreach ($apps as $app): ?>
            <?php
                $catColor = $catColors[$app['category_id'] ?? 0] ?? 'emerald';
                $barColor = $colorHex[$catColor] ?? '#10b981';
                $iconBg = $barColor;
            ?>
            <a href="/app/<?= \App\Helpers\H::e($app['slug']) ?>" class="app-tile" style="--cat:<?= $barColor ?>">
                <style>.app-tile[style*="<?= $barColor ?>"]::before { background:<?= $barColor ?>; }</style>
                <div class="tile-icon" style="background:<?= $barColor ?>15">
                    <svg width="20" height="20" fill="none" stroke="<?= $barColor ?>" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/>
                    </svg>
                </div>
                <span class="tile-name"><?= \App\Helpers\H::e($app['name']) ?></span>
                <span class="tile-sub"><?= \App\Helpers\H::e($app['category_name'] ?? '') ?></span>
            </a>
            <?php endforeach; ?>
            <?php else: ?>
            <p style="color:rgba(255,255,255,0.3);font-size:13px;text-align:center;padding:48px 0">Belum ada aplikasi</p>
            <?php endif; ?>
        </div>

        <!-- Stats bar -->
        <?php if (!empty($stats)): ?>
        <div style="display:flex;justify-content:center;gap:32px;margin-top:28px;padding-top:16px;border-top:1px solid rgba(255,255,255,0.06)">
            <?php
            $statItems = [
                ['label' => 'Aplikasi', 'value' => $stats['total_apps'] ?? 0],
                ['label' => 'Guru', 'value' => $stats['total_guru'] ?? 0],
                ['label' => 'Siswa', 'value' => $stats['total_siswa'] ?? 0],
                ['label' => 'Sistem', 'value' => $stats['total_systems'] ?? 0],
            ];
            ?>
            <?php foreach ($statItems as $stat): ?>
            <div style="text-align:center">
                <p style="margin:0;font-size:18px;font-weight:800;color:rgba(255,255,255,0.8);line-height:1"><?= $stat['value'] ?></p>
                <p style="margin:4px 0 0;font-size:9px;color:rgba(255,255,255,0.25);text-transform:uppercase;letter-spacing:0.1em;font-weight:600"><?= $stat['label'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Footer -->
        <div style="text-align:center;padding:20px 0 8px;color:rgba(255,255,255,0.2);font-size:10px">
            <?= \App\Helpers\H::e($settings['footer_text'] ?? '© 2025 SMP Muhammadiyah Unggulan Ashidiq.') ?>
        </div>
    </div>
</div>
