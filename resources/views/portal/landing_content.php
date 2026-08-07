<?php
/**
 * Landing page — editorial layout.
 * 60/30/10: Deep Emerald 60% | Cream White 30% | Gold 10%
 */
?>
<style>
.texture-noise {
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.05'/%3E%3C/svg%3E");
    background-repeat: repeat;
    background-size: 256px 256px;
}
.texture-lines {
    background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 20L20 0' stroke='%23fff' stroke-opacity='0.04' stroke-width='0.5' fill='none'/%3E%3C/svg%3E");
}
.texture-dots-dark {
    background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='1' cy='1' r='0.8' fill='%23fff' fill-opacity='0.04'/%3E%3C/svg%3E");
}
</style>

<!-- ═══ Navbar ═══ -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#065f46">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="font-bold text-sm" style="color:#065f46">SMP Muhammadiyah Unggulan Ashidiq</span>
            </div>
            <a href="#apps" class="text-sm text-gray-500 hover:text-emerald-800 font-medium transition hidden sm:block">Aplikasi</a>
        </div>
    </div>
</nav>

<!-- ═══ Hero — 60% deep emerald ═══ -->
<section style="background:#065f46" class="pt-14 texture-noise texture-lines relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Top rule -->
        <div class="flex items-center justify-between py-4" style="border-bottom:1px solid rgba(255,255,255,0.1)">
            <span style="color:rgba(255,255,255,0.4);font-size:11px;letter-spacing:0.1em;text-transform:uppercase">Portal Digital Sekolah</span>
            <span style="color:rgba(255,255,255,0.4);font-size:11px;letter-spacing:0.1em;text-transform:uppercase">Sistem Terintegrasi</span>
        </div>

        <!-- Main -->
        <div class="py-16 sm:py-20 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8">
                <!-- Left: Type -->
                <div class="lg:col-span-7">
                    <p style="color:#fbbf24;font-size:11px;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:1.5rem;font-weight:600">
                        Muhammadiyah Unggulan Ashidiq
                    </p>
                    <h1 style="color:#f0fdf4;font-size:clamp(40px,8vw,80px);line-height:0.95;font-weight:800;letter-spacing:-0.03em;margin-bottom:2rem">
                        Semua yang<br>
                        dibutuhkan,<br>
                        <span style="color:#fbbf24">satu pintu.</span>
                    </h1>
                    <p style="color:rgba(255,255,255,0.55);font-size:16px;line-height:1.6;max-width:420px;margin-bottom:2.5rem">
                        Aplikasi, data, dan informasi sekolah. Tidak perlu kemana-mana.
                    </p>
                    <a href="#apps" style="display:inline-flex;align-items:center;gap:8px;background:#fbbf24;color:#064e3b;font-size:14px;font-weight:700;padding:12px 28px;transition:background 0.2s" onmouseover="this.style.background='#f59e0b'" onmouseout="this.style.background='#fbbf24'">
                        Jelajahi
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                </div>

                <!-- Right: Stats -->
                <div class="lg:col-span-5 lg:flex lg:items-end">
                    <div style="width:100%">
                        <?php
                        $statItems = [
                            ['label' => 'Aplikasi', 'value' => $stats['total_apps'] ?? 0, 'color' => '#fbbf24'],
                            ['label' => 'Guru', 'value' => $stats['total_guru'] ?? 0, 'color' => '#f0fdf4'],
                            ['label' => 'Siswa', 'value' => $stats['total_siswa'] ?? 0, 'color' => '#f0fdf4'],
                            ['label' => 'Sistem', 'value' => $stats['total_systems'] ?? 0, 'color' => '#fbbf24'],
                        ];
                        ?>
                        <?php foreach ($statItems as $i => $stat): ?>
                        <div style="display:flex;align-items:baseline;gap:12px;<?= $i > 0 ? 'border-top:1px solid rgba(255,255,255,0.08);' : '' ?>padding:16px 0">
                            <span style="font-size:clamp(36px,5vw,56px);font-weight:800;color:<?= $stat['color'] ?>;line-height:1;letter-spacing:-0.02em;min-width:80px">
                                <?= $stat['value'] ?>
                            </span>
                            <span style="color:rgba(255,255,255,0.35);font-size:12px;letter-spacing:0.1em;text-transform:uppercase;font-weight:500">
                                <?= $stat['label'] ?>
                            </span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══ Announcement Popup ═══ -->
