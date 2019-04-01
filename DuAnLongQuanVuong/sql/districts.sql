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
(1, 'QuÃ¢Ì£n BiÌ€nh TÃ¢n', 5),
(2, 'QuÃ¢Ì£n TÃ¢n PhuÌ', 0),
(3, 'QuÃ¢Ì£n 1', 7),
(4, 'QuÃ¢Ì£n 2', 8),
(5, 'QuÃ¢Ì£n 3', 0),
(6, 'QuÃ¢Ì£n 4', 0),
(7, 'QuÃ¢Ì£n 6', 0),
(8, 'QuÃ¢Ì£n 7', 0),
(9, 'QuÃ¢Ì£n 8', 0),
(10, 'QuÃ¢Ì£n 9', 0),
(11, 'QuÃ¢Ì£n 10', 0),
(12, 'QuÃ¢Ì£n 11', 0),
(13, 'QuÃ¢Ì£n 12', 0),
(14, 'QuÃ¢Ì£n ThuÌ‰ ÄÆ°Ìc', 0),
(15, 'QuÃ¢Ì£n BiÌ€nh ThaÌ£nh', 0),
(16, 'PhÃº Nhuáº­n', 2),
(17, 'NhÃ  BÃ¨', 2),
(18, 'HÃ³c MÃ´n', 2),
(19, 'Cá»§ Chi', 2),
(20, 'Cáº§n Giá»', 2),
(21, 'BÃ¬nh ChÃ¡nh', 2),
(22, 'Quáº­n 5', 2),
(23, 'Quáº­n TÃ¢n BÃ¬nh', 2),
(24, 'quáº­n GÃ² Váº¥p', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`districtID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `districtID` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
