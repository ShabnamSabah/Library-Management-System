-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 08:55 PM
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
-- Database: `laravel_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `name` text NOT NULL,
  `photo` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author` text DEFAULT NULL,
  `donor_id` int(11) DEFAULT 0,
  `rack_id` int(11) NOT NULL DEFAULT 0,
  `volume_no` text DEFAULT NULL,
  `total_volume` text DEFAULT NULL,
  `total_copy` int(11) DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `issue_date`, `name`, `photo`, `category_id`, `author`, `donor_id`, `rack_id`, `volume_no`, `total_volume`, `total_copy`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2025-07-31', 'Handbook on Offences and Punishments', 'backend_assets/images/books/1.jpg', 1, 'M. A. Rashid', NULL, 6, '1', '1-3', 8, 1, '2025-03-17 13:39:08', '2025-07-31 00:40:07'),
(2, '2025-07-31', 'Business Law I Essentials', 'backend_assets/images/books/2.jpg', 3, 'Renee De Assis', NULL, 7, '1', '2', 6, 1, '2025-03-17 13:46:16', '2025-07-31 00:40:34'),
(3, '2025-07-31', 'Handbook on Offenses and Punishment -2nd Ed', 'backend_assets/images/books/3.jpg', 1, 'M. A. Rashid', NULL, 6, '1-3', '1', 1, 1, '2025-03-17 13:47:00', '2025-07-31 00:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `priority` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`id`, `name`, `priority`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Criminal', 1, 0, '2025-03-14 22:40:37', '2025-03-14 16:40:37'),
(2, 'Anti-Money Laundering Law', 2, 0, '2025-03-14 22:41:40', '2025-03-14 16:41:40'),
(3, 'Business Law', 3, 1, '2025-03-14 16:42:01', '2025-03-14 16:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE `book_issues` (
  `id` int(11) NOT NULL,
  `membership_number` text DEFAULT NULL,
  `rack_id` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) DEFAULT 0,
  `book_id` int(11) DEFAULT 0,
  `issue_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `actual_return_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = issue, 1 = good, 2 = late',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `book_issues`
--

