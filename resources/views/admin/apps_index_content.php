<?php
/**
 * Applications index content.
 */
?>
<?php \App\Core\View::component('flash'); ?>

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900">Aplikasi</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola seluruh aplikasi portal.</p>
    </div>
    <a href="/admin/applications/create" class="inline-flex items-center gap-2 bg-emerald-600 text-white text-sm font-medium px-5 py-2.5 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/25">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Aplikasi
    </a>
</div>

<!-- Search & Filter -->
<div class="bg-white rounded-2xl border border-gray-200/60 p-4 mb-6">
    <form method="GET" action="/admin/applications" class="flex flex-col sm:flex-row gap-3">
        <input type="text" name="search" value="<?= \App\Helpers\H::e($search) ?>" placeholder="Cari aplikasi..."
               class="flex-1 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
        <select name="category" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            <option value="">Semua Kategori</option>
            <?php foreach ($categories as $cat): ?>
            <option value="<?= \App\Helpers\H::e($cat['slug']) ?>" <?= $category === $cat['slug'] ? 'selected' : '' ?>><?= \App\Helpers\H::e($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="bg-gray-900 text-white text-sm font-medium px-5 py-2.5 rounded-xl hover:bg-gray-800 transition">Cari</button>
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Nama</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Kategori</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Target</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Status</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Versi</th>
                    <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (!empty($apps)): ?>
                    <?php foreach ($apps as $app): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-sm text-gray-900"><?= \App\Helpers\H::e($app['name']) ?></p>
                                    <p class="text-xs text-gray-500 truncate max-w-[200px]"><?= \App\Helpers\H::e($app['short_description'] ?? '') ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600"><?= \App\Helpers\H::e($app['category_name'] ?? '') ?></td>
                        <td class="px-6 py-4 text-sm text-gray-600"><?= \App\Helpers\H::e(ucfirst($app['target_user'])) ?></td>
                        <td class="px-6 py-4">
                            <?php if (($app['status'] ?? '') === 'active'): ?>
                                <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">● Aktif</span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1 text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">● Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">v<?= \App\Helpers\H::e($app['version'] ?? '1.0') ?></td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/admin/applications/edit?id=<?= $app['id'] ?>" class="text-gray-400 hover:text-blue-600 transition p-1.5 rounded-lg hover:bg-blue-50" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <a href="/admin/applications/delete?id=<?= $app['id'] ?>" class="text-gray-400 hover:text-red-600 transition p-1.5 rounded-lg hover:bg-red-50" title="Hapus"
                                   onclick="return confirm('Yakin ingin menghapus?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">Tidak ada data.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($pagination['total_pages'] > 1): ?>
    <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
        <p class="text-sm text-gray-500">Halaman <?= $pagination['page'] ?> dari <?= $pagination['total_pages'] ?> (<?= $pagination['total'] ?> data)</p>
        <div class="flex gap-1">
            <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>"
               class="px-3 py-1.5 text-sm rounded-lg <?= $i === $pagination['page'] ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' ?> transition">
                <?= $i ?>
            </a>
            <?php endfor; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
