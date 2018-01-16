-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2018 at 09:55 AM
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
(28, 6, '10000.00', 'Add Balance'),
(29, 6, '0.00', 'Expense');

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
(2, 'Bill N. Hensen', 'BillNHensen@dayrep.com', '720-475-9533', '1117 Clay Lick Road\r\nAurora, CO 80014', '2018-01-16', '10000.00', '15159576186pwAPxIF37jqr410WTu81515957618.jpg', 'No File Selected', '<p>You did not select a file to upload.</p>', 0, 'Gate Man'),
(3, 'Victor P. Duff', 'VictorPDuff@armyspy.com', '731-512-4403', '52 Melville Street\r\nJackson, TN 38301', '2018-01-16', '10000.00', '1515957671fdE1xulQzsp6tiwID8UV1515957671.jpg', 'No File Selected', '<p>You did not select a file to upload.</p>', 0, 'Gate Man'),
(4, 'Helen H. Phillips', 'HelenHPhillips@dayrep.com', '740-357-4428', '4100 Robinson Lane\r\nPortsmouth, OH 45662', '2018-01-16', '10000.00', '1516092241kHmFINrscGSKthw4J3An1516092241.jpg', 'No File Selected', '<p>You did not select a file to upload.</p>', 0, 'Watch Man'),
(5, 'April R. Burt', 'AprilRBurt@dayrep.com', '785-227-5897', '1026 Nicholas Street\r\nLindsborg, KS 67456', '2018-01-16', '10000.00', '15159577868WXDGzywhrP640oBlqRs1515957786.jpg', 'js_composer-NULLED.zip', '1516092113bJSXMZWqcrnhtA36ixlD1516092113.zip', 0, 'Gate Man');

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
(33, 'Gary E. Guzman', 'GaryEGuzman@jourrapide.com', '1163167739', 'Rua Herculano de Freitas, 758\r\nSão Paulo-SP', '2018-01-14', '50000.00', '1515938116fVGhbnEiNmcp97Kz5Wj21515938116.jpg', 'Gary E. Guzman.zip', '15159381166HPdbgqRsNW9BxYf1rmE1515938116.zip', 'Gary', '2dc5d9f0a8178984bad4064baddeafeaaf79a3e36e3e04cfac2bc7aeb74972e4bc747b94da69b75f4c1d64002f07a6e2788fe3624044c87416ed460801cd83ce', 1, 'Engineer'),
(34, 'Jacqueline R. Hunter', 'JacquelineRHunter@armyspy.com', '660-885-5591', '1607 Harvest Lane\r\nClinton, MO 64735', '2018-01-14', '50000.00', '1515938515YmIpJgjKfyx78H4NDlh91515938515.jpg', 'Jacqueline R. Hunter.zip', '15159385002q6dEcmKwx1J5oWD4pMy1515938500.zip', 'Jacqueline', '2dc5d9f0a8178984bad4064baddeafeaaf79a3e36e3e04cfac2bc7aeb74972e4bc747b94da69b75f4c1d64002f07a6e2788fe3624044c87416ed460801cd83ce', 1, 'Engineer'),
(35, 'Pedro R. Tee', 'PedroRTee@jourrapide.com', '305-576-3780', '669 Poplar Lane\r\nMiami, FL 33127', '2018-01-14', '50000.00', '15159389807jfaTxt0peL1SisZyMKh1515938980.jpg', 'Pedro R. Tee.zip', '1515938980CHpPwmlb9fkJryu67eF31515938980.zip', 'Pedro', '2dc5d9f0a8178984bad4064baddeafeaaf79a3e36e3e04cfac2bc7aeb74972e4bc747b94da69b75f4c1d64002f07a6e2788fe3624044c87416ed460801cd83ce', 1, 'Engineer'),
(36, 'Patrick D. Henderson', 'PatrickDHenderson@dayrep.com', '812-659-9434', '3650 Heliport Loop\r\nLyons, IN 47443', '2018-01-14', '50000.00', '1515942686nLgW61R8vjYak7uU4dcx1515942686.jpg', 'Patrick D. Henderson.zip', '15159426860Nct6SIiTBjsaFrd3pWf1515942686.zip', 'Patrick', '2dc5d9f0a8178984bad4064baddeafeaaf79a3e36e3e04cfac2bc7aeb74972e4bc747b94da69b75f4c1d64002f07a6e2788fe3624044c87416ed460801cd83ce', 1, 'Engineer'),
(37, 'Teri H. Thompson', 'TeriHThompson@rhyta.com', '517-462-6227', '127 Elk Avenue\r\nKalamazoo, MI 49007', '2018-01-14', '50000.00', '1515942859016nkHqytwE4D3cdFSVC1515942859.jpg', 'Teri H. Thompson.zip', '1515942859V91lWSZ2Xp6b5IqaNMRU1515942859.zip', 'Teri', '2dc5d9f0a8178984bad4064baddeafeaaf79a3e36e3e04cfac2bc7aeb74972e4bc747b94da69b75f4c1d64002f07a6e2788fe3624044c87416ed460801cd83ce', 1, 'Engineer');

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
(5, 'Brick', 'PCS', '8.00');

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
  `usertype` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Manager'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`ID`, `name`, `email`, `phone`, `address`, `join_date`, `salary`, `photo`, `filename`, `document`, `username`, `password`, `status`, `usertype`) VALUES
