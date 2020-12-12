-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2020 at 09:47 AM
-- Server version: 8.0.22-0ubuntu0.20.04.2
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `code-practice`
--

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `user_id` bigint NOT NULL,
  `token` varchar(1024) NOT NULL DEFAULT '',
  `expiry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
  `email` varchar(1024) NOT NULL DEFAULT '',
  `password` varchar(1024) NOT NULL DEFAULT '',
  `first_name` varchar(1024) NOT NULL DEFAULT '',
  `last_name` varchar(1024) NOT NULL DEFAULT '',
  `address` varchar(1024) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `address`, `created_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(16, 'kamal@yahoo.com', '12345678', 'Kamal', 'Maisuriya', 'Navsari', '2020-11-28 14:54:50', NULL, NULL, NULL, NULL),
(22, 'askhay@yahoo.com', '123456', 'Akashay', 'Patel', 'Address', '2020-11-28 16:09:50', NULL, NULL, NULL, NULL),
(23, 'tejash@yahoo.com', '123456', 'Tejash', 'Patel', '', '2020-11-28 16:10:15', NULL, NULL, NULL, NULL),
(24, 'zinal@yahoo.com', '123456', 'Zinal', 'patel', 'Address here..', '2020-11-28 16:10:47', NULL, NULL, NULL, NULL),
(25, 'switi', '123456', 'Switi', 'Tandel', 'Bilimora\r\n', '2020-11-28 16:41:14', NULL, NULL, NULL, NULL),
(26, 'divyangi@yahoo.com', '123456', 'Divyangi', 'Talavya', 'Gandevi', '2020-11-28 16:41:51', NULL, NULL, NULL, NULL),
(28, 'akash@yahoo.com', '12345678', 'Akash', 'Patel', 'Address here...', '2020-11-28 17:09:19', NULL, NULL, NULL, NULL),
(29, 'admin', 'yourpass', 'KAMALKUMAR', 'MAISURIYA', 'Navsari\r\nKUMBHAR FALIYA', '2020-11-28 17:36:58', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
