-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 28, 2024 at 10:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `experiment`
--

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `name`, `email`, `mobile`, `password`, `user_type`) VALUES
(59, 'Niloy Chowdhury', 'nilon@gmail.com', '1234', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(60, 'Afif Arfan', 'tech360.afif@gmail.com', '01759813343', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(61, 'Teresa Palmar', 'tech360.teresa@gmail.com', '44441', '81dc9bdb52d04dc20036dbd8313ed055', 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `inbound`
--

CREATE TABLE `inbound` (
  `SN` int(3) NOT NULL,
  `trx_id` varchar(1000) NOT NULL,
  `item_id` varchar(12) NOT NULL,
  `item_description` varchar(50) NOT NULL,
  `item_quantity` varchar(100) NOT NULL,
  `unit_price` varchar(500) NOT NULL,
  `date_received` date NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inbound`
--

INSERT INTO `inbound` (`SN`, `trx_id`, `item_id`, `item_description`, `item_quantity`, `unit_price`, `date_received`, `supplier`, `total_price`, `remarks`, `updated_by`, `updated_time`) VALUES
(1, '1001', '101', 'star screws packet', '100', '1000', '2024-01-24', 'Hooks', '100000', 'intact', 'Niloy Chowdhury', '2024-03-28 08:55:04'),
(2, '1002', '102', 'philip screws packet', '100', '1000', '2024-01-25', 'Alamdina hardware store', '100000', 'intact', '', '2024-03-28 08:36:43'),
(3, '1003', '103', 'Hex screws packet', '100', '1000', '2024-01-26', 'Rahim hardware store', '100000', 'intact', '', '2024-03-28 08:36:43'),
(4, '1004', '104', 'Zip ties packet', '100', '1000', '2024-01-27', 'Nirob hardware', '100000', 'intact', '', '2024-03-28 08:36:43'),
(5, '1008', '105', 'Flat screw driver', '100', '5000', '2024-01-28', 'Jessore hardware', '500000', 'intact', '', '2024-03-28 08:36:43'),
(6, '2085', '106', 'Philip screw driver', '100', '10000', '2024-01-29', 'Jashim hardware', '100000', 'intact', '', '2024-03-28 08:36:43'),
(7, '2008', '107', 'Hex Keys', '100', '20000', '2024-01-30', 'Rahima hardware', '20000', 'intact', '', '2024-03-28 08:36:43'),
(8, '1088', '108', 'Routers', '50', '100000', '2024-01-31', 'Megna hardware', '5000000', 'intact', '', '2024-03-28 08:36:43'),
(9, '1077', '109', 'Cisco modules', '50', '500000', '2024-02-02', 'ACI hardware', '25000000', 'intact', '', '2024-03-28 08:36:43'),
(10, '2086', '110', 'Wrenches', '100', '30000', '2024-02-04', 'Huawei hardware', '3000000', 'intact', '', '2024-03-28 08:36:43'),
(11, '3043', '111', 'Testers', '100', '50000', '2024-02-06', 'Robi hardware', '5000000', 'intact', '', '2024-03-28 08:36:43'),
(12, '4076', '112', 'Drill machine', '20', '50000', '2024-02-01', 'Airtel hardware', '1000000', 'intact', '', '2024-03-28 08:36:43'),
(13, '2019', '114', 'Optical attenuators', '1000', '40000', '2024-01-04', 'Banglalink hardware', '4000000', 'intact', '', '2024-03-28 08:36:43'),
(14, '2009', '115', 'Measuring tape', '100', '5000', '2024-03-01', 'Double A hardware', '500000', 'intact', '', '2024-03-28 08:36:43'),
(15, '1012', '116', 'Electro tape', '1000', '5000', '2024-02-05', 'B2B hardware', '5000000', 'intact', '', '2024-03-28 08:36:43'),
(16, '1099', '117', 'Marking tape', '1000', '5000', '2024-02-05', 'Hanif hardware', '5000000', 'intact', '', '2024-03-28 08:36:43'),
(17, '1075', '201', 'Marsking tape', '1000', '5000', '2024-02-06', 'Azwad hardware', '5000000', 'intact', '', '2024-03-28 08:36:43'),
(18, '1068', '202', 'Side cutters', '150', '50000', '2024-01-23', 'Veloce hardware', '750000', 'intact', '', '2024-03-28 08:36:43'),
(19, '1069', '203', 'Sensors', '1000', '50000', '2024-01-27', 'Sony hardware', '50000000', 'intact', '', '2024-03-28 08:36:43'),
(20, '1459', '302', 'Repeaters', '50', '45000', '2024-01-29', 'Sony hardware', '2250000', 'intact', '', '2024-03-28 08:36:43'),
(21, '1980', '303', 'Fiber Optic cable', '1000', '35000', '2024-01-20', 'Sony hardware', '35000000', 'intact', '', '2024-03-28 08:36:43'),
(22, '2014', '304', 'Fiber Optic pigtail', '1000', '50000', '2024-01-21', 'Sony hardware', '500000000', 'intact', '', '2024-03-28 08:36:43'),
(23, '2018', '305', 'FBT coupler', '200', '67000', '2024-01-15', 'Mehgna hardware', '13400000', 'intact', '', '2024-03-28 08:36:43'),
(24, '2044', '333', 'PLC splitter', '200', '42000', '2024-01-16', 'MRF hardware', '8400000', 'intact', '', '2024-03-28 08:36:43'),
(25, '3034', '345', 'Fast connector', '500', '32000', '2024-02-09', 'Trek hardware', '16000000', 'intact', '', '2024-03-28 08:36:43'),
(26, '3033', '355', 'FTTH Box', '500', '68000', '2024-01-09', 'Instar hardware', '340000000', 'intact', '', '2024-03-28 08:36:43'),
(27, '3333', '366', 'Fiber Optic closure', '5000', '20500', '2024-01-10', 'Techlogic hardware', '10250000', 'intact', '', '2024-03-28 08:36:43'),
(28, '4444', '234', 'Modular Crimps tools', '30', '65000', '2024-02-08', 'Fare tech hardware', '1950000', 'intact', '', '2024-03-28 08:36:43'),
(29, '5657', '255', 'CAT-5 cables', '1000', '43000', '2024-01-28', 'Aqme hardware', '43000000', 'intact', '', '2024-03-28 08:36:43'),
(30, '2347', '245', 'Codless', '50', '154500', '2024-02-29', 'Pran hardware', '7725000', 'intact', '', '2024-03-28 08:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `outbound`
--

CREATE TABLE `outbound` (
  `SN` int(11) NOT NULL,
  `trx_id` varchar(1000) NOT NULL,
  `item_id` varchar(6) NOT NULL,
  `item_description` varchar(50) NOT NULL,
  `item_quantity` varchar(100) NOT NULL,
  `unit_price` varchar(10000) NOT NULL,
  `date_shipped` date NOT NULL,
  `department` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outbound`
--

INSERT INTO `outbound` (`SN`, `trx_id`, `item_id`, `item_description`, `item_quantity`, `unit_price`, `date_shipped`, `department`, `destination`, `total_price`, `remarks`, `updated_by`, `updated_time`) VALUES
(1, '1001', '104', 'CAT-5 cables', '100', '20', '2024-01-24', 'Logistics', 'Dhanmondi', 'tk 2000', 'intact', '', '2024-03-28 08:36:14'),
(2, '1002', '102', 'philip screws packet', '100', '1000', '2024-01-25', 'SAS', 'Uttara', '100000', 'intact', '', '2024-03-28 08:36:14'),
(3, '1003', '103', 'Hex screws packet', '100', '1000', '2024-01-26', 'HR', 'Banani', '100000', 'intact', '', '2024-03-28 08:36:14'),
(4, '1004', '104', 'Zip ties packet', '100', '1000', '2024-01-27', 'Logistics', 'Mirpur-11', '100000', 'intact', '', '2024-03-28 08:36:14'),
(5, '1008', '105', 'Flat screw driver', '100', '5000', '2024-01-28', 'SAS', 'Old Dhaka', '500000', 'intact', '', '2024-03-28 08:36:14'),
(6, '2085', '106', 'Philip screw driver', '100', '10000', '2024-01-29', 'HR', 'Manikganj', '100000', 'intact', '', '2024-03-28 08:36:14'),
(7, '2008', '107', 'Hex Keys', '100', '20000', '2024-01-30', 'Logistics', 'Savar', '20000', 'intact', '', '2024-03-28 08:36:14'),
(8, '1088', '108', 'Routers', '50', '100000', '2024-01-31', 'SAS', 'Demra', '5000000', 'intact', '', '2024-03-28 08:36:14'),
(9, '1077', '109', 'Cisco modules', '50', '500000', '2024-02-02', 'Logistics', 'Aftab Nagar', '25000000', 'intact', '', '2024-03-28 08:36:14'),
(10, '2086', '110', 'Wrenches', '100', '30000', '2024-02-04', 'SAS', 'Kafrul', '3000000', 'intact', '', '2024-03-28 08:36:14'),
(11, '3043', '111', 'Testers', '100', '50000', '2024-02-06', 'HR', 'Mirpur-1', '5000000', 'intact', '', '2024-03-28 08:36:14'),
(12, '4076', '112', 'Drill machine', '20', '50000', '2024-02-01', 'Logistics', 'Postokola', '1000000', 'intact', '', '2024-03-28 08:36:14'),
(13, '2019', '114', 'Optical attenuators', '1000', '40000', '2024-01-04', 'SAS', 'TSC', '4000000', 'intact', '', '2024-03-28 08:36:14'),
(14, '2009', '115', 'Measuring tape', '100', '5000', '2024-03-01', 'WAP', 'Farmgate', '500000', 'intact', '', '2024-03-28 08:36:14'),
(15, '1012', '116', 'Electro tape', '1000', '5000', '2024-02-05', 'Logistics', 'Shahbag', '5000000', 'intact', '', '2024-03-28 08:36:14'),
(16, '1099', '117', 'Marking tape', '1000', '5000', '2024-02-05', 'WAP', 'Keraniganj', '5000000', 'intact', '', '2024-03-28 08:36:14'),
(17, '1075', '201', 'Marsking tape', '1000', '5000', '2024-02-06', 'SAS', 'Narayanganj', '5000000', 'intact', '', '2024-03-28 08:36:14'),
(18, '1068', '202', 'Side cutters', '150', '50000', '2024-01-23', 'WAP', 'Rupganj', '750000', 'intact', '', '2024-03-28 08:36:14'),
(19, '1069', '203', 'Sensors', '1000', '50000', '2024-01-27', 'Logistics', 'Gazipur', '50000000', 'intact', '', '2024-03-28 08:36:14'),
(20, '1459', '302', 'Repeaters', '50', '45000', '2024-01-29', 'HR', 'Airport', '2250000', 'intact', '', '2024-03-28 08:36:14'),
(21, '1980', '303', 'Fiber Optic cable', '1000', '35000', '2024-01-20', 'WAP', 'Sreenagar', '35000000', 'intact', '', '2024-03-28 08:36:14'),
(22, '2014', '304', 'Fiber Optic pigtail', '1000', '50000', '2024-01-21', 'SAS', 'Nayapur', '500000000', 'intact', '', '2024-03-28 08:36:14'),
(23, '2018', '305', 'FBT coupler', '200', '67000', '2024-01-15', 'HR', 'Faridpur', '13400000', 'intact', '', '2024-03-28 08:36:14'),
(24, '2044', '333', 'PLC splitter', '200', '42000', '2024-01-16', 'Logistics', 'Natore', '8400000', 'intact', '', '2024-03-28 08:36:14'),
(25, '3034', '345', 'Fast connector', '500', '32000', '2024-02-09', 'Logistics', 'Bogura', '16000000', 'intact', '', '2024-03-28 08:36:14'),
(26, '3033', '355', 'FTTH Box', '500', '68000', '2024-01-09', 'WAP', 'Jamalpur', '340000000', 'intact', '', '2024-03-28 08:36:14'),
(27, '3333', '366', 'Fiber Optic closure', '5000', '20500', '2024-01-10', 'PO', 'Sunamganj', '10250000', 'intact', '', '2024-03-28 08:36:14'),
(28, '4444', '234', 'Modular Crimps tools', '30', '65000', '2024-02-08', 'Logistics', 'Gobindaganj', '1950000', 'intact', '', '2024-03-28 08:36:14'),
(29, '5657', '255', 'CAT-5 cables', '1000', '43000', '2024-01-28', 'HR', 'Bhatipara', '43000000', 'intact', '', '2024-03-28 08:36:14'),
(30, '2347', '245', 'Codless', '50', '154500', '2024-02-29', 'SAS', 'Netrokona', '7725000', 'intact', '', '2024-03-28 08:36:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbound`
--
ALTER TABLE `inbound`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `outbound`
--
ALTER TABLE `outbound`
  ADD PRIMARY KEY (`SN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `inbound`
--
ALTER TABLE `inbound`
  MODIFY `SN` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `outbound`
--
ALTER TABLE `outbound`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
