-- Supervisi Akademik Guru
-- Migration: tambah tabel supervisi ke database portal yang sudah ada

SET NAMES utf8mb4;

-- Settings supervisi (key-value)
CREATE TABLE IF NOT EXISTS `supervisi_settings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` VARCHAR(100) NOT NULL,
  `setting_value` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_supervisi_settings_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Guru binaan
CREATE TABLE IF NOT EXISTS `supervisi_guru` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED DEFAULT NULL,
  `nama` VARCHAR(255) NOT NULL,
  `sekolah` VARCHAR(255) NOT NULL,
  `mapel` VARCHAR(100) NOT NULL,
  `jam_tatap_muka` INT DEFAULT NULL,
  `kepsek_nama` VARCHAR(255) DEFAULT NULL,
  `kepsek_nip` VARCHAR(100) DEFAULT NULL,
  `tanggal_supervisi` DATE DEFAULT NULL,
  `keterangan` VARCHAR(255) DEFAULT NULL,
  `created_by` INT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_supervisi_guru_user` (`user_id`),
  KEY `fk_supervisi_guru_creator` (`created_by`),
  CONSTRAINT `fk_supervisi_guru_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_supervisi_guru_creator` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Penilaian instrumen
CREATE TABLE IF NOT EXISTS `supervisi_penilaian` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `guru_id` INT UNSIGNED NOT NULL,
  `instrumen` ENUM('G1','G2','G3','G4') NOT NULL,
  `aspek_values` JSON DEFAULT NULL,
  `score` DECIMAL(5,2) DEFAULT NULL,
  `max_score` INT NOT NULL,
  `predicate` VARCHAR(50) DEFAULT NULL,
  `tindak_lanjut` TEXT DEFAULT NULL,
  `is_saved` TINYINT(1) NOT NULL DEFAULT 0,
  `saved_at` TIMESTAMP NULL DEFAULT NULL,
  `created_by` INT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_penilaian_guru_instrumen` (`guru_id`, `instrumen`),
  KEY `fk_penilaian_creator` (`created_by`),
  CONSTRAINT `fk_penilaian_guru` FOREIGN KEY (`guru_id`) REFERENCES `supervisi_guru` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_penilaian_creator` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed default settings
INSERT IGNORE INTO `supervisi_settings` (`setting_key`, `setting_value`) VALUES
('kepsek_nama', ''),
('kepsek_nip', ''),
('kepsek_unit', ''),
('kepsek_kota', '');
