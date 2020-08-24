DROP TABLE IF EXISTS `zeus_menu`;
CREATE TABLE IF NOT EXISTS `zeus_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(50) NOT NULL,
  `segment` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `icon` varchar(50) NOT NULL,
  `zeus_menu_id` int(11) DEFAULT NULL,
  `route_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `route_prefix_json` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zeus_menu`
--

INSERT INTO `zeus_menu` (`id`, `menu_code`, `title`, `segment`, `icon`, `zeus_menu_id`, `route_name`, `route_prefix_json`, `precedence`, `can_edit`, `can_delete`, `is_admin`, `created_at`, `deleted_at`) VALUES
(2, 'edd4cfea39ec0bb1230cc9faf61ffa49', 'Manage User', '[\"core\",\"user\",null]', 'far fa-user', NULL, NULL, '[]', 0, 0, 0, 1, '2020-08-22 10:47:06', NULL),
(4, '76f1bf9bdedc99259a6ee57f9b5134a3', 'User Groups', '[]', 'far fa-circle', 2, 'core.user.group', '[]', 0, 0, 0, 1, '2020-08-22 10:53:26', NULL),
(5, '9bc65c2abec141778ffaa729489f3e87', 'Users', '[]', 'far fa-circle', 2, 'core.user.master', '[]', 1, 0, 0, 1, '2020-08-22 10:53:53', NULL),
(6, 'ccd1066343c95877b75b79d47c36bebe', 'Configuration', '[\"core\",\"config\",null]', 'fa fa-wrench', NULL, NULL, '[]', 1, 0, 0, 1, '2020-08-22 10:54:19', NULL),
(7, '3676d55f84497cbeadfc614c1b1b62fc', 'Application', 'null', 'far fa-circle', 6, 'core.config.application', '[]', 0, 0, 0, 1, '2020-08-22 10:54:37', NULL),
(8, '93c731f1c3a84ef05cd54d044c379eaa', 'Company', '[]', 'far fa-circle', 6, 'core.config.company', '[]', 1, 0, 0, 1, '2020-08-22 10:54:53', NULL),
(9, '4a931512ce65bdc9ca6808adf92d8783', 'Tools', '[\"core\",\"tools\",null]', 'fa fa-star', NULL, NULL, '[]', 2, 0, 0, 1, '2020-08-22 10:56:33', NULL),
(10, 'fb1e17501e6dbc22e60e1e98130678ad', 'Send Email', '[]', 'far fa-circle', 9, 'core.tools.send_email', '[]', 0, 0, 0, 1, '2020-08-22 10:56:54', NULL),
(11, '5d891b239cbe6d7f844728038b5f007e', 'Menu Builder', '[]', 'far fa-circle', 9, 'core.tools.menu_builder', '[]', 1, 0, 0, 1, '2020-08-22 10:57:09', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zeus_meta`
--

DROP TABLE IF EXISTS `zeus_meta`;
CREATE TABLE IF NOT EXISTS `zeus_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_group` varchar(40) NOT NULL,
  `meta_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `user_id` int(11) DEFAULT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `editable` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option_key` (`meta_key`),
  KEY `meta_group` (`meta_group`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zeus_meta`
--

INSERT INTO `zeus_meta` (`id`, `meta_group`, `meta_key`, `meta_value`, `user_id`, `user_group_id`, `editable`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'system', 'backend_theme', 'adminlte3', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-07-26 10:41:29', NULL),
(2, 'system', 'logo', 'logo.png', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-08-15 12:47:31', NULL),
(3, 'system', 'favicon', 'favicon.png', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-08-15 12:49:01', NULL),
(4, 'system', 'app_name', 'Zeus', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-07-26 10:41:29', NULL),
(5, 'system', 'app_version', '1.0.0-Alpha4', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-07-26 10:41:29', NULL),
(6, 'system', 'app_year', '2020', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-07-26 10:41:29', NULL),
(8, 'system', 'company_name', 'Zeus Laravel', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-07-26 10:46:59', NULL),
(9, 'system', 'company_address', '-', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-07-26 10:46:59', NULL),
(10, 'system', 'company_phone', '-', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-07-26 10:46:59', NULL),
(11, 'system', 'company_email', '-', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-07-26 10:46:59', NULL),
(12, 'system', 'company_fax', '-', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-06-06 17:58:18', NULL),
(13, 'system', 'company_web', '-', NULL, NULL, 1, '2020-06-06 17:58:18', '2020-07-26 10:46:59', NULL),
(16, 'user_group', 'superadmin', 'Super Administrator', NULL, NULL, 0, '2020-06-06 18:42:21', '2020-06-06 18:42:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zeus_user`
--

DROP TABLE IF EXISTS `zeus_user`;
CREATE TABLE IF NOT EXISTS `zeus_user` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zeus_user`
--

INSERT INTO `zeus_user` (`id`, `name`, `username`, `email`, `password`, `user_group_id`, `token`, `status`, `avatar`, `last_login`, `forgot_token`, `forgot_valid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Administrator', 'admin', 'eyubalzary@gmail.com', '$2y$10$NDLwGiAC7AC9KQfgPK7fu.5p5GN1OOOGkxnWuYwB4rhf6/n/hMMIG', 16, 'eb5ef67f3f855987471bab1e43f34b75', 1, 'avatar-1.png', '2020-08-22 22:31:42', NULL, NULL, '2019-10-04 13:01:10', '2020-08-22 15:31:42', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
