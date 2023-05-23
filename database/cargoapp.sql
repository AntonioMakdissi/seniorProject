-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 08:36 PM
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
('hh'),
('potato'),
('still at client'),
('Tripoli'),
('Tripoli2'),
('Tripoli31'),
('Tripoli5'),
('Tripoli589');

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
(9, 23, NULL, 'client2', '71758821', 'client2', NULL, NULL, 'Beirut', '2023-05-23 14:24:53', 0, NULL);

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
(3, NULL, 4, 'still at client', '2023-04-24 08:11:32'),
(4, NULL, 5, 'still at client', '2023-04-24 08:24:39'),
(5, NULL, 6, 'still at client', '2023-04-24 08:40:13'),
(6, NULL, 7, 'still at client', '2023-04-24 08:41:23'),
(7, NULL, 8, 'still at client', '2023-04-24 08:43:42'),
(8, NULL, 9, 'still at client', '2023-04-30 17:00:52'),
(9, NULL, 10, 'still at client', '2023-04-30 17:08:55'),
(10, NULL, 11, 'still at client', '2023-04-30 17:12:08'),
(11, NULL, 12, 'still at client', '2023-04-30 17:30:39'),
(12, NULL, 13, 'still at client', '2023-04-30 17:42:04'),
(13, NULL, 14, 'still at client', '2023-04-30 18:08:56'),
(14, NULL, 15, 'still at client', '2023-04-30 18:10:15'),
(15, NULL, 16, 'still at client', '2023-04-30 18:18:34'),
(29, 11, 4, 'Beirut', '2023-05-13 10:13:02'),
(134, 11, 16, 'Beirut', '2023-05-13 10:17:38'),
(179, 10, 1, 'Batroun', '2023-05-13 10:26:57'),
(180, 14, 1, 'Al Koura', '2023-05-13 10:27:56'),
(181, 10, 1, 'delivered', '2023-05-13 10:29:41'),
(182, 10, 4, 'Batroun', '2023-05-13 10:43:49'),
(183, 14, 17, 'Beirut', '2023-05-15 05:16:38'),
(184, 14, 18, 'Beirut', '2023-05-15 05:17:33'),
(185, NULL, 19, 'still at client', '2023-05-23 16:40:53'),
(186, NULL, 20, 'still at client', '2023-05-23 16:42:37'),
(187, NULL, 21, 'still at client', '2023-05-23 16:45:14'),
(188, NULL, 22, 'still at client', '2023-05-23 16:45:30'),
(189, NULL, 23, 'still at client', '2023-05-23 16:47:16'),
(190, NULL, 24, 'still at client', '2023-05-23 16:48:40'),
(191, NULL, 25, 'still at client', '2023-05-23 16:51:24'),
(192, NULL, 26, 'still at client', '2023-05-23 16:55:45'),
(193, NULL, 27, 'still at client', '2023-05-23 16:56:50'),
(194, NULL, 28, 'still at client', '2023-05-23 16:57:49'),
(195, NULL, 29, 'still at client', '2023-05-23 17:28:01'),
(196, NULL, 30, 'still at client', '2023-05-23 17:37:04'),
(197, NULL, 31, 'still at client', '2023-05-23 17:37:18'),
(198, NULL, 32, 'still at client', '2023-05-23 17:37:39'),
(199, NULL, 33, 'still at client', '2023-05-23 17:39:51'),
(200, NULL, 34, 'still at client', '2023-05-23 17:41:13'),
(201, NULL, 35, 'still at client', '2023-05-23 17:43:29'),
(202, NULL, 36, 'still at client', '2023-05-23 17:43:48'),
(203, NULL, 37, 'still at client', '2023-05-23 17:46:50'),
(204, NULL, 38, 'still at client', '2023-05-23 17:47:42');

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
(1, 1, 2, 'oooo', '2023-05-17 16:53:24'),
(2, 1, 2, 'ewewe', '2023-05-17 16:55:55'),
(3, 1, 1, 'lol', '2023-05-17 17:00:59');

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
(2, 2, 7, 'successful', '2023-04-10 07:59:42', NULL),
(3, 1, 6, 'successful', '2023-04-23 15:14:54', NULL),
(4, 6, 6, 'pending', '2023-04-24 08:11:32', NULL),
(5, 8, 6, 'pending', '2023-04-24 08:24:39', NULL),
(6, 12, 6, 'pending', '2023-04-24 08:40:13', NULL),
(7, 13, 6, 'pending', '2023-04-24 08:41:22', NULL),
(8, 14, 6, 'pending', '2023-04-24 08:43:42', NULL),
(9, 15, 6, 'pending', '2023-04-30 17:00:52', NULL),
(10, 16, 6, 'pending', '2023-04-30 17:08:55', NULL),
(11, 17, 6, 'pending', '2023-04-30 17:12:08', NULL),
(12, 18, 6, 'pending', '2023-04-30 17:30:39', NULL),
(13, 19, 6, 'pending', '2023-04-30 17:42:04', NULL),
(14, 20, 6, 'pending', '2023-04-30 18:08:56', NULL),
(15, 21, 6, 'pending', '2023-04-30 18:10:15', NULL),
(16, 22, 6, 'pending', '2023-04-30 18:18:33', NULL),
(17, 23, 6, 'failed', '2023-05-15 05:16:38', NULL),
(18, 24, 6, 'failed', '2023-05-15 05:17:33', NULL),
(19, 25, 6, 'pending', '2023-05-23 16:40:52', NULL),
(20, 26, 6, 'pending', '2023-05-23 16:42:37', NULL),
(21, 27, 6, 'pending', '2023-05-23 16:45:13', NULL),
(22, 28, 6, 'pending', '2023-05-23 16:45:30', NULL),
(23, 29, 6, 'pending', '2023-05-23 16:47:16', NULL),
(24, 30, 6, 'pending', '2023-05-23 16:48:40', NULL),
(25, 31, 6, 'pending', '2023-05-23 16:51:23', NULL),
(26, 32, 6, 'pending', '2023-05-23 16:55:45', NULL),
(27, 33, 6, 'pending', '2023-05-23 16:56:50', NULL),
(28, 34, 6, 'pending', '2023-05-23 16:57:49', NULL),
(29, 35, 6, 'pending', '2023-05-23 17:28:01', NULL),
(30, 36, 6, 'pending', '2023-05-23 17:37:04', NULL),
(31, 37, 6, 'pending', '2023-05-23 17:37:18', NULL),
(32, 38, 6, 'pending', '2023-05-23 17:37:38', NULL),
(33, 39, 6, 'pending', '2023-05-23 17:39:51', NULL),
(34, 40, 6, 'pending', '2023-05-23 17:41:13', NULL),
(35, 41, 6, 'pending', '2023-05-23 17:43:29', NULL),
(36, 42, 6, 'pending', '2023-05-23 17:43:48', NULL),
(37, 43, 6, 'pending', '2023-05-23 17:46:50', NULL),
(38, 44, 6, 'pending', '2023-05-23 17:47:42', NULL);

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
  `o_price` float NOT NULL DEFAULT 0,
  `cost` float NOT NULL,
  `charge` float NOT NULL DEFAULT 5,
  `f_price` float NOT NULL,
  `pay_at_delivery` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`p_id`, `width`, `height`, `weight`, `message`, `to_name`, `to_phone`, `to_address`, `p_longitude`, `p_latitude`, `to_district`, `fragile`, `o_price`, `cost`, `charge`, `f_price`, `pay_at_delivery`) VALUES
