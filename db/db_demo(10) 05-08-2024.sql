-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 06:38 AM
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
-- Database: `db_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `jeno_book`
--

CREATE TABLE `jeno_book` (
  `book_id` int(11) NOT NULL,
  `book_stu_id` int(11) NOT NULL,
  `book_received` enum('Received','Not Received') NOT NULL DEFAULT 'Not Received',
  `book_uni_received` longtext NOT NULL,
  `book_issued` longtext NOT NULL,
  `book_id_card` enum('Issued','Not Issued') NOT NULL DEFAULT 'Not Issued',
  `book_year` int(11) NOT NULL,
  `book_center_id` int(11) NOT NULL,
  `book_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `book_created_by` int(11) NOT NULL,
  `book_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `book_updated_by` int(11) NOT NULL,
  `book_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_book`
--

INSERT INTO `jeno_book` (`book_id`, `book_stu_id`, `book_received`, `book_uni_received`, `book_issued`, `book_id_card`, `book_year`, `book_center_id`, `book_created_at`, `book_created_by`, `book_updated_at`, `book_updated_by`, `book_status`) VALUES
(1, 1, 'Received', '[\"Subject 1 year 1\",\"subject 2 year 1\"]', '[\"subject 3 year 1\"]', 'Issued', 1, 1, '2024-08-03 10:28:26', 3, '2024-08-03 05:05:41', 3, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_course`
--

