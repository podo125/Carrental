

PRODUCT DESCRIPTION 


1. General information

Product	SMS Car rentals
Version	3.5
Date	01.01.2016
Status	confidential
Product manager	Anthony Vandyck


2.	Description

This is a software application designed for users who want to rent a car with the defined  type of brand for a number of days .

 Date and Time is automatically recorded in the database system when a new price for a given Brand  is recorded.

This application allows the users to send SMS with the name of the car (Brand). When the user sent only  Brand  (in correct spelling words and  valid - i.e. existing in the database of the car rental firm)  it will return SMS with price per day.

This system is designed in way that when the user want a particular Brand of car for a defined number of days, then the system return an SMS with total sum for the given number of days.




3. Syntax

Description of the format of the input data (SMS):

The user is entitle to enter the type of car Brand name and number of days, and in between the brand and number of days should be (:).
It is very important for the user to have the spelling of the brand correctly to be possible  for the system to recognize in the database.  And spelling of words is case insensitive.



Formatting with 1 parameter	BRAND
Formatting with 2 parameter	BRAND :Number of DAYS

Examples of valid written SMS:
Benz: 2
Renault: 1
Opel: 3
BMW: 4

Examples of invalid written SMS:
Benes: 2
BMM: 1

The settings for delivery of a sent valid SMS from users are: the SMS to be correctly written and then sent with Brand and number of days to CarRental SMS system.
When a valid SMS is sent to the system, a message will be sent back to the client user and information sent by the client user will be registered in the system.

When a Brand name is misspelled for SMS for enquiry, the client will receive an SMS, which will inform the client user the message sent is invalid. And words entered are case insensitive Upper case and lower case are all allowed.



4. Set of messages

        4.1. Input with 1 parameters

This is when the user enter with two parameters (Brand and NumOfDays) and it will return to user with a message for total sum for paying day.

Formatting with 1 parameter	BRAND

Example: 
 input :  Opel
output :    +OK The price per day is 15.00 






        4.2. Input with 2 parameters

This is when a client user send SMS with only one parameter (Brand) and it will return to user with a message for total price per day.

Formatting with 2  parameter	BRAND:NUMBER OF DAYS

Example:
 input  :   Opel:2
output :       +OK your Total Price For Opel for 2 days is 30 

5. Paying - by short number with value added SMS   (VASMS)  on short number      3333 – 0.30 lv. with VAT.


6. Service promotion
This company uses internet media such as Facebook, search engine, Google and some internet sites for posting and pop-up adverts. We also use Billboards and sign boards to make awareness on a roadside when one is driving on the high way to see the affordable rates  of luxury and economy vehicles, perfect for a range of travel. 


7. Content generation
This is a process when the client- user  sends SMS with  a Brand of car,  the system search in the database “Carrental”  for the  last price for the entered brand of car.  If there exists only one parameter-brand – the system returns  the Price per day.  If the client-user  sends SMS with two parameters – the second parameter is the number of days for rent, then the system calculates the total sum for paying (by multiplying Price_per_day   by Numbers_of_days for the rent of that car ) and return a message with a total sum for paying. 

8. Launch plan

Task	responsible	Deadline	Comments responsible
Approving Product Description	Anthony Vandyck	1.04.2016	
Technical Realization, variant 1
(with 1 parameter)	Anthony Vandyck	15.04.2016	
Internal tests	Anthony Vandyck	22.04.2016	
Technical Realization, variant 2
(with two parameters)	Anthony Vandyck	13.05.2016	
Base tests	Anthony Vandyck	20.05.2016	
Marketing plan	Marketing manager		
Launch date	Anthony Vandyck	27.05.2016	

Appendix 1

Database   carrentaluni11.sql

-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2016 at 10:10 AM
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
(3, 'Renault', 35.20, '2016-04-08 02:16:09'),
(4, 'Rangerover', 50.00, '2016-04-10 02:16:09'),
(5, 'Benz', 40.00, '2016-04-12 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;







  Appendix 2

PHP Source code -   CarRental.php

<?php

error_reporting(E_ALL);

$link = mysql_connect('localhost', 'root', '');

if (!$link) {

    echo "-ERR MySQL Error: " . mysql_error();
    exit();
}
mysql_select_db("carrentaluni");
$smsID = $_GET["smsID"];
$MSISDN = $_GET["MSISDN"];
$mobileSP = $_GET["msp"];
$smsBody = $_GET['smsBody'];

$smssmsBody = str_replace(" ", "", $smsBody);

$smsID = addslashes($smsID);
$MSISDN = addslashes($MSISDN);
$mobileSP = addslashes($mobileSP);
$smsBody = addslashes($smsBody);

$args = explode(':', $smsBody);
$Brand = $args[0];
$Np = count($args);
if ($Np == 2)
    $NumOfDays = $args[1];

$selectSQL = "
	SELECT
		*
	FROM
		carrentaldata
WHERE
Brand='$Brand'
";
$rSelect = mysql_query($selectSQL);

if ($rSelect == false) {

    echo "-ERR MySQL Error: " . mysql_error() . "\nSQL: $selectSQL";
    exit();
} else {

    $count = mysql_num_rows($rSelect);

    if ($count == 0) {

        echo "+OK Invalid Brand.";
        mysql_close($link);
        exit();
    }

    $row = mysql_fetch_array($rSelect);

    $price = $row['Price'];
    $ID = $row['ID'];
    $Brand = $row['Brand'];
    $dt = $row['DateTime'];
    if ($Np == 2) {
        $Totalprice = $NumOfDays * $price;

        echo '+OK your Total Price For ' . $Brand . ' for ' . $NumOfDays . '  days is ' . $Totalprice;
    }
    else
        echo "+OK The price per day is $price ";

    exit();
}
mysql_close($link);
?>
