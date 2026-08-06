<?php
/**
 * Settings content.
 */
?>
<?php \App\Core\View::component('flash'); ?>

<div class="mb-6">
    <h1 class="text-2xl font-extrabold text-gray-900">Pengaturan Portal</h1>
    <p class="text-sm text-gray-500 mt-1">Kelola pengaturan umum portal.</p>
</div>

<form method="POST" action="/admin/settings" class="space-y-6">
    <?= \App\Core\Csrf::field() ?>

    <!-- General -->
    <div class="bg-white rounded-2xl border border-gray-200/60 p-6">
        <h2 class="font-bold text-gray-900 mb-4">Informasi Umum</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Sekolah</label>
                <input type="text" name="school_name" value="<?= \App\Helpers\H::e($settingsData['school_name'] ?? '') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Slogan</label>
                <textarea name="school_slogan" rows="2"
                          class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none"><?= \App\Helpers\H::e($settingsData['school_slogan'] ?? '') ?></textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Footer Text</label>
                <input type="text" name="footer_text" value="<?= \App\Helpers\H::e($settingsData['footer_text'] ?? '') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div class="bg-white rounded-2xl border border-gray-200/60 p-6">
        <h2 class="font-bold text-gray-900 mb-4">Kontak</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="school_address" rows="2"
                          class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none"><?= \App\Helpers\H::e($settingsData['school_address'] ?? '') ?></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="school_email" value="<?= \App\Helpers\H::e($settingsData['school_email'] ?? '') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                <input type="text" name="school_phone" value="<?= \App\Helpers\H::e($settingsData['school_phone'] ?? '') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                <input type="text" name="school_whatsapp" value="<?= \App\Helpers\H::e($settingsData['school_whatsapp'] ?? '') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>
        </div>
    </div>

    <!-- Social -->
    <div class="bg-white rounded-2xl border border-gray-200/60 p-6">
        <h2 class="font-bold text-gray-900 mb-4">Media Sosial</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">YouTube</label>
                <input type="url" name="school_youtube" value="<?= \App\Helpers\H::e($settingsData['school_youtube'] ?? '') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none"
                       placeholder="https://youtube.com/...">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                <input type="url" name="school_instagram" value="<?= \App\Helpers\H::e($settingsData['school_instagram'] ?? '') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none"
                       placeholder="https://instagram.com/...">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                <input type="url" name="school_facebook" value="<?= \App\Helpers\H::e($settingsData['school_facebook'] ?? '') ?>"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none"
                       placeholder="https://facebook.com/...">
            </div>
        </div>
    </div>

    <!-- Announcement Running Text -->
    <div class="bg-white rounded-2xl border border-gray-200/60 p-6">
        <h2 class="font-bold text-gray-900 mb-4">Running Text Pengumuman</h2>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Teks Pengumuman</label>
            <textarea name="announcement_running" rows="2"
                      class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none"><?= \App\Helpers\H::e($settingsData['announcement_running'] ?? '') ?></textarea>
        </div>
    </div>

    <button type="submit" class="bg-emerald-600 text-white text-sm font-medium px-6 py-2.5 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/25">
        Simpan Pengaturan
    </button>
</form>
