-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2022 at 04:23 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_list`
--

CREATE TABLE `client_list` (
  `id` int(30) NOT NULL,
  `client_code` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `fullname` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active, 2= Inactive',
  `termin_date` varchar(255) DEFAULT NULL,
  `termin_number` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_list`
--

INSERT INTO `client_list` (`id`, `client_code`, `password`, `fullname`, `status`, `termin_date`, `termin_number`, `date_created`, `date_updated`) VALUES
(32, '20220001', 'ad4817eaead4df26c8b6b4b48fb2158b', 'Fisteku, Filan ', 1, NULL, NULL, '2022-12-24 16:20:25', '2022-12-24 16:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `client_meta`
--

CREATE TABLE `client_meta` (
  `client_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_meta`
--

INSERT INTO `client_meta` (`client_id`, `meta_field`, `meta_value`) VALUES
(32, 'firstname', 'Filan'),
(32, 'lastname', 'Fisteku'),
(32, 'gender', 'Mashkull'),
(32, 'dob', '2022-12-24'),
(32, 'contact', '+38344111222'),
(32, 'address', 'Rr. ABC'),
(32, 'email', 'test@gmail.com'),
(32, 'seanca_id', 'Array');

-- --------------------------------------------------------

--
-- Table structure for table `client_seancat`
--

CREATE TABLE `client_seancat` (
  `client_id` int(30) NOT NULL,
  `seanca_id` int(30) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_seancat`
--

INSERT INTO `client_seancat` (`client_id`, `seanca_id`, `name`) VALUES
(32, 1, '0'),
(32, 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_list`
--

CREATE TABLE `doctors_list` (
  `id` int(30) NOT NULL,
  `doctor_code` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `fullname` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active, 2= Inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors_list`
--

INSERT INTO `doctors_list` (`id`, `doctor_code`, `password`, `fullname`, `status`, `date_created`, `date_updated`) VALUES
(1, '20210001', 'a88df23ac492e6e2782df6586a0c645f', 'Williams, Mike D', 1, '2021-11-05 13:12:15', '2021-11-05 14:58:01'),
(4, '20210002', '100af4e620024b40bbfc49214ea66509', 'Lou, Samantha Jane C', 1, '2021-11-05 14:59:58', '2021-11-05 15:19:32'),
(6, '20220001', 'ad4817eaead4df26c8b6b4b48fb2158b', 'Sokoli, Besart ', 1, '2022-08-25 12:26:23', '2022-08-25 12:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_meta`
--

CREATE TABLE `doctor_meta` (
  `doctor_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_meta`
--

INSERT INTO `doctor_meta` (`doctor_id`, `meta_field`, `meta_value`) VALUES
(6, 'firstname', 'Besart'),
(6, 'lastname', 'Sokoli'),
(6, 'gender', 'Mashkull'),
(6, 'dob', '2022-08-25'),
(6, 'contact', '+38345333220'),
(6, 'address', 'LlugÃ«, PodujevÃ«'),
(6, 'email', ''),
(1, 'lastname', 'Williams'),
(1, 'firstname', 'Mike'),
(1, 'middlename', 'D'),
(1, 'gender', 'Male'),
(1, 'dob', '1997-06-23'),
(1, 'contact', '09223554991'),
(1, 'address', 'My Address, Here City, There Province, 2306'),
(1, 'email', 'mwilliams@sample.com'),
(1, 'cpassword', 'mwilliams'),
(1, 'cur_password', '20210001'),
(4, 'lastname', 'Lou'),
(4, 'firstname', 'Samantha Jane'),
(4, 'middlename', 'C'),
(4, 'gender', 'Female'),
(4, 'dob', '1997-10-14'),
(4, 'contact', '097876546522'),
(4, 'address', 'Sample Address Only, Anywhere, 2306'),
(4, 'email', 'sjlou@sample.com'),
(4, 'cpassword', ''),
(4, 'cur_password', '20210002');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_list`
--

CREATE TABLE `invoice_list` (
  `id` int(30) NOT NULL,
  `invoice_code` varchar(50) NOT NULL,
  `client_id` int(30) NOT NULL,
  `total_amount` float NOT NULL DEFAULT 0,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `date_start` varchar(255) DEFAULT NULL,
  `date_end` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=Paid',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_list`
--

INSERT INTO `invoice_list` (`id`, `invoice_code`, `client_id`, `total_amount`, `discount_perc`, `discount`, `tax_perc`, `tax`, `date_start`, `date_end`, `remarks`, `status`, `date_created`, `date_updated`) VALUES
(1, '202100001', 1, 592.9, 2, 12.1, 12, 72.6, NULL, NULL, 'Sample Only', 1, '2021-11-05 13:12:43', '2021-11-05 13:45:49'),
(3, '202100002', 4, 717.24, 5, 37.7495, 12, 90.5988, NULL, NULL, 'Sample Invoice 2', 1, '2021-11-05 15:10:47', '2021-11-05 15:19:56'),
(4, '202200001', 5, 20, 0, 0, 0, 0, '0', '0', 'testFatura', 0, '2022-08-24 18:44:14', '2022-12-22 15:20:12'),
(6, '202200002', 5, 20, 0, 0, 0, 0, '0', '0', 'h', 0, '2022-12-22 15:39:04', '2022-12-22 15:39:04'),
(7, '202200003', 11, 20, 0, 0, 0, 0, '0', '0', 'asas', 0, '2022-12-24 14:16:53', '2022-12-24 14:16:53'),
(8, '202200004', 11, 21, 0, 0, 0, 0, '0', '0', 'aa', 0, '2022-12-24 14:18:13', '2022-12-24 14:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_services`
--

CREATE TABLE `invoice_services` (
  `invoice_id` int(30) NOT NULL,
  `service_id` int(30) NOT NULL,
  `price` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_services`
--

INSERT INTO `invoice_services` (`invoice_id`, `service_id`, `price`) VALUES
(1, 1, 250),
(1, 3, 355),
(2, 3, 355),
(2, 1, 250),
(2, 2, 399.99),
(3, 2, 399.99),
(3, 3, 355),
(5, 5, 20),
(4, 5, 20),
(6, 5, 20),
(9, 0, 0),
(9, 0, 0),
(9, 0, 0),
(9, 0, 2022),
(9, 0, 0),
(9, 0, 0),
(9, 0, 0),
(9, 0, 0),
(10, 0, 0),
(10, 0, 0),
(10, 0, 0),
(10, 0, 2022),
(10, 0, 0),
(10, 0, 0),
(10, 0, 0),
(10, 0, 0),
(7, 5, 20),
(8, 5, 20),
(8, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seancat_list`
--

CREATE TABLE `seancat_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seancat_list`
--

INSERT INTO `seancat_list` (`id`, `name`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Seanca 1', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(2, 'Seanca 2', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(3, 'Seanca 3', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(4, 'Seanca 4', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(5, 'Seanca 5', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(6, 'Seanca 6', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(7, 'Seanca 7', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(8, 'Seanca 8', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(9, 'Seanca 9', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(10, 'Seanca 10', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(11, 'Seanca 11', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(12, 'Seanca 12', 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `services_list`
--

CREATE TABLE `services_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services_list`
--

INSERT INTO `services_list` (`id`, `name`, `description`, `price`, `status`, `date_created`, `date_updated`) VALUES
(5, 'Test', 'Test', 20, 1, '2022-08-31 06:43:14', '2022-08-31 06:43:14'),
(6, 'aa', 'aa', 1, 1, '2022-12-24 14:18:00', '2022-12-24 14:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Client Management System in PHP'),
(6, 'short_name', 'CMS-PHP'),
(11, 'logo', 'uploads/logo-1661381209.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1636097638.png'),
(15, 'content', 'Array');

-- --------------------------------------------------------

--
-- Table structure for table `termin_list`
--

CREATE TABLE `termin_list` (
  `id` int(30) NOT NULL,
  `doctor_code` varchar(50) NOT NULL,
  `client_id` int(30) NOT NULL,
  `doctors_id` int(30) NOT NULL,
  `service_id` int(30) NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=Paid',
  `date_created` time NOT NULL DEFAULT current_timestamp(),
  `date_ofTermin` date NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `termin_list`
--

INSERT INTO `termin_list` (`id`, `doctor_code`, `client_id`, `doctors_id`, `service_id`, `remarks`, `status`, `date_created`, `date_ofTermin`, `date_updated`) VALUES
(0, '202200001', 7, 6, 5, NULL, 0, '17:46:00', '2022-12-16', '2022-12-16 10:45:12'),
(1, '202100001', 1, 1, 0, 'Sample Only', 1, '13:12:43', '2021-11-05', '2021-11-05 00:00:00'),
(3, '202100002', 4, 1, 0, 'Sample termin 2', 1, '15:10:47', '2021-11-05', '2021-11-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `termin_services`
--

CREATE TABLE `termin_services` (
  `termin_id` int(30) NOT NULL,
  `doctor_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `termin_services`
--

INSERT INTO `termin_services` (`termin_id`, `doctor_id`, `date_created`) VALUES
(1, 1, '2021-11-05 00:00:00'),
(1, 3, '2021-11-05 00:00:00'),
(2, 3, '2021-11-05 00:00:00'),
(2, 1, '2021-11-05 00:00:00'),
(2, 2, '2021-11-05 00:00:00'),
(3, 2, '2021-11-05 00:00:00'),
(3, 3, '2021-11-05 00:00:00'),
(1, 1, '2021-11-05 00:00:00'),
(1, 3, '2021-11-05 00:00:00'),
(2, 3, '2021-11-05 00:00:00'),
(2, 1, '2021-11-05 00:00:00'),
(2, 2, '2021-11-05 00:00:00'),
(3, 2, '2021-11-05 00:00:00'),
(3, 3, '2021-11-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'tedted admin', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1635556826', NULL, 1, '2021-01-20 14:02:37', '2022-04-01 15:08:31'),
(11, 'Claire', NULL, 'Blake', 'cblake', 'cd74fae0a3adf459f73bbf187607ccea', 'uploads/avatar-11.png?v=1635920566', NULL, 1, '2021-11-03 14:22:46', '2021-11-03 14:22:46'),
(14, 'John', NULL, 'Smith', 'jsmith', '39ce7e2a8573b41ce73b5ba41617f8f7', 'uploads/avatar-14.png?v=1636074078', NULL, 2, '2021-11-05 09:01:18', '2021-11-05 09:01:18'),
(15, 'Granit', NULL, 'Haliti', 'Granit', 'e33a892b39b9a68bd6fa56946785b2ee', NULL, NULL, 1, '2022-09-08 11:41:23', NULL),
(16, 'Kushtrim', NULL, 'Ibishi', 'Kusha', '5379068a395fb339266259d221d7773c', NULL, NULL, 1, '2022-11-29 16:09:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `user_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_list`
--
ALTER TABLE `client_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_meta`
--
ALTER TABLE `client_meta`
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client_seancat`
--
ALTER TABLE `client_seancat`
  ADD KEY `client_id` (`client_id`),
  ADD KEY `seanca_id` (`seanca_id`);

--
-- Indexes for table `doctors_list`
--
ALTER TABLE `doctors_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_meta`
--
ALTER TABLE `doctor_meta`
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `invoice_list`
--
ALTER TABLE `invoice_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `invoice_services`
--
ALTER TABLE `invoice_services`
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `seancat_list`
--
ALTER TABLE `seancat_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_list`
--
ALTER TABLE `services_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termin_services`
--
ALTER TABLE `termin_services`
  ADD KEY `termin_id` (`termin_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_list`
--
ALTER TABLE `client_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `doctors_list`
--
ALTER TABLE `doctors_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_list`
--
ALTER TABLE `invoice_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seancat_list`
--
ALTER TABLE `seancat_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services_list`
--
ALTER TABLE `services_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_meta`
--
ALTER TABLE `client_meta`
  ADD CONSTRAINT `client_meta_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_meta`
--
ALTER TABLE `doctor_meta`
  ADD CONSTRAINT `doctor_meta_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
