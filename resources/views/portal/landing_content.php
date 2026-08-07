<?php
/**
 * Landing page — smpam.site inspired, but unique.
 * Full-page bg + frosted tiles + stats bar + smooth footer.
 */
?>
<style>
.portal-bg {
    min-height:100vh;
    background: linear-gradient(160deg, rgba(6,95,70,0.85), rgba(6,78,59,0.92)), url('https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1600&q=80') no-repeat center center fixed;
    background-size:cover;
    -webkit-background-size:cover;
}
.app-tile {
    width:105px;
    height:110px;
    border-radius:14px;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);
    border:1px solid rgba(255,255,255,0.15);
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
.app-tile::before {
    content:'';
    position:absolute;
    top:0;left:0;right:0;
    height:3px;
    background:rgba(251,191,36,0.6);
    opacity:0;
    transition:opacity 0.3s;
}
.app-tile:hover {
    background:rgba(255,255,255,0.95);
    transform:translateY(-6px);
    box-shadow:0 12px 32px rgba(0,0,0,0.25);
    border-color:transparent;
}
.app-tile:hover::before { opacity:1; }
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
    color:#f0fdf4;
    text-align:center;
    line-height:1.2;
    transition:color 0.3s;
}
.app-tile:hover .tile-name { color:#111; }
.app-tile .tile-sub {
    font-size:9px;
    color:rgba(255,255,255,0.5);
    text-align:center;
    line-height:1.3;
    margin-top:2px;
    transition:color 0.3s;
}
.app-tile:hover .tile-sub { color:#888; }
.portal-footer {
    text-align:center;
    padding:20px 16px;
    color:rgba(255,255,255,0.35);
    font-size:11px;
}
</style>

<div class="portal-bg">
    <div style="max-width:780px;margin:0 auto;padding:40px 16px 20px">
        <!-- Header -->
        <div style="text-align:center;margin-bottom:28px">
            <!-- Logo -->
            <div style="width:72px;height:72px;background:rgba(255,255,255,0.12);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,0.15);border-radius:18px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:14px;box-shadow:0 8px 24px rgba(0,0,0,0.2)">
                <svg width="32" height="32" fill="none" stroke="#fbbf24" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <!-- Title -->
            <h1 style="margin:0 0 6px;font-size:22px;font-weight:800;color:#f0fdf4;letter-spacing:-0.01em">
                Portal Digital
            </h1>
            <p style="margin:0;font-size:12px;color:rgba(255,255,255,0.45);letter-spacing:0.08em;text-transform:uppercase;font-weight:500">
                SMP Muhammadiyah Unggulan Ashidiq
            </p>
            <!-- Gold line -->
            <div style="width:32px;height:2px;background:#fbbf24;margin:16px auto 0;border-radius:1px"></div>
        </div>

        <!-- Announcement (if any) -->
        <?php if (!empty($announcements)): ?>
        <div x-data="{ open: true }" x-show="open" x-cloak style="margin-bottom:22px">
            <div style="background:rgba(251,191,36,0.15);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border:1px solid rgba(251,191,36,0.25);border-radius:12px;padding:14px 16px;display:flex;align-items:flex-start;gap:10px">
                <span style="font-size:14px;line-height:1;margin-top:1px">&#x1F514;</span>
                <div style="flex:1;min-width:0">
                    <p style="margin:0;font-size:12px;font-weight:700;color:#fbbf24">
                        <?= \App\Helpers\H::e($announcements[0]['title']) ?>
                    </p>
                    <?php if (!empty($announcements[0]['content'])): ?>
                    <p style="margin:4px 0 0;font-size:11px;color:rgba(255,255,255,0.5);line-height:1.4">
                        <?= \App\Helpers\H::e(mb_strimwidth($announcements[0]['content'], 0, 140, '...')) ?>
                    </p>
                    <?php endif; ?>
                </div>
                <button @click="open = false" style="background:none;border:none;cursor:pointer;color:rgba(255,255,255,0.4);font-size:18px;line-height:1;padding:0">&times;</button>
            </div>
        </div>
        <?php endif; ?>

        <!-- App Tiles Grid -->
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:12px">
            <?php if (!empty($apps)): ?>
            <?php
            $iconColors = ['emerald'=>'#34d399','sky'=>'#38bdf8','violet'=>'#a78bfa','amber'=>'#fbbf24','rose'=>'#fb7185','blue'=>'#60a5fa','indigo'=>'#818cf8','pink'=>'#f472b6'];
            ?>
            <?php foreach ($apps as $app): ?>
            <?php $ic = $app['icon_color'] ?? 'emerald'; $stroke = $iconColors[$ic] ?? '#94a3b8'; ?>
            <a href="/app/<?= \App\Helpers\H::e($app['slug']) ?>" class="app-tile">
                <div class="tile-icon" style="background:rgba(255,255,255,0.1)">
                    <svg width="20" height="20" fill="none" stroke="<?= $stroke ?>" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/>
                    </svg>
                </div>
                <span class="tile-name"><?= \App\Helpers\H::e($app['name']) ?></span>
                <span class="tile-sub"><?= \App\Helpers\H::e($app['category_name'] ?? '') ?></span>
            </a>
            <?php endforeach; ?>
            <?php else: ?>
            <p style="color:rgba(255,255,255,0.4);font-size:13px;text-align:center;padding:48px 0">Belum ada aplikasi</p>
            <?php endif; ?>
        </div>

        <!-- Stats bar -->
        <?php if (!empty($stats)): ?>
        <div style="display:flex;justify-content:center;gap:32px;margin-top:32px;padding-top:20px;border-top:1px solid rgba(255,255,255,0.08)">
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
                <p style="margin:0;font-size:20px;font-weight:800;color:#fbbf24;line-height:1"><?= $stat['value'] ?></p>
                <p style="margin:4px 0 0;font-size:10px;color:rgba(255,255,255,0.35);text-transform:uppercase;letter-spacing:0.08em;font-weight:500"><?= $stat['label'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="portal-footer" style="margin-top:24px">
            <p style="margin:0">
                <?= \App\Helpers\H::e($settings['footer_text'] ?? '© 2025 SMP Muhammadiyah Unggulan Ashidiq. All rights reserved.') ?>
            </p>
        </div>
    </div>
</div>
