<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Models\ApplicationModel;
use App\Models\AnnouncementModel;
use App\Models\CategoryModel;
use App\Models\SettingModel;
use App\Models\VisitorModel;

/**
 * Portal / landing page controller.
 */
class PortalController
{
    private ApplicationModel $appModel;
    private CategoryModel $categoryModel;
    private AnnouncementModel $announcementModel;
    private SettingModel $settingModel;
    private VisitorModel $visitorModel;

    public function __construct()
    {
        $this->appModel = new ApplicationModel();
        $this->categoryModel = new CategoryModel();
        $this->announcementModel = new AnnouncementModel();
        $this->settingModel = new SettingModel();
        $this->visitorModel = new VisitorModel();
    }

    /**
     * Landing page.
     */
    public function index(): void
    {
        $this->visitorModel->log($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0', '/');

        $apps = $this->appModel->getActive();
        $categories = $this->categoryModel->getActive();
        $announcements = $this->announcementModel->getRunning();
        $settings = $this->settingModel->getAll();

        $stats = [
            'total_apps' => count($apps),
            'total_guru' => count(array_filter($apps, fn($a) => $a['target_user'] === 'guru' || $a['target_user'] === 'semua')),
            'total_siswa' => count(array_filter($apps, fn($a) => $a['target_user'] === 'siswa' || $a['target_user'] === 'semua')),
            'total_systems' => count(array_unique(array_column($apps, 'category_name'))),
        ];

        View::render('portal.landing', [
            'title' => 'Portal Digital - SMP Muhammadiyah Unggulan Ashidiq',
            'apps' => $apps,
            'categories' => $categories,
            'announcements' => $announcements,
            'portalSettings' => $settings,
            'stats' => $stats,
        ]);
    }

    /**
     * Application detail page.
     */
    public function appDetail(): void
    {
        $slug = $_GET['slug'] ?? '';

        if (!$slug) {
            Url::redirect('/');
        }

        $app = $this->appModel->findBySlug($slug);

        if (!$app) {
            http_response_code(404);
            View::render('errors.404');
            return;
        }

        $this->appModel->incrementAccess((int) $app['id']);

        $features = json_decode($app['features'] ?? '[]', true);

        View::render('portal.app_detail', [
            'title' => $app['name'] . ' - Portal Digital',
            'app' => $app,
            'features' => $features,
        ]);
    }

    /**
     * Search applications (AJAX).
     */
    public function search(): void
    {
        header('Content-Type: application/json');

        $query = trim($_GET['q'] ?? '');

        if (strlen($query) < 2) {
            echo json_encode(['data' => []]);
            return;
        }

        $results = $this->appModel->search($query);

        echo json_encode(['data' => $results]);
    }
}
