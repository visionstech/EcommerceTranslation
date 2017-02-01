-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2017 at 05:58 PM
-- Server version: 5.5.35-1ubuntu1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eqho_translation`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `from_lang_id` int(11) DEFAULT NULL,
  `to_lang_id` int(11) DEFAULT NULL,
  `language_price` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `package_price` varchar(255) DEFAULT NULL,
  `final_price` varchar(255) DEFAULT NULL,
  `language_package` varchar(100) DEFAULT NULL,
  `translation_purpose` varchar(255) DEFAULT NULL,
  `status` enum('pending','translated') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `order_id`, `from_lang_id`, `to_lang_id`, `language_price`, `total_price`, `package_price`, `final_price`, `language_package`, `translation_purpose`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 'ch_19iMgGCYdZYuUBVoxrmI02rA', 1, 4, '824', '824', '0.12', '824.12', 'Basic', 'Everyday use', 'pending', '2017-02-01 06:23:45', '2017-02-01 06:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `application_files`
--

CREATE TABLE IF NOT EXISTS `application_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) DEFAULT NULL,
  `application_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(50) DEFAULT NULL,
  `status` enum('pending','status') DEFAULT 'pending',
  `translated_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `application_files`
--

INSERT INTO `application_files` (`id`, `order_id`, `application_id`, `user_id`, `file_name`, `file_path`, `status`, `translated_file`, `created_at`, `updated_at`) VALUES
(19, 'ch_19iMgGCYdZYuUBVoxrmI02rA', 6, 1, '2c03d9e76d3fb03cfe2c3300e451b7bf385e2536_text.txt', '/uploads/files', 'pending', NULL, '2017-02-01 06:23:45', '2017-02-01 06:23:45'),
(20, 'ch_19iMgGCYdZYuUBVoxrmI02rA', 6, 1, '25YMCb1QJn_Print view - phpMyAdmin 4.0.pdf', '/uploads/files', 'pending', NULL, '2017-02-01 06:23:45', '2017-02-01 06:23:45'),
(21, 'ch_19iMgGCYdZYuUBVoxrmI02rA', 6, 1, 'JTlcDiLyaK_1.pdf', '/uploads/files', 'pending', NULL, '2017-02-01 06:23:45', '2017-02-01 06:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `content` text,
  `file` varchar(255) DEFAULT NULL,
  `file_path` varchar(100) DEFAULT NULL,
  `content_words` varchar(100) DEFAULT NULL,
  `total_words` int(11) DEFAULT NULL,
  `status` enum('Active','Trashed','Deleted') NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `content`, `file`, `file_path`, `content_words`, `total_words`, `status`, `session_id`, `created_at`, `updated_at`) VALUES
