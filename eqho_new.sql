-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 21, 2016 at 05:17 PM
-- Server version: 5.5.35-1ubuntu1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eqho_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `short` char(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `short`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', '2016-12-19 04:47:36', NULL),
(2, 'German', 'de', '2016-12-19 04:47:36', NULL),
(3, 'French (European)', 'fr', '2016-12-19 04:47:36', NULL),
(4, 'Dutch', 'nl', '2016-12-19 04:47:36', NULL),
(5, 'Italian', 'it', '2016-12-19 04:47:36', NULL),
(6, 'Spanish (Latin America, Mexico)', 'es', '2016-12-19 04:47:36', NULL),
(7, 'Polish', 'pl', '2016-12-19 04:47:36', NULL),
(8, 'Russian', 'ru', '2016-12-19 04:47:36', NULL),
(9, 'Japanese', 'ja', '2016-12-19 04:47:36', NULL),
(10, 'Portuguese (Brazil)', 'pt', '2016-12-19 04:47:36', NULL),
(11, 'Swedish', 'sv', '2016-12-19 04:47:36', NULL),
(14, 'Ukrainian', 'uk', '2016-12-19 04:47:36', NULL),
(15, 'Norwegian', 'no', '2016-12-19 04:47:36', NULL),
(16, 'Finnish', 'fi', '2016-12-19 04:47:36', NULL),
(17, 'Vietnamese', 'vi', '2016-12-19 04:47:36', NULL),
(18, 'Czech', 'cs', '2016-12-19 04:47:36', NULL),
(19, 'Hungarian', 'hu', '2016-12-19 04:47:36', NULL),
(20, 'Korean', 'ko', '2016-12-19 04:47:36', NULL),
(21, 'Indonesian', 'id', '2016-12-19 04:47:36', NULL),
(22, 'Turkish', 'tr', '2016-12-19 04:47:36', NULL),
(23, 'Romanian', 'ro', '2016-12-19 04:47:36', NULL),
(25, 'Arabic', 'ar', '2016-12-19 04:47:36', NULL),
(26, 'Danish', 'da', '2016-12-19 04:47:36', NULL),
(29, 'Lithuanian', 'lt', '2016-12-19 04:47:36', NULL),
(30, 'Slovak', 'sk', '2016-12-19 04:47:36', NULL),
(31, 'Malay', 'ms', '2016-12-19 04:47:36', NULL),
(33, 'Bulgarian', 'bg', '2016-12-19 04:47:36', NULL),
(34, 'Slovenian', 'sl', '2016-12-19 04:47:36', NULL),
(39, 'Croatian', 'hr', '2016-12-19 04:47:36', NULL),
(40, 'Hindi', 'hi', '2016-12-19 04:47:36', NULL),
(41, 'Estonian', 'et', '2016-12-19 04:47:36', NULL),
(42, 'Thai', 'th', '2016-12-19 04:47:50', NULL),
(43, 'Greek', 'el', '2016-12-19 04:48:00', NULL),
(44, 'Tagalog', 'tl', '2016-12-19 04:48:09', NULL),
(45, 'Latvian', 'lv', '2016-12-19 04:48:18', NULL),
(46, 'Urdu', 'ur', '2016-12-19 04:48:28', NULL),
(47, 'Burmese', 'my', '2016-12-19 04:48:32', NULL),
(48, 'Traditional Chinese (Hong Kong)', 'hk', '2016-12-19 04:48:35', NULL),
(49, 'Simplified Chinese', 'ch', '2016-12-19 04:48:39', NULL),
(50, 'Traditional Chinese (Taiwan)', 'ta', '2016-12-19 04:48:44', NULL),
(51, 'Lao', 'la', '2016-12-19 04:48:47', NULL),
(52, 'Khmer', 'kh', '2016-12-19 04:48:51', NULL),
(53, 'Hmong', 'hm', '2016-12-19 04:48:54', NULL),
(54, 'French (Canada)', 'fc', '2016-12-19 04:48:58', NULL),
(55, 'Spanish (European)', 'su', '2016-12-19 04:49:00', NULL),
(56, 'Portuguese (European)', 'PE', '2016-12-19 04:49:04', NULL),
(57, 'Farsi', 'fr', '2016-12-19 04:49:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Standard', '2016-12-19 04:56:39', NULL),
(2, 'Bussiness', '2016-12-19 04:56:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `price_per_word`
--

CREATE TABLE IF NOT EXISTS `price_per_word` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_language` int(11) NOT NULL,
  `to_language` int(11) DEFAULT NULL,
  `price_per_word` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', '2016-12-18 20:38:14', NULL),
(2, 'Management', '2016-12-18 20:38:14', NULL),
(3, 'Customer', '2016-12-20 18:30:00', NULL),
(4, 'Translator', '2016-12-20 18:30:00', NULL);

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
-- Table structure for table `translation_applications`
--

CREATE TABLE IF NOT EXISTS `translation_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(200) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `from_language_id` int(11) DEFAULT NULL,
  `to_language_id` tinytext,
  `number_of_words` varchar(100) DEFAULT NULL,
  `total_price` varchar(100) DEFAULT NULL,
  `estimation_quote_data` tinytext,
  `file_name` tinytext,
  `file_path` varchar(20) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
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
  `role` int(2) NOT NULL,
  `status` enum('Active','Deleted','Paused') COLLATE utf8_unicode_ci DEFAULT 'Paused',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `social_auth_id`, `role`, `status`, `remember_token`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(1, 'customer@test.com', '$2y$10$sSWnm6y0E/Ob8ieK1K9se.0FlVk4duaKQIvWd3DCqDdxunRglo2t.', NULL, 3, 'Active', 'NxnEoxLhV6uAkDX7vyIWMO0dFMsHGICtZGyu8VUnzLGp6fxAW42h2YsRqkr1', 0, NULL, '2016-12-21 02:20:10', '2016-12-21 03:43:19'),
(2, 'customer2@test.com', '$2y$10$IKNs6dQA0Fo9XxLurithzOMHv9PtyiQyyKT9eCUBc.8nX/I0qspn.', NULL, 3, 'Paused', 'DxMXzU6lbtA6ni4uL6yQutWgZq9GsErxODllYP8Y011dtcGSu39DZH7J5qYT', 0, NULL, '2016-12-21 03:39:07', '2016-12-21 03:39:27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
