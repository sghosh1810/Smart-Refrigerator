-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2020 at 08:46 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `refrigerg`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `username` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`username`, `email`, `subject`, `message`) VALUES
('Shounak Ghosh', 'sghsoh1810@gmail.com', 'Test', 'Test'),
('Shounak Ghosh', 'sghosh1810@gmail.com', 'Crash Logs', 'Crash of menu?'),
('admin', 'sghosh1810@gmail.com', 'Change billing', 'Final test?');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `username` varchar(255) NOT NULL,
  `product` varchar(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `price` int(255) NOT NULL,
  `expiry` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`username`, `product`, `quantity`, `price`, `expiry`) VALUES
('admin', 'apple', 5, 1, '10-05-20'),
('admin', 'banana', 12, 1, '10-05-20'),
('admin', 'tomato', 5, 5, '10-05-20'),
('admin', 'cauliflower', 3, 8, '10-05-20'),
('admin', 'potato', 20, 1, '10-05-20'),
('admin', 'cucumber', 5, 3, '10-05-20'),
('aroy', 'apple', 5, 2, '12-07-2020'),
('aroy', 'pinapple', 1, 12, '12-07-2020');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `type`) VALUES
('admin', 'sghosh1810@gmail.com', '25e2525bdee9f68747707bbcb7b095dd', 'user'),
('aroy', 'aroy.uemk16@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
