-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2026 at 05:38 AM
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
-- Database: `new_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `score` float DEFAULT 0,
  `exam_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `student_id`, `score`, `exam_type`) VALUES
(1, 1, 90, 'Mid-1'),
(2, 2, 80, 'Mid-1'),
(3, 4, 35, 'Mid-1'),
(4, 6, 20, 'Mid-1'),
(5, 9, 88, 'Mid-2'),
(6, 12, 33, 'Mid-2'),
(7, 1, 45, 'Mid-2'),
(8, 1, 88, 'Final');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(5) UNSIGNED NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `is_inactive` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `email`, `phone`, `address`, `is_inactive`) VALUES
(1, 'Mina', 'mina@example.com', NULL, 'Mirpur', 0),
(2, 'Raju', 'raju@example.com', NULL, 'Mothijheel', 1),
(4, 'Lali', 'lali@example.com', NULL, 'Chittagong', 0),
(6, 'Dipu', 'dipu@example.com', NULL, 'Mothijheel', 1),
(9, 'Ali', 'ali@mail.com', '01912345678', 'Khulna', 1),
(12, 'Arif', 'arif@example.com', NULL, NULL, 0),
(13, 'Redoy 70', 'doy@mail.com', NULL, NULL, 0);

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `add_student` AFTER INSERT ON `students` FOR EACH ROW insert into student_logs(student_id,status,time)
values(new.id,"Added",now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `modify_student` AFTER UPDATE ON `students` FOR EACH ROW insert into student_logs(student_id,status,time)
values(old.id,"Updated",now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `remove_student` AFTER DELETE ON `students` FOR EACH ROW insert into student_logs(student_id,status,time)
values(old.id,"Deleted",now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `student_logs`
--

CREATE TABLE `student_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_logs`
--

INSERT INTO `student_logs` (`id`, `student_id`, `status`, `time`) VALUES
(1, 13, 'Added', '2026-05-19 06:21:56'),
(2, 13, 'Updated', '2026-05-19 06:36:26'),
(3, 13, 'Updated', '2026-05-19 06:38:00'),
(4, 8, 'Deleted', '2026-05-19 06:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_student_results`
-- (See below for the actual view)
--
CREATE TABLE `view_student_results` (
`student_id` int(11)
,`name` varchar(100)
,`marks` float
,`exam_type` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `view_student_results`
--
DROP TABLE IF EXISTS `view_student_results`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_student_results`  AS SELECT `r`.`student_id` AS `student_id`, `s`.`full_name` AS `name`, `r`.`score` AS `marks`, `r`.`exam_type` AS `exam_type` FROM (`students` `s` join `results` `r`) WHERE `r`.`student_id` = `s`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student_logs`
--
ALTER TABLE `student_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student_logs`
--
ALTER TABLE `student_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