<?php if (!empty($announcements)): ?>
<div x-data="{ open: true }" x-show="open" x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center p-4"
     style="background:rgba(6,95,70,0.85)"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <div class="max-w-md w-full" style="max-height:80vh;overflow:hidden;background:#fff"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0">
        <div style="background:#065f46;padding:24px;color:#f0fdf4;position:relative" class="texture-dots-dark">
            <p style="font-size:11px;letter-spacing:0.15em;text-transform:uppercase;color:#fbbf24;margin-bottom:8px;font-weight:600">Pengumuman</p>
            <h3 style="font-size:18px;font-weight:700">Informasi Terbaru</h3>
            <button @click="open = false" style="position:absolute;top:16px;right:16px;width:32px;height:32px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.15);background:none;cursor:pointer" onmouseover="this.style.borderColor='rgba(255,255,255,0.4)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.15)'">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div style="overflow-y:auto;max-height:50vh;padding:16px 24px">
            <?php foreach ($announcements as $announcement): ?>
            <div style="padding:12px 0;<?= $announcement !== reset($announcements) ? 'border-top:1px solid #f3f4f6;' : '' ?>">
                <div style="display:flex;align-items:flex-start;gap:10px">
                    <div style="width:6px;height:6px;border-radius:50%;margin-top:6px;flex-shrink:0;
                        background:<?= $announcement['priority'] === 'high' ? '#ef4444' : ($announcement['priority'] === 'medium' ? '#f59e0b' : '#10b981') ?>">
                    </div>
                    <div>
                        <p style="font-size:14px;font-weight:600;color:#111"><?= \App\Helpers\H::e($announcement['title']) ?></p>
                        <?php if (!empty($announcement['content'])): ?>
                        <p style="font-size:13px;color:#6b7280;margin-top:4px;line-height:1.5"><?= nl2br(\App\Helpers\H::e(mb_strimwidth($announcement['content'], 0, 200, '...'))) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div style="padding:16px 24px;border-top:1px solid #f3f4f6">
            <button @click="open = false" style="width:100%;background:#065f46;color:#f0fdf4;font-size:14px;font-weight:600;padding:12px;border:none;cursor:pointer;transition:background 0.2s" onmouseover="this.style.background='#064e3b'" onmouseout="this.style.background='#065f46'">
                Mengerti
            </button>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ═══ Applications — 30% cream white ═══ -->
