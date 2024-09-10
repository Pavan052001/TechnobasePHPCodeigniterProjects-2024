-- Adminer 4.8.1 MySQL 5.5.5-10.4.27-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `loginmodule` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `loginmodule`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `attempts` tinyint(4) NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Pending',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `attempts`, `status`, `created`, `modified`) VALUES
(1,	'Pavan Mohankar',	'pavan@gmail.com',	'9552307590',	'pavan@2001',	0,	'Active',	'2024-08-23 12:22:04',	'2024-08-28 15:04:10');

-- 2024-09-10 05:04:12
