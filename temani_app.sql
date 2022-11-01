-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: temani_app
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adm_categories`
--

DROP TABLE IF EXISTS `adm_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adm_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ca_name` varchar(100) DEFAULT NULL,
  `ca_description` varchar(255) DEFAULT NULL,
  `ca_icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_categories`
--

LOCK TABLES `adm_categories` WRITE;
/*!40000 ALTER TABLE `adm_categories` DISABLE KEYS */;
INSERT INTO `adm_categories` VALUES (1,'Keamanan','Aduan seputar keamanan wilayah.','storage/files/icon-2022-01-11/092121_undraw_security_on_re_e491.svg','2022-01-11 02:21:21','2022-01-11 02:31:41',NULL),(2,'Kesehatan','Aduan seputar kesehatan masyarakat.','storage/files/icon-2022-01-11/163635_undraw_medicine_b-1-ol.svg','2022-01-11 09:36:35','2022-01-11 09:37:37',NULL),(3,'Pekerjaan Umum','Aduan seputar pekerjaan umum dan infrastruktur.','storage/files/icon-2022-01-11/175837_undraw_coming_home_-52-ir.svg','2022-01-11 10:58:37','2022-01-11 10:58:37',NULL),(4,'Sosial','Aduan seputar sosial.','storage/files/icon-2022-01-11/180342_undraw_social_friends_re_7uaa.svg','2022-01-11 11:03:42','2022-01-11 11:03:42',NULL);
/*!40000 ALTER TABLE `adm_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rep_headers`
--

DROP TABLE IF EXISTS `rep_headers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rep_headers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `he_title` varchar(100) DEFAULT NULL,
  `he_description` text DEFAULT NULL,
  `he_place` varchar(255) DEFAULT NULL,
  `he_place_lat` varchar(255) DEFAULT NULL,
  `he_place_long` varchar(255) DEFAULT NULL,
  `he_image` varchar(255) DEFAULT NULL,
  `he_date` date DEFAULT NULL,
  `he_time` time DEFAULT NULL,
  `he_category` int(11) DEFAULT NULL,
  `he_creator` int(11) DEFAULT NULL,
  `he_worker` int(11) DEFAULT NULL,
  `he_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `he_departement` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rep_header_FK_worker` (`he_worker`),
  KEY `rep_header_FK_creator` (`he_creator`),
  KEY `rep_header_FK_category` (`he_category`),
  CONSTRAINT `rep_header_FK_category` FOREIGN KEY (`he_category`) REFERENCES `adm_categories` (`id`),
  CONSTRAINT `rep_header_FK_creator` FOREIGN KEY (`he_creator`) REFERENCES `adm_users` (`id`),
  CONSTRAINT `rep_header_FK_worker` FOREIGN KEY (`he_worker`) REFERENCES `adm_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rep_headers`
--

