-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 07:10 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhakametroraildb`
--

-- --------------------------------------------------------

--
-- Table structure for table `abcbank`
--

CREATE TABLE `abcbank` (
  `idNo` int(11) NOT NULL,
  `bankID` varchar(55) DEFAULT NULL,
  `balance` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `abcbank`
--

INSERT INTO `abcbank` (`idNo`, `bankID`, `balance`) VALUES
(1, '123', '719991594'),
(3, '456', '7'),
(5, '000', '108');

-- --------------------------------------------------------

--
-- Table structure for table `line`
--

CREATE TABLE `line` (
  `idNo` int(11) NOT NULL,
  `lineName` varchar(55) DEFAULT NULL,
  `firstStation` varchar(55) DEFAULT NULL,
  `discription` text DEFAULT NULL,
  `timeStamp` varchar(55) DEFAULT NULL,
  `numOfTrains` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `line`
--

INSERT INTO `line` (`idNo`, `lineName`, `firstStation`, `discription`, `timeStamp`, `numOfTrains`) VALUES
(25, 'MRT_Line_6', 'Uttara North', 'Line-6 consists of 16 elevated stations each of 180m long and 20.1 km (12.5 mi) of electricity-powered light rail tracks. All of Line-6, save for the depot, and some of its accompanying LRT, will be elevated above current roads primarily above road medians to allow traffic flow underneath, with stations also elevated.', '1641976651', NULL),
(27, 'MRT_Line_1', 'Rampura', '', '1641980647', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mrt_line_1`
--

CREATE TABLE `mrt_line_1` (
  `idNo` int(11) NOT NULL,
  `stationName` varchar(55) DEFAULT NULL,
  `distance` varchar(55) DEFAULT NULL,
  `timeStamp` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mrt_line_1`
--

INSERT INTO `mrt_line_1` (`idNo`, `stationName`, `distance`, `timeStamp`) VALUES
(2, 'Rampura', '0', '1641980647'),
(3, 'Badda', '5', '1641980676');

-- --------------------------------------------------------

--
-- Table structure for table `mrt_line_6`
--

CREATE TABLE `mrt_line_6` (
  `idNo` int(11) NOT NULL,
  `stationName` varchar(55) DEFAULT NULL,
  `distance` varchar(55) DEFAULT NULL,
  `timeStamp` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mrt_line_6`
--

INSERT INTO `mrt_line_6` (`idNo`, `stationName`, `distance`, `timeStamp`) VALUES
(10, 'Motijheel', '22', '1641976685'),
(12, 'Mirpur 10', '7', '1641980337'),
(15, 'Uttara North', '0', '1641976651');

-- --------------------------------------------------------

--
-- Table structure for table `mrt_line_7`
--

CREATE TABLE `mrt_line_7` (
  `idNo` int(11) NOT NULL,
  `stationName` varchar(55) DEFAULT NULL,
  `distance` varchar(55) DEFAULT NULL,
  `timeStamp` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketId` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `lineName` varchar(55) DEFAULT NULL,
  `startStation` varchar(55) DEFAULT NULL,
  `endStation` varchar(55) DEFAULT NULL,
  `totalPerson` varchar(55) DEFAULT NULL,
  `pin` varchar(55) DEFAULT NULL,
  `valid` varchar(55) DEFAULT NULL,
  `timeStamp` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketId`, `userID`, `lineName`, `startStation`, `endStation`, `totalPerson`, `pin`, `valid`, `timeStamp`) VALUES
(23, 4, 'MRT_Line_6', 'Uttara North', 'Motijheel', '4', '82403', 'out', '1641977037'),
(25, 3, 'MRT_Line_6', 'Uttara North', 'Motijheel', '2', '61404', 'out', '1641979896'),
(26, 3, 'MRT_Line_6', 'Uttara North', 'Mirpur 10', '1', '74266', 'out', '1641984767'),
(27, 3, 'MRT_Line_1', 'Rampura', 'Badda', '1', '31179', 'out', '1641985752'),
(28, 3, 'MRT_Line_1', 'Badda', 'Rampura', '1', '61420', 'out', '1641986649'),
(29, 3, 'MRT_Line_6', 'Motijheel', 'Mirpur 10', '2', '20152', 'yes', '1642005536');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idNo` int(11) NOT NULL,
  `userName` varchar(55) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `mobile` varchar(55) DEFAULT NULL,
  `password` varchar(55) DEFAULT NULL,
  `nID` varchar(55) DEFAULT NULL,
  `bankID` varchar(55) DEFAULT NULL,
  `userT` varchar(55) DEFAULT NULL,
  `timeStamp` varchar(55) DEFAULT NULL,
  `lastLogin` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idNo`, `userName`, `email`, `mobile`, `password`, `nID`, `bankID`, `userT`, `timeStamp`, `lastLogin`) VALUES
(1, 'Kent', 'kent@yahoo.com', '01766838278', 'qwer1234', '12345', '123', 'user', '1641718993', '1641916271'),
(3, 'Bob', 'bob@mail.edu', '01719608412', 'asdf1234', '', '123', 'user', '1641909857', '1642005812'),
(4, 'Anne', 'anne@gmail.com', '01766838211', '12341234', '123', '', 'admin', '1641917049', '1642658614');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abcbank`
--
ALTER TABLE `abcbank`
  ADD PRIMARY KEY (`idNo`);

--
-- Indexes for table `line`
--
ALTER TABLE `line`
  ADD PRIMARY KEY (`idNo`);

--
-- Indexes for table `mrt_line_1`
--
ALTER TABLE `mrt_line_1`
  ADD PRIMARY KEY (`idNo`);

--
-- Indexes for table `mrt_line_6`
--
ALTER TABLE `mrt_line_6`
  ADD PRIMARY KEY (`idNo`);

--
-- Indexes for table `mrt_line_7`
--
ALTER TABLE `mrt_line_7`
  ADD PRIMARY KEY (`idNo`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abcbank`
--
ALTER TABLE `abcbank`
  MODIFY `idNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `line`
--
ALTER TABLE `line`
  MODIFY `idNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `mrt_line_1`
--
ALTER TABLE `mrt_line_1`
  MODIFY `idNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mrt_line_6`
--
ALTER TABLE `mrt_line_6`
  MODIFY `idNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mrt_line_7`
--
ALTER TABLE `mrt_line_7`
  MODIFY `idNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
