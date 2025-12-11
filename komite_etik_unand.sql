-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: komite_etik_unand
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_activity_logs`
--

DROP TABLE IF EXISTS `admin_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_activity_logs_user_id_created_at_index` (`user_id`,`created_at`),
  KEY `admin_activity_logs_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `admin_activity_logs_action_index` (`action`),
  CONSTRAINT `admin_activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_activity_logs`
--

LOCK TABLES `admin_activity_logs` WRITE;
/*!40000 ALTER TABLE `admin_activity_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ktd_sae`
--

DROP TABLE IF EXISTS `ktd_sae`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ktd_sae` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengajuan_id` bigint unsigned NOT NULL,
  `jenis_kejadian` enum('ktd','sae','uade') COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_penelitian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peneliti_utama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kejadian` date NOT NULL,
  `waktu_kejadian` time DEFAULT NULL,
  `deskripsi_kejadian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_kejadian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjek_terlibat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi_subjek_sebelum` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi_subjek_sesudah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat_keparahan` enum('ringan','sedang','berat','mengancam_jiwa','fatal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindakan_yang_diambil` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil_tindakan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hubungan_dengan_penelitian` enum('pasti','mungkin','kemungkinan_kecil','tidak_berhubungan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `analisis_penyebab` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindakan_pencegahan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen_pendukung` json DEFAULT NULL,
  `status` enum('draft','submitted','under_review','approved','follow_up_required') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `catatan_reviewer` text COLLATE utf8mb4_unicode_ci,
  `tanggal_submit` timestamp NULL DEFAULT NULL,
  `tanggal_review` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ktd_sae_nomor_laporan_unique` (`nomor_laporan`),
  KEY `ktd_sae_pengajuan_id_foreign` (`pengajuan_id`),
  KEY `ktd_sae_user_id_foreign` (`user_id`),
  CONSTRAINT `ktd_sae_pengajuan_id_foreign` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ktd_sae_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ktd_sae`
--

LOCK TABLES `ktd_sae` WRITE;
/*!40000 ALTER TABLE `ktd_sae` DISABLE KEYS */;
/*!40000 ALTER TABLE `ktd_sae` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_01_17_000001_add_rbac_fields_to_users_table',1),(5,'2025_01_17_000002_create_roles_table',1),(6,'2025_01_17_000003_create_permissions_table',1),(7,'2025_01_17_000004_create_role_user_table',1),(8,'2025_01_17_000005_create_permission_role_table',1),(9,'2025_01_17_000006_create_user_registrations_table',1),(10,'2025_01_17_000007_create_admin_activity_logs_table',1),(11,'2025_08_28_031749_create_pengajuan_table',1),(12,'2025_08_28_031813_create_ktd_sae_table',1),(13,'2025_08_28_041908_add_pembimbing_fields_to_pengajuan_table',1),(14,'2025_08_29_031310_add_evaluation_columns_to_pengajuan_table',1),(15,'2025_09_19_022123_create_news_table',1),(16,'2025_11_11_000001_add_operator_verification_to_user_registrations_table',1),(17,'0001_01_01_000003_create_sessions_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Panduan Baru Pengajuan Penelitian Etik 2025','Komite Etik Penelitian Universitas Andalas telah menerbitkan panduan terbaru untuk pengajuan penelitian etik tahun 2025. Panduan ini mencakup prosedur yang telah disederhanakan dan persyaratan dokumen yang lebih jelas. Peneliti diharapkan untuk mengikuti panduan terbaru ini dalam setiap pengajuan penelitian yang melibatkan subjek manusia. Panduan lengkap dapat diunduh melalui website resmi komite etik.',NULL,1,1,'Admin Komite Etik','2025-12-08 08:38:33','2025-12-08 08:38:33','2025-12-08 08:38:33'),(2,'Jadwal Rapat Komite Etik Bulan Januari 2025','Komite Etik Penelitian akan mengadakan rapat rutin pada tanggal 15 dan 30 Januari 2025. Rapat akan membahas pengajuan penelitian yang masuk dan evaluasi protokol penelitian yang sedang berjalan. Peneliti yang memiliki pengajuan dalam antrian akan diberitahu melalui email mengenai status review mereka.',NULL,1,0,'Sekretariat Komite Etik','2025-12-05 08:38:33','2025-12-05 08:38:33','2025-12-05 08:38:33'),(3,'Workshop Etika Penelitian untuk Mahasiswa S2 dan S3','Dalam rangka meningkatkan pemahaman tentang etika penelitian, Komite Etik akan mengadakan workshop khusus untuk mahasiswa S2 dan S3. Workshop akan membahas prinsip-prinsip dasar etika penelitian, cara mengisi formulir pengajuan, dan tips untuk mendapatkan persetujuan etik dengan cepat. Pendaftaran dibuka mulai tanggal 20 Januari 2025.',NULL,1,0,'Tim Edukasi Komite Etik','2025-12-03 08:38:33','2025-12-03 08:38:33','2025-12-03 08:38:33'),(4,'Pembaruan Sistem Informasi Komite Etik','Sistem informasi komite etik telah diperbarui dengan fitur-fitur baru untuk meningkatkan pengalaman pengguna. Fitur baru termasuk dashboard yang lebih informatif, tracking status pengajuan real-time, dan notifikasi email otomatis. Semua pengguna diharapkan untuk memperbarui profil mereka dan memastikan informasi kontak terbaru.',NULL,0,0,'Tim IT Komite Etik',NULL,'2025-12-09 08:38:33','2025-12-09 08:38:33');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengajuan`
--

DROP TABLE IF EXISTS `pengajuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengajuan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_pengajuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pengajuan` enum('baru','perbaikan','amandemen','laporan_akhir','perpanjangan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_penelitian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abstrak` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peneliti_utama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institusi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_peneliti` text COLLATE utf8mb4_unicode_ci,
  `pembimbing_data` json DEFAULT NULL,
  `nama_pembimbing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `lokasi_penelitian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode_penelitian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `populasi_sampel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kriteria_inklusi` text COLLATE utf8mb4_unicode_ci,
  `kriteria_eksklusi` text COLLATE utf8mb4_unicode_ci,
  `risiko_manfaat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `informed_consent` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen_pendukung` json DEFAULT NULL,
  `status` enum('draft','submitted','under_review','approved','rejected','revision_required') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `catatan_reviewer` text COLLATE utf8mb4_unicode_ci,
  `tanggal_submit` timestamp NULL DEFAULT NULL,
  `tanggal_review` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengajuan_nomor_pengajuan_unique` (`nomor_pengajuan`),
  KEY `pengajuan_user_id_foreign` (`user_id`),
  CONSTRAINT `pengajuan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengajuan`
--

LOCK TABLES `pengajuan` WRITE;
/*!40000 ALTER TABLE `pengajuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengajuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_role_permission_id_role_id_unique` (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1,1,NULL,NULL),(2,2,1,NULL,NULL),(3,3,1,NULL,NULL),(4,4,1,NULL,NULL),(5,5,1,NULL,NULL),(6,6,1,NULL,NULL),(7,7,1,NULL,NULL),(8,8,1,NULL,NULL),(9,9,1,NULL,NULL),(10,10,1,NULL,NULL),(11,11,1,NULL,NULL),(12,1,2,NULL,NULL),(13,2,2,NULL,NULL),(14,3,2,NULL,NULL),(15,4,2,NULL,NULL),(16,5,2,NULL,NULL),(17,6,2,NULL,NULL),(18,7,2,NULL,NULL),(19,2,3,NULL,NULL),(20,8,3,NULL,NULL),(21,9,4,NULL,NULL),(22,10,4,NULL,NULL),(23,11,4,NULL,NULL),(24,1,5,NULL,NULL),(25,2,5,NULL,NULL),(26,5,5,NULL,NULL),(27,6,5,NULL,NULL),(28,4,5,NULL,NULL);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view_monitoring','Monitoring Data','Melihat statistik dashboard dan monitoring','Monitoring',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(2,'view_pengajuan_list','Daftar Pengajuan','Mengakses daftar lengkap pengajuan etik','Pengajuan',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(3,'verify_pengajuan','Verifikasi Pengajuan','Memverifikasi dan menilai pengajuan etik','Pengajuan',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(4,'export_pengajuan','Export Data Pengajuan','Mengunduh data pengajuan dan laporan','Operasional',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(5,'view_users','Melihat User','Melihat dan mencari data user','User',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(6,'verify_users','Verifikasi User','Memverifikasi registrasi dan status user','User',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(7,'plot_lay_person','Plotting Lay Person','Menugaskan lay person ke pengajuan tertentu','Operasional',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(8,'fill_lay_person_forms','Isi Form Lay Person','Mengisi formulir review sesuai penugasan','Lay Person',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(9,'submit_pengajuan','Ajukan Usulan Etik','Mengirimkan usulan etik baru','Pengusul',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(10,'access_pengajuan_forms','Akses Form Pengajuan/Pelaporan','Mengakses seluruh formulir pengajuan dan pelaporan','Pengusul',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(11,'view_lay_person_inputs','Lihat Isian Lay Person','Mengakses catatan dari lay person','Pengusul',1,'2025-12-10 08:38:32','2025-12-10 08:38:32');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `assigned_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_user_role_id_user_id_unique` (`role_id`,`user_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_assigned_by_foreign` (`assigned_by`),
  CONSTRAINT `role_user_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,'2025-12-10 08:38:32',NULL,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(2,2,2,'2025-12-10 08:38:33',NULL,'2025-12-10 08:38:33','2025-12-10 08:38:33'),(3,3,3,'2025-12-10 08:38:33',NULL,'2025-12-10 08:38:33','2025-12-10 08:38:33'),(4,4,4,'2025-12-10 08:38:33',NULL,'2025-12-10 08:38:33','2025-12-10 08:38:33'),(5,5,5,'2025-12-10 08:38:33',NULL,'2025-12-10 08:38:33','2025-12-10 08:38:33');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_admin','Super Admin','Mengelola seluruh modul tanpa batasan akses',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(2,'verifikator','Verifikator','Memverifikasi pengajuan, memonitor data, dan plotting lay person',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(3,'lay_person','Lay Person','Reviewer masyarakat yang mengisi formulir penilaian',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(4,'pengusul_etik','Pengusul Etik','Peneliti/pengusul yang mengajukan proposal etik',1,'2025-12-10 08:38:32','2025-12-10 08:38:32'),(5,'operator','Operator','Mengelola user, verifikasi registrasi, dan eksport data',1,'2025-12-10 08:38:32','2025-12-10 08:38:32');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('TTL7P7KS7804YwBFHSsmyGqnKk62F7atCcfuz6eG',NULL,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidXBxcDQ0OWlFZzBDNFJId3NWV3V6SVhoZHFBYk9ja2xPYkNTWEQ1WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6OTA5MS9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1765267986);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_registrations`
--

DROP TABLE IF EXISTS `user_registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason_for_registration` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `operator_verified_at` timestamp NULL DEFAULT NULL,
  `operator_verified_by` bigint unsigned DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint unsigned DEFAULT NULL,
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `generated_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generated_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credentials_sent` tinyint(1) NOT NULL DEFAULT '0',
  `credentials_sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_registrations_email_unique` (`email`),
  KEY `user_registrations_approved_by_foreign` (`approved_by`),
  KEY `user_registrations_operator_verified_by_foreign` (`operator_verified_by`),
  CONSTRAINT `user_registrations_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  CONSTRAINT `user_registrations_operator_verified_by_foreign` FOREIGN KEY (`operator_verified_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_registrations`
--

LOCK TABLES `user_registrations` WRITE;
/*!40000 ALTER TABLE `user_registrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `approved_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint unsigned DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_approved_by_foreign` (`approved_by`),
  CONSTRAINT `users_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Administrator','superadmin','superadmin@komite-etik.unand.ac.id','081200000001','2025-12-10 08:38:32','active','super_admin','2025-12-10 08:38:32','$2y$12$l51UNpniLXfS5K9.A47EyOX.MgxXQREKArJTzpHyZmL4i56dezNc2',NULL,'2025-12-10 08:38:32','2025-12-10 08:38:32',NULL,NULL,NULL,NULL,NULL),(2,'Verifikator Utama','verifikator','verifikator@komite-etik.unand.ac.id','081200000002','2025-12-10 08:38:33','active','verifikator','2025-12-10 08:38:33','$2y$12$DlKM47UEvNazP6kQXIT/GejuAhILvCxnIvxUDEbO/psgRbitjMAf6',NULL,'2025-12-10 08:38:33','2025-12-10 08:38:33',NULL,NULL,NULL,NULL,NULL),(3,'Lay Person Panel','layperson','layperson@komite-etik.unand.ac.id','081200000003','2025-12-10 08:38:33','active','lay_person','2025-12-10 08:38:33','$2y$12$0dMKyK0Bltb97ZxY2JJPx.0U7Weqnq6AGZaVSFHgINKCnlJtJm4BC',NULL,'2025-12-10 08:38:33','2025-12-10 08:38:33',NULL,NULL,NULL,NULL,NULL),(4,'Pengusul Etik Demo','pengusul','pengusul@komite-etik.unand.ac.id','081200000004','2025-12-10 08:38:33','active','pengusul_etik','2025-12-10 08:38:33','$2y$12$V5AnDN2rcgm/hvn/5NePOuZfC6xI8eau57rmYhx/21INEoK52qwuC',NULL,'2025-12-10 08:38:33','2025-12-10 08:38:33',NULL,NULL,NULL,NULL,NULL),(5,'Operator Komite','operator','operator@komite-etik.unand.ac.id','081200000005','2025-12-10 08:38:33','active','operator','2025-12-10 08:38:33','$2y$12$y78R2pELPw52MY3WJChGlOvxpBYkPn86ssxlN0GZu/DosPCL0TuC6',NULL,'2025-12-10 08:38:33','2025-12-10 08:38:33',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-10  8:38:46
