<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Csrf;
use App\Core\View;
use App\Helpers\Url;
use App\Helpers\Upload;
use App\Models\ApplicationModel;
use App\Models\CategoryModel;
use App\Models\AnnouncementModel;
use App\Models\SettingModel;
use App\Models\UserModel;
use App\Models\VisitorModel;

/**
 * Admin dashboard controller.
 */
class AdminController
{
    private ApplicationModel $appModel;
    private CategoryModel $categoryModel;
    private AnnouncementModel $announcementModel;
    private SettingModel $settingModel;
    private UserModel $userModel;
    private VisitorModel $visitorModel;

    public function __construct()
    {
        $this->appModel = new ApplicationModel();
        $this->categoryModel = new CategoryModel();
        $this->announcementModel = new AnnouncementModel();
        $this->settingModel = new SettingModel();
        $this->userModel = new UserModel();
        $this->visitorModel = new VisitorModel();
    }

    /**
     * Admin dashboard.
     */
    public function dashboard(): void
    {
        $data = [
            'title' => 'Dashboard - Admin',
            'totalApps' => $this->appModel->count(),
            'totalCategories' => $this->categoryModel->count(),
            'totalAnnouncements' => $this->announcementModel->countActive(),
            'totalVisitors' => $this->visitorModel->countToday(),
            'visitorChart' => $this->visitorModel->getChart(),
            'recentApps' => array_slice($this->appModel->getActive(), 0, 5),
        ];

        View::render('admin.dashboard', $data);
    }

    // ─── APPLICATIONS ───

    /**
     * List applications.
     */
    public function appsIndex(): void
    {
        $page = (int) ($_GET['page'] ?? 1);
        $search = trim($_GET['search'] ?? '');
        $category = trim($_GET['category'] ?? '');

        $result = $this->appModel->paginate($page, 15, $search, $category);

        View::render('admin.apps_index', [
            'title' => 'Aplikasi - Admin',
            'apps' => $result['data'],
            'pagination' => $result,
            'search' => $search,
            'category' => $category,
            'categories' => $this->categoryModel->getActive(),
        ]);
    }

    /**
     * Show create form.
     */
    public function appsCreate(): void
    {
        View::render('admin.apps_form', [
            'title' => 'Tambah Aplikasi - Admin',
            'app' => null,
            'categories' => $this->categoryModel->getActive(),
        ]);
    }

