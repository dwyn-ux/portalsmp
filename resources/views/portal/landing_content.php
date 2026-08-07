<?php
/**
 * Landing page — smpam.site inspired.
 * Full-page background photo + frosted glass app tiles grid.
 */
?>
<style>
/* Full-page bg with overlay */
.portal-bg {
    min-height:100vh;
    background: linear-gradient(0deg, rgba(0,0,0,0.55), rgba(0,0,0,0.25)), url('https://images.unsplash.com/photo-1562774053-701939374585?w=1600&q=80') no-repeat center center fixed;
    background-size:cover;
    -webkit-background-size:cover;
}
/* App tile */
.app-tile {
    width:100px;
    height:100px;
    border-radius:10px;
    background:rgba(255,255,255,0.65);
    backdrop-filter:blur(8px);
    -webkit-backdrop-filter:blur(8px);
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    transition:all 0.25s ease;
    box-shadow:0 4px 12px rgba(0,0,0,0.15);
    cursor:pointer;
    overflow:hidden;
    position:relative;
}
.app-tile:hover {
    background:rgba(255,255,255,0.95);
    transform:translateY(-4px);
    box-shadow:0 8px 24px rgba(0,0,0,0.25);
}
.app-tile .tile-icon {
    width:36px;
    height:36px;
    border-radius:8px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:6px;
}
.app-tile .tile-name {
    font-size:11px;
    font-weight:700;
    color:#222;
    text-align:center;
    line-height:1.2;
}
.app-tile .tile-sub {
    font-size:9px;
    color:#666;
    text-align:center;
    line-height:1.3;
    margin-top:1px;
}
/* Footer */
.portal-footer {
    position:fixed;
    bottom:0;
    left:0;
    right:0;
    text-align:center;
    padding:12px 16px;
    background:rgba(0,0,0,0.4);
    backdrop-filter:blur(8px);
    -webkit-backdrop-filter:blur(8px);
    color:rgba(255,255,255,0.7);
    font-size:11px;
    z-index:10;
}
</style>

<div class="portal-bg">
    <div style="max-width:800px;margin:0 auto;padding:30px 16px 100px">
        <!-- Logo + Title -->
        <div style="text-align:center;margin-bottom:24px">
            <div style="width:80px;height:80px;background:#fff;border-radius:16px;display:inline-flex;align-items:center;justify-content:center;box-shadow:0 4px 16px rgba(0,0,0,0.2);margin-bottom:12px">
                <svg width="40" height="40" fill="none" stroke="#065f46" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div style="background:rgba(255,255,255,0.65);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);display:inline-block;padding:10px 24px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,0.15)">
                <h1 style="margin:0;font-size:14px;font-weight:700;color:#065f46;letter-spacing:0.02em">
                    Portal Resmi SMP Muhammadiyah Unggulan Ashidiq
                </h1>
            </div>
        </div>

        <!-- Announcement popup (if any) -->
        <?php if (!empty($announcements)): ?>
        <div x-data="{ open: true }" x-show="open" x-cloak style="margin-bottom:20px">
            <div style="background:rgba(251,191,36,0.9);backdrop-filter:blur(8px);border-radius:10px;padding:14px 18px;display:flex;align-items:flex-start;gap:10px;box-shadow:0 4px 12px rgba(0,0,0,0.15)">
                <svg width="16" height="16" fill="none" stroke="#064e3b" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:2px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div style="flex:1;min-width:0">
                    <p style="margin:0;font-size:12px;font-weight:700;color:#064e3b">
                        <?= \App\Helpers\H::e($announcements[0]['title']) ?>
                    </p>
                    <?php if (!empty($announcements[0]['content'])): ?>
                    <p style="margin:4px 0 0;font-size:11px;color:#064e3b;opacity:0.8">
                        <?= \App\Helpers\H::e(mb_strimwidth($announcements[0]['content'], 0, 120, '...')) ?>
                    </p>
                    <?php endif; ?>
                </div>
                <button @click="open = false" style="background:none;border:none;cursor:pointer;padding:0;color:#064e3b;opacity:0.6;font-size:16px;line-height:1">&times;</button>
            </div>
        </div>
        <?php endif; ?>

        <!-- App Tiles Grid -->
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:14px">
            <?php if (!empty($apps)): ?>
            <?php
            $iconColors = ['emerald'=>'#059669','sky'=>'#0284c7','violet'=>'#7c3aed','amber'=>'#d97706','rose'=>'#e11d48','blue'=>'#2563eb','indigo'=>'#4f46e5','pink'=>'#db2777'];
            ?>
            <?php foreach ($apps as $app): ?>
            <?php $ic = $app['icon_color'] ?? 'emerald'; $stroke = $iconColors[$ic] ?? '#4b5563'; ?>
            <a href="/app/<?= \App\Helpers\H::e($app['slug']) ?>" class="app-tile">
                <div class="tile-icon" style="background:<?= \App\Helpers\H::e($ic) ?>18">
                    <svg width="20" height="20" fill="none" stroke="<?= $stroke ?>" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/>
                    </svg>
                </div>
                <span class="tile-name"><?= \App\Helpers\H::e($app['name']) ?></span>
                <span class="tile-sub"><?= \App\Helpers\H::e($app['category_name'] ?? '') ?></span>
            </a>
            <?php endforeach; ?>
            <?php else: ?>
            <p style="color:rgba(255,255,255,0.6);font-size:13px;text-align:center;padding:40px 0">Belum ada aplikasi</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="portal-footer">
    <?= \App\Helpers\H::e($settings['footer_text'] ?? '© 2025 SMP Muhammadiyah Unggulan Ashidiq. All rights reserved.') ?>
</div>
