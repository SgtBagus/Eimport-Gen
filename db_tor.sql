-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2019 at 08:55 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tor`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `id` int(11) NOT NULL,
  `access_control_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `access_control_id`, `role_id`, `status`) VALUES
(2, 94, 17, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `access_control`
--

CREATE TABLE `access_control` (
  `id` int(11) NOT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `val` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_control`
--

INSERT INTO `access_control` (`id`, `folder`, `class`, `method`, `val`) VALUES
(1, '', 'Access', '__construct', 'access/__construct'),
(2, '', 'Access', 'index', 'access/index'),
(3, '', 'Access', 'json', 'access/json'),
(4, '', 'Access', 'control', 'access/control'),
(5, '', 'Access', 'store', 'access/store'),
(6, '', 'Access', 'konfig', 'access/konfig'),
(7, '', 'Access', 'upload_file', 'access/upload_file'),
(8, '', 'Access', 'get_uri', 'access/get_uri'),
(9, '', 'Access', 'log_activity', 'access/log_activity'),
(10, '', 'Access', 'get_instance', 'access/get_instance'),
(11, '', 'Admin', '__construct', 'admin/__construct'),
(12, '', 'Admin', 'index', 'admin/index'),
(13, '', 'Admin', 'logout', 'admin/logout'),
(14, '', 'Admin', 'act_login', 'admin/act_login'),
(15, '', 'Admin', 'lockscreen', 'admin/lockscreen'),
(16, '', 'Admin', 'konfig', 'admin/konfig'),
(17, '', 'Admin', 'upload_file', 'admin/upload_file'),
(18, '', 'Admin', 'get_uri', 'admin/get_uri'),
(19, '', 'Admin', 'log_activity', 'admin/log_activity'),
(20, '', 'Admin', 'get_instance', 'admin/get_instance'),
(21, '', 'Crud', '__construct', 'crud/__construct'),
(22, '', 'Crud', 'index', 'crud/index'),
(23, '', 'Crud', 'viewcode', 'crud/viewcode'),
(24, '', 'Crud', 'generate', 'crud/generate'),
(25, '', 'Crud', 'get_kolom', 'crud/get_kolom'),
(26, '', 'Crud', 'save_generate', 'crud/save_generate'),
(27, '', 'Crud', 'api', 'crud/api'),
(28, '', 'Crud', 'api_generate', 'crud/api_generate'),
(29, '', 'Crud', 'services', 'crud/services'),
(30, '', 'Crud', 'konfig', 'crud/konfig'),
(31, '', 'Crud', 'upload_file', 'crud/upload_file'),
(32, '', 'Crud', 'get_uri', 'crud/get_uri'),
(33, '', 'Crud', 'log_activity', 'crud/log_activity'),
(34, '', 'Crud', 'get_instance', 'crud/get_instance'),
(35, '', 'Debug', '__construct', 'debug/__construct'),
(36, '', 'Debug', 'index', 'debug/index'),
(37, '', 'Debug', 'exportexcell', 'debug/exportexcell'),
(38, '', 'Debug', 'ecryprdecrypt', 'debug/ecryprdecrypt'),
(39, '', 'Debug', 'validation_form', 'debug/validation_form'),
(40, '', 'Debug', 'konfig', 'debug/konfig'),
(41, '', 'Debug', 'upload_file', 'debug/upload_file'),
(42, '', 'Debug', 'get_uri', 'debug/get_uri'),
(43, '', 'Debug', 'log_activity', 'debug/log_activity'),
(44, '', 'Debug', 'get_instance', 'debug/get_instance'),
(45, '', 'Fitur', '__construct', 'fitur/__construct'),
(46, '', 'Fitur', 'ekspor', 'fitur/ekspor'),
(47, '', 'Fitur', 'impor', 'fitur/impor'),
(48, '', 'Fitur', 'importdata', 'fitur/importdata'),
(49, '', 'Fitur', 'access', 'fitur/access'),
(50, '', 'Fitur', 'exportreport', 'fitur/exportreport'),
(51, '', 'Fitur', 'toPdf', 'fitur/topdf'),
(52, '', 'Fitur', 'konfig', 'fitur/konfig'),
(53, '', 'Fitur', 'upload_file', 'fitur/upload_file'),
(54, '', 'Fitur', 'get_uri', 'fitur/get_uri'),
(55, '', 'Fitur', 'log_activity', 'fitur/log_activity'),
(56, '', 'Fitur', 'get_instance', 'fitur/get_instance'),
(57, '', 'Home', '__construct', 'home/__construct'),
(58, '', 'Home', 'index', 'home/index'),
(59, '', 'Home', 'chart', 'home/chart'),
(60, '', 'Home', 'get_autocomplete', 'home/get_autocomplete'),
(61, '', 'Home', 'konfig', 'home/konfig'),
(62, '', 'Home', 'upload_file', 'home/upload_file'),
(63, '', 'Home', 'get_uri', 'home/get_uri'),
(64, '', 'Home', 'log_activity', 'home/log_activity'),
(65, '', 'Home', 'get_instance', 'home/get_instance'),
(66, '', 'Login', '__construct', 'login/__construct'),
(67, '', 'Login', 'index', 'login/index'),
(68, '', 'Login', 'logout', 'login/logout'),
(69, '', 'Login', 'act_login', 'login/act_login'),
(70, '', 'Login', 'lockscreen', 'login/lockscreen'),
(71, '', 'Login', 'konfig', 'login/konfig'),
(72, '', 'Login', 'upload_file', 'login/upload_file'),
(73, '', 'Login', 'get_uri', 'login/get_uri'),
(74, '', 'Login', 'log_activity', 'login/log_activity'),
(75, '', 'Login', 'get_instance', 'login/get_instance'),
(76, '', 'Page', '__construct', 'page/__construct'),
(77, '', 'Page', 'portrait', 'page/portrait'),
(78, '', 'Page', 'landscape', 'page/landscape'),
(79, '', 'Page', 'konfig', 'page/konfig'),
(80, '', 'Page', 'upload_file', 'page/upload_file'),
(81, '', 'Page', 'get_uri', 'page/get_uri'),
(82, '', 'Page', 'log_activity', 'page/log_activity'),
(83, '', 'Page', 'get_instance', 'page/get_instance'),
(84, '', 'Rest_server', 'index', 'rest_server/index'),
(85, '', 'Rest_server', '__construct', 'rest_server/__construct'),
(86, '', 'Rest_server', 'get_instance', 'rest_server/get_instance'),
(87, '', 'Tinymce', '__construct', 'tinymce/__construct'),
(88, '', 'Tinymce', 'index', 'tinymce/index'),
(89, '', 'Tinymce', 'konfig', 'tinymce/konfig'),
(90, '', 'Tinymce', 'upload_file', 'tinymce/upload_file'),
(91, '', 'Tinymce', 'get_uri', 'tinymce/get_uri'),
(92, '', 'Tinymce', 'log_activity', 'tinymce/log_activity'),
(93, '', 'Tinymce', 'get_instance', 'tinymce/get_instance'),
(94, '', 'UploadImage', '__construct', 'uploadimage/__construct'),
(95, '', 'UploadImage', 'index', 'uploadimage/index'),
(96, '', 'UploadImage', 'uploadAjax', 'uploadimage/uploadajax'),
(97, '', 'UploadImage', 'ajaxImageUnlink', 'uploadimage/ajaximageunlink'),
(98, '', 'UploadImage', 'konfig', 'uploadimage/konfig'),
(99, '', 'UploadImage', 'upload_file', 'uploadimage/upload_file'),
(100, '', 'UploadImage', 'get_uri', 'uploadimage/get_uri'),
(101, '', 'UploadImage', 'log_activity', 'uploadimage/log_activity'),
(102, '', 'UploadImage', 'get_instance', 'uploadimage/get_instance'),
(103, 'master', 'Activity', '__construct', 'master/activity/__construct'),
(104, 'master', 'Activity', 'index', 'master/activity/index'),
(105, 'master', 'Activity', 'create', 'master/activity/create'),
(106, 'master', 'Activity', 'validate', 'master/activity/validate'),
(107, 'master', 'Activity', 'store', 'master/activity/store'),
(108, 'master', 'Activity', 'json', 'master/activity/json'),
(109, 'master', 'Activity', 'edit', 'master/activity/edit'),
(110, 'master', 'Activity', 'update', 'master/activity/update'),
(111, 'master', 'Activity', 'delete', 'master/activity/delete'),
(112, 'master', 'Activity', 'status', 'master/activity/status'),
(113, 'master', 'Activity', 'konfig', 'master/activity/konfig'),
(114, 'master', 'Activity', 'upload_file', 'master/activity/upload_file'),
(115, 'master', 'Activity', 'get_uri', 'master/activity/get_uri'),
(116, 'master', 'Activity', 'log_activity', 'master/activity/log_activity'),
(117, 'master', 'Activity', 'get_instance', 'master/activity/get_instance'),
(118, 'master', 'Bss', 'index', 'master/bss/index'),
(119, 'master', 'Bss', '__construct', 'master/bss/__construct'),
(120, 'master', 'Bss', 'konfig', 'master/bss/konfig'),
(121, 'master', 'Bss', 'upload_file', 'master/bss/upload_file'),
(122, 'master', 'Bss', 'get_uri', 'master/bss/get_uri'),
(123, 'master', 'Bss', 'log_activity', 'master/bss/log_activity'),
(124, 'master', 'Bss', 'get_instance', 'master/bss/get_instance'),
(125, 'master', 'Condition', '__construct', 'master/condition/__construct'),
(126, 'master', 'Condition', 'index', 'master/condition/index'),
(127, 'master', 'Condition', 'create', 'master/condition/create'),
(128, 'master', 'Condition', 'validate', 'master/condition/validate'),
(129, 'master', 'Condition', 'store', 'master/condition/store'),
(130, 'master', 'Condition', 'json', 'master/condition/json'),
(131, 'master', 'Condition', 'edit', 'master/condition/edit'),
(132, 'master', 'Condition', 'update', 'master/condition/update'),
(133, 'master', 'Condition', 'delete', 'master/condition/delete'),
(134, 'master', 'Condition', 'status', 'master/condition/status'),
(135, 'master', 'Condition', 'konfig', 'master/condition/konfig'),
(136, 'master', 'Condition', 'upload_file', 'master/condition/upload_file'),
(137, 'master', 'Condition', 'get_uri', 'master/condition/get_uri'),
(138, 'master', 'Condition', 'log_activity', 'master/condition/log_activity'),
(139, 'master', 'Condition', 'get_instance', 'master/condition/get_instance'),
(140, 'master', 'Currency', '__construct', 'master/currency/__construct'),
(141, 'master', 'Currency', 'index', 'master/currency/index'),
(142, 'master', 'Currency', 'create', 'master/currency/create'),
(143, 'master', 'Currency', 'validate', 'master/currency/validate'),
(144, 'master', 'Currency', 'store', 'master/currency/store'),
(145, 'master', 'Currency', 'json', 'master/currency/json'),
(146, 'master', 'Currency', 'edit', 'master/currency/edit'),
(147, 'master', 'Currency', 'update', 'master/currency/update'),
(148, 'master', 'Currency', 'delete', 'master/currency/delete'),
(149, 'master', 'Currency', 'status', 'master/currency/status'),
(150, 'master', 'Currency', 'konfig', 'master/currency/konfig'),
(151, 'master', 'Currency', 'upload_file', 'master/currency/upload_file'),
(152, 'master', 'Currency', 'get_uri', 'master/currency/get_uri'),
(153, 'master', 'Currency', 'log_activity', 'master/currency/log_activity'),
(154, 'master', 'Currency', 'get_instance', 'master/currency/get_instance'),
(155, 'master', 'Customer', '__construct', 'master/customer/__construct'),
(156, 'master', 'Customer', 'index', 'master/customer/index'),
(157, 'master', 'Customer', 'create', 'master/customer/create'),
(158, 'master', 'Customer', 'validate', 'master/customer/validate'),
(159, 'master', 'Customer', 'store', 'master/customer/store'),
(160, 'master', 'Customer', 'json', 'master/customer/json'),
(161, 'master', 'Customer', 'edit', 'master/customer/edit'),
(162, 'master', 'Customer', 'update', 'master/customer/update'),
(163, 'master', 'Customer', 'delete', 'master/customer/delete'),
(164, 'master', 'Customer', 'status', 'master/customer/status'),
(165, 'master', 'Customer', 'konfig', 'master/customer/konfig'),
(166, 'master', 'Customer', 'upload_file', 'master/customer/upload_file'),
(167, 'master', 'Customer', 'get_uri', 'master/customer/get_uri'),
(168, 'master', 'Customer', 'log_activity', 'master/customer/log_activity'),
(169, 'master', 'Customer', 'get_instance', 'master/customer/get_instance'),
(170, 'master', 'Grafik', '__construct', 'master/grafik/__construct'),
(171, 'master', 'Grafik', 'index', 'master/grafik/index'),
(172, 'master', 'Grafik', 'create', 'master/grafik/create'),
(173, 'master', 'Grafik', 'validate', 'master/grafik/validate'),
(174, 'master', 'Grafik', 'store', 'master/grafik/store'),
(175, 'master', 'Grafik', 'json', 'master/grafik/json'),
(176, 'master', 'Grafik', 'edit', 'master/grafik/edit'),
(177, 'master', 'Grafik', 'update', 'master/grafik/update'),
(178, 'master', 'Grafik', 'delete', 'master/grafik/delete'),
(179, 'master', 'Grafik', 'status', 'master/grafik/status'),
(180, 'master', 'Grafik', 'konfig', 'master/grafik/konfig'),
(181, 'master', 'Grafik', 'upload_file', 'master/grafik/upload_file'),
(182, 'master', 'Grafik', 'get_uri', 'master/grafik/get_uri'),
(183, 'master', 'Grafik', 'log_activity', 'master/grafik/log_activity'),
(184, 'master', 'Grafik', 'get_instance', 'master/grafik/get_instance'),
(185, 'master', 'Image', '__construct', 'master/image/__construct'),
(186, 'master', 'Image', 'index', 'master/image/index'),
(187, 'master', 'Image', 'create', 'master/image/create'),
(188, 'master', 'Image', 'validate', 'master/image/validate'),
(189, 'master', 'Image', 'store', 'master/image/store'),
(190, 'master', 'Image', 'json', 'master/image/json'),
(191, 'master', 'Image', 'edit', 'master/image/edit'),
(192, 'master', 'Image', 'update', 'master/image/update'),
(193, 'master', 'Image', 'delete', 'master/image/delete'),
(194, 'master', 'Image', 'status', 'master/image/status'),
(195, 'master', 'Image', 'konfig', 'master/image/konfig'),
(196, 'master', 'Image', 'upload_file', 'master/image/upload_file'),
(197, 'master', 'Image', 'get_uri', 'master/image/get_uri'),
(198, 'master', 'Image', 'log_activity', 'master/image/log_activity'),
(199, 'master', 'Image', 'get_instance', 'master/image/get_instance'),
(200, 'master', 'Keys', '__construct', 'master/keys/__construct'),
(201, 'master', 'Keys', 'index', 'master/keys/index'),
(202, 'master', 'Keys', 'create', 'master/keys/create'),
(203, 'master', 'Keys', 'validate', 'master/keys/validate'),
(204, 'master', 'Keys', 'store', 'master/keys/store'),
(205, 'master', 'Keys', 'json', 'master/keys/json'),
(206, 'master', 'Keys', 'edit', 'master/keys/edit'),
(207, 'master', 'Keys', 'update', 'master/keys/update'),
(208, 'master', 'Keys', 'delete', 'master/keys/delete'),
(209, 'master', 'Keys', 'status', 'master/keys/status'),
(210, 'master', 'Keys', 'konfig', 'master/keys/konfig'),
(211, 'master', 'Keys', 'upload_file', 'master/keys/upload_file'),
(212, 'master', 'Keys', 'get_uri', 'master/keys/get_uri'),
(213, 'master', 'Keys', 'log_activity', 'master/keys/log_activity'),
(214, 'master', 'Keys', 'get_instance', 'master/keys/get_instance'),
(215, 'master', 'Konfig', '__construct', 'master/konfig/__construct'),
(216, 'master', 'Konfig', 'index', 'master/konfig/index'),
(217, 'master', 'Konfig', 'create', 'master/konfig/create'),
(218, 'master', 'Konfig', 'validate', 'master/konfig/validate'),
(219, 'master', 'Konfig', 'store', 'master/konfig/store'),
(220, 'master', 'Konfig', 'json', 'master/konfig/json'),
(221, 'master', 'Konfig', 'edit', 'master/konfig/edit'),
(222, 'master', 'Konfig', 'update', 'master/konfig/update'),
(223, 'master', 'Konfig', 'delete', 'master/konfig/delete'),
(224, 'master', 'Konfig', 'status', 'master/konfig/status'),
(225, 'master', 'Konfig', 'konfig', 'master/konfig/konfig'),
(226, 'master', 'Konfig', 'upload_file', 'master/konfig/upload_file'),
(227, 'master', 'Konfig', 'get_uri', 'master/konfig/get_uri'),
(228, 'master', 'Konfig', 'log_activity', 'master/konfig/log_activity'),
(229, 'master', 'Konfig', 'get_instance', 'master/konfig/get_instance'),
(230, 'master', 'Menu_master', '__construct', 'master/menu_master/__construct'),
(231, 'master', 'Menu_master', 'index', 'master/menu_master/index'),
(232, 'master', 'Menu_master', 'create', 'master/menu_master/create'),
(233, 'master', 'Menu_master', 'validate', 'master/menu_master/validate'),
(234, 'master', 'Menu_master', 'store', 'master/menu_master/store'),
(235, 'master', 'Menu_master', 'json', 'master/menu_master/json'),
(236, 'master', 'Menu_master', 'edit', 'master/menu_master/edit'),
(237, 'master', 'Menu_master', 'update', 'master/menu_master/update'),
(238, 'master', 'Menu_master', 'delete', 'master/menu_master/delete'),
(239, 'master', 'Menu_master', 'status', 'master/menu_master/status'),
(240, 'master', 'Menu_master', 'konfig', 'master/menu_master/konfig'),
(241, 'master', 'Menu_master', 'upload_file', 'master/menu_master/upload_file'),
(242, 'master', 'Menu_master', 'get_uri', 'master/menu_master/get_uri'),
(243, 'master', 'Menu_master', 'log_activity', 'master/menu_master/log_activity'),
(244, 'master', 'Menu_master', 'get_instance', 'master/menu_master/get_instance'),
(245, 'master', 'Report', '__construct', 'master/report/__construct'),
(246, 'master', 'Report', 'index', 'master/report/index'),
(247, 'master', 'Report', 'create', 'master/report/create'),
(248, 'master', 'Report', 'validate', 'master/report/validate'),
(249, 'master', 'Report', 'store', 'master/report/store'),
(250, 'master', 'Report', 'json', 'master/report/json'),
(251, 'master', 'Report', 'edit', 'master/report/edit'),
(252, 'master', 'Report', 'update', 'master/report/update'),
(253, 'master', 'Report', 'delete', 'master/report/delete'),
(254, 'master', 'Report', 'status', 'master/report/status'),
(255, 'master', 'Report', 'generate', 'master/report/generate'),
(256, 'master', 'Report', 'konfig', 'master/report/konfig'),
(257, 'master', 'Report', 'upload_file', 'master/report/upload_file'),
(258, 'master', 'Report', 'get_uri', 'master/report/get_uri'),
(259, 'master', 'Report', 'log_activity', 'master/report/log_activity'),
(260, 'master', 'Report', 'get_instance', 'master/report/get_instance'),
(261, 'master', 'Role', '__construct', 'master/role/__construct'),
(262, 'master', 'Role', 'index', 'master/role/index'),
(263, 'master', 'Role', 'create', 'master/role/create'),
(264, 'master', 'Role', 'validate', 'master/role/validate'),
(265, 'master', 'Role', 'store', 'master/role/store'),
(266, 'master', 'Role', 'json', 'master/role/json'),
(267, 'master', 'Role', 'edit', 'master/role/edit'),
(268, 'master', 'Role', 'update', 'master/role/update'),
(269, 'master', 'Role', 'delete', 'master/role/delete'),
(270, 'master', 'Role', 'status', 'master/role/status'),
(271, 'master', 'Role', 'konfig', 'master/role/konfig'),
(272, 'master', 'Role', 'upload_file', 'master/role/upload_file'),
(273, 'master', 'Role', 'get_uri', 'master/role/get_uri'),
(274, 'master', 'Role', 'log_activity', 'master/role/log_activity'),
(275, 'master', 'Role', 'get_instance', 'master/role/get_instance'),
(276, 'master', 'Service', '__construct', 'master/service/__construct'),
(277, 'master', 'Service', 'index', 'master/service/index'),
(278, 'master', 'Service', 'create', 'master/service/create'),
(279, 'master', 'Service', 'validate', 'master/service/validate'),
(280, 'master', 'Service', 'store', 'master/service/store'),
(281, 'master', 'Service', 'json', 'master/service/json'),
(282, 'master', 'Service', 'edit', 'master/service/edit'),
(283, 'master', 'Service', 'update', 'master/service/update'),
(284, 'master', 'Service', 'delete', 'master/service/delete'),
(285, 'master', 'Service', 'status', 'master/service/status'),
(286, 'master', 'Service', 'konfig', 'master/service/konfig'),
(287, 'master', 'Service', 'upload_file', 'master/service/upload_file'),
(288, 'master', 'Service', 'get_uri', 'master/service/get_uri'),
(289, 'master', 'Service', 'log_activity', 'master/service/log_activity'),
(290, 'master', 'Service', 'get_instance', 'master/service/get_instance'),
(291, 'master', 'Site', '__construct', 'master/site/__construct'),
(292, 'master', 'Site', 'index', 'master/site/index'),
(293, 'master', 'Site', 'site_json', 'master/site/site_json'),
(294, 'master', 'Site', 'site_default', 'master/site/site_default'),
(295, 'master', 'Site', 'site_custom', 'master/site/site_custom'),
(296, 'master', 'Site', 'site_data', 'master/site/site_data'),
(297, 'master', 'Site', 'site_store', 'master/site/site_store'),
(298, 'master', 'Site', 'site_edit', 'master/site/site_edit'),
(299, 'master', 'Site', 'site_update', 'master/site/site_update'),
(300, 'master', 'Site', 'site_hidden', 'master/site/site_hidden'),
(301, 'master', 'Site', 'konfig', 'master/site/konfig'),
(302, 'master', 'Site', 'upload_file', 'master/site/upload_file'),
(303, 'master', 'Site', 'get_uri', 'master/site/get_uri'),
(304, 'master', 'Site', 'log_activity', 'master/site/log_activity'),
(305, 'master', 'Site', 'get_instance', 'master/site/get_instance'),
(306, 'master', 'User', 'index', 'master/user/index'),
(307, 'master', 'User', 'json', 'master/user/json'),
(308, 'master', 'User', 'json_activity', 'master/user/json_activity'),
(309, 'master', 'User', 'store', 'master/user/store'),
(310, 'master', 'User', 'edit', 'master/user/edit'),
(311, 'master', 'User', 'editUser', 'master/user/edituser'),
(312, 'master', 'User', 'updateUser', 'master/user/updateuser'),
(313, 'master', 'User', 'update', 'master/user/update'),
(314, 'master', 'User', 'delete', 'master/user/delete'),
(315, 'master', 'User', 'password_check', 'master/user/password_check'),
(316, 'master', 'User', 'editUser_redirect', 'master/user/edituser_redirect'),
(317, 'master', 'User', '__construct', 'master/user/__construct'),
(318, 'master', 'User', 'konfig', 'master/user/konfig'),
(319, 'master', 'User', 'upload_file', 'master/user/upload_file'),
(320, 'master', 'User', 'get_uri', 'master/user/get_uri'),
(321, 'master', 'User', 'log_activity', 'master/user/log_activity'),
(322, 'master', 'User', 'get_instance', 'master/user/get_instance');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(1, 'SmartSoftStudio'),
(2, 'KaryaStudio');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mime` varchar(255) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `name`, `mime`, `dir`, `table`, `table_id`, `status`, `created_at`, `updated_at`) VALUES
(40, '6950c16c9bcc6995f376b297f16317593930.png', 'image/png', 'webfile/6950c16c9bcc6995f376b297f16317593930.png', 'user', 1, NULL, NULL, '2019-02-18 16:07:47'),
(180, '6950c16c9bcc6995f376b297f163175965119.png', 'image/png', 'webfile/6950c16c9bcc6995f376b297f163175965119.png', 'user', 14, 'ENABLE', '2019-07-04 10:15:41', '2019-07-09 09:57:03'),
(181, '6950c16c9bcc6995f376b297f163175913789.png', 'image/png', 'webfile/6950c16c9bcc6995f376b297f163175913789.png', 'user', 15, 'ENABLE', '2019-07-04 10:50:13', NULL),
(184, '6950c16c9bcc6995f376b297f163175915577.png', 'image/png', 'webfile/6950c16c9bcc6995f376b297f163175915577.png', 'user', 16, 'ENABLE', '2019-07-08 11:10:54', NULL),
(195, '6950c16c9bcc6995f376b297f163175993352.pdf', 'application/pdf', 'webfile/6950c16c9bcc6995f376b297f163175993352.pdf', 'pengajuan_detail', 13, 'ENABLE', '2019-07-09 08:34:58', NULL),
(196, '6950c16c9bcc6995f376b297f1631759933521.pdf', 'application/pdf', 'webfile/6950c16c9bcc6995f376b297f1631759933521.pdf', 'pengajuan_detail', 14, 'ENABLE', '2019-07-09 08:34:58', NULL),
(197, '6950c16c9bcc6995f376b297f163175960531.pdf', 'application/pdf', 'webfile/6950c16c9bcc6995f376b297f163175960531.pdf', 'pengajuan_detail', 15, 'ENABLE', '2019-07-09 09:06:24', NULL),
(198, '6950c16c9bcc6995f376b297f1631759605311.pdf', 'application/pdf', 'webfile/6950c16c9bcc6995f376b297f1631759605311.pdf', 'pengajuan_detail', 16, 'ENABLE', '2019-07-09 09:06:25', NULL),
(199, '6950c16c9bcc6995f376b297f16317591331.png', 'image/png', 'webfile/6950c16c9bcc6995f376b297f16317591331.png', 'user', 18, 'ENABLE', '2019-07-10 08:48:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `history` text DEFAULT NULL,
  `history_status` enum('INFO','SUCCESS','WARNING','DANGER') DEFAULT NULL,
  `status` enum('ENABLE','DISABLE') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `disabled_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `user_id`, `pengajuan_id`, `title`, `history`, `history_status`, `status`, `created_at`, `disabled_at`) VALUES
(7, 15, 9, 'PENGAJUAN DIBUAT', 'Pengajuan Berhasil Dibuat dan Menunggu Di konfirmasi', 'INFO', 'ENABLE', '2019-07-09 08:34:58', NULL),
(8, 16, 10, 'PENGAJUAN DIBUAT', 'Pengajuan Berhasil Dibuat dan Menunggu Di konfirmasi', 'INFO', 'ENABLE', '2019-07-09 09:06:25', NULL),
(9, 1, 9, 'PENGAJUAN DIKONFIRMASI', 'Pengajuan Dikonfirmasi dan Menunggu Dikonfirmasi Lapangan', 'WARNING', 'ENABLE', '2019-07-09 09:11:06', NULL),
(11, 14, 9, 'PENGAJUAN DITERIMA', 'Pengajuan DTerima', 'SUCCESS', 'ENABLE', '2019-07-09 13:18:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konfig`
--

CREATE TABLE `konfig` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `status` enum('ENABLE','DISABLE') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfig`
--

INSERT INTO `konfig` (`id`, `slug`, `value`, `status`, `created_at`, `updated_at`) VALUES
(6, 'APPLICATION', 'TOR', 'ENABLE', '2019-02-18 15:28:44', '2019-07-04 09:10:15'),
(7, 'LOGO', 'http://www.pertanian.go.id/img/logo.png', 'ENABLE', '2019-02-18 15:29:32', '2019-04-29 10:56:09'),
(8, 'LOGIN_BACKGROUND', 'background-image: url(\'https://nnimgt-a.akamaihd.net/transform/v1/crop/frm/329BAVcZBn8aqT7nnn4ZEVK/6e211103-469d-4cd1-a988-cda00c31a067.jpg/r0_244_2000_1502_w1200_h678_fmax.jpg\');background-size: cover;background-position: center;', 'ENABLE', '2019-02-18 15:29:52', '2019-04-29 10:57:19'),
(9, 'COLOR_HEADER', 'background: linear-gradient(to right,#0052D4,#65C7F7);', 'DISABLE', '2019-02-18 15:30:24', '2019-02-18 15:31:08'),
(10, 'VERSION', '1.0.0', 'ENABLE', '2019-02-18 15:30:39', NULL),
(11, 'COPYRIGHT', '© 2019 <a href=\"http://smartsoftstudio.com/\" target=\"_blank\">SmartSoft Studio</a>.</strong> All rights     reserved.', 'ENABLE', '2019-02-18 15:32:01', '2019-02-19 10:27:32'),
(12, 'SKIN', 'skin-blue', 'ENABLE', '2019-02-18 15:34:01', '2019-07-04 09:09:29'),
(13, 'TITLE_APPLICATION', 'Smartsoft | Standard operation system', 'ENABLE', '2019-02-18 15:39:54', NULL),
(14, 'APPLICATION_SMALL', 'TOR', 'ENABLE', '2019-02-18 15:42:41', '2019-07-04 09:10:26'),
(15, 'LOGIN_BOX', 'background : #6f6f6f !important ; ', 'ENABLE', '2019-02-18 15:45:53', '2019-02-18 15:58:53'),
(16, 'TITLE_LOGIN_APPLICATION', 'Smartsoft | Login', 'ENABLE', '2019-02-18 15:47:41', NULL),
(17, 'LOGIN_TITLE', 'LOGIN ADMIN', 'ENABLE', '2019-02-18 15:48:55', NULL),
(24, 'LOGIN', '0', 'ENABLE', '2019-02-21 14:12:14', '2019-07-01 09:50:27'),
(25, 'email-template', '<!DOCTYPE html PUBLIC \'-//W3C//DTD XHTML 1.0 Strict//EN\' \'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\'>\r\n<html xmlns=\'http://www.w3.org/1999/xhtml\'>\r\n\r\n<head>\r\n    <meta http-equiv=\'Content-Type\' content=\'text/html; charset=utf-8\' />\r\n    <meta name=\'viewport\' content=\'width=device-width\' />\r\n\r\n\r\n    <style type=\'text/css\'>\r\n        /* Your custom styles go here */\r\n        * {\r\n            margin: 0;\r\n            padding: 0;\r\n            font-size: 100%;\r\n            font-family: \'Avenir Next\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;\r\n            line-height: 1.65;\r\n        }\r\n\r\n        img {\r\n            max-width: 100%;\r\n            margin: 0 auto;\r\n            display: block;\r\n        }\r\n\r\n        body,\r\n        .body-wrap {\r\n            width: 100% !important;\r\n            height: 100%;\r\n            background: #f8f8f8;\r\n        }\r\n\r\n        a {\r\n            color: #71bc37;\r\n            text-decoration: none;\r\n        }\r\n\r\n        a:hover {\r\n            text-decoration: underline;\r\n        }\r\n\r\n        .text-center {\r\n            text-align: center;\r\n        }\r\n\r\n        .text-right {\r\n            text-align: right;\r\n        }\r\n\r\n        .text-left {\r\n            text-align: left;\r\n        }\r\n\r\n        .button {\r\n            display: inline-block;\r\n            color: white;\r\n            background: #71bc37;\r\n            border: solid #71bc37;\r\n            border-width: 10px 20px 8px;\r\n            font-weight: bold;\r\n            border-radius: 4px;\r\n        }\r\n\r\n        .button:hover {\r\n            text-decoration: none;\r\n        }\r\n\r\n        h1,\r\n        h2,\r\n        h3,\r\n        h4,\r\n        h5,\r\n        h6 {\r\n            margin-bottom: 20px;\r\n            line-height: 1.25;\r\n        }\r\n\r\n        h1 {\r\n            font-size: 32px;\r\n        }\r\n\r\n        h2 {\r\n            font-size: 28px;\r\n        }\r\n\r\n        h3 {\r\n            font-size: 24px;\r\n        }\r\n\r\n        h4 {\r\n            font-size: 20px;\r\n        }\r\n\r\n        h5 {\r\n            font-size: 16px;\r\n        }\r\n\r\n        p,\r\n        ul,\r\n        ol {\r\n            font-size: 16px;\r\n            font-weight: normal;\r\n            margin-bottom: 20px;\r\n        }\r\n\r\n        .container {\r\n            display: block !important;\r\n            clear: both !important;\r\n            margin: 0 auto !important;\r\n            max-width: 580px !important;\r\n        }\r\n\r\n        .container table {\r\n            width: 100% !important;\r\n            border-collapse: collapse;\r\n        }\r\n\r\n        .container .masthead {\r\n            padding: 80px 0;\r\n            background: #71bc37;\r\n            color: white;\r\n        }\r\n\r\n        .container .masthead h1 {\r\n            margin: 0 auto !important;\r\n            max-width: 90%;\r\n            text-transform: uppercase;\r\n        }\r\n\r\n        .container .content {\r\n            background: white;\r\n            padding: 30px 35px;\r\n        }\r\n\r\n        .container .content.footer {\r\n            background: none;\r\n        }\r\n\r\n        .container .content.footer p {\r\n            margin-bottom: 0;\r\n            color: #888;\r\n            text-align: center;\r\n            font-size: 14px;\r\n        }\r\n\r\n        .container .content.footer a {\r\n            color: #888;\r\n            text-decoration: none;\r\n            font-weight: bold;\r\n        }\r\n\r\n        .container .content.footer a:hover {\r\n            text-decoration: underline;\r\n        }\r\n\r\n    </style>\r\n</head>\r\n\r\n<body>\r\n    <table class=\'body-wrap\'>\r\n        <tr>\r\n            <td class=\'container\'>\r\n                <table>\r\n                    <tr>\r\n                        <td align=\'center\' class=\'masthead\'>\r\n                            <h1>Title</h1>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td class=\'content\'>\r\n                            <h2>\r\n{$title}</h2>\r\n                            <p>Kielbasa venison ball tip shankle. Boudin prosciutto landjaeger, pancetta jowl turkey tri-tip porchetta beef pork loin drumstick. Frankfurter short ribs kevin pig ribeye drumstick bacon kielbasa. Pork loin brisket biltong, pork belly filet mignon ribeye pig ground round porchetta turducken turkey. Pork belly beef ribs sausage ham hock, ham doner frankfurter pork chop tail meatball beef pig meatloaf short ribs shoulder. Filet mignon ham hock kielbasa beef ribs shank. Venison swine beef ribs sausage pastrami shoulder.</p>\r\n\r\n                            <table>\r\n                                <tr>\r\n                                    <td align=\'center\'>\r\n                                        <p>\r\n                                            <a href=\'#\' class=\'button\'>Share the Awesomeness</a>\r\n                                        </p>\r\n                                    </td>\r\n                                </tr>\r\n                            </table>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td class=\'container\'>\r\n                <table>\r\n                    <tr>\r\n                        <td class=\'content footer\' align=\'center\'>\r\n                            <p>Sent by <a href=\'#\'>Company Name</a>, 1234 Yellow Brick Road, OZ, 99999</p>\r\n                            <p><a href=\'mailto:\'\'>hello@company.com</a> | <a href=\'#\'\'>Unsubscribe</a></p>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n            </td>\r\n        </tr>\r\n    </table>\r\n</body>\r\n\r\n</html>\r\n', 'ENABLE', NULL, NULL),
(26, 'FILE UPLOAD', '2', 'ENABLE', '2019-07-08 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_master`
--

CREATE TABLE `menu_master` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `urutan` varchar(255) DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL,
  `notif` varchar(255) DEFAULT NULL,
  `status` enum('ENABLE','DISABLE') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_master`
--

INSERT INTO `menu_master` (`id`, `name`, `icon`, `link`, `urutan`, `parent`, `notif`, `status`, `created_at`, `updated_at`) VALUES
(24, 'Pengaruan', 'fa fa-cogs', '#', '3', '0', '', 'ENABLE', '2019-07-04 10:42:16', '2019-07-10 13:37:53'),
(22, 'Data Pengajuan', 'fa fa-file', '/pengajuan', '1', '0', '', 'ENABLE', '2019-07-03 15:35:44', '2019-07-04 14:52:47'),
(23, 'User', 'fa fa-user', '/user', '2', '0', '', 'ENABLE', '2019-07-04 10:10:48', '2019-07-04 15:02:23'),
(20, 'Dashboard', 'fa fa-dashboard', '/', '0', '0', '', 'ENABLE', '2019-07-03 14:53:31', '2019-07-03 14:53:46'),
(25, 'Pengaturan menu', 'mdi mdi-folder-network', '/menu_master', '0', '24', '', 'ENABLE', '2019-07-10 13:37:15', NULL),
(26, 'Role', 'fa fa-info', '/role', '1', '24', '', 'ENABLE', '2019-07-10 13:39:50', '2019-07-10 13:41:19'),
(27, 'Konfig', 'fa fa-link', '/konfig', '2', '24', '', 'ENABLE', '2019-07-10 13:40:43', '2019-07-10 13:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `notif_desc` text DEFAULT NULL,
  `read_on` enum('ENABLE','DISABLE') DEFAULT NULL,
  `status` enum('ENABLE','DISABLE') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `role_id`, `pengajuan_id`, `title`, `notif_desc`, `read_on`, `status`, `created_at`, `updated_at`) VALUES
(8, 15, 17, 9, 'PENGAJUAN DOKUMENT', 'Perlu Dikonfirmasi', 'ENABLE', 'ENABLE', '2019-07-09 08:34:59', NULL),
(9, 16, 17, 10, 'PENGAJUAN DOKUMENT', 'Perlu Dikonfirmasi', 'ENABLE', 'ENABLE', '2019-07-09 09:06:25', NULL),
(12, 15, 24, 9, 'PENGAJUAN DIKONFIRMASI', 'Menunggu untuk Dikonfirmasi Lapangan', 'DISABLE', 'ENABLE', '2019-07-09 13:16:59', NULL),
(13, 15, 23, 9, 'PENGAJUAN DIKONFIRMASI', 'Menunggu untuk Dikonfirmasi Lapangan', 'DISABLE', 'ENABLE', '2019-07-09 13:16:59', NULL),
(14, 15, 24, 9, 'PENGAJUAN DITERIMA', 'Diterima Dilapangan', 'DISABLE', 'ENABLE', '2019-07-09 13:18:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `judul` varchar(225) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `approve` enum('PROCESS','PROCESS2','ACCEPT','REJECT') DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` enum('ENABLE','DISABLE') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `user_id`, `judul`, `keterangan`, `approve`, `note`, `status`, `created_at`, `updated_at`) VALUES
(9, 15, 'Ini Pengajuan dari User 1', 'Ini isi pengajuan dari user 1', 'ACCEPT', 'Catatan Master', 'ENABLE', '2019-07-09 08:34:57', NULL),
(10, 16, 'Pengajuan dari User 2', 'Ini isi pengajuan dari user 2', 'PROCESS', NULL, 'ENABLE', '2019-07-09 09:06:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_detail`
--

CREATE TABLE `pengajuan_detail` (
  `id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `file` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `approve` enum('PROCESS','ACCEPT','REJECT') NOT NULL,
  `approve2` enum('PROCESS','ACCEPT','REJECT') NOT NULL,
  `status` enum('ENABLE','DISABLE') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan_detail`
--

INSERT INTO `pengajuan_detail` (`id`, `pengajuan_id`, `file`, `note`, `approve`, `approve2`, `status`, `created_at`, `updated_at`) VALUES
(13, 9, 'sample.pdf', 'catatan file 1', 'ACCEPT', 'ACCEPT', 'ENABLE', '2019-07-09 08:34:57', NULL),
(14, 9, 'your_filename.pdf', 'catatan file 2', 'ACCEPT', 'ACCEPT', 'ENABLE', '2019-07-09 08:34:58', NULL),
(15, 10, 'sample.pdf', '', 'PROCESS', 'PROCESS', 'ENABLE', '2019-07-09 09:06:24', NULL),
(16, 10, 'your_filename.pdf', '', 'PROCESS', 'PROCESS', 'ENABLE', '2019-07-09 09:06:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` enum('DISABLE','ENABLE') DEFAULT NULL,
  `menu` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `status`, `menu`, `created_at`, `updated_at`) VALUES
(17, 'Admin', 'ENABLE', '[\"20\",\"22\",\"23\",\"24\",\"25\",\"26\",\"27\"]', '2018-10-12 17:03:59', '2019-07-10 13:50:44'),
(23, 'Admin Lapangan', 'ENABLE', '[\"20\",\"22\"]', '2019-07-04 10:13:35', '2019-07-10 13:50:33'),
(24, 'Pengaju', 'ENABLE', '[\"20\",\"22\"]', '2019-07-04 10:48:31', '2019-07-10 13:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nib` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `verification` enum('TRUE','FALSE') NOT NULL,
  `status` varchar(255) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nib`, `name`, `email`, `password`, `role_id`, `desc`, `verification`, `status`, `created_at`, `updated_at`) VALUES
(1, '1234312', 'Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 17, 'asda', 'TRUE', '0', '2018-02-23 16:09:49', '2019-07-04 10:09:13'),
(14, '23521', 'Admin APP', 'adminapp@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 23, 'asd', 'TRUE', '0', '2019-07-04 10:15:41', '2019-07-09 09:57:05'),
(15, '23123123', 'User', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 24, 'user', 'TRUE', '0', '2019-07-04 10:50:11', NULL),
(16, '123124', 'User 2', 'user2@gmail.com', '7e58d63b60197ceb55a1c487989a3720', 24, 'Ini User ke 2', 'TRUE', '0', '2019-07-08 11:10:54', NULL),
(18, '123123', 'Bagus Andika', 'procw57@gmail.com', 'b3c9323ca84c0f3e6ea210cd31c9ea7a', 24, 'eqwe', 'FALSE', '0', '2019-07-10 08:48:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `access_control`
--
ALTER TABLE `access_control`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfig`
--
ALTER TABLE `konfig`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `menu_master`
--
ALTER TABLE `menu_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_detail`
--
ALTER TABLE `pengajuan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `access_control`
--
ALTER TABLE `access_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `konfig`
--
ALTER TABLE `konfig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `menu_master`
--
ALTER TABLE `menu_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengajuan_detail`
--
ALTER TABLE `pengajuan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
