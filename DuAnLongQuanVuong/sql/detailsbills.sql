-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2018 at 06:21 PM
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
-- Table structure for table `detailsbills`
--

CREATE TABLE `detailsbills` (
  `detailID` bigint(20) UNSIGNED NOT NULL,
  `productID` bigint(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `billID` bigint(20) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detailsbills`
--

INSERT INTO `detailsbills` (`detailID`, `productID`, `amount`, `price`, `billID`, `discount`) VALUES
(1, 1, 4, 456000, 2, 5),
(2, 4, 6, 1425000, 2, 5),
(3, 4, 5, 1187500, 3, 5),
(4, 1, 1, 120000, 4, 0),
(5, 1, 6, 720000, 5, 0),
(6, 4, 1, 250000, 5, 0),
(7, 4, 2, 500000, 6, 0),
(8, 1, 1, 120000, 6, 0),
(9, 1, 6, 648000, 7, 10),
(10, 4, 4, 950000, 7, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailsbills`
--
ALTER TABLE `detailsbills`
  ADD PRIMARY KEY (`detailID`),
  ADD UNIQUE KEY `detailID` (`detailID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailsbills`
--
ALTER TABLE `detailsbills`
  MODIFY `detailID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
