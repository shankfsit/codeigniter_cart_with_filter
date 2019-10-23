-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2019 at 03:41 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `serial` int(11) NOT NULL,
  `name` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `price` float NOT NULL,
  `picture` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `gender` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `material_type` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`serial`, `name`, `description`, `price`, `picture`, `gender`, `material_type`) VALUES
(1, 'Simple Shirt', 'test', 699, 'images/m1.jpg', 'male', 'sythetics'),
(2, 'Kurti ', 'test', 396, 'images/s3.jpg', 'female', 'lycra'),
(3, 'Designer Shirt', 'test', 64, 'images/m2.jpg', 'male', 'cotton'),
(4, 'identity Mens Wear', 'test', 461, 'images/m3.jpg', 'male', 'silk'),
(5, 'Formal Shirt', 'test', 850, 'images/m4.jpg', 'male', 'cotton'),
(6, 'Formal Shirt', 'test', 41, 'images/m5.jpg', 'male', 'cotton'),
(11, 'Patiala Suit', 'testing', 800, 'images/s1.png', 'female', 'silk'),
(12, 'Ethinic Wear', 'fg', 650, 'images/s2.jpg', 'female', 'cotton');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`serial`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
