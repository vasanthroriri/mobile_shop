-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 03:24 PM
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
-- Table structure for table `stock_tbl`
--

CREATE TABLE `stock_tbl` (
  `stock_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `model_name` varchar(225) NOT NULL,
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

INSERT INTO `stock_tbl` (`stock_id`, `brand_id`, `product_id`, `model_name`, `product_price`, `product_quantity`, `place`, `emi_no`, `created_at`, `upated_at`, `stock_status`) VALUES
(1, 2, 1, 'Galaxy S25', 20000, 3, 'C', '', '2024-10-04 10:27:27', '2024-10-04 04:57:27', 'Active'),
(2, 1, 1, 'Galaxy S24 ', 9000, 2, 'A', '', '2024-10-04 11:15:36', '2024-10-04 05:45:36', 'Inactive'),
(3, 2, 1, 'X3', 200, 5, 'B', '', '2024-10-04 22:27:50', '2024-10-04 16:57:50', 'Inactive'),
(4, 2, 1, 'Galaxy S25', 20000, 3, 'C', '', '2024-10-05 16:16:24', '2024-10-05 10:46:24', 'Inactive'),
(5, 1, 1, 'X5', 50000, 1, 'A', '', '2024-10-05 16:30:50', '2024-10-05 11:00:50', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stock_tbl`
--
ALTER TABLE `stock_tbl`
  ADD PRIMARY KEY (`stock_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stock_tbl`
--
ALTER TABLE `stock_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
