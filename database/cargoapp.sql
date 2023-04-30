-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 08:47 AM
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
('delivered'),
('still at client');

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
(6, 8, NULL, 'test01', 'test01', 'test01', NULL, NULL, 'Batroun', '2023-03-31 12:18:06', 0, 4),
(7, 9, NULL, 'zaher', 'zaher', 'zaher', NULL, NULL, 'Batroun', '2023-04-03 06:04:07', 0, 4),
(8, 10, NULL, 'client', '555', 'client', NULL, NULL, 'Akkar', '2023-04-23 13:49:36', 0, 4);

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
(2, 3, 1, 'Beirut', '2023-04-18 07:19:56'),
(3, NULL, 4, 'still at client', '2023-04-24 08:11:32'),
(4, NULL, 5, 'still at client', '2023-04-24 08:24:39'),
(5, NULL, 6, 'still at client', '2023-04-24 08:40:13'),
(6, NULL, 7, 'still at client', '2023-04-24 08:41:23'),
(7, NULL, 8, 'still at client', '2023-04-24 08:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `m_id` int(11) NOT NULL,
  `send_id` int(11) NOT NULL,
  `receive_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `status` enum('successful','pending','failed','') NOT NULL DEFAULT 'pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `p_id`, `c_id`, `status`, `date`) VALUES
(1, 1, 6, 'pending', '2023-04-10 07:17:10'),
(2, 2, 7, 'successful', '2023-04-10 07:59:42'),
(3, 1, 6, 'pending', '2023-04-23 15:14:54'),
(4, 6, 6, 'pending', '2023-04-24 08:11:32'),
(5, 8, 6, 'pending', '2023-04-24 08:24:39'),
(6, 12, 6, 'pending', '2023-04-24 08:40:13'),
(7, 13, 6, 'pending', '2023-04-24 08:41:22'),
(8, 14, 6, 'pending', '2023-04-24 08:43:42');

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
(1, 30, 30, 5, 'to my love', NULL, NULL, 'kfaraaka', NULL, NULL, 'Al Koura', 0, 0, 5, 5, 5, 1),
(2, 50, 100, 20, NULL, NULL, NULL, 'kfarsaroun', NULL, NULL, 'Al Koura', 0, 0, 7, 5, 7, 1),
(6, 33, 33, 33, 'p', 'fawz', '33', 'rr', NULL, NULL, 'Akkar', 0, 33.33, 10, 10, 53.33, 0),
(8, 33, 33, 33, 'rr', 'fawze', '33', 'rr', NULL, NULL, 'Beirut', 0, 33.33, 10, 10, 53.33, 0),
(12, 33, 33, 33, 'f', 'fawz', '33', 'rr', NULL, NULL, 'Al Koura', 0, 33.33, 10, 10, 53.33, 0),
(13, 33, 33, 33, 'f4 ggg', 'fawz ff', '33', 'rr', NULL, NULL, 'Al Koura', 0, 33.33, 10, 10, 53.33, 0),
(14, 33, 33, 33, 'f4 ggg', 'fawz ff', '33', 'rr', NULL, NULL, 'Al Koura', 0, 33.33, 10, 10, 53.33, 0);

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
(3, 'worker1@hotmail.com', 'ebad64149cc767ba26ef069819279fd5', 'worker'),
(8, 'test01@wow', '0e698a8ffc1a0af622c7b4db3cb750cc', 'client'),
(9, 'zaher@hotmail.com', '2a4e7d2de385a10968b001de2bc66adf', 'client'),
(10, 'client@client.com', '62608e08adc29a8d6dbc9754e659f125', 'client');

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
(3, 3, 'worker1', '3543345', 'Beirut', '1993-04-01', 1000, '2023-04-12 16:25:08');

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
  ADD KEY `send_id` (`send_id`),
  ADD KEY `receive_id` (`receive_id`);

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
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`send_id`) REFERENCES `workers` (`w_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receive_id`) REFERENCES `workers` (`w_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
