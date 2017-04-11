-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2017 at 01:04 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_permission`
--

CREATE TABLE `account_permission` (
  `account_permission_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account_permission`
--

INSERT INTO `account_permission` (`account_permission_id`, `name`, `description`) VALUES
(1, 'Manage Assigned Project', 'User can view and manage only assigned projects to him. Project status update, document upload/view, project discussion will be available to assigned projects'),
(2, 'Manage All Projects', ''),
(3, 'Manage Clients', ''),
(4, 'Manage Staffs', ''),
(5, 'Manage Payment', ''),
(6, 'Manage Assigned Support Ticket', ''),
(7, 'Manage All Support Tickets', '');

-- --------------------------------------------------------

--
-- Table structure for table `account_role`
--

CREATE TABLE `account_role` (
  `account_role_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `account_permissions` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account_role`
--

INSERT INTO `account_role` (`account_role_id`, `name`, `account_permissions`) VALUES
(10, 'Designer', '1,'),
(11, 'Developer', '1,'),
(12, 'Nhân viên nhập liệu', '1,6,7,'),
(13, 'Nhân viên kinh doanh', ''),
(14, 'Quản lý dự án', '1,2,3,5,');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `chat_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'offline',
  `owner_status` int(11) NOT NULL DEFAULT '0' COMMENT '1 owner, 0 not owner'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `phone`, `address`, `chat_status`, `owner_status`) VALUES
