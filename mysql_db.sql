-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2020 at 02:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jewellers_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`) VALUES
(1, 'head', 'surat'),
(3, 'bhagal_sub', 'bhagal');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'bracelet'),
(2, 'chain'),
(3, 'ear ring'),
(5, 'pendent'),
(6, 'pendent set'),
(8, 'ring'),
(10, 'long set');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `user_name`, `email`, `password`) VALUES
(1, 'root', 'root123', 'root@gmail.com', '9e3d66f92822103d2f91843736af98b8'),
(2, 'Rudra Soni', 'rudra123', 'rudra@gmail.com', '05fbeaaee1ec9eec822d96ddb16873b5');

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `id` int(12) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email_from` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mails`
--

INSERT INTO `mails` (`id`, `name`, `email_from`, `subject`, `message`) VALUES
(1, 'tesst', 'sonirdr06@gmail.com', 'test', 'test msg'),
(2, 'asdfghjkl', 'hiral@siliconbrix.com', 'viva', 'mail via php'),
(3, 'rudra', 'parmarhiral481@gmail.com', 'viva', 'mail via php for viva'),
(4, 'rudra', 'sonirdr06@gmail.com', 'html', 'test'),
(5, 'krtn', 'kirtanpatelx@gmail.com', 'php mail with HTML markup.', 'hi'),
(6, 'rudrs', 'rudrasoni2000@gmail.com', 'tet', 'duyt'),
(7, 'ucnewkcu', 'rudrasoni2000@gmail.com', 'ciem', 'ncdece'),
(8, 'ewwc', 'rudrasoni2000@gmail.com', 'fver', 'ersdcf'),
(9, 'clsf', 'rudrasoni2000@gmail.com', 'cecdcw', 'fvsecer'),
(10, 'ceur', 'rudrasoni2000@gmail.com', 'dcad', 'ervrec'),
(11, 'ceur', 'rudrasoni2000@gmail.com', 'dcad', 'ervrec'),
(12, 'qqqq', 'rudrasoni2000@gmail.com', 'noind', 'biuiniu'),
(13, 'cscddsrf', 'rudrasoni2000@gmail.com', 'bsfbgr', 'ntrgbfsrd');

-- --------------------------------------------------------

--
-- Table structure for table `mfg_workers`
--

CREATE TABLE `mfg_workers` (
  `id` int(11) NOT NULL,
  `worker_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mfg_workers`
--

INSERT INTO `mfg_workers` (`id`, `worker_name`) VALUES
(1, 'arjun'),
(2, 'abhijeet');

-- --------------------------------------------------------

--
-- Table structure for table `mfg_work_reciept`
--

CREATE TABLE `mfg_work_reciept` (
  `id` int(11) NOT NULL,
  `reciept_no` varchar(250) NOT NULL,
  `worker` varchar(250) NOT NULL,
  `customer_order` varchar(250) NOT NULL,
  `prd_category` varchar(250) NOT NULL,
  `prd_metal` varchar(250) NOT NULL,
  `prd_quality` varchar(250) NOT NULL,
  `prd_weight` float NOT NULL,
  `gvn_material_type` varchar(250) NOT NULL,
  `gvn_material_quality` varchar(250) NOT NULL,
  `gvn_material_weight` float NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deadline_date` varchar(250) NOT NULL,
  `completion_date` timestamp NULL DEFAULT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mfg_work_reciept`
--

INSERT INTO `mfg_work_reciept` (`id`, `reciept_no`, `worker`, `customer_order`, `prd_category`, `prd_metal`, `prd_quality`, `prd_weight`, `gvn_material_type`, `gvn_material_quality`, `gvn_material_weight`, `start_date`, `deadline_date`, `completion_date`, `status`) VALUES
(1, '0000000001', '1', 'no', '1', 'gold', '20k', 11, 'gold', '24k', 16, '2020-09-05 18:30:00', '2020-09-13', NULL, 'in work');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(250) NOT NULL,
  `metal` varchar(250) NOT NULL,
  `category_id` varchar(250) NOT NULL,
  `branch_id` varchar(250) NOT NULL,
  `weight` float NOT NULL,
  `labour` int(250) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `metal`, `category_id`, `branch_id`, `weight`, `labour`, `price`) VALUES
(10, 'GLS0001', 'gold', '10', '3', 120.98, 50500, 1200000),
(11, 'SLBRC89', 'silver', '1', '1', 85, 1200, 2340),
(12, 'SLPSET0011', 'silver', '6', '1', 22, 2200, 4444),
(14, 'GER0012', 'gold', '3', '1', 2, 564, 9798),
(15, 'GR0012', 'gold', '8', '1', 12.4, 2313, 4123);

-- --------------------------------------------------------

--
-- Table structure for table `superuser`
--

CREATE TABLE `superuser` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superuser`
--

INSERT INTO `superuser` (`id`, `name`, `user_name`, `email`, `password`) VALUES
(1, 'superuser', 'super123', 'su@gmail.com', 'super123@@');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`user_name`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mfg_workers`
--
ALTER TABLE `mfg_workers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mfg_work_reciept`
--
ALTER TABLE `mfg_work_reciept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superuser`
--
ALTER TABLE `superuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mfg_workers`
--
ALTER TABLE `mfg_workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mfg_work_reciept`
--
ALTER TABLE `mfg_work_reciept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `superuser`
--
ALTER TABLE `superuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
