-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 09, 2021 at 02:44 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zeus_laravel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `zeus_menu`
--

DROP TABLE IF EXISTS `zeus_menu`;
CREATE TABLE IF NOT EXISTS `zeus_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_code` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `segment` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `zeus_menu_id` int(11) DEFAULT NULL,
  `route_name` varchar(50) DEFAULT NULL,
  `route_prefix_json` varchar(50) DEFAULT NULL,
  `precedence` int(11) NOT NULL DEFAULT '0',
  `can_edit` tinyint(1) NOT NULL DEFAULT '1',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zeus_menu_id` (`zeus_menu_id`),
  KEY `menu_code` (`menu_code`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COMMENT='Dont Remove It';

--
-- Dumping data for table `zeus_menu`
--

INSERT INTO `zeus_menu` (`id`, `menu_code`, `title`, `segment`, `icon`, `zeus_menu_id`, `route_name`, `route_prefix_json`, `precedence`, `can_edit`, `can_delete`, `is_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'edd4cfea39ec0bb1230cc9faf61ffa49', 'User Management', '[\"core\",\"user\",null]', 'fa fa-user', NULL, NULL, '[]', 7, 0, 0, 1, '2020-08-22 03:47:06', '2020-09-22 23:24:50', NULL),
(4, '76f1bf9bdedc99259a6ee57f9b5134a3', 'Role Setting', '[]', 'ti-control-record', 2, 'core.user.group', '[]', 30, 0, 0, 1, '2020-08-22 03:53:26', '2020-09-22 23:24:50', NULL),
(5, '9bc65c2abec141778ffaa729489f3e87', 'User List', '[]', 'ti-control-record', 2, 'core.user.master', '[]', 32, 0, 0, 1, '2020-08-22 03:53:53', '2020-09-22 23:24:50', NULL),
(6, 'ccd1066343c95877b75b79d47c36bebe', 'Configuration', '[\"core\",\"config\",null]', 'fa fa-wrench', NULL, NULL, '[]', 8, 0, 0, 1, '2020-08-22 03:54:19', '2020-09-22 23:24:50', NULL),
(7, '3676d55f84497cbeadfc614c1b1b62fc', 'Application', '[]', 'ti-control-record', 6, 'core.config.application', '[]', 33, 0, 0, 1, '2020-08-22 03:54:37', '2020-09-22 23:24:50', NULL),
(8, '93c731f1c3a84ef05cd54d044c379eaa', 'Company', '[]', 'ti-control-record', 6, 'core.config.company', '[]', 34, 0, 0, 1, '2020-08-22 03:54:53', '2020-09-22 23:24:50', NULL),
(9, '4a931512ce65bdc9ca6808adf92d8783', 'Tools', '[\"core\",\"tools\",null]', 'fa fa-star', NULL, NULL, '[]', 9, 0, 0, 1, '2020-08-22 03:56:33', '2020-09-22 23:24:50', NULL),
(10, 'fb1e17501e6dbc22e60e1e98130678ad', 'Send Email', '[]', 'ti-control-record', 9, 'core.tools.send_email', '[]', 35, 0, 0, 1, '2020-08-22 03:56:54', '2020-09-22 23:24:50', NULL),
(11, '5d891b239cbe6d7f844728038b5f007e', 'Menu Builder', '[]', 'ti-control-record', 9, 'core.tools.menu_builder', '[]', 36, 0, 0, 1, '2020-08-22 03:57:09', '2020-09-22 23:24:50', NULL),
(75, '9bc65c2abec141778ffaa722489f3e87', 'User Add', '[]', 'ti-control-record', 2, 'core.user.master.add', '[]', 31, 0, 0, 1, '2020-08-22 03:53:53', '2020-09-22 23:24:50', NULL),
(122, '254c0ac405dec3c7a6635c416b226b33', 'Module Manager', '[]', 'fa fa-circle', 6, 'core.config.module.index', '[]', 9, 1, 1, 1, '2020-10-06 00:50:38', '2020-10-08 03:29:08', NULL),
(123, 'e230ed6bd40f365039878226d09d472a', 'Sub Module Manager', '[]', 'fa fa-circle', 6, 'core.config.module_sub.index', '[]', 10, 1, 1, 1, '2020-10-06 00:52:01', '2020-10-08 03:29:08', NULL),
(124, 'c4f12283a121a562399f6309c3273437', 'Access Module', '[]', 'fa fa-circle', 6, 'core.config.module_access.index', '[]', 12, 1, 1, 1, '2020-10-06 00:52:13', '2020-10-08 03:29:08', NULL),
(125, 'c4f12283a121a562399c6309c3273437', 'Access Menu', '[]', 'fa fa-circle', 6, 'core.config.menu_access.index', '[]', 11, 1, 1, 1, '2020-10-06 00:52:13', '2020-10-08 03:29:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zeus_menu_access`
--

DROP TABLE IF EXISTS `zeus_menu_access`;
CREATE TABLE IF NOT EXISTS `zeus_menu_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `user_group_id` (`user_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zeus_menu_group`
--

DROP TABLE IF EXISTS `zeus_menu_group`;
CREATE TABLE IF NOT EXISTS `zeus_menu_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zeus_menu_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zeus_menu_id` (`zeus_menu_id`),
  KEY `user_group_id` (`user_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Dont Remove It';

-- --------------------------------------------------------

--
-- Table structure for table `zeus_meta`
--

DROP TABLE IF EXISTS `zeus_meta`;
CREATE TABLE IF NOT EXISTS `zeus_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_group` varchar(40) NOT NULL,
  `meta_key` varchar(50) NOT NULL,
  `meta_value` text,
  `user_id` int(11) DEFAULT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `editable` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option_key` (`meta_key`),
  KEY `meta_group` (`meta_group`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='Dont Remove It';

--
-- Dumping data for table `zeus_meta`
--

INSERT INTO `zeus_meta` (`id`, `meta_group`, `meta_key`, `meta_value`, `user_id`, `user_group_id`, `editable`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'system', 'backend_theme', 'adminlte3', NULL, NULL, 1, '2020-10-28 17:29:49', '2020-09-16 17:43:21', NULL),
(2, 'system', 'logo', 'logo.png', NULL, NULL, 1, '2020-09-11 11:08:55', '2020-09-11 11:08:55', NULL),
(3, 'system', 'favicon', 'favicon.png', NULL, NULL, 1, '2020-09-11 11:17:47', '2020-09-11 11:17:47', NULL),
(4, 'system', 'app_name', 'Intertwine-Omni', NULL, NULL, 1, '2020-09-16 17:43:21', '2020-09-16 17:43:21', NULL),
(5, 'system', 'app_version', '1.0.0-Alpha4', NULL, NULL, 1, '2020-09-16 17:43:21', '2020-09-16 17:43:21', NULL),
(6, 'system', 'app_year', '2020', NULL, NULL, 1, '2020-09-16 17:43:21', '2020-09-16 17:43:21', NULL),
(8, 'system', 'company_name', 'Intertwine-Omni', NULL, NULL, 1, '2020-09-07 02:42:36', '2020-09-07 02:42:36', NULL),
(9, 'system', 'company_address', '-', NULL, NULL, 1, '2020-09-07 02:42:36', '2020-09-07 02:42:36', NULL),
(10, 'system', 'company_phone', '-', NULL, NULL, 1, '2020-09-07 02:42:36', '2020-09-07 02:42:36', NULL),
(11, 'system', 'company_email', '-', NULL, NULL, 1, '2020-09-07 02:42:36', '2020-09-07 02:42:36', NULL),
(12, 'system', 'company_fax', '-', NULL, NULL, 1, '2020-06-06 10:58:18', '2020-06-06 10:58:18', NULL),
(13, 'system', 'company_web', '-', NULL, NULL, 1, '2020-09-07 02:42:36', '2020-09-07 02:42:36', NULL),
(16, 'user_group', 'superadmin', 'Super Administrator', NULL, NULL, 0, '2020-06-06 11:42:21', '2020-06-06 11:42:21', NULL),
(25, 'user_group', 'admin', 'Administrator', NULL, NULL, 1, '2020-08-30 05:18:01', '2020-08-30 05:18:01', NULL),
(26, 'user_group_access', 'admin', '{\"campaign.list.index\":\"on\",\"campaign.list.add\":\"on\",\"campaign.flowchart.index\":\"on\",\"campaign.picklist.index\":\"on\",\"campaign.picklist.add\":\"on\",\"campaign.brand.index\":\"on\",\"admin.user.index\":\"on\",\"admin.user.add\":\"on\",\"admin.role.index\":\"on\",\"master.spg.index\":\"on\",\"master.spg.add\":\"on\",\"master.outlet.index\":\"on\",\"master.outlet.add\":\"on\",\"master.channel.index\":\"on\",\"master.channel.add\":\"on\",\"master.crm.index\":\"on\",\"master.gender.index\":\"on\",\"process.temporary.upload\":\"on\",\"process.dedup.first\":\"on\",\"process.dedup.two\":\"on\",\"process.dedup.manual\":\"on\",\"outbound.dashboard.index\":\"on\",\"outbound.call_log.index\":\"on\"}', NULL, NULL, 0, '2020-08-31 03:07:35', '2020-08-31 03:07:35', NULL),
(27, 'user_group', 'agent', 'Agent', NULL, NULL, 1, '2020-08-31 01:55:57', '2020-08-31 01:55:57', NULL),
(28, 'user_group', 'manager', 'Manager', NULL, NULL, 1, '2020-08-31 07:54:54', '2020-08-31 07:54:54', NULL),
(29, 'user_group', 'spg', 'SPG/BP/MD', NULL, NULL, 1, '2020-08-31 07:55:21', '2020-08-31 07:55:21', NULL),
(30, 'user_group', 'spv', 'Supervisor', NULL, NULL, 1, '2020-08-31 07:55:31', '2020-08-31 07:55:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zeus_module`
--

DROP TABLE IF EXISTS `zeus_module`;
CREATE TABLE IF NOT EXISTS `zeus_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zeus_module_access`
--

DROP TABLE IF EXISTS `zeus_module_access`;
CREATE TABLE IF NOT EXISTS `zeus_module_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `zeus_module_sub_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_group_id` (`user_group_id`),
  KEY `zeus_module_sub_id` (`zeus_module_sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zeus_module_sub`
--

DROP TABLE IF EXISTS `zeus_module_sub`;
CREATE TABLE IF NOT EXISTS `zeus_module_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zeus_module_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `route_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `zeus_module_id` (`zeus_module_id`),
  KEY `route_name` (`route_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zeus_user`
--

DROP TABLE IF EXISTS `zeus_user`;
CREATE TABLE IF NOT EXISTS `zeus_user` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `forgot_token` varchar(50) DEFAULT NULL,
  `forgot_valid` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `user_group_id` (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Dont Remove It';

--
-- Dumping data for table `zeus_user`
--

INSERT INTO `zeus_user` (`id`, `name`, `username`, `email`, `password`, `user_group_id`, `token`, `status`, `avatar`, `last_login`, `forgot_token`, `forgot_valid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Administrator', 'super', 'eyubalzary@gmail.com', '$2y$10$NDLwGiAC7AC9KQfgPK7fu.5p5GN1OOOGkxnWuYwB4rhf6/n/hMMIG', 16, 'c244548b553be66186de11c574114433', 1, 'avatar-1.png', '2020-10-28 17:29:59', NULL, NULL, '2019-10-04 06:01:10', '2020-10-28 10:29:59', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