LOCK TABLES `rep_headers` WRITE;
/*!40000 ALTER TABLE `rep_headers` DISABLE KEYS */;
INSERT INTO `rep_headers` VALUES (2,'Jalan di depan gapura RT. 06 sudah mulai retak !','Mohon untuk jalan di depan gapura RT. 06 Kampung Santri diperhatikan karena sudah mulai retak. Jika tidak ditangani bisa membahayakan bagi pengendara motor dan pejalan kaki !','Kampung Santri','-6.256167','106.637828','storage/files/report-2022-01-12/225806_asphalt-3399815_960_720.jpg','2022-01-11','21:00:00',3,1,3,3,'2022-01-11 15:58:06','2022-01-13 09:21:54',NULL,3),(3,'Begal meresahkan warga tangerang !','Mohon bantuan untuk pihak kepolisian, begal sering sekali terjadi didaerah saya saat malam hari.','Ciputat Timur',NULL,NULL,'storage/files/report-2022-01-13/164748_tiang-tiang-makan-badan-jalan-di-jl-wr-supratman-ciputat-timur-tangsel-16-september-2021-faiz-iqbal-mauliddetikcom-2.jpeg','2022-01-13','09:00:00',1,6,2,3,'2022-01-13 09:47:48','2022-01-13 09:49:51',NULL,1),(4,'Jalanan di jalan A berlubang dan membahayakan pengendara !','Mohon perhatiannya bagi dinas PU untuk menangani jalanan yang rusak di Jalan A.','Tangerang Selatan',NULL,NULL,'storage/files/report-2022-01-13/210510_asphalt-3399815_960_720.jpg','2022-01-13','09:00:00',3,6,3,3,'2022-01-13 14:05:10','2022-01-13 14:13:54',NULL,3);
/*!40000 ALTER TABLE `rep_headers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_users`
--

DROP TABLE IF EXISTS `adm_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `us_name` varchar(100) DEFAULT NULL,
  `us_email` varchar(100) DEFAULT NULL,
  `us_password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `us_role` varchar(50) DEFAULT NULL,
  `us_structural` varchar(100) DEFAULT NULL,
  `us_departement` int(11) DEFAULT NULL,
  `us_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `adm_users_FK_departement` (`us_departement`),
  CONSTRAINT `adm_users_FK_departement` FOREIGN KEY (`us_departement`) REFERENCES `adm_departements` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_users`
--

LOCK TABLES `adm_users` WRITE;
/*!40000 ALTER TABLE `adm_users` DISABLE KEYS */;
INSERT INTO `adm_users` VALUES (1,'Baskara Arjuna Putra','baskara@temani.id','$2y$10$bnS6eGSTc7Gx8V6ZECNw8OqqUYG17IwJM.TlGEDJ1kg4PwhkBPHbu','2022-01-10 14:36:00','2022-01-10 09:07:06',NULL,'ADMIN','Pengelola Aplikasi',NULL,NULL),(2,'Yudhistira Wijayanegara','yudhistira@temani.id','$2y$10$K0xuL6Ga.NddNg7qIgGSiOr6HbU4Kc7/xSoa7Zb7SOdi78HR2SjVy','2022-01-12 14:36:58','2022-01-12 14:46:40',NULL,'EMPLOYEE','Pegawai',1,'Tangerang Selatan'),(3,'Bima Satria','bima@temani.id','$2y$10$NtMf0lrNZY1rSh/.6xW8Me0QuKeQxfwBxlkIuxTqndwPix0zypgX2','2022-01-12 14:45:03','2022-01-12 14:45:03',NULL,'EMPLOYEE','Pegawai',3,'Tangerang Selatan'),(4,'Askara Cahaya','askara@temani.id','$2y$10$w3E7f2I6pRq68hf65yvWCOip48MJuT7d8T40EFvlrzYt2S6e9CGZe','2022-01-12 14:45:48','2022-01-13 10:28:43',NULL,'EMPLOYEE','Pegawai',4,'Tangerang Selatan'),(5,'Pandu Winata','pandu@temani.id','$2y$10$qlbGoW5O2oqJRml0qk9KMuLA93E3wYdRQKg8hfqBHK8/qvHefoWYe','2022-01-12 14:46:29','2022-01-12 14:46:29',NULL,'EMPLOYEE','Pegawai',2,'Tangerang Selatan'),(6,'Yahya Oktariansyah','yahya@temani.id','$2y$10$3yv/fGG1clW2n/2/WTYAruUiXExKYImuxmcIssyu21fYqWKEqRlXi','2022-01-13 09:45:27','2022-01-13 10:29:21',NULL,'USER',NULL,NULL,'Tangerang Selatan');
/*!40000 ALTER TABLE `adm_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_departements`
--

DROP TABLE IF EXISTS `adm_departements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adm_departements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `de_name` varchar(100) DEFAULT NULL,
  `de_icon` varchar(255) DEFAULT NULL,
  `de_is_active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `de_description` varchar(255) DEFAULT NULL,
  `de_category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `adm_departements_FK_category` (`de_category`),
  CONSTRAINT `adm_departements_FK_category` FOREIGN KEY (`de_category`) REFERENCES `adm_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_departements`
--

LOCK TABLES `adm_departements` WRITE;
/*!40000 ALTER TABLE `adm_departements` DISABLE KEYS */;
INSERT INTO `adm_departements` VALUES (1,'Polres Tangerang Selatan','storage/files/icon-2022-01-11/174948_Lambang_Polda_Metro_Jaya.png',NULL,'2022-01-11 10:49:48','2022-01-11 11:03:22',NULL,'-',1),(2,'Dinas Kesehatan Tangerang Selatan','storage/files/icon-2022-01-11/175232_logo (1).png',NULL,'2022-01-11 10:51:08','2022-01-11 10:59:33',NULL,'-',2),(3,'Dinas Pekerjaan Umum Tangerang Selatan','storage/files/icon-2022-01-11/175247_download (1).png',NULL,'2022-01-11 10:52:48','2022-01-11 11:03:10',NULL,'-',3),(4,'Dinas Sosial Tangerang Selatan','storage/files/icon-2022-01-11/175414_kementerian sosial logo vektor cdr (1).jpg',NULL,'2022-01-11 10:54:14','2022-01-11 11:03:54',NULL,'-',4);
/*!40000 ALTER TABLE `adm_departements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rep_comments`
--

DROP TABLE IF EXISTS `rep_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rep_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ce_content` varchar(255) DEFAULT NULL,
  `ce_image` varchar(255) DEFAULT NULL,
  `ce_header` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rep_comments_FK` (`ce_header`),
  CONSTRAINT `rep_comments_FK` FOREIGN KEY (`ce_header`) REFERENCES `rep_headers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rep_comments`
--

LOCK TABLES `rep_comments` WRITE;
/*!40000 ALTER TABLE `rep_comments` DISABLE KEYS */;
INSERT INTO `rep_comments` VALUES (1,'Tim PU telah kami kirimkan ke titik yang diberikan.','storage/files/report-2022-01-13/160227_Jalan-Bhayangkara-Serpong-Utara-Kota-Tangerang-Selatan-Tangsel.jpeg',2,'2022-01-12 09:02:27','2022-01-12 09:02:27',NULL),(2,'Jalanan telah diperbaiki oleh tim PU dan dapat digunakan oleh masyarakat kembali.',NULL,2,'2022-01-13 09:21:54','2022-01-13 09:21:54',NULL),(3,'Terimakasih untuk aduannya. Kami akan mengirimkan patroli lebih ke daerah tersebut. Terus laporkan perkembangannya kepada kami.',NULL,3,'2022-01-13 09:49:51','2022-01-13 09:49:51',NULL),(4,'Tim PU telah datang ke tempat dan akan melakukan pekerjaan.','storage/files/report-2022-01-13/211215_Jalan-Bhayangkara-Serpong-Utara-Kota-Tangerang-Selatan-Tangsel.jpeg',4,'2022-01-13 14:12:15','2022-01-13 14:12:15',NULL),(5,'Jalan telah diperbaiki dan dapat digunakan kembali.',NULL,4,'2022-01-13 14:13:54','2022-01-13 14:13:54',NULL);
/*!40000 ALTER TABLE `rep_comments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-15 11:38:40
