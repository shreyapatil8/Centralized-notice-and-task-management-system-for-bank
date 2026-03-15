-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2026 at 10:30 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contactno` varchar(10) DEFAULT NULL,
  `posting_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `admin`:
--

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `fname`, `lname`, `email`, `contactno`, `posting_date`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'ABC', 'PQR', NULL, '8087053905', NULL),
(2, 'opret', '202cb962ac59075b964b07152d234b70', 'opet', 'user', NULL, '9876543210', NULL),
(3, 'pp@gmail.com', '202cb962ac59075b964b07152d234b70', 'Prakash', 'Patil', 'pp@gmail.com', '7020211701', '2026-02-07 10:23:24');

-- --------------------------------------------------------

--
-- Table structure for table `photo_event`
--

CREATE TABLE `photo_event` (
  `idphoto_event` int(11) NOT NULL,
  `pe_title` varchar(255) NOT NULL,
  `pe_description` text DEFAULT NULL,
  `pe_visible` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `photo_event`:
--

--
-- Dumping data for table `photo_event`
--

INSERT INTO `photo_event` (`idphoto_event`, `pe_title`, `pe_description`, `pe_visible`) VALUES
(23, 'test', 'test', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_event`
--
ALTER TABLE `photo_event`
  ADD PRIMARY KEY (`idphoto_event`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photo_event`
--
ALTER TABLE `photo_event`
  MODIFY `idphoto_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
