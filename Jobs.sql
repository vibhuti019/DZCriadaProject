-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2021 at 06:17 AM
-- Server version: 10.5.8-MariaDB-3
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DZCriada`
--

-- --------------------------------------------------------

--
-- Table structure for table `Jobs`
--

CREATE TABLE `Jobs` (
  `jobId` int(11) NOT NULL,
  `customerName` text NOT NULL,
  `customerMobile` text NOT NULL,
  `deliveryTime` text NOT NULL,
  `dropOffLocation` text NOT NULL,
  `dropUnitNumber` text NOT NULL,
  `pickupLocation` text NOT NULL,
  `pickupUnitNumber` text NOT NULL,
  `requiredVehicle` text NOT NULL,
  `priceOfDelivery` text NOT NULL,
  `scheduleDelivery` text NOT NULL,
  `scheduleDate` text NOT NULL,
  `scheduleTime` text NOT NULL,
  `driverNotes` text NOT NULL,
  `paymentMode` text NOT NULL,
  `paymentId` text NOT NULL,
  `status` text NOT NULL,
  `assignedDriver` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Jobs`
--

INSERT INTO `Jobs` (`jobId`, `customerName`, `customerMobile`, `deliveryTime`, `dropOffLocation`, `dropUnitNumber`, `pickupLocation`, `pickupUnitNumber`, `requiredVehicle`, `priceOfDelivery`, `scheduleDelivery`, `scheduleDate`, `scheduleTime`, `driverNotes`, `paymentMode`, `paymentId`, `status`, `assignedDriver`) VALUES
(112920742, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Booked', 'None'),
(276500834, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Booked', 'None'),
(522032284, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Booked', 'None'),
(574715339, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Booked', 'None'),
(1066342095, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Booked', 'None'),
(1354447263, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Assigned', '1'),
(1461060964, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Booked', 'None'),
(1472383253, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Booked', 'None'),
(1510226048, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Assigned', '1'),
(1665870522, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Booked', 'None'),
(1759411412, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Booked', 'None'),
(2031989855, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Assigned', '1'),
(2074114871, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Booked', 'None'),
(2087620053, 'Melisa Tan', '989496843', '31 Aug 12:20PM', 'Toa Poyah', '04-123', 'Potang Pasir', '04-123', 'Bike, (Weight < 8kg)', '400', '', 'Today (29th Aug)', '11:10 AM', 'TextField', 'Wallet', 'id', 'Booked', 'None');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Jobs`
--
ALTER TABLE `Jobs`
  ADD PRIMARY KEY (`jobId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Jobs`
--
ALTER TABLE `Jobs`
  MODIFY `jobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2087620054;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
