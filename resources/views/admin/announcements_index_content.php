<?php
/**
 * Announcements index content.
 */
?>
<?php \App\Core\View::component('flash'); ?>

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900">Pengumuman</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola pengumuman portal.</p>
    </div>
    <a href="/admin/announcements/create" class="inline-flex items-center gap-2 bg-emerald-600 text-white text-sm font-medium px-5 py-2.5 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/25">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Pengumuman
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Judul</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Prioritas</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Status</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Dibuat Oleh</th>
                    <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (!empty($announcements)): ?>
                    <?php foreach ($announcements as $ann): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <p class="font-medium text-sm text-gray-900"><?= \App\Helpers\H::e($ann['title']) ?></p>
                            <p class="text-xs text-gray-500 truncate max-w-[300px]"><?= \App\Helpers\H::e($ann['content']) ?></p>
                        </td>
                        <td class="px-6 py-4">
                            <?php if ($ann['priority'] === 'high'): ?>
                                <span class="text-xs font-medium text-red-700 bg-red-50 px-2.5 py-1 rounded-full">Tinggi</span>
                            <?php elseif ($ann['priority'] === 'medium'): ?>
                                <span class="text-xs font-medium text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full">Sedang</span>
                            <?php else: ?>
                                <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">Rendah</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php if ($ann['is_active']): ?>
                                <span class="text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">Aktif</span>
                            <?php else: ?>
                                <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= \App\Helpers\H::e($ann['creator_name'] ?? '-') ?></td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/admin/announcements/edit?id=<?= $ann['id'] ?>" class="text-gray-400 hover:text-blue-600 p-1.5 rounded-lg hover:bg-blue-50 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <a href="/admin/announcements/delete?id=<?= $ann['id'] ?>" class="text-gray-400 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition"
                                   onclick="return confirm('Yakin ingin menghapus?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">Tidak ada pengumuman.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
