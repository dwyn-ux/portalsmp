-- Kartu Pelajar — Migration
-- Adapted from nirsinggih/kartu-pelajar with kp_ prefix

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `kp_pengaturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kepala_sekolah` varchar(100) DEFAULT NULL,
  `nip_kepala_sekolah` varchar(30) NOT NULL DEFAULT '',
  `tanggal_ttd` date DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `tanda_tangan` varchar(100) DEFAULT NULL,
  `background` varchar(100) DEFAULT NULL,
  `background_belakang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `kp_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','siswa') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `kp_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis` (`nis`),
  UNIQUE KEY `nisn` (`nisn`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `kp_siswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `kp_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed: admin (password: admin123 = md5)
INSERT IGNORE INTO `kp_users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', MD5('admin123'), 'admin');

-- Seed: pengaturan
INSERT IGNORE INTO `kp_pengaturan` (`id`, `nama_sekolah`, `alamat`, `kepala_sekolah`, `nip_kepala_sekolah`) VALUES
(1, 'SMP Muhammadiyah Unggulan Ashidiq', '', '', '');
