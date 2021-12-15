-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2021 at 12:50 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_locator`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_bot`
--

CREATE TABLE `chat_bot` (
  `chat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_type_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `subdomain_id` int(11) NOT NULL,
  `course_name` varchar(300) NOT NULL,
  `institute_id` int(30) NOT NULL,
  `course_description` text NOT NULL,
  `course_duration` int(11) NOT NULL,
  `duration_type` varchar(150) NOT NULL,
  `course_fee` double(10,2) NOT NULL,
  `semester_fee` double(10,2) NOT NULL,
  `course_enter_by` int(11) NOT NULL,
  `course_status` enum('active','inactive') NOT NULL,
  `course_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_type_id`, `domain_id`, `subdomain_id`, `course_name`, `institute_id`, `course_description`, `course_duration`, `duration_type`, `course_fee`, `semester_fee`, `course_enter_by`, `course_status`, `course_date`) VALUES
(62, 16, 32, 7, 'Marketing Degree', 3, 'This is a 3 years degree.', 3, 'Years', 1000000.00, 20000.00, 20, 'active', '2021-09-24'),
(63, 16, 39, 6, 'Degree in Economics', 3, 'This is a 2 years degree.', 2, 'Years', 74444000.00, 50000.00, 20, 'active', '2021-09-24'),
(64, 25, 34, 4, 'Engineering Dimploma', 5, 'A good course for students who are seeking to be engineers.', 24, 'Months', 12000000.00, 40000.00, 20, 'active', '2021-09-24'),
(65, 25, 39, 6, 'Diploma in Economics', 9, 'This is a good diploma', 4, 'Months', 670000.00, 500000.00, 20, 'active', '2021-09-24'),
(79, 17, 42, 5, 'rocket science', 3, 'Good one', 4, 'Years', 67000000.00, 670000.00, 20, 'active', '2021-09-25'),
(83, 30, 45, 3, 'Test Course', 14, 'Test Description', 24, 'Months', 2500000.00, 20000.00, 20, 'active', '2021-09-25'),
(90, 16, 33, 1, 'IT Cyber security  ', 12, 'Good course', 3, 'Years', 6000000.00, 45000.00, 20, 'active', '2021-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `course_fee`
--

CREATE TABLE `course_fee` (
  `course_fee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_module`
--

CREATE TABLE `course_module` (
  `course_module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_type`
--

CREATE TABLE `course_type` (
  `course_type_id` int(11) NOT NULL,
  `course_type_name` varchar(250) NOT NULL,
  `course_type_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_type`
--

INSERT INTO `course_type` (`course_type_id`, `course_type_name`, `course_type_status`) VALUES
(16, 'Degree', 'active'),
(17, 'PHD', 'active'),
(18, 'MSC', 'active'),
(24, 'Certifications', 'active'),
(25, 'Diploma', 'active'),
(30, 'Test', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `doc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE `domain` (
  `domain_id` int(11) NOT NULL,
  `domain_name` varchar(250) NOT NULL,
  `domain_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`domain_id`, `domain_name`, `domain_status`) VALUES
(32, 'Marketing', 'active'),
(33, 'IT', 'active'),
(34, 'Engineering', 'active'),
(35, 'Traveling', 'active'),
(42, 'Rocket Science', 'active'),
(43, 'Finance', 'active'),
(45, 'Test Domain', 'active'),
(46, 'IIT Cyber security', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `duration`
--

CREATE TABLE `duration` (
  `duration_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `fav_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `institute_id` int(30) NOT NULL,
  `institute_name` varchar(300) NOT NULL,
  `institute_address` varchar(300) NOT NULL,
  `institute_description` varchar(1000) NOT NULL,
  `institute_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`institute_id`, `institute_name`, `institute_address`, `institute_description`, `institute_status`) VALUES
(1, 'ANC', 'No 46, M.J.C. Fernando road, Moratuwa', 'Located in Moratuwa. Provide many courses', 'Active'),
(2, 'idp', 'COLOMBO 04', 'Best place to visit if you want to get graduated', 'Active'),
(3, 'Moratuwa University', 'Katubedda, Moratuwa', 'Located in the heart of the city. One of the best rankings', 'Active'),
(4, 'colombo Uni', 'Colombo', 'A good university', 'Active'),
(5, 'wayamba Uni', 'Wayamba ', 'A good university', 'Active'),
(9, 'new uni', 'new uni, colombo', 'Good university dfvlkm;sldfms;d s;dlmf;smdf .,dfa;smdf\'ask;,a sda;so\'adsm;a/ sd;alsm', 'Active'),
(10, 'IIT', 'No, 123. abc road, Idama', 'good', 'Active'),
(12, 'NSBM', 'Colombo', 'located in colombo 07', 'Active'),
(13, 'Ruhunu Uni', 'Ruhuna', 'Excellent!', 'Active'),
(14, 'Test institute', 'No 01, abc road, colombo', 'Excellent university located in the heart of the city', 'Active'),
(15, 'hello insti', 'moratuwa', 'good uni', 'Active'),
(16, 'hi insti', 'colombo', 'good', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subdomain`
--

CREATE TABLE `subdomain` (
  `subdomain_id` int(11) NOT NULL,
  `subdomain_name` varchar(250) NOT NULL,
  `subdomain_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subdomain`
--

INSERT INTO `subdomain` (`subdomain_id`, `subdomain_name`, `subdomain_status`) VALUES
(1, 'cyber security', 'active'),
(2, 'securityy', 'active'),
(3, 'Information systems', 'active'),
(4, 'civil', 'active'),
(5, 'spaceship', 'active'),
(6, 'advance economics', 'active'),
(7, 'sales', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_type` enum('Admin','Student','Instructor') NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_email`, `user_password`, `user_name`, `user_type`, `user_status`) VALUES
(18, 'keshia@gmail.com', '$2y$10$I7KW8pbNMccXY4YTyvpqLeuo3j7nfj2CESpeFbp2FFsLo5vOBBYv2', 'keshia', 'Student', 'Active'),
(19, 'OpenArc@gmail.com', '$2y$10$wMcnAMhI/gOUeKSspw5KPOjDmWiqw/3SYvwJEe4z5CoFZTwywVt06', 'open', 'Instructor', 'Active'),
(20, 'admin@gmail.com', '$2y$10$KtetL4EgvQAD0gNyqYEWluxv.CYk.qXOA8On7G5L79RC/kPbvC3z.', 'Admin', 'Admin', 'Active'),
(34, 'ree@gmail.com', '$2y$10$KqSiHD8.3Ua.8Ry5jBY2..QvWTG5q6dupngWSJMjlszFWBNrrXbGq', 'ree', 'Student', 'Active'),
(37, 'iit@gmail.com', '$2y$10$w9NQpp/ifEyQAMa00v7lceN5QIFpvyyYii8sAxp2eWZzHO4zzDWkS', 'iit instructor', 'Instructor', 'Active'),
(39, 'maashi@gmail.com', '$2y$10$AfJ8KJPBJgLxyslX9R2GReKp0d97Cij35xA8U6UTplYpOvey.LpZ2', 'Maashi', 'Instructor', 'Active'),
(40, 'ann@gmail.com', '$2y$10$ZZ3xH9oGVvy.dLRyk/qsA.Px7NsM5jiq2e8h2X.JO3I5z4tN0HaZW', 'Ann', 'Student', 'Active'),
(41, 'anc@gmail.com', '$2y$10$kqhK1GdMZYqI/WTjYEGPDefBitap.GbE/618WHgCOOUos4tAer6Ja', 'anc instuctor', 'Instructor', 'Active'),
(42, 'teststudent@gmail.com', '$2y$10$/wLsVxxbE7XZMvAa9RjrUOYHzhj1G1anWZp7Qdd4W5cy4feV8TES2', 'teststudent', 'Student', 'Active'),
(43, 'hello@gmail.com', '$2y$10$ZVvblRDMtk0CK7hoglwtzuysOR7nj9dCFfPmkACaZJm8.XLymL0tq', 'hello', '', 'Active'),
(44, 'hi@gmail.com', '$2y$10$3Qm9pKbHNEbW5IaDkDJSN.WXl3eKau6SuFVg4eWBFOakX.NYtGCei', 'hi', '', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_type`
--
ALTER TABLE `course_type`
  ADD PRIMARY KEY (`course_type_id`);

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`domain_id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`institute_id`);

--
-- Indexes for table `subdomain`
--
ALTER TABLE `subdomain`
  ADD PRIMARY KEY (`subdomain_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `course_type`
--
ALTER TABLE `course_type`
  MODIFY `course_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `domain`
--
ALTER TABLE `domain`
  MODIFY `domain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `institute_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subdomain`
--
ALTER TABLE `subdomain`
  MODIFY `subdomain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
