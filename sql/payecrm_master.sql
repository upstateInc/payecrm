-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2017 at 03:16 AM
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
(73, 1, 1, 34, 'Y');

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
-- Table structure for table `t_centerGroup`
--

CREATE TABLE `t_centerGroup` (
  `id` int(11) NOT NULL,
  `groupId` varchar(100) NOT NULL,
  `companyID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'Modules', 0, 20, 'modules', 'Admin User Listings', 'fa-tasks', 'Y'),
(3, 'Transaction', 0, 100, 'transactions', 'Transaction Details', 'fa-money', 'Y'),
(9, 'Admin', 0, 12, 'admin', 'Admin Records', 'fa-user', 'Y'),
(10, 'Merchant', 0, 700, 'merchant', 'Merchant Details ', 'fa-book', 'Y');

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
(34, 10, 5, 'Y');

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
-- Indexes for table `t_centerGroup`
--
ALTER TABLE `t_centerGroup`
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
-- Indexes for table `t_merchant`
--
ALTER TABLE `t_merchant`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
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
-- AUTO_INCREMENT for table `t_centerGroup`
--
ALTER TABLE `t_centerGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `t_merchant`
--
ALTER TABLE `t_merchant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `t_module`
--
ALTER TABLE `t_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `t_moduleAction`
--
ALTER TABLE `t_moduleAction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `t_nominee`
--
ALTER TABLE `t_nominee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
