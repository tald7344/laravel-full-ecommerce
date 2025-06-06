-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 06:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'talal', 'tald2905@gmail.com', '$2y$10$RjGz6peXtOERT1Vgj2sf1uUaLh401RkQ1pi.G9LkQezeCnJSJtzbC', NULL, '2020-05-29 16:26:48', '2020-05-29 16:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_events`
--

CREATE TABLE `calendar_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_name` varchar(191) NOT NULL,
  `event_start` date NOT NULL,
  `event_end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `cities_name_ar` varchar(191) NOT NULL,
  `cities_name_en` varchar(191) NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `cities_name_ar`, `cities_name_en`, `country_id`, `created_at`, `updated_at`) VALUES
(4, 'دمشق', 'Damascus', 2, '2020-06-13 03:49:15', '2020-06-13 03:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `colors_name_ar` varchar(191) NOT NULL,
  `colors_name_en` varchar(191) NOT NULL,
  `color` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `colors_name_ar`, `colors_name_en`, `color`, `created_at`, `updated_at`) VALUES
(4, 'أزرق', 'Blue', '#0011ff', '2020-06-30 06:47:30', '2020-06-30 06:47:30'),
(5, 'أخضر', 'Green', '#37ff00', '2020-06-30 06:47:45', '2020-06-30 06:47:45'),
(6, 'أسود', 'black', '#000000', '2020-07-08 07:49:54', '2020-07-08 07:49:54'),
(7, 'ابيض', 'white', '#ffffff', '2025-03-30 01:56:51', '2025-03-30 01:56:51'),
(8, 'أجمر', 'Red', '#ff0000', '2025-03-30 01:57:25', '2025-03-30 01:57:25'),
(9, 'Brushed Slate', 'Brushed Slate', '#907f7f', '2025-03-30 05:33:29', '2025-03-30 05:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `countries_name_ar` varchar(191) NOT NULL,
  `countries_name_en` varchar(191) NOT NULL,
  `mob` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `countries_name_ar`, `countries_name_en`, `mob`, `code`, `currency`, `logo`, `created_at`, `updated_at`) VALUES
(2, 'سوريا', 'syria', '963', 'SY', 'SYP', 'countries/VOvpKd6glMtGE6TaXFS90ju5fBevVMsjch7ErAm9.png', '2020-06-12 13:22:52', '2020-06-20 15:29:36'),
(3, 'السعودية', 'Suwody Arebia', '966', 'KSA', 'SAR', 'countries/FMahi3ZvJ7b2rSDJCubb6mOdn0r58N5MOomFsVgF.png', '2020-06-30 07:56:22', '2020-06-30 07:56:22'),
(4, 'الولايات المتحدة الامريكية', 'United American State', '+1', 'US', '$', NULL, '2025-03-29 16:44:05', '2025-03-29 16:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE `departements` (
  `id` int(10) UNSIGNED NOT NULL,
  `dep_name_ar` varchar(191) NOT NULL,
  `dep_name_en` varchar(191) NOT NULL,
  `icon` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `keywords` varchar(191) DEFAULT NULL,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id`, `dep_name_ar`, `dep_name_en`, `icon`, `description`, `keywords`, `parent`, `created_at`, `updated_at`) VALUES
(14, 'الاجهزة الذكية', 'Smart Device', 'departements/wPu17hIhmcDn1MV8xSjUtjlfigdGQz9GCjKTI5rN.png', NULL, NULL, NULL, '2020-06-14 07:11:21', '2020-06-29 06:43:49'),
(15, 'اجهزة الموبايل واللوحية', 'Moblie and Tablet', NULL, NULL, NULL, 14, '2020-06-29 06:44:42', '2020-06-29 06:44:42'),
(16, 'كومبيوتر ولابتوب', 'Computers And Laptop', NULL, NULL, NULL, 14, '2020-06-29 06:47:05', '2020-06-29 06:47:05'),
(17, 'ماك', 'mac', NULL, NULL, NULL, 16, '2020-06-30 05:29:11', '2020-06-30 05:29:11'),
(18, 'ويندوز', 'windows', NULL, NULL, NULL, 16, '2020-06-30 05:30:06', '2020-06-30 05:30:06'),
(19, 'أحذية وجوارب', 'Shoes And Socks', NULL, NULL, NULL, NULL, '2020-07-08 07:46:09', '2020-07-08 07:46:09'),
(20, 'كهربائيات', 'Electronics', NULL, NULL, 'Electronics', NULL, '2025-03-30 04:07:01', '2025-03-30 04:07:01'),
(21, 'ملحقات اللابتوب', 'Laptop tools', NULL, NULL, NULL, 16, '2025-03-30 04:09:18', '2025-03-30 04:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `size` varchar(191) NOT NULL,
  `file` varchar(191) NOT NULL,
  `path` varchar(191) NOT NULL,
  `full_file` varchar(191) NOT NULL,
  `mime_type` varchar(191) NOT NULL,
  `file_type` varchar(191) NOT NULL,
  `relation_id` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `size`, `file`, `path`, `full_file`, `mime_type`, `file_type`, `relation_id`, `created_at`, `updated_at`) VALUES
