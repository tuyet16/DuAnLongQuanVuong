-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2018 at 06:20 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `billID` bigint(20) UNSIGNED NOT NULL,
  `customerID` bigint(20) NOT NULL,
  `billingAddress` varchar(255) NOT NULL,
  `setDate` date NOT NULL,
  `delivery` varchar(255) NOT NULL DEFAULT '0',
  `totalPrice` int(11) NOT NULL,
  `tinhtrang` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`billID`, `customerID`, `billingAddress`, `setDate`, `delivery`, `totalPrice`, `tinhtrang`) VALUES
(1, 11, '2sdf', '2018-07-17', 'Giao thuong', 0, 1),
(2, 12, 'MARITIME BANK TOWER, 192 NGUYá»„N CÃ”NG TRá»¨ 0 3', '2018-07-17', 'Giao thÆ°á»ng', 1881000, 1),
(3, 13, '934 Tá»ˆNH Lá»˜ 43 KP1 P.LINH CHIá»‚U  BiÌ€nh TÃ¢n QuÃ¢Ì£n ThuÌ‰ ÄÆ°Ìc', '2018-07-17', 'Giao thÆ°á»ng', 1187500, 1),
(4, 14, '155/20B CÃ” Báº®C P.CÃ” GIANG  PhÆ°á»ng BÃ¬nh Trá»‹ ÄÃ´ng A QuÃ¢Ì£n 1', '2018-07-17', 'Giao thÆ°á»ng', 120000, 1),
(5, 15, '335/7/6 NGUYá»„N THá»Š KIá»‚U P TÃ‚N THá»šI HIá»†P  PhÆ°á»ng BÃ¬nh Trá»‹ ÄÃ´ng A QuÃ¢Ì£n 12', '2018-07-17', 'Giao thÆ°á»ng', 970000, 1),
(7, 16, '123 xa lá»™ hÃ  ná»™i  QuÃ¢Ì£n ThuÌ‰ ÄÆ°Ìc', '2018-07-23', 'Giao thÆ°á»ng', 1598000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`billID`),
  ADD UNIQUE KEY `billID` (`billID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `billID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
