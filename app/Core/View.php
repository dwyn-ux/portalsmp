<?php

declare(strict_types=1);

/**
 * View rendering helper.
 */

namespace App\Core;

class View
{
    /**
     * Render a view with data.
     *
     * @param string $view Dot-notation path (e.g. 'portal.landing')
     * @param array $data Variables to extract
     */
    public static function render(string $view, array $data = []): void
    {
        $config = require dirname(__DIR__, 2) . '/config/paths.php';
        $viewPath = $config['views'] . '/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($viewPath)) {
            http_response_code(500);
            echo 'View not found: ' . htmlspecialchars($view, ENT_QUOTES, 'UTF-8');
            return;
        }

        extract(array_merge(self::sharedData(), $data), EXTR_SKIP);

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        if (str_contains($view, 'layouts.')) {
            echo $content;
        } else {
            echo $content;
        }
    }

    /**
     * Render a view inside a layout.
     */
    public static function layout(string $layout, string $view, array $data = []): void
    {
        $config = require dirname(__DIR__, 2) . '/config/paths.php';
        $layoutPath = $config['views'] . '/layouts/' . $layout . '.php';
        $viewPath = $config['views'] . '/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($layoutPath)) {
            http_response_code(500);
            echo 'Layout not found: ' . htmlspecialchars($layout, ENT_QUOTES, 'UTF-8');
            return;
        }

        if (!file_exists($viewPath)) {
            http_response_code(500);
            echo 'View not found: ' . htmlspecialchars($view, ENT_QUOTES, 'UTF-8');
            return;
        }

        extract(array_merge(self::sharedData(), $data), EXTR_SKIP);

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        extract(array_merge(self::sharedData(), $data, ['content' => $content]), EXTR_SKIP);
        ob_start();
        require $layoutPath;
        echo ob_get_clean();
    }

    /**
     * Render a component.
     */
    public static function component(string $component, array $data = []): void
    {
        $config = require dirname(__DIR__, 2) . '/config/paths.php';
        $componentPath = $config['views'] . '/components/' . str_replace('.', '/', $component) . '.php';

        if (!file_exists($componentPath)) {
            echo '<!-- Component not found: ' . htmlspecialchars($component, ENT_QUOTES, 'UTF-8') . ' -->';
            return;
        }

        extract(array_merge(self::sharedData(), $data), EXTR_SKIP);
        require $componentPath;
    }

    /**
     * Get shared data across all views.
     */
    private static function sharedData(): array
    {
        $settings = [];

        try {
            $pdo = Database::getInstance();
            $stmt = $pdo->query("SELECT `key`, `value` FROM `settings`");
            while ($row = $stmt->fetch()) {
                $settings[$row['key']] = $row['value'];
            }
        } catch (\Exception $e) {
            $settings['school_name'] = 'SMP Muhammadiyah Unggulan Ashidiq';
        }

        return [
            'settings' => $settings,
            'csrf' => Csrf::token(),
            'csrfField' => Csrf::field(),
            'currentUser' => $_SESSION['user'] ?? null,
            'appName' => $settings['school_name'] ?? 'Portal Digital',
        ];
    }
}
