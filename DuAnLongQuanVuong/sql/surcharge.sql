-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2018 at 06:23 PM
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
(1, 'Khá»‘i lÆ°á»£ng hÃ ng khÃ´ng vÆ°á»£t quÃ¡', '10kg(TrÃªn 10kg, phá»¥ thu 1k/kg)'),
(3, 'KÃ­ch thÆ°á»›c hÃ ng hÃ³a', '50cm x 50cm x 50cm'),
(4, 'GiÃ¡ trÃªn chÆ°a bao gá»“m', 'PhÃ­ gá»­i chÃ nh, gá»­i xe, phÃ­ giao táº­n tay cho khÃ¡ch hÃ ng táº¡i cao á»‘c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surcharge`
--
ALTER TABLE `surcharge`
  ADD PRIMARY KEY (`surchargeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `surcharge`
--
ALTER TABLE `surcharge`
  MODIFY `surchargeID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
