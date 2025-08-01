-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2025 at 09:41 AM
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
-- Database: `todo_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `due_date` timestamp NULL DEFAULT NULL,
  `start_type` enum('now','custom','estimated') NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `urgent` enum('low','medium','high','critical') NOT NULL DEFAULT 'low',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estimated_minutes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `completed`, `due_date`, `start_type`, `start_date`, `urgent`, `created_at`, `updated_at`, `estimated_minutes`) VALUES
(22, 'Task.destroy', 'show delete', 1, NULL, 'now', '2025-08-01 04:31:35', 'low', '2025-08-01 04:31:35', '2025-08-01 04:36:57', NULL),
(23, 'Task.create', 'show create', 1, NULL, 'now', '2025-08-01 04:33:41', 'low', '2025-08-01 04:33:41', '2025-08-01 04:36:46', NULL),
(24, 'Task.edited', 'show editzzzzzzzzzz', 1, NULL, 'now', '2025-08-01 04:37:13', 'low', '2025-08-01 04:34:12', '2025-08-01 04:37:17', NULL),
(25, 'Task level', 'show urgent', 1, NULL, 'now', '2025-08-01 04:37:26', 'critical', '2025-08-01 04:34:40', '2025-08-01 04:37:29', NULL),
(28, 'Custom time', NULL, 0, NULL, 'custom', '2025-08-20 07:38:00', 'low', '2025-08-01 04:38:25', '2025-08-01 04:39:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
