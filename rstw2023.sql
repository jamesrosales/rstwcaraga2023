-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2023 at 05:21 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pnhrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `qrcode` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `password`, `name`) VALUES
(1, 'admin', 'f3ba381b6baef526bf70ff220b1da4906989224b', 'Ryan Neil Abina\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `event_id` int(11) NOT NULL,
  `event_name` text NOT NULL,
  `event_date` date DEFAULT NULL,
  `maximum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`event_id`, `event_name`, `event_date`, `maximum`) VALUES
(18, 'Main Conference (Aug 11) - Plenary Session 2: Developing Sustainable Solutions through Research and Innovation for Health', '2023-08-11', 450);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`role_id`, `role_name`) VALUES
(1, 'Participant'),
(2, 'VIP'),
(3, 'Organizer'),
(4, 'Resource Speaker'),
(5, 'DOST Official'),
(6, 'Photographer'),
(7, 'Documentor'),
(8, 'Medical Team');

-- --------------------------------------------------------

--
-- Table structure for table `usr_table`
--

CREATE TABLE `usr_table` (
  `usr_id` int(50) NOT NULL,
  `usr_fname` varchar(200) NOT NULL,
  `usr_mname` varchar(200) NOT NULL,
  `usr_lname` varchar(200) NOT NULL,
  `usr_role` int(11) NOT NULL,
  `usr_suffix` varchar(10) NOT NULL,
  `usr_email` varchar(200) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `usr_gender` varchar(200) NOT NULL,
  `usr_contact` varchar(20) NOT NULL,
  `usr_occupation` varchar(200) NOT NULL,
  `usr_institution` varchar(100) NOT NULL,
  `usr_municipality` varchar(200) NOT NULL,
  `date_created` date NOT NULL,
  `usr_sector` varchar(300) NOT NULL,
  `usr_sector_other` varchar(60) NOT NULL,
  `usr_cluster` varchar(30) NOT NULL,
  `qrcode` text NOT NULL,
  `event_id` varchar(150) NOT NULL,
  `event_approved_id` text NOT NULL,
  `added_to_local` int(11) NOT NULL,
  `approval_status` int(11) NOT NULL,
  `number_of_email` int(11) NOT NULL,
  `move_to_pending_status` int(11) NOT NULL,
  `idcard_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `usr_table`
--
ALTER TABLE `usr_table`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usr_table`
--
ALTER TABLE `usr_table`
  MODIFY `usr_id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
