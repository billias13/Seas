-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2016 at 06:02 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seasbasicdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `CompanyID` int(11) NOT NULL,
  `CompanyName` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`CompanyID`, `CompanyName`) VALUES
(3, ' Anek Lines'),
(1, ' Blue Star'),
(2, ' Hellenic Seaways');

-- --------------------------------------------------------

--
-- Table structure for table `portinfo`
--

CREATE TABLE `portinfo` (
  `PortID` int(11) NOT NULL,
  `PortCode` varchar(5) NOT NULL,
  `PortName` varchar(64) NOT NULL,
  `PortDescr` varchar(64) NOT NULL,
  `PortLat` float(10,6) DEFAULT '0.000000',
  `PortLng` float(10,6) DEFAULT '0.000000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portinfo`
--

INSERT INTO `portinfo` (`PortID`, `PortCode`, `PortName`, `PortDescr`, `PortLat`, `PortLng`) VALUES
(1, 'NAA', 'Naxos', 'Chora', 37.102650, 25.374050),
(2, 'ANP', 'Paros', 'Paroikia', 37.086189, 25.148830),
(3, 'PIR', 'Pireus', ' Athens', 37.948399, 23.640800),
(4, 'LIV', 'Serifos', ' Livadi', 37.141819, 24.518410),
(5, 'SYR', 'Syros', 'Town', 0.000000, 0.000000),
(7, 'KRE', 'Sifnos', 'Kamares', 0.000000, 0.000000),
(8, 'IOS', 'Ios', 'Chora', 0.000000, 0.000000),
(11, 'TIN', 'Tinos', 'Chora', 0.000000, 0.000000),
(12, 'JMK', 'Mykonos', 'Chora', 0.000000, 0.000000),
(13, 'KMS', 'Kimolos', 'Kimolos', 0.000000, 0.000000),
(14, 'MLO', 'Milos', 'Adamas', 0.000000, 0.000000),
(15, 'KYT', 'Kythnos', 'Kythnos', 0.000000, 0.000000),
(16, 'FOL', 'Folegandros', 'Folegandros', 0.000000, 0.000000),
(17, 'ATN', 'Santorini', 'Thira', 0.000000, 0.000000),
(18, 'SII', 'Sikinos', 'Sikinos', 0.000000, 0.000000),
(21, 'AMO', 'Amorgos', 'Katapola', 0.000000, 0.000000),
(22, 'AIG', 'Amorgos', 'Aigiali', 0.000000, 0.000000),
(23, 'HRK', 'Herakleia', 'Cyclades', 0.000000, 0.000000),
(24, 'KOF', 'Koufonissia', 'Cyclades', 0.000000, 0.000000),
(25, 'SHC', 'Schinousa', 'Cyclades', 0.000000, 0.000000);

-- --------------------------------------------------------

--
-- Table structure for table `ports`
--

CREATE TABLE `ports` (
  `PortID` int(11) NOT NULL,
  `PortName` varchar(128) NOT NULL,
  `PortLocation` varchar(128) NOT NULL,
  `PortLat` float(10,6) NOT NULL,
  `PortLng` float(10,6) NOT NULL,
  `PortOther` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ports`
--

INSERT INTO `ports` (`PortID`, `PortName`, `PortLocation`, `PortLat`, `PortLng`, `PortOther`) VALUES
(1, 'Naxos', ' ', 37.101292, 25.373020, ' '),
(2, 'Paros', ' ', 37.085644, 25.148832, ' '),
(3, 'Syros', ' ', 37.438503, 24.913935, ' '),
(4, 'Pireus', ' ', 37.942986, 23.646982, ' '),
(5, 'Serifos', ' ', 37.155807, 24.505917, ' '),
(6, 'Sifnos', ' ', 36.967957, 24.702417, ' '),
(7, 'Milos', ' ', 36.743855, 24.422606, ' '),
(8, 'Rafina', ' ', 38.023445, 24.005924, ' '),
(9, 'Andros', ' ', 37.838039, 24.939127, ' '),
(10, 'Mykonos', ' ', 37.446720, 25.328861, ' '),
(11, 'Tinos', ' ', 37.539314, 25.159822, ' '),
(12, 'Ios', ' ', 49.923252, -6.296573, ' '),
(13, 'Santorini', ' ', 36.393154, 25.461510, ' '),
(14, 'Aegina', ' ', 37.740883, 23.501421, ' '),
(15, 'Chania', ' ', 35.513828, 24.018038, ' '),
(16, 'Rodos', ' ', 36.434963, 28.217484, ' '),
(17, 'Karpathos', ' ', 35.507572, 27.212198, ' '),
(18, 'Herakleion', '', 35.338734, 25.144213, '');

-- --------------------------------------------------------

--
-- Table structure for table `routelegs`
--

CREATE TABLE `routelegs` (
  `LegID` int(11) NOT NULL,
  `RouteID` int(11) NOT NULL,
  `PortAID` int(11) NOT NULL,
  `PortBID` int(11) NOT NULL,
  `DepartureTime` datetime DEFAULT NULL,
  `ArrivalTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routelegs`
--

INSERT INTO `routelegs` (`LegID`, `RouteID`, `PortAID`, `PortBID`, `DepartureTime`, `ArrivalTime`) VALUES
(1, 1, 4, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 3, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 1, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 12, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 2, 8, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 2, 9, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 2, 10, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 2, 11, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 3, 4, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 3, 5, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 3, 6, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 4, 4, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 5, 4, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 6, 15, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 6, 18, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 7, 15, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 7, 16, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 7, 17, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `RouteID` int(11) NOT NULL,
  `VesselID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `OriginPortID` int(11) NOT NULL,
  `DestinationPortID` int(11) NOT NULL,
  `DepartureTime` datetime NOT NULL,
  `ArrivalTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`RouteID`, `VesselID`, `CompanyID`, `OriginPortID`, `DestinationPortID`, `DepartureTime`, `ArrivalTime`) VALUES
(1, 1, 1, 4, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 1, 8, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 1, 4, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 2, 4, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 2, 4, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 6, 2, 15, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 7, 2, 15, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `routesdetails`
--

CREATE TABLE `routesdetails` (
  `RouteID` int(11) NOT NULL,
  `PortID` varchar(5) NOT NULL,
  `PortOrder` int(11) NOT NULL,
  `StopID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routesdetails`
--

INSERT INTO `routesdetails` (`RouteID`, `PortID`, `PortOrder`, `StopID`) VALUES
(1, '3', 1, 1),
(1, '2', 2, 2),
(1, '1', 3, 3),
(1, '23', 4, 4),
(1, '25', 5, 5),
(1, '24', 6, 6),
(1, '21', 7, 7),
(2, '3', 1, 8),
(2, '15', 2, 11),
(2, '4', 3, 12),
(2, '7', 4, 13),
(2, '14', 5, 14),
(2, '13', 6, 15),
(2, '16', 7, 16),
(2, '18', 8, 17),
(2, '8', 9, 18),
(2, '17', 10, 19),
(3, '3', 1, 20),
(3, '11', 2, 21),
(3, '12', 3, 24),
(3, '1', 4, 25),
(3, '17', 5, 26);

-- --------------------------------------------------------

--
-- Table structure for table `routesinfo`
--

CREATE TABLE `routesinfo` (
  `RouteID` int(11) NOT NULL,
  `RoutePortA` varchar(5) NOT NULL,
  `RoutePortB` varchar(5) NOT NULL,
  `RoutePortNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routesinfo`
--

INSERT INTO `routesinfo` (`RouteID`, `RoutePortA`, `RoutePortB`, `RoutePortNum`) VALUES
(1, '3', '21', 7),
(2, '3', '17', 10),
(3, '3', '17', 5);

-- --------------------------------------------------------

--
-- Table structure for table `seasvisitors`
--

CREATE TABLE `seasvisitors` (
  `VisitorID` int(32) NOT NULL,
  `VisitorIP` varchar(30) DEFAULT NULL,
  `VisitorVisits` int(32) NOT NULL,
  `VisitorCountry` varchar(255) NOT NULL,
  `Unused` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seasvisitors`
--

INSERT INTO `seasvisitors` (`VisitorID`, `VisitorIP`, `VisitorVisits`, `VisitorCountry`, `Unused`) VALUES
(28, '192.168.2.1', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vessels`
--

CREATE TABLE `vessels` (
  `VesselID` int(11) NOT NULL,
  `VesselName` varchar(128) NOT NULL,
  `CompanyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vessels`
--

INSERT INTO `vessels` (`VesselID`, `VesselName`, `CompanyID`) VALUES
(1, ' Naxos', 1),
(2, ' Paros', 1),
(3, ' Ithaki', 1),
(4, ' HighSpeed 1', 2),
(5, ' HighSpeed 2', 2),
(6, ' HighSpeed 3', 2),
(7, ' HighSpeed 4', 2),
(8, ' HighSpeed 5', 2),
(9, ' F/B BLUE GALAXY', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`CompanyID`),
  ADD UNIQUE KEY `CompanyName` (`CompanyName`);

--
-- Indexes for table `portinfo`
--
ALTER TABLE `portinfo`
  ADD PRIMARY KEY (`PortID`),
  ADD UNIQUE KEY `PortCode` (`PortCode`),
  ADD UNIQUE KEY `PortID` (`PortID`);

--
-- Indexes for table `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`PortID`);

--
-- Indexes for table `routelegs`
--
ALTER TABLE `routelegs`
  ADD PRIMARY KEY (`LegID`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`RouteID`);

--
-- Indexes for table `routesdetails`
--
ALTER TABLE `routesdetails`
  ADD PRIMARY KEY (`StopID`);

--
-- Indexes for table `routesinfo`
--
ALTER TABLE `routesinfo`
  ADD PRIMARY KEY (`RouteID`);

--
-- Indexes for table `seasvisitors`
--
ALTER TABLE `seasvisitors`
  ADD PRIMARY KEY (`VisitorID`),
  ADD UNIQUE KEY `VisitorIP` (`VisitorIP`);

--
-- Indexes for table `vessels`
--
ALTER TABLE `vessels`
  ADD PRIMARY KEY (`VesselID`),
  ADD UNIQUE KEY `VesselName` (`VesselName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `CompanyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `portinfo`
--
ALTER TABLE `portinfo`
  MODIFY `PortID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `ports`
--
ALTER TABLE `ports`
  MODIFY `PortID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `routelegs`
--
ALTER TABLE `routelegs`
  MODIFY `LegID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `RouteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `routesdetails`
--
ALTER TABLE `routesdetails`
  MODIFY `StopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `routesinfo`
--
ALTER TABLE `routesinfo`
  MODIFY `RouteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `seasvisitors`
--
ALTER TABLE `seasvisitors`
  MODIFY `VisitorID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `vessels`
--
ALTER TABLE `vessels`
  MODIFY `VesselID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
