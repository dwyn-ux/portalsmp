<?php
/**
 * Application card component.
 * @var array $app Application data
 */
$colorMap = [
    'emerald' => 'bg-emerald-50 text-emerald-600 ring-emerald-500/20',
    'blue' => 'bg-blue-50 text-blue-600 ring-blue-500/20',
    'teal' => 'bg-teal-50 text-teal-600 ring-teal-500/20',
    'indigo' => 'bg-indigo-50 text-indigo-600 ring-indigo-500/20',
    'violet' => 'bg-violet-50 text-violet-600 ring-violet-500/20',
    'amber' => 'bg-amber-50 text-amber-600 ring-amber-500/20',
    'rose' => 'bg-rose-50 text-rose-600 ring-rose-500/20',
];
$color = $app['icon_color'] ?? 'emerald';
$ringColor = $colorMap[$color] ?? $colorMap['emerald'];

$targetLabels = [
    'semua' => 'Semua',
    'guru' => 'Guru',
    'siswa' => 'Siswa',
    'wali' => 'Wali',
    'admin' => 'Admin',
];

$statusBadge = match($app['status'] ?? 'active') {
    'active' => '<span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">● Aktif</span>',
    'inactive' => '<span class="inline-flex items-center gap-1 text-xs font-medium text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">● Nonaktif</span>',
    'maintenance' => '<span class="inline-flex items-center gap-1 text-xs font-medium text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full">● Pemeliharaan</span>',
    default => '',
};
?>
<div class="group relative bg-white rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
    <div class="p-6 flex-1">
        <!-- Logo & Status -->
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl ring-1 <?= $ringColor ?> flex items-center justify-center flex-shrink-0">
                <?php if (!empty($app['logo'])): ?>
                    <img src="<?= \App\Helpers\H::e($app['logo']) ?>" alt="<?= \App\Helpers\H::e($app['name']) ?>" class="w-8 h-8 object-contain">
                <?php else: ?>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/>
                    </svg>
                <?php endif; ?>
            </div>
            <?= $statusBadge ?>
        </div>

        <!-- Name -->
        <h3 class="font-bold text-gray-900 mb-1 group-hover:text-emerald-600 transition-colors">
            <?= \App\Helpers\H::e($app['name']) ?>
        </h3>

        <!-- Description -->
        <p class="text-sm text-gray-500 mb-4 line-clamp-2">
            <?= \App\Helpers\H::e($app['short_description'] ?? $app['description'] ?? '') ?>
        </p>

        <!-- Tags -->
        <div class="flex flex-wrap gap-2 mb-4">
            <span class="inline-flex items-center text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-lg">
                <?= \App\Helpers\H::e($app['category_name'] ?? '') ?>
            </span>
            <span class="inline-flex items-center text-xs font-medium text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg">
                <?= $targetLabels[$app['target_user'] ?? 'semua'] ?? 'Semua' ?>
            </span>
            <?php if (!empty($app['version'])): ?>
                <span class="inline-flex items-center text-xs font-medium text-gray-400 bg-gray-50 px-2.5 py-1 rounded-lg">
                    v<?= \App\Helpers\H::e($app['version']) ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Action -->
    <div class="px-6 pb-6">
        <a href="/app/<?= \App\Helpers\H::e($app['slug']) ?>"
           class="w-full inline-flex items-center justify-center gap-2 bg-gray-900 text-white text-sm font-medium px-4 py-2.5 rounded-xl hover:bg-emerald-600 transition-colors duration-200">
            Buka Aplikasi
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>
</div>
