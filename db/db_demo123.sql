-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 11:10 AM
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
-- Database: `db_demo123`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand_tbl`
--

CREATE TABLE `brand_tbl` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `brand_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_tbl`
--

CREATE TABLE `invoice_tbl` (
  `invoice_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(10) NOT NULL,
  `billing_address` varchar(225) NOT NULL,
  `products` text NOT NULL,
  `total_price` int(11) NOT NULL,
  `invoice_date` datetime NOT NULL,
  `gst_no` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `upated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `invoice_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jeno_user`
--

CREATE TABLE `jeno_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_role` enum('Admin','Staff') NOT NULL,
  `user_center_id` int(11) NOT NULL,
  `user_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_created_by` int(11) NOT NULL,
  `user_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_updated_by` int(11) NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_tbl`
--

CREATE TABLE `model_tbl` (
  `mod_id` int(11) NOT NULL,
  `mod_brand_id` int(11) NOT NULL,
  `mod_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `mod_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `rack_tbl`
--

CREATE TABLE `rack_tbl` (
  `rack_id` int(11) NOT NULL,
  `rack_no` varchar(20) NOT NULL,
  `rack_name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `brand_tbl`
--
ALTER TABLE `brand_tbl`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `invoice_tbl`
--
ALTER TABLE `invoice_tbl`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `jeno_user`
--
ALTER TABLE `jeno_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `model_tbl`
--
ALTER TABLE `model_tbl`
  ADD PRIMARY KEY (`mod_id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_type_tbl`
--
ALTER TABLE `product_type_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rack_tbl`
--
ALTER TABLE `rack_tbl`
  ADD PRIMARY KEY (`rack_id`);

--
-- Indexes for table `stock_tbl`
--
ALTER TABLE `stock_tbl`
  ADD PRIMARY KEY (`stock_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_tbl`
--
ALTER TABLE `brand_tbl`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_tbl`
--
ALTER TABLE `invoice_tbl`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jeno_user`
--
ALTER TABLE `jeno_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model_tbl`
--
ALTER TABLE `model_tbl`
  MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_type_tbl`
--
ALTER TABLE `product_type_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rack_tbl`
--
ALTER TABLE `rack_tbl`
  MODIFY `rack_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_tbl`
--
ALTER TABLE `stock_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