(3, 'William D. Brown', 'WilliamDBrown@jourrapide.com', '828-325-4326', '1608 Hannah Street\r\nHickory, NC 28601', '2018-01-14', '40000.00', '1515949793hwcSEexglFiKHomvp2Xa1515949793.jpg', 'William D. Brown.zip', '1515949793rcY5ZI1dH8LksVOm4oC61515949793.zip', 'William', '2dc5d9f0a8178984bad4064baddeafeaaf79a3e36e3e04cfac2bc7aeb74972e4bc747b94da69b75f4c1d64002f07a6e2788fe3624044c87416ed460801cd83ce', 1, 'Manager'),
(4, 'Darrell E. Robinson', 'DarrellERobinson@teleworm.us', '617-260-3019', '2067 Lynn Street\r\nCambridge, MA 02141', '2018-01-14', '40000.00', '1515950107CUVPw1RQHckdslWO50L91515950107.jpg', 'someting.zip', '1515951191PaphQ7rUlRL9JdHxACST1515951191.zip', 'Darrell', '2dc5d9f0a8178984bad4064baddeafeaaf79a3e36e3e04cfac2bc7aeb74972e4bc747b94da69b75f4c1d64002f07a6e2788fe3624044c87416ed460801cd83ce', 1, 'Manager');

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

--
-- Dumping data for table `sitedocuments`
--

INSERT INTO `sitedocuments` (`ID`, `siteID`, `title`, `note`, `filename`, `document`) VALUES
(1, 6, 'Something Document', 'Nothing', 'wplms.zip', '1515959698cgOGAqbEZ2TksBFyLCp71515959698.zip');

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
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `ID` int(11) NOT NULL,
  `name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `engineerID` int(11) NOT NULL,
  `sitetype` enum('Construction','Supply') COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`ID`, `name`, `address`, `engineerID`, `sitetype`, `photo`, `created`, `status`) VALUES
(6, 'Jamuna Future', 'House #08 Road #03 Block-A Bochila Garden City', 34, 'Construction', '1515958422SMixQlbRra4JB3NLpVjU1515958422.jpg', '2018-01-15', 1);

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
(17, 5, 6, 0),
(18, 4, 6, 0);

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
(67, 6, '10000.00', '2018-01-15', 'Add Balance', 'Noting');

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
(4, 'Watch Man', 'Something About Watch Man');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
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
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `engineers`
--
ALTER TABLE `engineers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sitedocuments`
--
ALTER TABLE `sitedocuments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `siteemployees`
--
ALTER TABLE `siteemployees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stocktotal`
--
ALTER TABLE `stocktotal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