<section id="apps" style="background:#fafaf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div style="padding:64px 0 32px;border-bottom:1px solid #e8e8e4">
            <p style="color:#065f46;font-size:11px;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:12px;font-weight:600">Digital</p>
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <h2 style="font-size:clamp(28px,4vw,40px);font-weight:800;color:#1a1a1a;letter-spacing:-0.02em;line-height:1">Aplikasi</h2>
                <p style="font-size:13px;color:#9ca3af" x-data="appFilter()" x-text="filteredApps.length + ' tersedia'"></p>
            </div>
        </div>

        <div x-data="appFilter()" style="padding:32px 0">
            <!-- Search + Filter -->
            <div class="flex flex-col sm:flex-row gap-3 mb-8">
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" x-model="search" placeholder="Cari..."
                           style="width:100%;padding:10px 12px 10px 36px;border:1px solid #ddd;font-size:14px;background:#fff;outline:none;transition:border-color 0.2s"
                           onfocus="this.style.borderColor='#065f46'" onblur="this.style.borderColor='#ddd'">
                </div>
                <div class="flex flex-wrap gap-1.5">
                    <button @click="activeCategory = ''"
                            :style="activeCategory === '' ? 'background:#065f46;color:#f0fdf4' : 'background:#f0f0ec;color:#6b7280'"
                            style="padding:8px 14px;font-size:12px;font-weight:600;border:none;cursor:pointer;transition:all 0.15s">
                        Semua
                    </button>
                    <?php foreach ($categories as $cat): ?>
                    <button @click="activeCategory = '<?= \App\Helpers\H::e($cat['slug']) ?>'"
                            :style="activeCategory === '<?= \App\Helpers\H::e($cat['slug']) ?>' ? 'background:#065f46;color:#f0fdf4' : 'background:#f0f0ec;color:#6b7280'"
                            style="padding:8px 14px;font-size:12px;font-weight:600;border:none;cursor:pointer;transition:all 0.15s">
                        <?= \App\Helpers\H::e($cat['name']) ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Apps list -->
            <div>
                <template x-for="app in filteredApps" :key="app.id">
                    <a :href="'/app/' + app.slug" style="display:flex;align-items:center;gap:16px;padding:16px 0;border-bottom:1px solid #e8e8e4;text-decoration:none;transition:background 0.15s" onmouseover="this.style.background='#f5f5f0'" onmouseout="this.style.background='transparent'">
                        <div style="width:40px;height:40px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0"
                             :style="'background:' + app.icon_color + '15;color:' + (app.icon_color === 'emerald' ? '#059669' : app.icon_color === 'sky' ? '#0284c7' : app.icon_color === 'violet' ? '#7c3aed' : app.icon_color === 'amber' ? '#d97706' : app.icon_color === 'rose' ? '#e11d48' : '#4b5563')">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p style="font-size:14px;font-weight:600;color:#1a1a1a" x-text="app.name"></p>
                            <p style="font-size:12px;color:#9ca3af;margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" x-text="app.short_description || app.description || ''"></p>
                        </div>
                        <div class="hidden sm:flex items-center gap-2 flex-shrink-0">
                            <span style="font-size:10px;font-weight:600;color:#9ca3af;background:#f0f0ec;padding:2px 8px;text-transform:uppercase;letter-spacing:0.05em" x-text="app.category_name"></span>
                        </div>
                        <svg width="16" height="16" fill="none" stroke="#ccc" viewBox="0 0 24 24" class="flex-shrink-0"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </template>
            </div>

            <!-- Empty -->
            <div x-show="filteredApps.length === 0" x-cloak style="text-align:center;padding:64px 0">
                <p style="font-size:14px;color:#6b7280;font-weight:500">Tidak ditemukan</p>
                <p style="font-size:12px;color:#9ca3af;margin-top:4px">Coba kata kunci lain</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══ Footer — 60% deep emerald ═══ -->
<footer style="background:#065f46;padding:48px 0" class="texture-lines">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <p style="font-size:14px;font-weight:700;color:#f0fdf4;margin-bottom:8px">Portal Digital</p>
                <p style="font-size:12px;color:rgba(255,255,255,0.4);line-height:1.6;max-width:280px">
                    Pusat seluruh aplikasi digital sekolah.
                </p>
            </div>
            <div>
                <p style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-bottom:12px;font-weight:600">Tautan</p>
                <a href="/" style="font-size:13px;color:rgba(255,255,255,0.5);text-decoration:none;transition:color 0.2s" onmouseover="this.style.color='#fbbf24'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">Portal Utama</a>
            </div>
            <div>
                <p style="font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-bottom:12px;font-weight:600">Kontak</p>
                <?php if (!empty($settings['school_email'])): ?>
                <p style="font-size:13px;color:rgba(255,255,255,0.5);margin-bottom:4px"><?= \App\Helpers\H::e($settings['school_email']) ?></p>
                <?php endif; ?>
                <?php if (!empty($settings['school_phone'])): ?>
                <p style="font-size:13px;color:rgba(255,255,255,0.5)"><?= \App\Helpers\H::e($settings['school_phone']) ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div style="border-top:1px solid rgba(255,255,255,0.08);margin-top:32px;padding-top:24px;text-align:center">
            <p style="font-size:11px;color:rgba(255,255,255,0.2)"><?= \App\Helpers\H::e($settings['footer_text'] ?? '© 2025 SMP Muhammadiyah Unggulan Ashidiq.') ?></p>
        </div>
    </div>
</footer>

<script>
function appFilter() {
    return {
        search: '',
        activeCategory: '',
        apps: <?= json_encode($apps) ?>,
        get filteredApps() {
            return this.apps.filter(app => {
                const matchSearch = !this.search ||
                    app.name.toLowerCase().includes(this.search.toLowerCase()) ||
                    (app.description || '').toLowerCase().includes(this.search.toLowerCase()) ||
                    (app.category_name || '').toLowerCase().includes(this.search.toLowerCase());
                const matchCategory = !this.activeCategory || app.category_slug === this.activeCategory;
                return matchSearch && matchCategory;
            });
        }
    };
}
</script>
