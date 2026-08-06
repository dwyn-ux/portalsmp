<?php
/**
 * Application form content.
 */
$isEdit = !empty($app);
$formAction = $isEdit ? '/admin/applications/update?id=' . $app['id'] : '/admin/applications/store';
$featuresList = is_array($app['features'] ?? null) ? implode("\n", $app['features']) : '';
?>
<div class="mb-6">
    <h1 class="text-2xl font-extrabold text-gray-900"><?= $isEdit ? 'Edit Aplikasi' : 'Tambah Aplikasi' ?></h1>
</div>

<div class="bg-white rounded-2xl border border-gray-200/60 p-6 max-w-3xl">
    <form method="POST" action="<?= $formAction ?>" enctype="multipart/form-data" class="space-y-6">
        <?= \App\Core\Csrf::field() ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Aplikasi *</label>
                <input type="text" name="name" required value="<?= \App\Helpers\H::e($app['name'] ?? '') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                <select name="category_id" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= ($app['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>><?= \App\Helpers\H::e($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Target User</label>
                <select name="target_user" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                    <?php foreach (['semua' => 'Semua', 'guru' => 'Guru', 'siswa' => 'Siswa', 'wali' => 'Wali', 'admin' => 'Admin'] as $val => $label): ?>
                    <option value="<?= $val ?>" <?= ($app['target_user'] ?? 'semua') === $val ? 'selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                <input type="text" name="short_description" value="<?= \App\Helpers\H::e($app['short_description'] ?? '') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none"><?= \App\Helpers\H::e($app['description'] ?? '') ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                <input type="url" name="url" value="<?= \App\Helpers\H::e($app['url'] ?? '#') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Versi</label>
                <input type="text" name="version" value="<?= \App\Helpers\H::e($app['version'] ?? '1.0.0') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Developer</label>
                <input type="text" name="developer" value="<?= \App\Helpers\H::e($app['developer'] ?? '') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Icon Color</label>
                <select name="icon_color" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                    <?php foreach (['emerald' => 'Emerald', 'blue' => 'Blue', 'teal' => 'Teal', 'indigo' => 'Indigo', 'violet' => 'Violet', 'amber' => 'Amber', 'rose' => 'Rose'] as $val => $label): ?>
                    <option value="<?= $val ?>" <?= ($app['icon_color'] ?? 'emerald') === $val ? 'selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                <input type="number" name="sort_order" value="<?= \App\Helpers\H::e((string) ($app['sort_order'] ?? 0)) ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                    <option value="active" <?= ($app['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Aktif</option>
                    <option value="inactive" <?= ($app['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Nonaktif</option>
                    <option value="maintenance" <?= ($app['status'] ?? '') === 'maintenance' ? 'selected' : '' ?>>Pemeliharaan</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                <input type="file" name="logo" accept="image/*"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700 file:font-medium file:text-sm">
                <?php if (!empty($app['logo'])): ?>
                <p class="text-xs text-gray-500 mt-1">Current: <?= \App\Helpers\H::e($app['logo']) ?></p>
                <?php endif; ?>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Fitur (satu per baris)</label>
                <textarea name="features" rows="4" placeholder="Fitur 1&#10;Fitur 2&#10;Fitur 3"
                          class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none"><?= \App\Helpers\H::e($featuresList) ?></textarea>
            </div>

            <div class="sm:col-span-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" <?= ($app['is_featured'] ?? 0) ? 'checked' : '' ?>
                           class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                    <span class="text-sm text-gray-700">Tampilkan sebagai aplikasi unggulan</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="bg-emerald-600 text-white text-sm font-medium px-6 py-2.5 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/25">
                <?= $isEdit ? 'Perbarui' : 'Simpan' ?>
            </button>
            <a href="/admin/applications" class="text-sm text-gray-500 hover:text-gray-700 transition">Batal</a>
        </div>
    </form>
</div>
