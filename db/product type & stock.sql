-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 03:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_type_tbl`
--

CREATE TABLE `product_type_tbl` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type_tbl`
--

INSERT INTO `product_type_tbl` (`id`, `pro_id`, `name`, `status`, `created_at`) VALUES
(1, 3, '3D class', 'Active', '2024-10-20 17:56:27'),
(2, 2, 'Mat class', 'Active', '2024-10-20 17:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `stock_tbl`
--

CREATE TABLE `stock_tbl` (
  `stock_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `place` enum('A','B','C') NOT NULL,
  `emi_no` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `upated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `stock_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_tbl`
--

INSERT INTO `stock_tbl` (`stock_id`, `brand_id`, `product_id`, `model_id`, `product_type_id`, `product_price`, `product_quantity`, `place`, `emi_no`, `created_at`, `upated_at`, `stock_status`) VALUES
(1, 1, 3, 2, 0, 150, 10, 'A', '', '2024-10-20 17:32:57', '2024-10-20 12:02:57', 'Active'),
(2, 3, 4, 3, 0, 400, 5, 'A', '', '2024-10-20 17:43:45', '2024-10-20 12:13:45', 'Active'),
(3, 3, 3, 3, 1, 200, 2, 'B', '', '2024-10-20 18:11:36', '2024-10-20 12:41:36', 'Active'),
(4, 3, 2, 3, 2, 150, 4, 'B', '', '2024-10-20 18:31:25', '2024-10-20 13:01:25', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_type_tbl`
--
ALTER TABLE `product_type_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_tbl`
--
ALTER TABLE `stock_tbl`
  ADD PRIMARY KEY (`stock_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_type_tbl`
--
ALTER TABLE `product_type_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_tbl`
--
ALTER TABLE `stock_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