    /**
     * Store application.
     */
    public function appsStore(): void
    {
        $data = $_POST;
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['name'] ?? ''), '-'));

        $appData = [
            'name' => $data['name'] ?? '',
            'slug' => $slug,
            'description' => $data['description'] ?? '',
            'short_description' => $data['short_description'] ?? '',
            'url' => $data['url'] ?? '#',
            'category_id' => (int) ($data['category_id'] ?? 1),
            'target_user' => $data['target_user'] ?? 'semua',
            'icon_color' => $data['icon_color'] ?? 'emerald',
            'sort_order' => (int) ($data['sort_order'] ?? 0),
            'status' => $data['status'] ?? 'active',
            'version' => $data['version'] ?? '1.0.0',
            'developer' => $data['developer'] ?? '',
            'is_featured' => isset($data['is_featured']) ? 1 : 0,
            'features' => array_filter(array_map('trim', explode("\n", $data['features'] ?? ''))),
        ];

        if (!empty($_FILES['logo']['tmp_name'])) {
            $logo = \App\Helpers\Upload::handle($_FILES['logo'], 'logos');
            if ($logo) {
                $appData['logo'] = $logo;
            }
        }

        $this->appModel->create($appData);

        $_SESSION['flash_success'] = 'Aplikasi berhasil ditambahkan.';
        Url::redirect('/admin/applications');
    }

    /**
     * Show edit form.
     */
    public function appsEdit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $app = $this->appModel->find($id);

        if (!$app) {
            Url::redirect('/admin/applications');
        }

        $app['features'] = json_decode($app['features'] ?? '[]', true);

        View::render('admin.apps_form', [
            'title' => 'Edit Aplikasi - Admin',
            'app' => $app,
            'categories' => $this->categoryModel->getActive(),
        ]);
    }

    /**
     * Update application.
     */
    public function appsUpdate(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $data = $_POST;

        $updateData = [
            'name' => $data['name'] ?? '',
            'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['name'] ?? ''), '-')),
            'description' => $data['description'] ?? '',
            'short_description' => $data['short_description'] ?? '',
            'url' => $data['url'] ?? '#',
            'category_id' => (int) ($data['category_id'] ?? 1),
            'target_user' => $data['target_user'] ?? 'semua',
            'icon_color' => $data['icon_color'] ?? 'emerald',
            'sort_order' => (int) ($data['sort_order'] ?? 0),
            'status' => $data['status'] ?? 'active',
            'version' => $data['version'] ?? '1.0.0',
            'developer' => $data['developer'] ?? '',
            'is_featured' => isset($data['is_featured']) ? 1 : 0,
            'features' => json_encode(array_filter(array_map('trim', explode("\n", $data['features'] ?? '')))),
        ];

        if (!empty($_FILES['logo']['tmp_name'])) {
            $logo = \App\Helpers\Upload::handle($_FILES['logo'], 'logos');
            if ($logo) {
                $updateData['logo'] = $logo;
            }
        }

        $this->appModel->update($id, $updateData);

        $_SESSION['flash_success'] = 'Aplikasi berhasil diperbarui.';
        Url::redirect('/admin/applications');
    }

    /**
     * Delete application.
     */
    public function appsDelete(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $this->appModel->softDelete($id);

        $_SESSION['flash_success'] = 'Aplikasi berhasil dihapus.';
        Url::redirect('/admin/applications');
    }

    // ─── CATEGORIES ───

    /**
     * List categories.
     */
    public function categoriesIndex(): void
    {
        View::render('admin.categories_index', [
            'title' => 'Kategori - Admin',
            'categories' => $this->categoryModel->getAllWithCount(),
        ]);
    }

    /**
     * Show create form.
     */
    public function categoriesCreate(): void
    {
        View::render('admin.categories_form', [
            'title' => 'Tambah Kategori - Admin',
            'category' => null,
        ]);
    }

    /**
     * Store category.
     */
    public function categoriesStore(): void
    {
        $data = $_POST;
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['name'] ?? ''), '-'));

        $this->categoryModel->create([
            'name' => $data['name'] ?? '',
            'slug' => $slug,
            'icon' => $data['icon'] ?? 'academic-cap',
            'color' => $data['color'] ?? 'emerald',
            'sort_order' => (int) ($data['sort_order'] ?? 0),
            'is_active' => isset($data['is_active']) ? 1 : 0,
        ]);

        $_SESSION['flash_success'] = 'Kategori berhasil ditambahkan.';
        Url::redirect('/admin/categories');
    }

    /**
     * Show edit form.
     */
    public function categoriesEdit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $cat = $this->categoryModel->find($id);

        if (!$cat) {
            Url::redirect('/admin/categories');
        }

        View::render('admin.categories_form', [
            'title' => 'Edit Kategori - Admin',
            'category' => $cat,
        ]);
    }

    /**
     * Update category.
     */
    public function categoriesUpdate(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $data = $_POST;

        $this->categoryModel->update($id, [
            'name' => $data['name'] ?? '',
            'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['name'] ?? ''), '-')),
            'icon' => $data['icon'] ?? 'academic-cap',
            'color' => $data['color'] ?? 'emerald',
            'sort_order' => (int) ($data['sort_order'] ?? 0),
            'is_active' => isset($data['is_active']) ? 1 : 0,
        ]);

        $_SESSION['flash_success'] = 'Kategori berhasil diperbarui.';
        Url::redirect('/admin/categories');
    }

    /**
     * Delete category.
     */
    public function categoriesDelete(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $this->categoryModel->softDelete($id);

        $_SESSION['flash_success'] = 'Kategori berhasil dihapus.';
        Url::redirect('/admin/categories');
    }

    // ─── ANNOUNCEMENTS ───

    /**
     * List announcements.
     */
    public function announcementsIndex(): void
    {
        View::render('admin.announcements_index', [
            'title' => 'Pengumuman - Admin',
            'announcements' => $this->announcementModel->getAllWithCreator(),
        ]);
    }

    /**
     * Show create form.
     */
    public function announcementsCreate(): void
    {
        View::render('admin.announcements_form', [
            'title' => 'Tambah Pengumuman - Admin',
            'announcement' => null,
        ]);
    }

    /**
     * Store announcement.
     */
    public function announcementsStore(): void
    {
        $data = $_POST;

        $this->announcementModel->create([
            'title' => $data['title'] ?? '',
            'content' => $data['content'] ?? '',
            'is_active' => isset($data['is_active']) ? 1 : 0,
            'is_running' => isset($data['is_running']) ? 1 : 0,
            'priority' => $data['priority'] ?? 'medium',
            'starts_at' => !empty($data['starts_at']) ? $data['starts_at'] : null,
            'expires_at' => !empty($data['expires_at']) ? $data['expires_at'] : null,
            'created_by' => $_SESSION['user']['id'] ?? null,
        ]);

        $_SESSION['flash_success'] = 'Pengumuman berhasil ditambahkan.';
        Url::redirect('/admin/announcements');
    }

    /**
     * Show edit form.
     */
    public function announcementsEdit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $announcements = $this->announcementModel->find($id);

        if (!$announcements) {
            Url::redirect('/admin/announcements');
        }

        View::render('admin.announcements_form', [
            'title' => 'Edit Pengumuman - Admin',
            'announcement' => $announcements,
        ]);
    }

    /**
     * Update announcement.
     */
    public function announcementsUpdate(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $data = $_POST;

        $this->announcementModel->update($id, [
            'title' => $data['title'] ?? '',
            'content' => $data['content'] ?? '',
            'is_active' => isset($data['is_active']) ? 1 : 0,
            'is_running' => isset($data['is_running']) ? 1 : 0,
            'priority' => $data['priority'] ?? 'medium',
            'starts_at' => !empty($data['starts_at']) ? $data['starts_at'] : null,
            'expires_at' => !empty($data['expires_at']) ? $data['expires_at'] : null,
        ]);

        $_SESSION['flash_success'] = 'Pengumuman berhasil diperbarui.';
        Url::redirect('/admin/announcements');
    }

    /**
     * Delete announcement.
     */
    public function announcementsDelete(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $this->announcementModel->softDelete($id);

        $_SESSION['flash_success'] = 'Pengumuman berhasil dihapus.';
        Url::redirect('/admin/announcements');
    }

    // ─── SETTINGS ───

    /**
     * Show settings page.
     */
    public function settingsIndex(): void
    {
        // Handle logo delete via GET param
        if (isset($_GET['delete_logo'])) {
            $currentLogo = $this->settingModel->getAll()['hero_logos'] ?? '';
            if ($currentLogo) {
                Upload::delete($currentLogo);
                $this->settingModel->updateMany(['hero_logos' => '']);
                $_SESSION['flash_success'] = 'Logo berhasil dihapus.';
            }
            Url::redirect('/admin/settings');
        }

        View::render('admin.settings', [
            'title' => 'Pengaturan - Admin',
            'settingsData' => $this->settingModel->getAll(),
        ]);
    }

    /**
     * Update settings.
     */
    public function settingsUpdate(): void
    {
        $data = $_POST;
        $settings = [];

        foreach ($data as $key => $value) {
            if ($key === '_token' || str_starts_with($key, 'hero_logos_delete')) {
                continue;
            }
            $settings[$key] = $value;
        }

        // Handle hero_bg upload
        if (!empty($_FILES['hero_bg']['name'])) {
            $bgPath = Upload::handle($_FILES['hero_bg'], 'hero');
            if ($bgPath) {
                // Delete old bg
                if (!empty($settings['hero_bg_delete'])) {
                    Upload::delete($settings['hero_bg'] ?? '');
                }
                $settings['hero_bg'] = $bgPath;
            }
        } elseif (!empty($data['hero_bg_delete'])) {
            if (!empty($this->settingModel->getAll()['hero_bg'])) {
                Upload::delete($this->settingModel->getAll()['hero_bg']);
            }
            $settings['hero_bg'] = '';
        }
        unset($settings['hero_bg_delete']);

        // Handle hero_logos — single logo file
        $currentLogo = isset($this->settingModel->getAll()['hero_logos']) ? $this->settingModel->getAll()['hero_logos'] : '';

        if (!empty($_FILES['hero_logos']['name'])) {
            $logoFile = [
                'name' => $_FILES['hero_logos']['name'],
                'type' => $_FILES['hero_logos']['type'],
                'tmp_name' => $_FILES['hero_logos']['tmp_name'],
                'error' => $_FILES['hero_logos']['error'],
                'size' => $_FILES['hero_logos']['size'],
            ];
            $logoPath = Upload::handle($logoFile, 'hero');
            if ($logoPath) {
                if ($currentLogo) {
                    Upload::delete($currentLogo);
                }
                $settings['hero_logos'] = $logoPath;
            }
        }

        $this->settingModel->updateMany($settings);

        $_SESSION['flash_success'] = 'Pengaturan berhasil diperbarui.';
        Url::redirect('/admin/settings');
    }

    // ─── SUPERVISI USERS ───

    public function supervisiUsers(): void
    {
        $db = \App\Core\Database::getInstance();

        $method = $_GET['_method'] ?? $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $stmt = $db->query('SELECT id, username, name, role, is_active, last_login_at FROM supervisi_users ORDER BY created_at DESC');
            $this->jsonResponse(['data' => $stmt->fetchAll(\PDO::FETCH_ASSOC)]);
        }

        if ($method === 'POST') {
            $data = $_POST;
            $name = trim($data['name'] ?? '');
            $username = trim($data['username'] ?? '');
            $password = $data['password'] ?? '';
            $role = $data['role'] ?? 'kepsek';

            if ($name === '' || $username === '') {
                $this->jsonResponse(['error' => 'Nama dan username wajib'], 422);
            }

            // Cek duplikat
            $check = $db->prepare('SELECT id FROM supervisi_users WHERE username = ?');
            $check->execute([$username]);
            if ($check->fetch()) {
                $this->jsonResponse(['error' => 'Username sudah digunakan'], 422);
            }

            $stmt = $db->prepare('INSERT INTO supervisi_users (username, password, name, role) VALUES (?, ?, ?, ?)');
            $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), $name, $role]);
            $this->jsonResponse(['ok' => true]);
        }

        if ($method === 'PUT') {
            $data = $_POST;
            $id = (int) ($data['id'] ?? 0);
            if ($id <= 0) { $this->jsonResponse(['error' => 'id wajib'], 422); }

            $stmt = $db->prepare('UPDATE supervisi_users SET is_active = ? WHERE id = ?');
            $stmt->execute([(int) ($data['is_active'] ?? 1), $id]);
            $this->jsonResponse(['ok' => true]);
        }

        if ($method === 'DELETE') {
            $data = $_POST;
            $id = (int) ($data['id'] ?? 0);
            if ($id <= 0) { $this->jsonResponse(['error' => 'id wajib'], 422); }

            $stmt = $db->prepare('DELETE FROM supervisi_users WHERE id = ?');
            $stmt->execute([$id]);
            $this->jsonResponse(['ok' => true]);
        }

        $this->jsonResponse(['error' => 'Method not allowed'], 405);
    }
}
