<?php
/**
 * App detail content.
 */
?>
<!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/70 backdrop-blur-xl border-b border-gray-200/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="/" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/25">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-900 text-sm">Portal Digital</span>
            </a>
            <a href="/" class="text-sm text-gray-600 hover:text-emerald-600 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>
</nav>

<!-- Detail -->
<section class="pt-24 pb-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl border border-gray-200/60 shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 p-8 text-white">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center">
                        <?php if (!empty($app['logo'])): ?>
                            <img src="<?= \App\Helpers\H::e($app['logo']) ?>" alt="<?= \App\Helpers\H::e($app['name']) ?>" class="w-10 h-10 object-contain">
                        <?php else: ?>
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>
                            </svg>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold"><?= \App\Helpers\H::e($app['name']) ?></h1>
                        <p class="text-emerald-100 text-sm mt-1"><?= \App\Helpers\H::e($app['category_name'] ?? '') ?> &bull; v<?= \App\Helpers\H::e($app['version'] ?? '1.0') ?></p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mt-4">
                    <span class="bg-white/20 backdrop-blur-md text-white text-xs font-medium px-3 py-1 rounded-full">
                        <?= \App\Helpers\H::e(ucfirst($app['target_user'] ?? 'semua')) ?>
                    </span>
                    <?php if (!empty($app['developer'])): ?>
                    <span class="bg-white/20 backdrop-blur-md text-white text-xs font-medium px-3 py-1 rounded-full">
                        <?= \App\Helpers\H::e($app['developer']) ?>
                    </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Body -->
            <div class="p-8 space-y-8">
                <!-- Description -->
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">Deskripsi</h2>
                    <p class="text-gray-600 leading-relaxed"><?= nl2br(\App\Helpers\H::e($app['description'] ?? '')) ?></p>
                </div>

                <!-- Features -->
                <?php if (!empty($features)): ?>
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-3">Fitur</h2>
                    <ul class="space-y-2">
                        <?php foreach ($features as $feature): ?>
                        <li class="flex items-start gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <?= \App\Helpers\H::e($feature) ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- Info -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-xs text-gray-500 mb-1">Status</p>
                        <p class="font-semibold text-gray-900">
                            <?php if (($app['status'] ?? '') === 'active'): ?>
                                <span class="text-emerald-600">Aktif</span>
                            <?php elseif (($app['status'] ?? '') === 'maintenance'): ?>
                                <span class="text-amber-600">Pemeliharaan</span>
                            <?php else: ?>
                                <span class="text-gray-500">Nonaktif</span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-xs text-gray-500 mb-1">Versi</p>
                        <p class="font-semibold text-gray-900"><?= \App\Helpers\H::e($app['version'] ?? '1.0.0') ?></p>
                    </div>
                </div>

                <!-- Action -->
                <a href="<?= \App\Helpers\H::e($app['url'] ?? '#') ?>"
                   target="_blank"
                   class="w-full inline-flex items-center justify-center gap-2 bg-emerald-600 text-white font-semibold px-6 py-3.5 rounded-2xl hover:bg-emerald-700 transition-all duration-200 shadow-lg shadow-emerald-500/25">
                    Buka Aplikasi
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<?php \App\Core\View::component('footer'); ?>