(10, 1, 'dfg dgdfg dfgdfg dfg dfg dfg dfgdfg df', NULL, NULL, '8', 3323, 'Active', '12ccb5e2820f9a361a59657d75647375969595ce', '2017-02-01 11:47:04', '2017-01-30 01:11:02'),
(21, 1, NULL, '25YMCb1QJn_Print view - phpMyAdmin 4.0.pdf', 'uploads/files', '947', 956, 'Trashed', 'ffe86f195395abaad485dd86cbe00884845deb95', '2017-01-31 04:44:40', '2017-01-30 23:14:40'),
(22, 1, NULL, 'JTlcDiLyaK_1.pdf', 'uploads/files', '1105', 1114, 'Active', 'ffe86f195395abaad485dd86cbe00884845deb95', '2017-01-30 23:15:44', '2017-01-30 23:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `cart_languages`
--

CREATE TABLE IF NOT EXISTS `cart_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(200) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `from_language_id` int(11) DEFAULT NULL,
  `to_language_id` tinytext,
  `language_package` varchar(100) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `status` enum('Active','Trashed','Deleted') DEFAULT 'Active',
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cart_languages`
--

INSERT INTO `cart_languages` (`id`, `user_id`, `session_id`, `from_language_id`, `to_language_id`, `language_package`, `purpose`, `status`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(1, '1', 'ca6e12b4f7c1766ce1a16bd0e8dcd4576ac7c560', 1, '4', '1', 'Everyday use', 'Active', NULL, NULL, '2017-01-30 22:49:52', '2017-02-01 11:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `short` char(4) DEFAULT NULL,
  `status` enum('Active','Deleted') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `short`, `status`, `created_at`, `updated_at`, `updated_by`, `updated_ip`) VALUES
(1, 'English', 'en', 'Active', '2016-12-19 04:47:36', NULL, NULL, NULL),
(2, 'German', 'de', 'Active', '2016-12-19 04:47:36', NULL, NULL, NULL),
(4, 'Dutch', 'nl', 'Active', '2016-12-19 04:47:36', NULL, NULL, NULL),
(5, 'Italian', 'it', 'Active', '2016-12-19 04:47:36', NULL, NULL, NULL),
(8, 'Russian', 'ru', 'Active', '2016-12-19 04:47:36', NULL, NULL, NULL),
(9, 'Japanese', 'ja', 'Active', '2016-12-19 04:47:36', NULL, NULL, NULL),
(21, 'Indonesian', 'id', 'Active', '2016-12-19 04:47:36', NULL, NULL, NULL),
(40, 'Hindi', 'hi', 'Active', '2016-12-19 04:47:36', NULL, NULL, NULL),
(46, 'Urdu', 'ur', 'Active', '2016-12-19 04:48:28', NULL, NULL, NULL),
(48, 'Traditional Chinese (Hong Kong)', 'hk', 'Active', '2016-12-19 04:48:35', NULL, NULL, NULL),
(49, 'Simplified Chinese', 'ch', 'Active', '2016-12-19 04:48:39', NULL, NULL, NULL),
(50, 'Traditional Chinese (Taiwan)', 'ta', 'Active', '2016-12-19 04:48:44', NULL, NULL, NULL),
(54, 'French (Canada)', 'fc', 'Active', '2016-12-19 04:48:58', NULL, NULL, NULL),
(55, 'Spanish (European)', 'su', 'Active', '2016-12-19 04:49:00', NULL, NULL, NULL),
(56, 'Portuguese (European)', 'PE', 'Active', '2016-12-19 04:49:04', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language_packages`
--

CREATE TABLE IF NOT EXISTS `language_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `price_per_word` varchar(50) DEFAULT NULL,
  `status` enum('Active','Deleted') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `language_packages`
--

INSERT INTO `language_packages` (`id`, `name`, `description`, `price_per_word`, `status`, `created_at`, `updated_at`, `updated_by`, `updated_ip`) VALUES
(1, 'Basic', '<p>Everyday use</p>\r\n\r\n<ul>\r\n	<li>Emails</li>\r\n	<li>Internal Communications</li>\r\n	<li>Letters</li>\r\n	<li>Personal Translation</li>\r\n</ul>\r\n\r\n<p>General online</p>\r\n\r\n<ul>\r\n	<li>Social Media</li>\r\n	<li>Product Descriptions</li>\r\n	<li>User-Generated Content</li>\r\n</ul>\r\n', '0.12', 'Active', '2017-01-31 06:22:49', '2017-01-31 00:52:49', 1, '127.0.0.1'),
(2, 'Professional', '<p>Business</p>\r\n\r\n<ul>\r\n	<li>Presentations</li>\r\n	<li>Reports</li>\r\n	<li>User Guides</li>\r\n	<li>Manuals</li>\r\n</ul>\r\n', '0.18', 'Active', '2017-01-31 06:45:41', '2017-01-31 01:15:41', 1, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `language_prices`
--

CREATE TABLE IF NOT EXISTS `language_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` int(11) DEFAULT NULL,
  `destination` int(11) DEFAULT NULL,
  `price_per_word` varchar(100) DEFAULT NULL,
  `status` enum('Active','Deleted') DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `language_prices`
--

INSERT INTO `language_prices` (`id`, `source`, `destination`, `price_per_word`, `status`, `created_at`, `updated_by`, `updated_ip`, `updated_at`) VALUES
(1, 1, 2, '0.5', 'Active', '2017-01-22 22:54:37', 1, '127.0.0.1', '2017-01-23 03:30:45'),
(2, 1, 4, '0.4', 'Active', '2017-01-23 00:59:38', NULL, NULL, NULL),
(3, 2, 4, '0.7', 'Active', '2017-01-23 23:56:12', 1, '127.0.0.1', '2017-01-27 06:07:32'),
(4, 3, 11, '0.13', 'Active', '2017-01-27 06:46:43', 1, '127.0.0.1', '2017-01-27 06:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `transaction_id`, `user_id`, `payment_type`, `payment_status`, `created_at`, `updated_at`) VALUES
(14, 'ch_19iMgGCYdZYuUBVoxrmI02rA', 1, NULL, 'success', '2017-02-01 06:23:45', '2017-02-01 06:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL,
  `status` enum('Active','Deleted') DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `status`, `created_at`, `updated_at`, `updated_by`, `updated_ip`) VALUES
(1, 'Superadmin', 'Active', '2016-12-18 20:38:14', '2017-01-11 10:49:43', 1, '127.0.0.1'),
(2, 'Management', 'Active', '2016-12-18 20:38:14', NULL, NULL, NULL),
(3, 'Customer', 'Active', '2016-12-20 18:30:00', NULL, NULL, NULL),
(4, 'Translator', 'Active', '2016-12-20 18:30:00', NULL, NULL, NULL),
(6, 'TER1', 'Deleted', '2017-01-24 00:16:31', '2017-01-27 11:36:03', 1, '127.0.0.1'),
(7, 'test 1', 'Deleted', '2017-01-27 06:41:53', '2017-01-27 12:12:32', 1, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(50) DEFAULT NULL,
  `image_title` varchar(100) DEFAULT NULL,
  `section_type` varchar(50) NOT NULL,
  `status` enum('Active','Deleted') DEFAULT 'Active',
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `title`, `description`, `image`, `image_path`, `image_title`, `section_type`, `status`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(7, 'Smart technology means you translate once', 'Never pay for the same sentence to be translated twice. Our smart technology recognizes repeated text and only serves new sentences to the translator so you save time and costs', NULL, NULL, NULL, 'our-promises', 'Active', NULL, NULL, '2017-01-18 04:45:26', '2017-01-18 04:45:26'),
(8, 'A 4-stage human-centric process', 'Personal Translation Assistant assigns the right linguist to your job.A native-speaking subject-specialist translator is placed according to subject type. A senior editor fine-tunes the translation, paying close attention to accuracy and style. A wiz-kid layout artist formats your file.', NULL, '/uploads', NULL, 'our-promises', 'Active', 1, '127.0.0.1', '2017-01-18 04:45:42', '2017-01-27 07:43:19'),
(9, 'Guaranteed quality, no questions asked', 'We’re proud of our work so we guarantee the quality.', NULL, NULL, NULL, 'our-promises', 'Active', 1, '127.0.0.1', '2017-01-18 04:45:55', '2017-01-18 05:28:47'),
(15, 'SIGN-UP', 'Sign-up by completing some basic details. It’s free to join and you will only be required to provide a credit card when you are ready to place an order', 'how-it-works_I2TeBr26BGYVcsZ1JgxZ.png', '/uploads', 'approved', 'how-it-works', 'Active', 1, '127.0.0.1', '2017-01-18 06:38:56', '2017-01-19 04:45:57'),
(16, 'Upload', 'Upload your files, or copy paste your text, select your languages and the purpose of your translation and view your online quote', '', '/uploads', '', 'how-it-works', 'Active', 1, '127.0.0.1', '2017-01-18 06:39:56', '2017-01-19 04:45:21'),
(17, 'Pay', 'Pay via a secure 3rd party payment gateway. Put your feet up and wait for the translation to arrive', 'how-it-works_W2nPZYk96cJRUoMiJPI1.png', '/uploads', 'approved', 'how-it-works', 'Active', 1, '127.0.0.1', '2017-01-18 06:41:03', '2017-01-19 04:55:58'),
(20, 'dfdgdfg', 'dfgdfgfdger4t ergcv fg', NULL, '/uploads', NULL, 'faqs', 'Deleted', 1, '127.0.0.1', '2017-01-18 23:37:08', '2017-01-27 07:17:43'),
(21, 'dfgdf', 'dfg dfgfdgfdg', NULL, NULL, NULL, 'faqs', 'Active', NULL, NULL, '2017-01-18 23:41:18', '2017-01-18 23:41:18'),
(22, 'sdfdsfsd', 'fsdfsdfsf', NULL, NULL, NULL, 'faqs', 'Active', NULL, NULL, '2017-01-19 00:15:31', '2017-01-19 00:15:31'),
(36, 'Words Translated', '751,457,548', 'eqho-by-numbers_zjmt1id4ecdQYM9tYpb8.png', NULL, NULL, 'eqho-by-numbers', 'Active', NULL, NULL, '2017-01-19 07:00:06', '2017-01-19 07:00:06'),
(37, 'Minutes of Multilingual Audio', '1,116,796', 'eqho-by-numbers_twu94tPTqo6mqucptwzA.png', '/uploads', NULL, 'eqho-by-numbers', 'Active', 1, '127.0.0.1', '2017-01-19 07:00:42', '2017-01-24 00:04:48'),
(38, 'Pages Formatted', '953,629', 'eqho-by-numbers_kIngWukV1CbZdva3U8aJ.png', NULL, NULL, 'eqho-by-numbers', 'Active', NULL, NULL, '2017-01-19 07:01:07', '2017-01-19 07:01:07'),
(39, 'Receive Instant Quotations', 'Copy paste your text or upload text-based files, and our proprietary counter will calculate your project ', 'features_QNLGt3Baaqk9PlFjVHFX.png', NULL, NULL, 'features', 'Active', NULL, NULL, '2017-01-19 07:08:56', '2017-01-19 07:08:56'),
(40, 'Intuitive User Interface', 'Review everything with ease within an easy to use mobile friendly dashboard', 'features_gvUIzt5dxn0R6n83StZT.png', NULL, NULL, 'features', 'Active', NULL, NULL, '2017-01-19 07:09:37', '2017-01-19 07:09:37'),
(41, 'Track your Project Progress', 'Track your project from translation to review, revision and completion', 'features_JjrDHdWr3EswbXFfqv9Q.png', '/uploads', NULL, 'features', 'Active', 1, '127.0.0.1', '2017-01-19 07:10:13', '2017-01-27 07:02:20'),
(42, 'Build and Maintain Lists of your Favorite Translators', 'Maintain translator IDs to enable you to reuse them on your future projects', 'features_3XYnhRnUeHTh6IDmfkmu.png', '/uploads', NULL, 'features', 'Active', 1, '127.0.0.1', '2017-01-19 07:12:43', '2017-01-24 00:27:46'),
(43, 'Receive Real Time Alerts when it’s Review Time', 'Receive real-time alerts when the translations and amendments are completed', 'features_rqnyseqAGFncAkHXYgk4.png', NULL, NULL, 'features', 'Active', NULL, NULL, '2017-01-19 07:13:18', '2017-01-19 07:13:18'),
(44, 'Maintain and Manage your Project Assets', 'Maintain your terminology glossaries, brand guides and other assets all in one place', 'features_o9NDAiBXJWnpGB3IWSsH.png', NULL, NULL, 'features', 'Active', NULL, NULL, '2017-01-19 07:13:56', '2017-01-19 07:13:56'),
(45, '', '', 'clients_PCctYorBfwOUSFyXh0oO.png', '/uploads', NULL, 'clients', 'Active', 1, '127.0.0.1', '2017-01-19 07:15:21', '2017-01-20 00:10:51'),
(46, '', '', 'clients_ABj1mcnaJJxd4e15Emrt.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:17:58', '2017-01-19 07:17:58'),
(47, '', '', 'clients_TwmGz7BLY1gyDAzZMX9w.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:18:04', '2017-01-27 06:18:32'),
(48, '', '', 'clients_GGKLVLRA8i41PqIoxjav.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:18:11', '2017-01-27 06:17:27'),
(49, '', '', 'clients_TgcjKpJeViOEBgijufKx.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:18:17', '2017-01-19 07:18:17'),
(50, '', '', 'clients_5bTiG3mBcxlt3fcCJiQg.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:18:28', '2017-01-19 07:18:28'),
(51, '', '', 'clients_3MszWKUu3H5wpcbpjmVq.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:18:33', '2017-01-19 07:18:33'),
(52, '', '', 'clients_ykB5IDiHaWFZzSsxgT8w.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:18:39', '2017-01-19 07:18:39'),
(53, '', '', 'clients_qsWdHpv3JytEdz5zpksX.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:18:51', '2017-01-19 07:18:51'),
(54, '', '', 'clients_40ARRMvOeNkGeHeGWFgC.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:18:56', '2017-01-19 07:18:56'),
(55, '', '', 'clients_kHj9YFnHIXa76YKHglF0.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:19:01', '2017-01-19 07:19:01'),
(56, '', '', 'clients_fifk4hbk7QoOLA6qp4y8.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:19:07', '2017-01-19 07:19:07'),
(57, '', '', 'clients_j7cCsnStCvCFi4feP9JS.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:19:13', '2017-01-19 07:19:13'),
(58, '', '', 'clients_O9kWQ2ddSU5SvK5F5Dc8.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:19:19', '2017-01-19 07:19:19'),
(59, '', '', 'clients_Tc359JkAeuq7KDrv2bJY.png', NULL, NULL, 'clients', 'Active', NULL, NULL, '2017-01-19 07:19:23', '2017-01-19 07:19:23'),
(62, '', '', 'banner-image_zBwYcIP8ym2psYXRKVfT.jpeg', '/uploads', NULL, 'banner-image', 'Active', 1, '127.0.0.1', '2017-01-19 23:18:42', '2017-01-19 23:20:25'),
(65, '', '', 'banner-bottom-logos_u3hZfVaNgv1z5rgRCMZZ.png', NULL, NULL, 'banner-bottom-logos', 'Active', NULL, NULL, '2017-01-19 23:55:32', '2017-01-27 07:09:27'),
(66, '', '', 'banner-bottom-logos_uxIApX8Vb5qF9IFoEPcU.png', NULL, NULL, 'banner-bottom-logos', 'Active', NULL, NULL, '2017-01-19 23:55:39', '2017-01-19 23:55:39'),
(67, '', '', 'banner-bottom-logos_aeglXZBjQODRBF0Tii6C.png', '/uploads', NULL, 'banner-bottom-logos', 'Active', 1, '127.0.0.1', '2017-01-19 23:55:47', '2017-01-24 00:28:07'),
(68, '', '', 'banner-bottom-logos_M6WBXlloLGQVV6gT5ScW.png', NULL, NULL, 'banner-bottom-logos', 'Active', NULL, NULL, '2017-01-19 23:55:54', '2017-01-19 23:55:54'),
(69, '', '', 'banner-bottom-logos_3R5ALRCpjbAavWSSMeoJ.png', NULL, NULL, 'banner-bottom-logos', 'Active', NULL, NULL, '2017-01-19 23:56:04', '2017-01-24 00:05:47'),
(70, '', '', 'banner-bottom-logos_FbWfLzWuLxYRhHyHebB0.png', NULL, NULL, 'banner-bottom-logos', 'Active', NULL, NULL, '2017-01-19 23:56:10', '2017-01-19 23:56:10'),
(71, '', '<h1>We are EQHO</h1>\r\n<p>Technology driven. Human powered. Quality guaranteed.</p>\r\n\r\n', '', '/uploads', NULL, 'banner-info', 'Active', 1, '127.0.0.1', '2017-01-20 01:27:27', '2017-01-20 02:13:22'),
(72, 'Home', '#home', '', NULL, NULL, 'header-menus', 'Active', NULL, NULL, '2017-01-20 02:27:45', '2017-01-20 02:27:45'),
(73, 'Our Promise', '#our-promise', '', NULL, NULL, 'header-menus', 'Active', NULL, NULL, '2017-01-20 02:28:08', '2017-01-20 02:28:08'),
(74, 'How it works', '#how-it-works', '', NULL, NULL, 'header-menus', 'Active', NULL, NULL, '2017-01-20 02:28:27', '2017-01-20 02:28:27'),
(75, 'testimonials', '#testimonials', '', NULL, NULL, 'header-menus', 'Active', NULL, NULL, '2017-01-20 02:28:49', '2017-01-20 02:28:49'),
(76, 'Faq', '#faq', '', NULL, NULL, 'header-menus', 'Active', NULL, NULL, '2017-01-20 02:28:59', '2017-01-20 02:28:59'),
(77, 'clients', '#clients', '', NULL, NULL, 'header-menus', 'Active', NULL, NULL, '2017-01-20 02:29:08', '2017-01-20 02:29:08'),
(78, 'Documents', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. \r\nLorem Ipsum has been the industry''s standard dummy text ever since the\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has\r\n', 'what-we-translate_0AGmCtgY1bjRKCZLDFTZ.png', '/uploads', NULL, 'what-we-translate', 'Active', 1, '127.0.0.1', '2017-01-20 03:28:44', '2017-01-24 00:33:34'),
(79, 'Website', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has', 'what-we-translate_BjsGQdgd2Whf7A524IFk.png', '/uploads', NULL, 'what-we-translate', 'Active', 1, '127.0.0.1', '2017-01-20 03:31:18', '2017-01-24 00:33:53'),
(80, 'Software', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has\r\n', 'what-we-translate_tq0o97v8dIbFg2dApRtj.png', '/uploads', NULL, 'what-we-translate', 'Active', 1, '127.0.0.1', '2017-01-20 03:31:48', '2017-01-24 00:33:24'),
(81, 'Mobile', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has\r\n', 'what-we-translate_71S8tOq9lh5UbimUdIaZ.png', '/uploads', NULL, 'what-we-translate', 'Active', 1, '127.0.0.1', '2017-01-20 03:32:24', '2017-01-24 00:33:42'),
(82, 'Multimedia', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has\r\n', 'what-we-translate_pgG312YTFdgQMBXKruzW.png', '/uploads', NULL, 'what-we-translate', 'Active', 1, '127.0.0.1', '2017-01-20 03:32:50', '2017-01-24 00:34:46'),
(83, '', '', 'header-image_Y1thKMaaDZWL0OUuDlDY.png', '/uploads', NULL, 'header-image', 'Active', 1, '127.0.0.1', '2017-01-20 03:51:00', '2017-01-27 07:14:15'),
(84, 'title testing12', 'Testing Description 12', '', '/uploads', NULL, 'faqs', 'Deleted', 1, '127.0.0.1', '2017-01-24 00:01:17', '2017-01-24 00:02:06'),
(85, '', 'testing', '', '/uploads', NULL, 'banner-info', 'Active', 1, '127.0.0.1', '2017-01-24 00:06:07', '2017-01-27 07:10:07'),
(86, 'tet', 'fg rgrg ', '', NULL, NULL, 'our-promises', 'Deleted', NULL, NULL, '2017-01-27 06:54:18', '2017-01-27 06:55:14'),
(87, 'title faq', 'desc', '', '/uploads', NULL, 'faqs', 'Active', 1, '127.0.0.1', '2017-01-27 06:57:37', '2017-01-27 06:57:55'),
(88, 'title', 'desc', '', '/uploads', NULL, 'eqho-by-numbers', 'Deleted', 1, '127.0.0.1', '2017-01-27 07:03:05', '2017-01-27 07:05:48'),
(89, '', '', 'banner-image_aJO1yzDUrWhKnatMK73b.png', '/uploads', 'Screenshot from 2016-12-15 18:56:30', 'banner-image', 'Deleted', 1, '127.0.0.1', '2017-01-27 07:08:22', '2017-01-27 07:08:45'),
(90, '', 'testing', '', '/uploads', NULL, 'banner-info', 'Deleted', 1, '127.0.0.1', '2017-01-27 07:09:37', '2017-01-27 07:10:00'),
(91, '', '', 'banner-image_LUVFOIZZ7bNmeeFQOTZb.png', '/uploads', 'pardot 24-nov', 'banner-image', 'Deleted', 1, '127.0.0.1', '2017-01-30 22:58:47', '2017-01-30 22:59:25'),
(92, '', 'testing sjdfhjksd fklsd fjsjk hdfjks dhfjks dhfkjsh d jfkhsd hfsjkd fhskjdh fjksdh fkjsd fhkjsd hfjksdhfjk sdfkj hsfkjhsdkfh sdj hfjbvjvbjksd vjksd kjcvsbcjksdbcjksdfjksd hfkdjh fkjsdhf kjs dhfkjsdfkjsdhfkj sdfjsdkjf hsdjkf skdj fhksjd hfjsd fhksdj fksdh fkjsd hfjksdh fkj shfjksdhf jksdvnmbvmxncb vmxnbcvmnxbcvjkxvbjkdvkjsdbvjksdvjks djckndcnjkkcjnksn cn c cnsmn cm,cnmzcmxnbzcmnxb mnxbmnxc mcv bvcx jkdbjvkdfbvj vmmkj fjkf kjb fvbkj bvkjf bvjkb vjk bvkj vbksd bvkjsdbkjsdvbdbx cmv mxcv m,xcv,xcvnkx dk kj fkjsdfh ksjd hjksd fhjsdk hskd skj kjsd fhksjd hfkjsd hkjsd fhksjd hfkjds hfkjds hfj hfjksd fhkjds fhkjkj hd kjh kjfhjks fhkjsd fhkjdsf hd kjfhdsjkjsfjsd hfjk h j ', '', '/uploads', NULL, 'banner-info', 'Deleted', 1, '127.0.0.1', '2017-01-30 23:01:28', '2017-01-30 23:02:08'),
(93, 'Title2', 'Description', '', '/uploads', NULL, 'what-we-translate', 'Deleted', 1, '127.0.0.1', '2017-01-30 23:03:16', '2017-01-31 06:29:45'),
(94, 'Title', 'Rtret', '', '/uploads', NULL, 'what-we-translate', 'Deleted', 1, '127.0.0.1', '2017-01-30 23:04:06', '2017-01-30 23:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `social_auth`
--

CREATE TABLE IF NOT EXISTS `social_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fb_id` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `social_auth_id` smallint(6) DEFAULT NULL,
  `role_id` int(2) NOT NULL,
  `status` enum('Active','Deleted','Paused') COLLATE utf8_unicode_ci DEFAULT 'Paused',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_token` tinytext COLLATE utf8_unicode_ci,
  `updated_by` int(11) NOT NULL,
  `updated_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `social_auth_id`, `role_id`, `status`, `remember_token`, `reset_password_token`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(1, 'admin@test.com', '$2y$10$sSWnm6y0E/Ob8ieK1K9se.0FlVk4duaKQIvWd3DCqDdxunRglo2t.', NULL, 1, 'Active', 'yIDDzcWxT2FcvzPIKP0yLtPqsqOPZFclGzCcZg7c7VU6kHTb3nvA3aFkwq5H', NULL, 1, '127.0.0.1', '2016-12-21 02:20:10', '2017-02-01 04:06:44'),
(2, 'customer@test.com', '$2y$10$QRlRhYDD41yLxfQVY3y7cevWRCAQ.lzqhpm8cWbCQ70XYeUjUNKKa', NULL, 3, 'Deleted', '8RW8ev3BhBboXVrLEiZP1ZPLDmn3i7IIGXz1zcrpmE6QbLuffteUENefaU6b', '20r8126gw2pUfDsYGYyPmCzAsRayQ84wymvqerLRk1kE4TdAqSQ', 0, NULL, '2016-12-21 03:39:07', '2017-01-27 06:25:44'),
(3, 'translator@gmail.com', '$2y$10$sSWnm6y0E/Ob8ieK1K9se.0FlVk4duaKQIvWd3DCqDdxunRglo2t.', NULL, 4, 'Active', NULL, NULL, 0, NULL, '2017-01-11 03:40:36', '2017-01-27 06:26:06'),
(4, 'rajwinder@visions.net.in', '$2y$10$bH/WbvSi.obQOEXsEYNI3ej775A/hsgSNpR7fKsIcJ.LQQ4htBhH2', NULL, 3, 'Active', NULL, NULL, 1, '127.0.0.1', '2017-01-23 23:51:51', '2017-01-27 07:42:23'),
(5, 'Ree@sdf.o', '$2y$10$pGtiNQD1KUlDSBpUpCGPf.gW.zi3eu3xKQfKQDf1q8ZFDqXY4PqyK', NULL, 2, 'Active', NULL, NULL, 1, '127.0.0.1', '2017-01-23 23:52:37', '2017-01-24 00:13:04'),
(6, 'dffs@dffg.oo', '$2y$10$AZP9hBO.9oO5wY18.JbwWOXfVqWZBAbWO8HNpo/EdiTXD2c8PcNCy', NULL, 3, 'Active', NULL, NULL, 1, '127.0.0.1', '2017-01-24 00:12:38', '2017-01-27 06:40:46');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
