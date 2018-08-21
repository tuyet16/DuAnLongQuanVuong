-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2018 at 12:46 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duan`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance`
--

CREATE TABLE `advance` (
  `advanceID` bigint(20) NOT NULL,
  `money` varchar(255) DEFAULT NULL,
  `advanceName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advance`
--

INSERT INTO `advance` (`advanceID`, `money`, `advanceName`) VALUES
(2, '>= 2 TriÃªÌ£u', '16000'),
(3, '> 1 TriÃªÌ£u', '1');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `areasID` bigint(20) NOT NULL,
  `areasName` varchar(255) NOT NULL,
  `km` int(3) NOT NULL DEFAULT '0',
  `often` int(3) NOT NULL DEFAULT '0',
  `fast` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`areasID`, `areasName`, `km`, `often`, `fast`) VALUES
(1, 'KV1', 0, 15000, 20000),
(2, 'KV2', 6, 25000, 30000),
(3, 'KV3', 8, 30000, 35000),
(4, 'KV4', 10, 35000, 40000),
(5, 'KV5', 12, 40000, 50000),
(6, 'KV6', 18, 45000, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `billID` bigint(20) UNSIGNED NOT NULL,
  `customerID` bigint(20) NOT NULL,
  `billingAddress` varchar(255) NOT NULL,
  `PurchaseDate` date DEFAULT NULL,
  `setDate` date NOT NULL,
  `delivery` int(11) NOT NULL DEFAULT '0',
  `totalPrice` int(11) NOT NULL,
  `tinhtrang` tinyint(4) NOT NULL DEFAULT '1',
  `shopcheck` int(11) NOT NULL DEFAULT '0',
  `idEm` bigint(20) NOT NULL DEFAULT '0',
  `ghichu` varchar(255) NOT NULL,
  `phiship` int(11) NOT NULL,
  `luongnv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`billID`, `customerID`, `billingAddress`, `PurchaseDate`, `setDate`, `delivery`, `totalPrice`, `tinhtrang`, `shopcheck`, `idEm`, `ghichu`, `phiship`, `luongnv`) VALUES
(2, 12, 'MARITIME BANK TOWER, 192 NGUYá»„N CÃ”NG TRá»¨ 0 3', NULL, '2018-07-17', 0, 1881000, 2, 1, 8, '', 0, 0),
(3, 13, '934 Tá»ˆNH Lá»˜ 43 KP1 P.LINH CHIá»‚U  BiÌ€nh TÃ¢n QuÃ¢Ì£n ThuÌ‰ ÄÆ°Ìc', NULL, '2018-07-17', 0, 1187500, 1, 1, 8, '', 0, 0),
(4, 14, '155/20B CÃ” Báº®C P.CÃ” GIANG  PhÆ°á»ng BÃ¬nh Trá»‹ ÄÃ´ng A QuÃ¢Ì£n 1', NULL, '2018-07-17', 0, 120000, 1, 0, 0, '', 0, 0),
(5, 15, '335/7/6 NGUYá»„N THá»Š KIá»‚U P TÃ‚N THá»šI HIá»†P  PhÆ°á»ng BÃ¬nh Trá»‹ ÄÃ´ng A QuÃ¢Ì£n 12', NULL, '2018-07-17', 0, 970000, 1, 1, 0, '', 0, 0),
(7, 16, '123 xa lá»™ hÃ  ná»™i  QuÃ¢Ì£n ThuÌ‰ ÄÆ°Ìc', NULL, '2018-07-23', 0, 1598000, 2, 1, 8, 'khÃ´ng gáº·p Ä‘Æ°á»£c khÃ¡ch hÃ ng', 0, 0),
(8, 17, '123 linh chiá»ƒu  QuÃ¢Ì£n ThuÌ‰ ÄÆ°Ìc', NULL, '2018-08-01', 1, 550000, 2, 1, 8, '', 0, 0),
(9, 18, '130 linh chiá»ƒu  QuÃ¢Ì£n ThuÌ‰ ÄÆ°Ìc', NULL, '2018-08-02', 0, 610000, 2, 1, 8, '', 0, 0),
(10, 19, '546 xa lá»™ hÃ  ná»™i  QuÃ¢Ì£n BiÌ€nh ThaÌ£nh', NULL, '2018-08-02', 0, 120000, 2, 1, 9, '', 0, 0),
(11, 20, '569 xa lá»™ HÃ  Ná»™i  QuÃ¢Ì£n BiÌ€nh TÃ¢n', NULL, '2018-08-02', 0, 250000, 2, 1, 9, '', 0, 0),
(12, 21, '123 báº¿n lá»™i  QuÃ¢Ì£n BiÌ€nh TÃ¢n', NULL, '2018-08-03', 0, 250000, 2, 1, 9, '', 35000, 28000),
(13, 22, '85 Nguyá»…n CÆ° Trinh  QuÃ¢Ì£n 1', NULL, '2018-08-03', 0, 970000, 2, 1, 8, '', 30000, 24000),
(14, 23, '150 bÃ  hom  QuÃ¢Ì£n 6', NULL, '2018-08-03', 0, 900000, 2, 1, 8, '', 25000, 20000),
(15, 24, '345 Quang Trung quáº­n GÃ² Váº¥p', NULL, '2018-08-03', 0, 250000, 2, 1, 9, '', 30000, 24000),
(16, 26, '54 tÃ¢y lÃ¢n QuÃ¢Ì£n BiÌ€nh TÃ¢n', NULL, '2018-08-03', 0, 500000, 2, 1, 8, '', 35000, 28000),
(17, 27, 'Nguyá»…n TrÃ£i QuÃ¢Ì£n BiÌ€nh TÃ¢n', NULL, '2018-08-18', 0, 370000, 2, 1, 8, '', 35000, 28000),
(18, 28, 'Nguyá»…n TrÃ£i QuÃ¢Ì£n BiÌ€nh TÃ¢n', NULL, '2018-08-18', 0, 5300000, 2, 1, 8, '', 35000, 28000),
(19, 29, '2345 LÃª VÄƒn CÆ°Æ¡ng P HÃ²a Tháº¡nh QuÃ¢Ì£n 9', '2018-08-19', '2018-08-20', 0, 5120000, 2, 1, 8, '', 40000, 32000),
(20, 30, '30 Tráº§n XuÃ¢n Soáº¡n, PhÆ°á»ng 12 QuÃ¢Ì£n 7', '2018-08-20', '2018-08-20', 0, 810000, 1, 1, 9, '', 30000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` bigint(20) UNSIGNED NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(1, 'QuÃ¢Ì€n aÌo'),
(2, 'MyÌƒ PhÃ¢Ì‰m'),
(3, 'GiaÌ€y DeÌp'),
(5, 'Trang sÆ°Ìc');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` bigint(20) UNSIGNED NOT NULL,
  `customerName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `districtID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `customerName`, `address`, `phone`, `districtID`) VALUES
(2, 'q', '123 tay lan', '0987654321', 1),
(3, 'e', '33sfvds', '09876543', 1),
(4, 'e', '33sfvds', '09876543', 1),
(5, 'abc', '13fdg', '98765432222', 1),
(6, 'm', '32dvd', '09876543', 1),
(7, 'd', '21ef', '09876543', 1),
(8, 'a', '123 frg', '0986543', 1),
(9, 'b', '7tr', '098765432', 1),
(10, 'b', '324v', '098432', 1),
(11, 'c', '2sdf', '0965432', 1),
(12, 'CHá»Š BÃŒNH', 'MARITIME BANK TOWER, 192 NGUYá»„N CÃ”NG TRá»¨', '0913884888', 3),
(13, 'CHá»Š KHÃNH', '934 Tá»ˆNH Lá»˜ 43 KP1 P.LINH CHIá»‚U ', '0936966166', 14),
(14, 'HUá»²NH THá»Š NGá»ŒC DUNG', '155/20B CÃ” Báº®C P.CÃ” GIANG ', '09876543', 3),
(15, 'TU NGO', '335/7/6 NGUYá»„N THá»Š KIá»‚U P TÃ‚N THá»šI HIá»†P ', '0936224409', 13),
(16, 'Tráº§n thá»‹ thu hoÃ i', '123 xa lá»™ hÃ  ná»™i', '09876543', 14),
(17, 'Nguyá»…n VÄƒn DÆ°Æ¡ng', '123 linh chiá»ƒu', '0986443653', 14),
(18, 'Nguyá»…n HoÃ ng', '130 linh chiá»ƒu', '098342352', 14),
(19, 'Nguyá»…n Thá»‹ Há»“ng', '546 xa lá»™ hÃ  ná»™i', '09243645765', 15),
(20, 'Nguyá»…n VÄƒn Thanh', '569 xa lá»™ HÃ  Ná»™i', '01235475687', 1),
(21, 'Nguyá»…n VÄƒn KiÃªn', '123 báº¿n lá»™i', '01234544688', 1),
(22, 'nguyá»…n khÃ¡nh Linh', '85 Nguyá»…n CÆ° Trinh', '0987632423', 3),
(23, 'Tráº§n VÄƒn An', '150 bÃ  hom', '0987324255', 7),
(24, 'DÆ°Æ¡ng Gia Báº£o', '345 Quang Trung', '09876325', 24),
(25, 'VÄƒn ToÃ n', '34 báº¿n lá»™i', '0934363475', 1),
(26, 'HoÃ ng Linh', '54 tÃ¢y lÃ¢n', '096756456', 1),
(27, 'Viáº¿t TrÆ°á»ng', 'Nguyá»…n TrÃ£i', '12334432432', 1),
(28, 'Viáº¿t TrÆ°á»ng', 'Nguyá»…n TrÃ£i', '12334432432', 1),
(29, 'LÃª Minh', '2345 LÃª VÄƒn CÆ°Æ¡ng P HÃ²a Tháº¡nh', '102938475', 10),
(30, 'LÃª VÅ© TrÆ°á»ng', '30 Tráº§n XuÃ¢n Soáº¡n, PhÆ°á»ng 12', '0909123456', 8);

-- --------------------------------------------------------

--
-- Table structure for table `detailsbills`
--

CREATE TABLE `detailsbills` (
  `detailID` bigint(20) UNSIGNED NOT NULL,
  `productID` bigint(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `billID` bigint(20) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT '0',
  `shop_acceptance` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detailsbills`
--

INSERT INTO `detailsbills` (`detailID`, `productID`, `amount`, `price`, `billID`, `discount`, `shop_acceptance`) VALUES
(1, 1, 4, 456000, 2, 5, 0),
(2, 4, 6, 1425000, 2, 5, 0),
(3, 4, 5, 1187500, 3, 5, 0),
(4, 1, 1, 120000, 4, 0, 0),
(5, 1, 6, 720000, 5, 0, 0),
(6, 4, 1, 250000, 5, 0, 0),
(7, 4, 2, 500000, 6, 0, 0),
(8, 1, 1, 120000, 6, 0, 0),
(9, 1, 6, 648000, 7, 10, 0),
(10, 4, 4, 950000, 7, 5, 0),
(11, 4, 1, 250000, 8, 0, 0),
(12, 5, 1, 300000, 8, 0, 0),
(13, 1, 3, 360000, 9, 0, 0),
(14, 4, 1, 250000, 9, 0, 0),
(15, 1, 1, 120000, 10, 0, 0),
(16, 4, 1, 250000, 11, 0, 0),
(17, 4, 1, 250000, 12, 0, 0),
(18, 1, 6, 720000, 13, 0, 0),
(19, 4, 1, 250000, 13, 0, 0),
(20, 5, 1, 300000, 14, 0, 0),
(21, 1, 5, 600000, 14, 0, 0),
(22, 4, 1, 250000, 15, 0, 0),
(23, 4, 2, 500000, 16, 0, 0),
(24, 1, 1, 120000, 17, 0, 0),
(25, 4, 1, 250000, 17, 0, 0),
(26, 5, 1, 300000, 18, 0, 0),
(27, 6, 1, 5000000, 18, 0, 0),
(28, 1, 1, 120000, 19, 0, 1),
(29, 7, 5, 810000, 20, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `districtID` bigint(10) NOT NULL,
  `districtName` varchar(255) NOT NULL,
  `areasID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`districtID`, `districtName`, `areasID`) VALUES
(1, 'QuÃ¢Ì£n BiÌ€nh TÃ¢n', 4),
(2, 'QuÃ¢Ì£n TÃ¢n PhuÌ', 3),
(3, 'QuÃ¢Ì£n 1', 2),
(4, 'QuÃ¢Ì£n 2', 4),
(5, 'QuÃ¢Ì£n 3', 2),
(6, 'QuÃ¢Ì£n 4', 2),
(7, 'QuÃ¢Ì£n 6', 2),
(8, 'QuÃ¢Ì£n 7', 3),
(9, 'QuÃ¢Ì£n 8', 2),
(10, 'QuÃ¢Ì£n 9', 5),
(11, 'QuÃ¢Ì£n 10', 2),
(12, 'QuÃ¢Ì£n 11', 3),
(13, 'QuÃ¢Ì£n 12', 5),
(14, 'QuÃ¢Ì£n ThuÌ‰ ÄÆ°Ìc', 5),
(15, 'QuÃ¢Ì£n BiÌ€nh ThaÌ£nh', 3),
(16, 'PhÃº Nhuáº­n', 3),
(17, 'NhÃ  BÃ¨', 6),
(18, 'HÃ³c MÃ´n', 6),
(19, 'Cá»§ Chi', 5),
(20, 'Cáº§n Giá»', 2),
(21, 'BÃ¬nh ChÃ¡nh', 5),
(22, 'Quáº­n 5', 1),
(23, 'Quáº­n TÃ¢n BÃ¬nh', 3),
(24, 'quáº­n GÃ² Váº¥p', 4);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `idEm` bigint(11) NOT NULL,
  `employeeID` varchar(11) NOT NULL,
  `employeeName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `hinhanh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`idEm`, `employeeID`, `employeeName`, `address`, `phone`, `hinhanh`) VALUES
(8, 'NV2', 'Minh Tráº§n', 'PhuÌ nhuÃ¢Ì£n', '11111111111', ''),
(9, 'NV3', 'nguyá»…n Duy', '215 Äiá»‡n BiÃªn Phá»§', '09876543243', 'demen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` bigint(20) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `categoryID` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `unitID` bigint(20) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(300) NOT NULL,
  `description` text,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `categoryID`, `userid`, `unitID`, `price`, `image`, `description`, `created`) VALUES
(1, 'Ão thun', 1, 1, 2, 120000, 'demen.jpg', NULL, NULL),
(4, 'Set vÃ¡y cÃ´ng sá»Ÿ', 1, 1, 2, 250000, 'q1.jpg', NULL, NULL),
(5, 'Son li', 2, 3, 2, 300000, 'h1.jpg', NULL, NULL),
(6, 'Nháº«n Ä‘Ã´i', 5, 1, 2, 5000000, 'h2.jpg', NULL, NULL),
(7, 'GiÃ y tÃ¢y nam - XT07', 3, 2, 3, 180000, 'GsvWXY_simg_de2fe0_500x500_maxb.jpg', '<p>GIÃ€Y TÃ‚Y Báº®C NAM CHUYÃŠN CUNG Sá»ˆ VÃ€ Láºº&nbsp;</p><p>https://www.sendo.vn/shop/giaygiasi/giay-tay-nam-9552178.html</p><p>Size 38 Ä‘áº¿n 43&nbsp;</p><p>HÃ ng sáº£n xuáº¥t táº¡i viá»‡t nam FULLBOX, FULL SIZE ThÃ­ch há»£p Ä‘i lÃ m , Ä‘i chÆ¡i,tiÃªc, ....... há»™i tháº£o, Ä‘Ã¡m cÆ°á»›i Sáº£n pháº©m dc báº£o hÃ nh 3 thÃ¡ng bao Ä‘á»•i size trong 7 ngÃ y&nbsp;</p><p>ThÃ´ng tin liÃªn há»‡ 0868675446 hoáº·c 01664544446</p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `serviceID` bigint(20) UNSIGNED NOT NULL,
  `serviceName` varchar(255) NOT NULL,
  `minute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ships`
--

CREATE TABLE `ships` (
  `shipID` bigint(20) UNSIGNED NOT NULL,
  `districtID` bigint(20) NOT NULL,
  `serviceID` bigint(20) NOT NULL,
  `kmNum` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shopid` bigint(20) UNSIGNED NOT NULL,
  `shopname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `mashop` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shopid`, `shopname`, `address`, `phone`, `userid`, `mashop`) VALUES
(1, 'BÁCH HÓA Ý NGHĨA\r\n', 'ĐÀ LẠT - LÂM ĐỒNG\r\n', '0918360272', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `surcharge`
--

CREATE TABLE `surcharge` (
  `surchargeID` int(12) NOT NULL,
  `surchargeName` text NOT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surcharge`
--

INSERT INTO `surcharge` (`surchargeID`, `surchargeName`, `content`) VALUES
(0, 'Khá»‘i lÆ°á»£ng hÃ ng khÃ´ng vÆ°á»£t quÃ¡', '10kg(TrÃªn 10kg, phá»¥ thu 1k/kg)');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unitID` tinyint(1) NOT NULL,
  `unitName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unitID`, `unitName`) VALUES
(1, 'KG'),
(2, 'Cai'),
(3, 'DOI'),
(4, 'CHIEC');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT '1',
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `shopName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `password`, `role`, `fullname`, `email`, `address`, `phone`, `shopName`) VALUES
(1, 'abc', '1', 'HEOXINH SHOP', 'heoxinh@example.com', '80/14 LÃŠ Há»’NG PHONG P2, QUáº¬N 5', '0986232119', 'HEOXINH SHOP'),
(2, 'abc', '1', 'VÃ‚N ANH', 'vananh@example.com', '33 CHIÃŠU ANH CÃC, PHÆ¯á»œNG 05, QUáº¬N 05', '0914465160', 'VÃ‚N ANH'),
(3, 'abc', '1', 'abc', 'abc@example.com', 'abc', '0987654324', 'abc'),
(4, 'admin', '0', 'Chu Thanh', 'admin', 'quan 5', '09876543', 'Long Quan Vuong');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance`
--
ALTER TABLE `advance`
  ADD PRIMARY KEY (`advanceID`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`areasID`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`billID`),
  ADD UNIQUE KEY `billID` (`billID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`),
  ADD UNIQUE KEY `categoryid` (`categoryID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `customerID` (`customerID`);

--
-- Indexes for table `detailsbills`
--
ALTER TABLE `detailsbills`
  ADD PRIMARY KEY (`detailID`),
  ADD UNIQUE KEY `detailID` (`detailID`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`districtID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`idEm`),
  ADD UNIQUE KEY `employeeID` (`employeeID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productID` (`productID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`serviceID`),
  ADD UNIQUE KEY `serviceID` (`serviceID`);

--
-- Indexes for table `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`shipID`),
  ADD UNIQUE KEY `shipID` (`shipID`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shopid`),
  ADD UNIQUE KEY `shopid` (`shopid`);

--
-- Indexes for table `surcharge`
--
ALTER TABLE `surcharge`
  ADD PRIMARY KEY (`surchargeID`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unitID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance`
--
ALTER TABLE `advance`
  MODIFY `advanceID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `areasID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `billID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `detailsbills`
--
ALTER TABLE `detailsbills`
  MODIFY `detailID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `districtID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `idEm` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `serviceID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ships`
--
ALTER TABLE `ships`
  MODIFY `shipID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shopid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unitID` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
