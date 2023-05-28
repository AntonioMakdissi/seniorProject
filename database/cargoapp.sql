-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 06:06 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cargoapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch`) VALUES
('Akkar'),
('Al Koura'),
('Batroun'),
('Beirut'),
('Bekaa'),
('delivered'),
('still at client'),
('Tripoli'),
('Tripoli2');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `c_id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `pay_id` int(11) DEFAULT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_phone` varchar(30) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `c_longitude` decimal(11,8) DEFAULT NULL,
  `c_latitude` decimal(10,8) DEFAULT NULL,
  `c_district` varchar(255) NOT NULL,
  `c_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `guest` tinyint(1) NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`c_id`, `u_id`, `pay_id`, `c_name`, `c_phone`, `c_address`, `c_longitude`, `c_latitude`, `c_district`, `c_timestamp`, `guest`, `rating`) VALUES
(6, 8, NULL, 'test01', 'test01', 'test01', NULL, NULL, 'Beirut', '2023-03-31 12:18:06', 0, 5),
(7, 9, NULL, 'zaher', 'zaher', 'zaher', NULL, NULL, 'Batroun', '2023-04-03 06:04:07', 0, 4),
(8, 10, NULL, 'client', '555', 'client', NULL, NULL, 'Akkar', '2023-04-23 13:49:36', 0, 4),
(9, 23, NULL, 'client2', '71758821', 'client2', NULL, NULL, 'Beirut', '2023-05-23 14:24:53', 0, NULL),
(10, NULL, NULL, 'example1', '22222', 'example1', NULL, NULL, 'Beirut', '2023-05-26 07:47:08', 1, NULL),
(11, NULL, NULL, 'tryc', '22222333', 'tryf', NULL, NULL, 'Bekaa', '2023-05-27 09:45:30', 1, NULL),
(12, NULL, NULL, 'Johnny', '70191716', 'kfaraaka', NULL, NULL, 'Al Koura', '2023-05-28 09:59:41', 1, NULL),
(13, NULL, NULL, 'Johnny', '70191716', 'menyra', NULL, NULL, 'Akkar', '2023-05-28 10:11:45', 1, NULL),
(14, NULL, NULL, 'Johnny', '70191716', 'kfaraaka', NULL, NULL, 'Tripoli2', '2023-05-28 10:44:42', 1, NULL),
(15, NULL, NULL, 'Johnny', '22222333', 'example1', NULL, NULL, 'Akkar', '2023-05-28 10:50:23', 1, NULL),
(16, 34, NULL, 'Antonio Al Makdissi', '88218282', 'kfaraaka', NULL, NULL, 'Al Koura', '2023-05-28 11:40:18', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `d_id` int(11) NOT NULL,
  `w_id` int(11) DEFAULT NULL,
  `o_id` int(11) DEFAULT NULL,
  `current_location` varchar(100) NOT NULL DEFAULT 'still at client',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`d_id`, `w_id`, `o_id`, `current_location`, `timestamp`) VALUES
