-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 03:08 AM
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
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `firstname`, `lastname`, `role`, `email`, `username`, `password`, `is_verified`, `is_archived`, `created_at`, `updated_at`) VALUES
(1, 'john', 'Micko', 1, 'johnmickooo28@gmail.com', 'admin', 'admin', 1, 0, '2023-05-12 14:06:23', '2023-05-12 14:06:23'),
(33, 'JOhn Micko', 'Rapanot', 2, '', 'pewdie852', 'admin', 1, 0, '2023-05-22 01:50:39', '2023-05-22 01:50:39'),
(44, 'John Micko', 'Micko', 1, 'johnmickooo28@gmail.com', 'johnmickorpnt', 'admin', 0, 1, '2023-12-10 23:23:55', '2023-12-10 23:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `user_id`, `action`, `created_at`) VALUES
(10, 1, 'Created a new blotter record', '2023-05-28 11:46:44'),
(11, NULL, 'Archived a row from the blotter_records table', '2023-05-28 11:55:05'),
(12, NULL, 'Archived a row from the blotter_records table', '2023-05-28 11:55:44'),
(13, NULL, 'Archived a row from the blotter_records table', '2023-05-28 11:55:49'),
(14, NULL, 'Archived a row from the blotter_records table', '2023-05-28 11:55:54'),
(15, NULL, 'Archived a row from the blotter_records table', '2023-05-28 11:56:02'),
(16, NULL, 'Archived a row from the blotter_records table', '2023-05-28 11:56:47'),
(17, NULL, 'Archived a row from the blotter_records table', '2023-05-28 11:57:36'),
(18, NULL, 'Archived a row from the blotter_records table', '2023-05-28 11:57:41'),
(19, 1, 'Archived a row from the blotter_records table and ID30', '2023-05-28 11:58:21'),
(20, 1, 'Updated a blotter record', '2023-05-28 12:04:39'),
(21, 1, 'Archived a row from the admin_users table and ID: 44', '2023-12-10 08:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `blotter_records`
--

CREATE TABLE `blotter_records` (
  `id` int(11) NOT NULL,
  `complainant_id` int(11) NOT NULL,
  `complainant_name` varchar(255) NOT NULL,
  `respondent_name` varchar(255) NOT NULL,
  `respondent_address` varchar(255) NOT NULL,
  `incident_location` varchar(255) NOT NULL,
  `incident_details` longtext NOT NULL,
  `incident_type` varchar(255) NOT NULL,
  `blotter_status` varchar(255) DEFAULT 'pending',
  `investigating_officer` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) NOT NULL,
  `qrcode` varchar(255) NOT NULL,
  `is_archived` tinyint(1) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blotter_records`
--

INSERT INTO `blotter_records` (`id`, `complainant_id`, `complainant_name`, `respondent_name`, `respondent_address`, `incident_location`, `incident_details`, `incident_type`, `blotter_status`, `investigating_officer`, `remarks`, `qrcode`, `is_archived`, `created_at`, `updated_at`) VALUES
(1, 17, '', 'Jao Juan', 'Angono Mahabang Parang', 'Antipolo Rizal', 'Sinuntok ako sa mukha par tapos kinuha wallet ko.', 'Theft', 'pending', 'Michael Zapanta', 'Hulihin niyo pls, kinuwa niya pitaka q huhu.', '', 0, '2023-05-21 08:35:18', '2023-05-21 08:35:18'),
(6, 17, '', 'fasf', 'asfasf', 'das', 'asd', 'asd', 'asd', 'asd', 'nothing', '', 0, '2023-05-21 23:40:57', '2023-05-21 23:40:57'),
(7, 17, '', 'ako lang to', 'sheeesh', 'das', 'dasd', 'asf', 'asf', 'asd', 'asf', '', 0, '2023-05-22 03:52:52', '2023-05-22 03:52:52'),
(11, 17, '', 'fasf', 'Dito lang', 'das', 'dasd', 'asd', 'das', 'dasd', 'asdda', '', 0, '2023-05-22 04:13:39', '2023-05-22 04:13:39'),
(12, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:40:51', '2023-05-22 04:40:51'),
(13, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:42:14', '2023-05-22 04:42:14'),
(14, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:42:16', '2023-05-22 04:42:16'),
(15, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:42:16', '2023-05-22 04:42:16'),
(16, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:42:21', '2023-05-22 04:42:21'),
(17, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:43:55', '2023-05-22 04:43:55'),
(18, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:43:57', '2023-05-22 04:43:57'),
(19, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:45:19', '2023-05-22 04:45:19'),
(20, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:45:20', '2023-05-22 04:45:20'),
(21, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:45:35', '2023-05-22 04:45:35'),
(22, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:47:26', '2023-05-22 04:47:26'),
(23, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:50:01', '2023-05-22 04:50:01'),
(24, 17, '', 'fasf', 'asfasf', 'dasdsa', 'das', 'Physical Abuse', NULL, NULL, 'dassad', '', 0, '2023-05-22 04:50:26', '2023-05-22 04:50:26'),
(25, 17, '', 'fasf', 'asfasf', 'fas', 'asf', 'Physical Abuse', NULL, NULL, 'fasfasf', '', 0, '2023-05-22 10:42:49', '2023-05-22 10:42:49'),
(26, 17, '', 'fasf', 'asfasf', 'fasf', 'asfsaf', 'Physical Abuse', NULL, NULL, 'fsafsa', '', 0, '2023-05-22 10:43:22', '2023-05-22 10:43:22'),
(27, 17, '', 'fasf', 'asfasf', 'fasf', 'asfsaf', 'Physical Abuse', NULL, NULL, 'fsafsa', '', 0, '2023-05-22 10:43:32', '2023-05-22 10:43:32'),
(28, 17, '', 'fasf', 'asfasf', 'fasf', 'asfsaf', 'Physical Abuse', NULL, NULL, 'fsafsa', '', 0, '2023-05-22 10:43:38', '2023-05-22 10:43:38'),
(29, 18, '', 'fasf', 'asfasf', 'fasf', 'asfsaf', 'Physical Abuse', '', '', 'fsafsa', '', NULL, '2023-05-22 10:43:43', '2023-05-22 10:43:43'),
(30, 17, '', 'fasf', 'asfasf', 'fasf', 'asfsaf', 'Physical Abuse', NULL, NULL, 'fsafsa', '', 1, '2023-05-22 10:47:34', '2023-05-22 10:47:34'),
(31, 17, '', 'fasf', 'asfasf', 'gas', 'asga', 'Verbal Abuse', NULL, NULL, 'gasgasg', '', 1, '2023-05-22 10:47:49', '2023-05-22 10:47:49'),
(32, 17, '', 'fasf', 'asfasf', 'gas', 'asga', 'Verbal Abuse', NULL, NULL, 'gasgasg', '', 1, '2023-05-22 10:48:13', '2023-05-22 10:48:13'),
(33, 17, '', 'fasf', 'asfasf', 'gas', 'asga', 'Verbal Abuse', NULL, NULL, 'gasgasg', '', 1, '2023-05-22 10:48:25', '2023-05-22 10:48:25'),
(34, 17, '', 'fasf', 'asfasf', 'gas', 'asga', 'Verbal Abuse', NULL, NULL, 'gasgasg', '', 1, '2023-05-22 10:48:51', '2023-05-22 10:48:51'),
(35, 17, '', 'gas', 'gas', 'gas', 'ags', 'Theft', NULL, NULL, 'gasg', '', 1, '2023-05-22 10:49:30', '2023-05-22 10:49:30'),
(36, 17, '', 'gas', 'gas', 'gas', 'ags', 'Theft', NULL, NULL, 'gasg', '', 1, '2023-05-22 10:49:58', '2023-05-22 10:49:58'),
(37, 17, '', 'gas', 'gas', 'gas', 'ags', 'Theft', NULL, NULL, 'gasg', '', 1, '2023-05-22 10:54:43', '2023-05-22 10:54:43'),
(38, 17, '', 'fasf', 'asfasf', 'fszdf', 'fsdfsd', 'Verbal Abuse', NULL, NULL, 'fsafsayrdy', '', 1, '2023-05-22 22:15:16', '2023-05-22 22:15:16'),
(39, 17, '', 'fasf', 'asfasf', 'gasg', 'gsa', 'Theft', NULL, NULL, 'gasga', '', 1, '2023-05-22 22:53:36', '2023-05-22 22:53:36'),
(41, 17, '', 'fasf', 'asfasf', 'das', 'fasf', '', 'fsaf', 'fsafa', 'fsafsa', '', NULL, '2023-05-29 01:38:49', '2023-05-29 01:38:49'),
(42, 17, '', 'fasf', 'asfasf', 'das', 'fasf', '', 'fsaf', 'fsafa', 'fsafsa', '', NULL, '2023-05-29 01:40:23', '2023-05-29 01:40:23'),
(43, 17, '', 'fasf', 'asfasf', 'das', 'fasf', '', 'fsaf', 'fsafa', 'fsafsa', '', NULL, '2023-05-29 01:41:42', '2023-05-29 01:41:42'),
(44, 17, '', 'fasf', 'asfasf', 'das', 'fasf', '', 'fsaf', 'fsafa', 'fsafsa', '', NULL, '2023-05-29 01:43:35', '2023-05-29 01:43:35'),
(45, 17, '', 'fasf', 'asfasf', 'das', 'fasf', 'asd', 'asd', 'asd', 'fsafsa', '', NULL, '2023-05-29 01:43:58', '2023-05-29 01:43:58'),
(46, 17, '', 'fasf', 'asfasf', 'das', 'fasf', 'asd', 'asd', 'asd', 'fsafsa', '', NULL, '2023-05-29 01:44:24', '2023-05-29 01:44:24'),
(47, 17, '', 'fasf', 'asfasf', 'das', 'fasf', 'asd', 'asd', 'asd', 'fsafsa', '', NULL, '2023-05-29 01:45:06', '2023-05-29 01:45:06'),
(48, 17, '', 'fasf', 'asfasf', 'das', 'fasf', 'asd', 'asd', 'asd', 'fsafsa', '', NULL, '2023-05-29 01:45:07', '2023-05-29 01:45:07'),
(49, 17, '', 'fasf', 'asfasf', 'das', 'fasf', 'asd', 'asd', 'asd', 'fsafsa', '', NULL, '2023-05-29 01:45:57', '2023-05-29 01:45:57'),
(50, 17, '', 'fasf', 'asfasf', 'das', 'fasf', 'asd', 'asd', 'asd', 'fsafsa', '', NULL, '2023-05-29 01:46:29', '2023-05-29 01:46:29'),
(51, 17, '', 'fasf', 'asfasf', 'das', 'fasf', 'asd', 'asd', 'asd', 'fsafsa', '', NULL, '2023-05-29 01:46:35', '2023-05-29 01:46:35'),
(52, 17, '', 'fasf', 'asfasf', 'das', 'fasf', 'asd', 'asd', 'asd', 'fsafsa', '', NULL, '2023-05-29 01:46:44', '2023-05-29 01:46:44'),
(53, 17, '', 'fasf', 'asfasf', 'gasg', 'gasga', 'Physical Abuse', NULL, NULL, 'gasgasgsagasgasg', '', 0, '2023-05-29 02:17:48', '2023-05-29 02:17:48'),
(54, 17, '', 'ako lang to', 'asfasf', 'sdas', 'das', 'Physical Abuse', NULL, NULL, 'dasdsad', '', 0, '2023-12-09 00:39:43', '2023-12-09 00:39:43'),
(55, 17, '', 'fasf', 'asfasf', 'gasg', 'gsaga', 'Theft', NULL, NULL, 'gasggasags', '', 0, '2023-12-09 05:03:26', '2023-12-09 05:03:26'),
(56, 17, '', 'fasf', 'asfasf', 'gas', 'gas', 'Theft', NULL, NULL, 'gas', '', 0, '2023-12-09 05:11:36', '2023-12-09 05:11:36'),
(57, 17, '', 'fasf', 'gas', 'gasg', 'gasga', 'Physical Abuse', NULL, NULL, 'gasgsa', '', 0, '2023-12-09 05:12:22', '2023-12-09 05:12:22'),
(58, 17, '', 'fasf', 'gas', 'gasg', 'gasga', 'Physical Abuse', NULL, NULL, 'gasgsa', '', 0, '2023-12-09 05:12:52', '2023-12-09 05:12:52'),
(59, 17, '', 'ako lang to', 'gas', 'gas', 'gas', 'Verbal Abuse', NULL, NULL, 'gasgasg', '', 0, '2023-12-09 05:27:39', '2023-12-09 05:27:39'),
(60, 17, '', 'fasf', 'asfasf', 'gas', 'gasgas', 'Physical Abuse', NULL, 'ako', 'asgasggsa', '', 0, '2023-12-09 05:31:47', '2023-12-09 05:31:47'),
(61, 17, '', 'ako lang to', 'gas', 'hashsa', 'hsahsa', 'other', NULL, NULL, 'hashashassh', '', 0, '2023-12-11 02:55:47', '2023-12-11 02:55:47'),
(62, 17, '', 'ako lang to', 'Dito lang', 'hashas', 'hashas', 'Verbal Abuse', NULL, NULL, 'hashsa', '', 0, '2023-12-11 03:28:37', '2023-12-11 03:28:37'),
(63, 17, '', 'ako lang to', 'Dito lang', 'gasgsa', 'gasgas', 'Verbal Abuse', NULL, NULL, 'gsagasg', '', 0, '2023-12-11 03:34:35', '2023-12-11 03:34:35'),
(64, 17, '', 'ako lang to', 'gas', 'hashsa', 'ashhsa', 'Verbal Abuse', NULL, NULL, 'hashsas', '', 0, '2023-12-11 03:35:41', '2023-12-11 03:35:41'),
(65, 17, '', 'ako lang to', 'gas', 'hashsa', 'ashhsa', 'Verbal Abuse', NULL, NULL, 'hashsas', '', 0, '2023-12-11 03:36:22', '2023-12-11 03:36:22'),
(66, 17, '', 'fasf', 'gas', 'gasga', 'gsagas', 'Verbal Abuse', NULL, NULL, 'gasgasgs', '', 0, '2023-12-11 03:38:48', '2023-12-11 03:38:48'),
(67, 17, '', 'ako lang to', 'gas', 'hashsa', 'hashsa', 'other', NULL, NULL, 'hashsa', '../../../assets/qrcode1702237201.png', 0, '2023-12-11 03:40:01', '2023-12-11 03:40:01'),
(68, 17, 'gasgasg', 'hsahsa', 'hsahas', 'hsahas', 'hashasha', 'Physical Abuse', NULL, NULL, 'hsahashhas', '../../../assets/qrcode1702237745.png', 0, '2023-12-11 03:49:05', '2023-12-11 03:49:05');

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
  `is_archived` int(11) NOT NULL,
  `date_settled` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settlements`
--

INSERT INTO `settlements` (`id`, `blotter_id`, `resolution`, `settlement_details`, `settled_by`, `remarks`, `is_archived`, `date_settled`, `updated_at`) VALUES
(1, 1, 'yes', 'yeye', '', '', 0, '2023-05-10 15:59:16', '2023-05-10 15:59:16'),
(3, 6, 'haha', 'haha', 'haha', 'asd', 0, '0000-00-00 00:00:00', '2023-05-22 03:41:10'),
(4, 6, 'yes', 'yeye', '', '', 0, '2023-05-10 15:59:16', '2023-05-22 03:45:49'),
(5, 1, 'haha', 'haha', 'haha', 'asdfthftghfth', 0, '0000-00-00 00:00:00', '2023-05-22 03:45:58'),
(8, 6, 'haha', 'hahaururdturu', 'haha', 'fasf', 0, '0000-00-00 00:00:00', '2023-05-22 03:53:42');

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
  `is_archived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `address`, `password`, `is_archived`, `created_at`, `updated`) VALUES
(17, 'John Micko', 'Rapanot', 'johnmickooo28@gmail.com', '09194282431', '17c Daffodil St. Grandvalley Phase 3, Barangay Mahabang Parang Angono Rizal', '$2y$10$z/swtY3bczDKsUXfQ/AxAuNoE325bMehTicavWINaRzL40DS5QZXm', 0, '2023-04-13 02:23:26', '2023-04-13 02:23:26'),
(18, 'JOhn Micko', 'Rapanot', 'johnmickorapanot@yahoo.com', '09194282431', '17c Daffodil St. Grandvalley Phase 3, Barangay Mahabang Parang Angono Rizal', '$2y$10$fnkk.ufQoes1AHX9RWqbPuaNtVKG8LWq.EZin0aS0GRcChNJuVNyK', 0, '2023-04-13 10:57:35', '2023-04-13 10:57:35'),
(23, 'John Micko', 'Rapanot', 'johnmickooo28x@gmail.com', '09194282431', '17c Daffodil St. Grandvalley Phase 3, Barangay Mahabang Parang Angono Rizal', 'Siah311_project!', 1, '2023-05-22 00:26:34', '2023-05-22 00:26:34'),
(24, 'JOhn Micko', 'Rapanot', 'johnmickooo28@gmail.comfasf', '09194282431', '17c Daffodil St. Grandvalley Phase 3, Barangay Mahabang Parang Angono Rizal', '$2y$10$k4QlVP.3TZKVBQq5L9T.vexGBa9ESK6IOj6T1koiuJ8ogNwilMjO2', 0, '2023-05-29 02:15:06', '2023-05-29 02:15:06');

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
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_trail_user` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `blotter_records`
--
ALTER TABLE `blotter_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `settlements`
--
ALTER TABLE `settlements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
-- Constraints for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD CONSTRAINT `fk_audit_trail_user` FOREIGN KEY (`user_id`) REFERENCES `admin_users` (`id`);

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
