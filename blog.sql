-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2026 at 06:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `module` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `module`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 1, 'create', 'users', 'Menambahkan pengguna baru: budi', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '2026-09-11 06:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `cover_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int UNSIGNED DEFAULT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_general_ci,
  `content` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('draft','published','scheduled','archived') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'draft',
  `view_count` int UNSIGNED NOT NULL DEFAULT '0',
  `seo_title` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `seo_description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `seo_keywords` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `canonical_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `author_id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `status`, `view_count`, `seo_title`, `seo_description`, `seo_keywords`, `canonical_url`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'Kegiatan Upacara Hari Kemerdekaan RI', 'kegiatan-upacara-hari-kemerdekaan-ri', 'Sekolah mengadakan upacara bendera memperingati Hari Kemerdekaan RI dengan khidmat.', '<p>Sekolah mengadakan upacara bendera memperingati Hari Kemerdekaan RI dengan khidmat diikuti oleh seluruh siswa, guru, dan staf sekolah.</p>', NULL, 'published', 29, NULL, NULL, NULL, NULL, '2026-09-11 13:14:24', '2026-09-11 13:14:24', '2026-09-11 06:42:02', NULL),
(2, 3, 2, 'Tim Sains Sekolah Raih Medali Emas Olimpiade Nasional', 'tim-sains-sekolah-raih-medali-emas-olimpiade-nasional', 'Siswa kita berhasil memborong medali emas pada ajang Olimpiade Sains Nasional.', '<p>Selamat kepada Ananda Ahmad dan Tim yang berhasil membawa pulang <strong>Medali Emas</strong> dalam ajang Olimpiade Sains tingkat nasional.</p>', NULL, 'published', 36, NULL, NULL, NULL, NULL, '2026-09-11 13:14:24', '2026-09-11 13:14:24', '2026-09-11 06:41:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_attachments`
--

CREATE TABLE `article_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `article_id` bigint UNSIGNED NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `stored_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `extension` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `mime_type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` int UNSIGNED NOT NULL,
  `download_count` int UNSIGNED NOT NULL DEFAULT '0',
  `uploaded_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `button_text` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `seo_title` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `seo_description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `seo_title`, `seo_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pengumuman Resmi', 'pengumuman', 'Pengumuman penting dan resmi dari pimpinan sekolah.', NULL, NULL, 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24', NULL),
(2, 'Kegiatan Sekolah', 'kegiatan-sekolah', 'Kumpulan dokumentasi kegiatan operasional dan kesiswaan.', NULL, NULL, 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24', NULL),
(3, 'Prestasi Siswa', 'prestasi-siswa', 'Kabar raihan prestasi akademik maupun non-akademik.', NULL, NULL, 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('unread','read','replied','archived') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'unread',
  `read_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `original_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `stored_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `extension` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `mime_type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` int UNSIGNED NOT NULL,
  `download_count` int UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `uploaded_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_photos`
--

