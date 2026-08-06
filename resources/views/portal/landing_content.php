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
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="relative min-h-[90vh] flex items-center overflow-hidden pt-16">
    <!-- Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-900 via-emerald-800 to-teal-900"></div>
    <div class="absolute inset-0 opacity-[0.07] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1564769625905-50e93615e769?w=1200&q=80')"></div>
    <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-400/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-teal-400/15 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Left: Text -->
            <div>
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-white/90 text-sm px-4 py-2 rounded-full mb-8">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    Sistem Digital Terintegrasi
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight tracking-tight">
                    Portal Digital
                </h1>
                <p class="text-xl sm:text-2xl text-emerald-100/90 font-medium mb-3">
                    SMP Muhammadiyah Unggulan Ashidiq
                </p>
                <p class="text-sm sm:text-base text-emerald-200/70 mb-10 max-w-lg leading-relaxed">
                    Berkemajuan &bull; Mandiri &bull; Berprestasi<br>
                    Menguasai Teknologi Digital &bull; Berjiwa Qur'ani
                </p>
                <div class="flex flex-col sm:flex-row items-start gap-4">
                    <a href="#apps" class="group inline-flex items-center gap-2 bg-white text-emerald-700 font-semibold px-8 py-3.5 rounded-2xl hover:bg-emerald-50 transition-all duration-200 shadow-xl shadow-black/10">
                        Jelajahi Aplikasi
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right: Image -->
            <div class="relative hidden lg:block">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=600&q=80" alt="Sekolah" class="w-full h-[480px] object-cover" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/30 to-transparent"></div>
                </div>
                <!-- Floating badge: Digital -->
                <div class="absolute -bottom-5 -left-5 bg-white rounded-2xl p-4 shadow-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Digital Learning</p>
                            <p class="text-xs text-gray-500">Terintegrasi</p>
                        </div>
                    </div>
                </div>
                <!-- Floating badge: Prestasi -->
                <div class="absolute -top-4 -right-4 bg-white rounded-2xl p-4 shadow-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Berprestasi</p>
                            <p class="text-xs text-gray-500">Unggulan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <!-- Header -->
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
        <!-- Content -->
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
        <!-- Footer -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <button @click="open = false"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2.5 rounded-xl transition-colors">
                Mengerti
            </button>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Statistics -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
            <?php
            $statItems = [
                ['label' => 'Total Aplikasi', 'value' => $stats['total_apps'] ?? 0, 'color' => 'emerald', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>'],
                ['label' => 'Jumlah Guru', 'value' => $stats['total_guru'] ?? 0, 'color' => 'blue', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>'],
                ['label' => 'Jumlah Siswa', 'value' => $stats['total_siswa'] ?? 0, 'color' => 'violet', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>'],
                ['label' => 'Sistem Terintegrasi', 'value' => $stats['total_systems'] ?? 0, 'color' => 'amber', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>'],
            ];
            ?>
            <?php foreach ($statItems as $stat): ?>
            <div class="bg-gray-50 rounded-2xl p-5 text-center border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="w-10 h-10 bg-<?= $stat['color'] ?>-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-<?= $stat['color'] ?>-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
