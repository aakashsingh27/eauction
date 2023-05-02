-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2023 at 03:24 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sabredge_eauction`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_liquidator`
--

CREATE TABLE `add_liquidator` (
  `id` int NOT NULL,
  `email_sent_status` varchar(50) DEFAULT NULL,
  `mobile` bigint DEFAULT NULL,
  `liquidator_name` varchar(50) DEFAULT NULL,
  `liquidator_email` varchar(80) DEFAULT NULL,
  `liquidator_password` varchar(80) DEFAULT NULL,
  `liquidator_address` varchar(255) DEFAULT NULL,
  `liquidator_address2` varchar(255) DEFAULT NULL,
  `input_city` varchar(50) DEFAULT NULL,
  `input_state` varchar(50) DEFAULT NULL,
  `input_zip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `add_liquidator`
--

INSERT INTO `add_liquidator` (`id`, `email_sent_status`, `mobile`, `liquidator_name`, `liquidator_email`, `liquidator_password`, `liquidator_address`, `liquidator_address2`, `input_city`, `input_state`, `input_zip`) VALUES
(1, NULL, 9381041949, 'Mr. Sambasivam Kannan', 'charitarthkannan@gmail.com', '12345', ' 27, Abdul Razack Street, ', 'Saidapet', 'Chennai', 'Tamil Nadu', '600015');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int NOT NULL,
  `status` varchar(50) DEFAULT 'enable',
  `user_type` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` bigint DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `a_email` varchar(50) DEFAULT NULL,
  `a_name` varchar(50) DEFAULT NULL,
  `a_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `status`, `user_type`, `address`, `mobile`, `gender`, `designation`, `a_email`, `a_name`, `a_password`) VALUES
(1, 'enable', '1', 'delhi', 7701931014, 'Male', 'Employee', 'admin@gmail.com', 'Admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assign_bidders_by_liquidator`
--

CREATE TABLE `assign_bidders_by_liquidator` (
  `id` int NOT NULL,
  `liquidator_id` int DEFAULT NULL,
  `bidder_id` int DEFAULT NULL,
  `company_id` int DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assign_bidders_by_liquidator`
--

INSERT INTO `assign_bidders_by_liquidator` (`id`, `liquidator_id`, `bidder_id`, `company_id`, `date_time`) VALUES
(1, 1, 1, 3, '2022-12-31 00:00:00'),
(2, 1, 2, 1, '2022-12-31 11:47:39'),
(3, 1, 3, 1, '2022-12-31 11:51:14'),
(4, 1, 2, 2, '2022-12-31 11:51:25'),
(5, 1, 2, 3, '2022-12-31 11:52:06'),
(6, 1, 3, 2, '2022-12-31 11:52:52'),
(7, 1, 4, 3, '2022-12-31 11:52:59'),
(8, 1, 5, 1, '2022-12-31 11:53:05'),
(9, 1, 6, 2, '2022-12-31 11:53:12'),
(10, 1, 3, 3, '2022-12-31 11:53:19'),
(11, 1, 6, 1, '2022-12-31 11:53:46'),
(12, 1, 8, 1, '2022-12-31 12:23:38'),
(13, 1, 8, 2, '2022-12-31 12:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `assign_liquidator`
--

CREATE TABLE `assign_liquidator` (
  `id` int NOT NULL,
  `email_sent_status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `company_id` int DEFAULT NULL,
  `liquidator_id` int DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `assign_liquidator`
--

INSERT INTO `assign_liquidator` (`id`, `email_sent_status`, `company_id`, `liquidator_id`, `date`) VALUES
(1, NULL, 1, 1, '0000-00-00'),
(2, NULL, 2, 1, '0000-00-00'),
(3, NULL, 3, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `bidder_status`
--

CREATE TABLE `bidder_status` (
  `id` int NOT NULL,
  `bidder_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bidder_status`
--

INSERT INTO `bidder_status` (`id`, `bidder_id`) VALUES
(1, 11),
(2, 2),
(3, 6),
(4, 5),
(5, 7),
(6, 8),
(7, 8),
(8, 5),
(9, 7),
(10, 8),
(11, 5),
(12, 7),
(13, 8),
(14, 5),
(15, 7),
(16, 8),
(17, 5),
(18, 7),
(19, 8),
(20, 5),
(21, 7),
(22, 8),
(23, 5),
(24, 7),
(25, 5),
(26, 7),
(27, 8),
(28, 7),
(29, 9);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int NOT NULL,
  `city_name` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`) VALUES
(1, 'Delhi'),
(2, 'Noida'),
(3, 'gurgaon'),
(4, 'faridabad'),
(5, 'Chennai');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `address`) VALUES
(1, ' M/s. KAPICO MOTORS INDIA PRIVATE LIMITED 1', 'Chennai '),
(2, ' M/s. KAPICO MOTORS INDIA PRIVATE LIMITED 2', 'Chennai'),
(3, ' M/s. KAPICO MOTORS INDIA PRIVATE LIMITED 3', 'Chennai');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `create_sale`
--

CREATE TABLE `create_sale` (
  `id` int NOT NULL,
  `property_type` varchar(100) DEFAULT NULL,
  `state_id` varchar(50) DEFAULT NULL,
  `city_id` varchar(50) DEFAULT NULL,
  `emp` decimal(65,2) NOT NULL DEFAULT '0.00',
  `auction_type` varchar(50) DEFAULT NULL,
  `company_id` varchar(50) DEFAULT NULL,
  `buffer_time` varchar(50) DEFAULT NULL,
  `create_by_liquiditor_id` varchar(50) DEFAULT NULL,
  `Title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Pdf` varchar(255) DEFAULT NULL,
  `Incremental` decimal(65,2) NOT NULL DEFAULT '0.00',
  `Reserve_Price` decimal(65,2) NOT NULL DEFAULT '0.00',
  `Start_Date_Auction` datetime DEFAULT NULL,
  `End_Date_Auction` datetime DEFAULT NULL,
  `liquidator_email_sent_status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `create_sale`
--

INSERT INTO `create_sale` (`id`, `property_type`, `state_id`, `city_id`, `emp`, `auction_type`, `company_id`, `buffer_time`, `create_by_liquiditor_id`, `Title`, `Pdf`, `Incremental`, `Reserve_Price`, `Start_Date_Auction`, `End_Date_Auction`, `liquidator_email_sent_status`) VALUES
(1, '3', '9', '5', '55000.00', 'forward', '1', '1', '1', 'MARUTHI SWIFT ZXI BS4 AMT(PETROL) having Registration Number TN 01 BE 5790 (2018 Model) ', 'Kapico Process Memorandum.pdf', '5000.00', '550000.00', '2023-01-27 11:30:00', '2023-01-27 12:30:26', NULL),
(2, '3', '9', '5', '57500.00', 'forward', '2', '2', '1', 'MARUTHI BALENO ZETA PTRL BS4 AMT(PETROL) TN 01 BC 8874 (2017 Model)', 'Kapico Process Memorandum.pdf', '5000.00', '575000.00', '2023-01-27 11:30:00', '2023-01-27 12:30:17', NULL),
(3, '3', '9', '5', '40000.00', 'forward', '3', '3', '1', 'MARUTI IGNIS ALPHA BS4(DIESEL) TN 01 BE 5422 (2017 Model)', 'Kapico Process Memorandum.pdf', '5000.00', '400000.00', '2023-01-27 11:30:00', '2023-01-27 12:30:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cron_test`
--

CREATE TABLE `cron_test` (
  `id` int NOT NULL,
  `test` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_api_credentials`
--

CREATE TABLE `email_api_credentials` (
  `id` int NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `port_number` varchar(150) DEFAULT NULL,
  `host` varchar(150) DEFAULT NULL,
  `smtp_auth` varchar(150) DEFAULT NULL,
  `smtp_secure` varchar(150) DEFAULT NULL,
  `from_mail` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `email_api_credentials`
--

INSERT INTO `email_api_credentials` (`id`, `email`, `password`, `port_number`, `host`, `smtp_auth`, `smtp_secure`, `from_mail`) VALUES
(1, 'support@ipsupport.in', 'jigsaw@3208', '465', 'eauction.ipsupport.in', 'true', 'ssl', 'support@ipsupport.in');

-- --------------------------------------------------------

--
-- Table structure for table `existing_bidders_request`
--

CREATE TABLE `existing_bidders_request` (
  `id` int NOT NULL,
  `reason_for_disapprove` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `pan_card_image` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bidder_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `company_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `liquidator_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `annual_income` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `existing_bidders_request`
--

INSERT INTO `existing_bidders_request` (`id`, `reason_for_disapprove`, `pan_card_image`, `bidder_id`, `company_id`, `date`, `liquidator_id`, `status`, `annual_income`) VALUES
(1, NULL, 'Kapico Auction Chart.pdf', '1', '3', '2022-12-31', '1', 'approved', '700000');

-- --------------------------------------------------------

--
-- Table structure for table `latest_announcement`
--

CREATE TABLE `latest_announcement` (
  `id` int NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `latest_announcement`
--

INSERT INTO `latest_announcement` (`id`, `content`) VALUES
(1, 'IP Supports is Committed to Provide, Efficient and easy to use e-auction Platform for insolvency professionals, investors and establishments for direction');

-- --------------------------------------------------------

--
-- Table structure for table `liquidator_login`
--

CREATE TABLE `liquidator_login` (
  `id` int NOT NULL,
  `username` text NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livebidding`
--

CREATE TABLE `livebidding` (
  `id` int NOT NULL,
  `number_of_extension` varchar(500) DEFAULT NULL,
  `reserver_Price` decimal(65,2) NOT NULL DEFAULT '0.00',
  `highestBid` decimal(65,2) NOT NULL DEFAULT '0.00',
  `nextBid` decimal(65,2) NOT NULL DEFAULT '0.00',
  `bidder_fid` varchar(11) DEFAULT NULL,
  `salenotice_id` varchar(12) DEFAULT NULL,
  `incremental_val` decimal(65,2) NOT NULL DEFAULT '0.00',
  `ipaddress` varchar(200) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `livebidding`
--

INSERT INTO `livebidding` (`id`, `number_of_extension`, `reserver_Price`, `highestBid`, `nextBid`, `bidder_fid`, `salenotice_id`, `incremental_val`, `ipaddress`, `datetime`) VALUES
(1, '4', '550000.00', '552000.00', '552500.00', '3', '1', '500.00', '122.161.53.142', '2022-12-31 12:31:29'),
(2, '2', '550000.00', '553000.00', '553000.00', '8', '1', '500.00', '165.225.124.187', '2022-12-31 12:31:47'),
(3, '1', '550000.00', '553500.00', '554000.00', '3', '1', '500.00', '122.161.53.142', '2022-12-31 12:32:06'),
(4, '500', '400000.00', '650000.00', '650500.00', '4', '3', '500.00', '122.161.53.142', '2022-12-31 12:32:08'),
(5, '10', '550000.00', '558500.00', '554500.00', '2', '1', '500.00', '122.161.53.142', '2022-12-31 12:32:17'),
(6, '10', '550000.00', '563500.00', '559500.00', '3', '1', '500.00', '122.161.53.142', '2022-12-31 12:32:34'),
(7, '1', '550000.00', '564000.00', '564500.00', '5', '1', '500.00', '103.212.158.21', '2022-12-31 12:32:41'),
(8, '1', '575000.00', '575500.00', '576000.00', '2', '2', '500.00', '122.161.53.142', '2022-12-31 12:32:50'),
(9, '1', '550000.00', '564500.00', '565000.00', '3', '1', '500.00', '122.161.53.142', '2022-12-31 12:33:02'),
(10, '1', '400000.00', '650500.00', '651000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:33:20'),
(11, '1', '550000.00', '565000.00', '565500.00', '3', '1', '500.00', '122.161.53.142', '2022-12-31 12:33:56'),
(12, '2', '575000.00', '576500.00', '576500.00', '8', '2', '500.00', '165.225.124.187', '2022-12-31 12:34:02'),
(13, '3', '550000.00', '566500.00', '566000.00', '5', '1', '500.00', '103.212.158.21', '2022-12-31 12:34:16'),
(14, '8', '550000.00', '570500.00', '567500.00', '5', '1', '500.00', '103.212.158.21', '2022-12-31 12:35:05'),
(15, '1', '550000.00', '571000.00', '571500.00', '2', '1', '500.00', '122.161.53.142', '2022-12-31 12:35:15'),
(16, '5', '400000.00', '653000.00', '651500.00', '4', '3', '500.00', '122.161.53.142', '2022-12-31 12:35:24'),
(17, '3', '575000.00', '578000.00', '577500.00', '8', '2', '500.00', '165.225.124.187', '2022-12-31 12:36:11'),
(18, '3', '400000.00', '654500.00', '654000.00', '3', '3', '500.00', '122.161.53.142', '2022-12-31 12:36:31'),
(19, '10', '575000.00', '583000.00', '579000.00', '3', '2', '500.00', '122.161.53.142', '2022-12-31 12:36:44'),
(20, '1', '575000.00', '583500.00', '584000.00', '8', '2', '500.00', '165.225.124.187', '2022-12-31 12:37:16'),
(21, '2', '575000.00', '584500.00', '584500.00', '3', '2', '500.00', '122.161.53.142', '2022-12-31 12:37:37'),
(22, '20', '400000.00', '664500.00', '655500.00', '3', '3', '500.00', '122.161.53.142', '2022-12-31 12:37:49'),
(23, '1', '550000.00', '571500.00', '572000.00', '3', '1', '500.00', '122.161.53.142', '2022-12-31 12:39:07'),
(24, '1', '550000.00', '572000.00', '572500.00', '2', '1', '500.00', '122.161.53.142', '2022-12-31 12:39:13'),
(25, '4', '575000.00', '586500.00', '585500.00', '8', '2', '500.00', '165.225.124.187', '2022-12-31 12:39:24'),
(26, '10', '550000.00', '577000.00', '573000.00', '5', '1', '500.00', '103.212.158.21', '2022-12-31 12:39:26'),
(27, '2', '550000.00', '573000.00', '573000.00', '2', '1', '500.00', '122.161.53.142', '2022-12-31 12:39:26'),
(28, '10', '400000.00', '669500.00', '665500.00', '4', '3', '500.00', '122.161.53.142', '2022-12-31 12:40:37'),
(29, '11', '575000.00', '1097000.00', '587500.00', '8', '2', '500.00', '165.225.124.187', '2022-12-31 13:24:49'),
(30, '10', '400000.00', '1097000.00', '670500.00', '3', '3', '500.00', '122.161.53.142', '2022-12-31 13:24:44'),
(31, '1000', '575000.00', '1092000.00', '593000.00', '2', '2', '500.00', '122.161.53.142', '2022-12-31 12:43:22'),
(32, '9999', '400000.00', '1097000.00', '675500.00', '3', '3', '500.00', '122.161.53.142', '2022-12-31 13:24:33'),
(33, '10', '575000.00', '1097000.00', '1093000.00', '2', '2', '500.00', '122.161.53.142', '2022-12-31 12:44:17'),
(34, '10', '575000.00', '1097000.00', '1098000.00', '8', '2', '500.00', '165.225.124.187', '2022-12-31 12:44:17'),
(35, '1', '400000.00', '5674500.00', '5675000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:46:42'),
(36, '1', '400000.00', '5674500.00', '5675500.00', '3', '3', '500.00', '122.161.53.142', '2022-12-31 12:46:43'),
(37, '3', '400000.00', '5676000.00', '5675500.00', '4', '3', '500.00', '122.161.53.142', '2022-12-31 12:49:38'),
(38, '9999', '400000.00', '10675500.00', '5677000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:50:15'),
(39, '2', '400000.00', '10676500.00', '10676500.00', '3', '3', '500.00', '122.161.53.142', '2022-12-31 12:50:27'),
(40, '9999', '400000.00', '15676000.00', '10677500.00', '4', '3', '500.00', '122.161.53.142', '2022-12-31 12:50:29'),
(41, '9999', '400000.00', '20675500.00', '15677000.00', '3', '3', '500.00', '122.161.53.142', '2022-12-31 12:51:45'),
(42, '001', '400000.00', '20676000.00', '20676500.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:52:27'),
(43, '2', '400000.00', '20677000.00', '20677000.00', '4', '3', '500.00', '122.161.53.142', '2022-12-31 12:53:03'),
(44, '1', '400000.00', '20677500.00', '20678000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:53:50'),
(45, '1', '400000.00', '20678000.00', '20678500.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:53:55'),
(46, '1', '400000.00', '20678500.00', '20679000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:54:00'),
(47, '1', '400000.00', '20679000.00', '20679500.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:54:05'),
(48, '1', '400000.00', '20679500.00', '20680000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:54:10'),
(49, '1', '400000.00', '20680000.00', '20680500.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:54:17'),
(50, '2', '400000.00', '20681000.00', '20681000.00', '3', '3', '500.00', '122.161.53.142', '2022-12-31 12:54:21'),
(51, '1', '400000.00', '20681500.00', '20682000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:54:23'),
(52, '1', '400000.00', '20682000.00', '20682500.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:54:29'),
(53, '1', '400000.00', '20682500.00', '20683000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:54:36'),
(54, '1', '400000.00', '20683000.00', '20683500.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:54:43'),
(55, '1000', '400000.00', '21183000.00', '20684000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:55:30'),
(56, '9999', '400000.00', '26182500.00', '21184000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:55:54'),
(57, '1', '400000.00', '26183000.00', '26183500.00', '4', '3', '500.00', '122.161.53.142', '2022-12-31 12:56:03'),
(58, '9999', '400000.00', '31182500.00', '26184000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:56:14'),
(59, '1', '400000.00', '31183000.00', '31183500.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:56:52'),
(60, '1', '400000.00', '31183500.00', '31184000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:57:01'),
(61, '1', '400000.00', '31184000.00', '31184500.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:57:07'),
(62, '1', '400000.00', '31184500.00', '31185000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:57:19'),
(63, '1', '400000.00', '31185000.00', '31185500.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:57:58'),
(64, '0022', '400000.00', '31196000.00', '31186000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:58:34'),
(65, '1', '400000.00', '31196500.00', '31197000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:58:47'),
(66, '1', '400000.00', '31197000.00', '31197500.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 12:59:11'),
(67, '1', '400000.00', '31197500.00', '31198000.00', '2', '3', '500.00', '122.161.53.142', '2022-12-31 13:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int UNSIGNED NOT NULL,
  `page_name` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `action` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_id` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `remark` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newbidder_login`
--

CREATE TABLE `newbidder_login` (
  `id` int NOT NULL,
  `user_logged_in_id` varchar(50) DEFAULT NULL,
  `email_sent_status` varchar(255) DEFAULT NULL,
  `disapprove_reason` varchar(150) DEFAULT NULL,
  `otp` varchar(30) DEFAULT NULL,
  `register_for_sale_notice_id` varchar(50) DEFAULT NULL,
  `register_from` varchar(50) DEFAULT NULL,
  `uid` varchar(50) DEFAULT NULL,
  `bidder_mobile` bigint DEFAULT NULL,
  `bidder_add_by_liquiditor_id` varchar(50) DEFAULT NULL,
  `Bidder_Name` varchar(50) DEFAULT NULL,
  `Bidder_Email` varchar(80) DEFAULT NULL,
  `Bidder_Password` varchar(50) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'deactive',
  `request_approval` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `newbidder_login`
--

INSERT INTO `newbidder_login` (`id`, `user_logged_in_id`, `email_sent_status`, `disapprove_reason`, `otp`, `register_for_sale_notice_id`, `register_from`, `uid`, `bidder_mobile`, `bidder_add_by_liquiditor_id`, `Bidder_Name`, `Bidder_Email`, `Bidder_Password`, `status`, `request_approval`) VALUES
(1, '666799214', NULL, NULL, '8892', NULL, NULL, '12345678', 9654124186, NULL, 'saurabh singh', 'saurabh@jigsaw.edu.in', '650610', 'active', NULL),
(2, '25873913', NULL, NULL, NULL, NULL, NULL, '987654321', 9311024666, '1', 'Yash Sharma', 'godigital@jigsaw.edu.in', '12345', 'active', NULL),
(3, '151297048', NULL, NULL, NULL, NULL, NULL, '87654321', 9999999999, '1', 'Golu', 'golukumar1242001@gmail.com', '12345', 'active', NULL),
(4, '11416547', NULL, NULL, NULL, NULL, NULL, '7654321', 9999999999, '1', 'Arvind', 'arvindrawat5595@gmail.com', '12345', 'active', NULL),
(5, '518881694', NULL, NULL, NULL, NULL, NULL, '654321', 999999999, '1', 'Dinesh', 'dineshkumar@jigsaw.edu.in', '12345', 'active', NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, '54321', 9999999999, '1', 'Mohan', 'software@jigsaw.edu.in', '12345', 'deactive', NULL),
(8, '914533317', NULL, NULL, '5167', '1', NULL, '123456', 7982380091, '1', 'mohaan', 'mohan.bachhety@gmail.com', '649943', 'active', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `otp_consent`
--

CREATE TABLE `otp_consent` (
  `id` int NOT NULL,
  `consent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `otp_consent`
--

INSERT INTO `otp_consent` (`id`, `consent`) VALUES
(1, 'without otp');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int NOT NULL,
  `state_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state_name`) VALUES
(6, 'Delhi'),
(8, 'Uttrakhand'),
(9, 'Tamil Nadu');

-- --------------------------------------------------------

--
-- Table structure for table `sub_liquidator`
--

CREATE TABLE `sub_liquidator` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mobile` bigint DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `add_by_liquidator` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_of_property`
--

CREATE TABLE `type_of_property` (
  `id` int NOT NULL,
  `property_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `type_of_property`
--

INSERT INTO `type_of_property` (`id`, `property_type`) VALUES
(3, 'vehicle'),
(5, 'machinery '),
(6, 'garbage'),
(7, 'Asset');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_liquidator`
--
ALTER TABLE `add_liquidator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_bidders_by_liquidator`
--
ALTER TABLE `assign_bidders_by_liquidator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_liquidator`
--
ALTER TABLE `assign_liquidator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidder_status`
--
ALTER TABLE `bidder_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `create_sale`
--
ALTER TABLE `create_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cron_test`
--
ALTER TABLE `cron_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_api_credentials`
--
ALTER TABLE `email_api_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `existing_bidders_request`
--
ALTER TABLE `existing_bidders_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latest_announcement`
--
ALTER TABLE `latest_announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liquidator_login`
--
ALTER TABLE `liquidator_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livebidding`
--
ALTER TABLE `livebidding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newbidder_login`
--
ALTER TABLE `newbidder_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_consent`
--
ALTER TABLE `otp_consent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_liquidator`
--
ALTER TABLE `sub_liquidator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_property`
--
ALTER TABLE `type_of_property`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_liquidator`
--
ALTER TABLE `add_liquidator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_bidders_by_liquidator`
--
ALTER TABLE `assign_bidders_by_liquidator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `assign_liquidator`
--
ALTER TABLE `assign_liquidator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `create_sale`
--
ALTER TABLE `create_sale`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cron_test`
--
ALTER TABLE `cron_test`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_api_credentials`
--
ALTER TABLE `email_api_credentials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `existing_bidders_request`
--
ALTER TABLE `existing_bidders_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `latest_announcement`
--
ALTER TABLE `latest_announcement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `livebidding`
--
ALTER TABLE `livebidding`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newbidder_login`
--
ALTER TABLE `newbidder_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `otp_consent`
--
ALTER TABLE `otp_consent`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_liquidator`
--
ALTER TABLE `sub_liquidator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_of_property`
--
ALTER TABLE `type_of_property`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
