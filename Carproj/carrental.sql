-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2016 at 10:48 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carrentaluni11`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrentaldata`
--

CREATE TABLE IF NOT EXISTS `carrentaldata` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Brand` varchar(12) NOT NULL DEFAULT '',
  `Price` float(10,2) NOT NULL DEFAULT '0.00',
  `DateTime` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TimeBrand` (`DateTime`,`Brand`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `carrentaldata`
--

INSERT INTO `carrentaldata` (`ID`, `Brand`, `Price`, `DateTime`) VALUES
(1, 'BMW', 29.99, '2016-04-05 03:23:08'),
(2, 'Opel', 15.00, '2016-04-06 02:15:06'),
(3, 'Renult', 35.20, '2016-04-08 02:16:09'),
(4, 'Rangerover', 50.00, '2016-04-10 02:16:09'),
(5, 'Benz', 40.00, '2016-04-12 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
