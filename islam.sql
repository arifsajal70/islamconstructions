-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2018 at 06:06 PM
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
  `filename` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `pass_reset_key` varchar(110) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `usertype` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `name`, `email`, `phone`, `address`, `join_date`, `salary`, `photo`, `filename`, `document`, `username`, `password`, `pass_reset_key`, `status`, `usertype`) VALUES
(6, 'Ariful Islam Sajal', 'sajalarifulislam@gmail.com', '01954465596', 'House #08 Road #03 Block-A Bochila Garden City, Bochila , Mohammadpur , Dhaka - 1207', '2018-01-14', '500.00', '1517149980KUyqJGB9SFoMnieIHpRf1517149980.png', 'IMG_20171005_164349.jpg', '1516557610ckZD3eGTpQnIVShjWYJK1516557610.jpg', 'admin', '9970afa4e37e566253b99c9921891cc7afce83fb98174adb8e870ffa3b06ec112e57f77f62f2106a6958b598a6768a6634418ddf0c6d4b716646dabfcc0b3a42', '', 1, 'Admin');

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

-- --------------------------------------------------------

--
-- Table structure for table `currentwork`
--

CREATE TABLE `currentwork` (
  `ID` int(11) NOT NULL,
  `siteID` int(11) DEFAULT NULL,
  `vehicle` enum('Truck','Ship') COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_status` enum('Not Arrived','Arrived','Unloading','Unloaded','Completed') COLLATE utf8_unicode_ci DEFAULT NULL,
  `vehicle_name` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vehicle_number` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `pass_reset_key` varchar(110) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `usertype` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Engineer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `pass_reset_key` varchar(110) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `usertype` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Manager'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `personal_balance`
--

CREATE TABLE `personal_balance` (
  `ID` int(11) NOT NULL,
  `title` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT NULL,
  `filename` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_expense`
--

CREATE TABLE `personal_expense` (
  `ID` int(11) NOT NULL,
  `title` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT NULL,
  `filename` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `supplierbills`
--

CREATE TABLE `supplierbills` (
  `ID` int(11) NOT NULL,
  `supplierID` int(11) DEFAULT NULL,
  `title` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `itemID` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `filename` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplierpayments`
--

CREATE TABLE `supplierpayments` (
  `ID` int(11) NOT NULL,
  `supplierID` int(11) DEFAULT NULL,
  `title` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `filename` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `filename` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
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
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(110) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indexes for table `currentwork`
--
ALTER TABLE `currentwork`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `currentwork_ID_uindex` (`ID`);

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
-- Indexes for table `personal_balance`
--
ALTER TABLE `personal_balance`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `personal_balance_ID_uindex` (`ID`);

--
-- Indexes for table `personal_expense`
--
ALTER TABLE `personal_expense`
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
-- Indexes for table `supplierbills`
--
ALTER TABLE `supplierbills`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `supplierbills_ID_uindex` (`ID`);

--
-- Indexes for table `supplierpayments`
--
ALTER TABLE `supplierpayments`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `supplierpayments_ID_uindex` (`ID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `currentwork`
--
ALTER TABLE `currentwork`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employeesalary`
--
ALTER TABLE `employeesalary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `engineers`
--
ALTER TABLE `engineers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `engineersalary`
--
ALTER TABLE `engineersalary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `managersalary`
--
ALTER TABLE `managersalary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personal_balance`
--
ALTER TABLE `personal_balance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personal_expense`
--
ALTER TABLE `personal_expense`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sitedocuments`
--
ALTER TABLE `sitedocuments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `siteemployees`
--
ALTER TABLE `siteemployees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sitemanagers`
--
ALTER TABLE `sitemanagers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplierbills`
--
ALTER TABLE `supplierbills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplierpayments`
--
ALTER TABLE `supplierpayments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
