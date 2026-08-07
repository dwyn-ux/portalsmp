<?php

declare(strict_types=1);

/**
 * Application routes.
 */

use App\Core\Router;

$router = new Router();

// ─── PORTAL ───
$router->get('/', [PortalController::class, 'index']);
$router->get('/app/{slug}', [PortalController::class, 'appDetail']);
$router->get('/search', [PortalController::class, 'search']);

// ─── AUTH ───
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login'], ['CsrfMiddleware']);
$router->get('/logout', [AuthController::class, 'logout']);

// ─── ADMIN ───
$router->get('/admin', [AdminController::class, 'dashboard'], ['AuthMiddleware']);

// Applications
$router->get('/admin/applications', [AdminController::class, 'appsIndex'], ['AuthMiddleware']);
$router->get('/admin/applications/create', [AdminController::class, 'appsCreate'], ['AuthMiddleware']);
$router->post('/admin/applications/store', [AdminController::class, 'appsStore'], ['AuthMiddleware', 'CsrfMiddleware']);
$router->get('/admin/applications/edit', [AdminController::class, 'appsEdit'], ['AuthMiddleware']);
$router->post('/admin/applications/update', [AdminController::class, 'appsUpdate'], ['AuthMiddleware', 'CsrfMiddleware']);
$router->get('/admin/applications/delete', [AdminController::class, 'appsDelete'], ['AuthMiddleware']);

// Categories
$router->get('/admin/categories', [AdminController::class, 'categoriesIndex'], ['AuthMiddleware']);
$router->get('/admin/categories/create', [AdminController::class, 'categoriesCreate'], ['AuthMiddleware']);
$router->post('/admin/categories/store', [AdminController::class, 'categoriesStore'], ['AuthMiddleware', 'CsrfMiddleware']);
$router->get('/admin/categories/edit', [AdminController::class, 'categoriesEdit'], ['AuthMiddleware']);
$router->post('/admin/categories/update', [AdminController::class, 'categoriesUpdate'], ['AuthMiddleware', 'CsrfMiddleware']);
$router->get('/admin/categories/delete', [AdminController::class, 'categoriesDelete'], ['AuthMiddleware']);

// Announcements
$router->get('/admin/announcements', [AdminController::class, 'announcementsIndex'], ['AuthMiddleware']);
$router->get('/admin/announcements/create', [AdminController::class, 'announcementsCreate'], ['AuthMiddleware']);
$router->post('/admin/announcements/store', [AdminController::class, 'announcementsStore'], ['AuthMiddleware', 'CsrfMiddleware']);
$router->get('/admin/announcements/edit', [AdminController::class, 'announcementsEdit'], ['AuthMiddleware']);
$router->post('/admin/announcements/update', [AdminController::class, 'announcementsUpdate'], ['AuthMiddleware', 'CsrfMiddleware']);
$router->get('/admin/announcements/delete', [AdminController::class, 'announcementsDelete'], ['AuthMiddleware']);

// Settings
$router->get('/admin/settings', [AdminController::class, 'settingsIndex'], ['AuthMiddleware']);
$router->post('/admin/settings', [AdminController::class, 'settingsUpdate'], ['AuthMiddleware', 'CsrfMiddleware']);

// Supervisi Users (admin manage)
$router->get('/admin/supervisi-users', [AdminController::class, 'supervisiUsers'], ['AuthMiddleware']);
$router->post('/admin/supervisi-users', [AdminController::class, 'supervisiUsers'], ['AuthMiddleware']);

// ─── SUPERVISI ───
$router->get('/supervisi/login', [SupervisiAuthController::class, 'showLogin']);
$router->post('/supervisi/login', [SupervisiAuthController::class, 'login'], ['CsrfMiddleware']);
$router->get('/supervisi/logout', [SupervisiAuthController::class, 'logout']);
$router->post('/supervisi/auth/change-password', [SupervisiAuthController::class, 'changePassword']);
$router->get('/supervisi', [SupervisiController::class, 'index']);
$router->get('/supervisi/api/guru', [SupervisiController::class, 'apiGuru']);
$router->post('/supervisi/api/guru', [SupervisiController::class, 'apiGuru']);
$router->get('/supervisi/api/penilaian', [SupervisiController::class, 'apiPenilaian']);
$router->post('/supervisi/api/penilaian', [SupervisiController::class, 'apiPenilaian']);
$router->get('/supervisi/api/settings', [SupervisiController::class, 'apiSettings']);
$router->post('/supervisi/api/settings', [SupervisiController::class, 'apiSettings']);
$router->get('/supervisi/api/stats', [SupervisiController::class, 'apiStats']);
$router->get('/supervisi/api/rekap', [SupervisiController::class, 'apiRekap']);

return $router;
