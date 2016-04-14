-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2016 at 09:29 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrentaldata`
--

CREATE TABLE IF NOT EXISTS `carrentaldata` (
  `ID` int(10) NOT NULL,
  `Brand` varchar(12) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `Numberofdays` int(10) NOT NULL DEFAULT '0',
  `Price` float(10,2) NOT NULL DEFAULT '0.00',
  `DateTime` datetime NOT NULL,
  KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carrentaldata`
--

INSERT INTO `carrentaldata` (`ID`, `Brand`, `Numberofdays`, `Price`, `DateTime`) VALUES
(1, 'BMW', 3, 29.99, '2016-04-05 03:23:08'),
(2, 'Opel', 2, 15.00, '2016-04-06 02:15:06'),
(3, 'Renult', 5, 35.20, '2016-04-08 02:16:09'),
(4, 'Rangerover', 1, 50.00, '2016-04-10 02:16:09'),
(5, 'Benz', 2, 40.00, '2016-04-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `carsprice`
--

CREATE TABLE IF NOT EXISTS `carsprice` (
  `CarsID` int(10) NOT NULL,
  `Brand` varchar(12) NOT NULL,
  `Priceforaday` float NOT NULL DEFAULT '0',
  KEY `CarsID` (`CarsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carsprice`
--

INSERT INTO `carsprice` (`CarsID`, `Brand`, `Priceforaday`) VALUES
(1, 'BMW', 14.99),
(2, 'Opel', 10),
(3, 'Renult', 12.12),
(4, 'Rengerover', 20.99),
(5, 'Benz', 18.99);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
