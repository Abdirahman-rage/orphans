-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2019 at 10:48 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orphans`
--

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `status`) VALUES
(1, 'ijara', 'active'),
(2, 'kamkunji', 'active'),
(3, 'garissa', 'active'),
(4, 'ffss', 'inactive'),
(5, 'derwrwer', 'inactive'),
(6, 'dadaab', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `fullnames` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `fullnames`, `phone`, `email`, `status`) VALUES
(1, 'Mohamed abdirahman Hassan', '888888888', 'mo@gmail.com', 'inactive'),
(2, 'Mohamed abdirahman Hassan', '908987787878', 'moha@gmail.com', 'active'),
(3, 'Suleyman Ibrahim', '09887787878', 'suleyman@gmail.com', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `orphans`
--

CREATE TABLE `orphans` (
  `id` int(11) NOT NULL,
  `onum` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `age` int(2) NOT NULL,
  `bcertno` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `district` varchar(100) NOT NULL,
  `gname` varchar(100) NOT NULL,
  `gcontacts` varchar(30) NOT NULL,
  `bcert` longblob NOT NULL,
  `dcert` longblob NOT NULL,
  `natid` longblob NOT NULL,
  `photo` longblob NOT NULL,
  `representative` varchar(100) NOT NULL,
  `date_reg` varchar(100) NOT NULL,
  `donor` varchar(100) NOT NULL DEFAULT 'No donor'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orphans`
--

INSERT INTO `orphans` (`id`, `onum`, `firstname`, `middlename`, `lastname`, `dob`, `age`, `bcertno`, `address`, `district`, `gname`, `gcontacts`, `bcert`, `dcert`, `natid`, `photo`, `representative`, `date_reg`, `donor`) VALUES
(5, 1, 'hh', 'hh', 'hh', '2015-12-28', 3, '77', 'hh', 'garissa', 'jj', '77', 0x61686d656420736f6d206c616e6473636170652e706e67, 0x616264696b61646972322e6a7067, 0x612e706e67, 0x494d472d32303139303732322d5741303030352e6a7067, 'ahsa@gmail.com', '10-09-2019', 'No donor'),
(6, 2, 'moha', 'tytyty', 'ali', '2017-06-20', 2, '88', 'kk', 'ijara', 'sacdia abdullahi', '88', 0x612e706e67, 0x612e706e67, 0x612e706e67, 0x612e706e67, 'ahsa@gmail.com', '10-09-2019', '2'),
(7, 3, 'Hassan ', 'Aden', 'Ibrahim', '2014-02-05', 5, '6666yyy', 'sangailu', 'ijara', 'sacdia abdullahi', '075555665', 0x612e706e67, 0x612e706e67, 0x612e706e67, 0x612e706e67, 'yasmiin@gmail.com', '11-09-2019', '3');

-- --------------------------------------------------------

--
-- Table structure for table `stipends`
--

CREATE TABLE `stipends` (
  `id` int(11) NOT NULL,
  `onum` int(11) NOT NULL,
  `amount` int(100) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stipends`
--

INSERT INTO `stipends` (`id`, `onum`, `amount`, `date`) VALUES
(4, 2, 1000, '2019-10-01 16:12:52'),
(5, 1, 4000, '2019-08-11 00:47:36'),
(6, 2, 6000, '2019-07-11 01:24:37'),
(7, 1, 15000, '2019-10-01 16:13:48'),
(8, 2, 9000, '2019-07-11 02:01:20'),
(9, 3, 15000, '2019-09-11 02:18:43'),
(10, 3, 10000, '2019-10-01 00:00:00'),
(11, 2, 4000, '2019-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullnames` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `district` varchar(100) NOT NULL,
  `photo` longblob NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullnames`, `email`, `password`, `type`, `district`, `photo`, `status`) VALUES
(8, 'Yasiim Abdi', 'yasmiin@gmail.com', 'MTIz', 'Representative', '', 0x74727573742e6a7067, 'inactive'),
(9, 'Asha Abdullahi', 'ahsa@gmail.com', 'MTIz', 'Representative', '', 0x73732e6a7067, 'active'),
(12, 'aden', 'aden@gmail.com', 'MTIz', 'Admin', '', 0x494d472d32303139303732322d5741303030352e6a7067, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orphans`
--
ALTER TABLE `orphans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stipends`
--
ALTER TABLE `stipends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orphans`
--
ALTER TABLE `orphans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stipends`
--
ALTER TABLE `stipends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
