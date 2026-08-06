-- Portal Digital SMP Muhammadiyah Unggulan Ashidiq
-- Database Schema

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE IF NOT EXISTS `portal_smpmuashidiq`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `portal_smpmuashidiq`;

-- Users table
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin','guru','siswa','wali') NOT NULL DEFAULT 'siswa',
  `avatar` VARCHAR(255) DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `last_login_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_users_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Categories table
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL,
  `icon` VARCHAR(100) DEFAULT 'academic-cap',
  `color` VARCHAR(20) DEFAULT 'emerald',
  `sort_order` INT NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_categories_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Applications table
DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `short_description` VARCHAR(255) DEFAULT NULL,
  `logo` VARCHAR(255) DEFAULT NULL,
  `url` VARCHAR(500) DEFAULT NULL,
  `category_id` INT UNSIGNED NOT NULL,
  `target_user` ENUM('semua','guru','siswa','wali','admin') NOT NULL DEFAULT 'semua',
  `icon_color` VARCHAR(20) DEFAULT 'emerald',
  `sort_order` INT NOT NULL DEFAULT 0,
  `status` ENUM('active','inactive','maintenance') NOT NULL DEFAULT 'active',
  `version` VARCHAR(20) DEFAULT '1.0.0',
  `developer` VARCHAR(255) DEFAULT NULL,
  `features` JSON DEFAULT NULL,
  `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
  `access_count` INT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_applications_slug` (`slug`),
  KEY `fk_applications_category` (`category_id`),
  CONSTRAINT `fk_applications_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Announcements table
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `is_running` TINYINT(1) NOT NULL DEFAULT 0,
  `priority` ENUM('low','medium','high') NOT NULL DEFAULT 'medium',
  `starts_at` TIMESTAMP NULL DEFAULT NULL,
  `expires_at` TIMESTAMP NULL DEFAULT NULL,
  `created_by` INT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_announcements_creator` (`created_by`),
  CONSTRAINT `fk_announcements_creator` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Settings table
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` VARCHAR(100) NOT NULL,
  `value` TEXT DEFAULT NULL,
  `type` ENUM('text','textarea','image','json','boolean') NOT NULL DEFAULT 'text',
  `group` VARCHAR(50) NOT NULL DEFAULT 'general',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_settings_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Visitor logs
DROP TABLE IF EXISTS `visitor_logs`;
CREATE TABLE `visitor_logs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(45) NOT NULL,
  `user_agent` VARCHAR(500) DEFAULT NULL,
  `url` VARCHAR(500) DEFAULT NULL,
  `user_id` INT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_visitor_created` (`created_at`),
  KEY `fk_visitor_user` (`user_id`),
  CONSTRAINT `fk_visitor_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Audit logs
DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE `audit_logs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED DEFAULT NULL,
  `action` VARCHAR(100) NOT NULL,
  `entity` VARCHAR(100) NOT NULL,
  `entity_id` INT UNSIGNED DEFAULT NULL,
  `old_data` JSON DEFAULT NULL,
  `new_data` JSON DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_audit_user` (`user_id`),
  KEY `idx_audit_entity` (`entity`, `entity_id`),
  CONSTRAINT `fk_audit_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed admin user (password: admin123)
INSERT INTO `users` (`name`, `email`, `password`, `role`) VALUES
('Administrator', 'admin@smpmuashidiq.sch.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Seed categories
INSERT INTO `categories` (`name`, `slug`, `icon`, `color`, `sort_order`) VALUES
('Akademik', 'akademik', 'academic-cap', 'emerald', 1),
('Tahfidz', 'tahfidz', 'book-open', 'teal', 2),
('Guru', 'guru', 'users', 'blue', 3),
('Siswa', 'siswa', 'user-group', 'indigo', 4),
('Administrasi', 'administrasi', 'clipboard-document-list', 'violet', 5),
('Keuangan', 'keuangan', 'currency-dollar', 'amber', 6);

-- Seed settings
INSERT INTO `settings` (`key`, `value`, `type`, `group`) VALUES
('school_name', 'SMP Muhammadiyah Unggulan Ashidiq', 'text', 'general'),
('school_slogan', 'Berkemajuan • Mandiri • Berprestasi Menguasai Teknologi Digital • Berjiwa Qur''ani', 'textarea', 'general'),
('school_address', 'Jl. Raya Ashidiq No. 1, Jawa Tengah', 'text', 'contact'),
('school_email', 'info@smpmuashidiq.sch.id', 'text', 'contact'),
('school_phone', '081234567890', 'text', 'contact'),
('school_whatsapp', '6281234567890', 'text', 'contact'),
('school_youtube', '', 'text', 'social'),
('school_instagram', '', 'text', 'social'),
('school_facebook', '', 'text', 'social'),
('announcement_running', '', 'textarea', 'general'),
('footer_text', '© 2025 SMP Muhammadiyah Unggulan Ashidiq. All rights reserved.', 'text', 'general');

-- Seed sample applications
INSERT INTO `applications` (`name`, `slug`, `description`, `short_description`, `url`, `category_id`, `target_user`, `icon_color`, `sort_order`, `status`, `version`, `developer`) VALUES
('Portal Akademik', 'portal-akademik', 'Sistem informasi akademik lengkap untuk mengelola nilai, jadwal, dan laporan pelajar.', 'Sistem informasi akademik', '#', 1, 'semua', 'emerald', 1, 'active', '1.0.0', 'Tim IT'),
('E-Learning', 'e-learning', 'Platform pembelajaran daring dengan materi interaktif, ujian online, dan tugas digital.', 'Platform pembelajaran daring', '#', 1, 'semua', 'blue', 2, 'active', '2.1.0', 'Tim IT'),
('Tahfidz Tracker', 'tahfidz-tracker', 'Aplikasi pemantauan hafalan Al-Qur''an siswa dengan progress dan laporan.', 'Pemantauan hafalan Al-Qur''an', '#', 2, 'siswa', 'teal', 3, 'active', '1.2.0', 'Tim IT'),
('Dashboard Guru', 'dashboard-guru', 'Panel informasi guru meliputi jadwal mengajar, input nilai, dan absensi.', 'Panel informasi guru', '#', 3, 'guru', 'indigo', 4, 'active', '1.0.0', 'Tim IT'),
('Portal Siswa', 'portal-siswa', 'Portal informasi siswa meliputi jadwal, nilai, absensi, dan pengumuman.', 'Portal informasi siswa', '#', 4, 'siswa', 'violet', 5, 'active', '1.0.0', 'Tim IT'),
('SPP Online', 'spp-online', 'Sistem pembayaran SPP dan keuangan sekolah secara online.', 'Pembayaran SPP online', '#', 6, 'wali', 'amber', 6, 'active', '1.3.0', 'Tim IT');

SET FOREIGN_KEY_CHECKS = 1;
