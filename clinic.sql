-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 09:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `service` varchar(500) DEFAULT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `message` varchar(800) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `email`, `phone`, `service`, `date`, `time`, `doctor`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New Usertest', 'test@gmail.com', '8983444338', NULL, '2022-09-23', '01:08', '', NULL, '0', '2022-09-21 13:31:38', '2022-09-23 06:43:49'),
(2, 'Raju Gupta', 'raju@gmail.com', '4444444444', 'Dental', '2022-09-23', '05:31', '3', 'msg', '1', '2022-09-22 13:28:49', '2022-09-22 18:58:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('admin','doctor','patient') DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@clinic.com', '8888888888', '0e7517141fb53f21ee439b355b5a1d0a', 'admin', '1', '2022-09-21 15:30:34', '2022-09-21 17:29:43'),
(2, 'Ram Mishra', 'ramm@gmail.com', '8888888888', 'd41d8cd98f00b204e9800998ecf8427e', 'patient', '1', '2022-09-22 12:43:23', '2022-09-22 18:15:16'),
(3, 'Dr John Doe', 'john@gmail.com', '9999999999', '1f9d9a9efc2f523b2f09629444632b5c', 'doctor', '1', '2022-09-22 13:12:21', '2022-09-22 18:53:09'),
(4, 'Raju Gupta', 'raju@gmail.com', '4444444444', 'd41d8cd98f00b204e9800998ecf8427e', 'patient', '1', '2022-09-22 13:25:55', '2022-09-22 18:56:11'),
(5, 'Dr Deven Shah', 'deven@gmail.com', '1184770760', '6f948f1b428825a3583a550d09bdb4e3', 'doctor', NULL, '2022-09-22 14:11:39', '2022-09-22 19:41:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
