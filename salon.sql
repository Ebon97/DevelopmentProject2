-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 12, 2019 at 02:03 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `customer_name` varchar(25) COLLATE utf8mb4_bin DEFAULT NULL,
  `customer_contact` varchar(25) COLLATE utf8mb4_bin DEFAULT NULL,
  `staffs_id` int(11) DEFAULT NULL,
  `services_booked` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time_expected` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `price_final` decimal(10,2) DEFAULT NULL,
  `cancelled` tinyint(1) DEFAULT '0',
  `cancellation_reason` text COLLATE utf8mb4_bin,
  `lastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customers_id` (`customers_id`),
  KEY `staffs_id` (`staffs_id`),
  KEY `services_booked` (`services_booked`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_Name` varchar(25) COLLATE utf8mb4_bin DEFAULT NULL,
  `last_Name` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `joined_since` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rec_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rec_by` (`rec_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `products_category_id` int(11) DEFAULT NULL,
  `manufacturer` varchar(60) COLLATE utf8mb4_bin DEFAULT NULL,
  `type_of_use` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `unitPrice` decimal(10,2) NOT NULL,
  `quantity` int(6) NOT NULL,
  `dateAdded` datetime NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_name` (`product_name`),
  KEY `products_category_id` (`products_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `products_category`
--

DROP TABLE IF EXISTS `products_category`;
CREATE TABLE IF NOT EXISTS `products_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` text COLLATE utf8mb4_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(40) COLLATE utf8mb4_bin NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_name` (`service_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------
-- INSERT INTO `services` (`id`, `service_name`, `duration`, `price`, `lastUpdated`) VALUES
-- (1, 'Wash & Cut(Male)', '60', '25', '2019-04-12 22:19:16'),
-- (2, 'Wash & Cut(Female)', '100', '45', '2019-04-12 22:19:16'),
-- (3, 'Wash & Cut(Children)', '60', '15', '2019-04-12 22:19:16'),
-- (4, 'Hair Coloring', '180', '120', '2019-04-12 22:19:16'),
-- (5, 'Manicure', '60', '30', '2019-04-12 22:19:16'),
-- (6, 'Pedicure', '60', '50', '2019-04-12 22:19:16');
--
-- Table structure for table `services_booked`
--

DROP TABLE IF EXISTS `services_booked`;
CREATE TABLE IF NOT EXISTS `services_booked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `services_id` (`services_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
CREATE TABLE IF NOT EXISTS `staffs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) COLLATE utf8mb4_bin DEFAULT NULL UNIQUE,
  `first_name` varchar(25) COLLATE utf8mb4_bin DEFAULT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` char(60) DEFAULT NULL,
  `role` char(5) NOT NULL,
  `created_on` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `last_seen` datetime NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `schedules_id` int(11) NULL DEFAULT NULL,
  `account_status` char(1) NOT NULL DEFAULT '1',
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `schedules_id` (`schedules_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

INSERT INTO `staffs` (`id`, `user_name`, `first_name`, `last_name`, `mobile`, `password`, `role`, `created_on`, `last_login`, `last_seen`, `last_edited`, `schedules_id`, `account_status`, `deleted`) VALUES
(1, 'AdminDemo', 'Admin', 'Demo', '082333999', '$2y$10$xv9I14OlR36kPCjlTv.wEOX/6Dl7VMuWCl4vCxAVWP1JwYIaw4J2C', 'Super', '2019-04-12 22:19:16', '2019-04-18 16:47:21', '2019-04-18 17:28:09', '2019-04-18 16:28:09', NULL , '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffs_id` int(11) NOT NULL,
  `from` timestamp NULL DEFAULT NULL,
  `to` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staffs_id` (`staffs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `eventlog`
--

DROP TABLE IF EXISTS `eventlog`;
CREATE TABLE `eventlog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event` varchar(200) NOT NULL,
  `eventRowIdOrRef` varchar(20) DEFAULT NULL,
  `eventDesc` text,
  `eventTable` varchar(20) DEFAULT NULL,
  `staffInCharge` bigint(20) UNSIGNED NOT NULL,
  `eventTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

ALTER TABLE `appointments` ADD FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`);

ALTER TABLE `appointments` ADD FOREIGN KEY (`staffs_id`) REFERENCES `staffs` (`id`);

ALTER TABLE `appointments` ADD FOREIGN KEY (`services_booked`) REFERENCES `services_booked` (`id`);

ALTER TABLE `customers` ADD FOREIGN KEY (`rec_by`) REFERENCES `customers` (`id`);

ALTER TABLE `services_booked` ADD FOREIGN KEY (`services_id`) REFERENCES `services` (`id`);

ALTER TABLE `products` ADD FOREIGN KEY (`products_category_id`) REFERENCES `products_category` (`id`);

ALTER TABLE `staffs` ADD FOREIGN KEY (`schedules_id`) REFERENCES `schedules` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
