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
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` bigint(20) UNSIGNED NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `districtID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `customerName`, `address`, `phone`, `districtID`) VALUES
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
(16, 'Tráº§n thá»‹ thu hoÃ i', '123 xa lá»™ hÃ  ná»™i', '09876543', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `customerID` (`customerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