CREATE TABLE `gallery_photos` (
  `id` bigint UNSIGNED NOT NULL,
  `album_id` int UNSIGNED NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `stored_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `caption` text COLLATE utf8mb4_general_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `uploaded_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int UNSIGNED NOT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `target` enum('_self','_blank') COLLATE utf8mb4_general_ci NOT NULL DEFAULT '_self',
  `icon` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `url`, `target`, `icon`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Profil', '#', '_self', NULL, 1, 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24'),
(2, 1, 'Profil Sekolah', '/halaman/profil', '_self', NULL, 1, 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24'),
(3, 1, 'Sejarah', '/halaman/sejarah', '_self', NULL, 2, 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24'),
(4, 1, 'Visi & Misi', '/halaman/visi-misi', '_self', NULL, 3, 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24'),
(5, NULL, 'Berita', '/artikel', '_self', NULL, 2, 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24'),
(6, NULL, 'Dokumen', '/dokumen', '_self', NULL, 3, 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24'),
(7, NULL, 'Kontak', '/kontak', '_self', NULL, 4, 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-09-10-000001', 'App\\Database\\Migrations\\Roles', 'default', 'App', 1789058562, 1),
(2, '2026-09-10-000002', 'App\\Database\\Migrations\\Users', 'default', 'App', 1789058562, 1),
(3, '2026-09-10-000003', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1789058562, 1),
(4, '2026-09-10-000004', 'App\\Database\\Migrations\\Articles', 'default', 'App', 1789058562, 1),
(5, '2026-09-10-000005', 'App\\Database\\Migrations\\ArticleAttachments', 'default', 'App', 1789058562, 1),
(6, '2026-09-10-000006', 'App\\Database\\Migrations\\Pages', 'default', 'App', 1789058562, 1),
(7, '2026-09-10-000007', 'App\\Database\\Migrations\\Menus', 'default', 'App', 1789058562, 1),
(8, '2026-09-10-000008', 'App\\Database\\Migrations\\Banners', 'default', 'App', 1789058562, 1),
(9, '2026-09-10-000009', 'App\\Database\\Migrations\\Albums', 'default', 'App', 1789058562, 1),
(10, '2026-09-10-000010', 'App\\Database\\Migrations\\GalleryPhotos', 'default', 'App', 1789058562, 1),
(11, '2026-09-10-000011', 'App\\Database\\Migrations\\Documents', 'default', 'App', 1789058562, 1),
(12, '2026-09-10-000012', 'App\\Database\\Migrations\\SocialMedia', 'default', 'App', 1789058562, 1),
(13, '2026-09-10-000013', 'App\\Database\\Migrations\\ContactMessages', 'default', 'App', 1789058562, 1),
(14, '2026-09-10-000014', 'App\\Database\\Migrations\\SchoolProfile', 'default', 'App', 1789058562, 1),
(15, '2026-09-10-000015', 'App\\Database\\Migrations\\ActivityLogs', 'default', 'App', 1789058562, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_general_ci,
  `content` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'draft',
  `seo_title` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `seo_description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `seo_keywords` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `author_id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `status`, `seo_title`, `seo_description`, `seo_keywords`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Profil Sekolah', 'profil', 'Profil ringkas tentang institusi pendidikan kami.', '<h3>Tentang Kami</h3><p>SMA Contoh Nusantara adalah institusi pendidikan menengah unggulan.</p>', NULL, 'published', NULL, NULL, NULL, '2026-09-11 13:14:24', '2026-09-11 13:14:24', '2026-09-11 13:14:24', NULL),
(2, 1, 'Sejarah Singkat', 'sejarah', 'Sejarah berdirinya sekolah dari masa ke masa.', '<h3>Sejarah Berdirinya Sekolah</h3><p>Didirikan pada tahun 1995, sekolah ini telah meluluskan ribuan alumni.</p>', NULL, 'published', NULL, NULL, NULL, '2026-09-11 13:14:24', '2026-09-11 13:14:24', '2026-09-11 13:14:24', NULL),
(3, 1, 'Visi & Misi', 'visi-misi', 'Visi dan Misi Utama Sekolah', '<h3>Visi</h3><p>Terwujudnya Generasi Cerdas dan Berkarakter.</p>', NULL, 'published', NULL, NULL, NULL, '2026-09-11 13:14:24', '2026-09-11 13:14:24', '2026-09-11 13:14:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', 'Memiliki hak akses penuh ke seluruh sistem', 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24'),
(2, 'Author', 'author', 'Hanya dapat menulis dan mengelola artikel sendiri', 'active', '2026-09-11 13:14:24', '2026-09-11 13:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `school_profile`
--

CREATE TABLE `school_profile` (
  `id` tinyint(1) NOT NULL,
  `school_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `school_short_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `npsn` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `postal_code` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `google_maps_url` text COLLATE utf8mb4_general_ci,
  `principal_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `principal_photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `principal_message` text COLLATE utf8mb4_general_ci,
  `seo_title_default` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `seo_desc_default` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `footer_text` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_profile`
--

INSERT INTO `school_profile` (`id`, `school_name`, `school_short_name`, `npsn`, `level`, `logo`, `favicon`, `address`, `postal_code`, `phone`, `email`, `google_maps_url`, `principal_name`, `principal_photo`, `principal_message`, `seo_title_default`, `seo_desc_default`, `footer_text`, `updated_at`) VALUES
(1, 'SMA Contoh Nusantara', 'SMACON', '12345678', 'SMA', 'uploads/settings/1789104916_da21857992597878e80a.png', NULL, 'Jl. Pendidikan No. 1, Bandar Lampung', '35141', '0721-123456', 'info@smacon.sch.id', '', 'Drs. H. Bambang Subagyo, M.M.', NULL, 'Selamat datang di portal informasi resmi sekolah kami.', 'SMA Contoh Nusantara - Sekolah Unggulan', 'Official Website SMA Contoh Nusantara Bandar Lampung', '© 2026 SMA Contoh Nusantara. All Rights Reserved.', '2026-09-11 05:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `platform` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `job_title` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_general_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `last_login_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `email`, `password`, `avatar`, `job_title`, `bio`, `status`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Administrator Utama', 'admin', 'admin@sekolah.com', '$2y$10$NhM.JU.DB.I7IAYk1mkFg.DEywbsz6CrVxcAYIBOnow5sIJTSeGvq', NULL, 'System Administrator', 'Pengelola utama sistem website dan TI sekolah.', 'active', NULL, '2026-09-11 13:14:24', '2026-09-11 13:14:24', NULL),
(2, 2, 'Yolandika Sila Chandra', 'yolan_sc', 'yolandikasila@gmail.com', '$2y$10$5hMwGYjSAoxN.kW1fkt62e8vu9ijMrVA0tln8mrbCsHlhkTF6jjSq', NULL, 'Penulis Berita & Humas', 'Penulis aktif berita operasional dan prestasi sekolah.', 'active', NULL, '2026-09-11 13:14:24', '2026-09-11 13:14:24', NULL),
(3, 2, 'BUDI', 'budi', 'budi@example.com', '$2y$10$4Ry4ul48id4K4ULyvZ0sXuSr5nw6WR2iagbZBIm9p7yApSYbsIhhu', NULL, 'guru', '', 'active', NULL, '2026-09-11 06:27:29', '2026-09-11 06:27:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `articles_category_id_foreign` (`category_id`),
  ADD KEY `articles_author_id_foreign` (`author_id`),
  ADD KEY `status` (`status`),
  ADD KEY `published_at` (`published_at`);
ALTER TABLE `articles` ADD FULLTEXT KEY `articles_search_fulltext` (`title`,`excerpt`,`content`);

--
-- Indexes for table `article_attachments`
--
ALTER TABLE `article_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_attachments_article_id_foreign` (`article_id`),
  ADD KEY `article_attachments_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `documents_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `gallery_photos`
--
ALTER TABLE `gallery_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_photos_album_id_foreign` (`album_id`),
  ADD KEY `gallery_photos_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `pages_author_id_foreign` (`author_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `school_profile`
--
ALTER TABLE `school_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `article_attachments`
--
ALTER TABLE `article_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery_photos`
--
ALTER TABLE `gallery_photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `article_attachments`
--
ALTER TABLE `article_attachments`
  ADD CONSTRAINT `article_attachments_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_attachments_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `gallery_photos`
--
ALTER TABLE `gallery_photos`
  ADD CONSTRAINT `gallery_photos_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_photos_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
