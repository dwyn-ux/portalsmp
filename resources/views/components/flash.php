<?php
$flashSuccess = $_SESSION['flash_success'] ?? null;
$flashError = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);
?>
<?php if ($flashSuccess): ?>
<div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
     class="fixed top-20 right-4 z-50 max-w-sm bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl shadow-lg flex items-center gap-2">
    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="text-sm"><?= \App\Helpers\H::e($flashSuccess) ?></span>
    <button @click="show = false" class="ml-auto text-emerald-500 hover:text-emerald-700">&times;</button>
</div>
<?php endif; ?>

<?php if ($flashError): ?>
<div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
     class="fixed top-20 right-4 z-50 max-w-sm bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-lg flex items-center gap-2">
    <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="text-sm"><?= \App\Helpers\H::e($flashError) ?></span>
    <button @click="show = false" class="ml-auto text-red-500 hover:text-red-700">&times;</button>
</div>
<?php endif; ?>
