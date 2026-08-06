<?php
/**
 * Landing page content.
 */
?>
<!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100" x-data="{ scrolled: false }" @scroll.window="scrolled = window.scrollY > 20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/25">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm leading-tight">Portal Digital</p>
                    <p class="text-[10px] text-gray-500 leading-tight">SMP Muhammadiyah Unggulan Ashidiq</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="#apps" class="text-sm text-gray-600 hover:text-emerald-600 transition hidden sm:block">Aplikasi</a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="pt-24 pb-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="relative bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-800 rounded-[2rem] overflow-hidden">
        <!-- Decorative circles -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/3 -translate-x-1/4"></div>
        <div class="absolute top-1/2 right-1/4 w-32 h-32 bg-emerald-400/10 rounded-full"></div>

        <div class="relative z-10 px-8 py-16 sm:px-12 sm:py-20 lg:px-20 lg:py-24 text-center">
            <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm border border-white/20 text-white/90 text-xs font-medium px-4 py-1.5 rounded-full mb-6">
                <span class="w-1.5 h-1.5 bg-emerald-300 rounded-full animate-pulse"></span>
                Sistem Digital Terintegrasi
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-4 leading-tight tracking-tight">
                Portal Digital<br class="hidden sm:block"> SMP Muhammadiyah Unggulan Ashidiq
            </h1>
            <p class="text-sm sm:text-base text-emerald-100/80 mb-8 max-w-2xl mx-auto leading-relaxed">
                Berkemajuan &bull; Mandiri &bull; Berprestasi &bull; Menguasai Teknologi Digital &bull; Berjiwa Qur'ani
            </p>
            <a href="#apps" class="group inline-flex items-center gap-2 bg-white text-emerald-700 font-semibold px-8 py-3 rounded-2xl hover:bg-emerald-50 transition-all duration-200 shadow-xl shadow-black/10">
                Jelajahi Aplikasi
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
        <?php
        $statItems = [
            ['label' => 'Aplikasi', 'value' => $stats['total_apps'] ?? 0, 'color' => 'emerald', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
            ['label' => 'Guru', 'value' => $stats['total_guru'] ?? 0, 'color' => 'blue', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
            ['label' => 'Siswa', 'value' => $stats['total_siswa'] ?? 0, 'color' => 'violet', 'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222'],
            ['label' => 'Sistem', 'value' => $stats['total_systems'] ?? 0, 'color' => 'amber', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
        ];
        ?>
        <?php foreach ($statItems as $stat): ?>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-<?= $stat['color'] ?>-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-<?= $stat['color'] ?>-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $stat['icon'] ?>"/>
                    </svg>
                </div>
                <p class="text-xs font-medium text-gray-500"><?= $stat['label'] ?></p>
            </div>
            <p class="text-2xl font-extrabold text-gray-900"><?= $stat['value'] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Announcement Popup Modal -->
<?php if (!empty($announcements)): ?>
<div x-data="{ open: true }" x-show="open" x-cloak
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full max-h-[80vh] overflow-hidden"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0">
        <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-5 text-white relative">
            <h3 class="text-lg font-bold pr-8">Pengumuman</h3>
            <p class="text-emerald-100 text-sm mt-0.5">Informasi terbaru untuk Anda</p>
            <button @click="open = false"
                    class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="px-6 py-5 overflow-y-auto max-h-[50vh] space-y-4">
            <?php foreach ($announcements as $announcement): ?>
            <div class="border border-gray-100 rounded-2xl p-4 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full mt-2 flex-shrink-0
                        <?php if ($announcement['priority'] === 'high'): ?>bg-red-500
                        <?php elseif ($announcement['priority'] === 'medium'): ?>bg-amber-500
                        <?php else: ?>bg-emerald-500<?php endif; ?>">
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-gray-900 text-sm mb-1"><?= \App\Helpers\H::e($announcement['title']) ?></h4>
                        <?php if (!empty($announcement['content'])): ?>
                        <p class="text-sm text-gray-600 leading-relaxed"><?= nl2br(\App\Helpers\H::e($announcement['content'])) ?></p>
                        <?php endif; ?>
                        <p class="text-xs text-gray-400 mt-2">
                            <?= date('d M Y', strtotime($announcement['created_at'])) ?>
                            <?php if ($announcement['priority'] === 'high'): ?>
                                <span class="ml-2 text-red-500 font-medium">Penting</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <button @click="open = false"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2.5 rounded-xl transition-colors">
                Mengerti
            </button>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Applications -->
<section id="apps" class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="mb-10">
        <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Aplikasi Digital</h2>
        <p class="text-sm text-gray-500">Akses seluruh aplikasi pendukung kegiatan belajar mengajar.</p>
    </div>

    <div x-data="appFilter()">
        <!-- Search -->
        <div class="relative mb-6">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" x-model="search" placeholder="Cari aplikasi..."
                   class="w-full pl-12 pr-4 py-3.5 bg-white border border-gray-200 rounded-2xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition shadow-sm">
        </div>

        <!-- Category Filters -->
        <div class="flex flex-wrap gap-2 mb-8">
            <button @click="activeCategory = ''"
                    :class="activeCategory === '' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/25' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200">
                Semua
            </button>
            <?php foreach ($categories as $cat): ?>
            <button @click="activeCategory = '<?= \App\Helpers\H::e($cat['slug']) ?>'"
                    :class="activeCategory === '<?= \App\Helpers\H::e($cat['slug']) ?>' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/25' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200">
                <?= \App\Helpers\H::e($cat['name']) ?>
            </button>
            <?php endforeach; ?>
        </div>

        <!-- Apps Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <template x-for="app in filteredApps" :key="app.id">
                <a :href="'/app/' + app.slug" class="group bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-lg hover:border-emerald-200 transition-all duration-300 flex flex-col">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                             :class="'bg-' + app.icon_color + '-50 text-' + app.icon_color + '-600'">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">
                            &#x25cf; Aktif
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1 group-hover:text-emerald-600 transition-colors" x-text="app.name"></h3>
                    <p class="text-sm text-gray-500 mb-4 line-clamp-2 flex-1" x-text="app.short_description || app.description || ''"></p>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-2">
                            <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-lg" x-text="app.category_name"></span>
                            <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg" x-text="app.target_user === 'semua' ? 'Semua' : app.target_user"></span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            </template>
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