(1, 30, 30, 5, 'to my love', 'friend1', '878787', 'kfaraaka', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 5, 1),
(2, 50, 100, 20, NULL, NULL, NULL, 'kfarsaroun', NULL, NULL, 'Al Koura', 0, 0, 7, 5, 7, 1),
(6, 33, 33, 33, 'p', 'fawz', '33', 'rr', NULL, NULL, 'Akkar', 0, 33.33, 10, 10, 53.33, 0),
(8, 33, 33, 33, 'rr', 'fawze', '33', 'rr', NULL, NULL, 'Beirut', 0, 33.33, 10, 10, 53.33, 0),
(12, 33, 33, 33, 'f', 'fawz', '33', 'rr', NULL, NULL, 'Al Koura', 0, 33.33, 10, 10, 53.33, 0),
(13, 33, 33, 33, 'f4 ggg', 'fawz ff', '33', 'rr', NULL, NULL, 'Al Koura', 0, 33.33, 10, 10, 53.33, 0),
(14, 33, 33, 33, 'f4 ggg', 'fawz ff', '33', 'rr', NULL, NULL, 'Al Koura', 0, 33.33, 10, 10, 53.33, 0),
(15, 33, 33, 33, 'kk', 'fawzp', '33', 'rr', NULL, NULL, 'Al Koura', 0, 33.33, 5, 5, 43.33, 0),
(16, 33, 33, 33, 'hh', 'fawzp', '33', 'rr', NULL, NULL, 'Batroun', 0, 33.33, 5, 5, 43.33, 0),
(17, 33, 33, 33, '', 'fawz', '33', 'rr', NULL, NULL, 'Akkar', 1, 33.33, 10, 10, 53.33, 0),
(18, 33, 33, 33, '', 'fawz', '33', 'rr', NULL, NULL, 'Akkar', 0, 33.33, 5, 5, 43.33, 0),
(19, 33, 33, 33, '', 'fawz', '33', 'rr', NULL, NULL, 'Al Koura', 0, 33.33, 5, 5, 43.33, 0),
(20, 33, 33, 33, '', 'fawz', '33', 'rr', NULL, NULL, 'Beirut', 0, 33.33, 5, 5, 43.33, 0),
(21, 33, 33, 33, '', 'fawz', '33', 'rr', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(22, 33, 33, 33, '', 'fawz', '33', 'rr', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(23, 33, 33, 33, 'you', 'fawzp', '33', 'koura', NULL, NULL, 'Al Koura', 1, 33.33, 10, 10, 53.33, 0),
(24, 33, 33, 33, 'example', 'fawze', '33', 'here', NULL, NULL, 'Beirut', 1, 80, 10, 10, 100, 1),
(25, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(26, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(27, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(28, 33, 33, 33, '', 'fawz', '33', 'rr', NULL, NULL, 'Batroun', 0, 0, 5, 5, 10, 0),
(29, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(30, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(31, 33, 33, 33, '', 'fawz', '33', 'rr', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(32, 33, 33, 33, '', 'fawz', '33', 'rr', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(33, 33, 33, 33, '', 'fawz', '33', 'rr', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(34, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(35, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(36, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(37, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Akkar', 0, 0, 5, 5, 10, 0),
(38, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Akkar', 0, 0, 5, 5, 10, 0),
(39, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(40, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(41, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 10, 0),
(42, 33, 33, 33, '', 'fawz', '33', 'koura', NULL, NULL, 'Batroun', 0, 0, 5, 5, 10, 0),
(43, 33, 33, 33, '', 'fawz', '33', 'rr', NULL, NULL, 'Batroun', 0, 0, 5, 5, 10, 0),
(44, 33, 33, 33, '', 'fawz', '33', 'ffgfg', NULL, NULL, 'Akkar', 0, 0, 5, 5, 10, 0);

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
(21, 'testing@hotmail.com', 'ae2b1fca515949e5d54fb22b8ed95575', 'BranchManager'),
(22, 'worker2@hotmail.com', '01925b7892e2ca194993afdd20a7c761', 'worker'),
(23, 'client2@hotmail.com', '2c66045d4e4a90814ce9280272e510ec', 'client');

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
(1, 1, 'CEO', '71787766', 'Beirut', '1993-04-01', NULL, '2023-04-10 09:13:59'),
(2, 2, 'IT', '71787767', 'Beirut', '1993-04-01', 1000, '2023-04-10 09:15:38'),
(7, 14, 'me', '8888', 'Tripoli', '2023-03-16', 0, '2023-05-01 18:36:16'),
(10, 17, 'BranchManager', '89544848', 'Beirut', '2000-01-01', 5000, '2023-05-03 10:39:08'),
(11, 18, 'worker', '34454545', 'hh', '2023-05-03', 0, '2023-05-03 10:40:40'),
(12, 20, 'BranchManager2', '8888', 'Bekaa', '2023-05-01', 0, '2023-05-17 16:09:36'),
(13, 21, 'testing', '8888', 'Tripoli5', '2023-05-01', 6655.000000000002, '2023-05-17 16:21:56'),
(14, 22, 'worker2', '1000000', 'Bekaa', '2023-05-01', 1000, '2023-05-23 10:42:22');

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
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
