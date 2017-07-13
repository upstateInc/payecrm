-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2017 at 11:10 PM
-- Server version: 5.5.54-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payecrm_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_action`
--

CREATE TABLE `t_action` (
  `id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_action`
--

INSERT INTO `t_action` (`id`, `action`, `status`) VALUES
(1, 'List', 'Y'),
(2, 'Add', 'Y'),
(3, 'Edit', 'Y'),
(4, 'Delete', 'Y'),
(5, 'View', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE `t_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `rec_crt_date` datetime NOT NULL,
  `rec_up_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_admin`
--

INSERT INTO `t_admin` (`id`, `email`, `password`, `phone`, `fname`, `lname`, `alias`, `address`, `city`, `state`, `country`, `zip`, `image`, `status`, `rec_crt_date`, `rec_up_date`) VALUES
(1, 'admin@payecrm.com', 'e10adc3949ba59abbe56e057f20f883e', '', 'Admin', 'Admin', 'Admin', '', '', '', '', '', '1_38655058_admin.png', 'Y', '2017-05-11 00:00:00', '2017-05-11 00:00:00'),
(2, 'dasgupta.rony@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456789', 'Rony', 'DG', 'Rony', 'dasdasda', 'dasdasd', 'dasd', 'dasdas', 'dasdas', '', 'Y', '2017-05-24 12:16:32', '2017-05-24 12:16:32'),
(3, 'dasgupta.rony1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '42342342342', 'Rony2', 'Dg', 'Rony2', '', '', '', '', '', '11_fire_flame_png_image.png', 'Y', '2017-05-24 12:29:35', '2017-05-24 12:29:35');

-- --------------------------------------------------------

--
-- Table structure for table `t_adminAdminLevel`
--

CREATE TABLE `t_adminAdminLevel` (
  `id` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `adminLevelId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_adminAdminLevel`
--

INSERT INTO `t_adminAdminLevel` (`id`, `adminId`, `adminLevelId`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_adminAdminType`
--

CREATE TABLE `t_adminAdminType` (
  `id` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `adminTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_adminAdminType`
--

INSERT INTO `t_adminAdminType` (`id`, `adminId`, `adminTypeId`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `t_adminCompany`
--

CREATE TABLE `t_adminCompany` (
  `id` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `merchantId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_adminGroup`
--

CREATE TABLE `t_adminGroup` (
  `id` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_adminLevel`
--

CREATE TABLE `t_adminLevel` (
  `id` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_adminLevel`
--

INSERT INTO `t_adminLevel` (`id`, `level`, `status`) VALUES
(1, 'System', 'Y'),
(2, 'Company', 'Y'),
(3, 'Group', 'N'),
(4, 'Nominee', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `t_adminModuleAction`
--

CREATE TABLE `t_adminModuleAction` (
  `id` int(11) NOT NULL,
  `adminTypeId` int(11) NOT NULL,
  `adminLevelId` int(11) NOT NULL,
  `moduleActionId` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_adminModuleAction`
--

INSERT INTO `t_adminModuleAction` (`id`, `adminTypeId`, `adminLevelId`, `moduleActionId`, `status`) VALUES
(1, 1, 1, 1, 'Y'),
(2, 2, 1, 1, 'Y'),
(3, 3, 1, 1, 'Y'),
(4, 4, 1, 1, 'Y'),
(5, 1, 1, 2, 'Y'),
(6, 1, 1, 3, 'Y'),
(7, 1, 1, 4, 'Y'),
(8, 1, 1, 5, 'Y'),
(9, 1, 1, 6, 'Y'),
(51, 1, 1, 25, 'Y'),
(52, 2, 1, 25, 'Y'),
(53, 1, 2, 25, 'Y'),
(54, 2, 2, 25, 'Y'),
(55, 1, 1, 26, 'Y'),
(56, 2, 1, 26, 'Y'),
(57, 1, 2, 26, 'Y'),
(58, 2, 2, 26, 'Y'),
(59, 1, 1, 27, 'Y'),
(60, 2, 1, 27, 'Y'),
(61, 1, 2, 27, 'Y'),
(62, 2, 2, 27, 'Y'),
(63, 1, 1, 28, 'Y'),
(64, 1, 2, 28, 'Y'),
(65, 1, 1, 29, 'Y'),
(66, 2, 1, 29, 'Y'),
(67, 1, 2, 29, 'Y'),
(68, 2, 2, 29, 'Y'),
(69, 1, 1, 30, 'Y'),
(70, 1, 1, 31, 'Y'),
(71, 1, 1, 32, 'Y'),
(72, 1, 1, 33, 'Y'),
(73, 1, 1, 34, 'Y'),
(74, 1, 1, 35, 'Y'),
(75, 2, 1, 35, 'Y'),
(76, 1, 1, 36, 'Y'),
(77, 2, 1, 36, 'Y'),
(78, 1, 1, 37, 'Y'),
(79, 2, 1, 37, 'Y'),
(80, 1, 1, 38, 'Y'),
(81, 2, 1, 38, 'Y'),
(82, 1, 1, 39, 'Y'),
(83, 2, 1, 39, 'Y'),
(84, 1, 1, 40, 'Y'),
(85, 2, 1, 40, 'Y'),
(86, 1, 2, 40, 'Y'),
(87, 2, 2, 40, 'Y'),
(88, 1, 1, 41, 'Y'),
(89, 2, 1, 41, 'Y'),
(90, 1, 2, 41, 'Y'),
(91, 2, 2, 41, 'Y'),
(92, 1, 1, 42, 'Y'),
(93, 2, 1, 42, 'Y'),
(94, 1, 2, 42, 'Y'),
(95, 2, 2, 42, 'Y'),
(96, 1, 1, 43, 'Y'),
(97, 2, 1, 43, 'Y'),
(98, 1, 2, 43, 'Y'),
(99, 2, 2, 43, 'Y'),
(100, 1, 1, 44, 'Y'),
(101, 2, 1, 44, 'Y'),
(102, 1, 2, 44, 'Y'),
(103, 2, 2, 44, 'Y'),
(104, 1, 1, 45, 'Y'),
(105, 2, 1, 45, 'Y'),
(106, 1, 2, 45, 'Y'),
(107, 2, 2, 45, 'Y'),
(108, 1, 1, 46, 'Y'),
(109, 2, 1, 46, 'Y'),
(110, 1, 1, 47, 'Y'),
(111, 2, 1, 47, 'Y'),
(112, 1, 1, 48, 'Y'),
(113, 2, 1, 48, 'Y'),
(114, 1, 1, 49, 'Y'),
(115, 2, 1, 49, 'Y'),
(116, 1, 2, 49, 'Y'),
(117, 2, 2, 49, 'Y'),
(118, 1, 1, 50, 'Y'),
(119, 2, 1, 50, 'Y'),
(120, 1, 1, 51, 'Y'),
(121, 2, 1, 51, 'Y'),
(122, 1, 1, 52, 'Y'),
(123, 2, 1, 52, 'Y'),
(124, 1, 1, 53, 'Y'),
(125, 2, 1, 53, 'Y'),
(126, 1, 1, 54, 'Y'),
(127, 2, 1, 54, 'Y'),
(128, 1, 1, 55, 'Y'),
(129, 2, 1, 55, 'Y'),
(130, 1, 1, 56, 'Y'),
(131, 2, 1, 56, 'Y'),
(132, 1, 1, 57, 'Y'),
(133, 2, 1, 57, 'Y'),
(134, 1, 2, 57, 'Y'),
(135, 2, 2, 57, 'Y'),
(136, 1, 1, 58, 'Y'),
(137, 2, 1, 58, 'Y'),
(138, 1, 2, 58, 'Y'),
(139, 2, 2, 58, 'Y'),
(140, 1, 1, 59, 'Y'),
(141, 2, 1, 59, 'Y'),
(142, 1, 2, 59, 'Y'),
(143, 2, 2, 59, 'Y'),
(144, 1, 1, 60, 'Y'),
(145, 2, 1, 60, 'Y'),
(146, 1, 2, 60, 'Y'),
(147, 2, 2, 60, 'Y'),
(148, 1, 1, 61, 'Y'),
(149, 2, 1, 61, 'Y'),
(150, 1, 1, 62, 'Y'),
(151, 2, 1, 62, 'Y'),
(152, 1, 1, 63, 'Y'),
(153, 2, 1, 63, 'Y'),
(154, 1, 1, 64, 'Y'),
(155, 2, 1, 64, 'Y'),
(156, 1, 1, 65, 'Y'),
(157, 2, 1, 65, 'Y'),
(158, 1, 1, 66, 'Y'),
(159, 2, 1, 66, 'Y'),
(160, 1, 1, 67, 'Y'),
(161, 2, 1, 67, 'Y'),
(162, 1, 1, 68, 'Y'),
(163, 2, 1, 68, 'Y'),
(164, 1, 1, 69, 'Y'),
(165, 2, 1, 69, 'Y'),
(166, 1, 2, 69, 'Y'),
(167, 2, 2, 69, 'Y'),
(168, 1, 1, 70, 'Y'),
(169, 2, 1, 70, 'Y'),
(170, 1, 1, 71, 'Y'),
(171, 2, 1, 71, 'Y'),
(172, 1, 1, 72, 'Y'),
(173, 2, 1, 72, 'Y'),
(174, 1, 1, 73, 'Y'),
(175, 2, 1, 73, 'Y'),
(176, 1, 1, 74, 'Y'),
(177, 2, 1, 74, 'Y'),
(186, 1, 1, 76, 'Y'),
(187, 2, 1, 76, 'Y'),
(188, 3, 1, 76, 'Y'),
(189, 4, 1, 76, 'Y'),
(190, 1, 2, 76, 'Y'),
(191, 2, 2, 76, 'Y'),
(192, 3, 2, 76, 'Y'),
(193, 4, 2, 76, 'Y'),
(194, 1, 1, 77, 'Y'),
(195, 2, 1, 77, 'Y'),
(196, 1, 2, 77, 'Y'),
(197, 2, 2, 77, 'Y'),
(198, 1, 1, 78, 'Y'),
(199, 2, 1, 78, 'Y'),
(200, 1, 1, 79, 'Y'),
(201, 2, 1, 79, 'Y'),
(202, 1, 1, 80, 'Y'),
(203, 2, 1, 80, 'Y'),
(204, 1, 1, 81, 'Y'),
(205, 2, 1, 81, 'Y'),
(206, 1, 1, 82, 'Y'),
(207, 2, 1, 82, 'Y'),
(208, 1, 1, 83, 'Y'),
(209, 2, 1, 83, 'Y'),
(210, 1, 1, 84, 'Y'),
(211, 2, 1, 84, 'Y'),
(212, 1, 1, 85, 'Y'),
(213, 2, 1, 85, 'Y'),
(214, 1, 1, 86, 'Y'),
(215, 2, 1, 86, 'Y'),
(216, 1, 1, 87, 'Y'),
(217, 2, 1, 87, 'Y'),
(218, 1, 1, 88, 'Y'),
(219, 2, 1, 88, 'Y'),
(220, 1, 1, 89, 'Y'),
(221, 2, 1, 89, 'Y'),
(222, 1, 1, 90, 'Y'),
(223, 2, 1, 90, 'Y'),
(224, 1, 1, 91, 'Y'),
(225, 2, 1, 91, 'Y'),
(226, 1, 1, 92, 'Y'),
(227, 2, 1, 92, 'Y'),
(228, 1, 1, 93, 'Y'),
(229, 2, 1, 93, 'Y'),
(230, 1, 1, 94, 'Y'),
(231, 2, 1, 94, 'Y'),
(232, 1, 1, 95, 'Y'),
(233, 2, 1, 95, 'Y'),
(234, 1, 1, 96, 'Y'),
(235, 2, 1, 96, 'Y'),
(236, 1, 1, 97, 'Y'),
(237, 2, 1, 97, 'Y'),
(238, 1, 1, 98, 'Y'),
(239, 2, 1, 98, 'Y'),
(240, 1, 1, 99, 'Y'),
(241, 2, 1, 99, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_adminNominee`
--

CREATE TABLE `t_adminNominee` (
  `id` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `nomineeId` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_adminType`
--

CREATE TABLE `t_adminType` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_adminType`
--

INSERT INTO `t_adminType` (`id`, `type`, `status`) VALUES
(1, 'Super Admin', 'Y'),
(2, 'Team Lead', 'Y'),
(3, 'Tech Support', 'Y'),
(4, 'Sales Agent', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_batchDetails`
--

CREATE TABLE `t_batchDetails` (
  `id` int(11) NOT NULL,
  `gatewayTransactionId` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_city` varchar(255) NOT NULL,
  `customer_state` varchar(255) NOT NULL,
  `customer_country` varchar(11) NOT NULL,
  `customer_zip` varchar(50) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `cardNo` varchar(50) NOT NULL,
  `gatewayID` varchar(255) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `prefix` varchar(50) NOT NULL,
  `companyID` varchar(255) NOT NULL,
  `grossPrice` float NOT NULL,
  `action_type` varchar(255) NOT NULL,
  `response_text` varchar(255) NOT NULL,
  `response_code` varchar(50) NOT NULL,
  `batch_id` varchar(50) NOT NULL,
  `rec_crt_date` datetime NOT NULL,
  `rec_up_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_cart`
--

CREATE TABLE `t_cart` (
  `id` int(11) NOT NULL,
  `customer_ip` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_each` float NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `productName` varchar(100) NOT NULL,
  `ProductSupscriptionPeriod` int(11) NOT NULL,
  `no_of_support` int(11) NOT NULL,
  `productDescription` varchar(100) NOT NULL,
  `rec_crt_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_centerGroup`
--

CREATE TABLE `t_centerGroup` (
  `id` int(11) NOT NULL,
  `groupId` varchar(100) NOT NULL,
  `companyID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_center_fees`
--

CREATE TABLE `t_center_fees` (
  `id` int(11) NOT NULL,
  `companyID` varchar(255) NOT NULL,
  `fees_type` varchar(255) NOT NULL,
  `fee` float NOT NULL,
  `fee_type` enum('$','%') NOT NULL DEFAULT '$',
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_customer`
--

CREATE TABLE `t_customer` (
  `id` int(11) NOT NULL,
  `companyID` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_city` varchar(255) NOT NULL,
  `customer_state` varchar(255) NOT NULL,
  `customer_country` varchar(255) NOT NULL,
  `customer_zip` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `rec_crt_date` datetime NOT NULL,
  `rec_up_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_email_template`
--

CREATE TABLE `t_email_template` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_email_template`
--

INSERT INTO `t_email_template` (`id`, `name`, `description`, `directory`, `filename`, `status`) VALUES
(1, 'Welcome Email', '', '', '', 'Y'),
(2, 'Order Email', '', '', '', 'Y'),
(3, 'Feedback Email', '', '', '', 'Y'),
(4, 'New Phone Number Email', '', '', '', 'Y'),
(5, 'Refund Email', '', '', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_fees`
--

CREATE TABLE `t_fees` (
  `id` int(11) NOT NULL,
  `fees_type` varchar(255) NOT NULL,
  `fee` float NOT NULL,
  `fee_type` enum('$','%') NOT NULL DEFAULT '$',
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_fees`
--

INSERT INTO `t_fees` (`id`, `fees_type`, `fee`, `fee_type`, `status`) VALUES
(2, 'Refund', 30, '$', 'Y'),
(3, 'Chargeback', 50, '$', 'Y'),
(4, 'Wire', 50, '$', 'Y'),
(5, 'Processing', 27, '%', 'Y'),
(6, 'Reserve', 10, '%', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_group`
--

CREATE TABLE `t_group` (
  `id` int(11) NOT NULL,
  `groupName` varchar(255) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `rec_crt_date` datetime NOT NULL,
  `rec_up_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_groups`
--

CREATE TABLE `t_groups` (
  `id` int(11) NOT NULL,
  `groups` varchar(50) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_invoice`
--

CREATE TABLE `t_invoice` (
  `id` int(11) NOT NULL,
  `companyID` varchar(255) NOT NULL,
  `invoice_id` varchar(50) NOT NULL,
  `gatewayID` varchar(50) NOT NULL,
  `agentID` int(11) DEFAULT NULL,
  `agentName` varchar(100) NOT NULL,
  `customerId` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_city` varchar(255) NOT NULL,
  `customer_state` varchar(255) NOT NULL,
  `customer_country` varchar(255) NOT NULL,
  `customer_zip` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `grossPrice` float NOT NULL,
  `cardNo` varchar(50) NOT NULL,
  `cardType` varchar(50) NOT NULL,
  `gatewayTransactionId` varchar(255) DEFAULT NULL,
  `reason_code` varchar(255) DEFAULT NULL,
  `reason_descrption` varchar(500) DEFAULT NULL,
  `ip` varchar(50) NOT NULL,
  `validated` enum('Y','N') NOT NULL DEFAULT 'N',
  `rating` smallint(6) NOT NULL,
  `comment` text NOT NULL,
  `gateway_descriptor` varchar(255) NOT NULL,
  `RoutingNumber` varchar(50) NOT NULL,
  `AccountNumber` varchar(50) NOT NULL,
  `BankName` varchar(255) NOT NULL,
  `CheckDate` varchar(50) NOT NULL,
  `CheckNumber` varchar(50) NOT NULL,
  `CheckMemo` varchar(50) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `cvvresponse` varchar(255) DEFAULT NULL,
  `avsresponse` varchar(255) DEFAULT NULL,
  `originalGatewayTransactionId` varchar(50) NOT NULL,
  `locked` enum('Y','N') NOT NULL DEFAULT 'N',
  `sourceCode` varchar(255) NOT NULL,
  `batch_id` varchar(50) NOT NULL,
  `status` enum('Capture','Sale','Refund','Credit','Authorize','Void','Verify','Settlement','Return','Decrypt','Chargeback','Failed') NOT NULL DEFAULT 'Authorize',
  `captured_by` varchar(255) NOT NULL,
  `captured_date` datetime NOT NULL,
  `rec_crt_date` datetime NOT NULL,
  `rec_up_date` datetime NOT NULL,
  `qc_agentID` varchar(50) NOT NULL,
  `qc_Date` datetime NOT NULL,
  `chargeback_validation` enum('Y','N') NOT NULL DEFAULT 'N',
  `chargeback_validation_date` datetime NOT NULL,
  `chargeback_agentID` varchar(100) NOT NULL,
  `attention_required` varchar(10) NOT NULL,
  `expDate` varchar(10) NOT NULL,
  `cvv` varchar(10) NOT NULL,
  `securityProtection` int(11) NOT NULL,
  `totalDevices` int(11) NOT NULL,
  `frozen` enum('Y','N') NOT NULL DEFAULT 'N',
  `frozenDate` datetime NOT NULL,
  `releaseDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_invoiceDebitCredit`
--

CREATE TABLE `t_invoiceDebitCredit` (
  `id` int(11) NOT NULL,
  `tempInvoiceGenerationId` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price_each` decimal(6,2) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `total` decimal(6,2) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `credit` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_logindetails`
--

CREATE TABLE `t_logindetails` (
  `id` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `loginTime` datetime NOT NULL,
  `logoutTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_loginfo`
--

CREATE TABLE `t_loginfo` (
  `id` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `action_url` varchar(255) NOT NULL,
  `action_info` varchar(255) NOT NULL,
  `action_type` enum('0','1','2') NOT NULL DEFAULT '0',
  `action_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_merchant`
--

CREATE TABLE `t_merchant` (
  `id` int(11) NOT NULL,
  `companyID` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_feedback_email` varchar(255) NOT NULL,
  `company_invoice_email` varchar(255) NOT NULL,
  `company_invoice_prefix` varchar(255) NOT NULL,
  `Gorad_email` varchar(255) NOT NULL,
  `Gorad_Billing_Number` varchar(255) NOT NULL,
  `company_phonenumber` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_City` varchar(255) NOT NULL,
  `company_State` varchar(255) NOT NULL,
  `company_Zipcode` varchar(255) NOT NULL,
  `Company_PDF_Name` enum('yes','no') NOT NULL DEFAULT 'no',
  `send_feedback_form` varchar(10) NOT NULL DEFAULT 'Yes',
  `Additional_Group_email1` varchar(255) NOT NULL,
  `tranactionMode` enum('Sale','Auth') NOT NULL DEFAULT 'Auth',
  `transactionUpdate` enum('Y','N') NOT NULL DEFAULT 'N',
  `status` enum('P','Y','N') NOT NULL,
  `visibility` enum('Y','N') NOT NULL DEFAULT 'N',
  `duplicate` enum('Y','N') NOT NULL DEFAULT 'Y',
  `canCapture` enum('Y','N') NOT NULL DEFAULT 'Y',
  `canVoid` enum('Y','N') NOT NULL DEFAULT 'Y',
  `canRefund` enum('Y','N') NOT NULL DEFAULT 'Y',
  `canChargeback` enum('Y','N') NOT NULL DEFAULT 'N',
  `invoice_period` int(11) NOT NULL DEFAULT '7',
  `invoice_type` enum('Net','Gross') NOT NULL DEFAULT 'Net',
  `service_type` enum('None','Fee','Discount') NOT NULL DEFAULT 'None',
  `min_percentage` float NOT NULL,
  `max_percentage` float NOT NULL,
  `sendEmail` enum('Y','N') NOT NULL DEFAULT 'Y',
  `technicianIDRequired` enum('Y','N') NOT NULL DEFAULT 'Y',
  `productNameShow` enum('product','sku','skuNo') NOT NULL DEFAULT 'product',
  `failedAttempts` int(11) NOT NULL,
  `invoiceEmails` varchar(255) NOT NULL,
  `invoice_day` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '1',
  `Max_Sales_Amount_Allowed` float NOT NULL DEFAULT '399.99',
  `MidSelectionProcess` enum('Y','N') NOT NULL DEFAULT 'Y',
  `orderEmail` enum('Y','N') NOT NULL DEFAULT 'Y',
  `feedbackEmail` enum('Y','N') NOT NULL DEFAULT 'Y',
  `welcomeEmail` enum('Y','N') DEFAULT 'Y',
  `refundEmail` enum('Y','N') NOT NULL DEFAULT 'Y',
  `CreditCard_Hidden` enum('Y','N') NOT NULL DEFAULT 'N',
  `nbr_of_reserve_weeks` tinyint(4) NOT NULL DEFAULT '15',
  `rec_crt_date` datetime NOT NULL,
  `rec_update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_merchant`
--

INSERT INTO `t_merchant` (`id`, `companyID`, `company_name`, `company_email`, `company_feedback_email`, `company_invoice_email`, `company_invoice_prefix`, `Gorad_email`, `Gorad_Billing_Number`, `company_phonenumber`, `company_address`, `company_City`, `company_State`, `company_Zipcode`, `Company_PDF_Name`, `send_feedback_form`, `Additional_Group_email1`, `tranactionMode`, `transactionUpdate`, `status`, `visibility`, `duplicate`, `canCapture`, `canVoid`, `canRefund`, `canChargeback`, `invoice_period`, `invoice_type`, `service_type`, `min_percentage`, `max_percentage`, `sendEmail`, `technicianIDRequired`, `productNameShow`, `failedAttempts`, `invoiceEmails`, `invoice_day`, `Max_Sales_Amount_Allowed`, `MidSelectionProcess`, `orderEmail`, `feedbackEmail`, `welcomeEmail`, `refundEmail`, `CreditCard_Hidden`, `nbr_of_reserve_weeks`, `rec_crt_date`, `rec_update_date`) VALUES
(1, 'Template', 'Template', 'template@billingsupportusa.com', 'template@billingsupportusa.com', 'template@billingsupportusa.com', 'TMP', 'template@systemcare247.com', '1-860-200-4576', '1-888-255-8309', '', '', '', '', 'yes', 'No', '', 'Auth', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 7, 'Gross', 'None', 0, 0, 'N', 'N', 'product', 5, 'dasgupta.rony@gmail.com', '1', 2000, 'Y', 'Y', 'N', 'N', 'Y', 'N', 15, '2015-12-14 17:40:11', '2017-04-20 06:52:09'),
(7, '', 'ABC', 'abc@y.com', 'abc@y.com', 'abc@y.com', '', '', '', '(465)-465-4654', 'dasdasd', 'dasdasda', 'Alabama', '12205', 'no', 'Yes', '', 'Auth', 'N', 'P', 'N', 'Y', 'Y', 'Y', 'Y', 'N', 7, 'Net', 'None', 0, 0, 'Y', 'Y', 'product', 0, '', '1', 399.99, 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_midmaster`
--

CREATE TABLE `t_midmaster` (
  `id` int(11) NOT NULL,
  `gatewayID` varchar(100) NOT NULL,
  `gatewayType` varchar(50) NOT NULL,
  `programName` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mid_number` varchar(255) NOT NULL,
  `mid_key` varchar(50) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `descriptor` varchar(255) NOT NULL,
  `directory` varchar(255) NOT NULL,
  `monthly_volume` float NOT NULL DEFAULT '40000',
  `daily_volume` float NOT NULL DEFAULT '2000',
  `dailyHighTicketCapture` tinyint(4) NOT NULL DEFAULT '2',
  `MaxSalesAmount` float NOT NULL DEFAULT '400',
  `rec_crt_date` datetime NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `cron` enum('Y','N') NOT NULL DEFAULT 'Y',
  `link` varchar(255) NOT NULL,
  `visibility` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_module`
--

CREATE TABLE `t_module` (
  `id` int(11) NOT NULL,
  `module` varchar(50) NOT NULL,
  `parent` int(11) NOT NULL,
  `weightage` int(11) NOT NULL,
  `moduleLink` varchar(50) NOT NULL,
  `moduleDesc` varchar(255) NOT NULL,
  `imageClass` varchar(50) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_module`
--

INSERT INTO `t_module` (`id`, `module`, `parent`, `weightage`, `moduleLink`, `moduleDesc`, `imageClass`, `status`) VALUES
(1, 'Dashboard', 0, 1, 'dashboard', 'Dashboard of User', 'fa-home', 'Y'),
(2, 'Sub System - Master', 38, 20, 'modules', 'Admin User Listings', 'fa-tasks', 'Y'),
(3, 'Transaction', 0, 100, 'transactions', 'Transaction Details', 'fa-money', 'Y'),
(9, 'Admin', 0, 12, 'admin', 'Admin Records', 'fa-user', 'Y'),
(10, 'Merchant', 0, 700, 'merchant', 'Merchant Details ', 'fa-briefcase', 'Y'),
(11, 'Mid Master', 0, 700, 'mid-master', 'Mid Master', 'fa-check-square', 'Y'),
(12, 'Customer', 0, 20, 'customer', 'Customer Details', 'fa-user', 'Y'),
(13, 'Invoices', 0, 2000, '', 'Invoice Module', 'fa-book', 'Y'),
(14, 'List', 13, 2010, 'invoice', 'Invoices', 'fa-money', 'Y'),
(15, 'Generate', 13, 2020, 'generate-invoice', 'Invoice Generation', 'fa-users', 'Y'),
(16, 'Saved', 13, 2050, 'saved-invoice', 'Saved Invoices', 'fa-users', 'Y'),
(17, 'Report', 0, 3000, '', 'Report Module', 'fa-bar-chart', 'Y'),
(18, 'Center Report', 17, 3100, 'center-report', 'Center Report', 'fa-user', 'Y'),
(19, 'Center Percentage Report', 17, 3200, 'center_percentage_report', 'Center Percentage Report', 'fa-user', 'Y'),
(20, 'Failed Report', 17, 3300, 'failed-report', 'Failed Report', 'fa', 'Y'),
(21, 'Mid Report', 17, 3400, 'mid-report', 'Mid Report', 'fa', 'Y'),
(22, 'Mid Center Report', 17, 3500, 'mid-center-report', 'Mid Center Report', 'fa', 'Y'),
(23, 'Mid Percentage Report', 17, 3600, 'mid-percentage-report', 'Mid Percentage Report', 'fa', 'Y'),
(24, 'Mid Selection', 17, 3800, 'mid-selection', 'Mid Selection', 'fa', 'Y'),
(25, 'Transactions', 0, 4000, '', 'Transaction Module Heading', 'fa-credit-card', 'Y'),
(26, 'Batches', 25, 4100, 'batches', 'Batched Records', 'fa', 'Y'),
(27, 'Chargebacks', 25, 4200, 'chargebacks', 'Chargeback Records', 'fa', 'Y'),
(28, 'Reconciliation', 25, 4300, 'reconciliation', 'Reconciliation Records', 'fa', 'Y'),
(29, 'Pending Transactions', 25, 4400, 'pending-transactions', 'Pending Transaction Records', 'fa', 'Y'),
(30, 'Capturing Transaction', 25, 4500, 'capturing-transactions', 'Capturing Trasnaction', 'fa', 'Y'),
(32, 'My Sales', 25, 4800, 'my-sales', 'Individual Sales Record', 'fa', 'Y'),
(33, 'Transaction', 25, 4550, 'transaction', 'Transaction Record', 'fa', 'Y'),
(34, 'Transaction Update', 25, 4750, 'transaction-update', 'Transaction Update in Database', 'fa', 'Y'),
(35, 'Fees', 0, 5000, '', 'Fees Module Heading', 'fa-money', 'Y'),
(36, 'Center Fees', 35, 5100, 'center-fees', 'Center Fees', 'fa', 'Y'),
(37, 'Reserve Fees', 35, 5200, 'reserve-fees', 'Reserve Fees', 'fa', 'Y'),
(38, 'Utilities', 0, 6000, '', 'Utilities Module Heading', 'fa-wrench', 'Y'),
(39, 'Email', 38, 6100, 'emails', 'Email Sending Module', 'fa', 'Y'),
(40, 'Export', 38, 6200, 'export', 'Module to Export Records', 'fa', 'Y'),
(41, 'System Settings', 38, 6300, 'system-settings', 'System Settings', 'fa', 'Y'),
(42, 'System Events', 38, 6400, 'system-events', 'System Events', 'fa', 'Y'),
(43, 'Logs', 0, 10000, 'logs', 'Log Records', 'fa-pencil-square-o', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_moduleAction`
--

CREATE TABLE `t_moduleAction` (
  `id` int(11) NOT NULL,
  `moduleId` int(11) NOT NULL,
  `actionId` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_moduleAction`
--

INSERT INTO `t_moduleAction` (`id`, `moduleId`, `actionId`, `status`) VALUES
(1, 1, 1, 'Y'),
(2, 2, 1, 'Y'),
(3, 2, 2, 'Y'),
(4, 2, 3, 'Y'),
(5, 2, 4, 'Y'),
(6, 2, 5, 'Y'),
(7, 3, 1, 'Y'),
(8, 3, 2, 'Y'),
(9, 3, 3, 'Y'),
(10, 3, 4, 'Y'),
(11, 3, 5, 'Y'),
(25, 9, 1, 'Y'),
(26, 9, 2, 'Y'),
(27, 9, 3, 'Y'),
(28, 9, 4, 'Y'),
(29, 9, 5, 'Y'),
(30, 10, 1, 'Y'),
(31, 10, 2, 'Y'),
(32, 10, 3, 'Y'),
(33, 10, 4, 'Y'),
(34, 10, 5, 'Y'),
(35, 11, 1, 'Y'),
(36, 11, 2, 'Y'),
(37, 11, 3, 'Y'),
(38, 11, 4, 'Y'),
(39, 11, 5, 'Y'),
(40, 12, 1, 'Y'),
(41, 12, 2, 'Y'),
(42, 12, 3, 'Y'),
(43, 12, 4, 'Y'),
(44, 12, 5, 'Y'),
(45, 13, 1, 'Y'),
(46, 13, 2, 'Y'),
(47, 13, 3, 'Y'),
(48, 13, 4, 'Y'),
(49, 13, 5, 'Y'),
(50, 14, 1, 'Y'),
(51, 14, 2, 'Y'),
(52, 14, 3, 'Y'),
(53, 14, 4, 'Y'),
(54, 14, 5, 'Y'),
(55, 15, 1, 'Y'),
(56, 15, 2, 'Y'),
(57, 16, 1, 'Y'),
(58, 16, 3, 'Y'),
(59, 16, 4, 'Y'),
(60, 16, 5, 'Y'),
(61, 17, 1, 'Y'),
(62, 18, 1, 'Y'),
(63, 19, 1, 'Y'),
(64, 20, 1, 'Y'),
(65, 21, 1, 'Y'),
(66, 22, 1, 'Y'),
(67, 23, 1, 'Y'),
(68, 24, 1, 'Y'),
(69, 25, 1, 'Y'),
(70, 26, 1, 'Y'),
(71, 27, 1, 'Y'),
(72, 28, 1, 'Y'),
(73, 29, 1, 'Y'),
(74, 30, 1, 'Y'),
(76, 32, 1, 'Y'),
(77, 33, 1, 'Y'),
(78, 34, 1, 'Y'),
(79, 35, 1, 'Y'),
(80, 36, 1, 'Y'),
(81, 37, 1, 'Y'),
(82, 37, 2, 'Y'),
(83, 37, 3, 'Y'),
(84, 37, 4, 'Y'),
(85, 37, 5, 'Y'),
(86, 38, 1, 'Y'),
(87, 39, 1, 'Y'),
(88, 40, 1, 'Y'),
(89, 41, 1, 'Y'),
(90, 41, 2, 'Y'),
(91, 41, 3, 'Y'),
(92, 41, 4, 'Y'),
(93, 41, 5, 'Y'),
(94, 42, 1, 'Y'),
(95, 42, 2, 'Y'),
(96, 42, 3, 'Y'),
(97, 42, 4, 'Y'),
(98, 42, 5, 'Y'),
(99, 43, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_nominee`
--

CREATE TABLE `t_nominee` (
  `id` int(11) NOT NULL,
  `nominee` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_product`
--

CREATE TABLE `t_product` (
  `id` int(11) NOT NULL,
  `companyID` varchar(100) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` decimal(5,2) NOT NULL,
  `ProductSupscriptionPeriod` int(11) NOT NULL,
  `no_of_support` int(11) NOT NULL,
  `productDescription` varchar(255) NOT NULL,
  `discount` float NOT NULL,
  `sku_name` varchar(50) NOT NULL,
  `sku_number` varchar(50) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `rec_crt_date` datetime NOT NULL,
  `rec_up_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_qc_reasons`
--

CREATE TABLE `t_qc_reasons` (
  `id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_qc_reasons`
--

INSERT INTO `t_qc_reasons` (`id`, `reason`, `status`) VALUES
(2, 'Satisfied', 'Y'),
(3, 'Dis-satisfied', 'Y'),
(4, 'No Reply from the other end', 'Y'),
(5, 'Left Voice Message', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_reserve_fees_weekly`
--

CREATE TABLE `t_reserve_fees_weekly` (
  `id` int(11) NOT NULL,
  `companyID` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `release_date` date NOT NULL,
  `payment_date` date NOT NULL,
  `amount` float NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_savedInvoice`
--

CREATE TABLE `t_savedInvoice` (
  `id` int(11) NOT NULL,
  `tempInvoiceGenerationId` varchar(100) NOT NULL,
  `INVOICECOMPANYID` varchar(100) NOT NULL,
  `STARTDATE` varchar(50) DEFAULT NULL,
  `NOOFDAYS` int(11) DEFAULT NULL,
  `ENDDATE` varchar(50) DEFAULT NULL,
  `COMMISSIONFEE` varchar(50) DEFAULT NULL,
  `TOTALSALE` varchar(50) DEFAULT NULL,
  `TOTALGOODSALE` varchar(50) DEFAULT NULL,
  `PROCESSINGFEE` varchar(50) DEFAULT NULL,
  `REFUNDEACH` varchar(50) DEFAULT NULL,
  `NOREFUND` int(11) DEFAULT NULL,
  `TOTALREFUND` varchar(50) DEFAULT NULL,
  `CHARGEBACHEACH` varchar(50) DEFAULT NULL,
  `NOCHARGEBACK` int(11) DEFAULT NULL,
  `TOTALCHARGEBACK` varchar(50) DEFAULT NULL,
  `ACHFEE` varchar(50) DEFAULT NULL,
  `WIREFEE` varchar(50) DEFAULT NULL,
  `NETCHARGEBACK` varchar(50) DEFAULT NULL,
  `NETREFUND` varchar(50) DEFAULT NULL,
  `TOTALGROSSSALE` varchar(50) DEFAULT NULL,
  `NETDEDUCTION` varchar(50) DEFAULT NULL,
  `INVOICETYPE` varchar(10) DEFAULT NULL,
  `TOTALRESERVE` varchar(50) DEFAULT NULL,
  `RESERVEPERCENTAGE` varchar(50) DEFAULT NULL,
  `total_payout` varchar(50) DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_systemEvents`
--

CREATE TABLE `t_systemEvents` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `event` varchar(255) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_system_settings`
--

CREATE TABLE `t_system_settings` (
  `id` int(11) NOT NULL,
  `SYSTEMMAXSALESALLOWED` float NOT NULL,
  `ECHECKINGALLOWED` enum('Y','N') NOT NULL DEFAULT 'N',
  `AuthorizedSaleAmount` float NOT NULL,
  `searchLimit` int(11) NOT NULL,
  `newTollFreeNo` varchar(50) NOT NULL,
  `order_by` enum('asc','desc') NOT NULL DEFAULT 'asc',
  `Mid_Selection` enum('Y','N') NOT NULL DEFAULT 'Y',
  `pending_order_fld` enum('date','amount') NOT NULL DEFAULT 'date',
  `pending_oder_by` enum('asc','desc') NOT NULL DEFAULT 'asc',
  `techSupportStatusChange` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_system_settings`
--

INSERT INTO `t_system_settings` (`id`, `SYSTEMMAXSALESALLOWED`, `ECHECKINGALLOWED`, `AuthorizedSaleAmount`, `searchLimit`, `newTollFreeNo`, `order_by`, `Mid_Selection`, `pending_order_fld`, `pending_oder_by`, `techSupportStatusChange`) VALUES
(1, 350, 'N', 300, 10, '1-888-888-8888', 'asc', 'Y', 'date', 'asc', 'N'),
(2, 349, 'N', 0, 0, '', 'asc', 'Y', 'date', 'asc', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `t_transaction_code`
--

CREATE TABLE `t_transaction_code` (
  `transaction_code_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `transaction_code` int(11) NOT NULL,
  `rec_crt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_adminDetails`
-- (See below for the actual view)
--
CREATE TABLE `vw_adminDetails` (
`id` int(11)
,`email` varchar(50)
,`password` varchar(255)
,`phone` varchar(50)
,`fname` varchar(50)
,`lname` varchar(50)
,`alias` varchar(50)
,`address` varchar(50)
,`city` varchar(50)
,`state` varchar(50)
,`country` varchar(50)
,`zip` varchar(50)
,`image` varchar(100)
,`status` enum('Y','N')
,`rec_crt_date` datetime
,`rec_up_date` datetime
,`level` varchar(50)
,`type` varchar(50)
,`company_name` varchar(255)
,`companyID` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_adminDetails`
--
DROP TABLE IF EXISTS `vw_adminDetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_adminDetails`  AS  select `a`.`id` AS `id`,`a`.`email` AS `email`,`a`.`password` AS `password`,`a`.`phone` AS `phone`,`a`.`fname` AS `fname`,`a`.`lname` AS `lname`,`a`.`alias` AS `alias`,`a`.`address` AS `address`,`a`.`city` AS `city`,`a`.`state` AS `state`,`a`.`country` AS `country`,`a`.`zip` AS `zip`,`a`.`image` AS `image`,`a`.`status` AS `status`,`a`.`rec_crt_date` AS `rec_crt_date`,`a`.`rec_up_date` AS `rec_up_date`,`d`.`level` AS `level`,`e`.`type` AS `type`,`g`.`company_name` AS `company_name`,`g`.`companyID` AS `companyID` from ((((((`t_admin` `a` left join `t_adminAdminLevel` `b` on((`a`.`id` = `b`.`adminId`))) left join `t_adminAdminType` `c` on((`a`.`id` = `c`.`adminId`))) left join `t_adminLevel` `d` on((`b`.`adminLevelId` = `d`.`id`))) left join `t_adminType` `e` on((`c`.`adminTypeId` = `e`.`id`))) left join `t_adminCompany` `f` on((`a`.`id` = `f`.`adminId`))) left join `t_merchant` `g` on((`f`.`merchantId` = `g`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_action`
--
ALTER TABLE `t_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_adminAdminLevel`
--
ALTER TABLE `t_adminAdminLevel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_adminAdminLevel_ibfk_1` (`adminId`),
  ADD KEY `adminLevelId` (`adminLevelId`);

--
-- Indexes for table `t_adminAdminType`
--
ALTER TABLE `t_adminAdminType`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminId` (`adminId`),
  ADD KEY `adminTypeId` (`adminTypeId`);

--
-- Indexes for table `t_adminCompany`
--
ALTER TABLE `t_adminCompany`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminId` (`adminId`),
  ADD KEY `merchantId` (`merchantId`);

--
-- Indexes for table `t_adminGroup`
--
ALTER TABLE `t_adminGroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_adminLevel`
--
ALTER TABLE `t_adminLevel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_adminModuleAction`
--
ALTER TABLE `t_adminModuleAction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_adminModuleAction_ibfk_3` (`moduleActionId`),
  ADD KEY `t_adminModuleAction_ibfk_1` (`adminTypeId`),
  ADD KEY `t_adminModuleAction_ibfk_2` (`adminLevelId`);

--
-- Indexes for table `t_adminNominee`
--
ALTER TABLE `t_adminNominee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_adminType`
--
ALTER TABLE `t_adminType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_batchDetails`
--
ALTER TABLE `t_batchDetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_cart`
--
ALTER TABLE `t_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_centerGroup`
--
ALTER TABLE `t_centerGroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_center_fees`
--
ALTER TABLE `t_center_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_customer`
--
ALTER TABLE `t_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_email_template`
--
ALTER TABLE `t_email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_fees`
--
ALTER TABLE `t_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_group`
--
ALTER TABLE `t_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_groups`
--
ALTER TABLE `t_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_invoice`
--
ALTER TABLE `t_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_invoiceDebitCredit`
--
ALTER TABLE `t_invoiceDebitCredit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_logindetails`
--
ALTER TABLE `t_logindetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_loginfo`
--
ALTER TABLE `t_loginfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_merchant`
--
ALTER TABLE `t_merchant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_midmaster`
--
ALTER TABLE `t_midmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_module`
--
ALTER TABLE `t_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_moduleAction`
--
ALTER TABLE `t_moduleAction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_moduleAction_ibfk_2` (`actionId`),
  ADD KEY `t_moduleAction_ibfk_1` (`moduleId`);

--
-- Indexes for table `t_nominee`
--
ALTER TABLE `t_nominee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_product`
--
ALTER TABLE `t_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_qc_reasons`
--
ALTER TABLE `t_qc_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_reserve_fees_weekly`
--
ALTER TABLE `t_reserve_fees_weekly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_savedInvoice`
--
ALTER TABLE `t_savedInvoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_systemEvents`
--
ALTER TABLE `t_systemEvents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_system_settings`
--
ALTER TABLE `t_system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_transaction_code`
--
ALTER TABLE `t_transaction_code`
  ADD PRIMARY KEY (`transaction_code_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_action`
--
ALTER TABLE `t_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_admin`
--
ALTER TABLE `t_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_adminAdminLevel`
--
ALTER TABLE `t_adminAdminLevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_adminAdminType`
--
ALTER TABLE `t_adminAdminType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_adminCompany`
--
ALTER TABLE `t_adminCompany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_adminGroup`
--
ALTER TABLE `t_adminGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_adminLevel`
--
ALTER TABLE `t_adminLevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_adminModuleAction`
--
ALTER TABLE `t_adminModuleAction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT for table `t_adminNominee`
--
ALTER TABLE `t_adminNominee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_adminType`
--
ALTER TABLE `t_adminType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_batchDetails`
--
ALTER TABLE `t_batchDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_cart`
--
ALTER TABLE `t_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_centerGroup`
--
ALTER TABLE `t_centerGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_center_fees`
--
ALTER TABLE `t_center_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_customer`
--
ALTER TABLE `t_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_email_template`
--
ALTER TABLE `t_email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_fees`
--
ALTER TABLE `t_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `t_group`
--
ALTER TABLE `t_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_groups`
--
ALTER TABLE `t_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_invoice`
--
ALTER TABLE `t_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_invoiceDebitCredit`
--
ALTER TABLE `t_invoiceDebitCredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_logindetails`
--
ALTER TABLE `t_logindetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_loginfo`
--
ALTER TABLE `t_loginfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_merchant`
--
ALTER TABLE `t_merchant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `t_midmaster`
--
ALTER TABLE `t_midmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_module`
--
ALTER TABLE `t_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `t_moduleAction`
--
ALTER TABLE `t_moduleAction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `t_nominee`
--
ALTER TABLE `t_nominee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_product`
--
ALTER TABLE `t_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_qc_reasons`
--
ALTER TABLE `t_qc_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_reserve_fees_weekly`
--
ALTER TABLE `t_reserve_fees_weekly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_savedInvoice`
--
ALTER TABLE `t_savedInvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_systemEvents`
--
ALTER TABLE `t_systemEvents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_system_settings`
--
ALTER TABLE `t_system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_transaction_code`
--
ALTER TABLE `t_transaction_code`
  MODIFY `transaction_code_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_adminAdminLevel`
--
ALTER TABLE `t_adminAdminLevel`
  ADD CONSTRAINT `t_adminAdminLevel_ibfk_2` FOREIGN KEY (`adminLevelId`) REFERENCES `t_adminLevel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_adminAdminLevel_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `t_admin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `t_adminAdminType`
--
ALTER TABLE `t_adminAdminType`
  ADD CONSTRAINT `t_adminAdminType_ibfk_2` FOREIGN KEY (`adminTypeId`) REFERENCES `t_adminType` (`id`),
  ADD CONSTRAINT `t_adminAdminType_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `t_admin` (`id`);

--
-- Constraints for table `t_adminCompany`
--
ALTER TABLE `t_adminCompany`
  ADD CONSTRAINT `t_adminCompany_ibfk_2` FOREIGN KEY (`merchantId`) REFERENCES `t_merchant` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_adminCompany_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `t_admin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `t_adminModuleAction`
--
ALTER TABLE `t_adminModuleAction`
  ADD CONSTRAINT `t_adminModuleAction_ibfk_2` FOREIGN KEY (`adminLevelId`) REFERENCES `t_adminLevel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_adminModuleAction_ibfk_1` FOREIGN KEY (`adminTypeId`) REFERENCES `t_adminType` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_adminModuleAction_ibfk_3` FOREIGN KEY (`moduleActionId`) REFERENCES `t_moduleAction` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `t_moduleAction`
--
ALTER TABLE `t_moduleAction`
  ADD CONSTRAINT `t_moduleAction_ibfk_1` FOREIGN KEY (`moduleId`) REFERENCES `t_module` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_moduleAction_ibfk_2` FOREIGN KEY (`actionId`) REFERENCES `t_action` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
