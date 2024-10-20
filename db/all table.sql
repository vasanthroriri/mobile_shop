-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 06:06 PM
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
-- Table structure for table `brand_tbl`
--

CREATE TABLE `brand_tbl` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `brand_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand_tbl`
--

INSERT INTO `brand_tbl` (`brand_id`, `brand_name`, `created_at`, `updated_at`, `brand_status`) VALUES
(1, 'Samsung', '2024-10-03 20:48:58', '2024-10-03 15:18:58', 'Active'),
(2, 'Poco', '2024-10-03 20:49:10', '2024-10-03 15:19:10', 'Active'),
(3, 'Redmi', '2024-10-15 11:25:45', '2024-10-15 05:56:05', 'Active');

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
  `invoice_date` varchar(20) NOT NULL,
  `gst_no` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `upated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `invoice_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_tbl`
--

INSERT INTO `invoice_tbl` (`invoice_id`, `customer_name`, `customer_phone`, `billing_address`, `products`, `total_price`, `invoice_date`, `gst_no`, `created_at`, `upated_at`, `invoice_status`) VALUES
(1, 'Anushiya', '8056775934', 'Kalakad', '[{\"brand\":\"Samsung\",\"model\":\"a52\",\"model_id\":\"1\",\"product_id\":\"2\",\"brand_id\":\"1\",\"product\":\"Back Cover\",\"quantity\":1,\"price\":150,\"acutaltotal\":150,\"total\":150}]', 150, '2024-10-10', 12345, '2024-10-10 12:34:15', '2024-10-10 07:04:15', 'Active'),
(2, 'Vasanth', '9894688091', 'Kalakad', '[{\"brand\":\"Samsung\",\"model\":\"a52\",\"model_id\":\"1\",\"product_id\":\"2\",\"brand_id\":\"1\",\"product\":\"Back Cover\",\"quantity\":1,\"price\":150,\"acutaltotal\":150,\"total\":150},{\"brand\":\"Samsung\",\"model\":\"a52\",\"model_id\":\"1\",\"product_id\":\"3\",\"brand_id\":\"1\",\"product\":\"Tempered Glass\",\"quantity\":1,\"price\":100,\"acutaltotal\":100,\"total\":100}]', 250, '2024-10-10', 12345, '2024-10-10 12:36:01', '2024-10-10 07:06:01', 'Active'),
(3, 'Vasanth', '9894688091', 'Kalakad', '[{\"brand\":\"Samsung\",\"model\":\"a52\",\"model_id\":\"1\",\"product_id\":\"2\",\"brand_id\":\"1\",\"product\":\"Back Cover\",\"quantity\":1,\"price\":150,\"acutaltotal\":150,\"total\":150}]', 150, '2024-10-09', 12345, '2024-10-10 12:44:16', '2024-10-10 07:14:16', 'Active'),
(4, 'Anushiya', '8056775934', 'Kalakad', '[{\"brand\":\"Redmi\",\"model\":\"Note 13\",\"model_id\":\"3\",\"product_id\":\"1\",\"brand_id\":\"3\",\"product\":\"Mobile\",\"quantity\":1,\"price\":20000,\"acutaltotal\":20000,\"total\":20000}]', 20000, '2024-10-15', 12345, '2024-10-15 11:29:26', '2024-10-15 05:59:26', 'Active');

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

--
-- Dumping data for table `jeno_user`
--

INSERT INTO `jeno_user` (`user_id`, `user_name`, `user_username`, `user_password`, `user_role`, `user_center_id`, `user_created_at`, `user_created_by`, `user_updated_at`, `user_updated_by`, `user_status`) VALUES
(1, 'admin', 'admin', 'admin', 'Admin', 1, '2024-08-02 17:23:17', 0, '2024-10-20 15:20:12', 0, 'Active'),
(2, 'admin', 'admin2', 'admin', 'Admin', 2, '2024-08-02 17:23:17', 0, '2024-08-02 11:53:17', 0, 'Active'),
(3, 'staff', 'staff1', 'staff', 'Staff', 1, '2024-08-02 17:23:17', 0, '2024-08-02 11:53:17', 0, 'Active'),
(4, 'staff', 'staff2', 'staff', 'Staff', 2, '2024-08-02 17:23:17', 0, '2024-08-02 11:53:17', 0, 'Active');

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

--
-- Dumping data for table `model_tbl`
--

INSERT INTO `model_tbl` (`mod_id`, `mod_brand_id`, `mod_name`, `created_at`, `mod_status`) VALUES
(1, 1, 'a52', '2024-10-05 19:27:12', 'Active'),
(2, 2, 's22', '2024-10-05 20:31:45', 'Active'),
(3, 3, 'Note 13', '2024-10-15 11:27:05', 'Active');

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

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `product_name`, `created_at`, `updated_at`, `product_status`) VALUES
(1, 'Mobile', '2024-10-05 15:51:56', '2024-10-05 10:21:56', 'Active'),
(2, 'Back Cover', '2024-10-05 16:47:40', '2024-10-05 11:17:40', 'Active'),
(3, 'Tempered Glass', '2024-10-05 16:59:06', '2024-10-05 11:29:06', 'Active'),
(4, 'Earphones', '2024-10-15 11:26:31', '2024-10-15 05:56:31', 'Active');

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
(2, 2, 'Mat class', 'Active', '2024-10-20 17:56:54'),
(3, 3, 'miror class', 'Active', '2024-10-20 20:00:59');

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
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_tbl`
--
ALTER TABLE `invoice_tbl`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jeno_user`
--
ALTER TABLE `jeno_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `model_tbl`
--
ALTER TABLE `model_tbl`
  MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_type_tbl`
--
ALTER TABLE `product_type_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rack_tbl`
--
ALTER TABLE `rack_tbl`
  MODIFY `rack_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_tbl`
--
ALTER TABLE `stock_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
