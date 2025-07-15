-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 15, 2025 at 05:12 AM
-- Server version: 8.3.0
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task-manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `display_text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `display_text`, `type`) VALUES
(1, 'dashboard', 'Dashboard', 'Common'),
(2, 'user-create', 'Create User', 'User'),
(3, 'user-list', 'User List', 'User'),
(5, 'user-edit', 'Edit User', 'User'),
(6, 'user-role', 'User Roles', 'User'),
(7, 'user-role-edit', 'Edit User Role', 'User'),
(8, 'user-profile', 'User Profile', 'Common'),
(9, 'task-create', 'Create Task', 'Task'),
(10, 'task-edit', 'Edit Task', 'Task'),
(11, 'my-tasks', 'Tasks List', 'Task');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `task_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `allocated_time` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `task_status` int NOT NULL,
  `priority` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `assigned_to` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_task_status` (`task_status`),
  KEY `fk_user_1` (`assigned_to`),
  KEY `fk_user_2` (`created_by`),
  KEY `fk_user_3` (`updated_by`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_title`, `allocated_time`, `category`, `description`, `task_status`, `priority`, `assigned_to`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Web App Backend', '08:00', 'development', 'CRUD for Task Manager', 1, 'medium', 2, '2025-07-14 23:41:40', '2025-07-14 23:41:40', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

DROP TABLE IF EXISTS `task_status`;
CREATE TABLE IF NOT EXISTS `task_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `task_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `style` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_status`
--

INSERT INTO `task_status` (`id`, `task_status`, `style`) VALUES
(1, 'Pending', '#ffc107'),
(2, 'Completed', '#28a745'),
(3, 'Cancelled', '#17a2b8');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` int NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_role` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_role` (`user_role`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `gender`, `email`, `password`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 112233554, 'male', 'admin@gmail.com', '$2y$10$Msnt2nrC/Q06CC5Pd2w4.uJSGFEFnAIn2iHOLaBIGcTmGAjKsQgsu', 1, '2025-07-14 23:37:19', '2025-07-14 23:37:19'),
(2, 'John Doe', 114584587, 'male', 'johndoe@gmail.com', '$2y$10$QGyo.OqCjfXru671NjjsD.mAVpQzCqvcffWX25bdu1jOexdVRXTaO', 2, '2025-07-14 23:38:19', '2025-07-14 23:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_role` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_permission_map`
--

DROP TABLE IF EXISTS `user_role_permission_map`;
CREATE TABLE IF NOT EXISTS `user_role_permission_map` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_role` int NOT NULL,
  `permission` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_permission` (`permission`),
  KEY `fk_user_role_2` (`user_role`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role_permission_map`
--

INSERT INTO `user_role_permission_map` (`id`, `user_role`, `permission`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 5),
(5, 1, 6),
(6, 1, 7),
(7, 1, 8),
(8, 1, 9),
(9, 1, 10),
(10, 1, 11),
(11, 2, 1),
(12, 2, 8),
(13, 2, 9),
(14, 2, 10),
(15, 2, 11);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
