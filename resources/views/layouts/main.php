<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal Digital SMP Muhammadiyah Unggulan Ashidiq">
    <title><?= \App\Helpers\H::e($title ?? 'Portal Digital') ?></title>
    <link rel="stylesheet" href="/assets/css/app.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">
    <?= $content ?>
    <script src="/assets/js/app.js"></script>
</body>
</html>