(34, '61OtPEAjFVL._AC_SX466_.jpg', '18310', 'sLr8nnjABiwLLQj97p5zMyxQs8b1pvJwntKqFP4s.jpg', 'products/44', 'products/44/sLr8nnjABiwLLQj97p5zMyxQs8b1pvJwntKqFP4s.jpg', 'image/jpeg', 'product', '44', '2025-03-30 05:40:19', '2025-03-30 05:40:19'),
(35, '71hHGSrKQJL._AC_SX466_.jpg', '19649', 'XzMkiTi5UrHq1z6YyF1fxrcOZTnwma0AK4Z2gxr8.jpg', 'products/44', 'products/44/XzMkiTi5UrHq1z6YyF1fxrcOZTnwma0AK4Z2gxr8.jpg', 'image/jpeg', 'product', '44', '2025-03-30 05:41:32', '2025-03-30 05:41:32'),
(36, 'envato-market-account.png', '80384', 'ULlfOiyZ1mnTIyJOfPxUmcJRiWkSJdtFCJCT2QYs.png', 'products/45', 'products/45/ULlfOiyZ1mnTIyJOfPxUmcJRiWkSJdtFCJCT2QYs.png', 'image/png', 'product', '45', '2025-03-31 02:30:00', '2025-03-31 02:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `home_banners`
--

CREATE TABLE `home_banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_ar` varchar(191) DEFAULT NULL,
  `title_en` varchar(191) DEFAULT NULL,
  `content_ar` text DEFAULT NULL,
  `content_en` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_banners`
--

INSERT INTO `home_banners` (`id`, `title_ar`, `title_en`, `content_ar`, `content_en`, `image`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, 'home-banners/NnFDJLEzm0JKloBNfrPX6jODjh6m7ShZj8GGrPeX.png', '2025-03-28 03:06:27', '2025-03-28 03:06:50'),
(2, NULL, NULL, NULL, NULL, 'home-banners/ZN95HnVRU0rZaThhHUjrjDunK4aZAkNOUOJz44uW.jpg', '2025-03-28 03:07:08', '2025-03-28 03:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(10) UNSIGNED NOT NULL,
  `link_name_en` varchar(191) NOT NULL,
  `link_name_ar` varchar(191) NOT NULL,
  `link_content_en` text DEFAULT NULL,
  `link_content_ar` text DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `parent` varchar(191) NOT NULL DEFAULT '0',
  `hasLink` tinyint(1) NOT NULL DEFAULT 0,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `link_name_en`, `link_name_ar`, `link_content_en`, `link_content_ar`, `url`, `parent`, `hasLink`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 'about us', 'حولنا', '<p>An E-commerce site for the sale of various products of different colors, quality and various sections&nbsp;</p>', '<p>موقع للتجارة الإلكترونية لبيع المنتجات المتنوعة بألوانها المختلفة وجودتها وأقسامها المتنوعة&nbsp;</p>', NULL, '0', 0, 1, '2025-03-29 11:27:23', '2025-03-29 15:46:44'),
(2, 'Follow Us', 'تابعنا', '<p>Let us be social</p>', '<p>لنكن اجتماعيين</p>', NULL, '0', 0, 1, '2025-03-29 11:29:12', '2025-03-29 15:46:10'),
(3, 'Facebook', 'الفيس بوك', '<i class=\"fa fa-facebook\"></i>', '<i class=\"fa fa-facebook\"></i>', 'https://facebook.com', '2', 1, 1, '2025-03-29 15:34:53', '2025-03-29 15:45:33'),
(4, 'Twitter', 'تويتر', '<i class=\"fa fa-twitter\"></i>', '<i class=\"fa fa-twitter\"></i>', 'https://twitter.com', '2', 1, 1, '2025-03-29 15:47:46', '2025-03-29 15:47:46'),
(5, 'Youtube', 'يوتيوب', '<i class=\"fa fa-youtube\"></i>', '<i class=\"fa fa-youtube\"></i>', 'https://youtube.com', '2', 1, 1, '2025-03-29 15:48:41', '2025-03-29 15:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `malls`
--

CREATE TABLE `malls` (
  `id` int(10) UNSIGNED NOT NULL,
  `malls_name_ar` varchar(191) NOT NULL,
  `malls_name_en` varchar(191) NOT NULL,
  `facebook` varchar(191) DEFAULT NULL,
  `twitter` varchar(191) DEFAULT NULL,
  `website` varchar(191) DEFAULT NULL,
  `contact_name` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `lat` varchar(191) DEFAULT NULL,
  `lag` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `malls`
--

INSERT INTO `malls` (`id`, `malls_name_ar`, `malls_name_en`, `facebook`, `twitter`, `website`, `contact_name`, `address`, `mobile`, `email`, `lat`, `lag`, `image`, `country_id`, `created_at`, `updated_at`) VALUES
(2, 'مزة مول', 'Maza Mall', NULL, NULL, NULL, 'Talal Danoon', 'Syria, damascus', '31655689894984', 'tald2905@gmail.com', '-34.397', NULL, NULL, 2, '2020-06-30 07:58:35', '2020-06-30 07:58:35'),
(3, 'راشيد مول', 'Rashed Mall', NULL, NULL, NULL, 'Talal Danoon', NULL, '90802938492823', 'tald2905@gmail.com', '-34.397', NULL, NULL, 3, '2020-06-30 07:59:26', '2020-06-30 07:59:26'),
(4, 'US Mall', 'US Mall', NULL, NULL, NULL, 'Talal', NULL, '+1684864535', 'talal@gmail.com', '-34.397', NULL, NULL, 4, '2025-03-29 16:45:27', '2025-03-29 16:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `mall_products`
--

CREATE TABLE `mall_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `mall_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mall_products`
--

INSERT INTO `mall_products` (`id`, `product_id`, `mall_id`, `created_at`, `updated_at`) VALUES
(16, 38, 3, '2020-07-09 05:19:00', '2020-07-09 05:19:00'),
(17, 39, 3, '2020-07-19 05:06:26', '2020-07-19 05:06:26'),
(23, 40, 4, '2025-03-29 16:54:50', '2025-03-29 16:54:50'),
(26, 41, 4, '2025-03-29 17:22:42', '2025-03-29 17:22:42'),
(32, 42, 4, '2025-03-29 17:28:06', '2025-03-29 17:28:06'),
(33, 43, 4, '2025-03-30 01:56:24', '2025-03-30 01:56:24'),
(38, 44, 4, '2025-03-30 05:41:37', '2025-03-30 05:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `manufactories`
--

CREATE TABLE `manufactories` (
  `id` int(10) UNSIGNED NOT NULL,
  `manufactories_name_ar` varchar(191) NOT NULL,
  `manufactories_name_en` varchar(191) NOT NULL,
  `facebook` varchar(191) DEFAULT NULL,
  `twitter` varchar(191) DEFAULT NULL,
  `website` varchar(191) DEFAULT NULL,
  `contact_name` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `lat` varchar(191) DEFAULT NULL,
  `lag` varchar(191) DEFAULT NULL,
  `icon` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufactories`
--

INSERT INTO `manufactories` (`id`, `manufactories_name_ar`, `manufactories_name_en`, `facebook`, `twitter`, `website`, `contact_name`, `address`, `mobile`, `email`, `lat`, `lag`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'زارا', 'zara', NULL, NULL, NULL, 'Talal Danoon', NULL, '90802938492', 'tald2905@gmail.com', '-34.397', NULL, 'manufactories/ksUCA9jqnlxQffgP1X4QFluJ0FnGXkOkhGnJTx0P.jpeg', '2020-06-30 07:15:05', '2020-06-30 07:57:15'),
(2, 'امبراطور', 'Imprator', NULL, NULL, NULL, 'Talal Danoon', NULL, '90802938492', 'tal-d@gmail.com', '-34.397', NULL, NULL, '2020-07-08 07:49:26', '2020-07-08 07:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `parent` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name_en`, `name_ar`, `parent`, `created_at`, `updated_at`) VALUES
(1, 'Footer Menu', 'قائمة الفوتر', 0, '2025-03-29 11:26:35', '2025-03-29 11:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2020_05_24_130458_create_admins_table', 1),
(8, '2020_05_25_151752_create_password_resets_table', 1),
(9, '2020_05_30_082107_create_settings_table', 2),
(10, '2020_05_31_144145_create_files_table', 3),
(13, '2020_06_09_190924_create_countries_table', 4),
(14, '2020_06_11_095640_create_cities_table', 5),
(15, '2020_06_12_162459_create_states_table', 6),
(17, '2020_06_13_073549_create_departements_table', 7),
(18, '2020_06_14_103823_create_trade_marks_table', 8),
(21, '2020_06_14_183607_create_manufactories_table', 9),
(22, '2020_06_15_194515_create_users_table', 10),
(24, '2020_06_15_195347_create_shippings_table', 11),
(27, '2020_06_16_072148_create_malls_table', 12),
(28, '2020_06_16_192421_create_colors_table', 13),
(29, '2020_06_17_064322_create_sizes_table', 14),
(30, '2020_06_20_103145_create_weights_table', 15),
(32, '2020_06_20_183334_create_products_table', 16),
(33, '2020_07_04_162725_create_other_data_table', 17),
(35, '2020_07_05_071343_create_mall_products_table', 18),
(36, '2020_07_08_195925_create_related_products_table', 19),
(37, '2020_07_19_095605_create_orders_table', 20),
(38, '0000_00_00_000000_create_websockets_statistics_entries_table', 21),
(39, '2021_09_28_181217_add_facebook_id_column', 21),
(40, '2022_09_21_084818_create_reviews_table', 21),
(41, '2022_09_30_174329_create_pages_table', 21),
(42, '2022_10_01_164043_create_wishlist_table', 21),
(43, '2022_10_02_184630_create_home_banners_table', 21),
(44, '2022_10_06_064233_create_menu_table', 21),
(45, '2022_10_06_064304_create_links_table', 21),
(46, '2022_10_13_033958_create_visits_table', 21),
(47, '2022_10_13_180731_create_calendar_events_table', 21),
(48, '2022_10_19_044013_create_to_do_table', 21),
(49, '2022_10_24_182843_create_visit_count_daily_table', 21),
(50, '2022_10_30_055740_create_user_password_reset_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `cart` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `cart`, `created_at`, `updated_at`) VALUES
(1, 1, 'O:14:\"App\\Model\\Cart\":3:{s:5:\"items\";a:1:{i:39;a:4:{s:3:\"qty\";i:1;s:5:\"price\";d:25;s:4:\"item\";O:17:\"App\\Model\\Product\":27:{s:11:\"\0*\0fillable\";a:22:{i:0;s:5:\"title\";i:1;s:5:\"photo\";i:2;s:7:\"content\";i:3;s:13:\"department_id\";i:4;s:14:\"manufactory_id\";i:5;s:9:\"weight_id\";i:6;s:7:\"size_id\";i:7;s:8:\"color_id\";i:8;s:11:\"currency_id\";i:9;s:8:\"trade_id\";i:10;s:5:\"price\";i:11;s:5:\"stock\";i:12;s:4:\"size\";i:13;s:11:\"price_offer\";i:14;s:6:\"weight\";i:15;s:8:\"start_at\";i:16;s:6:\"end_at\";i:17;s:14:\"start_offer_at\";i:18;s:12:\"end_offer_at\";i:19;s:10:\"other_data\";i:20;s:6:\"status\";i:21;s:6:\"reason\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:25:{s:2:\"id\";i:39;s:5:\"title\";s:33:\"جورب قطن أخصر قصير\";s:5:\"photo\";s:57:\"products/39/YSrNHPzUeutr0H1QNevesKmwlVb0MxrWRYhMHX7U.jpeg\";s:7:\"content\";s:33:\"جورب قطن أخصر قصير\";s:13:\"department_id\";i:19;s:14:\"manufactory_id\";i:2;s:8:\"color_id\";i:5;s:4:\"size\";s:2:\"2x\";s:7:\"size_id\";i:6;s:11:\"currency_id\";N;s:8:\"trade_id\";i:5;s:5:\"price\";s:5:\"25.00\";s:5:\"stock\";i:3;s:8:\"start_at\";s:10:\"2020-07-07\";s:6:\"end_at\";s:10:\"2020-07-09\";s:14:\"start_offer_at\";s:10:\"2020-07-08\";s:12:\"end_offer_at\";s:10:\"2020-07-09\";s:11:\"price_offer\";s:5:\"10.00\";s:6:\"weight\";s:2:\"50\";s:9:\"weight_id\";i:2;s:10:\"other_data\";s:0:\"\";s:6:\"status\";s:7:\"pending\";s:6:\"reason\";N;s:10:\"created_at\";s:19:\"2020-07-08 10:56:07\";s:10:\"updated_at\";s:19:\"2020-07-19 08:06:26\";}s:11:\"\0*\0original\";a:25:{s:2:\"id\";i:39;s:5:\"title\";s:33:\"جورب قطن أخصر قصير\";s:5:\"photo\";s:57:\"products/39/YSrNHPzUeutr0H1QNevesKmwlVb0MxrWRYhMHX7U.jpeg\";s:7:\"content\";s:33:\"جورب قطن أخصر قصير\";s:13:\"department_id\";i:19;s:14:\"manufactory_id\";i:2;s:8:\"color_id\";i:5;s:4:\"size\";s:2:\"2x\";s:7:\"size_id\";i:6;s:11:\"currency_id\";N;s:8:\"trade_id\";i:5;s:5:\"price\";s:5:\"25.00\";s:5:\"stock\";i:3;s:8:\"start_at\";s:10:\"2020-07-07\";s:6:\"end_at\";s:10:\"2020-07-09\";s:14:\"start_offer_at\";s:10:\"2020-07-08\";s:12:\"end_offer_at\";s:10:\"2020-07-09\";s:11:\"price_offer\";s:5:\"10.00\";s:6:\"weight\";s:2:\"50\";s:9:\"weight_id\";i:2;s:10:\"other_data\";s:0:\"\";s:6:\"status\";s:7:\"pending\";s:6:\"reason\";N;s:10:\"created_at\";s:19:\"2020-07-08 10:56:07\";s:10:\"updated_at\";s:19:\"2020-07-19 08:06:26\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:5:\"photo\";s:57:\"products/39/YSrNHPzUeutr0H1QNevesKmwlVb0MxrWRYhMHX7U.jpeg\";}}s:8:\"totalQty\";i:1;s:10:\"totalPrice\";d:25;}', '2020-07-19 07:06:01', '2020-07-19 07:06:01'),
(2, 1, 'O:14:\"App\\Model\\Cart\":3:{s:5:\"items\";a:1:{i:38;a:5:{s:2:\"id\";i:38;s:3:\"qty\";i:1;s:5:\"price\";s:5:\"23.00\";s:4:\"item\";O:17:\"App\\Model\\Product\":27:{s:11:\"\0*\0fillable\";a:22:{i:0;s:5:\"title\";i:1;s:5:\"photo\";i:2;s:7:\"content\";i:3;s:13:\"department_id\";i:4;s:14:\"manufactory_id\";i:5;s:9:\"weight_id\";i:6;s:7:\"size_id\";i:7;s:8:\"color_id\";i:8;s:11:\"currency_id\";i:9;s:8:\"trade_id\";i:10;s:5:\"price\";i:11;s:5:\"stock\";i:12;s:4:\"size\";i:13;s:11:\"price_offer\";i:14;s:6:\"weight\";i:15;s:8:\"start_at\";i:16;s:6:\"end_at\";i:17;s:14:\"start_offer_at\";i:18;s:12:\"end_offer_at\";i:19;s:10:\"other_data\";i:20;s:6:\"status\";i:21;s:6:\"reason\";}s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:25:{s:2:\"id\";i:38;s:5:\"title\";s:33:\"جورب قطن أسود قصير\";s:5:\"photo\";s:57:\"products/38/z86NsdXTLOmGnGVSddWdUYoSgj7PlOf0Xvl2hB0j.jpeg\";s:7:\"content\";s:33:\"جورب قطن أسود قصير\";s:13:\"department_id\";i:19;s:14:\"manufactory_id\";i:2;s:8:\"color_id\";i:6;s:4:\"size\";s:2:\"1x\";s:7:\"size_id\";i:6;s:11:\"currency_id\";N;s:8:\"trade_id\";i:5;s:5:\"price\";s:5:\"23.00\";s:5:\"stock\";i:3;s:8:\"start_at\";s:10:\"2020-07-07\";s:6:\"end_at\";s:10:\"2020-07-09\";s:14:\"start_offer_at\";s:10:\"2020-07-08\";s:12:\"end_offer_at\";s:10:\"2020-07-09\";s:11:\"price_offer\";s:5:\"12.00\";s:6:\"weight\";s:2:\"50\";s:9:\"weight_id\";i:2;s:10:\"other_data\";s:0:\"\";s:6:\"status\";s:7:\"pending\";s:6:\"reason\";N;s:10:\"created_at\";s:19:\"2020-07-08 10:51:16\";s:10:\"updated_at\";s:19:\"2020-07-08 10:58:51\";}s:11:\"\0*\0original\";a:25:{s:2:\"id\";i:38;s:5:\"title\";s:33:\"جورب قطن أسود قصير\";s:5:\"photo\";s:57:\"products/38/z86NsdXTLOmGnGVSddWdUYoSgj7PlOf0Xvl2hB0j.jpeg\";s:7:\"content\";s:33:\"جورب قطن أسود قصير\";s:13:\"department_id\";i:19;s:14:\"manufactory_id\";i:2;s:8:\"color_id\";i:6;s:4:\"size\";s:2:\"1x\";s:7:\"size_id\";i:6;s:11:\"currency_id\";N;s:8:\"trade_id\";i:5;s:5:\"price\";s:5:\"23.00\";s:5:\"stock\";i:3;s:8:\"start_at\";s:10:\"2020-07-07\";s:6:\"end_at\";s:10:\"2020-07-09\";s:14:\"start_offer_at\";s:10:\"2020-07-08\";s:12:\"end_offer_at\";s:10:\"2020-07-09\";s:11:\"price_offer\";s:5:\"12.00\";s:6:\"weight\";s:2:\"50\";s:9:\"weight_id\";i:2;s:10:\"other_data\";s:0:\"\";s:6:\"status\";s:7:\"pending\";s:6:\"reason\";N;s:10:\"created_at\";s:19:\"2020-07-08 10:51:16\";s:10:\"updated_at\";s:19:\"2020-07-08 10:58:51\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:5:\"photo\";s:57:\"products/38/z86NsdXTLOmGnGVSddWdUYoSgj7PlOf0Xvl2hB0j.jpeg\";}}s:8:\"totalQty\";i:1;s:10:\"totalPrice\";d:23;}', '2020-07-21 07:13:38', '2020-07-21 07:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `other_data`
--

CREATE TABLE `other_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `data_key_en` varchar(191) DEFAULT NULL,
  `data_key_ar` varchar(191) DEFAULT NULL,
  `data_value` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_data`
--

INSERT INTO `other_data` (`id`, `product_id`, `data_key_en`, `data_key_ar`, `data_value`, `created_at`, `updated_at`) VALUES
(21, 38, NULL, NULL, '', '2020-07-09 05:19:01', '2020-07-09 05:19:01'),
(22, 39, NULL, NULL, '', '2020-07-19 05:06:26', '2020-07-19 05:06:26'),
(48, 42, NULL, NULL, '', '2025-03-30 04:10:51', '2025-03-30 04:10:51'),
(60, 40, 'building area', 'building area', '3', '2025-03-30 06:03:45', '2025-03-30 06:03:45'),
(79, 43, NULL, NULL, '', '2025-03-31 02:09:11', '2025-03-31 02:09:11'),
(84, 44, 'Product Dimensions', 'ابعاد المنتج', '9.9\"D x 13.1\"W x 12.7\"H', '2025-04-02 01:26:02', '2025-04-02 01:26:02'),
(85, 44, 'Special Feature', 'ميزة خاصة', 'Removable Tank, Programmable, Water Filter', '2025-04-02 01:26:02', '2025-04-02 01:26:02'),
(88, 41, 'Screen Resolution', 'دقة الشاشة', '2560 x 1440 pixels', '2025-04-03 18:12:31', '2025-04-03 18:12:31'),
(89, 41, 'Processor', 'المعالج', '‎4 GHz core_i9', '2025-04-03 18:12:31', '2025-04-03 18:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_en` varchar(191) NOT NULL,
  `name_ar` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `title_en` varchar(191) NOT NULL,
  `title_ar` varchar(191) NOT NULL,
  `content_en` text NOT NULL,
  `content_ar` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name_en`, `name_ar`, `slug`, `title_en`, `title_ar`, `content_en`, `content_ar`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'حولنا', 'about-us', 'About Us', 'حولنا', '<p>Welcome to Talal Ecommerce, your one-stop destination for [fashion, electronics, home essentials, and others]. We are passionate about bringing you high-quality products at unbeatable prices, ensuring you have a seamless shopping experience from start to finish.</p>\r\n\r\n<p><strong>Who We Are</strong></p>\r\n\r\n<p>Founded in 2024, Talal Ecommerce was created with a simple mission: to provide top-quality products with exceptional customer service. We believe that shopping should be fun, easy, and affordable, which is why we offer a wide selection of carefully curated items to meet your needs.</p>\r\n\r\n<p><strong>Why Choose Us?</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Premium Quality</strong>: We source our products from trusted suppliers to ensure superior quality.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Affordable Prices</strong>: Get the best value for your money with our competitive pricing.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Fast &amp; Secure Shipping</strong>: Enjoy quick deliveries and safe payment options for a worry-free shopping experience.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Customer Satisfaction</strong>: Our support team is here to assist you with any questions or concerns.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p><strong>Our Commitment</strong></p>\r\n\r\n<p>At Talal Ecommerce, we strive to provide an outstanding shopping experience by continuously improving our products and services. Your satisfaction is our top priority, and we work hard to exceed your expectations every time you shop with us.</p>\r\n\r\n<p>Thank you for choosing Talal Ecommerce. We look forward to serving you!</p>', '<p><strong>مرحبًا بكم في Talal Ecommerce</strong></p>\r\n\r\n<p>مرحبًا بكم في Talal Ecommerce، وجهتكم الشاملة لكل ما تحتاجونه من [الأزياء، الإلكترونيات، المستلزمات المنزلية، وغيرها]. نحن متحمسون لتقديم منتجات عالية الجودة بأسعار لا تُضاهى، لضمان حصولكم على تجربة تسوق سلسة من البداية إلى النهاية.</p>\r\n\r\n<p><strong>من نحن</strong></p>\r\n\r\n<p>تأسست Talal Ecommerce في عام 2024 برؤية واضحة: تقديم منتجات عالية الجودة مع خدمة عملاء استثنائية. نحن نؤمن بأن التسوق يجب أن يكون ممتعًا وسهلًا وميسور التكلفة، ولهذا نقدم مجموعة واسعة من المنتجات المختارة بعناية لتلبية احتياجاتكم.</p>\r\n\r\n<p><strong>لماذا تختاروننا؟</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>جودة ممتازة</strong>: نقوم بتوريد منتجاتنا من موردين موثوق بهم لضمان أفضل جودة.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>أسعار معقولة</strong>: احصلوا على أفضل قيمة مقابل أموالكم من خلال أسعارنا التنافسية.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>شحن سريع وآمن</strong>: استمتعوا بتوصيل سريع وخيارات دفع آمنة لضمان تجربة تسوق خالية من القلق.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>رضا العملاء</strong>: فريق الدعم لدينا هنا لمساعدتكم في أي استفسارات أو مخاوف.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p><strong>التزامنا</strong></p>\r\n\r\n<p>في Talal Ecommerce، نسعى جاهدين لتوفير تجربة تسوق استثنائية من خلال التحسين المستمر لمنتجاتنا وخدماتنا. رضاكم هو أولويتنا القصوى، ونعمل بجد لتجاوز توقعاتكم في كل مرة تتسوقون معنا.</p>\r\n\r\n<p>شكرًا لاختياركم Talal Ecommerce. نحن نتطلع لخدمتكم!</p>', '2025-03-30 18:20:28', '2025-03-30 18:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_en` varchar(191) DEFAULT NULL,
  `title_ar` varchar(191) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `content_en` longtext DEFAULT NULL,
  `content_ar` longtext DEFAULT NULL,
  `department_id` int(10) UNSIGNED DEFAULT NULL,
  `manufactory_id` int(10) UNSIGNED DEFAULT NULL,
  `color_id` int(10) UNSIGNED DEFAULT NULL,
  `size` varchar(191) DEFAULT NULL,
  `size_id` int(10) UNSIGNED DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT NULL,
  `trade_id` int(10) UNSIGNED DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `start_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `start_offer_at` date DEFAULT NULL,
  `end_offer_at` date DEFAULT NULL,
  `price_offer` int(11) DEFAULT NULL,
  `weight` varchar(191) DEFAULT NULL,
  `weight_id` int(10) UNSIGNED DEFAULT NULL,
  `other_data` longtext DEFAULT NULL,
  `status` enum('pending','refused','active') NOT NULL DEFAULT 'pending',
  `is_hot` tinyint(1) NOT NULL DEFAULT 0,
  `reason` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title_en`, `title_ar`, `photo`, `content_en`, `content_ar`, `department_id`, `manufactory_id`, `color_id`, `size`, `size_id`, `currency_id`, `trade_id`, `price`, `stock`, `start_at`, `end_at`, `start_offer_at`, `end_offer_at`, `price_offer`, `weight`, `weight_id`, `other_data`, `status`, `is_hot`, `reason`, `created_at`, `updated_at`) VALUES
(38, 'جورب قطن أسود قصير', 'جورب قطن أسود قصير', 'products/38/PNoxVTHzZ0sEgkHMzzcHLcWllLbFB5XOsdgnhNkB.jpg', 'جورب قطن أسود قصير', 'جورب قطن أسود قصير', 19, 2, 6, '1x', 6, 4, 5, 23, 3, '2020-07-07', '2020-07-09', '2020-07-08', '2020-07-09', 12, '50', 2, '', 'pending', 0, NULL, '2020-07-08 07:51:16', '2025-03-29 10:54:43'),
(39, 'جورب قطن أخصر قصير', 'جورب قطن أخصر قصير', 'products/39/b20Fr7FX6Y1urnMMR9h3MYJmyhAPRfwSgsY4WmT9.jpg', 'جورب قطن أخصر قصير', 'جورب قطن أخصر قصير', 19, 2, 5, '2x', 6, 4, 5, 25, 3, '2020-07-07', '2020-07-09', '2020-07-08', '2020-07-09', 10, '50', 2, '', 'pending', 0, NULL, '2020-07-08 07:56:07', '2025-03-29 10:57:57'),
(40, 'acrate Gaming Headset for PS5/PS4/Xbox One/Nintendo Switch/PC/Mac, PS5 Headset with Microphone Xbox Headset with LED Lights, Noise Cancelling PS4 Headset for Kids Adults - Blue', 'سماعة رأس أكريت للألعاب لأجهزة PS5/PS4/Xbox One/Xbox One/Nintendo Switch/PC/ماك ، سماعة PS5 مع ميكروفون سماعة رأس Xbox مع أضواء LED، سماعة رأس PS4 مانعة للضوضاء للأطفال البالغين - أزرق', 'products/40/babltCwIf9KLt3qZsXx7qXN9a2CeAB9KdwhI4YOj.jpg', '- MULTI-PLATFORM COMPATIBILITY - Pacrate gaming headset with microphone is compatible with PS4, PS5, PS4 Pro/Slim, PSP, Xbox One, Xbox One X/S, Xbox Series X/S, Nintendo Switch, PC, Laptop, iPad and most other devices with 3.5mm audio jack.\r\n- STEREO SURROUND SOUND QUALITY - Pacrate xbox headset are equipped with 40mm high density dual neodymium audio drivers, providing stunning audio \r\n- ADJUSTABLE NOISE CANCELING MICROPHONE - Pacrate ps4 headset have a highly sensitive\r\n- OPTIMIZED FOR CONVENIENT COMFORT - An adjustable steel slider and good breathable protein ear cushions provide comfort for those long nights of gaming.', '- التوافق مع منصات متعددة - تتوافق سماعة الألعاب المزودة بميكروفون من Pacrate مع PS4 و PS5 و PS4 Pro/Slim و PSP و Xbox One و Xbox One X/S و Xbox X/S و Xbox Series X/S و Nintendo Switch والكمبيوتر الشخصي والكمبيوتر المحمول والكمبيوتر المحمول و iPad ومعظم الأجهزة الأخرى المزودة بمقبس صوت 3.5 مم.\r\n- جودة صوت ستيريو ستيريو - تم تجهيز سماعة الرأس Pacrate xbox بمشغلات صوت نيوديميوم مزدوجة عالية الكثافة 40 مم، مما يوفر صوتًا مذهلاً \r\n- ميكروفون مانع للضوضاء قابل للتعديل - سماعة رأس باكرات ps4 مزودة بميكروفون حساس للغاية\r\n- مُحسّنة للراحة المريحة - شريط تمرير فولاذي قابل للتعديل ووسائد أذن بروتينية جيدة التهوية توفر الراحة لتلك الليالي الطويلة من اللعب.', 21, 1, 4, NULL, NULL, 4, 6, 200, 500, '2025-03-25', '2025-04-25', '2025-03-28', '2025-04-10', 150, NULL, NULL, '', 'active', 1, NULL, '2025-03-29 16:17:51', '2025-03-30 04:09:37'),
(41, 'ASUS ROG Strix G16 Gaming Laptop, 16” Nebula Display 16:10 QHD 240Hz, GeForce RTX 4060, Intel® Core™ i9-14900HX, 16GB DDR5-5600, 1TB PCIe SSD, Wi-Fi 6E, Windows 11, G614JVR-ES94', 'كمبيوتر محمول للألعاب ASUS ROG ROG Strix G16، شاشة نيبيولا مقاس 16:10 بدقة 16:10 QHD 240 هرتز، GeForce RTX 4060، Intel® Core™ i9-14900HX، 16GB DDR5-5600،', 'products/41/WGKWe8hvCPwxFkEEwUdbUGINfwSGTDwIDEbUVEIP.jpg', 'POWER UP YOUR PLAY - Win more games with Windows 11, a 14th Gen Intel Core i9-14900HX processor, and an NVIDIA GeForce RTX 4060 Laptop GPU at 140W Max TGP.\r\nBLAZING FAST MEMORY AND STORAGE – Multitask swiftly with 16GB of DDR5-5600MHz memory and 1TB of PCIe 4x4.\r\nROG INTELLIGENT COOLING – The Strix G16 features Thermal Grizzly’s Conductonaut Extreme liquid metal on the CPU, and a third intake fan among other premium features, to allow for sustained performance over long gaming sessions.\r\nROG NEBULA DISPLAY – The Nebula standard guarantees a premium display with high specs for the best visuals. Featuring QHD 240Hz/3ms, 100% DCI-P3, Pantone Validation, among other premium features on the Strix G16.', 'عزِّز لعبك - اربح المزيد من الألعاب مع نظام التشغيل Windows 11، ومعالج Intel Core i9-14900HX من الجيل الرابع عشر، ووحدة معالجة رسومات NVIDIA GeForce RTX 4060 للكمبيوتر المحمول بقدرة 140 وات كحد أقصى.\r\nذاكرة وتخزين فائق السرعة - يمكنك القيام بمهام متعددة بسرعة فائقة مع ذاكرة DDR5-5600 ميجاهرتز سعة 16 جيجابايت وذاكرة PCIe 4x4 سعة 1 تيرابايت.\r\nتبريد ذكي من ROG - يتميز Strix G16 بمعدن سائل من طراز Thermal Grizzly\'s Conductonaut Extreme على وحدة المعالجة المركزية، ومروحة سحب ثالثة من بين ميزات أخرى متميزة، للسماح بأداء مستدام على مدار جلسات اللعب الطويلة.\r\nشاشة ROG NEBULA DISPLAY - يضمن معيار Nebula شاشة متميزة بمواصفات عالية للحصول على أفضل المرئيات. تتميز الشاشة بدقة QHD 240 هرتز / 3 مللي ثانية، و100% DCI-P3، والتحقق من صحة Pantone، من بين ميزات أخرى متميزة في Strix G16.', 18, 2, 6, '16', 3, 4, 7, 700, 500, NULL, NULL, NULL, NULL, NULL, '2.4', 1, '', 'active', 0, NULL, '2025-03-29 17:10:23', '2025-04-03 18:12:31'),
(42, '0Series X – Halo Infinite Limited Edition Console Bundle (Renewed)', '0Series X - حزمة وحدة التحكم ذات الإصدار المحدود Halo Infinite (مجددة)', 'products/42/m0cfqOzcaSqHGcFxgO2L6vfiZ8RZNJRhZqi0JZN5.jpg', '0Series X – Halo Infinite Limited Edition Console Bundle (Renewed)', '0Series X – Halo Infinite Limited Edition Console Bundle (Renewed)', 20, 1, 6, NULL, NULL, 4, 8, 999, 500, '2025-03-25', '2025-04-30', NULL, NULL, NULL, NULL, NULL, '', 'active', 0, NULL, '2025-03-29 17:25:19', '2025-03-30 04:10:51'),
(43, 'PlayStation 5 Console (PS5)', 'وحدة تحكم PlayStation 5 (PS5)', 'products/43/xNOKHQSyVBA1HKgWSnauY3S6ct6eAHkEvKBIQ84k.jpg', '- Model Number CFI-1215A01X.\r\n- Stunning Games - Marvel at incredible graphics and experience new PS5 features.\r\n- Breathtaking Immersion - Discover a deeper gaming experience with support for haptic feedback, adaptive triggers, and 3D Audio technology.\r\n- Lightning Speed - Harness the power of a custom CPU, GPU, and SSD with Integrated I/O that rewrite the rules of what a PlayStation console can do.', '- رقم الموديل CFI-1215A01X.\r\n- ألعاب مذهلة - استمتع بالرسومات المذهلة واختبر ميزات PS5 الجديدة.\r\n- الانغماس المذهل - اكتشف تجربة لعب أعمق مع دعم ردود الفعل اللمسية والمحفزات التكيفية وتقنية الصوت ثلاثي الأبعاد.\r\n- سرعة البرق - استفد من قوة وحدة المعالجة المركزية المخصصة ووحدة معالجة الرسومات ووحدة معالجة الرسومات ومحرك أقراص الحالة الصلبة مع الإدخال/الإخراج المدمج الذي يعيد كتابة قواعد ما يمكن لوحدة تحكم PlayStation القيام به.', 20, 1, 7, NULL, NULL, 4, 9, 300, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'pending', 0, NULL, '2025-03-30 01:54:09', '2025-03-31 02:09:11'),
(44, 'Keurig K-Elite Single Serve K-Cup Pod Coffee Maker, with Strength and Temperature Control, Iced Coffee Capability, 8 to 12oz Brew Size, Programmable, Brushed Slate', 'ماكينة صنع القهوة Keurig K-Elite أحادية الخدمة K-Cup ، مع التحكم في القوة ودرجة الحرارة ، والقدرة على القهوة المثلجة ، وحجم التخمير من 8 إلى 12 أونصة ، قابلة للبرمجة ، لائحة مصقولة', 'products/44/KRVBVzRICJN1djPNlPhZ8Au1dScXHKddutlBYF7y.jpg', '- WHAT\'S IN THE BOX: One water filter handle, and one filter to help ensure your beverages taste their absolute best.Filter type:Reusable.Temperature: Adjust the brew temperature between 187° and 192°..Temperature Control : Allows you to adjust the temperature from 187° – 192\r\n- BREWS MULTIPLE CUP SIZES: 4, 6, 8, 10, 12oz Enjoy the most popular cup sizes.\r\n- STRONG BREW BUTTON: Increases the strength and bold taste of your coffee’s flavor.\r\n- ICED SETTING: Brew hot over ice at the touch of a button for full-flavored, delicious iced coffee.\r\n- HOT WATER ON DEMAND BUTTON: Perfect for instant soups or oatmeal.\r\n- FAST & FRESH BREWED: Coffee made in minutes.', '- ما هو في الصندوق: مقبض فلتر المياه وفلتر يساعد في ضمان أن مشروباتك تتذوق أفضل مذاق لها. نوع الفلتر: قابل لإعادة الاستخدام. درجة الحرارة: ضبط درجة حرارة التحضير بين 187° و192°. التحكم في درجة الحرارة: يسمح لك بضبط درجة الحرارة من 187° – 192- إعدادات حجم الكوب المتعددة: 4، 6، 8، 10، 12 أونصة. استمتع بأكثر أحجام الأكواب شعبية.- زر التحضير القوي: زيادة قوة وطعم قهوتك.- الإعداد المثلج: تحضير ساخن فوق الثلج بضغطة زر للحصول على قهوة مثلجة لذيذة ومليئة بالنكهة.- زر الماء الساخن عند الطلب: مثالي للحساء السريع أو دقيق الشوفان.- تحضير سريع وطازج: قهوة تُحضّر في دقائق.', 20, 2, 9, NULL, NULL, 4, 10, 150, 500, NULL, NULL, '2025-04-01', '2025-05-21', NULL, '6.6', 3, '', 'active', 1, NULL, '2025-03-30 05:27:41', '2025-04-02 01:26:02'),
(45, '', '', 'products/45/qVtQJOjmhEgyjNvBeiex8dMdMbyInG5atGvoTSdr.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 0, NULL, '2025-03-31 02:17:14', '2025-03-31 02:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `related_products`
--

CREATE TABLE `related_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `relation_product` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `related_products`
--

INSERT INTO `related_products` (`id`, `product_id`, `relation_product`, `created_at`, `updated_at`) VALUES
(1, 38, 39, '2020-07-09 05:19:01', '2020-07-09 05:19:01'),
(3, 40, 41, '2025-03-30 06:03:45', '2025-03-30 06:03:45'),
(32, 41, 40, '2025-04-03 18:12:31', '2025-04-03 18:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `reviewer_name` varchar(191) NOT NULL,
  `review_text` varchar(191) NOT NULL,
  `review` int(11) NOT NULL,
  `isApprove` tinyint(1) NOT NULL DEFAULT 0,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `reviewer_name`, `review_text`, `review`, `isApprove`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'Talal', 'amazing', 5, 1, 41, '2025-03-30 12:47:30', '2025-03-30 12:51:55'),
(2, 'Ahmad', 'wooow, it\'s so fast and it has various products to biuy', 4, 1, 41, '2025-03-30 12:48:27', '2025-03-30 12:51:53'),
(3, 'Rami', 'I love it so much', 5, 1, 41, '2025-03-30 12:52:15', '2025-03-30 12:52:57'),
(4, 'Yara', 'thanks to you for this amazing site', 4, 1, 41, '2025-03-30 12:52:48', '2025-03-30 12:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `sitename_ar` varchar(191) DEFAULT NULL,
  `sitename_en` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `icon` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `default_lang` varchar(191) NOT NULL DEFAULT 'ar',
  `description` longtext DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `menu_control` enum('show','hide') NOT NULL DEFAULT 'hide',
  `status` enum('open','close') NOT NULL DEFAULT 'open',
  `message_maintenance` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sitename_ar`, `sitename_en`, `logo`, `icon`, `email`, `default_lang`, `description`, `keywords`, `menu_control`, `status`, `message_maintenance`, `created_at`, `updated_at`) VALUES
(2, 'تجارة الكترونية', 'Ecommerce', 'settings/ON12q0hnUzHL13ujsp3jk7S7lE8IFVehIs87Q2ii.png', 'settings/MiT7SkLzGehdKQTj7aGVjetJCW2wOUaNF2HysXBe.png', 'talal.danoun@gmail.com', 'ar', NULL, 'Ecommerce, Products', 'show', 'open', 'The site is currently under maintenance', NULL, '2025-04-02 01:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` int(10) UNSIGNED NOT NULL,
  `shippings_name_ar` varchar(191) NOT NULL,
  `shippings_name_en` varchar(191) NOT NULL,
  `lat` varchar(191) DEFAULT NULL,
  `lng` varchar(191) DEFAULT NULL,
  `icon` varchar(191) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `shippings_name_ar`, `shippings_name_en`, `lat`, `lng`, `icon`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'الدنون', 'Al-Danoon', '-34.397', NULL, 'shippings/REbqayzj2dRsCPp80DpvMVyD7EmfS74lIYbEeug6.png', 4, '2020-06-15 17:14:59', '2020-06-16 03:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `sizes_name_ar` varchar(191) NOT NULL,
  `sizes_name_en` varchar(191) NOT NULL,
  `department_id` int(10) UNSIGNED DEFAULT NULL,
  `is_public` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `sizes_name_ar`, `sizes_name_en`, `department_id`, `is_public`, `created_at`, `updated_at`) VALUES
(3, 'بوصة', 'inches', 14, 'yes', '2020-06-29 06:48:58', '2020-06-30 05:36:53'),
(4, 'ميلي متر', 'mm', 18, 'no', '2020-06-30 05:36:11', '2020-06-30 05:36:11'),
(5, 'سانتي متر', 'SM', 16, 'yes', '2020-06-30 05:38:16', '2020-06-30 05:38:16'),
(6, 'رجالي  X', 'Men X', 19, 'yes', '2020-07-08 07:50:30', '2020-07-08 07:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `states_name_ar` varchar(191) NOT NULL,
  `states_name_en` varchar(191) NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `states_name_ar`, `states_name_en`, `country_id`, `city_id`, `created_at`, `updated_at`) VALUES
(3, 'المزة', 'Maze', 2, 4, '2020-06-13 03:51:53', '2020-06-13 03:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `to_do`
--

CREATE TABLE `to_do` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_ar` varchar(191) NOT NULL,
  `content_en` varchar(191) NOT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `isDone` tinyint(1) NOT NULL DEFAULT 0,
  `deadline` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `to_do`
--

INSERT INTO `to_do` (`id`, `content_ar`, `content_en`, `description_ar`, `description_en`, `isDone`, `deadline`, `created_at`, `updated_at`) VALUES
(1, 'صفحة العمليات الحسابية', 'financial transactions page', 'انشاء صفحة تعرض جميع العمليات الحسابية للموقع من بيع وشراء', 'Create a page that displays all the financial transactions of the site, including sales and purchases.', 0, '2025-04-09 21:00:00', '2025-04-01 13:25:26', '2025-04-01 13:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `trade_marks`
--

CREATE TABLE `trade_marks` (
  `id` int(10) UNSIGNED NOT NULL,
  `trademarks_name_ar` varchar(191) NOT NULL,
  `trademarks_name_en` varchar(191) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trade_marks`
--

INSERT INTO `trade_marks` (`id`, `trademarks_name_ar`, `trademarks_name_en`, `logo`, `created_at`, `updated_at`) VALUES
(3, 'سامسونغ', 'Samsung', 'trademarks/bbOn4EvMnMPlv3fUmwN4FlorKdfL8jVvOFnfj5CR.jpg', '2020-06-30 07:10:56', '2025-03-29 11:05:29'),
(4, 'أبل', 'Apply', 'trademarks/l3IrsQQyoFmUgTPDtRhcEHT6h13HG9szyDCJD2Pt.png', '2020-06-30 07:11:42', '2025-03-29 11:08:28'),
(5, 'نايك', 'Nike', 'trademarks/PxJpoL8LBUtY2nMdD1749CyvUoJR5rZF0uRG7v47.jpg', '2020-07-08 07:48:42', '2025-03-29 11:10:21'),
(6, 'Pacrate', 'Pacrate', 'trademarks/tkoNf5be4Q1GSPWjKSdOrn5Qv4i3JuOg8cjlKbTF.jpg', '2025-03-29 16:41:02', '2025-03-29 16:41:02'),
(7, 'ASUS', 'ASUS', 'trademarks/UdCeNn0ipco3f7riIxEjRnfFZtSoTljepBST5ev9.png', '2025-03-29 17:09:51', '2025-03-29 17:09:51'),
(8, 'XBOX', 'XBOX', 'trademarks/YYmlvAadXHHqrdSmKH9pdcpEYL8OveYZeIxljw38.jpg', '2025-03-29 17:24:59', '2025-03-29 17:24:59'),
(9, 'PlayStation', 'PlayStation', 'trademarks/Dkigb5H9LpGD7HHpOa4NhzfjRlsjIzDn9eBdPmc3.jpg', '2025-03-30 01:53:03', '2025-03-30 01:53:03'),
(10, 'Keurig', 'Keurig', 'trademarks/rZqcQ2o5lqkw1Y5BWB0zwJUohHydtH2r9spfmEUu.jpg', '2025-03-30 05:37:17', '2025-03-30 05:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `level` enum('user','company','vendor') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `facebook_id` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `level`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `facebook_id`) VALUES
(1, 'talal', 'talal.danoun@gmail.com', 'users/BadWJQYT02aRdtTfaVSuZJPgVXLGxt7rnFGI42ml.png', 'user', NULL, '$2y$10$tbpwf9/6xElWXzt.ee0cc./EXM/edERErbAjKImFTbYiiKiLvQUMG', NULL, '2020-06-15 17:01:14', '2025-03-30 18:40:59', NULL),
(2, 'Yes-soft', 'yes-soft@gmail.com', NULL, 'company', NULL, '$2y$10$fc3Serlvs4iT.bBQhxSAg.y4KeoR6A10wFaATg9DtEOBlLed4BFL.', NULL, '2020-06-15 17:01:42', '2020-06-15 17:01:42', NULL),
(3, 'market', 'market@live.com', NULL, 'vendor', NULL, '$2y$10$UJV2xcbJM/n2Q3LkqSgxCuYfRmaIA745RMDqndY5Aqbn25jToE6MG', NULL, '2020-06-15 17:02:15', '2020-06-15 17:02:15', NULL),
(4, 'Star', 'star@hotmail.com', NULL, 'company', NULL, '$2y$10$NLTvrtQ8qTbzdsI5d/MDkevx97OSxvOnvAOtlavG.3BHy.RvNldj6', NULL, '2020-06-15 17:02:40', '2020-06-15 17:02:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_password_reset`
--

CREATE TABLE `user_password_reset` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `primary_key` varchar(191) NOT NULL,
  `secondary_key` varchar(191) DEFAULT NULL,
  `score` bigint(20) UNSIGNED NOT NULL,
  `list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`list`)),
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `primary_key`, `secondary_key`, `score`, `list`, `expired_at`, `created_at`, `updated_at`) VALUES
(1, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-29 16:06:20', '2025-03-29 15:51:20', '2025-03-29 15:51:20'),
(2, 'visits:products_visits', NULL, 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(3, 'visits:products_visits_total', NULL, 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(4, 'visits:products_visits_referers:', NULL, 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(5, 'visits:products_visits_day', NULL, 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(6, 'visits:products_visits_day_total', NULL, 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(7, 'visits:products_visits_week', NULL, 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(8, 'visits:products_visits_week_total', NULL, 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(9, 'visits:products_visits_month', NULL, 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(10, 'visits:products_visits_month_total', NULL, 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(11, 'visits:products_visits_year', NULL, 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(12, 'visits:products_visits_year_total', NULL, 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(13, 'visits:products_visits_OSes:', 'Windows', 24, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(14, 'visits:products_visits_languages:', 'en', 35, NULL, NULL, '2025-03-29 15:51:20', '2025-04-03 18:23:27'),
(15, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-30 06:02:58', '2025-03-30 05:47:57', '2025-03-30 05:47:58'),
(16, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-30 12:11:27', '2025-03-30 11:56:27', '2025-03-30 11:56:27'),
(17, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-30 12:32:54', '2025-03-30 12:17:54', '2025-03-30 12:17:54'),
(18, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-30 12:54:59', '2025-03-30 12:39:59', '2025-03-30 12:39:59'),
(19, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-30 18:14:57', '2025-03-30 17:59:57', '2025-03-30 17:59:57'),
(20, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-31 01:04:58', '2025-03-31 00:49:58', '2025-03-31 00:49:58'),
(21, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-31 01:22:09', '2025-03-31 01:07:09', '2025-03-31 01:07:09'),
(22, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-31 02:17:05', '2025-03-31 02:02:05', '2025-03-31 02:02:05'),
(23, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-31 04:43:07', '2025-03-31 04:28:07', '2025-03-31 04:28:07'),
(24, 'visits:products_visits_OSes:', 'AndroidMobile', 11, NULL, NULL, '2025-03-31 04:28:07', '2025-04-03 00:30:24'),
(25, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-31 04:58:15', '2025-03-31 04:43:15', '2025-03-31 04:43:15'),
(26, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-31 05:14:02', '2025-03-31 04:59:01', '2025-03-31 04:59:02'),
(27, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-31 05:29:29', '2025-03-31 05:14:29', '2025-03-31 05:14:29'),
(28, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-31 07:08:21', '2025-03-31 06:53:21', '2025-03-31 06:53:21'),
(29, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-03-31 07:38:08', '2025-03-31 07:23:08', '2025-03-31 07:23:08'),
(30, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-01 00:47:38', '2025-04-01 00:32:38', '2025-04-01 00:32:38'),
(31, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-01 01:08:03', '2025-04-01 00:53:03', '2025-04-01 00:53:03'),
(32, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-01 01:24:42', '2025-04-01 01:09:42', '2025-04-01 01:09:42'),
(33, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-02 15:21:08', '2025-04-02 15:06:08', '2025-04-02 15:06:08'),
(34, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-02 15:37:48', '2025-04-02 15:22:48', '2025-04-02 15:22:48'),
(35, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-02 18:05:59', '2025-04-02 17:50:59', '2025-04-02 17:50:59'),
(36, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 00:45:23', '2025-04-03 00:30:23', '2025-04-03 00:30:23'),
(37, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 01:12:13', '2025-04-03 00:57:13', '2025-04-03 00:57:13'),
(38, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 01:40:31', '2025-04-03 01:25:31', '2025-04-03 01:25:31'),
(39, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 02:06:51', '2025-04-03 01:51:51', '2025-04-03 01:51:51'),
(40, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 12:45:17', '2025-04-03 12:30:17', '2025-04-03 12:30:17'),
(41, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 16:02:09', '2025-04-03 15:47:09', '2025-04-03 15:47:09'),
(42, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 16:25:35', '2025-04-03 16:10:35', '2025-04-03 16:10:35'),
(43, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 16:40:51', '2025-04-03 16:25:51', '2025-04-03 16:25:51'),
(44, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 16:58:21', '2025-04-03 16:43:21', '2025-04-03 16:43:21'),
(45, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 17:21:09', '2025-04-03 17:06:09', '2025-04-03 17:06:09'),
(46, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 17:48:29', '2025-04-03 17:33:29', '2025-04-03 17:33:29'),
(47, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 18:03:57', '2025-04-03 17:48:57', '2025-04-03 17:48:57'),
(48, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 18:19:13', '2025-04-03 18:04:13', '2025-04-03 18:04:13'),
(49, 'visits:products_visits_recorded_ips:::1', NULL, 1, NULL, '2025-04-03 18:38:27', '2025-04-03 18:23:27', '2025-04-03 18:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `visit_count_daily`
--

CREATE TABLE `visit_count_daily` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(191) NOT NULL,
  `score` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `client_ip` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visit_count_daily`
--

INSERT INTO `visit_count_daily` (`id`, `model`, `score`, `date`, `client_ip`, `created_at`, `updated_at`) VALUES
(1, 'ShopProductsController', 1, '2025-03-29', '::1', '2025-03-29 15:51:20', '2025-03-29 15:51:20'),
(2, 'ShopProductsController', 1, '2025-03-30', '::1', '2025-03-30 00:44:00', '2025-03-30 00:44:00'),
(3, 'ShopProductsController', 1, '2025-03-31', '::1', '2025-03-31 00:49:58', '2025-03-31 00:49:58'),
(4, 'ShopProductsController', 1, '2025-04-01', '::1', '2025-04-01 00:32:38', '2025-04-01 00:32:38'),
(5, 'ShopProductsController', 1, '2025-04-02', '::1', '2025-04-02 15:06:08', '2025-04-02 15:06:08'),
(6, 'ShopProductsController', 1, '2025-04-03', '::1', '2025-04-03 00:30:23', '2025-04-03 00:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(191) NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weights`
--

CREATE TABLE `weights` (
  `id` int(10) UNSIGNED NOT NULL,
  `weights_name_ar` varchar(191) NOT NULL,
  `weights_name_en` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weights`
--

INSERT INTO `weights` (`id`, `weights_name_ar`, `weights_name_en`, `created_at`, `updated_at`) VALUES
(1, 'كغ', 'Kg', '2020-06-20 07:55:18', '2020-06-20 07:55:18'),
(2, 'غرام', 'g', '2020-07-08 07:51:10', '2020-07-08 07:51:10'),
(3, 'باوند', 'Bound', '2025-03-30 01:58:13', '2025-03-30 01:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `wishlist` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departements_parent_foreign` (`parent`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_banners`
--
ALTER TABLE `home_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `links_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `malls`
--
ALTER TABLE `malls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `malls_country_id_foreign` (`country_id`);

--
-- Indexes for table `mall_products`
--
ALTER TABLE `mall_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mall_products_product_id_foreign` (`product_id`),
  ADD KEY `mall_products_mall_id_foreign` (`mall_id`);

--
-- Indexes for table `manufactories`
--
ALTER TABLE `manufactories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_data`
--
ALTER TABLE `other_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `other_data_product_id_foreign` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_department_id_foreign` (`department_id`),
  ADD KEY `products_manufactory_id_foreign` (`manufactory_id`),
  ADD KEY `products_color_id_foreign` (`color_id`),
  ADD KEY `products_size_id_foreign` (`size_id`),
  ADD KEY `products_currency_id_foreign` (`currency_id`),
  ADD KEY `products_trade_id_foreign` (`trade_id`),
  ADD KEY `products_weight_id_foreign` (`weight_id`);

--
-- Indexes for table `related_products`
--
ALTER TABLE `related_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_products_product_id_foreign` (`product_id`),
  ADD KEY `related_products_relation_product_foreign` (`relation_product`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_user_id_foreign` (`user_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sizes_department_id_foreign` (`department_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_country_id_foreign` (`country_id`),
  ADD KEY `states_city_id_foreign` (`city_id`);

--
-- Indexes for table `to_do`
--
ALTER TABLE `to_do`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_marks`
--
ALTER TABLE `trade_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_password_reset`
--
ALTER TABLE `user_password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `visits_primary_key_secondary_key_unique` (`primary_key`,`secondary_key`);

--
-- Indexes for table `visit_count_daily`
--
ALTER TABLE `visit_count_daily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weights`
--
ALTER TABLE `weights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `calendar_events`
--
ALTER TABLE `calendar_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `home_banners`
--
ALTER TABLE `home_banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `malls`
--
ALTER TABLE `malls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mall_products`
--
ALTER TABLE `mall_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `manufactories`
--
ALTER TABLE `manufactories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `other_data`
--
ALTER TABLE `other_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `related_products`
--
ALTER TABLE `related_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `to_do`
--
ALTER TABLE `to_do`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trade_marks`
--
ALTER TABLE `trade_marks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_password_reset`
--
ALTER TABLE `user_password_reset`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `visit_count_daily`
--
ALTER TABLE `visit_count_daily`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weights`
--
ALTER TABLE `weights`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `departements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `malls`
--
ALTER TABLE `malls`
  ADD CONSTRAINT `malls_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mall_products`
--
ALTER TABLE `mall_products`
  ADD CONSTRAINT `mall_products_mall_id_foreign` FOREIGN KEY (`mall_id`) REFERENCES `malls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mall_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `other_data`
--
ALTER TABLE `other_data`
  ADD CONSTRAINT `other_data_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `products_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_manufactory_id_foreign` FOREIGN KEY (`manufactory_id`) REFERENCES `manufactories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_trade_id_foreign` FOREIGN KEY (`trade_id`) REFERENCES `trade_marks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_weight_id_foreign` FOREIGN KEY (`weight_id`) REFERENCES `weights` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `related_products`
--
ALTER TABLE `related_products`
  ADD CONSTRAINT `related_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `related_products_relation_product_foreign` FOREIGN KEY (`relation_product`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `sizes_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
