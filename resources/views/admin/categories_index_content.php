<?php
/**
 * Categories index content.
 */
?>
<?php \App\Core\View::component('flash'); ?>

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900">Kategori</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola kategori aplikasi.</p>
    </div>
    <a href="/admin/categories/create" class="inline-flex items-center gap-2 bg-emerald-600 text-white text-sm font-medium px-5 py-2.5 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/25">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Kategori
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $cat): ?>
        <div class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-start justify-between mb-3">
                <div class="w-10 h-10 bg-<?= \App\Helpers\H::e($cat['color']) ?>-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-<?= \App\Helpers\H::e($cat['color']) ?>-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <div class="flex items-center gap-1">
                    <a href="/admin/categories/edit?id=<?= $cat['id'] ?>" class="text-gray-400 hover:text-blue-600 p-1.5 rounded-lg hover:bg-blue-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </a>
                    <a href="/admin/categories/delete?id=<?= $cat['id'] ?>" class="text-gray-400 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition"
                       onclick="return confirm('Yakin ingin menghapus?')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </a>
                </div>
            </div>
            <h3 class="font-bold text-gray-900"><?= \App\Helpers\H::e($cat['name']) ?></h3>
            <p class="text-sm text-gray-500 mt-1"><?= $cat['app_count'] ?> aplikasi &bull; Urutan: <?= $cat['sort_order'] ?></p>
            <div class="mt-3">
                <?php if ($cat['is_active']): ?>
                    <span class="text-xs font-medium text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">Aktif</span>
                <?php else: ?>
                    <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">Nonaktif</span>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-full text-center py-12 text-gray-500 text-sm">Belum ada kategori.</div>
    <?php endif; ?>
</div>
