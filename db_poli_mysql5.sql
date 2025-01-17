-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_poli
CREATE DATABASE IF NOT EXISTS `db_poli` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_poli`;

-- Dumping structure for table db_poli.tbl_daftar_poli
CREATE TABLE IF NOT EXISTS `tbl_daftar_poli` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pasien` int NOT NULL,
  `id_jadwal` int NOT NULL,
  `keluhan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_antrian` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_daftar_poli_tbl_pasien` (`id_pasien`),
  KEY `FK_tbl_daftar_poli_tbl_jadwal_periksa` (`id_jadwal`),
  CONSTRAINT `FK_tbl_daftar_poli_tbl_jadwal_periksa` FOREIGN KEY (`id_jadwal`) REFERENCES `tbl_jadwal_periksa` (`id`),
  CONSTRAINT `FK_tbl_daftar_poli_tbl_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `tbl_pasien` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_poli.tbl_daftar_poli: ~7 rows (approximately)
INSERT INTO `tbl_daftar_poli` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`) VALUES
	(1, 1, 1, 'cek keluhan', 1),
	(2, 1, 2, 'kaki saya sakit', 1),
	(3, 5, 2, 'test', 2),
	(4, 5, 4, 'cek', 1),
	(7, 1, 2, 'test', 3),
	(8, 1, 6, 'gigi saya sakit', 1),
	(9, 1, 2, 'tesdt', 4);

-- Dumping structure for table db_poli.tbl_detail_periksa
CREATE TABLE IF NOT EXISTS `tbl_detail_periksa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_periksa` int NOT NULL,
  `id_obat` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_detail_periksa_tbl_periksa` (`id_periksa`),
  KEY `FK_tbl_detail_periksa_tbl_obat` (`id_obat`),
  CONSTRAINT `FK_tbl_detail_periksa_tbl_obat` FOREIGN KEY (`id_obat`) REFERENCES `tbl_obat` (`id`),
  CONSTRAINT `FK_tbl_detail_periksa_tbl_periksa` FOREIGN KEY (`id_periksa`) REFERENCES `tbl_periksa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_poli.tbl_detail_periksa: ~10 rows (approximately)
INSERT INTO `tbl_detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
	(13, 1, 1),
	(14, 1, 2),
	(15, 3, 1),
	(16, 3, 2),
	(17, 3, 3),
	(18, 4, 1),
	(19, 4, 3),
	(20, 2, 1),
	(23, 5, 1),
	(24, 5, 3);

-- Dumping structure for table db_poli.tbl_dokter
CREATE TABLE IF NOT EXISTS `tbl_dokter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL DEFAULT '',
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) NOT NULL DEFAULT '',
  `id_poli` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_dokter_tbl_poli` (`id_poli`),
  CONSTRAINT `FK_tbl_dokter_tbl_poli` FOREIGN KEY (`id_poli`) REFERENCES `tbl_poli` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_poli.tbl_dokter: ~3 rows (approximately)
INSERT INTO `tbl_dokter` (`id`, `nama`, `alamat`, `no_hp`, `id_poli`) VALUES
	(1, 'Santoso', 'Semarang', '4294967295', 1),
	(2, 'Budi', 'Semarang', '089603450314', 2),
	(3, 'Sulistyo', 'Semarang', '123456', 1);

-- Dumping structure for table db_poli.tbl_jadwal_periksa
CREATE TABLE IF NOT EXISTS `tbl_jadwal_periksa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_dokter` int NOT NULL,
  `hari` varchar(10) NOT NULL DEFAULT '',
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `isActive` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_tbl_jadwal_periksa_tbl_dokter` (`id_dokter`),
  CONSTRAINT `FK_tbl_jadwal_periksa_tbl_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `tbl_dokter` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_poli.tbl_jadwal_periksa: ~6 rows (approximately)
INSERT INTO `tbl_jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `isActive`) VALUES
	(1, 1, 'Senin', '08:00:00', '10:00:00', 0),
	(2, 1, 'Selasa', '09:00:00', '11:00:00', 1),
	(3, 1, 'Rabu', '10:00:00', '00:00:00', 0),
	(4, 2, 'Jumat', '09:00:00', '11:00:00', 0),
	(5, 2, 'Senin', '23:43:00', '11:43:00', 0),
	(6, 2, 'Kamis', '09:00:00', '10:00:00', 1);

-- Dumping structure for table db_poli.tbl_obat
CREATE TABLE IF NOT EXISTS `tbl_obat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_obat` varchar(50) DEFAULT NULL,
  `kemasan` varchar(35) DEFAULT NULL,
  `harga` int unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_poli.tbl_obat: ~3 rows (approximately)
INSERT INTO `tbl_obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
	(1, 'ACT(Artesunate tablet 50 mg + Amodiaquine anhydrid', '2 blister @ 12 tablet / kotak', 44000),
	(2, 'Albendasol suspensi 200 mg/5 ml', 'Ktk 10 btl @ 10 ml', 6000),
	(3, 'Alopurinol tablet 100 mg', 'ktk 10 x 10 tablet', 16000);

-- Dumping structure for table db_poli.tbl_pasien
CREATE TABLE IF NOT EXISTS `tbl_pasien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL DEFAULT '',
  `alamat` varchar(255) NOT NULL DEFAULT '',
  `no_ktp` varchar(50) NOT NULL DEFAULT '',
  `no_hp` varchar(50) NOT NULL DEFAULT '',
  `no_rm` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_poli.tbl_pasien: ~2 rows (approximately)
INSERT INTO `tbl_pasien` (`id`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`) VALUES
	(1, 'Farrel Ardian', 'Semarang', '12345', '4294967295', '202412-001'),
	(5, 'Ardi', 'Semarang', '123456', '089603450314', '202412-002');

-- Dumping structure for table db_poli.tbl_periksa
CREATE TABLE IF NOT EXISTS `tbl_periksa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_daftar_poli` int NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_periksa_tbl_daftar_poli` (`id_daftar_poli`),
  CONSTRAINT `FK_tbl_periksa_tbl_daftar_poli` FOREIGN KEY (`id_daftar_poli`) REFERENCES `tbl_daftar_poli` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_poli.tbl_periksa: ~5 rows (approximately)
INSERT INTO `tbl_periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
	(1, 1, '2024-12-17 19:50:00', 'silahkan istirahat dirumah', 200000),
	(2, 4, '2024-12-17 20:03:00', 'cek ardi', 194000),
	(3, 2, '2024-12-17 20:09:00', 'istirahat yang cukup', 216000),
	(4, 3, '2024-12-17 20:10:00', 'cek', 210000),
	(5, 8, '2024-12-23 11:46:00', 'istirahat dengan cukup', 210000);

-- Dumping structure for table db_poli.tbl_poli
CREATE TABLE IF NOT EXISTS `tbl_poli` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_poli.tbl_poli: ~2 rows (approximately)
INSERT INTO `tbl_poli` (`id`, `nama_poli`, `keterangan`) VALUES
	(1, 'Poli Umum', 'Dokter Umum'),
	(2, 'Poli Gigi', 'Dokter Gigi');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
