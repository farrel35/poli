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
CREATE DATABASE IF NOT EXISTS `db_poli` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_poli`;

-- Dumping structure for table db_poli.tbl_daftar_poli
CREATE TABLE IF NOT EXISTS `tbl_daftar_poli` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pasien` int NOT NULL,
  `id_jadwal` int NOT NULL,
  `keluhan` int NOT NULL,
  `no_antrian` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_daftar_poli_tbl_pasien` (`id_pasien`),
  KEY `FK_tbl_daftar_poli_tbl_jadwal_periksa` (`id_jadwal`),
  CONSTRAINT `FK_tbl_daftar_poli_tbl_jadwal_periksa` FOREIGN KEY (`id_jadwal`) REFERENCES `tbl_jadwal_periksa` (`id`),
  CONSTRAINT `FK_tbl_daftar_poli_tbl_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `tbl_pasien` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_poli.tbl_daftar_poli: ~0 rows (approximately)

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_poli.tbl_detail_periksa: ~0 rows (approximately)

-- Dumping structure for table db_poli.tbl_dokter
CREATE TABLE IF NOT EXISTS `tbl_dokter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL DEFAULT '',
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` int unsigned NOT NULL,
  `id_poli` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_dokter_tbl_poli` (`id_poli`),
  CONSTRAINT `FK_tbl_dokter_tbl_poli` FOREIGN KEY (`id_poli`) REFERENCES `tbl_poli` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_poli.tbl_dokter: ~0 rows (approximately)

-- Dumping structure for table db_poli.tbl_jadwal_periksa
CREATE TABLE IF NOT EXISTS `tbl_jadwal_periksa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_dokter` int NOT NULL,
  `hari` varchar(10) NOT NULL DEFAULT '',
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_jadwal_periksa_tbl_dokter` (`id_dokter`),
  CONSTRAINT `FK_tbl_jadwal_periksa_tbl_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `tbl_dokter` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_poli.tbl_jadwal_periksa: ~0 rows (approximately)

-- Dumping structure for table db_poli.tbl_obat
CREATE TABLE IF NOT EXISTS `tbl_obat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_obat` varchar(50) DEFAULT NULL,
  `kemasan` varchar(35) DEFAULT NULL,
  `harga` int unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_poli.tbl_obat: ~0 rows (approximately)

-- Dumping structure for table db_poli.tbl_pasien
CREATE TABLE IF NOT EXISTS `tbl_pasien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL DEFAULT '',
  `alamat` varchar(255) NOT NULL DEFAULT '',
  `no_ktp` int unsigned NOT NULL,
  `no_hp` int unsigned NOT NULL,
  `no_rm` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_poli.tbl_pasien: ~0 rows (approximately)

-- Dumping structure for table db_poli.tbl_periksa
CREATE TABLE IF NOT EXISTS `tbl_periksa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_daftar_poli` int NOT NULL,
  `tgl_periksa` date NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_periksa_tbl_daftar_poli` (`id_daftar_poli`),
  CONSTRAINT `FK_tbl_periksa_tbl_daftar_poli` FOREIGN KEY (`id_daftar_poli`) REFERENCES `tbl_daftar_poli` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_poli.tbl_periksa: ~0 rows (approximately)

-- Dumping structure for table db_poli.tbl_poli
CREATE TABLE IF NOT EXISTS `tbl_poli` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_poli.tbl_poli: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
