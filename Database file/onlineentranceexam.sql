-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 03:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineentranceexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `date_time`) VALUES
(1, 'admin@gmail.com', '$2y$10$ppG4UIPJfehwP91I4bkiZuMAJ8n3hice31b0vEVX7padEmKiM4V4G', '2024-07-15 23:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `examinee`
--

CREATE TABLE `examinee` (
  `examinee_id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `last_institution` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `can_take_exam` int(30) NOT NULL DEFAULT 0,
  `date_time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `examinee`
--

INSERT INTO `examinee` (`examinee_id`, `fullname`, `email`, `phone_number`, `dob`, `gender`, `last_institution`, `password`, `can_take_exam`, `date_time`) VALUES
(1, 'Ibrahim Nurudeen Shehu', 'ibrahimnurudeenshehu@gmail.com', '08062585624', '2111-01-01', '08062585624', 'Al-Hikmah Secondary School', '$2y$10$9zxZ5rOeKfgio70DnK2U9ONXJD9djrSua44XAg8ykmaBNCLh5MciW', 1, '2024-07-17'),
(2, 'Nurudeen Shehu Ibrahim', 'ibrahimnurudeenshehu1447@gmail.com', '08012345678', '2001-01-01', '08012345678', 'British star, academy, Keffi', '$2y$10$hzo4RjG4WZpAKwMzYDzrVO1M8UpBWn7DDYfHkP4mhIqwirVOsLoPu', 0, '2024-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exams_id` int(255) NOT NULL,
  `examinee_id` int(255) NOT NULL,
  `score` int(255) NOT NULL,
  `total_questions` int(255) NOT NULL,
  `correct_answers` int(255) NOT NULL,
  `date_taken` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`exams_id`, `examinee_id`, `score`, `total_questions`, `correct_answers`, `date_taken`) VALUES
(1, 1, 0, 2, 0, '2024-07-26 18:41:20'),
(2, 1, 50, 2, 1, '2024-07-26 18:54:25'),
(3, 1, 50, 2, 1, '2024-07-26 18:57:36'),
(4, 1, 50, 2, 1, '2024-07-26 19:00:21'),
(5, 2, 75, 4, 3, '2024-08-04 18:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `ques_id` int(255) NOT NULL,
  `ques` varchar(3000) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ques_id`, `ques`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`) VALUES
(1, 'What is the full meaning of PHP?', 'Personal Home Page', 'Preprocessor Hypertext page', 'Hypertext Preprocessor', 'Hypertext Languauage preprocessor', 'C'),
(2, 'PHP is a ___ languange?', 'Backend', 'Frontend', 'Middleend', 'Runwayend', 'A'),
(3, 'What is a noun?', 'A name of a person, animal, place, or thing', 'A name of living things and non-living things', 'A name of my father, mother, and siblings', 'The name of my family members, and the muslims at large', 'A'),
(4, 'What is the full meaning of HTML', 'Home Text Markup Language', 'Hypertext Markup Language', 'Hypertext Preprocessor Language', 'Cascading Stylesheet', 'B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `examinee`
--
ALTER TABLE `examinee`
  ADD PRIMARY KEY (`examinee_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exams_id`),
  ADD KEY `join exams and examinee table` (`examinee_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ques_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `examinee`
--
ALTER TABLE `examinee`
  MODIFY `examinee_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exams_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `ques_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `join exams and examinee table` FOREIGN KEY (`examinee_id`) REFERENCES `examinee` (`examinee_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