(1, 'Tai Bui', 'taibui@mypage.vn', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '', 'offline', 1),
(7, 'qhxh', 'qhxh@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '21251212521', '', 'offline', 0),
(8, 'admin', 'quanghuong1991@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '01228142815', '', 'offline', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `bookmark_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calendar_event`
--

CREATE TABLE `calendar_event` (
  `calendar_event_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `end_timestamp` int(11) NOT NULL,
  `colour` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `calendar_event`
--

INSERT INTO `calendar_event` (`calendar_event_id`, `title`, `description`, `user_type`, `user_id`, `start_timestamp`, `end_timestamp`, `colour`) VALUES
(1, 'Tất niên', 'Tất niên 2016', 'admin', 8, '1485212400', 1485298800, '#279ACB'),
(2, 'Đá banh ', 'Giải đá banh 2017', 'admin', 7, '1491516000', 1492466400, '#E93339');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('13eca50dc95b4cb11955feed075e9ba5c1e5c42e', '127.0.0.1', 1491903060, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930323737353b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('232628fd16795b1e32d181202758257804ab9e31', '127.0.0.1', 1491908519, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930383232303b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('2a970c33ec52fcdf22715ee2156f8e6e4540ae44', '127.0.0.1', 1491903091, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930333039313b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('6035f1be66dc3ad62af759c5518c16cb42945e9b', '127.0.0.1', 1491903701, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930333432323b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('61eeac3ddf0fd48df86ec778fbc0727ab4f9b2bc', '127.0.0.1', 1491907553, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930373330333b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('7fcc50c6d6efc976aefd60c7cc15ef8682a599b5', '127.0.0.1', 1491904361, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930343036333b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('8536a03a10e58cbefdbc6c5b9b00f10104f57dec', '127.0.0.1', 1491902754, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930323432393b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('8abd6fe998381c5458faa077281a4c3086d45a05', '127.0.0.1', 1491904666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930343337383b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('8cefeb78f0642631f2ec9c659c6e50242c55ebdb', '127.0.0.1', 1491905084, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930343830393b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('96541695150fa2b244528ce480a180404459c4ce', '127.0.0.1', 1491906567, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930363237333b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('9c22d62a141b1a8b3615f754f0ac438813c2ce5b', '127.0.0.1', 1491901705, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930313430383b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b666c6173685f6d6573736167657c733a31323a225468c3a06e682063c3b46e67223b5f5f63695f766172737c613a313a7b733a31333a22666c6173685f6d657373616765223b733a333a226f6c64223b7d),
('a4fcc3f0616d4e2ad0e87d42a53f90f7e0a8d064', '127.0.0.1', 1491908620, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930383532313b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('a892ed45d34826c24266dca0cc3e22a564276eb4', '127.0.0.1', 1491901722, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930313731393b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('bc0f71be99fba26edbc22ce68bb738239ce91ed8', '127.0.0.1', 1491906933, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930363636303b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('c409f33aad8c90a1fe64f022fc31c6e62dd32a10', '127.0.0.1', 1491905832, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930353533353b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('c4b69e442c58ef6cb268bc34ecbda2c619cc2a85', '127.0.0.1', 1491904023, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930333732333b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('d7b7d7f48cd9dbd20767a058ff22d2621fd18bb8', '127.0.0.1', 1491905342, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930353131303b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('dd978ad8259e10b181d7f0099d70324f84c7168b', '127.0.0.1', 1491907233, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930363938343b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('e4885e2327c955702ee1229c03054ecba76cfb6a', '127.0.0.1', 1491902246, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930323037343b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('e7fc598849b8ef7ae91c7da3da7789e06db65e48', '127.0.0.1', 1491908161, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930373839383b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('ea5e995578aa92c3044f68c078e462b1e21c335d', '127.0.0.1', 1491905997, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930353932353b61646d696e5f6c6f67696e7c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2237223b6e616d657c733a343a2271687868223b6c6f67696e5f747970657c733a353a2261646d696e223b),
('ee9b06c09a17e37ea2571996b2bb4f561d001de8', '127.0.0.1', 1491908672, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313930383637323b);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `website` longtext COLLATE utf8_unicode_ci NOT NULL,
  `skype_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `facebook_profile_link` longtext COLLATE utf8_unicode_ci NOT NULL,
  `linkedin_profile_link` longtext COLLATE utf8_unicode_ci NOT NULL,
  `twitter_profile_link` longtext COLLATE utf8_unicode_ci NOT NULL,
  `short_note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `chat_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'offline'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `name`, `email`, `password`, `address`, `phone`, `website`, `skype_id`, `facebook_profile_link`, `linkedin_profile_link`, `twitter_profile_link`, `short_note`, `chat_status`) VALUES
(1, 'Nguyễn Minh Đăng', 'minhdang1111@gmail.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '314/74/31 Âu Dương Lân, Phường 3, Quận 8', '0933365989', '', '', '', '', '', '', 'offline'),
(29, 'khách hàng test 4', 'kh_test4@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', '', '', '', '', '', 'offline'),
(3, 'Bùi Tài', 'info@mypage.com.vn', 'ac75373a0850e2a29a6d7dd9cff2f84eb8fd013a', '294/7 Xô Viết Nghệ Tĩnh, Phường 21, Quận Bình Thạnh', '0933365989', '', '', '', '', '', '', 'offline'),
(4, 'khachhang1', 'khachhang1@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '121/texas USA', '0652125125', 'khachang.com', 'khachhangsype', 'fb/khachhang1', '', '', '', 'offline'),
(5, 'dinh huong', 'quanghuong@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '', '', '', '', '', '', '', '', 'offline'),
(33, 'Khách hàng test 6', 'kh_test6@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '123,Đinh Quang Hưởng, Sài Gòn. VN', '', '', '', '', '', '', '', 'offline'),
(11, 'Khách hàng 7', 'khachhang7@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', 'Califorlia , USA', '0021215121', '', '', '', '', '', '', 'offline'),
(13, 'Khach hang test 111', 'khachhang20@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '123,texas.UES', '4545434354', '', 'test11skepe', '', '', '', '', 'offline'),
(34, 'Khách hàng 8', 'kh_test8@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '', '', '', '', '', '', '', '', 'offline'),
(27, 'Khach hang test 2', 'kh_test2@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '', '', '', '', '', '', '', '', 'offline'),
(28, 'Khách hàng test 3', 'kh_test3@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '502, california USA', '0021215121', 'kh3.com', 'kh3_skype', '', '', '', '', 'offline'),
(16, 'khach hang 12', 'khachhang12@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '2012, califorlia', '0125151211', '', '', '', '', '', '', 'offline'),
(35, 'Khách hàng 8', 'kh_test8@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '', '', '', '', '', '', '', '', 'offline'),
(18, 'Khach hang 200', 'khachhang200@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '123, Thiểm Tay, Trung Quóc', '145454546', '', '', '', '', '', '', 'offline'),
(32, 'KH Test 5', 'kh_test5@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '123, Tô Nam Tinh, Quảng Châu, Trung Quốc', '', '', '', '', '', '', '', 'offline'),
(36, 'Khách hàng 9', 'kh_test9@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', '', '', '', '', '', '', '', '', 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `client_pending`
--

CREATE TABLE `client_pending` (
  `client_pending_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `website` longtext COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `name`, `email`, `address`, `phone`, `website`, `client_id`) VALUES
(1, 'Công ty cổ phần truyền thông iBranding', 'info@ibranding.vn', '143 Đường 17A, Khu B An Phú, An Khánh, An Phú, Q2', '0933365989', 'www.ibranding.vn', 1),
(2, 'Công ty trách nhiệm hữu hạn QHXH', 'qhxh@yahoo.com', '124/32 texas ÚSA', '012251215412', 'qhxhstudio.com', 5),
(5, 'Cong ty Ajinomoto', 'ajinomoto', '545, Osaka, Nhật Bản', '00654512151', 'aji.com', 11),
(7, 'Cong ty Test 13', 'rom@gmail.com', 'Roma, italy ', '6513215412', 'rom.com', 11),
(14, 'Cong ty 101', '101@gmail.com', '212, Bình Thạnh, HCM', '541654615', '101asc.com', 18),
(15, 'Công ty 900', 'jajaj@gmail.com', '213,Phú Sơn, TRảng Bom, Đông Nai', '231232131213', 'asda.com', 13),
(17, 'Công ty Giấy Bình Minh', 'giaybinhminh@yahoo.com', '25/25 Đống Đa, Hà Nôi', '01251421442', 'giaybinhminh.com', 4),
(20, 'Tổng Cong Ty Xây dụng sô 5', '', '123,Đinh Quang Hưởng, Sài Gòn. VN', '01228142158', '', 16),
(23, 'Công ty test 6', 'Congtyte@ha.com', '201,64 LA, USA', '08554512454', '', 33),
(24, 'Cong ty test 7', '', '454, LA, USA', '01228142158', '', 11);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `currency_id` int(11) NOT NULL,
  `currency_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `currency_symbol` longtext COLLATE utf8_unicode_ci NOT NULL,
  `currency_name` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`currency_id`, `currency_code`, `currency_symbol`, `currency_name`) VALUES
(1, 'USD', '$', 'US dollar'),
(2, 'GBP', '£', 'Pound'),
(3, 'EUR', '€', 'Euro'),
(4, 'AUD', '$', 'Australian Dollar'),
(5, 'CAD', '$', 'Canadian Dollar'),
(6, 'JPY', '¥', 'Japanese Yen'),
(7, 'NZD', '$', 'N.Z. Dollar'),
(8, 'CHF', 'Fr', 'Swiss Franc'),
(9, 'HKD', '$', 'Hong Kong Dollar'),
(10, 'SGD', '$', 'Singapore Dollar'),
(11, 'SEK', 'kr', 'Swedish Krona'),
(12, 'DKK', 'kr', 'Danish Krone'),
(13, 'PLN', 'zł', 'Polish Zloty'),
(14, 'HUF', 'Ft', 'Hungarian Forint'),
(15, 'CZK', 'Kč', 'Czech Koruna'),
(16, 'MXN', '$', 'Mexican Peso'),
(17, 'CZK', 'Kč', 'Czech Koruna'),
(18, 'VND', 'VND', 'Việt Nam đồng');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `email_template_id` int(11) NOT NULL,
  `task` longtext COLLATE utf8_unicode_ci NOT NULL,
  `subject` longtext COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `instruction` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`email_template_id`, `task`, `subject`, `body`, `instruction`) VALUES
(1, 'new_project_opening', 'Dự án mới được tạo', '<span>\r\n<div>Xin chào, [CLIENT_NAME], <br>Dự án của bạn đã được tạo trong hệ thống của chúng tôi<br><br>Tên &nbsp;dự án : [PROJECT_NAME]<br>Mời bạn vào link sau để theo dõi thông tin và tiến trình dự án.<br>[PROJECT_LINK]</div></span>', ''),
(2, 'new_client_account_opening', 'Client account creation', '<span><div>Hi [CLIENT_NAME],</div></span>Your client account is created !<span>Please login to your client account panel here :&nbsp;<br></span>[SYSTEM_URL]<br>Login credential :<br>email : [CLIENT_EMAIL]<br>password : [CLIENT_PASSWORD]', ''),
(3, 'new_staff_account_opening', 'Staff account creation', '<span>\n<div><div>Hi [STAFF_NAME],</div>Your staff account is created !&nbsp;Please login to your staff account panel here :&nbsp;<br>[SYSTEM_URL]<br>Login credential :<br>email : [STAFF_EMAIL]<br>password : [STAFF_PASSWORD]<br></div></span>', ''),
(4, 'payment_completion_notification', 'Payment completion notification', '<span>\n<div>Your payment of invoice [INVOICE_NUMBER] is completed.<br>You can review your payment history here :<br>[SYSTEM_PAYMENT_URL]</div></span>', ''),
(5, 'new_support_ticket_notify_admin', 'New support ticket notification', 'Hi [ADMIN_NAME],<br>A new support ticket is submitted. Ticket code : [TICKET_CODE]<br><br>Review all opened support tickets here :<br>[SYSTEM_OPENED_TICKET_URL]<br>', ''),
(6, 'support_ticket_assign_staff', 'Support ticket assignment notification', 'Hi [STAFF_NAME],<br>A new support ticket is assigned. Ticket code : [TICKET_CODE]<br><br>Review all opened support tickets here :<br>[SYSTEM_OPENED_TICKET_URL]', ''),
(7, 'new_message_notification', 'New message notification.', 'A new message has been sent by [SENDER_NAME].<br><br><span class="wysiwyg-color-silver">[MESSAGE]<br></span><br><span>To reply to this message, login to your account :<br></span>[SYSTEM_URL]', ''),
(8, 'password_reset_confirmation', 'Password reset notification', 'Hi [NAME],<br>Your password is reset. New password : [NEW_PASSWORD]<br>Login here with your new password :<br>[SYSTEM_URL]<br><br>You can change your password after logging in to your account.', ''),
(9, 'new_client_account_confirm', 'New Client account confirmed', '<span><div>Hi [CLIENT_NAME],</div></span>Your client account is confirmed!<span>Please login to your client account panel here :&nbsp;<br></span>[SYSTEM_URL]<br>', ''),
(10, 'new_admin_account_creation', 'Admin Account Creation', '<span><div>Hi [ADMIN_NAME],</div></span>Your admin account is created !<span>Please login to your admin account panel here :&nbsp;<br></span>[SYSTEM_URL]<br>Login credential :<br>email : [ADMIN_EMAIL]<br>password : [ADMIN_PASSWORD]', '');

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `expense_category_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`expense_category_id`, `title`, `description`) VALUES
(1, 'Staff Salary ', 'salary for staffs'),
(2, 'Inventory Purchase', 'purchases for office'),
(3, 'Office Equipments', 'new purchases'),
(4, 'Project Expense', 'expenses on client projects'),
(5, 'New Category', 'sample description'),
(6, 'Office Expense', 'Chi phí văn phòng');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_entries` longtext COLLATE utf8_unicode_ci NOT NULL,
  `creation_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `due_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'paid or unpaid',
  `vat_percentage` longtext COLLATE utf8_unicode_ci NOT NULL,
  `discount_amount` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `phrase_id` int(11) NOT NULL,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Vietnamese` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `Vietnamese`) VALUES
(1, 'login', 'Login', 'Đăng nhập'),
(2, 'forgot_password', 'Forgot Password', 'Quên mật khẩu'),
(3, 'create_new_account', 'Create New Account', 'Tạo tài khoản'),
(4, 'reset_password', 'Reset Password', 'Đặt lại mật khẩu'),
(5, 'return_to_login_page', 'Return To Login Page', 'Trở lại trang Đăng nhập'),
(6, 'admin_dashboard', 'Admin Dashboard', 'Tổng quan - Admin'),
(7, 'welcome', 'Welcome', 'Chào mừng'),
(8, 'edit_profile', 'Edit Profile', 'Chỉnh sửa hồ sơ thông tin'),
(9, 'change_password', 'Change Password', 'Thay đổi mật khẩu'),
(10, 'dashboard', 'Dashboard', 'Trang tổng quan'),
(11, 'client', 'Client', 'Khách hàng'),
(12, 'person', 'Person', 'Cá nhân'),
(13, 'company', 'Company', 'Công ty'),
(14, 'team', 'Team', 'Nhân viên'),
(15, 'admin', 'Admin', 'Admin'),
(16, 'staff', 'Staff', 'Nhân viên'),
(17, 'permission', 'Permission', 'Phân quyền'),
(18, 'client_project', 'Client Project', 'Dự án'),
(19, 'project_list', 'Project List', 'Danh sách dự án'),
(20, 'create_project', 'Create Project', 'Tạo dự án mới'),
(21, 'project_quote', 'Project Quote', 'Bảng giá dự án'),
(22, 'team_task', 'Team Task', 'Công việc'),
(23, 'running_tasks', 'Running Tasks', 'Công việc đang tiến hành'),
(24, 'archived_tasks', 'Archived Tasks', 'Công việc đã lưu trữ'),
(25, 'calendar', 'Calendar', 'Lịch'),
(26, 'message', 'Message', 'Tin nhắn'),
(27, 'note', 'Note', 'Ghi chú'),
(28, 'accounting', 'Accounting', 'Kế toán'),
(29, 'client_payment', 'Client Payment', 'Thanh toán'),
(30, 'expense_management', 'Expense Management', 'Quản lý chi phí'),
(31, 'expense_category', 'Expense Category', 'Danh mục chi phí'),
(32, 'report', 'Report', 'Báo cáo'),
(33, 'project_report', 'Project Report', 'Báo cáo dự án'),
(34, 'client_report', 'Client Report', 'Báo cáo khách hàng'),
(35, 'expense_report', 'Expense Report', 'Báo cáo chi phí'),
(36, 'income_expense_comparison', 'Income Expense Comparison', 'So sánh doanh thu - chi phí'),
(37, 'client_support', 'Client Support', 'Hỗ trợ khách hàng'),
(38, 'ticket_list', 'Ticket List', 'Danh sách thẻ hỗ trợ'),
(39, 'create_ticket', 'Create Ticket', 'Tạo thẻ hỗ trợ'),
(40, 'settings', 'Settings', 'Thiết lập'),
(41, 'system_settings', 'System Settings', 'Cài đặt hệ thống'),
(42, 'email_settings', 'Email Settings', 'Cài đặt email'),
(43, 'payment_settings', 'Payment Settings', 'Cài đặt thanh toán'),
(44, 'language_settings', 'Language Settings', 'Cài đặt ngôn ngữ'),
(45, 'view_all_messages', 'View All Messages', 'Xem tất cả tin nhắn'),
(46, 'running_projects', 'Running Projects', 'Các dự án đang thực hiện'),
(47, 'view_all_projects', 'View All Projects', 'Xem tất cả dự án'),
(48, 'account', 'Account', 'Tài khoản'),
(49, 'todo', 'Everything', 'Công việc'),
(50, 'total_client', 'Total Client', 'Tổng số khách hàng'),
(51, 'team_member', 'Team Member', 'Thành viên'),
(52, 'pending_invoice', 'Pending Invoice', 'Hoá đơn chờ thanh toán'),
(53, 'opened_support_ticket', 'Opened Support Ticket', 'Thẻ hỗ trợ mở'),
(54, 'running_project', 'Running Project', 'Dự án đang thực hiện'),
(55, 'pending_team_task', 'Pending Team Task', 'Công việc chờ xử lý'),
(56, 'income_graph', 'Income Graph', 'Đồ thị doanh thu'),
(57, 'projects', 'Projects', 'Dự án'),
(58, 'expense', 'Expense', 'Chi phí'),
(59, 'income', 'Income', 'Doanh thu'),
(60, 'event_calendar', 'Event Calendar', 'Lịch sự kiện'),
(61, 'add', 'Add', 'Thêm'),
(62, 'mark_incomplete', 'Mark Incomplete', 'Đánh dấu chưa hoàn thành'),
(63, 'move_up', 'Move Up', 'Di chuyển lên'),
(64, 'move_down', 'Move Down', 'Di chuyển xuống'),
(65, 'delete', 'Delete', 'Xoá'),
(66, 'mark_completed', 'Mark Completed', 'Đánh dấu đã hoàn thành'),
(67, 'cancel', 'Cancel', 'Huỷ'),
(68, 'manage_client', 'Manage Client', 'Quản lý khách hàng'),
(69, 'add_new_client', 'Add New Client', 'Thêm khách hàng'),
(70, 'clients', 'Clients', 'Khách hàng'),
(71, 'pending_clients', 'Pending Clients', 'Khách hàng còn tồn đọng'),
(72, 'name', 'Name', 'Tên'),
(73, 'address', 'Address', 'Địa chỉ'),
(74, 'project', 'Project', 'Dự án'),
(75, 'email', 'Email', 'Email'),
(76, 'skype', 'Skype', 'Skype'),
(77, 'phone', 'Phone', 'Điện thoại'),
(78, 'website', 'Website', 'Website'),
(79, 'contact', 'Contact', 'Liên hệ'),
(80, 'options', 'Options', 'Tuỳ chọn'),
(81, 'call_skype', 'Call Skype', 'Gọi qua Skype'),
(82, 'send_email', 'Send Email', 'Gửi email'),
(83, 'call_phone', 'Call Phone', 'Gọi điện thoại'),
(84, 'facebook_profile', 'Facebook Profile', 'Hồ sơ thông tin trên Facebook'),
(85, 'twitter_profile', 'Twitter Profile', 'Hồ sơ thông tin trên Twitter'),
(86, 'linkedin_profile', 'Linkedin Profile', 'Hồ sơ thông tin trên Linkedin'),
(87, 'view_profile', 'View Profile', 'Xem hồ sơ thông tin'),
(88, 'edit_client', 'Edit Client', 'Hoàn tất chỉnh sửa'),
(89, 'delete_client', 'Delete Client', 'Xoá khách hàng'),
(90, 'profile', 'Profile', 'Hồ sơ thông tin'),
(91, 'edit', 'Edit', 'Sửa'),
(92, 'manage_pending_client', 'Manage Pending Client', 'Quản lý khách hàng còn tồn đọng'),
(93, 'approve', 'Approve', 'Phê duyệt'),
(94, 'account_creation_form', 'Account Creation Form', 'Bảng tạo tài khoản'),
(95, 'value_required', 'Value Required', 'Giá trị yêu cầu'),
(96, 'password', 'Password', 'Mật khẩu'),
(97, 'skype_id', 'Skype Id', 'Tài khoản skype'),
(98, 'facebook_profile_link', 'Facebook Profile Link', 'Đường dẫn hồ sơ thông tin trên facebook'),
(99, 'linkedin_profile_link', 'Linkedin Profile Link', 'Đường dẫn hồ sơ thông tin trên linkedin'),
(100, 'twitter_profile_link', 'Twitter Profile Link', 'Đường dẫn hồ sơ thông tin trên twitter'),
(101, 'short_note', 'Short Note', 'Ghi chú ngắn'),
(102, 'photo', 'Photo', 'Hình ảnh'),
(103, 'notify_client', 'Notify Client', 'Thông báo khách hàng'),
(104, 'add_client', 'Add Client', 'Thêm khách hàng'),
(105, 'add_new_company', 'Add New Company', 'Thêm công ty'),
(106, 'associated_person', 'Associated Person', 'Người liên hệ'),
(107, 'payments', 'Payments', 'Thanh toán'),
(108, 'total_project', 'Total Project', 'Tổng dự án'),
(109, 'update_company', 'Update Company', 'Cập nhật công ty'),
(110, 'select_associated_person', 'Select Associated Person', 'Chọn người liên hệ'),
(111, 'update', 'Update', 'Cập nhật'),
(112, 'add_company', 'Add Company', 'Thêm công ty'),
(113, 'manage_admins', 'Manage Admins', 'Quản lý admins'),
(114, 'add_new_admin', 'Add New Admin', 'Thêm mới admin'),
(115, 'type', 'Type', 'Loại'),
(116, 'owner', 'Owner', 'Chủ'),
(117, 'administrator', 'Administrator', 'Người quản lý'),
(118, 'create_new_admin', 'Create New Admin', 'Tạo mới admin'),
(119, 'admin_type', 'Admin Type', 'Loại admin'),
(120, 'notify_this_admin', 'Notify This Admin', 'Thông báo tới admin'),
(121, 'add_admin', 'Add Admin', 'Hoàn tất'),
(122, 'role', 'Role', 'Chức vụ'),
(123, 'update_admin_data', 'Update Admin Data', 'Cập nhật dữ liệu admin'),
(124, 'edit_admin', 'Edit Admin', 'Hoàn tất chỉnh sửa'),
(125, 'manage_staff', 'Manage Staff', 'Quản lý nhân viên'),
(126, 'add_new_staff', 'Add New Staff', 'Thêm mới nhân viên'),
(127, 'account_role', 'Account Role', 'Chức vụ'),
(128, 'select_a_role', 'Select A Role', 'Chọn một vị trí công việc'),
(129, 'notify_staff', 'Notify Staff', 'Thông báo cho nhân viên'),
(130, 'add_staff', 'Add Staff', 'Thêm nhân viên'),
(131, 'visit_facebook_profile', 'Visit Facebook Profile', 'Xem hồ sơ thông tin trên facebook'),
(132, 'visit_twitter_profile', 'Visit Twitter Profile', 'Xem hồ sơ thông tin trên twitter'),
(133, 'visit_linkedin_profile', 'Visit Linkedin Profile', 'Xem hồ sơ thông tin trên linkedin'),
(134, 'update_informations', 'Update Information', 'Cập nhật thông tin'),
(135, 'edit_staff', 'Edit Staff', 'Hoàn tất chỉnh sửa'),
(136, 'manage_account_role', 'Manage Account Role', 'Quản lý tài khoản'),
(137, 'add_new_account_role', 'Add New Account Role', 'Tạo mới chức vụ/ vị trí'),
(138, 'permissions', 'Permissions', 'Quyền hạn'),
(139, 'number_of_staff', 'Number Of Staff', 'Số lượng nhân viên'),
(140, 'account_role_creation_form', 'Account Role Creation Form', 'Biểu mẫu tạo một vai trò'),
(141, 'role_name', 'Role Name', 'Tên'),
(142, 'add_account_role', 'Add Account Role', 'Tạo'),
(143, 'edit_account_role', 'Edit Account Role', 'Chỉnh sửa vị trí công việc'),
(144, 'manage_project', 'Manage Project', 'Quản lý dự án'),
(145, 'running', 'Running', 'Đang thực hiện'),
(146, 'archived', 'Archived', 'Đã lưu trữ'),
(147, 'progress', 'Progress', 'Tiến độ'),
(148, 'project_room', 'Project Room', 'Phòng dự án'),
(149, 'delete_project', 'Delete Project', 'Xoá dự án'),
(150, 'mark_as_archive', 'Mark As Archive', 'Đánh dấu lưu trữ'),
(151, 'overview', 'Overview', 'Tổng quan'),
(152, 'wall', 'Wall', 'Tường'),
(153, 'files', 'Files', 'Các tập tin'),
(154, 'tasks', 'Tasks', 'Công việc'),
(155, 'timesheet', 'Timesheet', 'Bảng chấm công'),
(156, 'payment', 'Payment', 'Thanh toán'),
(157, 'edit_this_project', 'Edit This Project', 'Sửa dự án này'),
(158, 'project_discussion', 'Project Discussion', 'Thảo luận về dự án'),
(159, 'post_message', 'Post Message', 'Đăng tin nhắn'),
(160, 'project_overview', 'Project Overview', 'Tổng quan về dự án'),
(161, 'upload_files', 'Upload Files', 'Tải lên các tập tin'),
(162, 'regular_upload', 'Regular Upload', 'Tải lên'),
(163, 'multiple_file_upload', 'Multiple File Upload', 'Tải lên nhiều tập tin'),
(164, 'dropbox_upload', 'Dropbox Upload', 'Tải lên dropbox'),
(165, 'select_file', 'Select File', 'Lựa chọn tập tin'),
(166, 'choose', 'Choose', 'Chọn'),
(167, 'change', 'Change', 'Thay đổi'),
(168, 'upload_file', 'Upload File', 'Tải lên tập tin'),
(169, 'file_chooser', 'File Chooser', 'Chọn file'),
(170, 'project_files', 'Project Files', 'Các tập tin của dự án'),
(171, 'download', 'Download', 'Tải về'),
(172, 'save_to_dropbox', 'Save To Dropbox', 'Lưu vào dropbox'),
(173, 'task_schedule', 'Task Schedule', 'Lịch trình công việc'),
(174, 'add_new_task', 'Add New Task', 'Thêm mới công việc'),
(175, 'mark_as_complete', 'Mark As Complete', 'Đánh dấu hoàn thành'),
(176, 'project_timer', 'Project Timer', 'Bộ đếm thời gian dự án'),
(177, 'hour', 'Hour', 'giờ'),
(178, 'minute', 'Minute', 'phút'),
(179, 'second', 'Second', 'giây'),
(180, 'start_timer', 'Start Timer', 'Bắt đầu bộ đếm thời gian'),
(181, 'timer_entries', 'Timer Entries', 'Tiến trình thời gian'),
(182, 'start', 'Start', 'Bắt đầu'),
(183, 'end', 'End', 'Kết thúc'),
(184, 'total_time', 'Total Time', 'Tổng thời gian'),
(185, 'option', 'Option', 'Lựa chọn'),
(186, 'total_time_completed', 'Total Time Completed', 'Tổng thời gian hoàn thành'),
(187, 'project_milestones', 'Project Milestones', 'Cột mốc dự án'),
(188, 'add_new_milestone', 'Add New Milestone', 'Thêm thanh toán'),
(189, 'payment_milestones', 'Payment Milestones', 'Thời gian thanh toán'),
(190, 'paid', 'Paid', 'Đã thanh toán'),
(191, 'unpaid', 'Unpaid', 'Chưa thanh toán'),
(192, 'take_manual_payment', 'Take Manual Payment', 'Thanh toán thủ công'),
(193, 'total_amount', 'Total Amount', 'Tổng số tiền'),
(194, 'paid_amount', 'Paid Amount', 'Số tiền đã thanh toán'),
(195, 'due', 'Due', 'Quá hạn'),
(196, 'project_notes', 'Project Notes', 'Ghi chú dự án'),
(197, 'save_note', 'Save Note', 'Lưu ghi chú'),
(198, 'edit_project', 'Edit Project', 'Sửa dự án'),
(199, 'project_title', 'Project Title', 'Tên dự án'),
(200, 'description', 'Description', 'Mô tả'),
(201, 'status', 'Status', 'Trạng thái'),
(202, 'select_project_status', 'Select Project Status', 'Lựa chọn trạng thái dự án'),
(203, 'budget', 'Budget', 'Ngân sách'),
(204, 'start_time', 'Start Time', 'Thời gian bắt đầu'),
(205, 'ending_time', 'Ending Time', 'Thời hạn hoàn thành'),
(206, 'demo_url', 'Demo Url', 'Đường dẫn demo'),
(207, 'progress_status', 'Progress Status', 'Trạng thái tiến độ'),
(208, 'select_a_client', 'Select A Client', 'Chọn một khách hàng'),
(209, 'select_company', 'Select Company', 'Lựa chọn công ty'),
(210, 'assign_staff', 'Assign Staff', 'Chỉ định nhân viên'),
(211, 'update_project', 'Update Project', 'Cập nhật dự án'),
(212, 'create_new_project', 'Create New Project', 'Tạo mới dự án'),
(213, 'project_form', 'Project Form', 'Biểu mẫu dự án'),
(214, 'add_new_project', 'Add New Project', 'Thêm dự án'),
(215, 'manage_project_quote', 'Manage Project Quote', 'Quản lý bảng giá dự án'),
(216, 'quote_list', 'Quote List', 'Danh sách giá'),
(217, 'archive_list', 'Archive List', 'Danh sách lưu trữ'),
(218, 'title', 'Title', 'Tiêu đề'),
(219, 'date', 'Date', 'Ngày'),
(220, 'amount', 'Amount', 'Số tiền'),
(221, 'view_quote', 'View Quote', 'Xem bảng giá'),
(222, 'archive', 'Archive', 'Lưu trữ'),
(223, 'discard', 'Discard', 'Loại bỏ'),
(224, 'project_updated', 'Project Updated', 'Dự án đã cập nhật'),
(225, 'running_team_tasks', 'Running Team Tasks', 'Công việc đang thực hiện'),
(226, 'add_a_new_team_task', 'Add A New Team Task', 'Thêm công việc'),
(227, 'edit_task', 'Edit Task', 'Chính sửa công việc'),
(228, 'delete_this_task', 'Delete This Task', 'Xóa công việc này'),
(229, 'running_task', 'Running Task', 'Công việc đang thực hiện'),
(230, 'mark_as_archived', 'Mark As Archived', 'Đánh dấu đã lưu trữ'),
(231, 'date_created', 'Date Created', 'Ngày khởi tạo'),
(232, 'due_date', 'Due Date', 'Ngày hết hạn'),
(233, 'assigned_staff', 'Assigned Staff', 'Nhân viên được chỉ định'),
(234, 'assign_staffs', 'Assign Staffs', 'Chỉ định nhân viên'),
(235, 'add_new_team_task', 'Add New Team Task', 'Thêm công việc chung'),
(236, 'task_title', 'Task Title', 'Tên công việc'),
(237, 'creation_date', 'Creation Date', 'Ngày tạo'),
(238, 'update_task', 'Update Task', 'Cập nhật công việc'),
(239, 'archived_team_tasks', 'Archived Team Tasks', 'Các công việc chung đã lưu trữ'),
(240, 'archived_task', 'Archived Task', 'Các công việc đã lưu trữ'),
(241, 'remove_from_archive', 'Remove From Archive', 'Loại bỏ khỏi danh sách lưu trữ'),
(242, 'private_messaging', 'Private Messaging', 'Gởi tin nhắn cá nhân'),
(243, 'new_message', 'New Message', 'Tin nhắn mới'),
(244, 'messages', 'Messages', 'Tin nhắn'),
(245, 'add_event', 'Add Event', 'Thêm sự kiện'),
(246, 'start_date', 'Start Date', 'Ngày bắt đầu'),
(247, 'end_date', 'End Date', 'Ngày kết thúc'),
(248, 'label', 'Label', 'Nhãn'),
(249, 'select_colour', 'Select Colour', 'Chọn màu sắc'),
(250, 'red', 'Red', 'Đỏ'),
(251, 'amber', 'Amber', 'Hổ phách'),
(252, 'black', 'Black', 'Đen'),
(253, 'blue', 'Blue', 'Xanh da trời'),
(254, 'green', 'Green', 'Xanh lá'),
(255, 'edit_event', 'Edit Event', 'Sửa sự kiện'),
(256, 'delete_event', 'Delete Event', 'Xoá sự kiện'),
(257, 'undo', 'Undo', 'Trở về'),
(258, 'reply_message', 'Reply Message', 'Trả lời tin nhắn'),
(259, 'send', 'Send', 'Gủi'),
(260, 'write_new_message', 'Write New Message', 'Viết tin nhắn mới'),
(261, 'recipient', 'Recipient', 'Người nhận'),
(262, 'select_a_user', 'Select A User', 'Chọn người dùng'),
(263, 'write_your_message', 'Write Your Message', 'Viết tin nhắn'),
(264, 'message_sent!', 'Message Sent!', 'Tin nhắn đã được gởi!'),
(265, 'notes', 'Notes', 'Ghi chú'),
(266, 'create_note', 'Create Note', 'Tạo ghi chú'),
(267, 'untitled', 'Untitled', 'Không có tiêu đề'),
(268, 'delete_note', 'Delete Note', 'Xoá ghi chú'),
(269, 'client_payments', 'Client Payments', 'Khách hàng thanh toán'),
(270, 'invoice', 'Invoice', 'Hóa đơn'),
(271, 'code', 'Code', 'Mã số'),
(272, 'payment_to', 'Payment To', 'Bên nhận thanh toán'),
(273, 'bill_to', 'Bill To', 'Bên nhận hóa đơn'),
(274, 'project_name', 'Project Name', 'Tên dự án'),
(275, 'milestone', 'Milestone', 'Cột mốc'),
(276, 'grand_total', 'Grand Total', 'Tổng'),
(277, 'manage_expenses', 'Manage Expenses', 'Quản lý chi phí'),
(278, 'add_expense', 'Add Expense', 'Thêm khoản phí'),
(279, 'category', 'Category', 'Danh mục'),
(280, 'select_expense_category', 'Select Expense Category', 'Chọn danh mục'),
(281, 'add_expense_category', 'Add Expense Category', 'Thêm danh mục chi phí'),
(282, 'project_income_report', 'Project Income Report', 'Báo cáo doanh thu'),
(283, 'search', 'Search', 'Tìm kiếm'),
(284, 'summary_report', 'Summary Report', 'Báo cáo tóm tắt'),
(285, 'payment_method', 'Payment Method', 'Phương thức thanh toán'),
(286, 'total_income', 'Total Income', 'Tổng doanh thu'),
(287, 'project_income_bar', 'Project Income Bar', 'Biểu đồ doanh thu (dạng thanh)'),
(288, 'project_income_percentage', 'Project Income Percentage', 'Biểu đồ doanh thu (tỉ lệ %)'),
(289, 'client_payment_report', 'Client Payment Report', 'Báo cáo về thanh toán của khách hàng'),
(290, 'total_client_payment', 'Total Client Payment', 'Tổng thanh toán của khách hàng'),
(291, 'client_payment_bar', 'Client Payment Bar', 'Biểu đồ thanh toán (dạng thanh)'),
(292, 'client_payment_percentage', 'Client Payment Percentage', 'Biểu đồ thanh toán (tỉ lệ %)'),
(293, 'total_expense', 'Total Expense', 'Tổng chi phí'),
(294, 'expense_bar', 'Expense Bar', 'Biểu đồ chi phí (dạng thanh)'),
(295, 'expense_percentage', 'Expense Percentage', 'Biểu đồ chi phí (tỉ lệ %)'),
(296, 'income_expense_comparison_report', 'Income Expense Comparison Report', 'Báo cáo so sánh doanh thu - chi phí'),
(297, 'transaction_source', 'Transaction Source', 'Nguồn giao dịch'),
(298, 'income_expense_percentage', 'Income Expense Percentage', 'Tỉ lệ % doanh thu - chi phí'),
(299, 'support_ticket', 'Support Ticket', 'Thẻ hỗ trợ'),
(300, 'opened', 'Opened', 'Mở'),
(301, 'closed', 'Closed', 'Đóng'),
(302, 'ticket_code', 'Ticket Code', 'Mã thẻ yêu cầu'),
(303, 'priority', 'Priority', 'Độ ưu tiên'),
(304, 'view_ticket', 'View Ticket', 'Xem thẻ yêu cầu'),
(305, 'reply_ticket', 'Reply Ticket', 'Trả lời thẻ yêu cầu'),
(306, 'post_reply', 'Post Reply', 'Đăng phản hồi'),
(307, 'ticket_summary', 'Ticket Summary', 'Tóm tắt thẻ yêu cầu'),
(308, 'ticket_status', 'Ticket Status', 'Tình trạng thẻ yêu cầu'),
(309, 'ticket_priority', 'Ticket Priority', 'Mức ưu tiên của yêu cầu'),
(310, 'update_ticket_status', 'Update Ticket Status', 'Cập nhật trạng thái thẻ yêu cầu'),
(311, 'create_new_ticket', 'Create New Ticket', 'Tạo thẻ yêu cầu mới'),
(312, 'ticket_form', 'Ticket Form', 'Biểu mẫu thẻ yêu cầu'),
(313, 'ticket_title', 'Ticket Title', 'Tiêu đề thẻ yêu cầu'),
(314, 'select_a_project', 'Select A Project', 'Lựa chọn dự án'),
(315, 'low', 'Low', 'Thấp'),
(316, 'medium', 'Medium', 'Trung bình'),
(317, 'high', 'High', 'Cao'),
(318, 'submit_support_ticket', 'Submit Support Ticket', 'Submit thẻ'),
(319, 'system_name', 'System Name', 'Tên hệ thống'),
(320, 'system_title', 'System Title', 'Tiêu đề hệ thống'),
(321, 'system_email', 'System Email', 'Email hệ thống'),
(322, 'language', 'Language', 'Ngôn ngữ'),
(323, 'text_align', 'Text Align', 'Căn chỉnh văn bản'),
(324, 'theme', 'Theme', 'Giao diện'),
(325, 'save', 'Save', 'Lưu'),
(326, 'upload_logo', 'Upload Logo', 'Tải lên logo'),
(327, 'upload', 'Upload', 'Tải lên'),
(328, 'email_template_settings', 'Email Template Settings', 'Thiết lập mẫu email'),
(329, 'new_project_opening', 'New Project Opening', 'Mở dự án mới'),
(330, 'new_client_account_opening', 'New Client Account Opening', 'Mở tài khoản khách hàng mới'),
(331, 'new_staff_account_opening', 'New Staff Account Opening', 'Mở tài khoản nhân viên mới'),
(332, 'payment_completion_notification', 'Payment Completion Notification', 'Thông báo hoàn tất thanh toán'),
(333, 'new_support_ticket_notify_admin', 'New Support Ticket Notify Admin', 'Thông báo thẻ yêu cầu mới tới admin'),
(334, 'support_ticket_assign_staff', 'Support Ticket Assign Staff', 'Chỉ định nhân viên xử lý thẻ yêu cầu'),
(335, 'new_message_notification', 'New Message Notification', 'Thông báo tin nhắn mới'),
(336, 'password_reset_confirmation', 'Password Reset Confirmation', 'Xác nhận thiết lập lại mật khẩu'),
(337, 'client_account_confirmation', 'Client Account Confirmation', 'Xác nhận tài khoản khách hàng'),
(338, 'email_subject', 'Email Subject', 'Chủ đề Email'),
(339, 'email_body', 'Email Body', 'Nội dung email'),
(340, 'instruction', 'Instruction', 'Hướng dẫn'),
(341, 'save_template', 'Save Template', 'Lưu bản mẫu'),
(342, 'email_template_updated', 'Email Template Updated', 'Đã cập nhật mẫu email'),
(343, 'settings_updated', 'Settings Updated', 'Đã cập nhật cài đặt'),
(344, 'system_currency', 'System Currency', 'Loại tiền tệ'),
(345, 'paypal_email', 'Paypal Email', ''),
(346, 'stripe_secret_key', 'Stripe Secret Key', 'Khóa Stripe mật'),
(347, 'stripe_publishable_key', 'Stripe Publishable Key', 'Khóa Stripe được công bố'),
(348, 'payment_settings_updated', 'Payment Settings Updated', 'Đã cập nhật cài đặt thanh toán'),
(349, 'manage_language', 'Manage Language', 'Quản lý ngôn ngữ'),
(350, 'language_list', 'Language List', 'Danh sách ngôn ngữ'),
(351, 'add_phrase', 'Add Phrase', 'Thêm cụm từ'),
(352, 'add_language', 'Add Language', 'Thêm ngôn ngữ'),
(353, 'edit_phrase', 'Edit Phrase', 'Sửa cụm từ'),
(354, 'delete_language', 'Delete Language', 'Xoá ngôn ngữ'),
(355, 'phrase', 'Phrase', 'Cụm từ'),
(356, 'update_phrase', 'Update Phrase', 'Cập nhật cụm từ'),
(357, 'search_result', 'Search Result', 'Kết quả tìm kiếm'),
(358, 'type_something_to_search', 'Type Something To Search', 'Gõ bất kỳ thông tin để tìm kiếm'),
(359, 'view_all_staff', 'View All Staff', 'Xem tất cả nhân viên'),
(360, 'no_results_found', 'No Results Found', 'Không tìm thấy kết quả'),
(361, 'view_all_client', 'View All Client', 'Xem tất cả khách hàng'),
(362, 'client_projects', 'Client Projects', 'Dự án'),
(363, 'team_tasks', 'Team Tasks', 'Công việc'),
(364, 'view_running_tasks', 'View Running Tasks', 'Xem các công việc đang thực hiện'),
(365, 'support_tickets', 'Support Tickets', 'Thẻ hỗ trợ'),
(366, 'view_all_tickets', 'View All Tickets', 'Xem tất cả thẻ'),
(367, 'manage_profile', 'Manage Profile', 'Quản lý hồ sơ thông tin'),
(368, 'image', 'Image', 'Hình ảnh'),
(369, 'update_profile', 'Update Profile', 'Cập nhật thông tin'),
(370, 'current_password', 'Current Password', 'Mật khẩu hiện tại'),
(371, 'new_password', 'New Password', 'Mật khẩu mới'),
(372, 'confirm_new_password', 'Confirm New Password', 'Xác nhận mật khẩu mới'),
(373, 'update_password', 'Update Password', 'Cập nhật mật khẩu'),
(374, 'account_updated', 'Account Updated', 'Đã cập nhật tài khoản'),
(375, 'stop_timer', 'Stop Timer', 'Dừng bộ đếm thời gian'),
(376, 'running_timers', 'Running Timers', 'Bộ đếm thời gian đang chạy'),
(377, 'timers_switched_on', 'Timers Switched On', 'Bật bộ đếm thời gian'),
(378, 'client_dashboard', 'Client Dashboard', 'Quản lý khách hàng'),
(379, 'payment_history', 'Payment History', 'Lịch sử thanh toán'),
(380, 'support', 'Support', 'Hỗ trợ'),
(381, 'submit_project_quote', 'Submit Project Quote', 'Submit bảng giá'),
(382, 'staff_dashboard', 'Staff Dashboard', 'Quản lý nhân viên'),
(383, 'assigned_client_projects', 'Assigned Client Projects', 'Dự án đã được phân công'),
(384, 'all_client_projects', 'All Client Projects', 'Tất cả dự án'),
(385, 'assigned_support_tickets', 'Assigned Support Tickets', 'Thẻ hỗ trợ đã được phân công'),
(386, 'all_support_tickets', 'All Support Tickets', 'Tất cả thẻ hỗ trợ'),
(387, 'assigned_projects', 'Assigned Projects', 'Dự án đã được phân công'),
(388, 'manage_projects', 'Manage Projects', 'Quản lý dự án'),
(389, 'manage_staffs', 'Manage Staffs', 'Quản lý nhân viên'),
(390, 'make_payment', 'Make Payment', 'Thanh toán'),
(391, 'view_invoice', 'View Invoice', 'Xem hóa đơn'),
(392, 'pay_with', 'Pay With', ''),
(393, 'stripe_payment', 'Stripe Payment', 'Thanh toán qua Stripe'),
(394, 'stripe_payment_form', 'Stripe Payment Form', 'Bảng thanh toán Stripe'),
(395, 'card_number', 'Card Number', 'Mã số thẻ'),
(396, 'expiration_date', 'Expiration Date', 'Ngày hết hiệu lực'),
(397, 'submit_payment', 'Submit Payment', 'Submit thanh toán'),
(398, 'phrase_list', 'Phrase List', 'Danh sách cum từ'),
(399, 'Assigned_staff', '', 'Nhân viên được chỉ định'),
(400, 'uploaded by', '', 'Được tải lên bởi'),
(401, 'Add Project Task', '', 'Thêm công việc'),
(402, 'Add_new_bug', '', 'Tạo báo  lỗi mới'),
(403, 'Edit_profile', '', 'Sửa thông tin'),
(404, 'Change_password', '', 'Thay mật khẩu'),
(405, 'Logout', '', 'Đăng xuất'),
(406, 'Report Task', '', 'Báo cáo tiến độ'),
(407, 'posted_by', '', 'Người đăng'),
(408, 'date_posted', '', 'Ngày đăng'),
(409, 'actions', '', 'Hành động'),
(410, 'bugs/Issues', '', 'Lỗi/vấn đề'),
(411, 'view', '', 'Xem'),
(412, 'Assigned_Staff', '', 'Nhân viên làm việc'),
(413, 'project staff progress', '', 'Tiến độ công việc'),
(414, 'category_manager', '', 'Quản lý gói dự ấn'),
(415, 'category add form', '', 'Thêm gói dự án mới'),
(416, 'add_category', '', 'Thêm gói sản phẩm'),
(417, 'cancle', '', 'Hủy'),
(418, 'new_project', '', 'Dự án mới'),
(419, 'cancled_project', '', 'Dự án bị hủy'),
(420, 'nofify update progress', '', 'cập nhật dự án'),
(421, 'notify edit project', '', '1 dự án vừa được cập nhật'),
(422, 'notify create project', '', 'Bạn nhận được dự án mới'),
(423, 'data_approved_successfuly', '', 'Thành công'),
(424, 'discount', '', 'Chiết khấu'),
(425, 'add_new_expense', '', 'Thêm chi phí');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `message_thread_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sender` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 unread 1 read'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `message_thread_code`, `message`, `sender`, `timestamp`, `read_status`) VALUES
(1, '141d296d3ea81b3', 'E hoàn thành công việc, tăng tiến độ cho anh nhé', 'admin-7', '1484704409', 1),
(2, '141d296d3ea81b3', 'Ok anh', 'staff-8', '1484704546', 1),
(3, '1e9b0ce4783087a', 'Banj  nhan duoc 1 thongo bao moi', 'admin-7', '1488870241', 1),
(4, '1e9b0ce4783087a', 'Test nhan thong bao', 'admin-7', '1489726780', 1),
(5, '1e9b0ce4783087a', '', 'admin-7', '1491636459', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_thread`
--

CREATE TABLE `message_thread` (
  `message_thread_id` int(11) NOT NULL,
  `message_thread_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender` longtext COLLATE utf8_unicode_ci NOT NULL,
  `reciever` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_message_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `message_thread`
--

INSERT INTO `message_thread` (`message_thread_id`, `message_thread_code`, `sender`, `reciever`, `last_message_timestamp`) VALUES
(1, '141d296d3ea81b3', 'admin-7', 'staff-8', ''),
(2, '1e9b0ce4783087a', 'admin-7', 'staff-7', '');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `note_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp_create` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp_last_update` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`note_id`, `title`, `note`, `user_type`, `user_id`, `timestamp_create`, `timestamp_last_update`) VALUES
(2, '', '', 'admin', 1, '1460339540', ''),
(3, '', '', 'admin', 1, '1467962425', ''),
(4, '', '', 'admin', 1, '1467962427', '1467962436'),
(5, '', '', 'admin', 1, '1467971145', ''),
(6, '', '', 'admin', 1, '1467971147', ''),
(7, '', '', 'admin', 1, '1467971154', ''),
(8, 'ghi chú 1', 'ví dự ghi chú 1', 'admin', 8, '1484711437', '1484711448'),
(13, '', '', 'admin', 7, '1490079609', ''),
(11, '', '', 'staff', 7, '1490070180', '');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notify_id` int(11) NOT NULL,
  `notify_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `notify_content` text COLLATE utf8_unicode_ci NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `receiver_level` varchar(50) CHARACTER SET latin1 NOT NULL,
  `notify_time` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `read_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notify_id`, `notify_title`, `notify_content`, `receiver_id`, `receiver_level`, `notify_time`, `read_status`) VALUES
(112, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viêndesignercập nhật dự án', 1, 'admin', '04:33:04am 03-21-2017', 0),
(114, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viêndesignercập nhật dự án', 8, 'admin', '04:33:04am 03-21-2017', 0),
(121, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viêndesigner vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/8f7756157e" >Dự án 2015</a>', 1, 'admin', '04:45:58am 03-21-2017', 0),
(123, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viêndesigner vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/8f7756157e" >Dự án 2015</a>', 8, 'admin', '04:45:58am 03-21-2017', 0),
(128, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/de6df61ac3" >Dự án test 1</a>', 1, 'admin', '05:18:22am 03-21-2017', 0),
(130, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/de6df61ac3" >Dự án test 1</a>', 8, 'admin', '05:18:22am 03-21-2017', 0),
(134, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/7775f12be2" >Dự án test 3</a> vừa được sửa thông tin.', 9, 'staff', '07:55:33am 03-21-2017', 0),
(139, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/8f7756157e" >Dự án 2015</a>', 1, 'admin', '01:02:37pm 04-04-2017', 0),
(141, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/8f7756157e" >Dự án 2015</a>', 8, 'admin', '01:02:37pm 04-04-2017', 0),
(144, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 1, 'admin', '09:05:09am 04-07-2017', 0),
(146, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 8, 'admin', '09:05:09am 04-07-2017', 0),
(149, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 1, 'admin', '09:16:36am 04-07-2017', 0),
(151, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 8, 'admin', '09:16:36am 04-07-2017', 0),
(153, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/35f4f3f594" >Dự án test 1023</a> vừa được sửa thông tin.', 10, 'staff', '11:53:55am 04-08-2017', 0),
(158, '<span class="text-danger"> Nhân viên: developer cập nhật dự án</span>', 'Nhân viên developer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 1, 'admin', '11:56:09am 04-08-2017', 0),
(160, '<span class="text-danger"> Nhân viên: developer cập nhật dự án</span>', 'Nhân viên developer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 8, 'admin', '11:56:09am 04-08-2017', 0),
(165, '<span class="text-danger"> Nhân viên: developer cập nhật dự án</span>', 'Nhân viên developer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 1, 'admin', '12:05:41pm 04-08-2017', 0),
(167, '<span class="text-danger"> Nhân viên: developer cập nhật dự án</span>', 'Nhân viên developer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 8, 'admin', '12:05:42pm 04-08-2017', 0),
(170, '<span class="text-danger"> Nhân viên: developer cập nhật dự án</span>', 'Nhân viên developer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 1, 'admin', '12:15:57pm 04-08-2017', 0),
(172, '<span class="text-danger"> Nhân viên: developer cập nhật dự án</span>', 'Nhân viên developer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 8, 'admin', '12:15:57pm 04-08-2017', 0),
(175, '<span class="text-danger"> Nhân viên: developer cập nhật dự án</span>', 'Nhân viên developer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 1, 'admin', '12:16:05pm 04-08-2017', 0),
(177, '<span class="text-danger"> Nhân viên: developer cập nhật dự án</span>', 'Nhân viên developer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/35f4f3f594" >Dự án test 1023</a>', 8, 'admin', '12:16:05pm 04-08-2017', 0),
(178, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/7775f12be2" >Dự án test 3</a> vừa được sửa thông tin.', 8, 'staff', '06:16:20am 04-10-2017', 0),
(179, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/7775f12be2" >Dự án test 3</a> vừa được sửa thông tin.', 9, 'staff', '06:16:20am 04-10-2017', 0),
(181, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/35f4f3f594" >Dự án test 1023</a> vừa được sửa thông tin.', 8, 'staff', '07:01:57am 04-10-2017', 0),
(183, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/35f4f3f594" >Dự án test 1023</a> vừa được sửa thông tin.', 8, 'staff', '08:35:31am 04-11-2017', 0),
(184, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/bcefa9a029" >Test modal client va company</a> vừa được sửa thông tin.', 8, 'staff', '08:35:56am 04-11-2017', 0),
(185, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/bcefa9a029" >Test modal client va company</a> vừa được sửa thông tin.', 9, 'staff', '08:35:56am 04-11-2017', 0),
(186, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/bcefa9a029" >Test modal client va company</a> vừa được sửa thông tin.', 8, 'staff', '08:36:30am 04-11-2017', 0),
(187, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/bcefa9a029" >Test modal client va company</a> vừa được sửa thông tin.', 9, 'staff', '08:36:30am 04-11-2017', 0),
(188, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/bcefa9a029" >Test modal client va company</a> vừa được sửa thông tin.', 8, 'staff', '09:20:15am 04-11-2017', 0),
(189, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/bcefa9a029" >Test modal client va company</a> vừa được sửa thông tin.', 9, 'staff', '09:20:15am 04-11-2017', 0),
(191, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/8f7756157e" >Dự án 2015</a> vừa được sửa thông tin.', 8, 'staff', '09:21:05am 04-11-2017', 0),
(193, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/8f7756157e" >Dự án 2015</a>', 8, 'staff', '09:22:01am 04-11-2017', 0),
(194, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/8f7756157e" >Dự án 2015</a>', 1, 'admin', '09:22:01am 04-11-2017', 0),
(196, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/8f7756157e" >Dự án 2015</a>', 8, 'admin', '09:22:02am 04-11-2017', 0),
(198, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/bcefa9a029" >Test modal client va company</a>', 8, 'staff', '09:22:56am 04-11-2017', 0),
(199, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/bcefa9a029" >Test modal client va company</a>', 9, 'staff', '09:22:56am 04-11-2017', 0),
(200, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/bcefa9a029" >Test modal client va company</a>', 1, 'admin', '09:22:56am 04-11-2017', 0),
(202, '<span class="text-danger"> Nhân viên: designer cập nhật dự án</span>', 'Nhân viên designer vừa cập nhật tiến độ dự án <a href="http://localhost/project_manager/index.php?admin/projectroom/overview/bcefa9a029" >Test modal client va company</a>', 8, 'admin', '09:22:56am 04-11-2017', 0),
(203, '<span class="text-success">Bạn nhận được dự án mới</span> ', 'Bạn vừa nhận được dự án <a class="text-danger" href="http://localhost/project_manager/index.php?staff/projectroom/overview/225d89b5bc" >Dự án test discount</a>', 7, 'staff', '12:36:24pm 04-11-2017', 0),
(204, '<span class="text-success">Bạn nhận được dự án mới</span> ', 'Bạn vừa nhận được dự án <a class="text-danger" href="http://localhost/project_manager/index.php?staff/projectroom/overview/225d89b5bc" >Dự án test discount</a>', 8, 'staff', '12:36:24pm 04-11-2017', 0),
(205, '<span class="text-success">Bạn nhận được dự án mới</span> ', 'Bạn vừa nhận được dự án <a class="text-danger" href="http://localhost/project_manager/index.php?staff/projectroom/overview/7c76dc9d3a" >Dự án test 0001</a>', 2, 'staff', '12:41:44pm 04-11-2017', 0),
(206, '<span class="text-success">Bạn nhận được dự án mới</span> ', 'Bạn vừa nhận được dự án <a class="text-danger" href="http://localhost/project_manager/index.php?staff/projectroom/overview/7c76dc9d3a" >Dự án test 0001</a>', 6, 'staff', '12:41:44pm 04-11-2017', 0),
(207, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/225d89b5bc" >Dự án test discount</a> vừa được sửa thông tin.', 7, 'staff', '12:51:52pm 04-11-2017', 0),
(208, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/225d89b5bc" >Dự án test discount</a> vừa được sửa thông tin.', 8, 'staff', '12:51:53pm 04-11-2017', 0),
(209, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/225d89b5bc" >Dự án test discount</a> vừa được sửa thông tin.', 7, 'staff', '12:52:15pm 04-11-2017', 0),
(210, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/225d89b5bc" >Dự án test discount</a> vừa được sửa thông tin.', 8, 'staff', '12:52:16pm 04-11-2017', 0),
(211, '<span class="text-success">Bạn nhận được dự án mới</span> ', 'Bạn vừa nhận được dự án <a class="text-danger" href="http://localhost/project_manager/index.php?staff/projectroom/overview/9f883bbb27" >Dự án test thêm discount</a>', 7, 'staff', '01:00:17pm 04-11-2017', 0),
(212, '<span class="text-success">Bạn nhận được dự án mới</span> ', 'Bạn vừa nhận được dự án <a class="text-danger" href="http://localhost/project_manager/index.php?staff/projectroom/overview/9f883bbb27" >Dự án test thêm discount</a>', 8, 'staff', '01:00:17pm 04-11-2017', 0),
(213, '<span class="text-success">Bạn nhận được dự án mới</span> ', 'Bạn vừa nhận được dự án <a class="text-danger" href="http://localhost/project_manager/index.php?staff/projectroom/overview/9f883bbb27" >Dự án test thêm discount</a>', 9, 'staff', '01:00:17pm 04-11-2017', 0),
(214, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/9f883bbb27" >Dự án test thêm discount</a> vừa được sửa thông tin.', 7, 'staff', '01:01:40pm 04-11-2017', 0),
(215, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/9f883bbb27" >Dự án test thêm discount</a> vừa được sửa thông tin.', 8, 'staff', '01:01:40pm 04-11-2017', 0),
(216, '<span class="text-warning">1 dự án vừa được cập nhật</span>', 'Dự án <a href="http://localhost/project_manager/index.php?staff/projectroom/overview/9f883bbb27" >Dự án test thêm discount</a> vừa được sửa thông tin.', 9, 'staff', '01:01:40pm 04-11-2017', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `project_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'income expense',
  `amount` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `milestone_id` int(11) NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `project_code`, `type`, `amount`, `title`, `description`, `payment_method`, `timestamp`, `milestone_id`, `expense_category_id`, `client_id`, `company_id`) VALUES
(1, '2204dbb5e0', 'expense', '5000000', 'Thanh toán đợt 1', '', '', '1467724560', 0, 0, 0, 0),
(2, '', 'expense', '10000', 'Tiền điện', '', '', '1467910800', 0, 3, 0, 0),
(3, '', 'expense', '5000', 'Tiền nước', '', '', '0', 0, 3, 0, 0),
(4, 'cc826aadc1', 'expense', '1000000', 'Thêm phí chính sửa', '', '', '1477487760', 0, 0, 0, 0),
(5, 'cc826aadc1', 'expense', '3500000', 'Đặt cọc lần 2', '', '', '1484594220', 0, 0, 0, 0),
(8, 'db7d7b245b', 'income', '6000000', 'Đặt cọc trước', 'thanh toán trực tiếp tại cong ty', 'Thanh toán trực tiếp', '1484674433', 3, 0, 2, 1),
(9, '940fce8fbe', 'income', '5000000', 'Đặt cọc trước', 'Thanh toán tại công ty', 'Thanh toán trực tiếp', '1484704932', 4, 0, 4, 0),
(10, '940fce8fbe', 'expense', '10000000', 'Thuê chuyên gia database', '', '', '1484767020', 0, 0, 0, 0),
(11, '940fce8fbe', 'expense', '250000', 'Mua tên miền', '', '', '1484767020', 0, 0, 0, 0),
(12, '851f853e00', 'income', '5000000', 'Đặt cọc trước', 'Thanh toán tại công ty, phòng kinh doanh', 'Thanh toán trực tiếp', '1485338004', 9, 0, 4, 2),
(13, 'f67cc40c9d', 'income', '2000000', 'Đặt cọc trước', 'Thanh toán tại cong ty', 'Thanh toán trực tiếp', '1489373529', 10, 0, 4, 11),
(14, 'ddd4e8cdbb', 'income', '11900000', 'Thanh toán toàn bộ', 'Thanh toán tại văn phòng công ty', 'Thanh toán trực tiếp', '1489456495', 12, 0, 1, 2),
(15, 'de6df61ac3', 'income', '3000000', 'Đặt cọc trước', 'Thanh toán tại văn phòng công ty', 'Thanh toán trực tiếp', '1490069982', 6, 0, 5, 2),
(16, '35f4f3f594', 'expense', '780000', 'Mua tên miền', '', '', '1491589020', 0, 0, 0, 0),
(17, '35f4f3f594', 'expense', '1000000', 'Thuê hosting', '', '', '1491589020', 0, 0, 0, 0),
(18, '35f4f3f594', 'income', '1.500.000₫', 'Đặt cọc dự án', 'Thanh toán tại văn phòng công ty MyPage', 'Thanh toán thủ công', '1491554312', 13, 0, 19, 16);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `demo_url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `project_category_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `staffs` longtext COLLATE utf8_unicode_ci NOT NULL,
  `budget` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timer_status` int(11) NOT NULL DEFAULT '0' COMMENT '1 running 0stopped',
  `timer_starting_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `total_time_spent` int(11) NOT NULL DEFAULT '0' COMMENT 'second',
  `progress_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp_start` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp_end` longtext COLLATE utf8_unicode_ci NOT NULL,
  `project_status` int(11) NOT NULL DEFAULT '1' COMMENT '1 for running, 0 for archived',
  `project_note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `discount` longtext COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_code`, `title`, `description`, `demo_url`, `project_category_id`, `client_id`, `company_id`, `staffs`, `budget`, `timer_status`, `timer_starting_timestamp`, `total_time_spent`, `progress_status`, `timestamp_start`, `timestamp_end`, `project_status`, `project_note`, `discount`) VALUES
(19, 'de6df61ac3', 'Dự án test 1', 'Dự án test 1<br>- test nhân viên cập nhật tiến độ dự án<br>- Test khởi tạo tiến độ của nhân viên trong admin<br>- Test kéo thanh cập nhật dự án trong staff', 'qhxh.info', 0, 5, 2, '7,8,', '20000000', 0, '', 0, '42', '01/26/2017', '02/04/2017', 4, '', '25'),
(22, '7775f12be2', 'Dự án test 3', 'Test dự án 3<br>- hoàn thanh thêm <b>discount</b> vào dự án', 'no demo', 0, 4, 2, '8,9,', '30000000', 0, '', 0, '33.333333333333', '01/25/2017', '02/04/2017', 3, '', '10'),
(28, 'c802f726d3', 'Dự án test 8', 'dự án test 8 test discount', 'qhxh.com', 3, 6, 2, '7,9,', '7900000', 0, '', 0, '49.5', '27/02/17', '24/04/17', 4, '', '20'),
(62, '35f4f3f594', 'Dự án test 1023', 'Test cập nhật nhân viên<br>', 'duan2016.com', 3, 0, 14, '7,8,', '7900000', 0, '', 0, '95', '03/04/2017', '05/12/2017', 0, '', '0'),
(63, 'bcefa9a029', 'Test modal client va company', 'test modal client', 'no demo', 2, 29, 17, '7,8,9,', '4900000', 0, '', 0, '28', '08/04/17', '18/05/17', 1, 'Dự án lớn', '0'),
(56, 'acc6296c5a', 'Dự an 2010', 'Test taoj thong báo khi create, edit, update progress', '', 2, 3, 11, '7,8,9,', '4900000', 0, '', 0, '33.666666666667', '20/03/2017', '26/04/2017', 3, '', '0'),
(61, '8f7756157e', 'Dự án 2015', 'Hoàn thành thông báo nhan vien, admin<br>Tạo dự án<br>Sửa dự án<br>update dự án', '', 2, 3, 23, '7,8,', '4900000', 0, '', 0, '41.5', '21/03/2017', '27/04/17', 2, '', '0'),
(64, '225d89b5bc', 'Dự án test discount', 'Test discount dự án<img alt="" src="http://">', 'no demo', 2, 29, 23, '7,8,', '4900000', 0, '', 0, '0', '11/04/17', '18/05/2017', 1, '', '30'),
(65, '7c76dc9d3a', 'Dự án test 0001', 'Test add discount', '0001.edu.vn', 4, 1, 24, '2,6,', '11900000', 0, '', 0, '0', '11/04/17', '19/06/2017', 3, '', NULL),
(70, '9f883bbb27', 'Dự án test thêm discount', 'Test them discount', 'no demo', 3, 29, 2, '7,8,9,', '7900000', 0, '', 0, '0', '11/04/17', '06/06/2017', 1, '', '1300000');

-- --------------------------------------------------------

--
-- Table structure for table `project_bug`
--

CREATE TABLE `project_bug` (
  `project_bug_id` int(11) NOT NULL,
  `project_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `file` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 for pending, 1 for solved',
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_bug`
--

INSERT INTO `project_bug` (`project_bug_id`, `project_code`, `title`, `description`, `user_type`, `user_id`, `file`, `status`, `timestamp`) VALUES
(1, 'db7d7b245b', 'Slide lỗi trên trang chủ', 'trang chủ không hiển thị slide.', 'staff', 8, '', 0, '1484680620'),
(2, '940fce8fbe', 'Websie không hoạt động đúng trên safari', 'trên safari. website không đáp ứng responsive', 'client', 4, '', 0, '1484767020');

-- --------------------------------------------------------

--
-- Table structure for table `project_category`
--

CREATE TABLE `project_category` (
  `project_category_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cat_ngansach` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cat_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_category`
--

INSERT INTO `project_category` (`project_category_id`, `name`, `description`, `cat_ngansach`, `cat_time`) VALUES
(1, 'BÁN CHUYÊN', 'Gói web bán chuyên với đầy đủ các tính năng danh cho doanh nghiệp', '3900000', 25),
(2, 'CHUYÊN NGHIỆP', 'Gói Chuyên nghiệp dành cho các doanh nghiệp quy mo', '4900000', 32),
(3, 'NÂNG CAO', 'Thiết kế theo  giao diện yêu cầu\nTặng tên miền quốc tế .com, .net', '7900000', 49),
(4, 'CAO CẤP', 'Thiết kế độc quyền,theo yêu cầu', '11900000', 60);

-- --------------------------------------------------------

--
-- Table structure for table `project_file`
--

CREATE TABLE `project_file` (
  `project_file_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `visibility_client` int(11) NOT NULL DEFAULT '1' COMMENT '1visible 0hidden',
  `visibility_staff` int(11) NOT NULL DEFAULT '1' COMMENT '1visible 0hidden',
  `size` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `uploader_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `timestamp_upload` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_file`
--

INSERT INTO `project_file` (`project_file_id`, `project_id`, `description`, `name`, `visibility_client`, `visibility_staff`, `size`, `file_type`, `uploader_type`, `uploader_id`, `timestamp_upload`) VALUES
(1, 3, '', 'shopdatabase.ods', 1, 1, '', 'ods', 'admin', 7, '1484680620'),
(2, 4, 'requipment', 'De_thi_PTCSDL_12CK.docx', 1, 1, '', 'docx', 'admin', 7, '1484767020'),
(3, 62, 'Giao diện admin', 'admin_theme.odt', 1, 1, '', 'odt', 'admin', 7, '1491675420');

-- --------------------------------------------------------

--
-- Table structure for table `project_message`
--

CREATE TABLE `project_message` (
  `project_message_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_file_name` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_message`
--

INSERT INTO `project_message` (`project_message_id`, `message`, `project_id`, `date`, `user_type`, `user_id`, `message_file_name`) VALUES
(1, 'Khách hàng đang hối', 3, '17 Jan 2017', 'staff', 8, ''),
(2, 'Ok, designer tăng tiến độ làm việc cho anh', 3, '17 Jan 2017', 'admin', 7, ''),
(3, 'Dự án đang triển khai tốt. Đã check bugs.', 4, '18 Jan 2017', 'client', 4, ''),
(4, '', 4, '19 Jan 2017', 'admin', 7, 'halleluja'),
(5, 'Thảo luận dự án', 4, '19 Jan 2017', 'staff', 8, ''),
(6, 'hoạt động tốt', 20, '25 Jan 2017', 'staff', 7, ''),
(7, 'Tiến độ hoàn thành dự án hơi chậm\r\nHi vộng sẽ kịp thời gian', 22, '25 Jan 2017', 'client', 4, ''),
(8, 'Chúng tôi đang cố gắng hoàn thành dự án đứng tiến độ', 22, '25 Jan 2017', 'staff', 7, ''),
(9, '', 28, '28 Feb 2017', 'admin', 7, ''),
(10, '', 28, '28 Feb 2017', 'admin', 7, ''),
(11, 'Bắt đầu thực hiện dự án', 39, '20 Mar 2017', 'staff', 8, ''),
(12, '', 63, '11 Apr 2017', 'admin', 7, ''),
(13, '', 63, '11 Apr 2017', 'admin', 7, '');

-- --------------------------------------------------------

--
-- Table structure for table `project_milestone`
--

CREATE TABLE `project_milestone` (
  `project_milestone_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `project_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `amount` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `currency_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 for unpaid, 1 for paid',
  `note` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_milestone`
--

INSERT INTO `project_milestone` (`project_milestone_id`, `title`, `project_code`, `client_id`, `company_id`, `amount`, `timestamp`, `currency_id`, `status`, `note`) VALUES
(1, 'Thanh toán đợt 1', '2204dbb5e0', 1, 1, '5000000', '1467738000', 0, 0, ''),
(2, 'Thanh toán đợt 2', '2204dbb5e0', 1, 1, '1000', '1468515600', 0, 0, ''),
(3, 'Đặt cọc trước', 'db7d7b245b', 2, 1, '6000000', '1485298800', 0, 1, ''),
(4, 'Đặt cọc trước', '940fce8fbe', 4, 0, '5000000', '1484780400', 0, 1, 'Đặt cọc chi phí phát triển'),
(5, 'Thanh toán lần 2', '940fce8fbe', 4, 0, '10000000', '1486508400', 0, 0, 'Thanh toán lần 2 project'),
(6, 'Đặt cọc trước', 'de6df61ac3', 5, 2, '3000000', '1485903600', 0, 1, 'Đặt cọc dự án'),
(7, 'Đặt cọc trước', '7775f12be2', 6, 2, '2000000', '1485385200', 0, 0, 'Đặt cọc thanh toán cho dự án'),
(8, 'Thanh toan dự án', 'de6df61ac3', 5, 2, '30000000', '1488841200', 0, 0, 'Thanh toán toàn bộ dự án'),
(9, 'Đặt cọc trước', '851f853e00', 4, 2, '5000000', '1486162800', 0, 1, 'Đặt cọc dự ấn'),
(10, 'Đặt cọc trước', 'f67cc40c9d', 4, 11, '2000000', '1489705200', 0, 1, 'Thanh toán trực tiếp'),
(11, 'Thanh toán hết', 'f67cc40c9d', 4, 11, '2900000', '1490565600', 0, 0, ''),
(12, 'Thanh toán toàn bộ', 'ddd4e8cdbb', 1, 2, '11900000', '1491602400', 0, 1, 'Thánh toán chi phí toàn bộ dự án'),
(13, 'Đặt cọc dự án', '35f4f3f594', 19, 16, '1500000', '1492812000', 0, 1, 'Đặt cọc cho dự án'),
(14, 'Đặt cọc trước cho dự án', 'bcefa9a029', 29, 17, '2000000', '0', 0, 0, 'Số tiện đặt cọc trước để làm dự án');

-- --------------------------------------------------------

--
-- Table structure for table `project_progress`
--

CREATE TABLE `project_progress` (
  `project_code` longtext NOT NULL,
  `staff_id` int(11) NOT NULL,
  `progress_percent` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_progress`
--

INSERT INTO `project_progress` (`project_code`, `staff_id`, `progress_percent`) VALUES
('c802f726d3', 7, 99),
('c802f726d3', 9, 0),
('de6df61ac3', 7, 84),
('de6df61ac3', 8, 0),
('acc6296c5a', 7, 47),
('acc6296c5a', 8, 54),
('acc6296c5a', 9, 0),
('8f7756157e', 7, 83),
('8f7756157e', 8, 0),
('7775f12be2', 8, 0),
('7775f12be2', 9, 0),
('35f4f3f594', 7, 0),
('35f4f3f594', 8, 93),
('bcefa9a029', 7, 84),
('bcefa9a029', 8, 0),
('bcefa9a029', 9, 0),
('225d89b5bc', 7, 0),
('225d89b5bc', 8, 0),
('7c76dc9d3a', 2, 0),
('7c76dc9d3a', 6, 0),
('9f883bbb27', 7, 0),
('9f883bbb27', 8, 0),
('9f883bbb27', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_task`
--

CREATE TABLE `project_task` (
  `project_task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `staff_id` int(11) NOT NULL,
  `complete_status` int(11) NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp_start` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp_end` longtext COLLATE utf8_unicode_ci NOT NULL,
  `task_color` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_task`
--

INSERT INTO `project_task` (`project_task_id`, `project_id`, `title`, `description`, `staff_id`, `complete_status`, `status`, `timestamp_start`, `timestamp_end`, `task_color`) VALUES
(1, 3, 'Thiết kế Giao diện', 'Thiết kế giao diện theo yêu cầu', 7, 0, '', '1484694000', '1485212400', '#E93339'),
(2, 3, 'test cong việc', 'test công việc', 7, 1, '', '1484780400', '1489014000', '#FDA330'),
(3, 61, 'Thiết kế database ', 'Thiết kế dattabase cho website', 7, 0, '', '1490050800', '1491516000', '#E93339'),
(4, 61, 'Designer thêm cong việc', 'Thêm cong viêc do designer', 8, 1, '', '1490050800', '1491602400', '#279ACB'),
(6, 62, 'Thiết kê giao diện cho website', 'Thiết kế và viết tài liệu cho coder', 8, 0, '', '1493244000', '1493589600', '#E93339'),
(10, 61, 'Design trang chủ', 'Design trang chủ cho dự án', 7, 0, '', '1491861600', '1493416800', '#E93339'),
(9, 62, 'Nhập liệu trang web', 'Nhập liệu cho các trang ', 7, 0, '', '1491602400', '1493330400', '#FDA330');

-- --------------------------------------------------------

--
-- Table structure for table `project_timesheet`
--

CREATE TABLE `project_timesheet` (
  `project_timesheet_id` int(11) NOT NULL,
  `start_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `end_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_timesheet`
--

INSERT INTO `project_timesheet` (`project_timesheet_id`, `start_timestamp`, `end_timestamp`, `project_id`) VALUES
(1, '1216201030', '1216201033', 1),
(2, '1792143816', '1074328493', 2),
(3, '1074328494', '1453047654', 2);

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

CREATE TABLE `quote` (
  `quote_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` longtext COLLATE utf8_unicode_ci NOT NULL,
  `files` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote_message`
--

CREATE TABLE `quote_message` (
  `quote_message_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `user_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'Quản lý dự án Mypage'),
(2, 'system_title', 'Quản lý dự án Mypage'),
(3, 'address', '12 Lê Thánh Tôn, Phường Bến Nghé, Quận 1, Hồ Chí Mình'),
(4, 'phone', '0933365989'),
(5, 'paypal_email', 'payment@creativeitem.com'),
(6, 'currency', 'usd'),
(7, 'system_email', 'support@mypage.vn'),
(8, 'buyer', '[ your-codecanyon-username-here ]'),
(9, 'purchase_code', '[ your-purchase-code-here ]'),
(10, 'language', 'Vietnamese'),
(11, 'text_align', 'left-to-right'),
(12, 'system_currency_id', '18'),
(13, 'skin_colour', 'default'),
(14, 'stripe_publishable_key', 'pk_test_c6VvBEbwHFdulFZ62q1IQrar'),
(15, 'stripe_api_key', 'sk_test_9IMkiM6Ykxr1LCe2dJ3PgaxS'),
(16, 'dropbox_data_app_key', '');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `account_role_id` int(11) NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `skype_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `facebook_profile_link` longtext COLLATE utf8_unicode_ci NOT NULL,
  `twitter_profile_link` longtext COLLATE utf8_unicode_ci NOT NULL,
  `linkedin_profile_link` longtext COLLATE utf8_unicode_ci NOT NULL,
  `chat_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'offline'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `email`, `password`, `account_role_id`, `phone`, `skype_id`, `facebook_profile_link`, `twitter_profile_link`, `linkedin_profile_link`, `chat_status`) VALUES
(1, 'Vũ Minh Vương', 'vuongvu@mypage.com.vn', '7c4a8d09ca3762af61e59520943dc26494f8941b', 12, '', '', '', '', '', 'offline'),
(2, 'Trần Quốc Huy', 'huytran@mypage.com.vn', '2ea6201a068c5fa0eea5d81a3863321a87f8d533', 12, '8629602551', '', '', '', '', 'offline'),
(3, 'Lê Thanh Liêm', 'liemle@mypage.vn', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', 10, '9333659892', '', '', '', '', 'offline'),
(4, 'Nguyễn Anh Tuấn', 'tuannguyen@mypage.vn', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', 10, '9333659891', '', '', '', '', 'offline'),
(5, 'Phạm Hữu Phước', 'phuocpham@mypage.vn', '2ea6201a068c5fa0eea5d81a3863321a87f8d533', 11, '', '', '', '', '', 'offline'),
(6, 'Hoàng Tuyết My', 'myhoang@mypage.com.vn', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 11, '', '', '', '', '', 'offline'),
(7, 'designer', 'designer@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', 10, '0128875412', 'designerSkype', 'https://facebook.com/desingerpro', 'n/a', 'n/a', 'offline'),
(8, 'developer', 'developer@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', 11, '', '', '', '', '', 'offline'),
(9, 'manager1', 'manager1@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', 14, '012284512145', 'mnager', '', '', '', 'offline'),
(10, 'Dinh Huong', 'doivodoi.n2@gmail.com', 'ccad756e906ec243f4a98e235fcc48bc22b7e942', 11, '0654212545', 'huongshype', '', '', '', 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `team_subtask`
--

CREATE TABLE `team_subtask` (
  `team_subtask_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `team_task_id` int(11) NOT NULL,
  `subtask_status` int(11) NOT NULL DEFAULT '1' COMMENT '1 for incomplete , 0 for complete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_task`
--

CREATE TABLE `team_task` (
  `team_task_id` int(11) NOT NULL,
  `task_title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `task_note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `assigned_staff_ids` longtext COLLATE utf8_unicode_ci NOT NULL,
  `creation_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `due_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `task_status` int(11) NOT NULL DEFAULT '1' COMMENT '0 for archived, 1 for running'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `team_task`
--

INSERT INTO `team_task` (`team_task_id`, `task_title`, `task_note`, `assigned_staff_ids`, `creation_timestamp`, `due_timestamp`, `task_status`) VALUES
(1, 'Thiết kế logo Microsite', 'Thiết kế logo sang trọng, ấn tượng', '6,7,', '1465250400', '1473199200', 1),
(2, 'Thiết kế Brochure', '', '6,', '1467824400', '1467910800', 1),
(3, 'Thiết kế Trang chủ', 'Thiet ke trang chu + trang con', '7,8,', '1484607600', '1485817200', 0),
(4, 'nhập liệu trang ', '', '7,', '1485903600', '1486076400', 1),
(5, 'Thiết kế giao diện website', '', '7,', '1490050800', '1491602400', 1);

-- --------------------------------------------------------

--
-- Table structure for table `team_task_file`
--

CREATE TABLE `team_task_file` (
  `team_task_file_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `team_task_id` int(11) NOT NULL,
  `upload_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ticket_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'opened closed',
  `priority` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'high medium low',
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `assigned_staff_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `title`, `ticket_code`, `status`, `priority`, `description`, `client_id`, `assigned_staff_id`, `project_id`, `timestamp`) VALUES
(1, 'Test 01', 'bab20de47bacde7', 'closed', 'low', '', 0, 0, 0, '08 Jul,2016'),
(2, 'Test 01', 'eb5c7096f6fb53b', 'opened', 'low', '', 0, 0, 0, '08 Jul,2016'),
(3, 'Test 01', '2e30243d335f2fd', 'opened', 'low', '', 0, 5, 0, '08 Jul,2016'),
(4, 'hỗ trợ post bài', '3ff394a7baeb63d', 'closed', 'medium', '', 4, 7, 22, '07 Apr,2017');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_message`
--

CREATE TABLE `ticket_message` (
  `ticket_message_id` int(11) NOT NULL,
  `ticket_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender_id` int(11) NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ticket_message`
--

INSERT INTO `ticket_message` (`ticket_message_id`, `ticket_code`, `message`, `file`, `sender_type`, `sender_id`, `timestamp`) VALUES
(1, 'bab20de47bacde7', '', '', 'admin', 1, '08 Jul,2016'),
(2, 'eb5c7096f6fb53b', '', '', 'admin', 1, '08 Jul,2016'),
(3, '2e30243d335f2fd', '', '', 'admin', 1, '08 Jul,2016'),
(4, '3ff394a7baeb63d', 'Hỗ trợ post bài cho trang web hàng tuần', '04.jpg', 'client', 4, '07 Apr,2017'),
(5, '3ff394a7baeb63d', 'Chúng tôi đang xem xet hệ thống để được hỗ trợ sớm nhất', '', 'admin', 7, '07 Apr,2017');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `todo_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`todo_id`, `title`, `user`, `status`, `order`) VALUES
(1, 'Test 01', 'admin-1', 0, 1),
(2, 'Thiết kế logo abc.com', 'admin-7', 1, 2),
(3, 'Thiết kế Banner abc.com', 'admin-7', 0, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_permission`
--
ALTER TABLE `account_permission`
  ADD PRIMARY KEY (`account_permission_id`);

--
-- Indexes for table `account_role`
--
ALTER TABLE `account_role`
  ADD PRIMARY KEY (`account_role_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`bookmark_id`);

--
-- Indexes for table `calendar_event`
--
ALTER TABLE `calendar_event`
  ADD PRIMARY KEY (`calendar_event_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_pending`
--
ALTER TABLE `client_pending`
  ADD PRIMARY KEY (`client_pending_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`email_template_id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`expense_category_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`phrase_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `message_thread`
--
ALTER TABLE `message_thread`
  ADD PRIMARY KEY (`message_thread_id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notify_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `project_bug`
--
ALTER TABLE `project_bug`
  ADD PRIMARY KEY (`project_bug_id`);

--
-- Indexes for table `project_category`
--
ALTER TABLE `project_category`
  ADD PRIMARY KEY (`project_category_id`);

--
-- Indexes for table `project_file`
--
ALTER TABLE `project_file`
  ADD PRIMARY KEY (`project_file_id`);

--
-- Indexes for table `project_message`
--
ALTER TABLE `project_message`
  ADD PRIMARY KEY (`project_message_id`);

--
-- Indexes for table `project_milestone`
--
ALTER TABLE `project_milestone`
  ADD PRIMARY KEY (`project_milestone_id`);

--
-- Indexes for table `project_task`
--
ALTER TABLE `project_task`
  ADD PRIMARY KEY (`project_task_id`);

--
-- Indexes for table `project_timesheet`
--
ALTER TABLE `project_timesheet`
  ADD PRIMARY KEY (`project_timesheet_id`);

--
-- Indexes for table `quote`
--
ALTER TABLE `quote`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `quote_message`
--
ALTER TABLE `quote_message`
  ADD PRIMARY KEY (`quote_message_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `team_subtask`
--
ALTER TABLE `team_subtask`
  ADD PRIMARY KEY (`team_subtask_id`);

--
-- Indexes for table `team_task`
--
ALTER TABLE `team_task`
  ADD PRIMARY KEY (`team_task_id`);

--
-- Indexes for table `team_task_file`
--
ALTER TABLE `team_task_file`
  ADD PRIMARY KEY (`team_task_file_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ticket_message`
--
ALTER TABLE `ticket_message`
  ADD PRIMARY KEY (`ticket_message_id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`todo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_permission`
--
ALTER TABLE `account_permission`
  MODIFY `account_permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `account_role`
--
ALTER TABLE `account_role`
  MODIFY `account_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `bookmark_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `calendar_event`
--
ALTER TABLE `calendar_event`
  MODIFY `calendar_event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `client_pending`
--
ALTER TABLE `client_pending`
  MODIFY `client_pending_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `email_template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `expense_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `phrase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `message_thread`
--
ALTER TABLE `message_thread`
  MODIFY `message_thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `project_bug`
--
ALTER TABLE `project_bug`
  MODIFY `project_bug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `project_category`
--
ALTER TABLE `project_category`
  MODIFY `project_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `project_file`
--
ALTER TABLE `project_file`
  MODIFY `project_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `project_message`
--
ALTER TABLE `project_message`
  MODIFY `project_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `project_milestone`
--
ALTER TABLE `project_milestone`
  MODIFY `project_milestone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `project_task`
--
ALTER TABLE `project_task`
  MODIFY `project_task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `project_timesheet`
--
ALTER TABLE `project_timesheet`
  MODIFY `project_timesheet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `quote`
--
ALTER TABLE `quote`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quote_message`
--
ALTER TABLE `quote_message`
  MODIFY `quote_message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `team_subtask`
--
ALTER TABLE `team_subtask`
  MODIFY `team_subtask_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `team_task`
--
ALTER TABLE `team_task`
  MODIFY `team_task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `team_task_file`
--
ALTER TABLE `team_task_file`
  MODIFY `team_task_file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ticket_message`
--
ALTER TABLE `ticket_message`
  MODIFY `ticket_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
