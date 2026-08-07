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

<form method="POST" action="/admin/settings" enctype="multipart/form-data" class="space-y-6">
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

    <!-- Hero Background -->
    <div class="bg-white rounded-2xl border border-gray-200/60 p-6">
        <h2 class="font-bold text-gray-900 mb-1">Background Hero</h2>
        <p class="text-xs text-gray-400 mb-4">Foto latar belakang halaman utama portal.</p>
        <?php if (!empty($settingsData['hero_bg'])): ?>
        <div class="mb-3 relative inline-block">
            <img src="<?= \App\Helpers\H::e($settingsData['hero_bg']) ?>" alt="Hero BG" class="w-48 h-28 object-cover rounded-xl border border-gray-200">
            <label class="absolute top-2 right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center cursor-pointer text-xs" title="Hapus background">
                <input type="checkbox" name="hero_bg_delete" value="1" class="hidden">
                &times;
            </label>
        </div>
        <?php endif; ?>
        <input type="file" name="hero_bg" accept="image/*"
               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
    </div>

    <!-- Logo Sekolah -->
    <div class="bg-white rounded-2xl border border-gray-200/60 p-6">
        <h2 class="font-bold text-gray-900 mb-1">Logo Sekolah</h2>
        <p class="text-xs text-gray-400 mb-4">Logo ditampilkan di header dan sebagai favicon.</p>
        <?php if (!empty($settingsData['hero_logos'])): ?>
        <div class="mb-3 flex items-center gap-3">
            <img src="<?= \App\Helpers\H::e($settingsData['hero_logos']) ?>" alt="Logo" class="w-16 h-16 object-contain bg-gray-50 rounded-lg border border-gray-200 p-1">
            <a href="/admin/settings?delete_logo=1" onclick="return confirm('Hapus logo?')" class="text-xs text-red-500 hover:text-red-700 font-medium">Hapus logo</a>
        </div>
        <?php endif; ?>
        <input type="file" name="hero_logos" accept="image/*"
               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
    </div>

    <!-- User Supervisi -->
    <div class="bg-white rounded-2xl border border-gray-200/60 p-6" x-data="supervisiUsers()">
        <h2 class="font-bold text-gray-900 mb-1">User Supervisi</h2>
        <p class="text-xs text-gray-400 mb-4">Kelola user yang bisa login ke modul Supervisi Akademik (/supervisi).</p>

        <!-- List -->
        <div class="mb-4" x-show="users.length > 0">
            <template x-for="u in users" :key="u.id">
                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                    <div>
                        <p class="text-sm font-semibold text-gray-900" x-text="u.name"></p>
                        <p class="text-xs text-gray-400" x-text="u.username + ' · ' + u.role"></p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] px-2 py-0.5 rounded-full" :class="u.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500'" x-text="u.is_active ? 'Aktif' : 'Nonaktif'"></span>
                        <button @click="toggleActive(u)" class="text-xs text-gray-500 hover:text-gray-700" x-text="u.is_active ? 'Nonaktifkan' : 'Aktifkan'"></button>
                        <button @click="deleteUser(u)" class="text-xs text-red-500 hover:text-red-700">Hapus</button>
                    </div>
                </div>
            </template>
        </div>
        <p x-show="users.length === 0" class="text-xs text-gray-400 mb-4">Belum ada user supervisi.</p>

        <!-- Add form -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-3">
            <input type="text" x-model="form.name" placeholder="Nama lengkap" class="px-3 py-2 border border-gray-200 rounded-lg text-sm">
            <input type="text" x-model="form.username" placeholder="Username" class="px-3 py-2 border border-gray-200 rounded-lg text-sm">
            <input type="password" x-model="form.password" placeholder="Password" class="px-3 py-2 border border-gray-200 rounded-lg text-sm">
        </div>
        <div class="flex gap-3">
            <select x-model="form.role" class="px-3 py-2 border border-gray-200 rounded-lg text-sm">
                <option value="kepsek">Kepala Sekolah</option>
                <option value="admin_sekolah">Admin Sekolah</option>
            </select>
            <button @click="addUser()" class="bg-emerald-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-emerald-700 transition">+ Tambah</button>
        </div>
    </div>

    <button type="submit" class="bg-emerald-600 text-white text-sm font-medium px-6 py-2.5 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/25">
        Simpan Pengaturan
    </button>
</form>

<script>
function supervisiUsers() {
    return {
        users: [],
        form: { name: '', username: '', password: '', role: 'kepsek' },
        async init() { await this.load(); },
        async load() {
            const r = await fetch('/admin/supervisi-users');
            const d = await r.json();
            this.users = d.data || [];
        },
        async addUser() {
            if (!this.form.name || !this.form.username || !this.form.password) { alert('Semua field wajib diisi'); return; }
            const fd = new FormData();
            fd.append('name', this.form.name);
            fd.append('username', this.form.username);
            fd.append('password', this.form.password);
            fd.append('role', this.form.role);
            fd.append('_token', document.querySelector('input[name="_token"]').value);
            await fetch('/admin/supervisi-users', { method: 'POST', body: fd });
            this.form = { name: '', username: '', password: '', role: 'kepsek' };
            await this.load();
        },
        async toggleActive(u) {
            const fd = new FormData();
            fd.append('id', u.id);
            fd.append('is_active', u.is_active ? '0' : '1');
            fd.append('_method', 'PUT');
            fd.append('_token', document.querySelector('input[name="_token"]').value);
            await fetch('/admin/supervisi-users', { method: 'POST', body: fd });
            await this.load();
        },
        async deleteUser(u) {
            if (!confirm('Hapus user "' + u.name + '"?')) return;
            const fd = new FormData();
            fd.append('id', u.id);
            fd.append('_method', 'DELETE');
            fd.append('_token', document.querySelector('input[name="_token"]').value);
            await fetch('/admin/supervisi-users', { method: 'POST', body: fd });
            await this.load();
        }
    };
}
</script>
