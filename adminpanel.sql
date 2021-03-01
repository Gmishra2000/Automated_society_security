-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2021 at 09:24 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminpanel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_visitor`
--

CREATE TABLE `admin_visitor` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `aadharNo` bigint(20) NOT NULL,
  `phoneNumber` bigint(20) NOT NULL,
  `designation` varchar(45) NOT NULL,
  `images` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_visitor`
--

INSERT INTO `admin_visitor` (`id`, `Name`, `aadharNo`, `phoneNumber`, `designation`, `images`) VALUES
(1, 'Ranjan Mali', 154651512, 8369291891, 'mali', 'ranjan.jpg'),
(3, 'Raju', 154154151, 8369291895, 'Cleaner', 'Raju.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `association_map`
--

CREATE TABLE `association_map` (
  `user_hNo` varchar(11) NOT NULL,
  `visitor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `association_map`
--

INSERT INTO `association_map` (`user_hNo`, `visitor_id`) VALUES
('105', 37);

-- --------------------------------------------------------

--
-- Table structure for table `dailyrecord`
--

CREATE TABLE `dailyrecord` (
  `Sr.No` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `Name` varchar(256) NOT NULL,
  `houseNo` varchar(11) NOT NULL,
  `phoneNumber` bigint(11) NOT NULL,
  `aadharNo` int(11) NOT NULL,
  `designation` varchar(256) NOT NULL,
  `temp` float NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dailyrecord`
--

INSERT INTO `dailyrecord` (`Sr.No`, `id`, `Name`, `houseNo`, `phoneNumber`, `aadharNo`, `designation`, `temp`, `time`) VALUES
(7, 29, 'Sharmn Joshi', '102', 9587456824, 123456789, 'Driver', 102, '2021-02-23 20:09:01'),
(8, 29, 'Sharmn Joshi', '102', 9587456824, 123456789, 'Driver', 102, '2021-02-23 20:09:01'),
(9, 29, 'Sharmn Joshi', '102', 9587456824, 123456789, 'Driver', 102, '2021-02-23 20:09:01'),
(10, 29, 'Sharmn Joshi', '102', 9587456824, 123456789, 'Driver', 102, '2021-02-23 20:09:01'),
(11, 29, 'Sharmn Joshi', '102', 9587456824, 123456789, 'Driver', 102, '2021-02-23 20:09:01'),
(12, 29, 'Sharmn Joshi', '102', 9587456824, 123456789, 'Driver', 102, '2021-02-23 20:09:01'),
(13, 29, 'Sharmn Joshi', '102', 9587456824, 123456789, 'Driver', 102, '2021-02-23 20:09:01'),
(14, 29, 'Sharmn Joshi', '102', 9587456824, 123456789, 'Driver', 102, '2021-02-23 20:09:01'),
(15, 29, 'Sharmn Joshi', '102', 9587456824, 123456789, 'Driver', 102, '2021-02-23 20:09:01'),
(16, 29, 'Sharmn Joshi', '102', 9587456824, 123456789, 'Driver', 102, '2021-02-23 20:09:01'),
(17, 29, 'Sharmn Joshi', '102', 9587456824, 123456789, 'Driver', 102, '2021-02-23 20:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `dailyvisit`
--

CREATE TABLE `dailyvisit` (
  `id` int(255) NOT NULL,
  `temp` float NOT NULL,
  `time` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `date` date NOT NULL DEFAULT current_timestamp(),
  `row_id` int(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dailyvisit`
--

INSERT INTO `dailyvisit` (`id`, `temp`, `time`, `date`, `row_id`, `status`) VALUES
(30, 98, '2021-02-23 23:18:40.000000', '2021-02-23', 42, 'read'),
(29, 102, '2021-02-24 01:39:01.000000', '2021-02-24', 43, 'read'),
(29, 102, '2021-02-24 01:39:01.000000', '2021-02-24', 44, 'read'),
(29, 102, '2021-02-24 01:39:01.000000', '2021-02-24', 45, 'read'),
(29, 102, '2021-02-24 01:39:01.000000', '2021-02-24', 46, 'read'),
(29, 102, '2021-02-24 01:39:01.000000', '2021-02-24', 47, 'read'),
(29, 102, '2021-02-24 01:39:01.000000', '2021-02-24', 48, 'read'),
(29, 102, '2021-02-24 01:39:01.000000', '2021-02-24', 49, 'read'),
(29, 102, '2021-02-24 01:39:01.000000', '2021-02-24', 50, 'read'),
(29, 102, '2021-02-24 01:39:01.000000', '2021-02-24', 51, 'read'),
(30, 98, '2021-02-24 11:23:27.000000', '2021-02-24', 52, 'read'),
(30, 98, '2021-02-24 11:24:49.000000', '2021-02-24', 53, 'read'),
(30, 98, '2021-02-24 11:24:49.000000', '2021-02-24', 54, 'read'),
(30, 98, '2021-02-24 11:35:55.000000', '2021-02-24', 55, 'read'),
(30, 98, '2021-02-24 11:42:49.000000', '2021-02-24', 56, 'read'),
(15, 98, '2021-02-24 11:42:49.000000', '2021-02-24', 57, 'read'),
(29, 100, '2021-02-24 12:05:28.000000', '2021-02-24', 58, 'read'),
(29, 100, '2021-02-24 12:05:28.000000', '2021-02-24', 59, 'read'),
(29, 100, '2021-02-24 12:05:28.000000', '2021-02-24', 60, 'read'),
(29, 100, '2021-02-24 12:05:28.000000', '2021-02-24', 61, 'read'),
(29, 100, '2021-02-24 12:27:05.000000', '2021-02-24', 62, 'read'),
(29, 100, '2021-02-24 12:27:05.000000', '2021-02-24', 63, 'read'),
(29, 100, '2021-02-24 12:27:05.000000', '2021-02-24', 64, 'read'),
(29, 100, '2021-02-24 12:27:05.000000', '2021-02-24', 65, 'read'),
(29, 100, '2021-02-24 12:27:05.000000', '2021-02-24', 66, 'read'),
(29, 100, '2021-02-24 12:27:05.000000', '2021-02-24', 67, 'read'),
(30, 98, '2021-02-24 11:24:49.000000', '2021-02-24', 68, 'read');

-- --------------------------------------------------------

--
-- Table structure for table `generate_id`
--

CREATE TABLE `generate_id` (
  `admin_id` varchar(11) NOT NULL,
  `unique_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `generate_id`
--

INSERT INTO `generate_id` (`admin_id`, `unique_id`) VALUES
('567@gmail.c', 'Wi7xQj');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `houseNo` varchar(11) NOT NULL,
  `phoneNo` bigint(11) NOT NULL,
  `password` varchar(45) NOT NULL,
  `images` varchar(45) NOT NULL,
  `usertype` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `email`, `houseNo`, `phoneNo`, `password`, `images`, `usertype`) VALUES
(11, 'Rajeev', '132@gmail.com', 'A20', 7894561234, 'Asdf321#', 'Rajjev.jpeg', 'admin'),
(12, 'Shivendu Bharat', '133@gmail.com', 'A21', 9632587412, 'Nmishra321@', 'shivendu.jpeg', 'admin'),
(13, 'Ramesh', '231@gmail.com', 'S00', 7894861234, 'Rpawar123#', 'Akash-Chourasiya.jpg', 'security');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `houseNo` varchar(255) NOT NULL,
  `phoneNo` bigint(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `houseNo`, `phoneNo`, `password`, `images`) VALUES
('Rahul sharma', '145@gmail.com', '105', 7894861284, 'Aqwer123$', 'suresh.jpeg'),
('Manan', '1456@gmail.com', 'B1', 7894561234, 'Aqwer123#', 'ronit.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `houseNo` varchar(255) NOT NULL,
  `aadharNo` bigint(20) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `designation` varchar(45) NOT NULL,
  `images` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id`, `Name`, `houseNo`, `aadharNo`, `phoneNumber`, `designation`, `images`) VALUES
(37, 'Laukik', '105', 41111565351, '9587456845', 'Cook', 'Laukik.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_visitor`
--
ALTER TABLE `admin_visitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `association_map`
--
ALTER TABLE `association_map`
  ADD KEY `fk_hNo` (`user_hNo`),
  ADD KEY `fk_vNo` (`visitor_id`);

--
-- Indexes for table `dailyrecord`
--
ALTER TABLE `dailyrecord`
  ADD PRIMARY KEY (`Sr.No`);

--
-- Indexes for table `dailyvisit`
--
ALTER TABLE `dailyvisit`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `generate_id`
--
ALTER TABLE `generate_id`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`houseNo`),
  ADD UNIQUE KEY `id` (`username`,`email`,`houseNo`,`phoneNo`,`password`,`images`) USING HASH;

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `houseNo` (`houseNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_visitor`
--
ALTER TABLE `admin_visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dailyrecord`
--
ALTER TABLE `dailyrecord`
  MODIFY `Sr.No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dailyvisit`
--
ALTER TABLE `dailyvisit`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `association_map`
--
ALTER TABLE `association_map`
  ADD CONSTRAINT `fk_hNo` FOREIGN KEY (`user_hNo`) REFERENCES `user` (`houseNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vNo` FOREIGN KEY (`visitor_id`) REFERENCES `visitor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visitor`
--
ALTER TABLE `visitor`
  ADD CONSTRAINT `visitor_ibfk_1` FOREIGN KEY (`houseNo`) REFERENCES `user` (`houseNo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
