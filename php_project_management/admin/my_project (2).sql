-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2026 at 10:29 PM
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
-- Database: `my_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `organization`, `email`, `contact_no`) VALUES
(1, 'TechCorp Solutions', 'TechCorp', 'contact@techcorp.com', '+1 555-0101'),
(2, 'Greenfield Construction', 'Greenfield Ltd.', 'info@greenfield.com', '+44 20 7946 0123'),
(3, 'MediHealth Systems', 'MediHealth', 'projects@medihealth.org', '+1 555-0199'),
(4, 'EduGlobal Institute', 'EduGlobal', 'admin@eduglobal.edu', '+61 3 9876 5432'),
(5, 'FinEdge Partners', 'FinEdge', 'clients@finedge.com', '+1 555-0178');

-- --------------------------------------------------------

--
-- Table structure for table `phases`
--

CREATE TABLE `phases` (
  `id` int(11) NOT NULL,
  `project_category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phases`
--

INSERT INTO `phases` (`id`, `project_category_id`, `title`) VALUES
(1, 1, 'Requirement Analysis'),
(2, 1, 'Design & Architecture'),
(3, 1, 'Development'),
(4, 1, 'Testing & QA'),
(5, 1, 'Deployment & Maintenance'),
(6, 2, 'Assessment & Audit'),
(7, 2, 'Planning & Procurement'),
(8, 2, 'Implementation'),
(9, 2, 'Testing & Validation'),
(10, 2, 'Rollout & Monitoring'),
(11, 3, 'Market Research'),
(12, 3, 'Strategy & Planning'),
(13, 3, 'Content Creation'),
(14, 3, 'Campaign Execution'),
(15, 3, 'Performance Review'),
(16, 4, 'Idea Generation'),
(17, 4, 'Feasibility Study'),
(18, 4, 'Prototyping'),
(19, 4, 'Testing & Evaluation'),
(20, 4, 'Final Report & Documentation'),
(21, 5, 'Client Onboarding'),
(22, 5, 'Diagnosis & Analysis'),
(23, 5, 'Solution Design'),
(33, 32, ''),
(34, 26, ''),
(35, 23, 'design');

-- --------------------------------------------------------

--
-- Table structure for table `phase_costs_and_timing`
--

CREATE TABLE `phase_costs_and_timing` (
  `id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `allocated_cost` decimal(15,2) DEFAULT NULL,
  `actual_cost` decimal(15,2) DEFAULT NULL,
  `actual_time` datetime DEFAULT NULL,
  `expected_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phase_costs_and_timing`
--

INSERT INTO `phase_costs_and_timing` (`id`, `phase_id`, `project_id`, `allocated_cost`, `actual_cost`, `actual_time`, `expected_time`) VALUES
(24, 1, 5, 80000.00, 75000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 3, 5, 150000.00, 160000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 2, 6, 90000.00, 40000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 4, 6, 100000.00, 50000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 6, 7, 70000.00, 72000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 8, 7, 200000.00, 210000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 7, 8, 120000.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 9, 8, 180000.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 11, 9, 30000.00, 28000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 13, 9, 40000.00, 38000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 12, 10, 25000.00, 18000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 14, 10, 35000.00, 22000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 16, 11, 60000.00, 58000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 18, 11, 75000.00, 70000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 17, 12, 100000.00, 95000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 19, 12, 120000.00, 110000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 21, 13, 15000.00, 14000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 22, 13, 20000.00, 19000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 22, 14, 25000.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 23, 14, 30000.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expected_starting_time` datetime DEFAULT NULL,
  `expected_ending_time` datetime DEFAULT NULL,
  `actual_starting_time` datetime DEFAULT NULL,
  `actual_ending_time` datetime DEFAULT NULL,
  `actual_cost` decimal(10,2) DEFAULT NULL,
  `budget_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `client_id`, `project_category_id`, `user_id`, `expected_starting_time`, `expected_ending_time`, `actual_starting_time`, `actual_ending_time`, `actual_cost`, `budget_cost`) VALUES
