-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2012 at 03:40 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nanma`
--

-- --------------------------------------------------------

--
-- Table structure for table `closingbal`
--

CREATE TABLE IF NOT EXISTS `closingbal` (
  `r1000n` int(11) NOT NULL,
  `r500n` int(11) NOT NULL,
  `r100n` int(11) NOT NULL,
  `r50n` int(11) NOT NULL,
  `r20n` int(11) NOT NULL,
  `r10n` int(11) NOT NULL,
  `r5n` int(11) NOT NULL,
  `r2n` int(11) NOT NULL,
  `r1n` int(11) NOT NULL,
  `r50p` int(11) NOT NULL,
  `r25p` int(11) NOT NULL,
  `total` float(20,9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closingbal`
--

INSERT INTO `closingbal` (`r1000n`, `r500n`, `r100n`, `r50n`, `r20n`, `r10n`, `r5n`, `r2n`, `r1n`, `r50p`, `r25p`, `total`, `date`) VALUES
(30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 30000.000000000, '2012-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT,
  `rc_num` int(20) NOT NULL,
  `rc_owner` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `card_type` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`card_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`card_id`, `rc_num`, `rc_owner`, `card_type`, `address`) VALUES
(1, 1234567890, 'Arun Sekhar', 'APL', 'Address,Neyyattinkara.P.O, TVM'),
(2, 1234567891, '01Sys', 'APL', 'Worldwide'),
(3, 1234567892, 'Biju', 'BPL', 'Biju Address'),
(4, 1234567893, 'TalentDepot Consulting', 'APL', 'WorldWide'),
(5, 123214, 'Arun', 'APL', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `festival_quota`
--

CREATE TABLE IF NOT EXISTS `festival_quota` (
  `pdt_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quota_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `apl_quota` float(20,2) DEFAULT NULL,
  `bpl_quota` float(20,2) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `festival_quota`
--

INSERT INTO `festival_quota` (`pdt_id`, `pdt_name`, `quota_unit`, `apl_quota`, `bpl_quota`, `created_date`, `q_id`) VALUES
('KURUVA_RICE_18', 'Kuruva Rice 18rs', 'Kg', 7.00, 12.00, '2012-09-20 04:05:43', 3);

-- --------------------------------------------------------

--
-- Table structure for table `festival_quota_purchase_history`
--

CREATE TABLE IF NOT EXISTS `festival_quota_purchase_history` (
  `q_p_h_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdt_id` varchar(20) NOT NULL,
  `bill_num` int(11) NOT NULL,
  `rc_num` int(11) NOT NULL,
  `week_num` int(11) NOT NULL,
  `purchased_quantity` float(10,9) NOT NULL,
  `purchased_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pdt_unit` varchar(10) NOT NULL,
  PRIMARY KEY (`q_p_h_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `festival_quota_purchase_history`
--

INSERT INTO `festival_quota_purchase_history` (`q_p_h_id`, `pdt_id`, `bill_num`, `rc_num`, `week_num`, `purchased_quantity`, `purchased_date`, `pdt_unit`) VALUES
(1, 'KURUVA_RICE_18', 2, 1234567890, 201238, 5.000000000, '2012-09-20 05:57:26', 'Kg');

-- --------------------------------------------------------

--
-- Table structure for table `normal_quota`
--

CREATE TABLE IF NOT EXISTS `normal_quota` (
  `pdt_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quota_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `apl_quota` float(20,2) DEFAULT NULL,
  `bpl_quota` float(20,2) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `normal_quota`
--

INSERT INTO `normal_quota` (`pdt_id`, `pdt_name`, `quota_unit`, `apl_quota`, `bpl_quota`, `created_date`, `q_id`) VALUES
('KURUVA_RICE_18', 'Kuruva Rice 18rs', 'Kg', 3.00, 8.00, '2012-09-20 04:09:00', 2),
('DADA', 'dada', 'Kg', 1.00, NULL, '2012-11-19 07:47:03', 3),
('ASDSADA', 'adada', 'Kg', NULL, NULL, '2012-11-19 08:02:56', 4),
('IRIS', 'Iris', 'Kg', 5.00, NULL, '2012-11-19 08:39:11', 5),
('UNDAPPORI', 'UNDAPPORI', 'Kg', 5.00, NULL, '2012-11-19 08:44:24', 6),
('UNDAPPORI', 'UNDAPPORI', 'Kg', 5.00, NULL, '2012-11-19 08:51:33', 7),
('UNDAPPORI', 'UNDAPPORI', 'Kg', 5.00, NULL, '2012-11-19 08:57:44', 8),
('UNDAPPORI', 'UNDAPPORI', 'Kg', 5.00, NULL, '2012-11-19 09:03:20', 9);

-- --------------------------------------------------------

--
-- Table structure for table `openingbal`
--

CREATE TABLE IF NOT EXISTS `openingbal` (
  `r1000n` int(11) NOT NULL,
  `r500n` int(11) NOT NULL,
  `r100n` int(11) NOT NULL,
  `r50n` int(11) NOT NULL,
  `r20n` int(11) NOT NULL,
  `r10n` int(11) NOT NULL,
  `r5n` int(11) NOT NULL,
  `r2n` int(11) NOT NULL,
  `r1n` int(11) NOT NULL,
  `r50p` int(11) NOT NULL,
  `r25p` int(11) NOT NULL,
  `total` float(20,9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `openingbal`
--

INSERT INTO `openingbal` (`r1000n`, `r500n`, `r100n`, `r50n`, `r20n`, `r10n`, `r5n`, `r2n`, `r1n`, `r50p`, `r25p`, `total`, `date`) VALUES
(5, 5, 5, 7, 4, 5, 8, 0, 0, 1, 0, 8520.500000000, '2012-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pdt_idx` int(11) NOT NULL AUTO_INCREMENT,
  `pdt_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_name_ml` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_sell_price` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quality` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_sell_price_unit` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hs_unit` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `ls_unit` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_quota_limited` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `is_festival_quota_limited` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`pdt_idx`),
  UNIQUE KEY `pdt_id` (`pdt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=62 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pdt_idx`, `pdt_id`, `pdt_name`, `pdt_name_ml`, `pdt_description`, `pdt_sell_price`, `quality`, `pdt_sell_price_unit`, `hs_unit`, `ls_unit`, `pdt_date`, `is_quota_limited`, `is_festival_quota_limited`) VALUES
(1, 'JAYA_RICE_15', 'Jaya Rice 15rs', 'Jaya Rice 15rs', 'Jaya Rice 15rs', '15.00', '', 'Kg', 'Kg', '', '2012-09-20 04:02:05', 'N', 'N'),
(2, 'KURUVA_RICE_18', 'Kuruva Rice 18rs', 'Kuruva Rice 18rs', 'Kuruva Rice 18rs', '18.00', 'Second Quality', 'Kg', 'Kg', '', '2012-09-20 04:03:14', 'Y', 'Y'),
(6, 'COLGATE_150', 'Colgate 150g', 'Colgate 150g', 'Colgate 150g', '44.50', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-09-20 04:27:53', 'N', 'N'),
(32, 'TEST_PRODUCT', 'Test Product 1', 'Test Product 1', 'Test Product', '25.00', 'First Quality', 'Kg', 'Kg', 'Gram', '2012-11-13 05:11:23', 'N', 'N'),
(34, 'DADA', 'dada', 'adad', 'asdada', '213.00', 'First Quality', 'Kg', 'Kg', 'Gram', '2012-11-19 07:47:03', 'Y', 'N'),
(35, 'ASDSADA', 'adada', 'adada', 'adada', '0.00', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-19 08:02:56', 'Y', 'N'),
(39, 'MLNLNLK', 'lklm', 'klnkkj', 'kjkbkbn', '76.00', 'First Quality', 'Kg', 'Kg', 'Gram', '2012-11-19 08:11:46', 'N', 'N'),
(40, 'IRIS', 'Iris', 'Iris', 'Iris', '23.00', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-19 08:39:11', 'Y', 'N'),
(48, 'UNDAPPORI', 'UNDAPPORI', 'UNDAPPORI', 'UNDAPPORI', '22.00', 'First Quality', 'Kg', 'Kg', 'Gram', '2012-11-19 09:03:20', 'Y', 'N'),
(54, 'ELLUNDA', 'ELLUNDA', 'ELLUNDA', 'ELLUNDA', '25.00', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-20 07:40:29', 'Y', 'N'),
(58, 'PDT_SELL_PRICE_UNIT', 'pdt_sell_price_unit', 'pdt_sell_price_unit', 'pdt_sell_price_unit', '25', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-20 08:02:48', 'Y', 'N'),
(59, 'EEEE', 'eeee', 'eeee', 'eeee', '27', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-20 13:56:36', 'Y', 'N'),
(60, 'TTTT', 'TTTT', 'TTTT', 'TTTT', '27', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-20 13:57:42', 'Y', 'N'),
(61, 'GGGGGGG', 'GGGGGGG', 'GGGGGGG', 'GGGGGGG', '27', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-20 13:58:38', 'Y', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_product`
--

CREATE TABLE IF NOT EXISTS `purchase_product` (
  `pdt_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_idx` int(11) NOT NULL AUTO_INCREMENT,
  `pdt_name_ml` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_purchase_price` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quality` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_purchase_price_unit` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hs_unit` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `ls_unit` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_quota_limited` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pdt_idx`),
  UNIQUE KEY `pdt_id` (`pdt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- Dumping data for table `purchase_product`
--

INSERT INTO `purchase_product` (`pdt_id`, `pdt_idx`, `pdt_name_ml`, `pdt_description`, `pdt_purchase_price`, `quality`, `pdt_purchase_price_unit`, `hs_unit`, `ls_unit`, `pdt_date`, `is_quota_limited`, `pdt_name`) VALUES
('JAYA_RICE_15', 1, 'Jaya Rice 15rs', 'Jaya Rice 15rs', '14.50', '', 'Kg', 'Kg', '', '2012-09-20 04:02:05', 'N', 'Jaya Rice 15rs'),
('KURUVA_RICE_18', 2, 'Kuruva Rice 18rs', 'Kuruva Rice 18rs', '17.00', 'Second Quality', 'Kg', 'Kg', '', '2012-09-20 04:03:14', 'N', 'Kuruva Rice 18rs'),
('COLGATE_150', 6, 'Colgate 150g', 'Colgate 150g', '43.50', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-09-20 04:27:53', 'N', 'Colgate 150g'),
('TEST_PRODUCT', 27, 'Test Product 1', 'Test Product', '24.00', 'First Quality', 'Kg', 'Kg', 'Gram', '2012-11-13 05:11:23', 'N', 'Test Product 1'),
('DADA', 29, 'adad', 'asdada', '122.00', 'First Quality', 'Kg', 'Kg', 'Gram', '2012-11-19 07:47:03', 'Y', 'dada'),
('ASDSADA', 30, 'adada', 'adada', '0.00', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-19 08:02:56', 'Y', 'adada'),
('MLNLNLK', 32, 'klnkkj', 'kjkbkbn', '69.00', 'First Quality', 'Kg', 'Kg', 'Gram', '2012-11-19 08:11:46', 'N', 'lklm'),
('IRIS', 33, 'Iris', 'Iris', '21.00', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-19 08:39:11', 'Y', 'Iris'),
('UNDAPPORI', 37, 'UNDAPPORI', 'UNDAPPORI', '21.00', 'First Quality', 'Kg', 'Kg', 'Gram', '2012-11-19 09:03:20', 'Y', 'UNDAPPORI'),
('PDT_SELL_PRICE_UNIT', 39, 'pdt_sell_price_unit', 'pdt_sell_price_unit', '23', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-20 08:02:48', 'Y', 'pdt_sell_price_unit'),
('EEEE', 40, 'eeee', 'eeee', '25', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-20 13:56:36', 'Y', 'eeee'),
('TTTT', 41, 'TTTT', 'TTTT', '25', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-20 13:57:42', 'Y', 'TTTT'),
('GGGGGGG', 42, 'GGGGGGG', 'GGGGGGG', '25', 'First Quality', 'Kg', 'Kg', 'Kg', '2012-11-20 13:58:38', 'Y', 'GGGGGGG');

-- --------------------------------------------------------

--
-- Table structure for table `quota_mode`
--

CREATE TABLE IF NOT EXISTS `quota_mode` (
  `quota_mode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `quota_mode_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`quota_mode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `quota_mode`
--

INSERT INTO `quota_mode` (`quota_mode`, `quota_mode_id`) VALUES
('normal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quota_purchase_history`
--

CREATE TABLE IF NOT EXISTS `quota_purchase_history` (
  `q_p_h_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdt_id` varchar(20) NOT NULL,
  `bill_num` int(11) NOT NULL,
  `rc_num` int(11) NOT NULL,
  `week_num` int(11) NOT NULL,
  `purchased_quantity` float(20,9) NOT NULL,
  `purchased_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pdt_unit` varchar(10) NOT NULL,
  PRIMARY KEY (`q_p_h_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `quota_purchase_history`
--

INSERT INTO `quota_purchase_history` (`q_p_h_id`, `pdt_id`, `bill_num`, `rc_num`, `week_num`, `purchased_quantity`, `purchased_date`, `pdt_unit`) VALUES
(1, 'KURUVA_RICE_18', 1, 1234567890, 201238, 2.000000000, '2012-09-20 04:48:16', 'Kg'),
(3, 'KURUVA_RICE_18', 3, 1234567890, 201238, 1.000000000, '2012-09-20 07:43:35', 'Kg');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_num` int(11) NOT NULL,
  `pdt_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_des` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rc_num` int(11) NOT NULL,
  `sub_total` float(20,9) NOT NULL,
  `pdt_quantity` float(20,9) NOT NULL,
  `price_per_h` float(20,9) NOT NULL,
  `price_per_unit_h` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bill_date` date NOT NULL,
  `pdt_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `bill_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_completed` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`s_id`, `bill_num`, `pdt_id`, `pdt_des`, `rc_num`, `sub_total`, `pdt_quantity`, `price_per_h`, `price_per_unit_h`, `bill_date`, `pdt_unit`, `bill_time`, `is_completed`) VALUES
(1, 1, 'KURUVA_RICE_18', 'Kuruva Rice 18rs', 1234567890, 36.000000000, 2.000000000, 18.000000000, 'Kg', '2012-09-20', 'Kg', '2012-09-20 04:48:16', 'Y'),
(3, 2, 'KURUVA_RICE_18', 'Kuruva Rice 18rs', 1234567890, 90.000000000, 5.000000000, 18.000000000, 'Kg', '2012-09-20', 'Kg', '2012-09-20 05:57:26', 'Y'),
(4, 3, 'KURUVA_RICE_18', 'Kuruva Rice 18rs', 1234567890, 18.000000000, 1.000000000, 18.000000000, 'Kg', '2012-09-20', 'Kg', '2012-09-20 07:43:35', 'Y'),
(5, 4, 'TEST', 'Test Product', 1234567890, 20.000000000, 2.000000000, 10.000000000, 'Kg', '2012-09-20', 'Kg', '2012-09-20 07:45:12', 'Y'),
(6, 5, 'JAYA_RICE_15', 'Jaya Rice 15rs', 1234567893, 15.000000000, 1.000000000, 15.000000000, 'Kg', '2012-11-07', 'Kg', '2012-11-07 14:40:51', 'Y'),
(7, 6, 'JAYA_RICE_15', 'Jaya Rice 15rs', 1234567890, 15.000000000, 1.000000000, 15.000000000, 'Kg', '2012-11-08', 'Kg', '2012-11-08 07:50:45', 'Y'),
(8, 7, 'JAYA_RICE_15', 'Jaya Rice 15rs', 1234567890, 15.000000000, 1.000000000, 15.000000000, 'Kg', '2012-11-08', 'Kg', '2012-11-08 07:53:39', 'Y'),
(9, 8, 'TEST_ITEM', 'Test Product', 1234567890, 70.500000000, 3.000000000, 23.500000000, 'Kg', '2012-11-13', 'Kg', '2012-11-13 05:17:35', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `sales_temp`
--

CREATE TABLE IF NOT EXISTS `sales_temp` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_num` int(11) NOT NULL,
  `pdt_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pdt_des` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rc_num` int(11) NOT NULL,
  `sub_total` float(20,9) NOT NULL,
  `pdt_quantity` float(20,9) NOT NULL,
  `price_per_h` float(20,9) NOT NULL,
  `price_per_unit_h` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bill_date` date NOT NULL,
  `pdt_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `bill_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_completed` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `pdt_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `available_stock` float(20,9) DEFAULT NULL,
  `stock_unit` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `s_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pdt_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pdt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`pdt_id`, `available_stock`, `stock_unit`, `s_date`, `pdt_name`) VALUES
('ASDSADA', 0.000000000, 'Kg', '2012-11-19 08:02:56', 'adada'),
('COLGATE_150', 75.000000000, 'Pieces', '2012-09-20 04:42:23', 'Colgate 150g'),
('DADA', 0.000000000, 'Kg', '2012-11-19 07:47:03', 'dada'),
('EEEE', 0.000000000, 'Kg', '2012-11-20 13:56:36', 'eeee'),
('GGGGGGG', 0.000000000, 'Kg', '2012-11-20 13:58:38', 'GGGGGGG'),
('IRIS', 0.000000000, 'Kg', '2012-11-19 08:39:11', 'Iris'),
('JAYA_RICE_15', 98.000000000, 'Kg', '2012-11-08 15:21:24', 'Jaya Rice 15rs'),
('KURUVA_RICE_18', 0.000000000, 'Kg', '2012-11-08 13:47:43', 'Kuruva Rice 18rs'),
('MLNLNLK', 0.000000000, 'Kg', '2012-11-19 08:11:46', 'lklm'),
('PDT_SELL_PRICE_UNIT', 0.000000000, 'Kg', '2012-11-20 08:02:48', 'pdt_sell_price_unit'),
('TEST', 102.000000000, 'Kg', '2012-11-13 05:19:15', 'Test Product'),
('TEST_PRODUCT', 0.000000000, 'Kg', '2012-11-13 05:11:42', 'Test Product 1'),
('TTTT', 0.000000000, 'Kg', '2012-11-20 13:57:42', 'TTTT'),
('UNDAPPORI', 0.000000000, 'Kg', '2012-11-19 09:03:20', 'UNDAPPORI');

-- --------------------------------------------------------

--
-- Table structure for table `stock_load_audit`
--

CREATE TABLE IF NOT EXISTS `stock_load_audit` (
  `spa_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdt_id` varchar(20) NOT NULL,
  `stock_load_unit` varchar(10) NOT NULL,
  `purchase_bill_no` bigint(20) NOT NULL,
  `stock_load_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pdt_description` varchar(100) NOT NULL,
  `current_unit_price` float(10,2) NOT NULL,
  `pdt_quality` varchar(20) NOT NULL,
  `highest_unit` varchar(10) NOT NULL,
  `stock_before_load` float(20,9) NOT NULL,
  `stock_after_load` float(20,9) NOT NULL,
  `pdt_price_unit` varchar(10) NOT NULL,
  `stock_load_qty` float(20,9) NOT NULL,
  `is_completed` varchar(1) NOT NULL DEFAULT 'N',
  `sub_total` float(20,9) NOT NULL,
  PRIMARY KEY (`spa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `stock_load_audit`
--

INSERT INTO `stock_load_audit` (`spa_id`, `pdt_id`, `stock_load_unit`, `purchase_bill_no`, `stock_load_date`, `pdt_description`, `current_unit_price`, `pdt_quality`, `highest_unit`, `stock_before_load`, `stock_after_load`, `pdt_price_unit`, `stock_load_qty`, `is_completed`, `sub_total`) VALUES
(1, 'KURUVA_RICE_18', 'Kg', 1, '2012-09-20 04:25:37', 'Kuruva Rice 18rs', 17.00, 'Second Quality', 'Kg', 0.000000000, 50.000000000, 'Kg', 50.000000000, 'Y', 850.000000000),
(2, 'JAYA_RICE_15', 'Kg', 1, '2012-09-20 04:25:46', 'Jaya Rice 15rs', 14.50, '', 'Kg', 0.000000000, 75.000000000, 'Kg', 75.000000000, 'Y', 1087.500000000),
(3, 'KURUVA_RICE_18', 'Kg', 1, '2012-09-20 04:25:56', 'Kuruva Rice 18rs', 17.00, 'Second Quality', 'Kg', 50.000000000, 70.000000000, 'Kg', 20.000000000, 'Y', 340.000000000),
(4, 'JAYA_RICE_15', 'Kg', 1, '2012-09-20 04:26:07', 'Jaya Rice 15rs', 14.50, '', 'Kg', 75.000000000, 100.000000000, 'Kg', 25.000000000, 'Y', 362.500000000),
(5, 'COLGATE_150', 'Pieces', 2, '2012-09-20 04:27:53', 'Colgate 150g', 44.00, '', 'Pieces', 0.000000000, 50.000000000, 'Pieces', 50.000000000, 'Y', 2200.000000000),
(6, 'COLGATE_150', 'Pieces', 1, '2012-09-20 04:29:12', 'Colgate 150g', 44.00, '', 'Pieces', 50.000000000, 70.000000000, 'Pieces', 20.000000000, 'Y', 880.000000000),
(7, 'COLGATE_150', 'Pieces', 3, '2012-09-20 04:42:23', 'Colgate 150g', 44.00, '', 'Pieces', 0.000000000, 75.000000000, 'Pieces', 75.000000000, 'Y', 3300.000000000),
(20, 'TEST', 'Kg', 4, '2012-09-20 07:14:14', 'Test Product', 9.50, '', 'Kg', 0.000000000, 40.000000000, 'Kg', 40.000000000, 'Y', 380.000000000),
(21, 'TEST', 'Kg', 5, '2012-09-20 07:14:20', 'Test Product', 9.50, '', 'Kg', 40.000000000, 50.000000000, 'Kg', 10.000000000, 'Y', 95.000000000),
(23, 'TEST', 'Kg', 6, '2012-09-20 07:46:28', 'Test Product', 9.50, '', 'Kg', 48.000000000, 60.000000000, 'Kg', 12.000000000, 'Y', 114.000000000),
(24, 'TEST', 'Kg', 7, '2012-09-20 08:42:09', 'Test Product', 9.50, '', 'Kg', 60.000000000, 70.000000000, 'Kg', 10.000000000, 'Y', 95.000000000),
(25, 'TEST', 'Kg', 8, '2012-09-20 08:43:06', 'Test Product', 9.50, '', 'Kg', 70.000000000, 80.000000000, 'Kg', 10.000000000, 'Y', 95.000000000),
(26, 'KURUVA_RICE_18', 'Kg', 9, '2012-09-20 08:43:26', 'Kuruva Rice 18rs', 17.00, 'Second Quality', 'Kg', 62.000000000, 80.000000000, 'Kg', 18.000000000, 'Y', 306.000000000),
(27, 'JAYA_RICE_15', 'Kg', 10, '2012-11-07 14:40:06', 'Jaya Rice 15rs', 14.50, '', 'Kg', 100.000000000, 101.000000000, 'Kg', 1.000000000, 'Y', 14.500000000),
(43, '2', 'Kg', 11, '2012-11-07 19:14:14', 'test', 4.00, 'First Quality', 'Kg', 0.000000000, 5.000000000, 'Kg', 5.000000000, 'Y', 20.000000000),
(44, '3', 'Kg', 11, '2012-11-07 19:15:45', 'test_2', 4.00, 'First Quality', 'Kg', 0.000000000, 5.000000000, 'Kg', 5.000000000, 'Y', 20.000000000),
(48, 'TEST_ITEM', 'Kg', 12, '2012-11-13 05:14:16', 'Test Product', 25.75, 'First Quality', 'Kg', 0.000000000, 150.000000000, 'Kg', 150.000000000, 'Y', 3862.500000000),
(49, 'TEST_ITEM', 'Kg', 13, '2012-11-13 05:15:53', 'Test Product', 25.75, 'First Quality', 'Kg', 0.000000000, 50.000000000, 'Kg', 50.000000000, 'Y', 1287.500000000),
(50, 'TEST_ITEM', 'Kg', 14, '2012-11-13 05:19:04', 'Test Product', 25.75, 'First Quality', 'Kg', 47.000000000, 97.000000000, 'Kg', 50.000000000, 'Y', 1287.500000000),
(51, 'TEST', 'Kg', 15, '2012-11-13 05:19:15', 'Test Product', 9.50, '', 'Kg', 80.000000000, 102.000000000, 'Kg', 22.000000000, 'Y', 209.000000000);

-- --------------------------------------------------------

--
-- Table structure for table `stock_load_audit_temp`
--

CREATE TABLE IF NOT EXISTS `stock_load_audit_temp` (
  `spa_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdt_id` varchar(20) NOT NULL,
  `stock_load_unit` varchar(10) NOT NULL,
  `purchase_bill_no` bigint(20) NOT NULL,
  `stock_load_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pdt_description` varchar(100) NOT NULL,
  `current_unit_price` float(10,2) NOT NULL,
  `pdt_quality` varchar(20) NOT NULL,
  `highest_unit` varchar(10) NOT NULL,
  `stock_before_load` float(20,9) NOT NULL,
  `stock_after_load` float(20,9) NOT NULL,
  `pdt_price_unit` varchar(10) NOT NULL,
  `stock_load_qty` float(20,9) NOT NULL,
  `is_completed` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`spa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_load_txn`
--

CREATE TABLE IF NOT EXISTS `stock_load_txn` (
  `txn_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_bill_no` bigint(20) NOT NULL,
  `pdt_id` varchar(20) NOT NULL,
  `pdt_description` varchar(100) NOT NULL,
  `stock_before_load` float(20,9) NOT NULL,
  `stock_load_qty` float(20,9) NOT NULL,
  `stock_after_load` float(20,9) NOT NULL,
  `is_new_pdt` varchar(1) NOT NULL DEFAULT 'N',
  `txn_time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`txn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `stock_load_txn`
--

INSERT INTO `stock_load_txn` (`txn_id`, `purchase_bill_no`, `pdt_id`, `pdt_description`, `stock_before_load`, `stock_load_qty`, `stock_after_load`, `is_new_pdt`, `txn_time_stamp`) VALUES
(4, 11, '2', 'test', 0.000000000, 5.000000000, 0.000000000, 'Y', '2012-11-07 18:50:48'),
(5, 11, 'JAYA_RICE_15', 'Jaya Rice 15rs', 100.000000000, 2.500000000, 102.500000000, 'N', '2012-11-07 18:51:44'),
(6, 11, '2', 'test', 0.000000000, 5.000000000, 5.000000000, 'Y', '2012-11-07 18:53:14'),
(7, 11, '3', 'test3', 0.000000000, 5.000000000, 5.000000000, 'Y', '2012-11-07 18:57:42'),
(8, 11, '2', 'test', 0.000000000, 5.000000000, 0.000000000, 'Y', '2012-11-07 19:01:04'),
(9, 0, '0', '0', 0.000000000, 0.000000000, 0.000000000, 'N', '2012-11-07 19:03:14'),
(10, 0, '0', '0', 0.000000000, 0.000000000, 0.000000000, 'N', '2012-11-07 19:05:22'),
(11, 11, '2', 'test', 0.000000000, 5.000000000, 5.000000000, 'N', '2012-11-07 19:06:18'),
(12, 11, '2', 'test', 0.000000000, 5.000000000, 0.000000000, 'Y', '2012-11-07 19:10:04'),
(13, 11, '2', 'test', 0.000000000, 5.000000000, 5.000000000, 'N', '2012-11-07 19:14:14'),
(14, 11, '3', 'test_2', 0.000000000, 5.000000000, 5.000000000, 'Y', '2012-11-07 19:15:45'),
(15, 12, '4', 'test_4', 0.000000000, 5.000000000, 5.000000000, 'Y', '2012-11-07 19:32:32'),
(16, 13, 'JAYA_RICE_15', 'Jaya Rice 15rs', 98.000000000, 1.000000000, 99.000000000, 'N', '2012-11-08 13:42:38'),
(17, 13, 'JAYA_RICE_15', 'Jaya Rice 15rs', 99.000000000, 2.000000000, 101.000000000, 'N', '2012-11-08 13:44:05'),
(18, 12, 'KURUVA_RICE_18', 'Kuruva Rice 18rs', 0.000000000, 4.000000000, 4.000000000, 'N', '2012-11-08 13:46:34'),
(19, 12, 'KURUVA_RICE_18', 'Kuruva Rice 18rs', 0.000000000, 5.000000000, 5.000000000, 'N', '2012-11-08 13:47:43'),
(20, 12, '343', '343', 0.000000000, 25.000000000, 25.000000000, 'Y', '2012-11-08 14:46:07'),
(21, 12, 'JAYA_RICE_15', 'Jaya Rice 15rs', 98.000000000, 2.000000000, 100.000000000, 'N', '2012-11-08 14:46:54'),
(22, 12, '3332', '3332', 0.000000000, 23.000000000, 23.000000000, 'Y', '2012-11-08 14:48:54'),
(23, 12, 'JAYA_RICE_15\\', 'Jaya Rice 15rs', 100.000000000, 2.000000000, 102.000000000, 'N', '2012-11-08 14:49:08'),
(24, 12, 'JAYA_RICE_15', 'Jaya Rice 15rs', 100.000000000, 2.000000000, 102.000000000, 'N', '2012-11-08 14:49:23'),
(25, 12, 'JAYA_RICE_15', 'Jaya Rice 15rs', 98.000000000, 2.000000000, 100.000000000, 'N', '2012-11-08 15:03:55'),
(26, 12, 'JAYA_RICE_15', 'Jaya Rice 15rs', 100.000000000, 1.000000000, 101.000000000, 'N', '2012-11-08 15:04:10'),
(27, 12, 'JAYA_RICE_15', 'Jaya Rice 15rs', 101.000000000, 2.000000000, 103.000000000, 'N', '2012-11-08 15:04:46'),
(28, 12, 'JAYA_RICE_152', 'Jaya Rice 15rs', 103.000000000, 2.000000000, 105.000000000, 'N', '2012-11-08 15:05:18'),
(29, 12, 'JAYA_RICE_15', 'Jaya Rice 15rs', 98.000000000, 2.000000000, 100.000000000, 'N', '2012-11-08 15:08:17'),
(30, 12, 'JAYA_RICE_15', 'Jaya Rice 15rs', 98.000000000, 2.000000000, 100.000000000, 'N', '2012-11-08 15:15:42'),
(31, 12, 'JAYA_RICE_15', 'Jaya Rice 15rs', 98.000000000, 2.000000000, 100.000000000, 'N', '2012-11-08 15:20:38'),
(32, 12, '1231', '1231', 0.000000000, 10.000000000, 10.000000000, 'Y', '2012-11-08 15:21:03'),
(33, 12, 'JAYA_RICE_15', 'Jaya Rice 15rs', 98.000000000, 2.000000000, 100.000000000, 'N', '2012-11-08 15:21:24'),
(34, 12, 'TEST_PRODUCT', 'Test Product', 0.000000000, 100.000000000, 100.000000000, 'N', '2012-11-13 05:11:42'),
(35, 12, 'TEST_ITEM', 'Test Product', 0.000000000, 500.000000000, 500.000000000, 'Y', '2012-11-13 05:12:34'),
(36, 12, 'TEST_ITEM', 'Test Product', 0.000000000, 50.000000000, 50.000000000, 'N', '2012-11-13 05:13:25'),
(37, 12, 'TEST_ITEM', 'Test Product', 0.000000000, 150.000000000, 150.000000000, 'N', '2012-11-13 05:14:16'),
(38, 13, 'TEST_ITEM', 'Test Product', 0.000000000, 50.000000000, 50.000000000, 'N', '2012-11-13 05:15:53'),
(39, 14, 'TEST_ITEM', 'Test Product', 47.000000000, 50.000000000, 97.000000000, 'N', '2012-11-13 05:19:04'),
(40, 15, 'TEST', 'Test Product', 80.000000000, 22.000000000, 102.000000000, 'N', '2012-11-13 05:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(1) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `password`, `role`) VALUES
(1, 'admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'A'),
(2, '01sys', '889a3a791b3875cfae413574b53da4bb8a90d53e', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `users_new`
--

CREATE TABLE IF NOT EXISTS `users_new` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hashed_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'O' COMMENT 'student -S, admin -A,Teacher-T,Others-O',
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_loggedin` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(19) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `index_users_on_username` (`username`(10))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users_new`
--

INSERT INTO `users_new` (`idx`, `username`, `hashed_password`, `user_type`, `full_name`, `email`, `last_loggedin`, `last_login_ip`, `created_at`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'A', 'Administrator', 'admin@nanma.com', '2012-11-22 05:44:13', '127.0.0.1', '2012-08-30 10:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `week_range`
--

CREATE TABLE IF NOT EXISTS `week_range` (
  `week_num` int(10) NOT NULL,
  `start_ts` timestamp NOT NULL DEFAULT '2012-09-02 18:30:00' ON UPDATE CURRENT_TIMESTAMP,
  `end_ts` timestamp NOT NULL DEFAULT '2012-09-09 18:29:59',
  PRIMARY KEY (`week_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `week_range`
--

INSERT INTO `week_range` (`week_num`, `start_ts`, `end_ts`) VALUES
(201236, '2012-09-02 18:30:00', '2012-09-09 18:29:59'),
(201237, '2012-09-09 18:30:00', '2012-09-16 18:29:59'),
(201238, '2012-09-16 18:30:00', '2012-09-23 18:29:59');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
