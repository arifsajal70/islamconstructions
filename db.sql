-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2018 at 08:21 AM
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
  `usertype` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `name`, `email`, `phone`, `address`, `join_date`, `salary`, `photo`, `document`, `username`, `password`, `status`, `usertype`) VALUES
(6, 'Ariful Isam Sajal', 'sajalarifulislam@gmail.com', '01954465596', 'House #08 Road #03 Block-A Bochila Garden City, Bochila , Mohammadpur , Dhaka - 1207', '2018-01-14', '500.00', '<p>You did not select a file to upload.</p>', '<p>You did not select a file to upload.</p>', 'admin', '99c228b7f960f0a452ef133dc72a164c63f8204e377698fdfa68f50978dd962046434c1fb373450b7f780bbfa160afbf69ebbd84165c772c1083634d90d4eae9', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `ID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `title` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `filename` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`ID`, `siteID`, `title`, `date`, `itemID`, `quantity`, `rate`, `amount`, `filename`, `document`) VALUES
(2, 7, 'Web Application For Mobile', '2018-01-17', 5, 500, '10.00', '5000.00', '', '<p>You did not select a file to upload.</p>'),
(3, 8, 'Web Application For Mobile', '2018-01-19', 6, 2000, '8.00', '16000.00', '103455746-GettyImages-512791400.600x400.jpg', '1516389135tizX17F5WCQ9OyT8hIHB1516389135.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID` int(11) NOT NULL,
  `name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `join_date` date NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `photo` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `usertype` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`ID`, `name`, `email`, `phone`, `address`, `join_date`, `salary`, `photo`, `filename`, `document`, `status`, `usertype`) VALUES
(7, 'Ariful Isam Sajal', 'upsajal@gmail.com', '01908088966', 'House #08 Road #03 Block-A Bochila Garden City, Bochila , Mohammadpur , Dhaka - 1207', '2018-01-17', '3000.00', '<p>You did not select a file to upload.</p>', '64487_utouch_v132.zip', '1516200612KCqQsN9cyWagP76hvHk01516200612.zip', 0, 'Labor');

-- --------------------------------------------------------

--
-- Table structure for table `employeesalary`
--

CREATE TABLE `employeesalary` (
  `ID` int(11) NOT NULL,
  `employeeID` int(11) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `paid` int(11) DEFAULT '0',
  `date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `filename` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `usertype` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Engineer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `engineers`
--

INSERT INTO `engineers` (`ID`, `name`, `email`, `phone`, `address`, `join_date`, `salary`, `photo`, `filename`, `document`, `username`, `password`, `status`, `usertype`) VALUES
(33, 'Gary E. Guzman', 'GaryEGuzman@jourrapide.com', '1163167739', 'Rua Herculano de Freitas, 758\r\nSão Paulo-SP', '2018-01-14', '50000.00', '1516200292tf6M7Qn2mu9Hor5yhqWF1516200292.jpg', '64487_utouch_v132.zip', '1516186033A8N1PML4USfTzOdil2uh1516186033.zip', 'Gary', '2dc5d9f0a8178984bad4064baddeafeaaf79a3e36e3e04cfac2bc7aeb74972e4bc747b94da69b75f4c1d64002f07a6e2788fe3624044c87416ed460801cd83ce', 1, 'Engineer');

-- --------------------------------------------------------

--
-- Table structure for table `engineersalary`
--

CREATE TABLE `engineersalary` (
  `ID` int(11) NOT NULL,
  `engineerID` int(11) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `paid` int(11) NOT NULL,
  `date` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `engineersalary`
--

INSERT INTO `engineersalary` (`ID`, `engineerID`, `salary`, `paid`, `date`) VALUES
(9, 33, '50000.00', 0, '2018-01');

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
(4, 'Stone Chips', 'CFT', '180.00'),
(5, 'Brick', 'PCS', '8.00'),
(6, 'Broken Bricks', 'CFT', '6.00');

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
  `filename` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `usertype` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Manager'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`ID`, `name`, `email`, `phone`, `address`, `join_date`, `salary`, `photo`, `filename`, `document`, `username`, `password`, `status`, `usertype`) VALUES
(7, 'Ariful Isam Sajal', 'sajal@asynweb.com', '01908088966', 'House #08 Road #03 Block-A Bochila Garden City, Bochila , Mohammadpur , Dhaka - 1207', '2018-01-19', '50000.00', '<p>You did not select a file to upload.</p>', 'No FIle Selected', '<p>You did not select a file to upload.</p>', 'sajal', '9970afa4e37e566253b99c9921891cc7afce83fb98174adb8e870ffa3b06ec112e57f77f62f2106a6958b598a6768a6634418ddf0c6d4b716646dabfcc0b3a42', 1, 'Site Manager');

-- --------------------------------------------------------

--
-- Table structure for table `managersalary`
--

CREATE TABLE `managersalary` (
  `ID` int(11) NOT NULL,
  `managerID` int(11) DEFAULT NULL,
  `salary` decimal(10,0) DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  `date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `title` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `filename` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`ID`, `siteID`, `title`, `date`, `amount`, `filename`, `document`) VALUES
(2, 7, 'Web Application For Mobile', '2018-01-17', '2500.00', '', '<p>You did not select a file to upload.</p>');

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
-- Table structure for table `siteemployees`
--

CREATE TABLE `siteemployees` (
  `ID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `work_started` date NOT NULL,
  `status` enum('Active','Fired') COLLATE utf8_unicode_ci NOT NULL,
  `fire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `siteemployees`
--

INSERT INTO `siteemployees` (`ID`, `siteID`, `employeeID`, `work_started`, `status`, `fire_date`) VALUES
(3, 9, 7, '2018-01-20', 'Active', '0000-00-00'),
(4, 6, 7, '2018-01-20', 'Active', '0000-00-00'),
(5, 10, 7, '2018-01-20', 'Active', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `sitemanagers`
--

CREATE TABLE `sitemanagers` (
  `ID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `managerID` int(11) NOT NULL,
  `added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sitemanagers`
--

INSERT INTO `sitemanagers` (`ID`, `siteID`, `managerID`, `added`) VALUES
(1, 8, 7, '2018-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `ID` int(11) NOT NULL,
  `name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `engineerID` int(11) DEFAULT NULL,
  `sitetype` enum('Construction','Supply') COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`ID`, `name`, `address`, `engineerID`, `sitetype`, `photo`, `created`, `status`) VALUES
(8, 'Jamuna Park', 'No Address Available', NULL, 'Supply', '<p>You did not select a file to upload.</p>', '2018-01-18', 1),
(11, 'Ariful Isam Sajal', 'sdsadsad', 33, 'Construction', '<p>You did not select a file to upload.</p>', '2018-01-20', 1);

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
  `quantity` int(11) NOT NULL,
  `filename` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`ID`, `siteID`, `date`, `stocktype`, `itemID`, `quantity`, `filename`, `document`) VALUES
(28, 6, '2018-01-20', 'Add', 5, 200, 'No File Selected', 'NO File Selected');

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

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`ID`, `name`, `email`, `phone`, `address`, `photo`, `document`, `usertype`) VALUES
(1, 'Ariful Isam Sajal', 'AprilRBurt@dayrep.com', '01908088966', 'House #08 Road #03 Block-A Bochila Garden City, Bochila , Mohammadpur , Dhaka - 1207', '', '', 'supplier');

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
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`ID`, `siteID`, `amount`, `date`, `transactiontype`, `note`, `filename`, `document`) VALUES
(93, 9, '2000.00', '2018-01-20', 'Add Balance', 'Nothing', 'No File Selected', 'No File Selected');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `ID` int(11) NOT NULL,
  `usertype` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(220) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`ID`, `usertype`, `note`) VALUES
(3, 'Gate Man', 'Something About Gateman'),
(4, 'Watch Man', 'Something About Watch Man'),
(5, 'Labor', 'Noting');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `employeesalary`
--
ALTER TABLE `employeesalary`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `employeesalary_ID_uindex` (`ID`);

--
-- Indexes for table `engineers`
--
ALTER TABLE `engineers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `engineersalary`
--
ALTER TABLE `engineersalary`
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
-- Indexes for table `managersalary`
--
ALTER TABLE `managersalary`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `managersalary_ID_uindex` (`ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sitedocuments`
--
ALTER TABLE `sitedocuments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `siteemployees`
--
ALTER TABLE `siteemployees`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sitemanagers`
--
ALTER TABLE `sitemanagers`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `employeesalary`
--
ALTER TABLE `employeesalary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `engineers`
--
ALTER TABLE `engineers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `engineersalary`
--
ALTER TABLE `engineersalary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `managersalary`
--
ALTER TABLE `managersalary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sitedocuments`
--
ALTER TABLE `sitedocuments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `siteemployees`
--
ALTER TABLE `siteemployees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sitemanagers`
--
ALTER TABLE `sitemanagers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
