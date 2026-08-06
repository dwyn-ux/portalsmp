<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Panel - Portal Digital SMP Muhammadiyah Unggulan Ashidiq">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23059669'/><text y='.9em' x='50' text-anchor='middle' font-size='65' fill='white'>A</text></svg>">
    <title><?= \App\Helpers\H::e($title ?? 'Admin') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:{50:'#ecfdf5',100:'#d1fae5',200:'#a7f3d0',300:'#6ee7b7',400:'#34d399',500:'#10b981',600:'#059669',700:'#047857',800:'#065f46',900:'#064e3b'}}}}}</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen" x-data="{ sidebarOpen: true, mobileMenu: false }">
    <!-- Top Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-200/60 h-16">
        <div class="flex items-center justify-between h-full px-4 lg:px-6">
            <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-800 hidden sm:block">Admin Panel</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="/" target="_blank" class="text-sm text-gray-500 hover:text-emerald-600 transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Lihat Portal
                </a>
                <div class="w-px h-6 bg-gray-200"></div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium text-emerald-700"><?= \App\Helpers\H::e(substr($_SESSION['user']['name'] ?? 'A', 0, 1)) ?></span>
                    </div>
                    <span class="text-sm font-medium hidden sm:block"><?= \App\Helpers\H::e($_SESSION['user']['name'] ?? 'Admin') ?></span>
                </div>
                <a href="/logout" class="text-gray-400 hover:text-red-500 transition p-2 rounded-lg hover:bg-red-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <div class="flex pt-16">
        <!-- Sidebar Desktop -->
        <aside class="fixed left-0 top-16 bottom-0 w-64 bg-white border-r border-gray-200/60 overflow-y-auto transition-all duration-300 z-40 hidden lg:block"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="p-4 space-y-1">
                <?php
                $menuItems = [
                    ['label' => 'Dashboard', 'url' => '/admin', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                    ['label' => 'Aplikasi', 'url' => '/admin/applications', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>'],
                    ['label' => 'Kategori', 'url' => '/admin/categories', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>'],
                    ['label' => 'Pengumuman', 'url' => '/admin/announcements', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>'],
                    ['label' => 'Pengaturan', 'url' => '/admin/settings', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>'],
                ];
                $currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
                ?>
                <?php foreach ($menuItems as $item): ?>
                    <?php $isActive = rtrim($currentPath, '/') === rtrim($item['url'], '/'); ?>
                    <a href="<?= $item['url'] ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 <?= $isActive ? 'bg-emerald-50 text-emerald-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' ?>">
                        <svg class="w-5 h-5 flex-shrink-0 <?= $isActive ? 'text-emerald-600' : 'text-gray-400' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <?= $item['icon'] ?>
                        </svg>
                        <?= $item['label'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </aside>

        <!-- Mobile Sidebar -->
        <div x-show="mobileMenu" x-transition:enter="transition-opacity ease-linear duration-200"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-200"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             @click="mobileMenu = false"
             class="fixed inset-0 bg-black/40 z-40 lg:hidden"></div>

        <aside x-show="mobileMenu" x-transition:transition="transition transform ease-out duration-300"
               x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
               x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
               class="fixed left-0 top-16 bottom-0 w-64 bg-white border-r border-gray-200 overflow-y-auto z-50 lg:hidden">
            <div class="p-4 space-y-1">
                <?php foreach ($menuItems as $item): ?>
                    <?php $isActive = rtrim($currentPath, '/') === rtrim($item['url'], '/'); ?>
                    <a href="<?= $item['url'] ?>"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all <?= $isActive ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-50' ?>">
                        <svg class="w-5 h-5 <?= $isActive ? 'text-emerald-600' : 'text-gray-400' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <?= $item['icon'] ?>
                        </svg>
                        <?= $item['label'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64 min-h-[calc(100vh-4rem)] p-4 lg:p-8">
            <?= $content ?>
        </main>
    </div>
    <script src="/assets/js/app.js"></script>
</body>
</html>
