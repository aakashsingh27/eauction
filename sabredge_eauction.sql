-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2023 at 11:49 AM
-- Server version: 8.0.33
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, NULL, 9381041949, 'Mr. Sambasivam Kannan', 'charitarthkannan@gmail.com', '12345', ' 27, Abdul Razack Street, ', 'Saidapet', 'Chennai', 'Tamil Nadu', '600015'),
(3, NULL, 8787878785, 'Goerge', 'goerge@gmail.com', '1234', 'Delhi', 'Delhi', 'Delhi', 'Delhi', '110075'),
(4, 'sent', 7895895489, 'VB', 'bagrinmundhra2@gmail.com', '9876', 'Delhi', 'Delhi', 'Delhi', 'Delhi', '110084'),
(6, 'send', 7878787878, 'Aakash liquidator', 'developer@jigsaw.edu.in', '1234', 'Delhi', 'Delhi', 'Delhi', 'Delhi', '110074'),
(7, 'send', 9826677735, 'Kuldeep ', 'support1@mvkirp.com', 'Kuldeep@123', 'New Delhi', 'New Delhi', 'Delhi', 'Delhi', '110005'),
(8, 'sent', 7847596574, 'GOLU', 'golukumar1242001@gmail.com', '1234', 'Delhi', 'Delhi', 'Delhi', 'Delhi', '110084'),
(9, NULL, 7875858585, 'Lorem', 'lorem@gmail.com', '1234', 'Delhi', 'Delhi', 'Delhi', 'Delhi', '110084'),
(10, NULL, 9561071705, 'Balaji Shrirang Sagar ', 'balajisagar381973@gmail.com', 'balaji@123', 'Sr.No.21/5, Opp.Creative Camio', 'Near PCMC - D Ward Office, Rahatani, Post Aundh Camp, Pune - 411027', 'Pune', 'Maharashtra ', '411027');

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
(1, 'enable', '1', 'delhi', 7701931014, 'Male', 'Employee', 'admin@gmail.com', 'Admin', '9845695b8067dc55bd73ec840a1a42e6');

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
(47, 1, 27, 3, '2023-01-24 10:37:50'),
(48, 1, 28, 2, '2023-01-24 10:38:20'),
(49, 1, 29, 1, '2023-01-24 10:38:49'),
(52, 1, 27, 2, '2023-02-21 17:17:46'),
(53, 1, 27, 1, '2023-02-21 17:45:43'),
(54, 1, 37, 6, NULL),
(59, 7, 40, 8, NULL),
(60, 7, 41, 8, NULL),
(65, 3, 43, 10, '2023-04-01 11:08:52'),
(66, 3, 38, 11, NULL),
(67, 3, 42, 11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assign_display_company_liquidator`
--

CREATE TABLE `assign_display_company_liquidator` (
  `id` int NOT NULL,
  `company_id` varchar(100) DEFAULT NULL,
  `liquidator_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assign_display_company_liquidator`
--

INSERT INTO `assign_display_company_liquidator` (`id`, `company_id`, `liquidator_id`) VALUES
(1, '1', '1'),
(2, '2', '3'),
(4, '4', '10');

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
(3, NULL, 3, 1, '0000-00-00'),
(6, NULL, 6, 1, '0000-00-00'),
(8, NULL, 8, 7, '0000-00-00'),
(9, NULL, 10, 3, '0000-00-00'),
(10, NULL, 11, 3, '0000-00-00'),
(11, NULL, 9, 3, '0000-00-00'),
(12, NULL, 13, 10, '0000-00-00');

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
  `state_id` int DEFAULT NULL,
  `city_name` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `state_id`, `city_name`) VALUES
(5, 9, 'Chennai'),
(9, 6, 'Delhi'),
(10, 8, 'Dehradun'),
(11, 8, 'Haridwar'),
(12, 8, 'Nainital'),
(13, 8, 'Rishikesh'),
(14, 8, 'Haldwani'),
(15, 8, 'Uttarkashi'),
(16, 8, 'Ranikhet'),
(17, 8, 'Almora'),
(18, 8, 'Pauri'),
(19, 8, 'Mussoorie'),
(20, 8, 'Joshimath'),
(21, 8, 'Roorkee'),
(22, 8, 'Kashipur'),
(23, 8, 'Rudrapur'),
(24, 8, 'Pithoragarh'),
(25, 8, 'Ramnagar'),
(26, 8, 'Srinagar'),
(27, 8, 'Bageshwar'),
(28, 8, 'New Tehri'),
(29, 8, 'Vikasnagar'),
(30, 8, 'Khatima'),
(31, 8, 'Kotdwar'),
(32, 8, 'Rudraprayag'),
(33, 8, 'Barkot'),
(34, 8, 'Didihat'),
(35, 8, 'Devprayag'),
(36, 8, 'Champawat'),
(37, 8, 'Kirtinagar'),
(38, 8, 'Bazpur'),
(39, 8, 'Dwarahat'),
(40, 8, 'Kichha'),
(41, 8, 'Chakrata'),
(42, 8, 'Dharchula'),
(43, 8, 'Gopeshwar'),
(44, 8, 'Bhowali'),
(45, 8, 'Chamba'),
(46, 8, 'Gauchar'),
(47, 8, 'Jaspur'),
(48, 8, 'Sitarganj'),
(49, 8, 'Nagla'),
(50, 8, 'Bhimtal'),
(51, 8, 'Manglaur'),
(52, 8, 'Dugadda'),
(53, 8, 'Narendra Nagar'),
(54, 8, 'Lohaghat'),
(55, 8, 'Lansdowne'),
(56, 8, 'Laksar'),
(57, 8, 'Tanakpur'),
(58, 8, 'Karnaprayag'),
(59, 8, 'Kaladhungi'),
(60, 8, 'Banbasa'),
(61, 9, 'Madurai'),
(62, 9, 'Coimbatore'),
(63, 9, 'Salem'),
(64, 9, 'Tiruchirappalli'),
(65, 9, 'Thanjavur'),
(66, 9, 'Tirunelveli'),
(67, 9, 'Thoothukudi'),
(68, 9, 'Tiruppur'),
(69, 9, 'Vellore'),
(70, 9, 'Kanchipuram'),
(71, 9, 'Cuddalore'),
(72, 9, 'Dindigul'),
(73, 9, 'Erode'),
(74, 9, 'Karur'),
(75, 9, 'Ooty'),
(76, 9, 'Pudukkottai'),
(77, 9, 'Nagapattinam'),
(78, 9, 'Sivaganga'),
(79, 9, 'Nagercoil'),
(80, 9, 'Gudiyatham'),
(81, 9, 'Kumbakonam'),
(82, 9, 'Pollachi'),
(83, 9, 'Karaikudi'),
(84, 9, 'Hosur'),
(85, 9, 'Ambur'),
(86, 9, 'Ranipet'),
(87, 9, 'Vaniyambadi'),
(88, 9, 'Dharmapuri'),
(89, 9, 'Komarapalayam'),
(90, 9, 'Rajapalayam'),
(91, 9, 'Kanyakumari'),
(92, 9, 'Neyveli'),
(93, 9, 'Krishnagiri'),
(94, 9, 'Sivakasi'),
(95, 9, 'Ramanathapuram'),
(96, 9, 'Maduranthakam'),
(97, 9, 'Viluppuram'),
(98, 9, 'Chengalpattu'),
(99, 9, 'Namakkal'),
(100, 9, 'Kancheepuram'),
(101, 9, 'Virudhunagar'),
(102, 9, 'Thiruvallur'),
(103, 9, 'Thiruvarur'),
(104, 9, 'Ariyalur'),
(105, 9, 'Panruti'),
(106, 9, 'Kodaikanal'),
(107, 9, 'Gobichettipalayam'),
(108, 9, 'Perambalur'),
(109, 9, 'Theni'),
(110, 9, 'Chidambaram'),
(111, 24, 'Hisar'),
(112, 10, 'Visakhapatnam'),
(113, 10, 'Vijayawada'),
(114, 10, ' Tirupati'),
(115, 10, 'Rajamahendravaram'),
(116, 10, 'Kakinada'),
(117, 10, ' Kurnool'),
(118, 10, 'Guntur'),
(119, 10, 'Nellore'),
(120, 10, ' Anantapur'),
(121, 10, 'Srikakulam'),
(122, 10, ' Kadapa'),
(123, 10, 'Vizianagaram'),
(124, 10, 'Eluru'),
(125, 10, ' Machilipatnam'),
(126, 10, ' Ongole'),
(127, 10, 'Bhimavaram'),
(128, 10, ' Chittoor'),
(129, 10, 'Adoni'),
(130, 10, 'Proddatur'),
(131, 10, 'Dharmavaram'),
(132, 10, ' Hindupuram'),
(133, 10, 'Chilakaluripet'),
(134, 10, 'Amaravati'),
(135, 10, 'Guntakal'),
(136, 10, 'Narasaraopeta'),
(137, 10, ' Nandyala'),
(138, 10, ' Gudivada'),
(139, 10, ' Tenali'),
(140, 10, ' Madanapalle'),
(141, 10, ' Kadiri'),
(142, 10, ' Tadipatri'),
(143, 10, ' Tadepalligudem'),
(144, 10, ' Bheemunipatnam'),
(145, 10, ' Palakollu'),
(146, 10, '  Chirala'),
(147, 10, ' Anakapalle'),
(148, 10, ' Puttur'),
(149, 10, ' Amalapuram'),
(150, 10, ' Bapatla'),
(151, 10, 'Parvathipuram'),
(152, 10, ' Rayachoty'),
(153, 10, ' Sattenapalle'),
(154, 10, 'Kavali'),
(155, 10, ' Mangalagiri'),
(156, 10, ' Samarlakota'),
(157, 10, 'Badvel'),
(158, 10, 'Vinukonda'),
(159, 10, ' Pulivendula'),
(160, 10, ' Palamaner'),
(161, 10, ' Palasa'),
(162, 10, 'Piduguralla'),
(163, 11, 'Raipur'),
(164, 11, 'Bilaspur'),
(165, 11, 'Bhilai'),
(166, 11, ' Korba'),
(167, 11, ' Raigarh'),
(168, 11, 'Jagdalpur'),
(169, 11, 'Dhamtari'),
(170, 11, 'Rajnandgaon'),
(171, 11, ' Durg'),
(172, 11, 'Ambikapur'),
(173, 11, 'Atal Nagar-Nava Raipur'),
(174, 11, 'Chirimiri'),
(175, 11, 'Dalli Rajhara'),
(176, 11, ' Bemetara'),
(177, 11, 'Arang'),
(178, 11, 'Akaltara'),
(179, 11, 'Gaurella'),
(180, 16, 'Pune'),
(181, 16, 'Mumbai');

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
(3, ' M/s. KAPICO MOTORS INDIA PRIVATE LIMITED 3', 'Chennai'),
(5, 'Goodwill', 'Delhi'),
(6, 'M/s. KAPICO MOTORS INDIA PRIVATE LIMITED 4', '27, Abdul Razack Street, Saidapet, Chennai-600 015'),
(7, 'XYZ Pvt. Ltd.', 'Delhi'),
(8, 'Kuldeep & Sons.', 'Delhi'),
(9, 'Maruti', 'Delhi'),
(10, 'BMW', 'Noida'),
(11, 'Hyundai ', 'Delhi'),
(13, 'M/s. MTC Ecom Private Limited ', '201 A, 2nd Floor, Pinnacle Corporate Park, Building No.19, A Wing, BKC, Bandra East, Mumbai 400051');

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
  `super_company_name` varchar(255) DEFAULT NULL,
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
  `pdf2` varchar(255) DEFAULT NULL,
  `pdf3` varchar(255) DEFAULT NULL,
  `pdf4` varchar(255) DEFAULT NULL,
  `pdf5` varchar(255) DEFAULT NULL,
  `Incremental` decimal(65,2) NOT NULL DEFAULT '0.00',
  `Reserve_Price` decimal(65,2) NOT NULL DEFAULT '0.00',
  `Start_Date_Auction` datetime DEFAULT NULL,
  `End_Date_Auction` datetime DEFAULT NULL,
  `liquidator_email_sent_status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `create_sale`
--

INSERT INTO `create_sale` (`id`, `super_company_name`, `property_type`, `state_id`, `city_id`, `emp`, `auction_type`, `company_id`, `buffer_time`, `create_by_liquiditor_id`, `Title`, `Pdf`, `pdf2`, `pdf3`, `pdf4`, `pdf5`, `Incremental`, `Reserve_Price`, `Start_Date_Auction`, `End_Date_Auction`, `liquidator_email_sent_status`) VALUES
(1, '1', '3', '9', '5', 55000.00, 'forward', '1', '1', '1', 'MARUTHI SWIFT ZXI BS4 AMT(PETROL) having Registration Number TN 01 BE 5790 (2018 Model) ', 'Kapico Process Memorandum.pdf', 'invc_print_prvw_watermark.pdf', NULL, NULL, NULL, 5000.00, 550000.00, '2023-01-27 11:30:00', '2023-01-27 12:30:00', NULL),
(2, '1', '3', '9', '5', 57500.00, 'forward', '2', '2', '1', 'MARUTHI BALENO ZETA PTRL BS4 AMT(PETROL) TN 01 BC 8874 (2017 Model)', 'Kapico Process Memorandum.pdf', NULL, NULL, NULL, NULL, 5000.00, 575000.00, '2023-01-27 11:30:00', '2023-01-27 12:30:00', NULL),
(3, '1', '3', '9', '5', 40000.00, 'forward', '3', '3', '1', 'MARUTI IGNIS ALPHA BS4(DIESEL) TN 01 BE 5422 (2017 Model)', 'Kapico Process Memorandum.pdf', NULL, NULL, NULL, NULL, 5000.00, 400000.00, '2023-01-27 11:30:00', '2023-01-27 12:30:00', NULL),
(14, '1', '3', '9', '5', 10000.00, 'forward', '6', '5', '1', 'MARUTI RITZ VDI (DIESEL) having Registration Number TN 02 AL 3119 (2010 Model)', 'Ritz Process Memorandum.pdf', '', '', '', '', 5000.00, 100000.00, '2023-02-24 11:30:00', '2023-02-24 12:30:00', NULL),
(18, '2', '3', '6', '9', 5000.00, 'forward', '10', '5', '3', 'BMW X5 2200', 'Untitled.png', '', '', '', '', 1000.00, 100000.00, '2023-04-01 11:05:00', '2023-04-01 11:22:59', NULL),
(20, '4', '5', '16', '181', 127500.00, 'forward', '13', '5', '10', 'Plant & Machinery', 'Sales Notice PDF.pdf', 'Memorandum of MTC Ecom pvt. ltd..pdf', '', '', '', 25000.00, 1275000.00, '2023-05-27 10:00:00', '2023-05-27 11:00:00', NULL),
(21, '4', '7', '16', '181', 24650.00, 'forward', '13', '5', '10', 'Office Equipment’s', 'Sales Notice PDF.pdf', 'Memorandum of MTC Ecom pvt. ltd..pdf', '', '', '', 10000.00, 246500.00, '2023-05-27 11:00:00', '2023-05-27 12:00:00', NULL),
(22, '4', '12', '16', '181', 185000.00, 'forward', '13', '5', '10', 'Inventory', 'Sales Notice PDF.pdf', 'Memorandum of MTC Ecom pvt. ltd..pdf', '', '', '', 25000.00, 1850000.00, '2023-05-27 12:00:00', '2023-05-27 13:30:00', NULL);

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
-- Table structure for table `display_company`
--

CREATE TABLE `display_company` (
  `id` int NOT NULL,
  `company_name` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `display_company`
--

INSERT INTO `display_company` (`id`, `company_name`) VALUES
(1, 'M/s. KAPICO MOTORS INDIA PRIVATE LIMITED'),
(2, 'MAHINDRA'),
(3, 'Accenture'),
(4, 'M/s. MTC Ecom Private Limited ');

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
(199, '0', 575000.00, 575000.00, 580000.00, '28', '2', 5000.00, '27.62.90.140', '2023-01-27 11:33:12'),
(200, '0', 550000.00, 550000.00, 555000.00, '29', '1', 5000.00, '210.18.133.176', '2023-01-27 11:34:59'),
(201, '0', 400000.00, 400000.00, 405000.00, '27', '3', 5000.00, '122.164.87.191', '2023-01-27 11:39:19'),
(205, '0', 100000.00, 100000.00, 105000.00, '37', '14', 5000.00, '210.18.133.176', '2023-02-24 12:08:57'),
(212, '1', 100000.00, 101000.00, 102000.00, '43', '18', 1000.00, '122.161.52.24', '2023-04-01 11:17:39'),
(213, '3', 100000.00, 104000.00, 103000.00, '43', '18', 1000.00, '122.161.52.24', '2023-04-01 11:17:59');

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
(27, '12676132', NULL, NULL, NULL, NULL, NULL, '987654321', 9965526473, '1', 'Mrs.Pushpalata Selvakumar', 'sskplk@gmail.com', 'Pushpalata@2023', 'active', NULL),
(28, '164417627', NULL, NULL, NULL, NULL, NULL, '897654321', 9965526473, '1', 'Mr.Saravanavel ', 'bala8577@yahoo.com', 'Saravanavel@2023', 'active', NULL),
(29, '292918986', NULL, NULL, NULL, NULL, NULL, '789654321', 9965526473, '1', 'M/S Guruvayurappan Traders', 'Guruvayurappan28@gmail.com', 'Guru@2023', 'active', NULL),
(37, '138332191', 'send', NULL, NULL, NULL, NULL, '1404234', 9540489727, '1', ' Arunachalam CH', 'arunanagu2018@gmail.com', 'CHARUN', 'active', NULL),
(38, '808784243', NULL, NULL, NULL, NULL, NULL, '123456789', 8130082112, '3', 'Kuldeep', 'kuldeep@gmail.com', '1234', 'active', NULL),
(40, NULL, NULL, NULL, NULL, NULL, NULL, '121212', 1234567890, '7', 'Sukhman', 'sukhmanp141@gmail.com', '123456', 'deactive', NULL),
(41, NULL, 'send', NULL, NULL, NULL, NULL, '123123', 1111111111, '7', 'Akash', 'developer@jigsaw.edu.in', '123456', 'active', NULL),
(42, NULL, NULL, NULL, NULL, NULL, NULL, '12341234', 1212121212, '3', 'Sukhman', 'sukhmanp141@gmail.com', '12345', 'active', NULL),
(43, '635673429', NULL, NULL, NULL, NULL, NULL, '1234567', 1212121212, '3', 'MUSKAN', 'Muskan@gmail.com', '1234', 'active', NULL),
(44, NULL, 'send', NULL, NULL, NULL, NULL, '2153691273', 9874758748, '9', 'Arvind', 'arvindrawat5595@gmail.com', '11346', 'active', NULL),
(45, NULL, NULL, NULL, NULL, NULL, NULL, '4181269027', 8747857459, '9', 'Yash', 'sharmayash1290@gmail.com', '11842', 'active', NULL),
(46, NULL, NULL, NULL, NULL, NULL, NULL, '8042232451', 8748574512, '9', 'Vikas', 'syash2616@gmail.com', '42619', 'active', NULL),
(47, NULL, NULL, NULL, NULL, NULL, NULL, '1231118443', 7418524125, '9', 'Vishal', 'kvishal737@gmail.com', '58747', 'active', NULL),
(48, NULL, NULL, NULL, NULL, NULL, NULL, '4839085426', 7584120369, '9', 'Sahani', 'sahanigroup@gmail.com', '99894', 'active', NULL),
(49, NULL, NULL, NULL, NULL, NULL, NULL, '1087068750', 8745120369, '9', 'Chetan', 'chetansharma.cs51@gmail.com', '28258', 'active', NULL),
(50, NULL, NULL, NULL, NULL, NULL, NULL, '7429592849', 8501478503, '9', 'Sukhman', 'sukhmanp141@gmail.com', '63685', 'active', NULL),
(51, NULL, NULL, NULL, NULL, NULL, NULL, '855465489556', 7701931111, '9', 'Akash', 'aakashvip27@gmail.com', '1234', 'deactive', NULL),
(52, NULL, NULL, NULL, '5332', NULL, NULL, 'ANCPM0180E', 8080080143, NULL, NULL, 'malikenterprises0143@gmail.com', NULL, 'deactive', NULL),
(53, NULL, NULL, NULL, '5628', NULL, NULL, 'ANCPM0180E', 8080080143, NULL, NULL, 'malikenterprises0143@gmail.com', NULL, 'deactive', NULL);

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
(8, 'Uttarakhand'),
(9, 'Tamil Nadu'),
(10, 'Andhra Pradesh'),
(11, 'Chhattisgarh'),
(12, 'Bihar'),
(13, 'Gujarat'),
(14, 'Karnataka'),
(15, ' Assam'),
(16, 'Maharashtra'),
(17, 'Madhya Pradesh'),
(18, 'Himachal Pradesh'),
(19, 'Odisha'),
(20, 'Uttar Pradesh'),
(21, 'Mizoram'),
(22, 'Rajasthan'),
(23, ' Goa'),
(24, ' Haryana'),
(25, 'West Bengal'),
(26, 'Tripura'),
(27, 'Punjab'),
(28, 'Arunachal Pradesh'),
(29, 'Kerala'),
(30, 'Manipur'),
(31, ' Sikkim'),
(32, 'Nagaland'),
(34, 'Meghalaya'),
(35, 'Jharkhand'),
(36, 'Telangana'),
(37, 'Jammu & Kashmir');

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

--
-- Dumping data for table `sub_liquidator`
--

INSERT INTO `sub_liquidator` (`id`, `name`, `email`, `mobile`, `password`, `add_by_liquidator`) VALUES
(4, 'indu kushwah', 'natashakuswah1998rs@gmail.com', 1212121212, 'adimn', '1'),
(5, 'Sukhman', 'saurabh@jigsaw.edu.in', 1234567890, 'werty', '1'),
(6, 'Rakesh', 'Rakesh@gmail.com', 1111111111, '12345', '3'),
(7, 'Sukhman', 'sukhman@gmal.com', 1212121212, '12345', '3');

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
(3, 'Vehicle'),
(5, 'Machinery '),
(7, 'Asset'),
(8, 'Agricultural or Forestry'),
(9, 'Land/Building'),
(10, 'Mining'),
(11, 'Miscellaneous'),
(12, 'Others'),
(13, 'Scrap/Disposables'),
(14, 'Shipping/ Transportation/ Vehicle'),
(15, 'Timber'),
(17, 'Inventory');

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
-- Indexes for table `assign_display_company_liquidator`
--
ALTER TABLE `assign_display_company_liquidator`
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
-- Indexes for table `display_company`
--
ALTER TABLE `display_company`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `assign_display_company_liquidator`
--
ALTER TABLE `assign_display_company_liquidator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assign_liquidator`
--
ALTER TABLE `assign_liquidator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `create_sale`
--
ALTER TABLE `create_sale`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cron_test`
--
ALTER TABLE `cron_test`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `display_company`
--
ALTER TABLE `display_company`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newbidder_login`
--
ALTER TABLE `newbidder_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `otp_consent`
--
ALTER TABLE `otp_consent`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sub_liquidator`
--
ALTER TABLE `sub_liquidator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `type_of_property`
--
ALTER TABLE `type_of_property`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
