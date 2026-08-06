<?php
/**
 * Login content.
 */
?>
<div class="min-h-[80vh] flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl border border-gray-200 shadow-xl p-8">
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-gray-900">Portal Digital</h1>
                <p class="text-gray-500 text-sm mt-1">SMP Muhammadiyah Unggulan Ashidiq</p>
            </div>

            <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <?= \App\Helpers\H::e($_SESSION['flash_error']) ?>
            </div>
            <?php unset($_SESSION['flash_error']); endif; ?>

            <form method="POST" action="/login" class="space-y-4">
                <?= \App\Core\Csrf::field() ?>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                           placeholder="admin@smpmuashidiq.sch.id">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                           placeholder="Masukkan password">
                </div>

                <button type="submit"
                        class="w-full bg-emerald-600 text-white font-semibold py-3 rounded-xl hover:bg-emerald-700 transition-all duration-200 shadow-lg">
                    Masuk
                </button>
            </form>

            <p class="text-center text-gray-400 text-xs mt-5">&copy; <?= date('Y') ?> SMP Muhammadiyah Unggulan Ashidiq</p>
        </div>
    </div>
</div>
