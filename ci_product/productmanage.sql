-- Adminer 4.8.1 MySQL 5.5.5-10.4.27-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `notebook` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `notebook`;

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `blog_cat_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` enum('Active','Block') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_cat_id` (`blog_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `blogs` (`id`, `blog_title`, `content`, `blog_cat_id`, `image`, `status`, `created`, `modified`) VALUES
(11,	'Pavan Mohankar',	'vgfgrt',	4,	'Screenshot_(2).png',	'Active',	'2024-08-28 11:35:53',	'0000-00-00 00:00:00'),
(12,	'aaaa',	'vgfgrt',	4,	'',	'Active',	'2024-08-28 16:04:56',	'0000-00-00 00:00:00'),
(13,	'bbb',	'vijay',	4,	'',	'Active',	'2024-08-28 16:06:03',	'0000-00-00 00:00:00'),
(14,	'ccccc',	'path',	10,	'',	'Active',	'2024-08-28 16:06:03',	'2024-08-28 16:09:22');

DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Active','Block') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `blog_categories` (`id`, `title`, `description`, `status`, `created`, `modified`) VALUES
(4,	'ljqdwew',	'quwdbuhaqs',	'Active',	'2024-06-19 07:38:31',	'2024-08-13 15:56:14'),
(6,	'lkqabhkba',	'xkqkja',	'Active',	'2024-08-13 15:55:53',	'0000-00-00 00:00:00'),
(10,	'Abc',	'Wwwwwwwwwwwwwwwwww',	'Active',	'2024-08-28 12:05:20',	'0000-00-00 00:00:00'),
(11,	'Bbbbbbbb',	'Cccccccccccccccc',	'Active',	'2024-08-28 12:05:20',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cities` (`id`, `token`, `state_id`, `country_id`, `city_name`, `status`, `created`, `modified`) VALUES
(3,	'9eaa704df5556b49a7d12f986d47dc27',	3,	3,	'Bbb',	'Active',	'2023-08-04 13:56:09',	'2024-08-23 14:32:23'),
(5,	'',	3,	2,	'Pokhara',	'Active',	'2024-08-13 15:42:44',	'2024-08-23 14:33:12'),
(8,	'',	1,	1,	'Thane',	'Active',	'2024-08-23 14:11:38',	'2024-08-23 14:33:19'),
(63,	'0a3377a93dc194d6e907e67528b2afc8',	3,	3,	'Lalitpur',	'Active',	'2024-08-28 17:40:39',	'0000-00-00 00:00:00'),
(64,	'2fa88b8280b5084f9b1ee88029f66288',	3,	2,	'Kathmandu',	'Active',	'2024-08-28 17:40:39',	'0000-00-00 00:00:00'),
(65,	'b22bf42f6aba882f492ec58e517b8bbc',	1,	1,	'beltarodi',	'Active',	'2024-08-28 17:40:39',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `country_flag` varchar(255) NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `countries` (`id`, `token`, `country_name`, `country_code`, `country_flag`, `status`, `created`, `modified`) VALUES
(1,	'7ca5d993fe3498a2efe47a7dc7a753a6',	'India',	'+91',	'indiaflag.jpg',	'Active',	'2023-08-04 13:55:20',	'2024-08-13 15:37:25'),
(2,	'',	'Nepal',	'+977',	'nepal4.jpg',	'Active',	'2024-08-12 12:17:06',	'0000-00-00 00:00:00'),
(3,	'',	'Australia',	'+61',	'australia.png',	'Active',	'2024-08-13 15:26:27',	'2024-08-13 15:37:15');

DROP TABLE IF EXISTS `guests`;
CREATE TABLE `guests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `hobby_id` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `details_about_guest` text NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `guests` (`id`, `token`, `user_id`, `name`, `email_address`, `address`, `dob`, `gender`, `country_id`, `state_id`, `city_id`, `hobby_id`, `photo`, `details_about_guest`, `status`, `created`, `modified`) VALUES
(2,	'869399cad845db0a96e2bc0fd100688e',	1,	'Pavan Mohankar',	'swapnil@gmail.com',	'At satgaon kinhala',	'0000-00-00',	'Male',	1,	1,	3,	'1, 3, 2',	'satya10.jpg',	'<p>jn nm&nbsp;</p>\r\n',	'Active',	'2024-08-23 12:27:20',	'0000-00-00 00:00:00'),
(3,	'f59567b9a756a31433fa2e16daa7cab3',	1,	'Vaibhav',	'vaibhav@gmail.com',	'At satgaon kinhala',	'0000-00-00',	'Male',	1,	1,	8,	'1, 3',	'demo6.jpg',	'<p>abcd</p>\r\n',	'Active',	'2024-08-23 16:45:55',	'0000-00-00 00:00:00'),
(4,	'31e496b6815cc98aa318760c88f543c5',	1,	'Ishu',	'ishu@gmail.com',	'ridhora east',	'0000-00-00',	'Female',	2,	3,	5,	' 1,  4',	'Screenshot_(2).png',	'hello\r\n',	'Block',	'2024-08-26 14:43:59',	'2024-08-26 14:46:05'),
(13,	'a354dd311245da527759140ee34b45e7',	1,	'Priti',	'priti@gmail.com',	'Nagpur',	'0000-00-00',	'Male',	1,	1,	8,	' 5',	'nepal.jpg',	'<p>Abc</p>\r\n',	'Active',	'2024-09-09 17:39:28',	'2024-09-09 17:47:48'),
(14,	'72733e33bc7a9a22b883f33edf227ce5',	2,	'Priti1',	'anamika@gmail.com',	'Nagpur',	'0000-00-00',	'Male',	1,	1,	8,	'5',	'',	'Abc',	'Active',	'2024-09-09 17:39:28',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `guest_logs`;
CREATE TABLE `guest_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `hobby_id` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `details_about_guest` text NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `hobbies`;
CREATE TABLE `hobbies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `hobby_title` varchar(255) NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hobbies` (`id`, `token`, `hobby_title`, `status`, `created`, `modified`) VALUES
(1,	'5f808e7cd6a0f6343905697c812f320e',	'Adventure',	'Active',	'2024-08-23 12:31:12',	'0000-00-00 00:00:00'),
(2,	'93ede9ab2011750760f91094a30c9517',	'Sketing',	'Active',	'2024-08-23 12:31:12',	'0000-00-00 00:00:00'),
(3,	'f83471d34827aadf16785cb954a9344a',	'Singing',	'Active',	'2024-08-23 12:31:12',	'0000-00-00 00:00:00'),
(4,	'6a67b96c7961f148ee207dda64b7be33',	'Dancing',	'Active',	'2024-08-26 12:11:25',	'0000-00-00 00:00:00'),
(5,	'5003af3c33c1fcf4c95cf7d336782ed0',	'Playing',	'Active',	'2024-08-26 12:11:25',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `leads`;
CREATE TABLE `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `status` enum('Active','Block') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `source_id` (`source_id`),
  KEY `stage_id` (`stage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `leads` (`id`, `source_id`, `stage_id`, `name`, `email`, `phone`, `status`, `created`, `modified`) VALUES
(1,	6,	6,	'oman',	'oman@gmail.com',	'09552307590',	'Active',	'2024-09-05 10:54:55',	'0000-00-00 00:00:00'),
(21,	6,	6,	'Vaidahi',	'vaidu@gmail.com',	'9765017100',	'Active',	'2024-09-09 11:16:01',	'0000-00-00 00:00:00'),
(22,	6,	6,	'Shubham',	'shubham@gmail.com',	'9552307590',	'Active',	'2024-09-09 11:16:01',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `lead_sources`;
CREATE TABLE `lead_sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Active','Block') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `lead_sources` (`id`, `source_title`, `description`, `status`, `created`, `modified`) VALUES
(6,	'Oijwdw',	'klqdbdchswb',	'Active',	'2024-06-18 05:33:14',	'2024-08-13 16:48:53'),
(7,	'pavan',	'cricket player',	'Active',	'2024-08-02 11:09:15',	'0000-00-00 00:00:00'),
(8,	'Abp New',	'kilvish',	'Active',	'2024-09-05 14:21:29',	'0000-00-00 00:00:00'),
(9,	'Ajtak',	'keltak',	'Active',	'2024-09-05 14:21:29',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `lead_stage`;
CREATE TABLE `lead_stage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Active','Block') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `lead_stage` (`id`, `s_title`, `description`, `status`, `created`, `modified`) VALUES
(6,	'qweetyui',	'asd',	'Active',	'2024-08-02 10:11:39',	'2024-08-02 10:52:54'),
(7,	'abcw',	'kjaxbkjwb',	'Active',	'2024-08-13 15:52:25',	'2024-08-13 15:52:48'),
(8,	'Bgmi',	'indian versin',	'Active',	'2024-09-05 14:31:42',	'0000-00-00 00:00:00'),
(9,	'Coc',	'globel',	'Active',	'2024-09-05 14:31:42',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `notices`;
CREATE TABLE `notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `notices` (`id`, `token`, `title`, `content`, `from_date`, `to_date`, `status`, `created`, `modified`) VALUES
(3,	'4d7cfc330aa1050e799882d6d5552af8',	'Test',	'test',	'2023-08-04',	'2023-08-12',	'Active',	'2023-08-04 13:58:08',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `notice_access_logs`;
CREATE TABLE `notice_access_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notice_id` int(11) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_sub_id` int(11) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` enum('Active','Block') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_sub_id` (`product_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `products` (`id`, `product_sub_id`, `product_name`, `description`, `price`, `image`, `status`, `created`, `modified`) VALUES
(1,	1,	'iponoe 12',	'expensive',	123,	'demo.jpg',	'Active',	'2024-09-05 10:56:07',	'0000-00-00 00:00:00'),
(2,	1,	'Iphone 14',	'expensive',	140000,	'satya3.jpg',	'Active',	'2024-09-05 14:06:22',	'2024-09-05 14:07:55');

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Active','Block') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `product_categories` (`id`, `category_name`, `description`, `status`, `created`, `modified`) VALUES
(1,	'apple',	'mack',	'Active',	'2024-07-31 21:26:21',	'2024-08-01 08:03:19'),
(2,	'vaibhav',	'Number one brand',	'Active',	'2024-08-13 15:44:13',	'2024-08-22 19:28:32'),
(3,	'Animation',	'toys',	'Active',	'2024-09-05 11:25:35',	'0000-00-00 00:00:00'),
(4,	'Tv',	'all compony toy',	'Active',	'2024-09-05 11:25:35',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `product_subcategories`;
CREATE TABLE `product_subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_category_id` int(11) NOT NULL,
  `subcategory_name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Active','Block') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_category_id` (`product_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `product_subcategories` (`id`, `product_category_id`, `subcategory_name`, `description`, `status`, `created`, `modified`) VALUES
(1,	1,	'iphone',	'chapri',	'Active',	'2024-08-01 10:32:26',	'2024-08-01 12:02:33'),
(3,	1,	'Lamps',	'chapri',	'Active',	'2024-09-05 12:49:28',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `footer_note` varchar(255) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `settings` (`id`, `token`, `title`, `logo`, `footer_note`, `tagline`, `created`, `modified`) VALUES
(1,	'3ea4b6cd805e9001a71358cda7948a59',	'GuestBook',	'08f3b0f7e9e075d95b8c561f8bdfc7b4.png',	'TBS Guestbook',	'GuestBook',	'2023-08-04 11:53:58',	'2023-08-04 13:57:29');

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `states` (`id`, `token`, `country_id`, `state_name`, `status`, `created`, `modified`) VALUES
(1,	'd45e559d0194b0ad7c8d1f3ef61a142f',	1,	'Maharashtra',	'Active',	'2023-08-04 13:55:32',	'2024-08-12 11:48:13'),
(2,	'8988e7069913dbd870df1d9d349ab40f',	1,	'Gujrat',	'Active',	'2023-08-04 13:55:40',	'0000-00-00 00:00:00'),
(3,	'4f69233dcfb0b15e0577cf4ef589e95c',	2,	'Gandaki',	'Active',	'2024-08-13 15:41:07',	'0000-00-00 00:00:00'),
(7,	'e67855ae594dcbd0f19dfd4670fe7b54',	1,	'Asam',	'Active',	'2024-08-26 13:10:20',	'0000-00-00 00:00:00'),
(8,	'5f57e4ab2ae4a794be0275f15d9bfa0c',	1,	'Goa',	'Active',	'2024-08-26 13:10:20',	'0000-00-00 00:00:00'),
(9,	'1a7e59e49139c155734148986de35f2c',	3,	'california',	'Active',	'2024-08-26 16:41:50',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `image` varchar(255) NOT NULL,
  `hobby` varchar(250) NOT NULL,
  `last_login` datetime NOT NULL,
  `last_ip` varchar(255) NOT NULL,
  `access_details` text NOT NULL,
  `role` enum('Admin','User','Guest') NOT NULL DEFAULT 'User',
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Pending',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `otp` varchar(100) NOT NULL,
  `token_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hobby` (`hobby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `token`, `name`, `email`, `number`, `password`, `dob`, `gender`, `image`, `hobby`, `last_login`, `last_ip`, `access_details`, `role`, `status`, `created`, `modified`, `otp`, `token_created`) VALUES
(1,	'12wjo2ndj2ndipdh',	'Pavan Mohankar',	'pavan@gmail.com',	'9552307590',	'pavan@2001',	'2001-05-05',	'Male',	'image.png',	'1',	'2024-09-09 16:30:30',	'::1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',	'Admin',	'Active',	'2024-08-23 12:22:04',	'2024-09-09 16:30:31',	'',	'0000-00-00 00:00:00'),
(2,	'c5c5932965fc8564ae792d22054acc03',	'swapnil agarkar',	'swapnil@gmail.com',	'1234567890',	'123',	'0000-00-00',	'Male',	'demo1.jpg',	' 1,  3',	'2024-09-09 16:27:34',	'::1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',	'User',	'Active',	'2024-08-23 16:46:51',	'2024-09-09 16:27:35',	'',	'0000-00-00 00:00:00'),
(3,	'4a7564b06605b86b143ff5d5db6740c7',	'ram',	'ram@gmail.com',	'937011896012',	'ram01',	'0000-00-00',	'Male',	'Screenshot_(6)1.png',	'3',	'0000-00-00 00:00:00',	'',	'',	'User',	'Active',	'2024-08-23 18:12:42',	'0000-00-00 00:00:00',	'',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `user_access_logs`;
CREATE TABLE `user_access_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_login` datetime NOT NULL,
  `user_logout` datetime NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `last_logout` datetime NOT NULL,
  `last_ip` varchar(255) NOT NULL,
  `access_details` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user_access_logs` (`id`, `user_id`, `user_login`, `user_logout`, `ip_address`, `last_login`, `last_logout`, `last_ip`, `access_details`, `created`, `modified`) VALUES
(8,	5,	'2023-09-05 10:36:12',	'2023-09-05 10:42:04',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-05 10:36:12',	'2023-09-05 10:42:04'),
(9,	8,	'2023-09-12 10:19:49',	'2024-07-07 09:21:07',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-12 10:19:49',	'2024-07-07 09:21:07'),
(10,	9,	'2023-09-12 13:16:54',	'2024-07-07 09:21:07',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-12 13:16:54',	'2024-07-07 09:21:07'),
(11,	9,	'2024-07-08 12:43:36',	'2024-07-08 12:45:48',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Chrome 126.0.0.0',	'2024-07-08 12:43:36',	'2024-07-08 12:45:48'),
(12,	8,	'2024-07-08 12:46:40',	'2024-07-10 18:21:33',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Chrome 126.0.0.0',	'2024-07-08 12:46:40',	'2024-07-10 18:21:33'),
(13,	8,	'2024-07-08 14:17:56',	'2024-07-10 18:21:33',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Chrome 126.0.0.0',	'2024-07-08 14:17:56',	'2024-07-10 18:21:33'),
(14,	8,	'2024-07-08 14:19:24',	'2024-07-10 18:21:33',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Chrome 126.0.0.0',	'2024-07-08 14:19:24',	'2024-07-10 18:21:33'),
(15,	4,	'2024-07-22 18:13:30',	'2024-07-25 10:49:18',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Chrome 126.0.0.0',	'2024-07-22 18:13:30',	'2024-07-25 10:49:18'),
(16,	2,	'2024-07-22 18:24:00',	'2024-07-25 10:49:18',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Chrome 126.0.0.0',	'2024-07-22 18:24:00',	'2024-07-25 10:49:18'),
(17,	10,	'2024-07-22 19:13:40',	'2024-07-25 10:49:18',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Chrome 126.0.0.0',	'2024-07-22 19:13:40',	'2024-07-25 10:49:18'),
(18,	10,	'2024-07-25 08:37:18',	'2024-07-26 10:40:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 08:37:18',	'2024-07-26 10:40:59'),
(19,	10,	'2024-07-25 08:38:00',	'2024-07-26 10:40:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 08:38:00',	'2024-07-26 10:40:59'),
(20,	10,	'2024-07-25 12:12:43',	'2024-07-26 10:40:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 12:12:43',	'2024-07-26 10:40:59'),
(21,	10,	'2024-07-25 12:14:56',	'2024-07-26 10:40:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 12:14:56',	'2024-07-26 10:40:59'),
(22,	10,	'2024-07-25 12:48:52',	'2024-07-26 10:40:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 12:48:52',	'2024-07-26 10:40:59'),
(23,	10,	'2024-07-25 12:51:29',	'2024-07-26 10:40:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 12:51:29',	'2024-07-26 10:40:59'),
(24,	10,	'2024-07-25 12:53:35',	'2024-07-26 10:40:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 12:53:35',	'2024-07-26 10:40:59'),
(25,	10,	'2024-07-25 13:00:01',	'2024-07-25 13:00:08',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 13:00:01',	'2024-07-25 13:00:08'),
(26,	10,	'2024-07-25 13:16:33',	'2024-07-26 10:40:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 13:16:33',	'2024-07-26 10:40:59'),
(27,	10,	'2024-07-25 14:21:18',	'2024-07-26 10:40:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 14:21:18',	'2024-07-26 10:40:59'),
(28,	10,	'2024-07-25 14:23:10',	'2024-07-25 14:32:43',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 14:23:10',	'2024-07-25 14:32:43'),
(29,	10,	'2024-07-25 14:23:10',	'2024-07-25 14:32:43',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 14:23:10',	'2024-07-25 14:32:43'),
(30,	10,	'2024-07-25 14:33:57',	'2024-07-25 14:34:11',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 14:33:57',	'2024-07-25 14:34:11'),
(31,	10,	'2024-07-25 14:36:46',	'2024-07-25 14:36:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 14:36:46',	'2024-07-25 14:36:59'),
(32,	10,	'2024-07-25 16:08:19',	'2024-07-26 10:40:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 16:08:19',	'2024-07-26 10:40:59'),
(33,	10,	'2024-07-25 18:18:29',	'2024-07-25 18:19:21',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 18:18:29',	'2024-07-25 18:19:21'),
(34,	11,	'2024-07-25 18:27:38',	'2024-07-26 10:40:59',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	'2024-07-25 18:27:38',	'2024-07-26 10:40:59'),
(35,	11,	'2024-07-25 18:41:36',	'2024-07-25 19:25:33',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Chrome 126.0.0.0',	'2024-07-25 18:41:36',	'2024-07-25 19:25:33'),
(36,	11,	'2024-07-26 10:41:34',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Chrome 127.0.0.0',	'2024-07-26 10:41:34',	'0000-00-00 00:00:00'),
(37,	11,	'2024-07-26 11:27:59',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-26 11:27:59',	'0000-00-00 00:00:00'),
(38,	11,	'2024-07-26 12:42:10',	'2024-07-26 14:57:26',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-26 12:42:10',	'2024-07-26 14:57:26'),
(39,	11,	'2024-07-26 14:57:32',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-26 14:57:32',	'0000-00-00 00:00:00'),
(40,	11,	'2024-07-26 15:14:22',	'2024-07-26 15:26:07',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-26 15:14:22',	'2024-07-26 15:26:07'),
(41,	11,	'2024-07-26 15:27:40',	'2024-07-26 19:13:53',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-26 15:27:40',	'2024-07-26 19:13:53'),
(42,	11,	'2024-07-26 19:13:59',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-26 19:13:59',	'0000-00-00 00:00:00'),
(43,	10,	'2024-07-28 17:53:25',	'2024-07-28 17:55:48',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-28 17:53:25',	'2024-07-28 17:55:48'),
(44,	10,	'2024-07-29 11:58:17',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-29 11:58:17',	'0000-00-00 00:00:00'),
(45,	10,	'2024-07-29 12:02:39',	'2024-07-29 12:10:57',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-29 12:02:39',	'2024-07-29 12:10:57'),
(46,	10,	'2024-07-29 12:11:04',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-29 12:11:04',	'0000-00-00 00:00:00'),
(47,	14,	'2024-07-30 14:18:33',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-30 14:18:33',	'0000-00-00 00:00:00'),
(48,	10,	'2024-07-31 11:58:27',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-07-31 11:58:27',	'0000-00-00 00:00:00'),
(49,	10,	'2024-08-08 10:03:27',	'2024-08-21 14:17:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 10:03:27',	'2024-08-21 14:17:00'),
(50,	11,	'2024-08-08 10:07:31',	'2024-08-08 10:08:48',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 10:07:31',	'2024-08-08 10:08:48'),
(51,	1,	'2024-08-08 10:11:49',	'2024-08-08 10:15:02',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 10:11:49',	'2024-08-08 10:15:02'),
(52,	2,	'2024-08-08 10:15:17',	'2024-08-08 10:25:55',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 10:15:17',	'2024-08-08 10:25:55'),
(53,	1,	'2024-08-08 10:26:33',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 10:26:33',	'0000-00-00 00:00:00'),
(54,	2,	'2024-08-08 11:32:44',	'2024-08-08 11:33:08',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 11:32:44',	'2024-08-08 11:33:08'),
(55,	2,	'2024-08-08 11:33:15',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 11:33:15',	'0000-00-00 00:00:00'),
(56,	1,	'2024-08-08 12:15:50',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 12:15:50',	'0000-00-00 00:00:00'),
(57,	1,	'2024-08-08 13:03:04',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 13:03:05',	'0000-00-00 00:00:00'),
(58,	2,	'2024-08-08 18:45:55',	'2024-08-08 18:46:17',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 18:45:55',	'2024-08-08 18:46:17'),
(59,	1,	'2024-08-08 18:46:24',	'2024-08-08 19:08:48',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 18:46:24',	'2024-08-08 19:08:48'),
(60,	2,	'2024-08-08 19:08:56',	'2024-08-08 19:09:21',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 19:08:56',	'2024-08-08 19:09:21'),
(61,	1,	'2024-08-08 19:09:29',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-08 19:09:29',	'0000-00-00 00:00:00'),
(62,	1,	'2024-08-09 09:40:37',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-09 09:40:37',	'0000-00-00 00:00:00'),
(63,	1,	'2024-08-09 11:18:27',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-09 11:18:27',	'0000-00-00 00:00:00'),
(64,	1,	'2024-08-09 11:43:32',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-09 11:43:32',	'0000-00-00 00:00:00'),
(65,	1,	'2024-08-10 11:39:04',	'2024-08-10 11:40:01',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-10 11:39:04',	'2024-08-10 11:40:01'),
(66,	1,	'2024-08-10 11:40:23',	'2024-08-10 11:41:25',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-10 11:40:23',	'2024-08-10 11:41:25'),
(67,	4,	'2024-08-10 11:41:48',	'2024-08-10 11:41:54',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-10 11:41:48',	'2024-08-10 11:41:54'),
(68,	1,	'2024-08-11 11:43:19',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-11 11:43:19',	'0000-00-00 00:00:00'),
(69,	1,	'2024-08-12 10:13:07',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-12 10:13:07',	'0000-00-00 00:00:00'),
(70,	1,	'2024-08-12 17:39:36',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-12 17:39:36',	'0000-00-00 00:00:00'),
(71,	1,	'2024-08-12 17:41:36',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-12 17:41:36',	'0000-00-00 00:00:00'),
(72,	1,	'2024-08-13 09:36:14',	'2024-08-13 10:51:06',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-13 09:36:14',	'2024-08-13 10:51:06'),
(73,	2,	'2024-08-13 10:52:04',	'2024-08-13 10:59:54',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-13 10:52:04',	'2024-08-13 10:59:54'),
(74,	1,	'2024-08-13 11:00:01',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-13 11:00:01',	'0000-00-00 00:00:00'),
(75,	1,	'2024-08-13 17:45:37',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-13 17:45:37',	'0000-00-00 00:00:00'),
(76,	1,	'2024-08-14 09:54:28',	'2024-08-14 09:59:22',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-14 09:54:28',	'2024-08-14 09:59:22'),
(77,	1,	'2024-08-14 09:59:32',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-14 09:59:32',	'0000-00-00 00:00:00'),
(78,	1,	'2024-08-14 14:33:27',	'2024-08-14 16:11:44',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-14 14:33:27',	'2024-08-14 16:11:44'),
(79,	4,	'2024-08-14 16:12:28',	'2024-08-14 16:28:02',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-14 16:12:28',	'2024-08-14 16:28:02'),
(80,	1,	'2024-08-14 16:29:15',	'2024-08-14 19:18:41',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-14 16:29:15',	'2024-08-14 19:18:41'),
(81,	1,	'2024-08-14 19:18:54',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-14 19:18:54',	'0000-00-00 00:00:00'),
(82,	1,	'2024-08-15 18:28:34',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-15 18:28:34',	'0000-00-00 00:00:00'),
(83,	1,	'2024-08-16 09:50:18',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-16 09:50:18',	'0000-00-00 00:00:00'),
(84,	1,	'2024-08-16 17:38:14',	'2024-08-16 17:40:53',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-16 17:38:14',	'2024-08-16 17:40:53'),
(85,	1,	'2024-08-16 17:41:14',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-16 17:41:14',	'0000-00-00 00:00:00'),
(86,	1,	'2024-08-18 11:03:24',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 11:03:24',	'0000-00-00 00:00:00'),
(87,	2,	'2024-08-18 14:07:48',	'2024-08-18 14:09:02',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 14:07:48',	'2024-08-18 14:09:02'),
(88,	1,	'2024-08-18 14:09:13',	'2024-08-18 14:44:28',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 14:09:13',	'2024-08-18 14:44:28'),
(89,	2,	'2024-08-18 14:44:37',	'2024-08-18 14:45:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 14:44:37',	'2024-08-18 14:45:00'),
(90,	1,	'2024-08-18 14:45:12',	'2024-08-18 14:50:23',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 14:45:12',	'2024-08-18 14:50:23'),
(91,	3,	'2024-08-18 14:50:31',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 14:50:31',	'0000-00-00 00:00:00'),
(92,	3,	'2024-08-18 14:50:32',	'2024-08-18 14:50:58',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 14:50:32',	'2024-08-18 14:50:58'),
(93,	1,	'2024-08-18 14:52:16',	'2024-08-18 14:52:32',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 14:52:16',	'2024-08-18 14:52:32'),
(94,	4,	'2024-08-18 14:52:44',	'2024-08-18 14:53:57',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 14:52:44',	'2024-08-18 14:53:57'),
(95,	1,	'2024-08-18 14:54:09',	'2024-08-18 15:14:53',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 14:54:09',	'2024-08-18 15:14:53'),
(96,	1,	'2024-08-18 15:15:03',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 15:15:03',	'0000-00-00 00:00:00'),
(97,	1,	'2024-08-18 19:42:54',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-18 19:42:54',	'0000-00-00 00:00:00'),
(98,	1,	'2024-08-19 09:58:42',	'2024-08-19 10:02:08',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-19 09:58:42',	'2024-08-19 10:02:08'),
(99,	1,	'2024-08-19 10:12:26',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-19 10:12:26',	'0000-00-00 00:00:00'),
(100,	1,	'2024-08-20 10:07:02',	'2024-08-20 16:01:21',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-20 10:07:02',	'2024-08-20 16:01:21'),
(101,	1,	'2024-08-20 16:56:11',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-20 16:56:11',	'0000-00-00 00:00:00'),
(102,	1,	'2024-08-21 10:49:50',	'2024-08-21 10:58:02',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-21 10:49:50',	'2024-08-21 10:58:02'),
(103,	1,	'2024-08-21 10:58:19',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-21 10:58:19',	'0000-00-00 00:00:00'),
(104,	1,	'2024-08-21 14:17:10',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-21 14:17:10',	'0000-00-00 00:00:00'),
(105,	1,	'2024-08-22 12:58:15',	'2024-08-22 14:09:36',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-22 12:58:15',	'2024-08-22 14:09:36'),
(106,	4,	'2024-08-22 14:09:44',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-22 14:09:44',	'0000-00-00 00:00:00'),
(107,	1,	'2024-08-22 16:34:46',	'2024-08-22 19:36:57',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-22 16:34:46',	'2024-08-22 19:36:57'),
(108,	1,	'2024-08-23 09:32:55',	'2024-08-23 10:58:36',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-23 09:32:55',	'2024-08-23 10:58:36'),
(109,	1,	'2024-08-23 10:58:43',	'2024-08-23 12:22:36',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-23 10:58:43',	'2024-08-23 12:22:36'),
(110,	1,	'2024-08-23 12:23:01',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-23 12:23:01',	'0000-00-00 00:00:00'),
(111,	1,	'2024-08-24 15:33:56',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-24 15:33:56',	'0000-00-00 00:00:00'),
(112,	2,	'2024-08-25 08:33:45',	'2024-08-25 08:34:11',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-25 08:33:45',	'2024-08-25 08:34:11'),
(113,	1,	'2024-08-25 08:34:34',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-25 08:34:34',	'0000-00-00 00:00:00'),
(114,	1,	'2024-08-26 09:52:22',	'2024-08-26 12:36:11',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-26 09:52:22',	'2024-08-26 12:36:11'),
(115,	1,	'2024-08-26 12:47:44',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-26 12:47:44',	'0000-00-00 00:00:00'),
(116,	1,	'2024-08-28 10:16:45',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-28 10:16:45',	'0000-00-00 00:00:00'),
(117,	1,	'2024-08-28 15:04:10',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'2024-08-28 15:04:10',	'0000-00-00 00:00:00'),
(118,	1,	'2024-09-05 10:54:04',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',	'2024-09-05 10:54:04',	'0000-00-00 00:00:00'),
(119,	1,	'2024-09-05 20:52:13',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',	'2024-09-05 20:52:13',	'0000-00-00 00:00:00'),
(120,	1,	'2024-09-09 09:46:42',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',	'2024-09-09 09:46:42',	'0000-00-00 00:00:00'),
(121,	1,	'2024-09-09 14:36:59',	'2024-09-09 14:42:20',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',	'2024-09-09 14:36:59',	'2024-09-09 14:42:20'),
(122,	1,	'2024-09-09 14:49:23',	'2024-09-09 16:25:52',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',	'2024-09-09 14:49:23',	'2024-09-09 16:25:52'),
(123,	2,	'2024-09-09 16:27:34',	'2024-09-09 16:29:43',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',	'2024-09-09 16:27:34',	'2024-09-09 16:29:43'),
(124,	1,	'2024-09-09 16:30:30',	'0000-00-00 00:00:00',	'::1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',	'2024-09-09 16:30:30',	'0000-00-00 00:00:00');

-- 2024-09-10 05:11:23
