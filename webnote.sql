-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 07, 2025 at 02:04 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webnote`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_general_ci,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`, `status`, `create_date`, `last_login`) VALUES
(1, 'Hamidreza', 'hamid@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '09115454454', 1, '2025-06-01 17:20:02', '2025-06-01 13:49:19'),
(2, 'arya', 'arya@test.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 0, '2025-06-01 20:48:41', '0000-00-00 00:00:00'),
(3, 'mmd', 'mmd@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, '2025-06-01 21:20:03', '0000-00-00 00:00:00'),
(4, 'mmdreza', 'mr@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, '2025-06-02 15:32:18', '0000-00-00 00:00:00'),
(5, 'ahmad', 'ahmad@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 0, '2025-06-07 17:23:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_note`
--

DROP TABLE IF EXISTS `user_note`;
CREATE TABLE IF NOT EXISTS `user_note` (
  `note_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `note_tittle` varchar(80) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pin_unpin` tinyint(1) DEFAULT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`note_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_note`
--

INSERT INTO `user_note` (`note_id`, `user_id`, `note_tittle`, `note_content`, `pin_unpin`, `img_path`, `create_date`, `edit_date`) VALUES
(1, 1, 'this is my first note!', 'I hope it works', 0, NULL, '2025-06-01 17:43:22', '2025-06-01 17:43:22'),
(14, 1, 'adsada', 'adasd', 0, 'file-1749129033.jpg', '2025-06-05 16:40:33', '2025-06-05 16:40:33'),
(22, 1, 'hello', 'hi', 1, 'file-1749304213.jpg', '2025-06-07 17:20:13', '2025-06-07 17:20:13'),
(23, 5, 'testing', 'testing', 0, 'file-1749304702.jpg', '2025-06-07 17:28:22', '2025-06-07 17:28:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
