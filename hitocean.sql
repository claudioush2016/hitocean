-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 11, 2022 at 07:17 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hitocean`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `avg` double UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id`, `name`, `avg`, `created_at`, `updated_at`) VALUES
(1, 'Cuerpo a cuierpo', NULL, '2022-09-11 06:27:27', '2022-09-11 06:27:27'),
(2, 'A distancia', 0.8, '2022-09-11 06:27:27', '2022-09-11 06:27:27'),
(3, 'Ulti', 2, '2022-09-11 06:27:46', '2022-09-11 06:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type_id` int UNSIGNED NOT NULL,
  `attack` int UNSIGNED NOT NULL,
  `deff` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `type_id`, `attack`, `deff`, `created_at`, `updated_at`) VALUES
(1, 'Botas Defensiva', 1, 0, 5, '2022-09-11 06:29:14', '2022-09-11 06:29:14'),
(2, 'Botas Ofensivas', 1, 3, 0, '2022-09-11 06:29:14', '2022-09-11 06:29:14'),
(3, 'Armadura Mixta', 2, 5, 5, '2022-09-11 06:33:22', '2022-09-11 06:33:22'),
(4, 'Armadura Ligera', 2, 4, 1, '2022-09-11 06:33:22', '2022-09-11 06:33:22'),
(5, 'Porra', 3, 6, 0, '2022-09-11 06:33:57', '2022-09-11 06:33:57'),
(6, 'Espada corta', 3, 5, 3, '2022-09-11 06:33:57', '2022-09-11 06:33:57'),
(7, 'Espada Larga', 3, 6, 1, '2022-09-11 06:34:30', '2022-09-11 06:34:30'),
(8, 'Botas Epicas', 1, 8, 8, '2022-09-11 15:12:29', '2022-09-11 18:15:47'),
(9, 'Armadura Epica', 2, 8, 8, '2022-09-11 15:14:01', '2022-09-11 15:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

DROP TABLE IF EXISTS `item_type`;
CREATE TABLE IF NOT EXISTS `item_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Botas', '2022-09-11 06:32:44', '2022-09-11 06:32:44'),
(2, 'Armadura', '2022-09-11 06:32:44', '2022-09-11 06:32:44'),
(3, 'Arma', '2022-09-11 06:32:57', '2022-09-11 06:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pj_type` int UNSIGNED NOT NULL,
  `life` int NOT NULL DEFAULT '100',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `pj_type`, `life`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@prueba.com', '123456', 1, 1000, '2022-09-11 05:37:17', '2022-09-11 05:37:17'),
(6, 'player 2', 'player2@gmail.com', NULL, 2, -11, '2022-09-11 18:15:11', '2022-09-11 18:15:11'),
(2, 'claudio', 'claudiocabrera12@gmail.com', NULL, 1, 88, '2022-09-11 06:09:14', '2022-09-11 06:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_action`
--

DROP TABLE IF EXISTS `user_action`;
CREATE TABLE IF NOT EXISTS `user_action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `action_id` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_action`
--

INSERT INTO `user_action` (`id`, `user_id`, `action_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-09-11 17:13:49', '2022-09-11 17:13:49'),
(2, 1, 2, '2022-09-11 17:14:03', '2022-09-11 17:14:03'),
(3, 1, 1, '2022-09-11 17:14:34', '2022-09-11 17:14:34'),
(4, 1, 3, '2022-09-11 17:15:25', '2022-09-11 17:15:25'),
(5, 1, 2, '2022-09-11 17:15:32', '2022-09-11 17:15:32'),
(6, 1, 1, '2022-09-11 17:15:40', '2022-09-11 17:15:40'),
(7, 1, 3, '2022-09-11 17:15:44', '2022-09-11 17:15:44'),
(8, 1, 2, '2022-09-11 17:22:24', '2022-09-11 17:22:24'),
(9, 1, 1, '2022-09-11 17:22:31', '2022-09-11 17:22:31'),
(10, 1, 3, '2022-09-11 17:22:34', '2022-09-11 17:22:34'),
(11, 2, 2, '2022-09-11 17:23:09', '2022-09-11 17:23:09'),
(12, 1, 3, '2022-09-11 17:23:13', '2022-09-11 17:23:13'),
(13, 2, 1, '2022-09-11 18:16:31', '2022-09-11 18:16:31'),
(14, 2, 3, '2022-09-11 18:16:37', '2022-09-11 18:16:37'),
(15, 2, 1, '2022-09-11 18:16:42', '2022-09-11 18:16:42'),
(16, 2, 3, '2022-09-11 18:16:45', '2022-09-11 18:16:45'),
(17, 2, 1, '2022-09-11 18:16:48', '2022-09-11 18:16:48'),
(18, 2, 3, '2022-09-11 18:16:51', '2022-09-11 18:16:51'),
(19, 2, 1, '2022-09-11 18:16:54', '2022-09-11 18:16:54'),
(20, 2, 1, '2022-09-11 18:16:57', '2022-09-11 18:16:57'),
(21, 2, 1, '2022-09-11 18:17:01', '2022-09-11 18:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_equipament`
--

DROP TABLE IF EXISTS `user_equipament`;
CREATE TABLE IF NOT EXISTS `user_equipament` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `item_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_equipament`
--

INSERT INTO `user_equipament` (`id`, `user_id`, `item_id`, `created_at`, `updated_at`) VALUES
(1, 2, 8, '2022-09-11 15:29:48', '2022-09-11 15:29:48'),
(2, 2, 3, '2022-09-11 15:58:19', '2022-09-11 15:58:19'),
(3, 2, 1, '2022-09-11 18:54:56', '2022-09-11 18:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `icon` varchar(150) DEFAULT NULL,
  `active` tinyint UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `icon`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Human', 'humano.png', 1, '2022-09-11 06:13:36', '2022-09-11 06:13:36'),
(2, 'Zombie', 'zombie.png', 1, '2022-09-11 06:13:36', '2022-09-11 06:13:36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