(5, 'E-Commerce Platform Development', 1, 1, 1, '2025-01-10 09:00:00', '2025-06-10 18:00:00', '2025-01-12 09:00:00', '2025-06-15 18:00:00', 480000.00, 450000.00),
(6, 'CRM System Upgrade', 2, 1, 2, '2025-02-01 09:00:00', '2025-07-01 18:00:00', '2025-02-03 09:00:00', NULL, 210000.00, 350000.00),
(7, 'Network Infrastructure Modernization', 3, 2, 1, '2025-03-15 09:00:00', '2025-08-15 18:00:00', '2025-03-15 09:00:00', '2025-08-20 18:00:00', 620000.00, 600000.00),
(8, 'Data Center Migration', 4, 2, 3, '2025-04-01 09:00:00', '2025-09-01 18:00:00', NULL, NULL, 0.00, 750000.00),
(9, 'Summer Brand Awareness Campaign', 5, 3, 2, '2025-05-01 09:00:00', '2025-07-01 18:00:00', '2025-05-01 09:00:00', '2025-07-05 18:00:00', 95000.00, 100000.00),
(10, 'Product Launch Marketing Drive', 1, 3, 4, '2025-06-01 09:00:00', '2025-08-01 18:00:00', '2025-06-02 09:00:00', NULL, 60000.00, 120000.00),
(11, 'AI Chatbot Feasibility Research', 2, 4, 5, '2025-01-20 09:00:00', '2025-05-20 18:00:00', '2025-01-22 09:00:00', '2025-05-25 18:00:00', 175000.00, 180000.00),
(12, 'Renewable Energy Tech R&D', 3, 4, 3, '2025-03-01 09:00:00', '2025-10-01 18:00:00', '2025-03-05 09:00:00', NULL, 320000.00, 400000.00),
(13, 'Business Process Consulting', 4, 5, 4, '2025-02-15 09:00:00', '2025-04-15 18:00:00', '2025-02-15 09:00:00', '2025-04-18 18:00:00', 45000.00, 50000.00),
(14, 'IT Strategy Advisory', 5, 5, 5, '2025-05-10 09:00:00', '2025-07-10 18:00:00', NULL, NULL, 0.00, 80000.00);

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE `project_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`id`, `name`) VALUES
(1, 'Software Development'),
(2, 'Infrastructure Upgrade'),
(3, 'Marketing Campaign'),
(4, 'Research & Development'),
(5, 'Consulting Service');

-- --------------------------------------------------------

--
-- Table structure for table `project_teams`
--

CREATE TABLE `project_teams` (
  `id` int(11) NOT NULL,
  `team_id` int(20) NOT NULL,
  `team_role_id` int(20) NOT NULL,
  `team_member_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_teams`
--

INSERT INTO `project_teams` (`id`, `team_id`, `team_role_id`, `team_member_id`) VALUES
(26, 1, 3, 1),
(27, 1, 1, 2),
(28, 6, 7, 3),
(29, 6, 8, 4),
(30, 2, 6, 5),
(31, 2, 1, 6),
(32, 7, 7, 7),
(33, 7, 3, 8),
(34, 3, 9, 9),
(35, 3, 1, 10),
(36, 8, 9, 1),
(37, 8, 4, 2),
(38, 4, 6, 3),
(39, 4, 3, 4),
(40, 9, 3, 5),
(41, 9, 5, 6),
(42, 5, 10, 7),
(43, 5, 1, 8),
(44, 12, 10, 9),
(45, 12, 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Editor');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `assign_to_team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `phase_id`, `title`, `assign_to_team_id`) VALUES
(23, 5, 1, 'Requirement Gathering Session', 1),
(24, 5, 3, 'Build Core Module', 1),
(25, 6, 2, 'System Architecture Design', 6),
(26, 6, 4, 'QA Test Cases Preparation', 6),
(27, 7, 6, 'Network Audit Report', 2),
(28, 7, 8, 'Hardware Implementation', 2),
(29, 8, 7, 'Procurement Planning', 7),
(30, 8, 9, 'Validation Testing', 7),
(31, 9, 11, 'Target Audience Research', 3),
(32, 9, 13, 'Ad Content Creation', 3),
(33, 10, 12, 'Campaign Strategy Draft', 8),
(34, 10, 14, 'Campaign Launch', 8),
(35, 11, 16, 'Idea Brainstorming Session', 4),
(36, 11, 18, 'Build Working Prototype', 4),
(37, 12, 17, 'Feasibility Report', 9),
(38, 12, 19, 'Evaluation & Feedback', 9),
(39, 13, 21, 'Client Kickoff Meeting', 5),
(40, 13, 22, 'Solution Blueprint', 5),
(41, 14, 22, 'Diagnosis Workshop', 12),
(42, 14, 23, 'Implementation Support Plan', 12);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `project_id`) VALUES
(1, 'Alpha Development Team', 5),
(2, 'Network Upgrade Crew', 7),
(3, 'Marketing Strike Team', 9),
(4, 'Innovation Research Squad', 11),
(5, 'Client Advisory Team', 13),
(6, 'Backend Engineering Team', 6),
(7, 'Cloud Migration Team', 8),
(8, 'Social Media Growth Team', 10),
(9, 'AI Prototype Lab', 12),
(12, 'ABC_TEAM', 14);

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `name`) VALUES
(1, 'Rafiul Islam'),
(2, 'Tanjila Akter'),
(3, 'Shakib Hasan'),
(4, 'Nusrat Jahan'),
(5, 'Mehedi Hasan'),
(6, 'Farzana Begum'),
(7, 'Abdullah Al Mamun'),
(8, 'Sadia Sultana'),
(9, 'Imran Khan'),
(10, 'Lamia Rahman');

-- --------------------------------------------------------

--
-- Table structure for table `team_roles`
--

CREATE TABLE `team_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_roles`
--

INSERT INTO `team_roles` (`id`, `name`) VALUES
(1, 'Project Manager'),
(2, 'Team Lead'),
(3, 'Software Developer'),
(4, 'UI/UX Designer'),
(5, 'QA Engineer'),
(6, 'Business Analyst'),
(7, 'DevOps Engineer'),
(8, 'Database Administrator'),
(9, 'Marketing Specialist'),
(10, 'Technical Consultant');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `password`) VALUES
(1, 'Alice Johnson', 'alice.johnson@example.com', 1, 'pass123Alice'),
(2, 'Bob Smith', 'bob.smith@example.com', 2, 'bobSecure!45'),
(3, 'Carla Mendoza', 'carla.m@example.com', 2, 'CarlaM2024'),
(4, 'David Kim', 'david.kim@example.com', 3, 'dkim_pass99'),
(5, 'Eva Green', 'eva.green@example.com', 3, 'evaG$77green');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phases`
--
ALTER TABLE `phases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phase_costs_and_timing`
--
ALTER TABLE `phase_costs_and_timing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_teams`
--
ALTER TABLE `project_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_roles`
--
ALTER TABLE `team_roles`
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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `phases`
--
ALTER TABLE `phases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `phase_costs_and_timing`
--
ALTER TABLE `phase_costs_and_timing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_teams`
--
ALTER TABLE `project_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `team_roles`
--
ALTER TABLE `team_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
