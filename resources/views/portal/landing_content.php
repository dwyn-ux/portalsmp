<?php
/**
 * Landing page content.
 */
?>
<!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/70 backdrop-blur-xl border-b border-gray-200/50" x-data="{ scrolled: false }" @scroll.window="scrolled = window.scrollY > 20">
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
                <a href="/login" class="text-sm font-medium bg-gray-900 text-white px-4 py-2 rounded-xl hover:bg-emerald-600 transition-all duration-200">
                    Masuk Portal
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden pt-16">
    <!-- Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-900 via-emerald-800 to-teal-900"></div>
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
    </div>
    <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-400/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-teal-400/15 rounded-full blur-3xl"></div>

    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-white/90 text-sm px-4 py-2 rounded-full mb-8">
            <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
            Sistem Digital Terintegrasi
        </div>
        <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-white mb-6 leading-tight tracking-tight">
            Portal Digital
        </h1>
        <p class="text-xl sm:text-2xl text-emerald-100/90 font-medium mb-3">
            SMP Muhammadiyah Unggulan Ashidiq
        </p>
        <p class="text-sm sm:text-base text-emerald-200/70 mb-10 max-w-2xl mx-auto leading-relaxed">
            Berkemajuan &bull; Mandiri &bull; Berprestasi<br>
            Menguasai Teknologi Digital &bull; Berjiwa Qur'ani
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="#apps" class="group inline-flex items-center gap-2 bg-white text-emerald-700 font-semibold px-8 py-3.5 rounded-2xl hover:bg-emerald-50 transition-all duration-200 shadow-xl shadow-black/10">
                Jelajahi Aplikasi
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </a>
            <a href="/login" class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-white font-medium px-8 py-3.5 rounded-2xl hover:bg-white/20 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk Portal
            </a>
        </div>
    </div>
</section>

<!-- Announcement Bar -->
<?php if (!empty($announcements)): ?>
<section class="bg-emerald-50 border-y border-emerald-100 py-3">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center gap-3 overflow-hidden">
            <span class="flex-shrink-0 bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full">INFO</span>
            <div class="overflow-hidden" x-data="{ i: 0, items: <?= json_encode(array_column($announcements, 'title')) ?> }" x-init="setInterval(() => i = (i + 1) % items.length, 5000)">
                <template x-for="(item, idx) in items" :key="idx">
                    <p x-show="i === idx" x-transition class="text-sm text-emerald-800 truncate" x-text="item"></p>
                </template>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Statistics -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
            <?php
            $statItems = [
                ['label' => 'Total Aplikasi', 'value' => $stats['total_apps'] ?? 0, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>'],
                ['label' => 'Jumlah Guru', 'value' => $stats['total_guru'] ?? 0, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>'],
                ['label' => 'Jumlah Siswa', 'value' => $stats['total_siswa'] ?? 0, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>'],
                ['label' => 'Sistem Terintegrasi', 'value' => $stats['total_systems'] ?? 0, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>'],
            ];
            ?>
            <?php foreach ($statItems as $stat): ?>
            <div class="bg-gray-50 rounded-2xl p-5 text-center border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <?= $stat['icon'] ?>
                    </svg>
                </div>
                <p class="text-3xl font-extrabold text-gray-900 mb-1"><?= $stat['value'] ?></p>
                <p class="text-sm text-gray-500"><?= $stat['label'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Quick Access / Applications -->
<section id="apps" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-3">Aplikasi Digital</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Akses seluruh aplikasi pendukung kegiatan belajar mengajar dalam satu portal terintegrasi.</p>
        </div>

        <!-- Search & Filter -->
        <div x-data="appFilter()" class="mb-10">
            <div class="flex flex-col sm:flex-row items-center gap-4 mb-6">
                <!-- Search -->
                <div class="relative flex-1 w-full">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" x-model="search" placeholder="Cari aplikasi..."
                           class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition shadow-sm">
                </div>
            </div>

            <!-- Category Filters -->
            <div class="flex flex-wrap gap-2 mb-8">
                <button @click="activeCategory = ''"
                        :class="activeCategory === '' ? 'bg-gray-900 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                        class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200">
                    Semua
                </button>
                <?php foreach ($categories as $cat): ?>
                <button @click="activeCategory = '<?= \App\Helpers\H::e($cat['slug']) ?>'"
                        :class="activeCategory === '<?= \App\Helpers\H::e($cat['slug']) ?>' ? 'bg-gray-900 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                        class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200">
                    <?= \App\Helpers\H::e($cat['name']) ?>
                </button>
                <?php endforeach; ?>
            </div>

            <!-- Apps Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <template x-for="app in filteredApps" :key="app.id">
                    <div class="group relative bg-white rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
                        <div class="p-6 flex-1">
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
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2" x-text="app.short_description || app.description || ''"></p>
                            <div class="flex flex-wrap gap-2">
                                <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-lg" x-text="app.category_name"></span>
                                <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg" x-text="app.target_user === 'semua' ? 'Semua' : app.target_user"></span>
                            </div>
                        </div>
                        <div class="px-6 pb-6">
                            <a :href="'/app/' + app.slug"
                               class="w-full inline-flex items-center justify-center gap-2 bg-gray-900 text-white text-sm font-medium px-4 py-2.5 rounded-xl hover:bg-emerald-600 transition-colors duration-200">
                                Buka Aplikasi
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </template>
            </div>
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
