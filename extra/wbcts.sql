-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 10:07 PM
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
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blotter_records`
--

INSERT INTO `blotter_records` (`id`, `complainant_id`, `respondent_name`, `respondent_address`, `incident_location`, `incident_details`, `incident_type`, `blotter_status`, `investigating_officer`, `remarks`) VALUES
(1, 17, 'Jao Juan', 'Angono Mahabang Parang', 'Antipolo Rizal', 'Sinuntok ako sa mukha par tapos kinuha wallet ko.', 'Theft', 'pending', 'Michael Zapanta', 'Hulihin niyo pls, kinuwa niya pitaka q huhu.'),
(2, 17, 'Mark', 'Ministop', 'Ministop', 'Nagpabook si \"kuya\".', 'Staffa', 'pending', 'Michael', 'hahaha kuya ka pala eh'),
(3, 17, 'fasf', 'asfasf', 'hash', 'asha', 'Verbal Abuse', NULL, NULL, 'hashsash');

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
(17, 'JOhn Micko', 'Rapanot', 'johnmickooo28@gmail.com', '09194282431', '17c Daffodil St. Grandvalley Phase 3, Barangay Mahabang Parang Angono Rizal', '$2y$10$z/swtY3bczDKsUXfQ/AxAuNoE325bMehTicavWINaRzL40DS5QZXm', '2023-04-13 02:23:26', '2023-04-13 02:23:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blotter_records`
--
ALTER TABLE `blotter_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_id` (`complainant_id`);

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
-- AUTO_INCREMENT for table `blotter_records`
--
ALTER TABLE `blotter_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blotter_records`
--
ALTER TABLE `blotter_records`
  ADD CONSTRAINT `blotter_records_ibfk_1` FOREIGN KEY (`complainant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_customer_id` FOREIGN KEY (`complainant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