INSERT INTO `book_issues` (`id`, `membership_number`, `rack_id`, `category_id`, `book_id`, `issue_date`, `return_date`, `actual_return_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '4', 7, 1, 1, '2025-07-30', '2025-08-06', '2025-08-04', 1, 1, '2025-07-30 22:15:52', '2025-07-31 00:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `photo` text DEFAULT NULL,
  `membership_number` varchar(50) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `name`, `photo`, `membership_number`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Abdur Rahim', 'backend_assets/images/donors/1.jpg', '456', 1, '2025-03-17 11:02:01', '2025-03-17 11:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `membership_number` int(11) NOT NULL DEFAULT 9999999,
  `name` text NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `member_photo` text DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `membership_number`, `name`, `email`, `phone`, `member_photo`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 4, 'Shabnam', 'tarannum.cse@gmail.com', '01761158112', 'backend_assets/images/members/1.jpg', 0, '2025-07-30 23:20:55', '2025-07-31 00:06:31'),
(2, 14, 'Rahat', 'rahat_424@yahoo.com', '01717697167', 'backend_assets/images/members/2.jpg', 0, '2025-07-30 23:20:55', '2025-07-31 00:11:30'),
(3, 17, 'Shahana', 'shahanabegum906@gmail.com', '01711239748', 'backend_assets/images/members/3.jpg', 0, '2025-07-30 23:20:55', '2025-07-31 00:14:05'),
(4, 18, 'Maksuda', '', '01717160573', 'backend_assets/images/members/4.jpg', 0, '2025-07-30 23:20:55', '2025-07-30 23:20:55'),
(5, 19, 'Mahmuda', '', '01911114826', 'backend_assets/images/members/5.jpg', 0, '2025-07-30 23:20:55', '2025-07-30 23:20:55'),
(6, 23, 'Rokeya', 'rokeyabegum442@gmail.com', '01711131780', 'backend_assets/images/members/6.jpg', 0, '2025-07-30 23:20:55', '2025-07-31 00:12:18'),
(7, 24, 'Nitu', '', '01677814122', 'backend_assets/images/members/7.jpg', 0, '2025-07-30 23:20:55', '2025-07-30 23:20:55'),
(8, 25, 'Rashed', '', '01711661684', 'backend_assets/images/members/8.jpg', 0, '2025-07-30 23:20:55', '2025-07-30 23:20:55'),
(9, 27, 'Liaqat', 'liaqathossain.dr@gmail.com', '01711131781', 'backend_assets/images/members/9.jpg', 0, '2025-07-30 23:20:55', '2025-07-31 00:14:32'),
(10, 28, 'Sabah', 'sabatarannum@rocketmail.com', '01534686255', 'backend_assets/images/members/10.jpg', 0, '2025-07-30 23:20:55', '2025-07-31 00:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_06_063751_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `racks`
--

INSERT INTO `racks` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(6, 'A-1', 1, '2025-03-17 17:28:26', '2025-03-17 17:28:26'),
(7, 'A-2', 1, '2025-03-17 17:28:41', '2025-03-17 17:28:41'),
(8, 'A-3', 1, '2025-03-17 17:36:30', '2025-03-17 17:36:30'),
(9, 'A-4', 1, '2025-03-17 17:36:42', '2025-03-17 17:36:42'),
(10, 'A-5', 1, '2025-03-17 17:36:58', '2025-03-17 17:36:58'),
(11, 'A-6', 1, '2025-03-17 17:37:12', '2025-03-17 17:37:12'),
(12, 'A-7', 1, '2025-03-17 17:37:25', '2025-03-17 17:37:25'),
(13, 'A-8', 1, '2025-03-17 17:37:35', '2025-03-17 17:37:35'),
(14, 'A-9', 1, '2025-03-17 17:37:45', '2025-03-17 17:37:45'),
(15, 'A-10', 1, '2025-03-17 17:37:56', '2025-03-17 17:37:56'),
(16, 'A-11', 1, '2025-03-17 18:12:52', '2025-03-17 18:12:52'),
(17, 'A-12', 1, '2025-03-17 18:13:11', '2025-03-17 18:13:11'),
(18, 'A-13', 1, '2025-03-17 18:13:20', '2025-03-17 18:13:20'),
(19, 'A-14', 1, '2025-03-17 18:13:29', '2025-03-17 18:13:29'),
(20, 'A-15', 1, '2025-03-17 18:13:39', '2025-03-17 18:13:39'),
(21, 'A-16', 1, '2025-03-17 18:18:33', '2025-03-17 18:18:33'),
(22, 'A-17', 1, '2025-03-17 18:18:45', '2025-03-17 18:18:45'),
(23, 'A-18', 1, '2025-03-17 18:19:00', '2025-03-17 18:19:00'),
(24, 'A-19', 1, '2025-03-17 18:19:09', '2025-03-17 18:19:09'),
(25, 'A-20', 1, '2025-03-17 18:19:29', '2025-03-17 18:19:29'),
(26, 'A-21', 1, '2025-03-17 18:19:39', '2025-03-17 18:19:39'),
(27, 'A-22', 1, '2025-03-17 18:19:51', '2025-03-17 18:19:51'),
(28, 'A-23', 1, '2025-03-17 18:21:52', '2025-03-17 18:21:52'),
(29, 'A-24', 1, '2025-03-17 18:22:01', '2025-03-17 18:22:01'),
(30, 'A-25', 1, '2025-03-17 18:22:11', '2025-03-17 18:22:11'),
(31, 'A-26', 1, '2025-03-17 18:22:36', '2025-03-17 18:22:36'),
(32, 'A-27', 1, '2025-03-17 18:22:46', '2025-03-17 18:22:46'),
(33, 'A-28', 1, '2025-03-17 18:22:55', '2025-03-17 18:22:55'),
(34, 'A-29', 1, '2025-03-17 18:23:04', '2025-03-17 18:23:04'),
(35, 'A-30', 1, '2025-03-17 18:23:12', '2025-03-17 18:23:12'),
(36, 'A-31', 1, '2025-03-17 18:23:21', '2025-03-17 18:23:21'),
(37, 'A-32', 1, '2025-03-17 18:23:30', '2025-03-17 18:23:30'),
(38, 'A-33', 1, '2025-03-17 18:23:39', '2025-03-17 18:23:39'),
(39, 'A-34', 1, '2025-03-17 18:23:48', '2025-03-17 18:23:48'),
(40, 'A-35', 1, '2025-03-17 18:23:58', '2025-03-17 18:23:58'),
(41, 'A-36', 1, '2025-03-17 18:24:33', '2025-03-17 18:24:33'),
(42, 'A-37', 1, '2025-03-17 18:24:43', '2025-03-17 18:24:43'),
(43, 'A-38', 1, '2025-03-17 18:24:53', '2025-03-17 18:24:53'),
(46, 'A-39', 1, '2025-03-17 18:25:15', '2025-03-17 18:25:15'),
(47, 'A-40', 1, '2025-03-17 18:25:26', '2025-03-17 18:25:26'),
(48, 'B-1', 1, '2025-03-17 18:30:24', '2025-03-17 18:30:24'),
(49, 'B-2', 1, '2025-03-17 18:30:33', '2025-03-17 18:30:33'),
(50, 'B-3', 1, '2025-03-17 18:30:41', '2025-03-17 18:30:41'),
(51, 'B-4', 1, '2025-03-17 18:30:49', '2025-03-17 18:30:49'),
(52, 'B-5', 1, '2025-03-17 18:30:58', '2025-03-17 18:30:58'),
(53, 'B-6', 1, '2025-03-17 18:31:07', '2025-03-17 18:31:07'),
(54, 'B-7', 1, '2025-03-17 18:31:15', '2025-03-17 18:31:15'),
(55, 'B-8', 1, '2025-03-17 18:31:25', '2025-03-17 18:31:25'),
(57, 'B-9', 1, '2025-03-17 19:09:18', '2025-03-17 19:09:18'),
(58, 'B-10', 1, '2025-03-17 19:09:27', '2025-03-17 19:09:27'),
(59, 'B-11', 1, '2025-03-17 19:09:41', '2025-03-17 19:09:41'),
(60, 'B-12', 1, '2025-03-17 19:09:51', '2025-03-17 19:09:51'),
(61, 'B-13', 1, '2025-03-17 19:10:02', '2025-03-17 19:10:02'),
(62, 'B-14', 1, '2025-03-17 19:10:13', '2025-03-17 19:10:13'),
(63, 'B-15', 1, '2025-03-17 19:10:37', '2025-03-17 19:10:37'),
(64, 'B-16', 1, '2025-03-17 19:10:46', '2025-03-17 19:10:46'),
(65, 'B-17', 1, '2025-03-17 19:11:31', '2025-03-17 19:11:31'),
(66, 'B-20', 1, '2025-03-17 19:11:50', '2025-03-17 19:11:50'),
(67, 'B-21', 1, '2025-03-17 19:11:59', '2025-03-17 19:11:59'),
(68, 'B-24', 1, '2025-03-17 19:12:12', '2025-03-17 19:12:12'),
(69, 'B-25', 1, '2025-03-17 19:13:06', '2025-03-17 19:13:06'),
(70, 'B-26', 1, '2025-03-17 19:13:16', '2025-03-17 19:13:16'),
(71, 'B-27', 1, '2025-03-17 19:13:24', '2025-03-17 19:13:24'),
(72, 'B-28', 1, '2025-03-17 19:13:33', '2025-03-17 19:13:33'),
(73, 'B-29', 1, '2025-03-17 19:13:42', '2025-03-17 19:13:42'),
(74, 'B-30', 1, '2025-03-17 19:13:51', '2025-03-17 19:13:51'),
(75, 'B-31', 1, '2025-03-17 19:14:23', '2025-03-17 19:14:23'),
(76, 'B-32', 1, '2025-03-17 19:14:37', '2025-03-17 19:14:37'),
(77, 'B-33', 1, '2025-03-17 19:14:47', '2025-03-17 19:14:47'),
(78, 'B-34', 1, '2025-03-20 04:07:22', '2025-03-20 15:07:22'),
(79, 'B-35', 1, '2025-03-17 19:15:10', '2025-03-17 19:15:10'),
(80, 'B-36', 1, '2025-03-17 19:15:19', '2025-03-17 19:15:19'),
(81, 'B-37', 1, '2025-03-17 19:15:29', '2025-03-17 19:15:29'),
(82, 'B-38', 1, '2025-03-17 19:15:44', '2025-03-17 19:15:44'),
(83, 'B-39', 1, '2025-03-17 19:15:53', '2025-03-17 19:15:53'),
(84, 'B-40', 1, '2025-03-17 19:16:02', '2025-03-17 19:16:02'),
(85, 'C-1', 1, '2025-03-17 19:16:36', '2025-03-17 19:16:36'),
(86, 'C-2', 1, '2025-03-17 19:16:46', '2025-03-17 19:16:46'),
(87, 'C-3', 1, '2025-03-17 19:16:56', '2025-03-17 19:16:56'),
(88, 'C-4', 1, '2025-03-17 19:17:05', '2025-03-17 19:17:05'),
(89, 'C-5', 1, '2025-03-17 19:17:15', '2025-03-17 19:17:15'),
(90, 'C-6', 1, '2025-03-17 19:17:26', '2025-03-17 19:17:26'),
(91, 'C-7', 1, '2025-03-17 19:17:47', '2025-03-17 19:17:47'),
(92, 'C-8', 1, '2025-03-17 19:17:58', '2025-03-17 19:17:58'),
(94, 'C-9', 1, '2025-03-17 19:18:18', '2025-03-17 19:18:18'),
(95, 'C-10', 1, '2025-03-17 19:18:28', '2025-03-17 19:18:28'),
(96, 'C-11', 1, '2025-03-17 19:19:20', '2025-03-17 19:19:20'),
(97, 'C-12', 1, '2025-03-17 19:19:33', '2025-03-17 19:19:33'),
(98, 'C-13', 1, '2025-03-17 19:19:45', '2025-03-17 19:19:45'),
(99, 'C-14', 1, '2025-03-17 19:19:56', '2025-03-17 19:19:56'),
(100, 'C-15', 1, '2025-03-17 19:20:05', '2025-03-17 19:20:05'),
(101, 'C-16', 1, '2025-03-17 19:20:16', '2025-03-17 19:20:16'),
(102, 'C-17', 1, '2025-03-17 19:20:26', '2025-03-17 19:20:26'),
(103, 'C-20', 1, '2025-03-17 19:20:38', '2025-03-17 19:20:38'),
(104, 'C-21', 1, '2025-03-17 19:22:09', '2025-03-17 19:22:09'),
(105, 'C-24', 1, '2025-03-17 19:22:20', '2025-03-17 19:22:20'),
(106, 'C-25', 1, '2025-03-17 19:22:31', '2025-03-17 19:22:31'),
(107, 'C-26', 1, '2025-03-17 19:23:33', '2025-03-17 19:23:33'),
(108, 'C-27', 1, '2025-03-17 19:23:44', '2025-03-17 19:23:44'),
(109, 'C-28', 1, '2025-03-17 19:23:53', '2025-03-17 19:23:53'),
(110, 'C-29', 1, '2025-03-17 19:24:04', '2025-03-17 19:24:04'),
(111, 'C-30', 1, '2025-03-17 19:24:16', '2025-03-17 19:24:16'),
(112, 'C-31', 1, '2025-03-17 19:27:29', '2025-03-17 19:27:29'),
(113, 'C-32', 1, '2025-03-17 19:28:33', '2025-03-17 19:28:33'),
(114, 'C-33', 1, '2025-03-17 19:28:45', '2025-03-17 19:28:45'),
(116, 'C-34', 1, '2025-03-17 19:29:23', '2025-03-17 19:29:23'),
(117, 'C-35', 1, '2025-03-17 19:29:31', '2025-03-17 19:29:31'),
(124, 'C-36', 1, '2025-03-17 19:35:07', '2025-03-17 19:35:07'),
(125, 'C-37', 1, '2025-03-17 19:35:19', '2025-03-17 19:35:19'),
(126, 'C-38', 1, '2025-03-17 19:36:32', '2025-03-17 19:36:32'),
(127, 'C-39', 1, '2025-03-17 19:36:44', '2025-03-17 19:36:44'),
(128, 'C-40', 1, '2025-03-17 19:37:16', '2025-03-17 19:37:16'),
(129, 'D-1', 1, '2025-03-17 19:38:40', '2025-03-17 19:38:40'),
(130, 'D-2', 1, '2025-03-17 19:38:50', '2025-03-17 19:38:50'),
(131, 'D-3', 1, '2025-03-17 19:39:00', '2025-03-17 19:39:00'),
(132, 'D-4', 1, '2025-03-17 19:39:11', '2025-03-17 19:39:11'),
(133, 'D-5', 1, '2025-03-17 19:39:20', '2025-03-17 19:39:20'),
(134, 'D-6', 1, '2025-03-17 19:39:31', '2025-03-17 19:39:31'),
(135, 'D-7', 1, '2025-03-17 19:39:41', '2025-03-17 19:39:41'),
(136, 'D-8', 1, '2025-03-17 19:39:51', '2025-03-17 19:39:51'),
(137, 'D-9', 1, '2025-03-17 19:40:21', '2025-03-17 19:40:21'),
(138, 'D-10', 1, '2025-03-17 19:40:33', '2025-03-17 19:40:33'),
(139, 'D-11', 1, '2025-03-17 19:40:44', '2025-03-17 19:40:44'),
(140, 'D-12', 1, '2025-03-17 19:40:57', '2025-03-17 19:40:57'),
(141, 'D-13', 1, '2025-03-17 19:41:07', '2025-03-17 19:41:07'),
(142, 'D-14', 1, '2025-03-17 19:41:18', '2025-03-17 19:41:18'),
(143, 'D-15', 1, '2025-03-17 19:41:29', '2025-03-17 19:41:29'),
(144, 'D-16', 1, '2025-03-17 19:41:40', '2025-03-17 19:41:40'),
(145, 'D-17', 1, '2025-03-17 19:41:51', '2025-03-17 19:41:51'),
(146, 'D-20', 1, '2025-03-17 19:42:31', '2025-03-17 19:42:31'),
(147, 'D-21', 1, '2025-03-17 19:42:53', '2025-03-17 19:42:53'),
(148, 'D-24', 1, '2025-03-17 19:43:30', '2025-03-17 19:43:30'),
(150, 'D-25', 1, '2025-03-17 19:43:50', '2025-03-17 19:43:50'),
(151, 'D-26', 1, '2025-03-17 19:46:31', '2025-03-17 19:46:31'),
(157, 'D-27', 1, '2025-03-17 19:50:03', '2025-03-17 19:50:03'),
(158, 'D-28', 1, '2025-03-17 19:50:14', '2025-03-17 19:50:14'),
(159, 'D-29', 1, '2025-03-17 19:50:23', '2025-03-17 19:50:23'),
(160, 'D-30', 1, '2025-03-17 19:50:33', '2025-03-17 19:50:33'),
(161, 'D-31', 1, '2025-03-17 19:51:03', '2025-03-17 19:51:03'),
(162, 'D-32', 1, '2025-03-17 19:51:14', '2025-03-17 19:51:14'),
(163, 'D-33', 1, '2025-03-17 19:51:25', '2025-03-17 19:51:25'),
(164, 'D-34', 1, '2025-03-17 19:51:35', '2025-03-17 19:51:35'),
(165, 'D-35', 1, '2025-03-17 19:51:45', '2025-03-17 19:51:45'),
(166, 'D-36', 1, '2025-03-17 19:51:56', '2025-03-17 19:51:56'),
(167, 'D-37', 1, '2025-03-17 19:52:55', '2025-03-17 19:52:55'),
(168, 'D-38', 1, '2025-03-17 19:53:06', '2025-03-17 19:53:06'),
(169, 'D-39', 1, '2025-03-17 19:53:18', '2025-03-17 19:53:18'),
(170, 'D-40', 1, '2025-03-17 19:53:29', '2025-03-17 19:53:29'),
(171, 'E-1', 1, '2025-03-17 19:56:08', '2025-03-17 19:56:08'),
(172, 'E-2', 1, '2025-03-17 19:56:20', '2025-03-17 19:56:20'),
(173, 'E-3', 1, '2025-03-17 19:56:31', '2025-03-17 19:56:31'),
(175, 'E-4', 1, '2025-03-17 19:57:42', '2025-03-17 19:57:42'),
(176, 'E-5', 1, '2025-03-17 19:57:55', '2025-03-17 19:57:55'),
(177, 'E-6', 1, '2025-03-17 19:58:06', '2025-03-17 19:58:06'),
(178, 'E-7', 1, '2025-03-17 19:58:40', '2025-03-17 19:58:40'),
(179, 'E-8', 1, '2025-03-17 19:58:51', '2025-03-17 19:58:51'),
(180, 'E-9', 1, '2025-03-17 19:59:38', '2025-03-17 19:59:38'),
(181, 'E-10', 1, '2025-03-17 19:59:55', '2025-03-17 19:59:55'),
(182, 'E-11', 1, '2025-03-17 20:00:50', '2025-03-17 20:00:50'),
(183, 'E-12', 1, '2025-03-17 20:01:02', '2025-03-17 20:01:02'),
(184, 'E-13', 1, '2025-03-17 20:01:14', '2025-03-17 20:01:14'),
(185, 'E-14', 1, '2025-03-17 20:01:43', '2025-03-17 20:01:43'),
(186, 'E-15', 1, '2025-03-17 20:01:57', '2025-03-17 20:01:57'),
(187, 'E-16', 1, '2025-03-19 06:12:37', '2025-03-19 17:12:37'),
(188, 'E-17', 1, '2025-03-17 20:02:43', '2025-03-17 20:02:43'),
(189, 'E-20', 1, '2025-03-17 20:03:26', '2025-03-17 20:03:26'),
(190, 'E-21', 1, '2025-03-17 20:03:44', '2025-03-17 20:03:44'),
(191, 'E-24', 1, '2025-03-17 20:04:06', '2025-03-17 20:04:06'),
(192, 'E-25', 1, '2025-03-17 20:04:36', '2025-03-17 20:04:36'),
(193, 'E-26', 1, '2025-03-17 20:04:50', '2025-03-17 20:04:50'),
(194, 'E-27', 1, '2025-03-17 20:05:01', '2025-03-17 20:05:01'),
(195, 'E-28', 1, '2025-03-17 20:05:14', '2025-03-17 20:05:14'),
(196, 'E-29', 1, '2025-03-17 20:05:48', '2025-03-17 20:05:48'),
(197, 'E-30', 1, '2025-03-17 20:06:20', '2025-03-17 20:06:20'),
(198, 'E-31', 1, '2025-03-17 20:06:33', '2025-03-17 20:06:33'),
(200, 'E-32', 1, '2025-03-17 20:08:11', '2025-03-17 20:08:11'),
(201, 'E-33', 1, '2025-03-17 20:08:37', '2025-03-17 20:08:37'),
(202, 'E-34', 1, '2025-03-17 20:09:43', '2025-03-17 20:09:43'),
(204, 'E-35', 1, '2025-03-17 20:10:47', '2025-03-17 20:10:47'),
(205, 'E-36', 1, '2025-03-17 20:25:42', '2025-03-17 20:25:42'),
(206, 'E-37', 1, '2025-03-17 20:26:05', '2025-03-17 20:26:05'),
(207, 'E-38', 1, '2025-03-17 20:26:48', '2025-03-17 20:26:48'),
(208, 'E-39', 1, '2025-03-18 14:31:58', '2025-03-18 14:31:58'),
(209, 'E-40', 1, '2025-03-18 14:33:09', '2025-03-18 14:33:09'),
(210, 'F-1', 1, '2025-03-18 14:33:47', '2025-03-18 14:33:47'),
(211, 'F-2', 1, '2025-03-18 14:33:57', '2025-03-18 14:33:57'),
(212, 'F-3', 1, '2025-03-18 14:34:08', '2025-03-18 14:34:08'),
(213, 'F-4', 1, '2025-03-18 14:34:19', '2025-03-18 14:34:19'),
(214, 'F-5', 1, '2025-03-18 14:34:33', '2025-03-18 14:34:33'),
(215, 'F-6', 1, '2025-03-18 14:34:50', '2025-03-18 14:34:50'),
(216, 'F-7', 1, '2025-03-18 14:35:00', '2025-03-18 14:35:00'),
(217, 'F-8', 1, '2025-03-18 14:35:11', '2025-03-18 14:35:11'),
(218, 'F-9', 1, '2025-03-18 14:35:23', '2025-03-18 14:35:23'),
(219, 'F-10', 1, '2025-03-18 14:35:36', '2025-03-18 14:35:36'),
(220, 'F-11', 1, '2025-03-18 14:35:48', '2025-03-18 14:35:48'),
(221, 'F-12', 1, '2025-03-18 14:36:01', '2025-03-18 14:36:01'),
(222, 'F-13', 1, '2025-03-18 14:36:25', '2025-03-18 14:36:25'),
(223, 'F-14', 1, '2025-03-18 14:36:36', '2025-03-18 14:36:36'),
(224, 'F-15', 1, '2025-03-18 14:36:46', '2025-03-18 14:36:46'),
(225, 'F-16', 1, '2025-03-18 14:36:56', '2025-03-18 14:36:56'),
(226, 'F-17', 1, '2025-03-18 14:37:05', '2025-03-18 14:37:05'),
(227, 'F-20', 1, '2025-03-18 14:38:16', '2025-03-18 14:38:16'),
(228, 'F-21', 1, '2025-03-18 14:38:25', '2025-03-18 14:38:25'),
(229, 'F-24', 1, '2025-03-18 14:38:35', '2025-03-18 14:38:35'),
(230, 'F-25', 1, '2025-03-18 14:38:47', '2025-03-18 14:38:47'),
(231, 'F-26', 1, '2025-03-18 14:39:01', '2025-03-18 14:39:01'),
(232, 'F-27', 1, '2025-03-18 14:39:14', '2025-03-18 14:39:14'),
(233, 'F-28', 1, '2025-03-18 14:39:38', '2025-03-18 14:39:38'),
(234, 'F-29', 1, '2025-03-18 14:39:52', '2025-03-18 14:39:52'),
(235, 'F-30', 1, '2025-03-18 14:40:03', '2025-03-18 14:40:03'),
(236, 'F-31', 1, '2025-03-18 14:40:25', '2025-03-18 14:40:25'),
(237, 'F-32', 1, '2025-03-18 14:40:36', '2025-03-18 14:40:36'),
(238, 'F-33', 1, '2025-03-18 14:44:36', '2025-03-18 14:44:36'),
(239, 'F-34', 1, '2025-03-18 14:44:48', '2025-03-18 14:44:48'),
(240, 'F-35', 1, '2025-03-18 14:45:11', '2025-03-18 14:45:11'),
(241, 'F-36', 1, '2025-03-18 14:45:24', '2025-03-18 14:45:24'),
(242, 'F-37', 1, '2025-03-18 14:45:37', '2025-03-18 14:45:37'),
(243, 'F-38', 1, '2025-03-18 14:50:29', '2025-03-18 14:50:29'),
(244, 'F-39', 1, '2025-03-18 14:50:50', '2025-03-18 14:50:50'),
(245, 'F-40', 1, '2025-03-18 14:51:07', '2025-03-18 14:51:07'),
(246, 'G-1', 1, '2025-03-18 14:53:45', '2025-03-18 14:53:45'),
(247, 'G-2', 1, '2025-03-18 14:54:07', '2025-03-18 14:54:07'),
(249, 'G-3', 1, '2025-03-18 14:55:25', '2025-03-18 14:55:25'),
(250, 'G-4', 1, '2025-03-18 14:55:39', '2025-03-18 14:55:39'),
(251, 'G-5', 1, '2025-03-18 14:55:52', '2025-03-18 14:55:52'),
(252, 'G-6', 1, '2025-03-18 14:56:05', '2025-03-18 14:56:05'),
(253, 'G-7', 1, '2025-03-18 14:56:18', '2025-03-18 14:56:18'),
(254, 'G-8', 1, '2025-03-18 14:56:31', '2025-03-18 14:56:31'),
(255, 'G-9', 1, '2025-03-18 14:56:49', '2025-03-18 14:56:49'),
(256, 'G-10', 1, '2025-03-18 14:57:07', '2025-03-18 14:57:07'),
(257, 'G-11', 1, '2025-03-18 14:58:23', '2025-03-18 14:58:23'),
(258, 'G-12', 1, '2025-03-18 14:58:39', '2025-03-18 14:58:39'),
(259, 'G-13', 1, '2025-03-18 14:58:56', '2025-03-18 14:58:56'),
(260, 'G-14', 1, '2025-03-18 14:59:12', '2025-03-18 14:59:12'),
(261, 'G-15', 1, '2025-03-18 14:59:26', '2025-03-18 14:59:26'),
(262, 'G-16', 1, '2025-03-18 14:59:43', '2025-03-18 14:59:43'),
(263, 'G-17', 1, '2025-03-18 14:59:55', '2025-03-18 14:59:55'),
(266, 'G-20', 1, '2025-03-18 15:01:07', '2025-03-18 15:01:07'),
(267, 'G-21', 1, '2025-03-18 15:01:22', '2025-03-18 15:01:22'),
(268, 'G-24', 1, '2025-03-18 15:01:39', '2025-03-18 15:01:39'),
(269, 'G-25', 1, '2025-03-18 15:01:55', '2025-03-18 15:01:55'),
(270, 'G-26', 1, '2025-03-18 15:02:07', '2025-03-18 15:02:07'),
(271, 'G-27', 1, '2025-03-18 15:02:20', '2025-03-18 15:02:20'),
(272, 'G-28', 1, '2025-03-18 15:02:33', '2025-03-18 15:02:33'),
(273, 'G-29', 1, '2025-03-18 15:02:45', '2025-03-18 15:02:45'),
(274, 'G-30', 1, '2025-03-18 15:02:59', '2025-03-18 15:02:59'),
(275, 'G-31', 1, '2025-03-18 15:03:38', '2025-03-18 15:03:38'),
(276, 'G-32', 1, '2025-03-18 15:03:48', '2025-03-18 15:03:48'),
(277, 'G-33', 1, '2025-03-18 15:04:05', '2025-03-18 15:04:05'),
(278, 'G-34', 1, '2025-03-18 15:04:15', '2025-03-18 15:04:15'),
(279, 'G-35', 1, '2025-03-18 15:04:26', '2025-03-18 15:04:26'),
(280, 'G-36', 1, '2025-03-18 15:04:38', '2025-03-18 15:04:38'),
(281, 'G-37', 1, '2025-03-18 15:04:49', '2025-03-18 15:04:49'),
(282, 'G-38', 1, '2025-03-18 15:05:00', '2025-03-18 15:05:00'),
(283, 'G-39', 1, '2025-03-18 15:05:11', '2025-03-18 15:05:11'),
(284, 'G-40', 1, '2025-03-18 15:05:24', '2025-03-18 15:05:24'),
(286, 'C-41', 4, '2025-03-22 06:54:28', '2025-03-22 17:54:28'),
(287, 'D-41', 4, '2025-03-22 06:54:05', '2025-03-22 17:54:05'),
(288, 'E-41', 4, '2025-03-22 06:51:37', '2025-03-22 17:51:37'),
(289, 'F-41', 4, '2025-03-22 06:51:16', '2025-03-22 17:51:16'),
(290, 'G-41', 4, '2025-03-22 06:50:51', '2025-03-22 17:50:51'),
(292, 'C-42', 4, '2025-03-22 06:49:54', '2025-03-22 17:49:54'),
(293, 'F-42', 4, '2025-03-22 06:49:02', '2025-03-22 17:49:02'),
(294, 'D-42', 4, '2025-03-22 06:49:30', '2025-03-22 17:49:30'),
(295, 'E-42', 4, '2025-03-22 06:48:40', '2025-03-22 17:48:40'),
(296, 'G-42', 4, '2025-03-22 06:46:46', '2025-03-22 17:46:46'),
(297, 'C-46', 5, '2025-03-22 06:45:48', '2025-03-22 17:45:48'),
(298, 'D-46', 5, '2025-03-22 06:45:30', '2025-03-22 17:45:30'),
(299, 'E-46', 5, '2025-03-22 06:45:07', '2025-03-22 17:45:07'),
(300, 'F-46', 5, '2025-03-22 06:44:52', '2025-03-22 17:44:52'),
(301, 'G-46', 5, '2025-03-22 06:44:27', '2025-03-22 17:44:27'),
(302, 'C-43', 5, '2025-03-22 06:43:52', '2025-03-22 17:43:52'),
(303, 'D-43', 5, '2025-03-22 06:43:36', '2025-03-22 17:43:36'),
(304, 'E-43', 5, '2025-03-22 06:43:18', '2025-03-22 17:43:18'),
(305, 'F-43', 5, '2025-03-22 06:43:02', '2025-03-22 17:43:02'),
(306, 'G-43', 5, '2025-03-22 06:42:30', '2025-03-22 17:42:30'),
(307, 'C-44', 5, '2025-03-22 06:42:10', '2025-03-22 17:42:10'),
(308, 'D-44', 5, '2025-03-22 06:41:48', '2025-03-22 17:41:48'),
(309, 'E-44', 5, '2025-03-22 06:41:31', '2025-03-22 17:41:31'),
(310, 'F-44', 5, '2025-03-22 06:41:13', '2025-03-22 17:41:13'),
(311, 'G-44', 5, '2025-03-22 06:40:52', '2025-03-22 17:40:52'),
(312, 'C-45', 5, '2025-03-22 06:40:34', '2025-03-22 17:40:34'),
(313, 'D-45', 5, '2025-03-22 06:40:05', '2025-03-22 17:40:05'),
(314, 'E-45', 5, '2025-03-22 06:39:25', '2025-03-22 17:39:25'),
(315, 'F-45', 5, '2025-03-22 06:38:43', '2025-03-22 17:38:43'),
(316, 'G-45', 5, '2025-03-22 06:38:23', '2025-03-22 17:38:23'),
(317, 'C-47', 5, '2025-03-22 18:06:02', '2025-03-22 18:06:02'),
(318, 'D-47', 5, '2025-03-22 18:06:17', '2025-03-22 18:06:17'),
(319, 'E-47', 5, '2025-03-22 18:06:34', '2025-03-22 18:06:34'),
(320, 'F-47', 5, '2025-03-22 18:06:46', '2025-03-22 18:06:46'),
(321, 'G-47', 5, '2025-03-22 18:07:00', '2025-03-22 18:07:00'),
(322, 'C-48', 5, '2025-03-22 18:49:06', '2025-03-22 18:49:06'),
(323, 'D-48', 5, '2025-03-22 18:49:16', '2025-03-22 18:49:16'),
(324, 'E-48', 5, '2025-03-22 18:49:32', '2025-03-22 18:49:32'),
(325, 'F-48', 5, '2025-03-22 18:50:23', '2025-03-22 18:50:23'),
(326, 'G-48', 5, '2025-03-22 18:50:36', '2025-03-22 18:50:36'),
(327, 'C-49', 5, '2025-03-22 18:50:56', '2025-03-22 18:50:56'),
(328, 'D-49', 5, '2025-03-22 18:51:09', '2025-03-22 18:51:09'),
(329, 'E-49', 5, '2025-03-22 18:51:20', '2025-03-22 18:51:20'),
(330, 'F-49', 5, '2025-03-22 18:51:31', '2025-03-22 18:51:31'),
(331, 'G-49', 5, '2025-03-22 18:51:48', '2025-03-22 18:51:48'),
(332, 'C-50', 5, '2025-03-22 18:52:54', '2025-03-22 18:52:54'),
(333, 'D-50', 5, '2025-03-22 07:53:44', '2025-03-22 18:53:44'),
(334, 'E-50', 5, '2025-03-22 07:54:12', '2025-03-22 18:54:12'),
(335, 'F-50', 5, '2025-03-22 18:54:33', '2025-03-22 18:54:33'),
(336, 'G-50', 5, '2025-03-22 18:54:42', '2025-03-22 18:54:42'),
(337, 'B-49', 5, '2025-03-23 18:43:17', '2025-03-23 18:43:17'),
(338, 'B-51', 5, '2025-03-23 18:43:51', '2025-03-23 18:43:51'),
(339, 'C-51', 5, '2025-03-23 18:44:06', '2025-03-23 18:44:06'),
(340, 'D-51', 5, '2025-03-23 18:44:19', '2025-03-23 18:44:19'),
(341, 'E-51', 5, '2025-03-23 18:44:30', '2025-03-23 18:44:30'),
(342, 'F-51', 5, '2025-03-23 18:44:43', '2025-03-23 18:44:43'),
(343, 'G-51', 5, '2025-03-23 18:44:53', '2025-03-23 18:44:53'),
(344, 'C-52', 5, '2025-03-23 18:45:22', '2025-03-23 18:45:22'),
(345, 'D-52', 5, '2025-03-23 18:45:35', '2025-03-23 18:45:35'),
(346, 'E-52', 5, '2025-03-23 18:45:44', '2025-03-23 18:45:44'),
(347, 'F-52', 5, '2025-03-23 18:45:53', '2025-03-23 18:45:53'),
(348, 'G-52', 5, '2025-03-23 07:46:38', '2025-03-23 18:46:38'),
(349, 'B-54', 5, '2025-03-23 07:48:26', '2025-03-23 18:48:26'),
(350, 'C-53', 5, '2025-03-23 18:47:02', '2025-03-23 18:47:02'),
(351, 'D-53', 5, '2025-03-23 18:47:23', '2025-03-23 18:47:23'),
(352, 'E-53', 5, '2025-03-23 18:47:35', '2025-03-23 18:47:35'),
(353, 'F-53', 5, '2025-03-23 18:47:45', '2025-03-23 18:47:45'),
(354, 'G-53', 5, '2025-03-23 18:48:05', '2025-03-23 18:48:05'),
(355, 'C-54', 5, '2025-03-23 18:48:38', '2025-03-23 18:48:38'),
(356, 'D-54', 5, '2025-03-23 18:48:47', '2025-03-23 18:48:47'),
(357, 'E-54', 5, '2025-03-23 18:48:57', '2025-03-23 18:48:57'),
(358, 'F-54', 5, '2025-03-23 18:49:07', '2025-03-23 18:49:07'),
(359, 'G-54', 5, '2025-03-23 18:49:19', '2025-03-23 18:49:19'),
(360, 'C-55', 5, '2025-03-23 18:49:37', '2025-03-23 18:49:37'),
(361, 'D-55', 5, '2025-03-23 18:49:48', '2025-03-23 18:49:48'),
(362, 'E-55', 5, '2025-03-23 18:49:57', '2025-03-23 18:49:57'),
(363, 'F-55', 5, '2025-03-23 18:50:09', '2025-03-23 18:50:09'),
(364, 'G-55', 5, '2025-03-23 18:50:19', '2025-03-23 18:50:19'),
(365, 'B-56', 5, '2025-03-23 18:50:43', '2025-03-23 18:50:43'),
(366, 'C-56', 5, '2025-03-23 18:50:52', '2025-03-23 18:50:52'),
(367, 'D-56', 5, '2025-03-23 18:51:03', '2025-03-23 18:51:03'),
(368, 'E-56', 5, '2025-03-23 18:51:15', '2025-03-23 18:51:15'),
(369, 'F-56', 5, '2025-03-23 18:51:24', '2025-03-23 18:51:24'),
(370, 'G-56', 5, '2025-03-23 18:51:38', '2025-03-23 18:51:38');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('OxQL6Ys1JABED15eYDTY4EkTaxPL09U5upwKXat2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHA0QXh1VlFYYndOVVZVcmxLVzdFZ0RiZmJMYUgwM0NlVjZmb1NoaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753901495);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `api_secret_key` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `photo`, `email_verified_at`, `password`, `user_type`, `remember_token`, `api_secret_key`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '01308389719', 'backend_assets/images/user/668ba2c9734ee.jpg', '2024-04-16 22:43:28', '$2y$12$I72NM9PGVKVVOui0oFZ3P.V5IzV7xHW8V0q/GP3/zPOyTZoUrRx..', 'admin', 'NERd56oe7vB3ykD516qbf8lKIu3MeZcQh3oRRmf7L2H5g8ua0lc4oGACzGWs', '4fd5f6454a0135083a1842eabb945b07ae24d82b', '2024-04-16 22:43:28', '2025-07-30 18:48:11'),
(2, 'operatoruzzaman', 'operator@gmail.com', '01308389719', 'backend_assets/images/user/668ba349538da.jpg', '2024-04-16 22:43:28', '$2y$12$.zhGtTQReAThI08Q33WLT.p1xjVJ2NP7t.RFzG3t/0JMmSngRaAAi', 'operator', 'CgB3Wvp2FEzdcYMXAJhVFblhtmY0dGrNg1Rpnn1Upe5mpZF15LYqM0oFCvlC', '4fd5f6454a0135083a1842eabb945b07ae24d82b', '2024-04-16 22:43:28', '2024-07-08 02:28:57'),
(3, 'Atiqur', 'atiq@gmail.com', '01308389720', NULL, '2024-04-16 22:43:28', '$2y$12$KhxkzqJOSwyxiCR00v2FAOY.CA4bZAyQZmkaq5UxWu.TLVgrZIn.G', 'admin', 'JzQIcpEuEt06ClCLr5pHQFEWd9ifOhV4TWua9opqjwQXAuVRFdcTkNrhSw8T', '4fd5f6454a0135083a1842eabb945b07ae24d82b', '2024-04-16 22:43:28', '2025-03-15 01:00:37'),
(4, 'Yousuf', 'yousuf@gmail.com', '01308389730', 'backend_assets/images/user/67e243407b3ae.jpg', '2024-04-16 22:43:28', '$2y$12$KhxkzqJOSwyxiCR00v2FAOY.CA4bZAyQZmkaq5UxWu.TLVgrZIn.G', 'admin', 'lnlwS1d1IG2I2t2KALqqd0fUoXTyIasg2DhXLBQtnMKJ27aAQE5xX9NbD0j3', '4fd5f6454a0135083a1842eabb945b07ae24d82b', '2024-04-16 22:43:28', '2025-03-25 16:46:40'),
(5, 'Siam', 'siam@gmail.com', '01308389711', NULL, '2024-04-16 22:43:28', '$2y$12$KhxkzqJOSwyxiCR00v2FAOY.CA4bZAyQZmkaq5UxWu.TLVgrZIn.G', 'admin', '5ggfHGFZy1w4AoexCG0KTQXtaEl2efRzmrEaZ3MPe1XxRsUTmwAFjPSGwTrV', '4fd5f6454a0135083a1842eabb945b07ae24d82b', '2024-04-16 22:43:28', '2025-03-15 01:00:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `membership_number` (`membership_number`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_number` (`membership_number`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
