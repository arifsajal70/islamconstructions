-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2018 at 12:07 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `islam`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `accounttype` enum('Add Balance','Expense') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `siteID`, `amount`, `accounttype`) VALUES
(26, 2, '10000.00', 'Add Balance'),
(27, 2, '5000.00', 'Expense');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ID` int(11) NOT NULL,
  `name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `join_date` date NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `photo` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `usertype` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `name`, `email`, `phone`, `address`, `join_date`, `salary`, `photo`, `document`, `username`, `password`, `status`, `usertype`) VALUES
(2, 'Ariful Islam Sajal', 'upsajal@gmail.com', '01908088966', '', '2017-12-29', '3000.00', '<p>You did not select a file to upload.</p>', '<p>You did not select a file to upload.</p>', 'sajal', '9970afa4e37e566253b99c9921891cc7afce83fb98174adb8e870ffa3b06ec112e57f77f62f2106a6958b598a6768a6634418ddf0c6d4b716646dabfcc0b3a42', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `ID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `title` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `join_date` date NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `photo` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `usertype` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`ID`, `siteID`, `name`, `email`, `phone`, `address`, `join_date`, `salary`, `photo`, `document`, `usertype`) VALUES
(1, 2, 'Ariful Isam Sajal', 'sajalarifulislam@gmail.com', '01908088966', 'House #08 Road #03 Block-A Bochila Garden City, Bochila , Mohammadpur , Dhaka - 1207', '0000-00-00', '0.00', '<p>You did not select a file to upload.</p>', '<p>You did not select a file to upload.</p>', 'Gateman');

-- --------------------------------------------------------

--
-- Table structure for table `engineers`
--

CREATE TABLE `engineers` (
  `ID` int(11) NOT NULL,
  `name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `join_date` date NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `photo` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `usertype` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'engineer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `engineers`
--

INSERT INTO `engineers` (`ID`, `name`, `email`, `phone`, `address`, `join_date`, `salary`, `photo`, `document`, `username`, `password`, `status`, `usertype`) VALUES
(26, 'Engineer', 'engineer@gmail.com', '01954465596', 'Some address', '2017-12-24', '50000.00', '<p>You did not select a file to upload.</p>', '<p>You did not select a file to upload.</p>', 'engineer', 'd69ac0c0034009a8ea72e56b730895948cbc60c25d41712bc1ab644863ea316ace95c428ef7f1df1f09c923c400bcfcfb97fef9dd0de1625303f5b3ab57f8867', 1, 'engineer'),
(27, 'Ariful Islam Sajal', 'upsajal@gmail.com', '01954465596', 'Some Address', '2017-12-26', '20000.00', '<p>You did not select a file to upload.</p>', '<p>You did not select a file to upload.</p>', 'sajal', '9970afa4e37e566253b99c9921891cc7afce83fb98174adb8e870ffa3b06ec112e57f77f62f2106a6958b598a6768a6634418ddf0c6d4b716646dabfcc0b3a42', 1, 'engineer'),
(28, 'Ariful Islam Sajal', 'sajalarifulislam@gmail.com', '01954465596', 'Somewhere In The World', '2017-12-29', '10000.00', '<p>You did not select a file to upload.</p>', '<p>You did not select a file to upload.</p>', 'sajal', '9970afa4e37e566253b99c9921891cc7afce83fb98174adb8e870ffa3b06ec112e57f77f62f2106a6958b598a6768a6634418ddf0c6d4b716646dabfcc0b3a42', 1, 'engineer');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ID` int(11) NOT NULL,
  `name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `name`, `unit`, `price`) VALUES
(1, 'Brick', 'Pcs', '8.00'),
(2, 'Stone Chips', 'CFT', '178.00'),
(3, 'Broken bricks', 'CFT', '60.00');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `ID` int(11) NOT NULL,
  `name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `join_date` date NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `photo` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `usertype` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'meneger'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`ID`, `name`, `email`, `phone`, `address`, `join_date`, `salary`, `photo`, `document`, `username`, `password`, `status`, `usertype`) VALUES
(1, 'Ariful Isam Sajal', 'sajalarifulislam@gmail.com', '01908088966', '', '2018-01-05', '3000.00', '<p>You did not select a file to upload.</p>', '<p>You did not select a file to upload.</p>', 'sdsd', '9970afa4e37e566253b99c9921891cc7afce83fb98174adb8e870ffa3b06ec112e57f77f62f2106a6958b598a6768a6634418ddf0c6d4b716646dabfcc0b3a42', 0, 'meneger');

-- --------------------------------------------------------

--
-- Table structure for table `sitedocuments`
--

CREATE TABLE `sitedocuments` (
  `ID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `title` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `ID` int(11) NOT NULL,
  `name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `engineerID` int(11) NOT NULL,
  `sitetype` enum('Construction','Supply') COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`ID`, `name`, `address`, `engineerID`, `sitetype`, `photo`, `created`) VALUES
(2, 'Some Construction Site', 'This is some address and you know better than me so i dont need to explain it more .', 26, 'Construction', '<p>You did not select a file to upload.</p>', '2017-12-25'),
(3, 'Constructions Site 2', 'Somewhere In the world', 27, 'Construction', '<p>You did not select a file to upload.</p>', '2017-12-25'),
(4, 'Supply Site', 'Somewhere In the world', 27, 'Supply', '<p>You did not select a file to upload.</p>', '2017-12-26'),
(5, 'Ariful Isam Sajal', 'sdad', 26, 'Construction', '<p>You did not select a file to upload.</p>', '2018-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `ID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `date` date NOT NULL,
  `stocktype` enum('Add','Drop') COLLATE utf8_unicode_ci NOT NULL,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`ID`, `siteID`, `date`, `stocktype`, `itemID`, `quantity`) VALUES
(33, 5, '2018-01-02', 'Add', 3, 200);

-- --------------------------------------------------------

--
-- Table structure for table `stocktotal`
--

CREATE TABLE `stocktotal` (
  `ID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stocktotal`
--

INSERT INTO `stocktotal` (`ID`, `itemID`, `siteID`, `quantity`) VALUES
(11, 1, 2, 0),
(12, 2, 2, 0),
(13, 3, 2, 0),
(14, 1, 3, 0),
(15, 2, 3, 0),
(16, 3, 5, 200);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `ID` int(11) NOT NULL,
  `name` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `usertype` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'supplier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `ID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `transactiontype` enum('Add Balance','Expense') COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`ID`, `siteID`, `amount`, `date`, `transactiontype`, `note`) VALUES
(63, 2, '2000.00', '2018-01-08', 'Add Balance', 'vhjvhvhjvh'),
(64, 2, '6000.00', '2018-01-08', 'Add Balance', 'gyghcghcghch'),
(65, 2, '2000.00', '2018-01-08', 'Add Balance', 'hjvhjvhjvvjhjh'),
(66, 2, '5000.00', '2018-01-08', 'Expense', 'jkbbjkbjk');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `ID` int(11) NOT NULL,
  `usertype` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`ID`, `usertype`) VALUES
(1, 'Labour'),
(2, 'Gateman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `engineers`
--
ALTER TABLE `engineers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sitedocuments`
--
ALTER TABLE `sitedocuments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stocktotal`
--
ALTER TABLE `stocktotal`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `engineers`
--
ALTER TABLE `engineers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sitedocuments`
--
ALTER TABLE `sitedocuments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `stocktotal`
--
ALTER TABLE `stocktotal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