CREATE TABLE `jeno_course` (
  `cou_id` int(11) NOT NULL,
  `cou_uni_id` int(11) NOT NULL,
  `cou_name` varchar(200) NOT NULL,
  `cou_medium` enum('Tamil','English','Both') NOT NULL,
  `cou_exam_type` enum('Year','Semester') NOT NULL,
  `cou_fees_type` enum('Year','Semester') NOT NULL,
  `cou_duration` int(11) NOT NULL,
  `cou_university_fess` varchar(200) NOT NULL,
  `cou_study_fees` varchar(200) NOT NULL,
  `cou_total_fees` varchar(200) NOT NULL,
  `cou_center_id` int(11) NOT NULL,
  `cou_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `cou_created_by` int(11) NOT NULL,
  `cou_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cou_updated_by` int(11) NOT NULL,
  `cou_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_course`
--

INSERT INTO `jeno_course` (`cou_id`, `cou_uni_id`, `cou_name`, `cou_medium`, `cou_exam_type`, `cou_fees_type`, `cou_duration`, `cou_university_fess`, `cou_study_fees`, `cou_total_fees`, `cou_center_id`, `cou_created_at`, `cou_created_by`, `cou_updated_at`, `cou_updated_by`, `cou_status`) VALUES
(1, 1, 'B.Com', 'English', 'Year', 'Year', 3, '[\"5000\",\"5000\",\"500\"]', '[\"5000\",\"5000\",\"5000\"]', '[\"10000\",\"10000\",\"5500\"]', 1, '2024-08-03 10:15:12', 3, '2024-08-03 04:45:12', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_document`
--

CREATE TABLE `jeno_document` (
  `doc_id` int(11) NOT NULL,
  `doc_stu_id` int(11) NOT NULL,
  `doc_sslc` varchar(100) NOT NULL,
  `doc_hsc` varchar(100) NOT NULL,
  `doc_community` varchar(100) NOT NULL,
  `doc_tc` varchar(100) NOT NULL,
  `doc_aadhar` varchar(100) NOT NULL,
  `doc_photo` varchar(100) NOT NULL,
  `doc_center_id` int(11) NOT NULL,
  `doc_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `doc_created_by` int(11) NOT NULL,
  `doc_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `doc_updated_by` int(11) NOT NULL,
  `doc_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_document`
--

INSERT INTO `jeno_document` (`doc_id`, `doc_stu_id`, `doc_sslc`, `doc_hsc`, `doc_community`, `doc_tc`, `doc_aadhar`, `doc_photo`, `doc_center_id`, `doc_created_at`, `doc_created_by`, `doc_updated_at`, `doc_updated_by`, `doc_status`) VALUES
(1, 1, '', '', '', '', '', '', 1, '2024-08-03 10:28:26', 3, '2024-08-03 04:58:26', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_elective`
--

CREATE TABLE `jeno_elective` (
  `ele_id` int(11) NOT NULL,
  `ele_cou_id` int(11) NOT NULL,
  `ele_elective` varchar(100) NOT NULL,
  `ele_lag_elec` enum('L','E') NOT NULL,
  `ele_center_id` int(11) NOT NULL,
  `ele_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `ele_created_by` int(11) NOT NULL,
  `ele_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ele_updated_by` int(11) NOT NULL,
  `ele_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_elective`
--

INSERT INTO `jeno_elective` (`ele_id`, `ele_cou_id`, `ele_elective`, `ele_lag_elec`, `ele_center_id`, `ele_created_at`, `ele_created_by`, `ele_updated_at`, `ele_updated_by`, `ele_status`) VALUES
(1, 1, 'Malayalam', 'L', 1, '2024-08-03 10:15:34', 3, '2024-08-03 04:45:34', 0, 'Active'),
(2, 1, 'Hindi', 'L', 1, '2024-08-03 10:15:49', 3, '2024-08-03 04:45:49', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_enquiry`
--

CREATE TABLE `jeno_enquiry` (
  `enq_id` int(11) NOT NULL,
  `enq_uni_id` int(11) NOT NULL,
  `enq_cou_id` int(11) NOT NULL,
  `enq_number` varchar(50) NOT NULL,
  `enq_stu_name` varchar(50) NOT NULL,
  `enq_email` varchar(50) NOT NULL,
  `enq_dob` varchar(20) NOT NULL,
  `enq_gender` enum('Male','Female','Transgender') NOT NULL,
  `enq_mobile` varchar(20) NOT NULL,
  `enq_address` longtext NOT NULL,
  `enq_medium` enum('Tamil','English') NOT NULL,
  `enq_adminsion_status` enum('Pending','Complete') NOT NULL DEFAULT 'Pending',
  `enq_center_id` int(11) NOT NULL,
  `enq_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `enq_created_by` int(11) NOT NULL,
  `enq_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `enq_updated_by` int(11) NOT NULL,
  `enq_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_enquiry`
--

INSERT INTO `jeno_enquiry` (`enq_id`, `enq_uni_id`, `enq_cou_id`, `enq_number`, `enq_stu_name`, `enq_email`, `enq_dob`, `enq_gender`, `enq_mobile`, `enq_address`, `enq_medium`, `enq_adminsion_status`, `enq_center_id`, `enq_created_at`, `enq_created_by`, `enq_updated_at`, `enq_updated_by`, `enq_status`) VALUES
(1, 1, 1, '', 'vasanth', 'vasanth@gmail.com', '2002-11-01', 'Male', '7896541354', 'kallikulam', 'English', 'Pending', 1, '2024-08-03 10:27:29', 3, '2024-08-03 04:57:29', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_faculty`
--

CREATE TABLE `jeno_faculty` (
  `fac_id` int(11) NOT NULL,
  `fac_name` varchar(100) NOT NULL,
  `fac_gender` enum('Male','Female','Transgender') NOT NULL,
  `fac_mobile` varchar(20) NOT NULL,
  `fac_email` varchar(50) NOT NULL,
  `fac_address` varchar(250) NOT NULL,
  `fac_date_of_join` date NOT NULL,
  `fac_salary` varchar(50) NOT NULL,
  `fac_qualification` varchar(50) NOT NULL,
  `fac_clg` varchar(150) NOT NULL,
  `fac_aadhar` varchar(50) NOT NULL,
  `fac_cou_id` int(11) NOT NULL,
  `fac_center_id` int(11) NOT NULL,
  `fac_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `fac_created_by` int(11) NOT NULL,
  `fac_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fac_updated_by` int(11) NOT NULL,
  `fac_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_faculty`
--

INSERT INTO `jeno_faculty` (`fac_id`, `fac_name`, `fac_gender`, `fac_mobile`, `fac_email`, `fac_address`, `fac_date_of_join`, `fac_salary`, `fac_qualification`, `fac_clg`, `fac_aadhar`, `fac_cou_id`, `fac_center_id`, `fac_created_at`, `fac_created_by`, `fac_updated_at`, `fac_updated_by`, `fac_status`) VALUES
(1, 'João Souza Silva', 'Male', '7896541389', 'fhjl@gmail.com', '11/23 main street kalakad', '2024-08-03', '5000', 'M.Sc', 'T.D.M.N.S College', '20240803_070857.png', 1, 1, '2024-08-03 10:38:57', 3, '2024-08-03 05:12:30', 0, 'Active'),
(2, 'JohnNicks', 'Female', '9894688091', 'jhfd@gmail.com', 'kalakad', '2024-08-01', '4000', 'B.Com', 'T.D.M.N.S College', '20240803_071214.png', 1, 1, '2024-08-03 10:42:14', 3, '2024-08-03 05:12:14', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_fees`
--

CREATE TABLE `jeno_fees` (
  `fee_id` int(11) NOT NULL,
  `fee_admision_id` varchar(20) NOT NULL,
  `fee_stu_id` int(11) NOT NULL,
  `fee_uni_fee_total` int(11) NOT NULL,
  `fee_uni_fee` int(10) NOT NULL,
  `fee_sdy_fee_total` int(11) NOT NULL,
  `fee_sty_fee` int(10) NOT NULL,
  `fee_stu_year` int(11) NOT NULL,
  `fee_center_id` int(11) NOT NULL,
  `fee_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `fee_created_by` int(11) NOT NULL,
  `fee_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fee_updated_by` int(11) NOT NULL,
  `fee_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_fees`
--

INSERT INTO `jeno_fees` (`fee_id`, `fee_admision_id`, `fee_stu_id`, `fee_uni_fee_total`, `fee_uni_fee`, `fee_sdy_fee_total`, `fee_sty_fee`, `fee_stu_year`, `fee_center_id`, `fee_created_at`, `fee_created_by`, `fee_updated_at`, `fee_updated_by`, `fee_status`) VALUES
(1, '2024AC1', 1, 5000, 5000, 5000, 5000, 1, 1, '2024-08-03 10:28:26', 3, '2024-08-03 10:46:43', 3, 'Active'),
(2, '2024AC1', 1, 5000, 0, 5000, 0, 2, 0, '2024-08-03 16:16:47', 3, '2024-08-03 10:46:47', 0, 'Active'),
(3, '2024AC1', 1, 5000, 0, 5000, 0, 2, 0, '2024-08-03 16:17:11', 3, '2024-08-03 10:47:11', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_location`
--

CREATE TABLE `jeno_location` (
  `loc_id` int(11) NOT NULL,
  `loc_name` varchar(100) NOT NULL,
  `loc_short_name` varchar(20) NOT NULL,
  `loc_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `loc_created_by` int(11) NOT NULL,
  `loc_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `loc_updated_by` int(11) NOT NULL,
  `loc_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_location`
--

INSERT INTO `jeno_location` (`loc_id`, `loc_name`, `loc_short_name`, `loc_created_at`, `loc_created_by`, `loc_updated_at`, `loc_updated_by`, `loc_status`) VALUES
(1, 'Murugankurichi', 'MKI', '2024-08-02 17:16:40', 0, '2024-08-02 11:52:28', 0, 'Active'),
(2, 'Samaathanapuram', 'SMP', '2024-08-02 17:16:40', 0, '2024-08-02 11:52:32', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_opening`
--

CREATE TABLE `jeno_opening` (
  `open_id` int(11) NOT NULL,
  `open_date` date NOT NULL,
  `open_open_online` int(11) NOT NULL,
  `open_open_cash` int(11) NOT NULL,
  `open_close_online` int(11) NOT NULL,
  `open_close_cash` int(11) NOT NULL,
  `open_create_at` datetime NOT NULL,
  `open_update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `open_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jeno_payment_history`
--

CREATE TABLE `jeno_payment_history` (
  `pay_id` int(11) NOT NULL,
  `pay_admission_id` varchar(50) NOT NULL,
  `pay_student_name` varchar(50) NOT NULL,
  `pay_year` varchar(20) NOT NULL,
  `pay_paid_method` enum('Online','Cash') NOT NULL,
  `pay_transaction_id` varchar(30) NOT NULL,
  `pay_description` varchar(100) NOT NULL,
  `pay_university_fees` int(11) NOT NULL,
  `pay_study_fees` int(11) NOT NULL,
  `pay_total_amount` int(11) NOT NULL,
  `pay_balance` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_center_id` int(11) NOT NULL,
  `pay_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `pay_created_by` int(11) NOT NULL,
  `pay_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pay_updated_by` int(11) NOT NULL,
  `pay_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_payment_history`
--

INSERT INTO `jeno_payment_history` (`pay_id`, `pay_admission_id`, `pay_student_name`, `pay_year`, `pay_paid_method`, `pay_transaction_id`, `pay_description`, `pay_university_fees`, `pay_study_fees`, `pay_total_amount`, `pay_balance`, `pay_date`, `pay_center_id`, `pay_created_at`, `pay_created_by`, `pay_updated_at`, `pay_updated_by`, `pay_status`) VALUES
(1, '2024AC1', 'vasanth', '1 Year', 'Online', '646465sa', 'paid by Gpay', 500, 500, 1000, 0, '2024-08-03', 1, '2024-08-03 10:33:02', 3, '2024-08-03 05:03:02', 0, 'Active'),
(2, '2024AC1', 'vasanth', '1 Year', 'Cash', '', '', 500, 500, 1000, 0, '2024-08-03', 1, '2024-08-03 14:33:54', 3, '2024-08-03 09:03:54', 0, 'Active'),
(3, '2024AC1', 'vasanth', '1 Year', 'Cash', '', '', 4000, 545, 4545, 0, '2024-08-03', 1, '2024-08-03 16:16:16', 3, '2024-08-03 10:46:16', 0, 'Active'),
(4, '2024AC1', 'vasanth', '1 Year', 'Cash', '', '', 0, 3455, 3455, 0, '2024-08-03', 1, '2024-08-03 16:16:43', 3, '2024-08-03 10:46:43', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_schedule`
--

CREATE TABLE `jeno_schedule` (
  `sch_id` int(11) NOT NULL,
  `sch_fac_id` int(11) NOT NULL,
  `sch_date` date NOT NULL,
  `sch_session` enum('Morning','Afternoon','Full Day') NOT NULL,
  `sch_timing` varchar(20) NOT NULL,
  `sch_cou_id` int(11) NOT NULL,
  `sch_sub_id` longtext NOT NULL,
  `sch_center_id` int(11) NOT NULL,
  `sch_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `sch_created_by` int(11) NOT NULL,
  `sch_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sch_updated_by` int(11) NOT NULL,
  `sch_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_schedule`
--

INSERT INTO `jeno_schedule` (`sch_id`, `sch_fac_id`, `sch_date`, `sch_session`, `sch_timing`, `sch_cou_id`, `sch_sub_id`, `sch_center_id`, `sch_created_at`, `sch_created_by`, `sch_updated_at`, `sch_updated_by`, `sch_status`) VALUES
(1, 1, '2024-08-06', 'Morning', '10-12', 1, '[\"subject 2 year 1\",\"subject 3 year 1\"]', 1, '2024-08-03 10:43:23', 3, '2024-08-03 05:15:12', 0, 'Active'),
(2, 1, '2024-08-19', 'Afternoon', '10-12', 1, '[\"Subject 1 year 1\"]', 1, '2024-08-03 10:45:27', 3, '2024-08-03 05:15:27', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_staff`
--

CREATE TABLE `jeno_staff` (
  `stf_id` int(11) NOT NULL,
  `stf_name` varchar(50) NOT NULL,
  `stf_birth` date NOT NULL,
  `stf_mobile` varchar(20) NOT NULL,
  `stf_email` varchar(50) NOT NULL,
  `stf_address` varchar(250) NOT NULL,
  `stf_gender` enum('Male','Female','Transgender','') NOT NULL,
  `stf_role` varchar(50) NOT NULL,
  `stf_salary` int(11) NOT NULL,
  `stf_joining_date` date NOT NULL,
  `stf_image` varchar(100) NOT NULL,
  `stf_userId` int(11) NOT NULL,
  `sft_center_id` int(11) NOT NULL,
  `stf_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `stf_created_by` int(11) NOT NULL,
  `stf_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stf_updated_by` int(11) NOT NULL,
  `stf_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jeno_student`
--

CREATE TABLE `jeno_student` (
  `stu_id` int(11) NOT NULL,
  `stu_name` varchar(50) NOT NULL,
  `stu_phone` varchar(20) NOT NULL,
  `stu_email` varchar(60) NOT NULL,
  `stu_uni_id` int(11) NOT NULL,
  `stu_cou_id` int(11) NOT NULL,
  `stu_medium_id` int(11) NOT NULL,
  `stu_apply_no` varchar(20) NOT NULL,
  `stu_enroll` varchar(30) NOT NULL,
  `stu_aca_year` varchar(20) NOT NULL,
  `stu_join_year` int(11) NOT NULL,
  `stu_center_id` int(11) NOT NULL,
  `stu_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `stu_created_by` int(11) NOT NULL,
  `stu_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stu_updated_by` int(11) NOT NULL,
  `stu_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_student`
--

INSERT INTO `jeno_student` (`stu_id`, `stu_name`, `stu_phone`, `stu_email`, `stu_uni_id`, `stu_cou_id`, `stu_medium_id`, `stu_apply_no`, `stu_enroll`, `stu_aca_year`, `stu_join_year`, `stu_center_id`, `stu_created_at`, `stu_created_by`, `stu_updated_at`, `stu_updated_by`, `stu_status`) VALUES
(1, 'vasanth', '9894688091', 'vasanth@gmail.com', 1, 1, 2, '2024AC1', '', '2', 1, 1, '2024-08-03 10:28:26', 3, '2024-08-03 10:46:47', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_stu_additional`
--

CREATE TABLE `jeno_stu_additional` (
  `add_id` int(11) NOT NULL,
  `add_stu_id` int(11) NOT NULL,
  `add_year_type` enum('Academic Year','Calander Year') NOT NULL,
  `add_language` int(11) NOT NULL,
  `add_digilocker` varchar(200) NOT NULL,
  `add_admit_date` date NOT NULL,
  `add_dob` date NOT NULL,
  `add_gender` enum('Male','Female','Transgender') NOT NULL,
  `add_address` longtext NOT NULL,
  `add_pincode` int(11) NOT NULL,
  `add_father_name` varchar(30) NOT NULL,
  `add_mother_name` varchar(30) NOT NULL,
  `add_aadhar_no` varchar(20) NOT NULL,
  `add_nationality` varchar(30) NOT NULL,
  `add_mother_tongue` varchar(30) NOT NULL,
  `add_religion` varchar(30) NOT NULL,
  `add_caste` varchar(30) NOT NULL,
  `add_community` varchar(30) NOT NULL,
  `add_marital_status` enum('Single','Married') NOT NULL,
  `add_employed` enum('Employed','Unemployed') NOT NULL,
  `add_qualifiaction` enum('Diploma','12','UG','PG') NOT NULL,
  `add_institute` varchar(255) NOT NULL,
  `add_comp_year` varchar(20) NOT NULL,
  `add_study_field` varchar(30) NOT NULL,
  `add_grade` varchar(20) NOT NULL,
  `add_center_id` int(11) NOT NULL,
  `add_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `add_created_by` int(11) NOT NULL,
  `add_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `add_updated_by` int(11) NOT NULL,
  `add_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_stu_additional`
--

INSERT INTO `jeno_stu_additional` (`add_id`, `add_stu_id`, `add_year_type`, `add_language`, `add_digilocker`, `add_admit_date`, `add_dob`, `add_gender`, `add_address`, `add_pincode`, `add_father_name`, `add_mother_name`, `add_aadhar_no`, `add_nationality`, `add_mother_tongue`, `add_religion`, `add_caste`, `add_community`, `add_marital_status`, `add_employed`, `add_qualifiaction`, `add_institute`, `add_comp_year`, `add_study_field`, `add_grade`, `add_center_id`, `add_created_at`, `add_created_by`, `add_updated_at`, `add_updated_by`, `add_status`) VALUES
(1, 1, '', 1, '', '0000-00-00', '0000-00-00', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2024-08-03 10:28:26', 3, '2024-08-03 04:58:26', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_subject`
--

CREATE TABLE `jeno_subject` (
  `sub_id` int(11) NOT NULL,
  `sub_uni_id` int(11) NOT NULL,
  `sub_cou_id` int(11) NOT NULL,
  `sub_ele_id` int(11) NOT NULL,
  `sub_exam_patten` int(11) NOT NULL,
  `sub_subject_code` longtext NOT NULL,
  `sub_subject_name` longtext NOT NULL,
  `sub_addition_lag_name` longtext NOT NULL,
  `sub_addition_sub_code` longtext NOT NULL,
  `sub_addition_sub_name` longtext NOT NULL,
  `sub_type` enum('Elective','Language') NOT NULL,
  `sub_center_id` int(11) NOT NULL,
  `sub_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `sub_created_by` int(11) NOT NULL,
  `sub_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sub_updated_by` int(11) NOT NULL,
  `sub_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_subject`
--

INSERT INTO `jeno_subject` (`sub_id`, `sub_uni_id`, `sub_cou_id`, `sub_ele_id`, `sub_exam_patten`, `sub_subject_code`, `sub_subject_name`, `sub_addition_lag_name`, `sub_addition_sub_code`, `sub_addition_sub_name`, `sub_type`, `sub_center_id`, `sub_created_at`, `sub_created_by`, `sub_updated_at`, `sub_updated_by`, `sub_status`) VALUES
(1, 1, 1, 0, 1, '[\"101\",\"102\",\"103\"]', '[\"Subject 1 year 1\",\"subject 2 year 1\",\"subject 3 year 1\"]', '[\"1\",\"2\"]', '[\"201\",\"202`\"]', '[\"tart -1\",\"part-2\"]', 'Language', 1, '2024-08-03 10:17:50', 3, '2024-08-03 04:47:50', 0, 'Active'),
(2, 1, 1, 0, 2, '[\"201\",\"202\",\"203\"]', '[\"subject -1 year 2\",\"subject -2 year 2\",\"subject -3 year 2\"]', '[\"1\"]', '[\"501\"]', '[\"part 1 year 2\"]', 'Language', 1, '2024-08-03 10:19:36', 3, '2024-08-03 04:49:36', 0, 'Active'),
(3, 1, 1, 0, 3, '[\"301\",\"302\",\"303\"]', '[\"subject 1 year 3\",\"subject 2 year 3\",\"subject 3 year 3\"]', '[\"2\"]', '[\"502\"]', '[\"Part -1 year 3\"]', 'Language', 1, '2024-08-03 10:22:55', 3, '2024-08-03 04:52:55', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_transaction`
--

CREATE TABLE `jeno_transaction` (
  `tran_id` int(11) NOT NULL,
  `tran_category` enum('Income','Expense') NOT NULL,
  `tran_date` date NOT NULL,
  `tran_amount` int(11) NOT NULL,
  `tran_method` enum('Online','Cash') NOT NULL,
  `tran_transaction_id` varchar(50) NOT NULL,
  `tran_description` varchar(100) NOT NULL,
  `tran_reason` varchar(100) NOT NULL,
  `tran_center_id` int(11) NOT NULL,
  `tran_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `tran_created_by` int(11) NOT NULL,
  `tran_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tran_updated_by` int(11) NOT NULL,
  `tran_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_transaction`
--

INSERT INTO `jeno_transaction` (`tran_id`, `tran_category`, `tran_date`, `tran_amount`, `tran_method`, `tran_transaction_id`, `tran_description`, `tran_reason`, `tran_center_id`, `tran_created_at`, `tran_created_by`, `tran_updated_at`, `tran_updated_by`, `tran_status`) VALUES
(1, 'Expense', '2024-08-02', 5000, 'Online', '43w5435', 'paid by gpay', 'corent bill', 1, '2024-08-03 10:33:55', 3, '2024-08-03 11:54:42', 0, 'Active'),
(2, 'Income', '2024-08-02', 500, 'Online', '646465sa', 'paid by Gpay', 'Books ', 1, '2024-08-03 15:40:52', 3, '2024-08-03 11:54:48', 0, 'Active'),
(3, 'Income', '2024-08-03', 200, 'Online', 'ph00145', 'paid by Gpay', 'bill ', 1, '2024-08-03 17:09:24', 3, '2024-08-03 11:39:24', 0, 'Active'),
(4, 'Income', '2024-08-02', 800, 'Cash', '', 'student Xerox', 'Xerox', 1, '2024-08-03 17:18:49', 3, '2024-08-03 11:54:53', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jeno_university`
--

CREATE TABLE `jeno_university` (
  `uni_id` int(11) NOT NULL,
  `uni_study_code` varchar(50) NOT NULL,
  `uni_name` varchar(100) NOT NULL,
  `uni_department` varchar(200) NOT NULL,
  `uni_contact` varchar(200) NOT NULL,
  `uni_center_id` int(11) NOT NULL,
  `uni_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `uni_created_by` int(11) NOT NULL,
  `uni_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `uni_updated_by` int(11) NOT NULL,
  `uni_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeno_university`
--

INSERT INTO `jeno_university` (`uni_id`, `uni_study_code`, `uni_name`, `uni_department`, `uni_contact`, `uni_center_id`, `uni_created_at`, `uni_created_by`, `uni_updated_at`, `uni_updated_by`, `uni_status`) VALUES
(1, 'jeno078', 'MS University', '[\"b.sc computer \"]', '[\"9894688091\"]', 1, '2024-08-03 10:14:45', 3, '2024-08-03 04:44:45', 0, 'Active');

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
(1, 'admin', 'admin1', 'admin', 'Admin', 1, '2024-08-02 17:23:17', 0, '2024-08-02 11:53:17', 0, 'Active'),
(2, 'admin', 'admin2', 'admin', 'Admin', 2, '2024-08-02 17:23:17', 0, '2024-08-02 11:53:17', 0, 'Active'),
(3, 'staff', 'staff1', 'staff', 'Staff', 1, '2024-08-02 17:23:17', 0, '2024-08-02 11:53:17', 0, 'Active'),
(4, 'staff', 'staff2', 'staff', 'Staff', 2, '2024-08-02 17:23:17', 0, '2024-08-02 11:53:17', 0, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jeno_book`
--
ALTER TABLE `jeno_book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `jeno_course`
--
ALTER TABLE `jeno_course`
  ADD PRIMARY KEY (`cou_id`);

--
-- Indexes for table `jeno_document`
--
ALTER TABLE `jeno_document`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `jeno_elective`
--
ALTER TABLE `jeno_elective`
  ADD PRIMARY KEY (`ele_id`);

--
-- Indexes for table `jeno_enquiry`
--
ALTER TABLE `jeno_enquiry`
  ADD PRIMARY KEY (`enq_id`);

--
-- Indexes for table `jeno_faculty`
--
ALTER TABLE `jeno_faculty`
  ADD PRIMARY KEY (`fac_id`);

--
-- Indexes for table `jeno_fees`
--
ALTER TABLE `jeno_fees`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `jeno_location`
--
ALTER TABLE `jeno_location`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `jeno_opening`
--
ALTER TABLE `jeno_opening`
  ADD PRIMARY KEY (`open_id`);

--
-- Indexes for table `jeno_payment_history`
--
ALTER TABLE `jeno_payment_history`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `jeno_schedule`
--
ALTER TABLE `jeno_schedule`
  ADD PRIMARY KEY (`sch_id`);

--
-- Indexes for table `jeno_staff`
--
ALTER TABLE `jeno_staff`
  ADD PRIMARY KEY (`stf_id`);

--
-- Indexes for table `jeno_student`
--
ALTER TABLE `jeno_student`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `jeno_stu_additional`
--
ALTER TABLE `jeno_stu_additional`
  ADD PRIMARY KEY (`add_id`);

--
-- Indexes for table `jeno_subject`
--
ALTER TABLE `jeno_subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `jeno_transaction`
--
ALTER TABLE `jeno_transaction`
  ADD PRIMARY KEY (`tran_id`);

--
-- Indexes for table `jeno_university`
--
ALTER TABLE `jeno_university`
  ADD PRIMARY KEY (`uni_id`);

--
-- Indexes for table `jeno_user`
--
ALTER TABLE `jeno_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jeno_book`
--
ALTER TABLE `jeno_book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jeno_course`
--
ALTER TABLE `jeno_course`
  MODIFY `cou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jeno_document`
--
ALTER TABLE `jeno_document`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jeno_elective`
--
ALTER TABLE `jeno_elective`
  MODIFY `ele_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jeno_enquiry`
--
ALTER TABLE `jeno_enquiry`
  MODIFY `enq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jeno_faculty`
--
ALTER TABLE `jeno_faculty`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jeno_fees`
--
ALTER TABLE `jeno_fees`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jeno_location`
--
ALTER TABLE `jeno_location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jeno_opening`
--
ALTER TABLE `jeno_opening`
  MODIFY `open_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jeno_payment_history`
--
ALTER TABLE `jeno_payment_history`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jeno_schedule`
--
ALTER TABLE `jeno_schedule`
  MODIFY `sch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jeno_staff`
--
ALTER TABLE `jeno_staff`
  MODIFY `stf_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jeno_student`
--
ALTER TABLE `jeno_student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jeno_stu_additional`
--
ALTER TABLE `jeno_stu_additional`
  MODIFY `add_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jeno_subject`
--
ALTER TABLE `jeno_subject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jeno_transaction`
--
ALTER TABLE `jeno_transaction`
  MODIFY `tran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jeno_university`
--
ALTER TABLE `jeno_university`
  MODIFY `uni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jeno_user`
--
ALTER TABLE `jeno_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
