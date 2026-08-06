<?php
$isEdit = !empty($category);
$formAction = $isEdit ? '/admin/categories/update?id=' . $category['id'] : '/admin/categories/store';
?>
<div class="mb-6">
    <h1 class="text-2xl font-extrabold text-gray-900"><?= $isEdit ? 'Edit Kategori' : 'Tambah Kategori' ?></h1>
</div>

<div class="bg-white rounded-2xl border border-gray-200/60 p-6 max-w-xl">
    <form method="POST" action="<?= $formAction ?>" class="space-y-5">
        <?= \App\Core\Csrf::field() ?>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama *</label>
            <input type="text" name="name" required value="<?= \App\Helpers\H::e($category['name'] ?? '') ?>"
                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
            <input type="text" name="icon" value="<?= \App\Helpers\H::e($category['icon'] ?? 'academic-cap') ?>"
                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none"
                   placeholder="academic-cap">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Warna</label>
            <select name="color" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                <?php foreach (['emerald' => 'Emerald', 'blue' => 'Blue', 'teal' => 'Teal', 'indigo' => 'Indigo', 'violet' => 'Violet', 'amber' => 'Amber', 'rose' => 'Rose'] as $val => $label): ?>
                <option value="<?= $val ?>" <?= ($category['color'] ?? 'emerald') === $val ? 'selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
            <input type="number" name="sort_order" value="<?= \App\Helpers\H::e((string) ($category['sort_order'] ?? 0)) ?>"
                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
        </div>

        <div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" <?= ($category['is_active'] ?? 1) ? 'checked' : '' ?>
                       class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                <span class="text-sm text-gray-700">Aktif</span>
            </label>
        </div>

        <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="bg-emerald-600 text-white text-sm font-medium px-6 py-2.5 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/25">
                <?= $isEdit ? 'Perbarui' : 'Simpan' ?>
            </button>
            <a href="/admin/categories" class="text-sm text-gray-500 hover:text-gray-700 transition">Batal</a>
        </div>
    </form>
</div>
