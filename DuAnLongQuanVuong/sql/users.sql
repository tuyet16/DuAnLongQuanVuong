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
(1, 'abc', '1', 'HEOXINH SHOP', 'heoxinh@example.com', '80/14 LÃŠ Há»’NG PHONG P2, QUáº¬N 5', '09786888888', 'HEOXINH SHOP'),
(2, 'abc', '1', 'VÃ‚N ANH', 'vananh@example.com', '33 CHIÃŠU ANH CÃC, PHÆ¯á»œNG 05, QUáº¬N 05', '0914465160', 'VÃ‚N ANH'),
(3, 'abc', '1', 'abc', 'abc@example.com', 'abc', '0987654324', 'abc'),
(4, 'admin', '0', 'Chu Thanh', 'admin', 'quan 5', '09876543', 'Long Quan Vuong'),
(5, '12345', '1', 'NguyÃªÌƒn Minh', 'minhex@gmail.com', 'ssssssssssssssss', '0963426589', 'Minh NguyÃªÌƒn'),
(10, '12345', '1', 'aaaa', 'ac@gmail.com', 'aaaaaa', '01846573859', 'Min min'),
(11, 'minmin123', '1', 'a', 'ac@gmail.com', 'a', '0124443344', 'min  min'),
(12, '11111111', '1', 's', 'c@example.com', 'c', '01269326654', 'c');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
