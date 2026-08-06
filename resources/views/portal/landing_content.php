<?php
/**
 * Landing page content.
 */
?>
<!-- Navbar -->
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

<!-- Hero -->
<section class="pt-28 pb-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-800">
        <!-- Decorative -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/[0.04] rounded-full -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[350px] h-[350px] bg-white/[0.04] rounded-full translate-y-1/2 -translate-x-1/4"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-400/[0.03] rounded-full"></div>
        <!-- Grid pattern -->
        <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 24px 24px;"></div>

        <div class="relative z-10 px-8 py-14 sm:px-12 sm:py-16 lg:px-20 lg:py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/15 text-white/80 text-xs font-medium tracking-wide uppercase px-4 py-1.5 rounded-full mb-6">
                <span class="w-1.5 h-1.5 bg-emerald-300 rounded-full animate-pulse"></span>
                SMP Muhammadiyah Unggulan Ashidiq
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-[3.25rem] font-extrabold text-white mb-4 leading-[1.1] tracking-tight">
                Portal Digital<br>Sekolah
            </h1>
            <p class="text-base sm:text-lg text-emerald-100/70 mb-8 max-w-lg mx-auto leading-relaxed">
                Akses seluruh aplikasi dan informasi sekolah dalam satu tempat terintegrasi.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="#apps" class="group inline-flex items-center gap-2 bg-white text-emerald-700 font-semibold text-sm px-7 py-3 rounded-xl hover:bg-emerald-50 transition-all duration-200 shadow-lg shadow-black/10">
                    Lihat Aplikasi
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="pb-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <?php
        $statItems = [
            ['label' => 'Aplikasi', 'value' => $stats['total_apps'] ?? 0, 'color' => 'emerald', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
            ['label' => 'Guru', 'value' => $stats['total_guru'] ?? 0, 'color' => 'blue', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M19 7a3 3 0 11-6 0 3 3 0 016 0z'],
            ['label' => 'Siswa', 'value' => $stats['total_siswa'] ?? 0, 'color' => 'violet', 'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222'],
            ['label' => 'Sistem', 'value' => $stats['total_systems'] ?? 0, 'color' => 'amber', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
        ];
        ?>
        <?php foreach ($statItems as $stat): ?>
        <div class="group bg-white rounded-2xl border border-gray-100 p-4 hover:border-<?= $stat['color'] ?>-200 hover:shadow-md transition-all duration-300">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 bg-<?= $stat['color'] ?>-50 group-hover:bg-<?= $stat['color'] ?>-100 transition-colors">
                    <svg class="w-5 h-5 text-<?= $stat['color'] ?>-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $stat['icon'] ?>"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-gray-900 leading-none"><?= $stat['value'] ?></p>
                    <p class="text-xs text-gray-400 font-medium mt-0.5"><?= $stat['label'] ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Announcement Popup Modal -->
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
        <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-5 text-white relative">
            <h3 class="text-lg font-bold pr-8">Pengumuman</h3>
            <p class="text-emerald-100/80 text-sm mt-0.5">Informasi terbaru</p>
            <button @click="open = false"
                    class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center transition-colors">
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

<!-- Applications -->
<section id="apps" class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
        <div>
            <h2 class="text-xl font-extrabold text-gray-900">Aplikasi</h2>
            <p class="text-sm text-gray-400 mt-1">Semua aplikasi digital sekolah</p>
        </div>
        <p class="text-sm text-gray-400" x-data="appFilter()" x-text="filteredApps.length + ' aplikasi'"></p>
    </div>

    <div x-data="appFilter()">
        <!-- Search -->
        <div class="relative mb-5">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" x-model="search" placeholder="Cari aplikasi..."
                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
        </div>

        <!-- Category Filters -->
        <div class="flex flex-wrap gap-2 mb-6">
            <button @click="activeCategory = ''"
                    :class="activeCategory === '' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                    class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200">
                Semua
            </button>
            <?php foreach ($categories as $cat): ?>
            <button @click="activeCategory = '<?= \App\Helpers\H::e($cat['slug']) ?>'"
                    :class="activeCategory === '<?= \App\Helpers\H::e($cat['slug']) ?>' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                    class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200">
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
            <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-500">Tidak ditemukan</p>
            <p class="text-xs text-gray-400 mt-1">Coba kata kunci lain</p>
        </div>
    </div>
</section>

<?php \App\Core\View::component('footer'); ?>

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