(1, NULL, 1, 'still at client', '2023-04-10 08:07:13'),
(2, 11, 1, 'Beirut', '2023-04-18 07:19:56'),
(179, 10, 1, 'Batroun', '2023-05-13 10:26:57'),
(180, 14, 1, 'Al Koura', '2023-05-13 10:27:56'),
(181, 10, 1, 'delivered', '2023-05-13 10:29:41'),
(183, 14, 17, 'Beirut', '2023-05-15 05:16:38'),
(184, 14, 18, 'Beirut', '2023-05-15 05:17:33'),
(185, NULL, 19, 'still at client', '2023-05-23 16:40:53'),
(186, NULL, 20, 'still at client', '2023-05-23 16:42:37'),
(187, NULL, 21, 'still at client', '2023-05-23 16:45:14'),
(189, NULL, 23, 'still at client', '2023-05-23 16:47:16'),
(190, NULL, 24, 'still at client', '2023-05-23 16:48:40'),
(194, NULL, 28, 'still at client', '2023-05-23 16:57:49'),
(195, NULL, 29, 'still at client', '2023-05-23 17:28:01'),
(196, NULL, 30, 'still at client', '2023-05-23 17:37:04'),
(197, NULL, 31, 'still at client', '2023-05-23 17:37:18'),
(198, NULL, 32, 'still at client', '2023-05-23 17:37:39'),
(199, NULL, 33, 'still at client', '2023-05-23 17:39:51'),
(200, NULL, 34, 'still at client', '2023-05-23 17:41:13'),
(201, NULL, 35, 'still at client', '2023-05-23 17:43:29'),
(202, NULL, 36, 'still at client', '2023-05-23 17:43:48'),
(206, NULL, 39, 'still at client', '2023-05-26 07:47:08'),
(207, NULL, 40, 'still at client', '2023-05-26 11:14:22'),
(208, NULL, 41, 'still at client', '2023-05-26 12:11:11'),
(210, NULL, 42, 'still at client', '2023-05-26 18:35:39'),
(211, NULL, 43, 'still at client', '2023-05-26 18:36:57'),
(212, NULL, 44, 'still at client', '2023-05-26 18:37:12'),
(213, NULL, 45, 'still at client', '2023-05-26 18:37:33'),
(214, NULL, 46, 'still at client', '2023-05-26 18:38:00'),
(215, NULL, 47, 'still at client', '2023-05-26 18:38:48'),
(216, NULL, 48, 'still at client', '2023-05-26 18:40:24'),
(217, NULL, 49, 'still at client', '2023-05-26 18:41:28'),
(218, NULL, 50, 'still at client', '2023-05-26 19:05:30'),
(219, NULL, 51, 'still at client', '2023-05-27 09:45:30'),
(231, NULL, 63, 'still at client', '2023-05-28 11:42:10'),
(232, NULL, 64, 'still at client', '2023-05-28 11:45:33'),
(233, NULL, 65, 'still at client', '2023-05-28 11:48:47'),
(234, NULL, 66, 'still at client', '2023-05-28 11:52:39'),
(236, 22, 64, 'Al Koura', '2023-05-28 12:00:05'),
(237, 22, 64, 'Batroun', '2023-05-28 12:00:21'),
(238, 14, 64, 'Beirut', '2023-05-28 12:00:56'),
(239, 11, 64, 'delivered', '2023-05-28 12:01:17'),
(240, NULL, 67, 'still at client', '2023-05-28 12:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `m_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `receive_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `m_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`m_id`, `u_id`, `receive_id`, `message`, `m_timestamp`) VALUES
(1, 1, 2, 'Message from CEO', '2023-05-17 16:53:24'),
(2, 1, 2, 'Message from CEO 2', '2023-05-17 16:55:55'),
(3, 1, 17, 'Message from CEO', '2023-05-17 17:00:59'),
(6, 2, 1, 'Message from IT', '2023-05-27 17:31:54'),
(8, 2, 1, 'Message from IT 2', '2023-05-27 17:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `status` enum('successful','pending','failed','') NOT NULL DEFAULT 'pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `pic` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `p_id`, `c_id`, `status`, `date`, `pic`) VALUES
(1, 1, 6, 'successful', '2023-04-10 07:17:10', NULL),
(17, 23, 6, 'failed', '2023-05-15 05:16:38', NULL),
(18, 24, 6, 'failed', '2023-05-15 05:17:33', NULL),
(19, 25, 6, 'pending', '2023-05-23 16:40:52', NULL),
(20, 26, 6, 'pending', '2023-05-23 16:42:37', NULL),
(21, 27, 6, 'pending', '2023-05-23 16:45:13', NULL),
(23, 29, 6, 'pending', '2023-05-23 16:47:16', NULL),
(24, 30, 6, 'pending', '2023-05-23 16:48:40', NULL),
(28, 34, 6, 'pending', '2023-05-23 16:57:49', NULL),
(29, 35, 6, 'pending', '2023-05-23 17:28:01', NULL),
(30, 36, 6, 'pending', '2023-05-23 17:37:04', NULL),
(31, 37, 6, 'pending', '2023-05-23 17:37:18', NULL),
(32, 38, 6, 'pending', '2023-05-23 17:37:38', NULL),
(33, 39, 6, 'pending', '2023-05-23 17:39:51', NULL),
(34, 40, 6, 'pending', '2023-05-23 17:41:13', NULL),
(35, 41, 6, 'pending', '2023-05-23 17:43:29', NULL),
(36, 42, 6, 'pending', '2023-05-23 17:43:48', NULL),
(39, 45, 10, 'pending', '2023-05-26 07:47:08', NULL),
(40, 46, 6, 'pending', '2023-05-26 11:14:22', NULL),
(41, 47, 6, 'pending', '2023-05-26 12:11:11', NULL),
(42, 48, 6, 'pending', '2023-05-26 18:35:39', NULL),
(43, 49, 6, 'pending', '2023-05-26 18:36:57', NULL),
(44, 50, 6, 'pending', '2023-05-26 18:37:12', NULL),
(45, 51, 6, 'pending', '2023-05-26 18:37:33', NULL),
(46, 52, 6, 'pending', '2023-05-26 18:38:00', NULL),
(47, 53, 6, 'pending', '2023-05-26 18:38:47', NULL),
(48, 54, 6, 'pending', '2023-05-26 18:40:24', NULL),
(49, 55, 6, 'pending', '2023-05-26 18:41:28', NULL),
(50, 56, 6, 'pending', '2023-05-26 19:05:29', NULL),
(51, 57, 11, 'pending', '2023-05-27 09:45:30', NULL),
(63, 69, 16, 'failed', '2023-05-28 11:42:10', NULL),
(64, 70, 16, 'successful', '2023-05-28 11:45:33', NULL),
(65, 71, 16, 'pending', '2023-05-28 11:48:46', NULL),
(66, 72, 16, 'pending', '2023-05-28 11:52:39', NULL),
(67, 73, 16, 'pending', '2023-05-28 12:49:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `p_id` int(11) NOT NULL,
  `width` float NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `message` text DEFAULT NULL,
  `to_name` varchar(255) DEFAULT NULL,
  `to_phone` varchar(100) DEFAULT NULL,
  `to_address` varchar(255) NOT NULL,
  `p_longitude` decimal(11,8) DEFAULT NULL,
  `p_latitude` decimal(10,8) DEFAULT NULL,
  `to_district` varchar(255) NOT NULL,
  `fragile` tinyint(1) NOT NULL DEFAULT 0,
  `urgent` tinyint(1) NOT NULL DEFAULT 0,
  `sender_pays` tinyint(1) NOT NULL DEFAULT 1,
  `o_price` float NOT NULL DEFAULT 0,
  `cost` float NOT NULL,
  `charge` float NOT NULL DEFAULT 5,
  `f_price` float NOT NULL,
  `pay_at_delivery` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`p_id`, `width`, `height`, `weight`, `message`, `to_name`, `to_phone`, `to_address`, `p_longitude`, `p_latitude`, `to_district`, `fragile`, `urgent`, `sender_pays`, `o_price`, `cost`, `charge`, `f_price`, `pay_at_delivery`) VALUES
(1, 30, 30, 5, 'to my love', 'friend1', '878787', 'kfaraaka', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 5, 1),
(23, 33, 33, 33, 'you', 'fawzp', '33', 'koura', NULL, NULL, 'Al Koura', 1, 0, 1, 33.33, 10, 10, 53.33, 0),
(24, 33, 33, 33, 'example', 'fawze', '33', 'here', NULL, NULL, 'Beirut', 1, 0, 1, 80, 10, 10, 100, 1),
(25, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 0),
(26, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 0),
(27, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 0),
(29, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 0),
(30, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 0),
(34, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 0),
(35, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 0),
(36, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 0),
(37, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 0),
(38, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 0),
(39, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 0),
(40, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 0),
(41, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 0),
(42, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Batroun', 0, 0, 1, 0, 5, 5, 10, 0),
(45, 33, 33, 33, '', 'example2', '333333', 'example2', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 1),
(46, 33, 33, 33, '', 'example2', '333333', 'example2', NULL, NULL, 'Al Koura', 0, 0, 0, 0, 5, 5, 10, 0),
(47, 33, 33, 33, '', 'example3', '71827262', 'example3', NULL, NULL, 'Tripoli', 1, 1, 1, 0, 10, 10, 20, 0),
(48, 33, 33, 33, '', 'noti', '71827262', 'noti', NULL, NULL, 'Tripoli2', 0, 1, 1, 0, 5, 5, 10, 0),
(49, 33, 33, 33, '', 'noti', '71827262', 'noti', NULL, NULL, 'Tripoli2', 0, 1, 1, 0, 5, 5, 10, 0),
(50, 33, 33, 33, '', 'noti', '71827262', 'noti', NULL, NULL, 'Tripoli2', 0, 1, 1, 0, 5, 5, 10, 0),
(51, 33, 33, 33, '', 'example3', '333333', 'noti', NULL, NULL, 'Tripoli', 0, 1, 1, 0, 5, 5, 10, 0),
(52, 33, 33, 33, '', 'example3', '333333', 'noti', NULL, NULL, 'Tripoli', 0, 1, 1, 0, 5, 5, 10, 0),
(53, 33, 33, 33, '', 'noti2', '71827262', 'noti2', NULL, NULL, 'Batroun', 0, 0, 1, 0, 5, 5, 10, 0),
(54, 33, 33, 33, '', 'fawzp', '333333', 'rr', NULL, NULL, 'Beirut', 0, 1, 1, 0, 5, 5, 10, 0),
(55, 33, 33, 33, '', 'example2', '71827262', 'koura', NULL, NULL, 'Al Koura', 0, 1, 1, 0, 5, 5, 10, 0),
(56, 33, 33, 33, '', 'fawze', '33', 'example3', NULL, NULL, 'Batroun', 0, 1, 1, 0, 5, 5, 10, 0),
(57, 33, 33, 33, '', 'tryc', '888222', 'tryc', NULL, NULL, 'Al Koura', 0, 1, 1, 0, 15, 15, 30, 0),
(58, 50, 75, 3, '', 'Fawzy', '71827262', 'kfaraaka', NULL, NULL, 'Al Koura', 0, 0, 1, 0, 5, 5, 10, 1),
(59, 50, 75, 3, '', 'Fawzy', '71827262', 'Menyara', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 1),
(60, 50, 75, 3, '', 'Fawzy', '71827262', 'Menyara', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 1),
(61, 50, 75, 3, '', 'Fawzy', '71827262', 'Menyara', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 1),
(62, 50, 75, 3, '', 'Fawzy', '71827262', 'Menyara', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 1),
(63, 50, 75, 3, '', 'Fawzy', '71827262', 'Menyara', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 1),
(64, 33, 75, 3, '', 'fawze', '71827262', 'koura', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 1),
(65, 33, 75, 3, '', 'fawze', '71827262', 'koura', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 1),
(66, 33, 75, 3, '', 'fawze', '71827262', 'koura', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 1),
(67, 33, 75, 3, '', 'Fawzy', '71827262', 'Menyara', NULL, NULL, 'Bekaa', 0, 0, 1, 0, 5, 5, 10, 1),
(68, 50, 75, 3, '', 'Fawzy', '71827262', 'Menyara', NULL, NULL, 'Akkar', 0, 0, 1, 0, 5, 5, 10, 1),
(69, 50, 75, 3, 'Very fragile. Be very careful.', 'Aafif', '71827262', 'Menyara', NULL, NULL, 'Akkar', 1, 0, 1, 0, 10, 10, 20, 1),
(70, 40, 20, 2, '', 'Amir', '70287557', 'hamra', NULL, NULL, 'Beirut', 0, 1, 0, 0, 5, 5, 10, 0),
(71, 50, 75, 33, 'very heavy', 'Gemma', '71827262', 'example', NULL, NULL, 'Bekaa', 1, 1, 0, 0, 10, 10, 20, 1),
(72, 75, 44, 10, '', 'adel', '89237564', 'there', NULL, NULL, 'Batroun', 0, 0, 1, 0, 5, 5, 10, 1),
(73, 75, 75, 75, '', 'Adib', '89237564', 'ashrafiyeh', NULL, NULL, 'Beirut', 1, 1, 1, 0, 20, 20, 40, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `card_numb` varchar(50) NOT NULL,
  `exp_date` date NOT NULL,
  `cvv` int(11) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `privilege` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`privilege`) VALUES
('BranchManager'),
('CEO'),
('client'),
('IT'),
('worker');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `o_id` int(11) DEFAULT NULL,
  `w_id` int(11) DEFAULT NULL,
  `deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `email`, `password`, `type`) VALUES
(1, 'CEO@hotmail.com', '858904c3e266f5640bfa88f16d2ed50a', 'CEO'),
(2, 'IT@hotmail.com', 'cd32106bcb6de321930cf34574ea388c', 'IT'),
(8, 'test01@wow', '0e698a8ffc1a0af622c7b4db3cb750cc', 'client'),
(9, 'zaher@hotmail.com', '2a4e7d2de385a10968b001de2bc66adf', 'client'),
(10, 'client@client.com', '62608e08adc29a8d6dbc9754e659f125', 'client'),
(14, 'me@hotmail.com', 'ab86a1e1ef70dff97959067b723c5c24', 'worker'),
(17, 'BranchManager@hotmail.com', '700a7ee3dcca1310355fd89585df38f0', 'BranchManager'),
(18, 'worker@hotmail.com', 'b61822e8357dcaff77eaaccf348d9134', 'worker'),
(20, 'BranchManager2@hotmail.com', '8e3eaafc6025f49dee8625a9e81960bb', 'BranchManager'),
(22, 'worker2@hotmail.com', '01925b7892e2ca194993afdd20a7c761', 'worker'),
(23, 'client2@hotmail.com', '2c66045d4e4a90814ce9280272e510ec', 'client'),
(24, 'karimm@gmail.com', '51467d5f95285c46f9dba677e991885b', 'worker'),
(25, 'omarh@hotmail.com', 'a56ba081cb30c9f2f921f6ee905637aa', 'worker'),
(26, 'BranchManagerT@hotmail.com', '33ee1df796ac28f735006aa731f9ee9a', 'BranchManager'),
(27, 'BranchManagerT2@hotmail.com', 'ae8880b56dd0ba2ceabfcbad40c9c707', 'BranchManager'),
(28, 'BranchManagerA@hotmail.com', '6f92164bca736b1e92227cac6060cd24', 'BranchManager'),
(29, 'BranchManagerK@hotmail.com', '14060d25150307b135b5351861809986', 'BranchManager'),
(30, 'BranchManagerBa@hotmail.com', 'e1aeb9dc4537229a8598f8fa48dfb14c', 'BranchManager'),
(31, 'workerK@hotmail.com', 'b126ec4deda4f977298d078a5c237d23', 'worker'),
(32, 'workerBek@hotmail.com', '8467d10d9d69b381cfb51f9e07028805', 'worker'),
(33, 'workerT@hotmail.com', 'bb2e11cede0e0505b905ca0065576b09', 'worker'),
(34, 'antoniomakdissi@hotmail.com', 'afc9af118f85465e52b7590d8020eee3', 'client');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `w_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `salary` double DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`w_id`, `u_id`, `name`, `phone`, `branch`, `dateOfBirth`, `salary`, `timestamp`) VALUES
(1, 1, 'CEO', '71787766', 'Beirut', '1993-04-01', 10000, '2023-04-10 09:13:59'),
(2, 2, 'IT', '71787767', 'Beirut', '1993-04-01', 1000, '2023-04-10 09:15:38'),
(7, 14, 'me', '8888', 'Akkar', '2023-03-16', 3000, '2023-05-01 18:36:16'),
(10, 17, 'BranchManager', '89544848', 'Beirut', '2000-01-01', 5000, '2023-05-03 10:39:08'),
(11, 18, 'worker', '34454545', 'Beirut', '2023-05-03', 1000, '2023-05-03 10:40:40'),
(12, 20, 'BranchManager2', '8888', 'Bekaa', '2023-05-01', 1500, '2023-05-17 16:09:36'),
(14, 22, 'worker2', '1000000', 'Batroun', '2023-05-01', 1210, '2023-05-23 10:42:22'),
(15, 24, 'Karim M', '8122827', 'Al Koura', '1998-12-29', 1000, '2023-05-28 11:07:53'),
(16, 25, 'Omar Halabi', '92838383', 'Tripoli2', '1969-07-23', 1000, '2023-05-28 11:10:11'),
(17, 26, 'BranchManagerT', '90120921', 'Tripoli', '1996-06-13', 3000, '2023-05-28 11:12:12'),
(18, 27, 'BranchManagerT2', '90120921', 'Tripoli2', '1996-06-13', 3000, '2023-05-28 11:12:21'),
(19, 28, 'BranchManagerA', '90120921', 'Akkar', '1996-06-13', 3000, '2023-05-28 11:12:40'),
(20, 29, 'BranchManagerK', '90120921', 'Al Koura', '1996-06-13', 3000, '2023-05-28 11:13:03'),
(21, 30, 'BranchManagerBa', '90120921', 'Batroun', '1996-06-13', 3000, '2023-05-28 11:13:22'),
(22, 31, 'workerK', '72626583', 'Al Koura', '1989-10-11', 1000, '2023-05-28 11:17:46'),
(23, 32, 'workerBek', '72626583', 'Bekaa', '1989-10-11', 1000, '2023-05-28 11:18:00'),
(24, 33, 'workerT', '72626583', 'Tripoli', '1989-10-11', 1000, '2023-05-28 11:18:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `c_district` (`c_district`),
  ADD KEY `pay_id` (`pay_id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `w_id` (`w_id`),
  ADD KEY `o_id` (`o_id`),
  ADD KEY `current_location` (`current_location`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `messages_ibfk_1` (`u_id`),
  ADD KEY `messages_ibfk_2` (`receive_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `to_district` (`to_district`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`privilege`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD KEY `o_id` (`o_id`),
  ADD KEY `w_id` (`w_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `users_ibfk_1` (`type`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`w_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `branch` (`branch`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`c_district`) REFERENCES `branches` (`branch`) ON UPDATE CASCADE,
  ADD CONSTRAINT `clients_ibfk_3` FOREIGN KEY (`pay_id`) REFERENCES `payment` (`pay_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`w_id`) REFERENCES `workers` (`w_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `deliveries_ibfk_2` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `deliveries_ibfk_3` FOREIGN KEY (`current_location`) REFERENCES `branches` (`branch`) ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receive_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `clients` (`c_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `packages` (`p_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`to_district`) REFERENCES `branches` (`branch`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`w_id`) REFERENCES `workers` (`w_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type`) REFERENCES `privileges` (`privilege`) ON UPDATE CASCADE;

--
-- Constraints for table `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `workers_ibfk_2` FOREIGN KEY (`branch`) REFERENCES `branches` (`branch`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
