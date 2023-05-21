-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 10:17 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wbcts`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `permission_create` tinyint(1) NOT NULL DEFAULT 0,
  `permission_read` tinyint(1) NOT NULL DEFAULT 1,
  `permission_write` tinyint(1) NOT NULL DEFAULT 0,
  `permission_update` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `role`, `permission_create`, `permission_read`, `permission_write`, `permission_update`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, 1, 1, 1, '2023-05-12 13:03:20', '2023-05-12 13:03:20'),
(2, 'staff', 0, 1, 1, 1, '2023-05-12 13:03:42', '2023-05-12 13:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `firstname`, `lastname`, `role`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'john', 'Micko', 1, 'admin', 'admin', '2023-05-12 14:06:23', '2023-05-12 14:06:23'),
(33, 'JOhn Micko', 'Rapanot', 2, 'pewdie852', 'admin', '2023-05-22 01:50:39', '2023-05-22 01:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `blotter_records`
--

CREATE TABLE `blotter_records` (
  `id` int(11) NOT NULL,
  `complainant_id` int(11) NOT NULL,
  `respondent_name` varchar(255) NOT NULL,
  `respondent_address` varchar(255) NOT NULL,
  `incident_location` varchar(255) NOT NULL,
  `incident_details` longtext NOT NULL,
  `incident_type` varchar(255) NOT NULL,
  `blotter_status` varchar(255) DEFAULT 'pending',
  `investigating_officer` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blotter_records`
--

INSERT INTO `blotter_records` (`id`, `complainant_id`, `respondent_name`, `respondent_address`, `incident_location`, `incident_details`, `incident_type`, `blotter_status`, `investigating_officer`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 17, 'Jao Juan', 'Angono Mahabang Parang', 'Antipolo Rizal', 'Sinuntok ako sa mukha par tapos kinuha wallet ko.', 'Theft', 'pending', 'Michael Zapanta', 'Hulihin niyo pls, kinuwa niya pitaka q huhu.', '2023-05-21 08:35:18', '2023-05-21 08:35:18'),
(6, 17, 'fasf', 'asfasf', 'das', 'asd', 'asd', 'asd', 'asd', 'nothing', '2023-05-21 23:40:57', '2023-05-21 23:40:57'),
(7, 17, 'ako lang to', 'sheeesh', 'das', 'dasd', 'asf', 'asf', 'asd', 'asf', '2023-05-22 03:52:52', '2023-05-22 03:52:52'),
(11, 17, 'fasf', 'Dito lang', 'das', 'dasd', 'asd', 'das', 'dasd', 'asdda', '2023-05-22 04:13:39', '2023-05-22 04:13:39');

-- --------------------------------------------------------

--
-- Table structure for table `settlements`
--

CREATE TABLE `settlements` (
  `id` int(11) NOT NULL,
  `blotter_id` int(11) NOT NULL,
  `resolution` varchar(255) NOT NULL,
  `settlement_details` longtext NOT NULL,
  `settled_by` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `date_settled` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settlements`
--

INSERT INTO `settlements` (`id`, `blotter_id`, `resolution`, `settlement_details`, `settled_by`, `remarks`, `date_settled`, `updated_at`) VALUES
(1, 1, 'yes', 'yeye', '', '', '2023-05-10 15:59:16', '2023-05-10 15:59:16'),
(3, 6, 'haha', 'haha', 'haha', 'asd', '0000-00-00 00:00:00', '2023-05-22 03:41:10'),
(4, 6, 'yes', 'yeye', '', '', '2023-05-10 15:59:16', '2023-05-22 03:45:49'),
(5, 1, 'haha', 'haha', 'haha', 'asdfthftghfth', '0000-00-00 00:00:00', '2023-05-22 03:45:58'),
(8, 6, 'haha', 'hahaururdturu', 'haha', 'fasf', '0000-00-00 00:00:00', '2023-05-22 03:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `address`, `password`, `created_at`, `updated`) VALUES
(17, 'John Micko', 'Rapanot', 'johnmickooo28@gmail.com', '09194282431', '17c Daffodil St. Grandvalley Phase 3, Barangay Mahabang Parang Angono Rizal', '$2y$10$z/swtY3bczDKsUXfQ/AxAuNoE325bMehTicavWINaRzL40DS5QZXm', '2023-04-13 02:23:26', '2023-04-13 02:23:26'),
(18, 'JOhn Micko', 'Rapanot', 'johnmickorapanot@yahoo.com', '09194282431', '17c Daffodil St. Grandvalley Phase 3, Barangay Mahabang Parang Angono Rizal', '$2y$10$fnkk.ufQoes1AHX9RWqbPuaNtVKG8LWq.EZin0aS0GRcChNJuVNyK', '2023-04-13 10:57:35', '2023-04-13 10:57:35'),
(23, 'John Micko', 'Rapanot', 'johnmickooo28x@gmail.com', '09194282431', '17c Daffodil St. Grandvalley Phase 3, Barangay Mahabang Parang Angono Rizal', 'Siah311_project!', '2023-05-22 00:26:34', '2023-05-22 00:26:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_User_roles` (`role`);

--
-- Indexes for table `blotter_records`
--
ALTER TABLE `blotter_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_id` (`complainant_id`);

--
-- Indexes for table `settlements`
--
ALTER TABLE `settlements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_blotter` (`blotter_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `blotter_records`
--
ALTER TABLE `blotter_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settlements`
--
ALTER TABLE `settlements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD CONSTRAINT `FK_User_roles` FOREIGN KEY (`role`) REFERENCES `admin_roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_roles` FOREIGN KEY (`role`) REFERENCES `admin_roles` (`id`);

--
-- Constraints for table `blotter_records`
--
ALTER TABLE `blotter_records`
  ADD CONSTRAINT `blotter_records_ibfk_1` FOREIGN KEY (`complainant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_customer_id` FOREIGN KEY (`complainant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settlements`
--
ALTER TABLE `settlements`
  ADD CONSTRAINT `FK_blotter` FOREIGN KEY (`blotter_id`) REFERENCES `blotter_records` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
