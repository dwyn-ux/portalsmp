<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23059669'/><text y='.9em' x='50' text-anchor='middle' font-size='65' fill='white'>P</text></svg>">
    <title><?= \App\Helpers\H::e($title ?? 'Login') ?></title>
    <link rel="stylesheet" href="/assets/css/tailwind.min.css">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">
    <?= $content ?>
</body>
</html>
