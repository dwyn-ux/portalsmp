<?php
/**
 * Landing page content — full page with educational textures.
 */
?>
<style>
/* ── Islamic geometric texture (CSS-only) ── */
.texture-islamic {
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.texture-dots {
    background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='1.5' cy='1.5' r='1' fill='%23ffffff' fill-opacity='0.05'/%3E%3C/svg%3E");
}
.texture-grid {
    background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23000000' fill-opacity='0.02'%3E%3Cpath d='M0 38.59l2.83-2.83 1.41 1.41L1.41 40H0v-1.41zM0 20l4-4 2 2-4 4-2-2zm0-20l2.83 2.83L1.41 4.24 0 2.83V0h1.41L4.24 2.83 2.83 4.24 0 1.41V0z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
/* ── Star pattern for hero ── */
.texture-stars {
    background-image: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23ffffff' stroke-opacity='0.06' stroke-width='0.5'%3E%3Cpath d='M40 10l5 15h16l-13 9 5 15-13-9-13 9 5-15L19 25h16z'/%3E%3C/g%3E%3C/svg%3E");
}
/* ── Divider wave ── */
.wave-divider { position: relative; }
.wave-divider::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 40px;
    background: url("data:image/svg+xml,%3Csvg viewBox='0 0 1440 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill='%23f9fafb' d='M0 20C360 0 720 40 1080 20s360 20 360 20v20H0z'/%3E%3C/svg%3E") no-repeat bottom center;
    background-size: cover;
}
</style>

<!-- ═══ Navbar ═══ -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/25">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm leading-tight">Portal Digital</p>
                    <p class="text-[10px] text-gray-400 leading-tight">SMP Muhammadiyah Unggulan Ashidiq</p>
                </div>
            </div>
            <a href="#apps" class="text-sm text-gray-500 hover:text-emerald-600 font-medium transition-colors hidden sm:block">Aplikasi</a>
        </div>
    </div>
</nav>

<!-- ═══ Hero ═══ -->
<section class="relative pt-24 overflow-hidden">
    <!-- Background layers -->
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-800"></div>
    <div class="absolute inset-0 texture-stars"></div>
    <div class="absolute inset-0 texture-dots"></div>
    <!-- Decorative orbs -->
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-white/[0.03] rounded-full -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-emerald-400/[0.04] rounded-full translate-y-1/2 -translate-x-1/4"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">
        <div class="max-w-2xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/15 text-white/80 text-xs font-medium tracking-wide uppercase px-4 py-1.5 rounded-full mb-6">
                <span class="w-1.5 h-1.5 bg-emerald-300 rounded-full animate-pulse"></span>
                SMP Muhammadiyah Unggulan Ashidiq
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-4 leading-[1.1] tracking-tight">
                Portal Digital<br>Sekolah
            </h1>
            <p class="text-base sm:text-lg text-emerald-100/70 mb-8 max-w-md mx-auto leading-relaxed">
                Akses seluruh aplikasi dan informasi sekolah dalam satu tempat terintegrasi.
            </p>
            <a href="#apps" class="group inline-flex items-center gap-2 bg-white text-emerald-700 font-semibold text-sm px-7 py-3 rounded-xl hover:bg-emerald-50 transition-all duration-200 shadow-lg shadow-black/10">
                Lihat Aplikasi
                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mt-12 max-w-3xl mx-auto">
            <?php
            $statItems = [
                ['label' => 'Aplikasi', 'value' => $stats['total_apps'] ?? 0, 'color' => 'emerald', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                ['label' => 'Guru', 'value' => $stats['total_guru'] ?? 0, 'color' => 'blue', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M19 7a3 3 0 11-6 0 3 3 0 016 0z'],
                ['label' => 'Siswa', 'value' => $stats['total_siswa'] ?? 0, 'color' => 'violet', 'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222'],
                ['label' => 'Sistem', 'value' => $stats['total_systems'] ?? 0, 'color' => 'amber', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
            ];
            ?>
            <?php foreach ($statItems as $stat): ?>
            <div class="group bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-3.5 hover:bg-white/15 hover:border-white/20 transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 bg-white/10">
                        <svg class="w-4 h-4 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $stat['icon'] ?>"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xl font-extrabold text-white leading-none"><?= $stat['value'] ?></p>
                        <p class="text-[10px] text-white/50 font-medium mt-0.5 uppercase tracking-wider"><?= $stat['label'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bottom wave -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full"><path d="M0 60V30C240 50 480 10 720 30S1200 50 1440 30V60H0Z" fill="#f9fafb"/></svg>
    </div>
</section>

<!-- ═══ Announcement Popup Modal ═══ -->
<?php if (!empty($announcements)): ?>
<div x-data="{ open: true }" x-show="open" x-cloak
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full max-h-[80vh] overflow-hidden"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0">
        <div class="relative bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-5 text-white overflow-hidden">
            <div class="absolute inset-0 texture-dots opacity-50"></div>
            <div class="relative z-10">
                <h3 class="text-lg font-bold pr-8">Pengumuman</h3>
                <p class="text-emerald-100/80 text-sm mt-0.5">Informasi terbaru</p>
            </div>
            <button @click="open = false"
                    class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center transition-colors z-20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="px-6 py-4 overflow-y-auto max-h-[50vh] space-y-3">
            <?php foreach ($announcements as $announcement): ?>
            <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                <div class="w-2 h-2 rounded-full mt-2 flex-shrink-0
                    <?php if ($announcement['priority'] === 'high'): ?>bg-red-500
                    <?php elseif ($announcement['priority'] === 'medium'): ?>bg-amber-500
                    <?php else: ?>bg-emerald-500<?php endif; ?>">
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm"><?= \App\Helpers\H::e($announcement['title']) ?></h4>
                    <?php if (!empty($announcement['content'])): ?>
                    <p class="text-sm text-gray-500 mt-1 leading-relaxed"><?= nl2br(\App\Helpers\H::e(mb_strimwidth($announcement['content'], 0, 200, '...'))) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            <button @click="open = false"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold py-2.5 rounded-xl transition-colors">
                Mengerti
            </button>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ═══ Applications ═══ -->
<section id="apps" class="relative py-16 bg-gray-50 texture-islamic">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <div class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-md mb-3">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Digital
                </div>
                <h2 class="text-xl font-extrabold text-gray-900">Aplikasi</h2>
                <p class="text-sm text-gray-400 mt-1">Semua aplikasi digital sekolah</p>
            </div>
            <p class="text-sm text-gray-400" x-data="appFilter()" x-text="filteredApps.length + ' tersedia'"></p>
        </div>

        <div x-data="appFilter()">
            <!-- Search -->
            <div class="relative mb-5">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" x-model="search" placeholder="Cari aplikasi..."
                       class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all shadow-sm">
            </div>

            <!-- Category Filters -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button @click="activeCategory = ''"
                        :class="activeCategory === '' ? 'bg-gray-900 text-white' : 'bg-white text-gray-500 hover:bg-gray-100 border border-gray-200'"
                        class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 shadow-sm">
                    Semua
                </button>
                <?php foreach ($categories as $cat): ?>
                <button @click="activeCategory = '<?= \App\Helpers\H::e($cat['slug']) ?>'"
                        :class="activeCategory === '<?= \App\Helpers\H::e($cat['slug']) ?>' ? 'bg-gray-900 text-white' : 'bg-white text-gray-500 hover:bg-gray-100 border border-gray-200'"
                        class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 shadow-sm">
                    <?= \App\Helpers\H::e($cat['name']) ?>
                </button>
                <?php endforeach; ?>
            </div>

            <!-- Apps Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <template x-for="app in filteredApps" :key="app.id">
                    <a :href="'/app/' + app.slug" class="group block bg-white rounded-2xl border border-gray-100 p-5 hover:border-emerald-200 hover:shadow-lg hover:shadow-emerald-500/[0.04] transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors duration-300"
                                 :class="'bg-' + app.icon_color + '-50 group-hover:bg-' + app.icon_color + '-100 text-' + app.icon_color + '-600'">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-900 text-sm group-hover:text-emerald-600 transition-colors truncate" x-text="app.name"></h3>
                                <p class="text-xs text-gray-400 mt-0.5 line-clamp-2" x-text="app.short_description || app.description || ''"></p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 group-hover:text-emerald-500 group-hover:translate-x-0.5 transition-all flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="flex items-center gap-2 mt-3 ml-15 pl-[60px]">
                            <span class="text-[10px] font-semibold uppercase tracking-wider text-gray-400 bg-gray-50 px-2 py-0.5 rounded" x-text="app.category_name"></span>
                            <span class="text-[10px] font-semibold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded" x-text="app.target_user === 'semua' ? 'Semua' : app.target_user"></span>
                        </div>
                    </a>
                </template>
            </div>

            <!-- Empty state -->
            <div x-show="filteredApps.length === 0" x-cloak class="text-center py-16">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-sm border border-gray-100">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500">Tidak ditemukan</p>
                <p class="text-xs text-gray-400 mt-1">Coba kata kunci lain</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══ Footer ═══ -->
<footer class="relative bg-gray-900 text-gray-300 overflow-hidden">
    <div class="absolute inset-0 texture-dots opacity-30"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-white">Portal Digital</p>
                        <p class="text-xs text-gray-500">SMP Muhammadiyah Unggulan Ashidiq</p>
                    </div>
                </div>
                <p class="text-sm text-gray-500 leading-relaxed max-w-xs">
                    Pusat seluruh aplikasi digital sekolah. Modern, profesional, dan berorientasi pendidikan.
                </p>
            </div>
            <div>
                <h3 class="font-semibold text-white mb-4 text-sm">Tautan</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="text-gray-400 hover:text-emerald-400 transition">Portal Utama</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-white mb-4 text-sm">Kontak</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2 text-gray-400">
                        <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <?= \App\Helpers\H::e($settings['school_email'] ?? '') ?>
                    </li>
                    <li class="flex items-center gap-2 text-gray-400">
                        <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <?= \App\Helpers\H::e($settings['school_phone'] ?? '') ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-xs text-gray-600">
            <?= \App\Helpers\H::e($settings['footer_text'] ?? '© 2025 SMP Muhammadiyah Unggulan Ashidiq. All rights reserved.') ?>
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
