<?php
/**
 * Admin dashboard content.
 */
?>
<?php \App\Core\View::component('flash'); ?>

<div class="mb-8">
    <h1 class="text-2xl font-extrabold text-gray-900">Dashboard</h1>
    <p class="text-sm text-gray-500 mt-1">Selamat datang, <?= \App\Helpers\H::e($_SESSION['user']['name'] ?? 'Admin') ?>.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <?php
    $dashStats = [
        ['label' => 'Total Aplikasi', 'value' => $totalApps, 'color' => 'emerald', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/>'],
        ['label' => 'Kategori', 'value' => $totalCategories, 'color' => 'blue', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>'],
        ['label' => 'Pengumuman', 'value' => $totalAnnouncements, 'color' => 'violet', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>'],
        ['label' => 'Visitor Hari Ini', 'value' => $totalVisitors, 'color' => 'amber', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>'],
    ];
    ?>
    <?php foreach ($dashStats as $stat): ?>
    <div class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500"><?= $stat['label'] ?></p>
                <p class="text-2xl font-extrabold text-gray-900 mt-1"><?= $stat['value'] ?></p>
            </div>
            <div class="w-11 h-11 bg-<?= $stat['color'] ?>-50 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-<?= $stat['color'] ?>-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <?= $stat['icon'] ?>
                </svg>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Recent Applications -->
<div class="bg-white rounded-2xl border border-gray-200/60 p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="font-bold text-gray-900">Aplikasi Terbaru</h2>
        <a href="/admin/applications" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">Lihat Semua &rarr;</a>
    </div>
    <div class="space-y-3">
        <?php if (!empty($recentApps)): ?>
            <?php foreach ($recentApps as $app): ?>
            <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-gray-900 text-sm truncate"><?= \App\Helpers\H::e($app['name']) ?></p>
                    <p class="text-xs text-gray-500"><?= \App\Helpers\H::e($app['category_name'] ?? '') ?></p>
                </div>
                <span class="text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">v<?= \App\Helpers\H::e($app['version'] ?? '1.0') ?></span>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-sm text-gray-500 text-center py-4">Belum ada aplikasi.</p>
        <?php endif; ?>
    </div>
</div>
