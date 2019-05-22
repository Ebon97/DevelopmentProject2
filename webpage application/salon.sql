-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 01:07 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(20) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `booking_cust` int(20) NOT NULL,
  `booking_staff` int(20) NOT NULL,
  `booking_status` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_date`, `booking_time`, `booking_cust`, `booking_staff`, `booking_status`, `price`) VALUES
(121, '2019-04-10', '12:30:00', 1, 1023, 'Booked', 250),
(122, '2019-04-11', '12:30:00', 2, 1024, 'Booked', 150),
(123, '2019-04-12', '12:30:00', 3, 1025, 'Booked', 450),
(124, '2019-04-13', '12:30:00', 4, 1026, 'Booked', 350),
(125, '2019-04-14', '12:30:00', 5, 1027, 'Booked', 450),
(126, '2019-04-15', '12:30:00', 6, 1028, 'Booked', 250),
(127, '2019-04-16', '12:30:00', 7, 1029, 'Booked', 50),
(128, '2019-04-17', '12:30:00', 1, 1023, 'Booked', 50);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(20) NOT NULL,
  `cust_name` varchar(225) NOT NULL,
  `cust_gender` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_gender`) VALUES
(1, 'Anna', 'Female'),
(2, 'B', 'female'),
(3, 'C', 'male'),
(4, 'D', 'female'),
(5, 'E', 'male'),
(6, 'F', 'female'),
(7, 'G', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inv_id` int(20) NOT NULL,
  `inv_name` varchar(225) NOT NULL,
  `inv_qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inv_id`, `inv_name`, `inv_qty`) VALUES
(25, 'Hair Conditioner', 20);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(20) NOT NULL,
  `staff_name` varchar(225) NOT NULL,
  `staff_gender` varchar(6) NOT NULL,
  `staff_password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_gender`, `staff_password`) VALUES
(1023, 'Raymond', 'male', 'raymond123'),
(1024, 'Chad', 'male', 'chad123'),
(1025, 'Yvonne', 'Female', 'yvonne123'),
(1026, 'Dastan', 'Male', 'dastan123'),
(1027, 'James', 'male', 'james123'),
(1028, 'Mary', 'female', 'mary123'),
(1029, 'Jerry', 'male', 'jerry123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `booking_cust` (`booking_cust`),
  ADD KEY `booking_staff` (`booking_staff`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`booking_cust`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`booking_staff`) REFERENCES `staff` (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
