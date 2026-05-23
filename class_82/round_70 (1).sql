-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2026 at 08:59 AM
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
-- Database: `round_70`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEmployeeByPosition` (`p_positon_name` VARCHAR(100))   begin 
select * from vw_employee_summary  where position_name= p_positon_name;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `hiredate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `position_id`, `salary`, `hiredate`) VALUES
(1, 'John Doe', 1, 5000, '2023-01-15 00:00:00'),
(2, 'Jane Smith', 2, 2800, '2023-03-20 00:00:00'),
(3, 'Bob Johnson', 3, 2500, '2023-06-10 00:00:00'),
(4, 'Alice Williams', 2, 3200, '2023-02-10 00:00:00'),
(5, 'Charlie Brown', 1, 6200, '2022-11-05 00:00:00'),
(6, 'Diana Prince', 3, 2700, '2023-07-22 00:00:00'),
(8, 'Fiona Apple', 1, 5800, '2022-09-30 00:00:00'),
(9, 'George Lopez', 3, 2300, '2023-08-14 00:00:00'),
(10, 'Hannah Baker', 2, 3100, '2023-05-01 00:00:00'),
(11, 'Ian Wright', 1, 7000, '2022-06-25 00:00:00'),
(12, 'Julia Roberts', 3, 2600, '2023-09-12 00:00:00'),
(13, 'Kevin Hart', 2, 2950, '2023-10-03 00:00:00'),
(14, 'Laura Linney', 1, 5500, '2023-01-20 00:00:00'),
(15, 'Mike Ross', 2, 3600, '2023-11-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `manufactures`
--

CREATE TABLE `manufactures` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufactures`
--

INSERT INTO `manufactures` (`id`, `name`, `address`, `is_active`) VALUES
(1, 'RFL', 'Rangpur', 1),
(2, 'Fresh', 'Dhaka', 1),
(3, 'Goldmark', 'Dhaka', 1),
(4, 'HP', 'USA', 1),
(9, 'DELL', 'USA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `position_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position_name`) VALUES
(1, 'Manager'),
(2, 'Developer'),
(3, 'Marketing Associate');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `manufacture_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `manufacture_id`) VALUES
(1, 'laptop', 1200, 1),
(2, 'mobile', 1000, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_employee_summary`
-- (See below for the actual view)
--
CREATE TABLE `vw_employee_summary` (
`name` varchar(100)
,`position_name` varchar(100)
,`salary` float
);

-- --------------------------------------------------------

--
-- Structure for view `vw_employee_summary`
--
DROP TABLE IF EXISTS `vw_employee_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_employee_summary`  AS SELECT `e`.`name` AS `name`, `p`.`position_name` AS `position_name`, `e`.`salary` AS `salary` FROM (`employees` `e` join `positions` `p`) WHERE `e`.`position_id` = `p`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufactures`
--
ALTER TABLE `manufactures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `manufactures`
--
ALTER TABLE `manufactures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
