-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 05:24 PM
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
-- Database: `exam`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `random_batch` () RETURNS CHAR(4) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
    RETURN (SELECT CASE FLOOR(1 + (RAND() * 3))
               WHEN 1 THEN '2019'
               WHEN 2 THEN '2020'
               WHEN 3 THEN '2021'
           END);
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `random_sub_type` () RETURNS CHAR(1) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    RETURN (CASE WHEN RAND() < 0.5 THEN 'T' ELSE 'P' END);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(255) NOT NULL,
  `admin_type` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_type`, `password`) VALUES
('A00456', 'hod', '$2y$10$qt417LvORmr4FuM7h1M/JePUhxpVLdinbvexzRX6WNUEiPC0LXfiS'),
('A02', 'lec', '@Lect02'),
('A03', 'lec', '$2y$10$mqHXyCLvykXnI4eZyxbhMuLB9SfLn0AUK//xBlrT281NOKh8O9i6S'),
('A04', 'superadmin', '$2y$10$qt417LvORmr4FuM7h1M/JePUhxpVLdinbvexzRX6WNUEiPC0LXfiS'),
('A05', 'lec', '$2y$10$4par/uANgamsn9n0nvLmrePkvotPCkxkOJbPOfY0G6VGPTqgXBMbW');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `reg_no` varchar(255) NOT NULL,
  `ass1_marks` int(11) DEFAULT 0,
  `ass2_marks` int(11) DEFAULT 0,
  `ass3_marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL,
  `sub_type` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`reg_no`, `ass1_marks`, `ass2_marks`, `ass3_marks`, `sub_code`, `sub_type`) VALUES
('2019/ASP/01', 34, 78, 89, 'CSC3222', 'T'),
('2019/ASP/02', 40, 75, 85, 'CSC3222', 'T'),
('2019/ASP/03', 45, 80, 90, 'CSC3222', 'T'),
('2019/ASP/04', 38, 78, 88, 'CSC3222', 'T'),
('2019/ASP/05', 42, 77, 87, 'CSC3222', 'P'),
('2019/ASP/06', 39, 76, 86, 'CSC3222', 'P'),
('2019/ASP/07', 43, 81, 91, 'CSC3222', 'P'),
('2019/ASP/08', 37, 79, 89, 'CSC3222', 'P'),
('2019/ASP/09', 44, 82, 92, 'CSC3222', 'P'),
('2019/ASP/10', 36, 74, 84, 'CSC3222', 'P'),
('2019/ASP/11', 41, 83, 93, 'CSC3222', 'P'),
('2019/ASP/12', 35, 72, 82, 'CSC3222', 'T'),
('2019/ASP/13', 47, 85, 95, 'CSC3222', 'P'),
('2019/ASP/14', 39, 78, 88, 'CSC3222', 'T'),
('2019/ASP/15', 43, 76, 86, 'CSC3222', 'P'),
('2019/ASP/16', 38, 80, 90, 'CSC3222', 'P'),
('2019/ASP/17', 42, 75, 85, 'CSC3222', 'P'),
('2019/ASP/18', 37, 77, 87, 'CSC3222', 'P'),
('2019/ASP/19', 46, 84, 94, 'CSC3222', 'P'),
('2019/ASP/20', 36, 73, 83, 'CSC3222', 'T'),
('2019/ASP/21', 41, 81, 91, 'CSC3222', 'T'),
('2019/ASP/22', 39, 74, 84, 'CSC3222', 'P'),
('2019/ASP/23', 44, 78, 88, 'CSC3222', ''),
('2019/ASP/24', 38, 79, 89, 'CSC3222', ''),
('2019/ASP/25', 42, 77, 87, 'CSC3222', ''),
('2019/ASP/26', 37, 80, 90, 'CSC3222', ''),
('2019/ASP/27', 46, 83, 93, 'CSC3222', ''),
('2019/ASP/28', 36, 73, 83, 'CSC3222', ''),
('2019/ASP/29', 41, 82, 92, 'CSC3222', ''),
('2019/ASP/30', 45, 85, 95, 'CSC3222', '');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `reg_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `hour` int(11) NOT NULL DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL,
  `attendance` int(11) DEFAULT 0,
  `sub_type` varchar(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`reg_no`, `date`, `time`, `hour`, `sub_code`, `attendance`, `sub_type`) VALUES
('2019/ASP/01', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'T'),
('2019/ASP/01', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/02', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'T'),
('2019/ASP/02', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/03', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'T'),
('2019/ASP/03', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/04', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'T'),
('2019/ASP/04', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/05', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'T'),
('2019/ASP/05', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/06', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'P'),
('2019/ASP/07', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'P'),
('2019/ASP/08', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'P'),
('2019/ASP/08', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/09', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'P'),
('2019/ASP/10', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'P'),
('2019/ASP/10', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/11', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'P'),
('2019/ASP/11', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/12', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'P'),
('2019/ASP/12', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/13', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'T'),
('2019/ASP/13', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/14', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'P'),
('2019/ASP/14', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/15', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'T'),
('2019/ASP/15', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/16', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'T'),
('2019/ASP/16', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/17', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'T'),
('2019/ASP/17', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/18', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'T'),
('2019/ASP/19', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'P'),
('2019/ASP/20', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'T'),
('2019/ASP/20', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/21', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'T'),
('2019/ASP/21', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/22', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'P'),
('2019/ASP/22', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/23', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'P'),
('2019/ASP/23', '2024-07-27', '13:02:00', 3, 'CSC3123', 1, 'T'),
('2019/ASP/24', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'T'),
('2019/ASP/25', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'T'),
('2019/ASP/26', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'P'),
('2019/ASP/27', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'P'),
('2019/ASP/28', '2024-05-27', '10:00:00', 2, 'CSC3222', 0, 'T'),
('2019/ASP/29', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'T'),
('2019/ASP/30', '2024-05-27', '10:00:00', 2, 'CSC3222', 1, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(255) NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `dep_id` varchar(255) DEFAULT NULL,
  `f_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `dep_id`, `f_id`) VALUES
('AMC', 'Applied Mathematics and Computing', 'DOPS', 'FAS'),
('ESC', 'Environment Science', 'DOBS', 'FAS'),
('ICT', 'Information Communication Technology ', 'DOPS', 'FAS');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` varchar(255) NOT NULL,
  `dep_name` varchar(255) DEFAULT NULL,
  `f_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`, `f_id`) VALUES
('BE', 'Department of Business Economics', 'FBS'),
('DOBS', 'Department of Bio-science', 'FAS'),
('DOPS', 'Department of Physical science', 'FAS'),
('DOT', 'Department of Technology', 'FTS');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `index_no` varchar(255) NOT NULL,
  `marks_att1` int(11) DEFAULT 0,
  `marks_att2` int(11) DEFAULT 0,
  `marks_att3` int(11) DEFAULT 0,
  `marks_attsp` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL,
  `sub_type` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`index_no`, `marks_att1`, `marks_att2`, `marks_att3`, `marks_attsp`, `sub_code`, `sub_type`) VALUES
('A22001', 56, 34, 67, 67, 'CSC3222', 'P'),
('A22002', 60, 40, 70, 72, 'CSC3222', 'P'),
('A22003', 58, 35, 68, 69, 'CSC3222', 'T'),
('A22004', 62, 42, 71, 74, 'CSC3222', 'P'),
('A22005', 55, 33, 66, 65, 'CSC3222', 'P'),
('A22006', 61, 41, 69, 73, 'CSC3222', 'T'),
('A22007', 57, 36, 67, 68, 'CSC3222', 'T'),
('A22008', 63, 43, 72, 75, 'CSC3222', 'P'),
('A22009', 54, 32, 65, 64, 'CSC3222', 'T'),
('A22010', 59, 39, 70, 71, 'CSC3222', 'P'),
('A22011', 56, 37, 68, 69, 'CSC3222', 'P'),
('A22012', 64, 44, 73, 76, 'CSC3222', 'T'),
('A22013', 55, 33, 66, 65, 'CSC3222', 'P'),
('A22014', 60, 40, 71, 72, 'CSC3222', 'P'),
('A22015', 58, 38, 69, 70, 'CSC3222', 'T'),
('A22016', 62, 42, 74, 74, 'CSC3222', 'T'),
('A22017', 54, 31, 65, 63, 'CSC3222', 'T'),
('A22018', 61, 41, 72, 73, 'CSC3222', 'P'),
('A22019', 57, 37, 68, 69, 'CSC3222', 'P'),
('A22020', 0, 0, 73, 75, 'CSC3222', 'T'),
('A22021', 56, 34, 67, 67, 'CSC3222', 'P'),
('A22022', 60, 40, 71, 72, 'CSC3222', 'P'),
('A22023', 58, 35, 68, 69, 'CSC3222', 'P'),
('A22024', 62, 42, 72, 74, 'CSC3222', 'T'),
('A22025', 55, 33, 66, 65, 'CSC3222', 'T'),
('A22026', 61, 41, 70, 73, 'CSC3222', ''),
('A22027', 57, 36, 67, 68, 'CSC3222', ''),
('A22028', 63, 43, 72, 75, 'CSC3222', ''),
('A22029', 54, 32, 65, 64, 'CSC3222', ''),
('A22030', 59, 39, 70, 71, 'CSC3222', '');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `f_id` varchar(255) NOT NULL,
  `f_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`f_id`, `f_name`) VALUES
('FAS', 'FACULTY OF APPLIED SCIENCE'),
('FBS', 'FACULTY OF BUSINESS STUDIES'),
('FTS', 'FACULTY OF TECHNOLOGICAL STUDIES');

-- --------------------------------------------------------

--
-- Table structure for table `gpa`
--

CREATE TABLE `gpa` (
  `index` varchar(255) NOT NULL,
  `marks` int(11) DEFAULT 0,
  `gpa` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gpa_factor`
--

CREATE TABLE `gpa_factor` (
  `year` int(11) NOT NULL DEFAULT 0,
  `gpa` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gpa_factor`
--

INSERT INTO `gpa_factor` (`year`, `gpa`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

CREATE TABLE `hod` (
  `reg_no` varchar(255) NOT NULL,
  `lec_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `f_id` varchar(255) DEFAULT NULL,
  `dep_id` varchar(255) DEFAULT NULL,
  `admin_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hod`
--

INSERT INTO `hod` (`reg_no`, `lec_id`, `name`, `f_id`, `dep_id`, `admin_id`) VALUES
('HO1', 'le02', 'Dr.S,Kirushanth', 'FAS', 'DOPS', 'A03');

-- --------------------------------------------------------

--
-- Table structure for table `ica_1`
--

CREATE TABLE `ica_1` (
  `reg_no` varchar(255) NOT NULL,
  `marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL,
  `sub_type` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ica_1`
--

INSERT INTO `ica_1` (`reg_no`, `marks`, `sub_code`, `sub_type`) VALUES
('2019/ASP/01', 56, 'CSC3222', 'P'),
('2019/ASP/02', 60, 'CSC3222', 'P'),
('2019/ASP/03', 58, 'CSC3222', 'P'),
('2019/ASP/04', 62, 'CSC3222', 'P'),
('2019/ASP/05', 55, 'CSC3222', 'T'),
('2019/ASP/06', 61, 'CSC3222', 'T'),
('2019/ASP/07', 57, 'CSC3222', 'T'),
('2019/ASP/08', 63, 'CSC3222', 'P'),
('2019/ASP/09', 54, 'CSC3222', 'T'),
('2019/ASP/10', 59, 'CSC3222', 'T'),
('2019/ASP/11', 56, 'CSC3222', 'T'),
('2019/ASP/12', 64, 'CSC3222', 'P'),
('2019/ASP/13', 55, 'CSC3222', 'T'),
('2019/ASP/14', 60, 'CSC3222', 'P'),
('2019/ASP/15', 58, 'CSC3222', 'P'),
('2019/ASP/16', 62, 'CSC3222', 'P'),
('2019/ASP/17', 54, 'CSC3222', 'P'),
('2019/ASP/18', 61, 'CSC3222', 'T'),
('2019/ASP/19', 57, 'CSC3222', 'P'),
('2019/ASP/20', 63, 'CSC3222', 'P'),
('2019/ASP/21', 56, 'CSC3222', 'P'),
('2019/ASP/22', 60, 'CSC3222', 'T'),
('2019/ASP/23', 58, 'CSC3222', 'P'),
('2019/ASP/24', 62, 'CSC3222', 'P'),
('2019/ASP/25', 55, 'CSC3222', 'T'),
('2019/ASP/26', 61, 'CSC3222', 'T'),
('2019/ASP/27', 57, 'CSC3222', 'P'),
('2019/ASP/28', 63, 'CSC3222', 'T'),
('2019/ASP/29', 54, 'CSC3222', 'T'),
('2019/ASP/30', 59, 'CSC3222', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `ica_2`
--

CREATE TABLE `ica_2` (
  `reg_no` varchar(255) NOT NULL,
  `marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL,
  `sub_type` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ica_2`
--

INSERT INTO `ica_2` (`reg_no`, `marks`, `sub_code`, `sub_type`) VALUES
('2019/ASP/01', 99, 'CSC3222', 'T'),
('2019/ASP/02', 88, 'CSC3222', 'T'),
('2019/ASP/03', 76, 'CSC3222', 'T'),
('2019/ASP/04', 85, 'CSC3222', 'P'),
('2019/ASP/05', 90, 'CSC3222', 'T'),
('2019/ASP/06', 92, 'CSC3222', 'P'),
('2019/ASP/07', 77, 'CSC3222', 'P'),
('2019/ASP/08', 83, 'CSC3222', 'T'),
('2019/ASP/09', 95, 'CSC3222', 'P'),
('2019/ASP/10', 80, 'CSC3222', 'P'),
('2019/ASP/11', 89, 'CSC3222', 'T'),
('2019/ASP/12', 78, 'CSC3222', 'P'),
('2019/ASP/13', 91, 'CSC3222', 'P'),
('2019/ASP/14', 82, 'CSC3222', 'P'),
('2019/ASP/15', 93, 'CSC3222', 'P'),
('2019/ASP/16', 79, 'CSC3222', 'P'),
('2019/ASP/17', 87, 'CSC3222', 'P'),
('2019/ASP/18', 84, 'CSC3222', 'P'),
('2019/ASP/19', 75, 'CSC3222', 'P'),
('2019/ASP/20', 86, 'CSC3222', 'P'),
('2019/ASP/21', 81, 'CSC3222', 'P'),
('2019/ASP/22', 94, 'CSC3222', 'P'),
('2019/ASP/23', 74, 'CSC3222', 'T'),
('2019/ASP/24', 97, 'CSC3222', 'P'),
('2019/ASP/25', 73, 'CSC3222', 'T'),
('2019/ASP/26', 99, 'CSC3222', 'T'),
('2019/ASP/27', 85, 'CSC3222', 'P'),
('2019/ASP/28', 90, 'CSC3222', 'P'),
('2019/ASP/29', 88, 'CSC3222', 'T'),
('2019/ASP/30', 91, 'CSC3222', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `ica_3`
--

CREATE TABLE `ica_3` (
  `reg_no` varchar(255) NOT NULL,
  `marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL,
  `sub_type` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ica_3`
--

INSERT INTO `ica_3` (`reg_no`, `marks`, `sub_code`, `sub_type`) VALUES
('2019/ASP/01', 76, 'CSC3222', 'P'),
('2019/ASP/02', 85, 'CSC3222', 'T'),
('2019/ASP/03', 88, 'CSC3222', 'P'),
('2019/ASP/04', 79, 'CSC3222', 'P'),
('2019/ASP/05', 82, 'CSC3222', 'T'),
('2019/ASP/06', 90, 'CSC3222', 'T'),
('2019/ASP/07', 84, 'CSC3222', 'T'),
('2019/ASP/08', 87, 'CSC3222', 'T'),
('2019/ASP/09', 75, 'CSC3222', 'P'),
('2019/ASP/10', 89, 'CSC3222', 'T'),
('2019/ASP/11', 92, 'CSC3222', 'T'),
('2019/ASP/12', 77, 'CSC3222', 'T'),
('2019/ASP/13', 91, 'CSC3222', 'P'),
('2019/ASP/14', 80, 'CSC3222', 'T'),
('2019/ASP/15', 93, 'CSC3222', 'P'),
('2019/ASP/16', 81, 'CSC3222', 'T'),
('2019/ASP/17', 78, 'CSC3222', 'T'),
('2019/ASP/18', 86, 'CSC3222', 'T'),
('2019/ASP/19', 83, 'CSC3222', 'P'),
('2019/ASP/20', 94, 'CSC3222', 'T'),
('2019/ASP/21', 73, 'CSC3222', 'P'),
('2019/ASP/22', 95, 'CSC3222', 'P'),
('2019/ASP/23', 72, 'CSC3222', 'P'),
('2019/ASP/24', 96, 'CSC3222', 'P'),
('2019/ASP/25', 89, 'CSC3222', 'T'),
('2019/ASP/26', 88, 'CSC3222', 'T'),
('2019/ASP/27', 75, 'CSC3222', 'T'),
('2019/ASP/28', 79, 'CSC3222', 'T'),
('2019/ASP/29', 90, 'CSC3222', 'T'),
('2019/ASP/30', 85, 'CSC3222', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `ica_4`
--

CREATE TABLE `ica_4` (
  `reg_no` varchar(255) NOT NULL,
  `marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL,
  `sub_type` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ica_4`
--

INSERT INTO `ica_4` (`reg_no`, `marks`, `sub_code`, `sub_type`) VALUES
('2019/ASP/01', 55, 'CSC3222', 'P'),
('2019/ASP/02', 65, 'CSC3222', 'P'),
('2019/ASP/03', 70, 'CSC3222', 'T'),
('2019/ASP/04', 85, 'CSC3222', 'P'),
('2019/ASP/05', 90, 'CSC3222', 'T'),
('2019/ASP/06', 75, 'CSC3222', 'P'),
('2019/ASP/07', 80, 'CSC3222', 'P'),
('2019/ASP/08', 95, 'CSC3222', 'P'),
('2019/ASP/09', 60, 'CSC3222', 'P'),
('2019/ASP/10', 55, 'CSC3222', 'P'),
('2019/ASP/11', 68, 'CSC3222', 'T'),
('2019/ASP/12', 72, 'CSC3222', 'P'),
('2019/ASP/13', 77, 'CSC3222', 'P'),
('2019/ASP/14', 83, 'CSC3222', 'T'),
('2019/ASP/15', 89, 'CSC3222', 'T'),
('2019/ASP/16', 92, 'CSC3222', 'P'),
('2019/ASP/17', 78, 'CSC3222', 'T'),
('2019/ASP/18', 81, 'CSC3222', 'P'),
('2019/ASP/19', 88, 'CSC3222', 'T'),
('2019/ASP/20', 91, 'CSC3222', 'T'),
('2019/ASP/21', 73, 'CSC3222', 'P'),
('2019/ASP/22', 66, 'CSC3222', 'P'),
('2019/ASP/23', 76, 'CSC3222', 'P'),
('2019/ASP/24', 82, 'CSC3222', 'T'),
('2019/ASP/25', 85, 'CSC3222', 'T'),
('2019/ASP/26', 87, 'CSC3222', 'T'),
('2019/ASP/27', 90, 'CSC3222', 'T'),
('2019/ASP/28', 93, 'CSC3222', 'P'),
('2019/ASP/29', 74, 'CSC3222', 'T'),
('2019/ASP/30', 79, 'CSC3222', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `index_no`
--

CREATE TABLE `index_no` (
  `index_no` varchar(255) NOT NULL,
  `reg_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `index_no`
--

INSERT INTO `index_no` (`index_no`, `reg_no`) VALUES
('A22001', '2019/ASP/01'),
('A22002', '2019/ASP/02'),
('A22003', '2019/ASP/03'),
('A22004', '2019/ASP/04'),
('A22005', '2019/ASP/05'),
('A22006', '2019/ASP/06'),
('A22007', '2019/ASP/07'),
('A22008', '2019/ASP/08'),
('A22009', '2019/ASP/09'),
('A22010', '2019/ASP/10'),
('A22011', '2019/ASP/11'),
('A22012', '2019/ASP/12'),
('A22013', '2019/ASP/13'),
('A22014', '2019/ASP/14'),
('A22015', '2019/ASP/15'),
('A22016', '2019/ASP/16'),
('A22017', '2019/ASP/17'),
('A22018', '2019/ASP/18'),
('A22019', '2019/ASP/19'),
('A22020', '2019/ASP/20'),
('A22021', '2019/ASP/21'),
('A22022', '2019/ASP/22'),
('A22023', '2019/ASP/23'),
('A22024', '2019/ASP/24'),
('A22025', '2019/ASP/25'),
('A22026', '2019/ASP/26'),
('A22027', '2019/ASP/27'),
('A22028', '2019/ASP/28'),
('A22029', '2019/ASP/29'),
('A22030', '2019/ASP/30'),
('a20254', '2019/ASP/72'),
('a20255', '2019/ASP/73');

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `lec_id` varchar(255) NOT NULL,
  `lec_name` varchar(255) DEFAULT NULL,
  `f_id` varchar(255) DEFAULT NULL,
  `dep_id` varchar(255) DEFAULT NULL,
  `type_of_lecture` varchar(255) DEFAULT NULL,
  `admin_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`lec_id`, `lec_name`, `f_id`, `dep_id`, `type_of_lecture`, `admin_id`) VALUES
('le02', 'Dr.S.Kirushanth', 'FAS', 'DOPS', 'sl', 'A03'),
('le03', 'Mr.B.Yogarajah ', 'FAS', 'DOPS', 'sl', 'A05'),
('lec100', 'Dr Kayanan', 'FAS', 'DOPS', 'sl', 'A00456');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_type`
--

CREATE TABLE `lecture_type` (
  `lec_type_name` varchar(255) NOT NULL,
  `type_id` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecture_type`
--

INSERT INTO `lecture_type` (`lec_type_name`, `type_id`) VALUES
('Assistant Lecturer', 'al'),
('Lecturer', 'l'),
('Senior Lecturer', 'sl');

-- --------------------------------------------------------

--
-- Table structure for table `preference`
--

CREATE TABLE `preference` (
  `column_key` varchar(255) NOT NULL,
  `column_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preference`
--

INSERT INTO `preference` (`column_key`, `column_id`) VALUES
('A001', 'RTR'),
('A002', 'KIN');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `admin_type` varchar(255) NOT NULL,
  `role_of_access` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`admin_type`, `role_of_access`) VALUES
('hod', 'add'),
('lec', 'input'),
('superadmin', 'maintaince');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `reg_no` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nic_no` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `date_of_admission` date DEFAULT NULL,
  `course_id` varchar(255) DEFAULT NULL,
  `batch` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`reg_no`, `name`, `nic_no`, `dob`, `date_of_admission`, `course_id`, `batch`) VALUES
('2019/ASP/01', 'Hariharan', '200023456789v', '2000-11-15', '2021-07-06', 'AMC', '2020'),
('2019/ASP/02', 'Anjali', '200123456788v', '2001-02-05', '2023-06-25', 'AMC', '2021'),
('2019/ASP/03', 'Ravi', '200223456787v', '2000-03-12', '2021-07-06', 'AMC', '2019'),
('2019/ASP/04', 'Priya', '200323456786v', '2000-04-18', '2021-07-06', 'AMC', '2019'),
('2019/ASP/05', 'Arun', '200423456785v', '2001-05-23', '2022-06-20', 'AMC', '2020'),
('2019/ASP/06', 'Kavya', '200523456784v', '2000-06-30', '2021-07-06', 'AMC', '2019'),
('2019/ASP/07', 'Vikram', '200623456783v', '2000-07-14', '2022-06-20', 'AMC', '2020'),
('2019/ASP/08', 'Neha', '200723456782v', '2001-08-09', '2022-06-20', 'AMC', '2020'),
('2019/ASP/09', 'Rahul', '200823456781v', '2000-09-19', '2022-06-20', 'AMC', '2020'),
('2019/ASP/10', 'Meera', '200923456780v', '2001-10-05', '2022-06-20', 'AMC', '2020'),
('2019/ASP/11', 'Surya', '201023456789v', '2000-11-25', '2022-06-20', 'AMC', '2020'),
('2019/ASP/12', 'Divya', '201123456788v', '2001-12-15', '2023-06-25', 'AMC', '2021'),
('2019/ASP/13', 'Ramesh', '201223456787v', '2000-01-20', '2023-06-25', 'AMC', '2021'),
('2019/ASP/14', 'Sita', '201323456786v', '2001-02-14', '2023-06-25', 'AMC', '2021'),
('2019/ASP/15', 'Raj', '201423456785v', '2000-03-07', '2021-07-06', 'AMC', '2019'),
('2019/ASP/16', 'Lakshmi', '201523456784v', '2001-04-11', '2021-07-06', 'AMC', '2019'),
('2019/ASP/17', 'Mohan', '201623456783v', '2000-05-16', '2021-07-06', 'AMC', '2019'),
('2019/ASP/18', 'Geeta', '201723456782v', '0000-00-00', '2021-07-06', 'AMC', '2019'),
('2019/ASP/19', 'Suresh', '201823456781v', '2000-07-28', '2022-06-20', 'AMC', '2020'),
('2019/ASP/20', 'Bhavna', '201923456780v', '2001-08-04', '2022-06-20', 'AMC', '2020'),
('2019/ASP/21', 'Krishna', '202023456789v', '2000-09-11', '2022-06-20', 'AMC', '2020'),
('2019/ASP/22', 'Sneha', '202123456788v', '2001-10-17', '2021-07-06', 'AMC', '2019'),
('2019/ASP/23', 'Amit', '202223456787v', '2000-11-23', '2022-06-20', 'AMC', '2020'),
('2019/ASP/24', 'Leela', '202323456786v', '2001-12-30', '2021-07-06', 'AMC', '2019'),
('2019/ASP/25', 'Kiran', '202423456785v', '2000-01-05', '2023-06-25', 'AMC', '2021'),
('2019/ASP/26', 'Nidhi', '202523456784v', '2001-02-18', '2021-07-06', 'AMC', '2019'),
('2019/ASP/27', 'Anil', '202623456783v', '2000-03-25', '2023-06-25', 'AMC', '2021'),
('2019/ASP/28', 'Pooja', '202723456782v', '2001-04-11', '2023-06-25', 'AMC', '2021'),
('2019/ASP/29', 'Deepak', '202823456781v', '2000-05-17', '2023-06-25', 'AMC', '2021'),
('2019/ASP/30', 'Asha', '202923456780v', '2001-06-21', '2023-06-25', 'AMC', '2021'),
('2019/ASP/72', 'R Sanjeevakanth', '991883460v', '0000-00-00', '0000-00-00', 'AMC', '2021'),
('2019/ASP/73', 'S Kambu', '20000545151', '0000-00-00', '0000-00-00', 'AMC', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_code` varchar(255) NOT NULL,
  `sub_name` varchar(255) DEFAULT NULL,
  `total_credit` int(11) DEFAULT 0,
  `practical_credit` int(11) DEFAULT 0,
  `theory_credit` int(11) DEFAULT 0,
  `pra_ica_ratio` int(11) DEFAULT 0,
  `theo_ica_ratio` int(11) DEFAULT 0,
  `course_id` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT 0,
  `semester` varchar(255) DEFAULT NULL,
  `lec_id` varchar(255) DEFAULT NULL,
  `preference_column` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_code`, `sub_name`, `total_credit`, `practical_credit`, `theory_credit`, `pra_ica_ratio`, `theo_ica_ratio`, `course_id`, `level`, `semester`, `lec_id`, `preference_column`) VALUES
('CSC3123', 'Operating System', 3, 1, 2, 40, 30, 'AMC', 3, '1', 'le03', 'C'),
('CSC3222', 'Graph Theory', 2, 0, 2, 0, 30, 'AMC', 3, '2', 'le02', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tutorial`
--

CREATE TABLE `tutorial` (
  `reg_no` varchar(255) NOT NULL,
  `tut1_marks` int(11) DEFAULT 0,
  `tut2_marks` int(11) DEFAULT 0,
  `tut3_marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL,
  `sub_type` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutorial`
--

INSERT INTO `tutorial` (`reg_no`, `tut1_marks`, `tut2_marks`, `tut3_marks`, `sub_code`, `sub_type`) VALUES
('2019/ASP/01', 56, 78, 34, 'CSC3222', 'P'),
('2019/ASP/02', 60, 70, 40, 'CSC3222', 'P'),
('2019/ASP/03', 65, 75, 45, 'CSC3222', 'T'),
('2019/ASP/04', 70, 80, 50, 'CSC3222', 'T'),
('2019/ASP/05', 55, 85, 55, 'CSC3222', 'P'),
('2019/ASP/06', 60, 90, 60, 'CSC3222', 'T'),
('2019/ASP/07', 65, 95, 65, 'CSC3222', 'P'),
('2019/ASP/08', 70, 85, 70, 'CSC3222', 'P'),
('2019/ASP/09', 75, 80, 75, 'CSC3222', 'P'),
('2019/ASP/10', 80, 75, 80, 'CSC3222', 'P'),
('2019/ASP/11', 85, 70, 85, 'CSC3222', 'T'),
('2019/ASP/12', 60, 65, 50, 'CSC3222', 'P'),
('2019/ASP/13', 70, 75, 60, 'CSC3222', 'T'),
('2019/ASP/14', 75, 80, 65, 'CSC3222', 'T'),
('2019/ASP/15', 80, 85, 70, 'CSC3222', 'P'),
('2019/ASP/16', 85, 90, 75, 'CSC3222', 'T'),
('2019/ASP/17', 90, 95, 80, 'CSC3222', 'T'),
('2019/ASP/18', 95, 85, 85, 'CSC3222', 'P'),
('2019/ASP/19', 85, 75, 90, 'CSC3222', 'T'),
('2019/ASP/20', 80, 70, 85, 'CSC3222', 'P'),
('2019/ASP/21', 75, 65, 80, 'CSC3222', 'T'),
('2019/ASP/22', 70, 60, 75, 'CSC3222', 'P'),
('2019/ASP/23', 65, 55, 70, 'CSC3222', 'T'),
('2019/ASP/24', 60, 50, 65, 'CSC3222', 'P'),
('2019/ASP/25', 55, 45, 60, 'CSC3222', 'T'),
('2019/ASP/26', 50, 40, 55, 'CSC3222', 'T'),
('2019/ASP/27', 45, 35, 50, 'CSC3222', 'T'),
('2019/ASP/28', 40, 30, 45, 'CSC3222', 'P'),
('2019/ASP/29', 35, 25, 40, 'CSC3222', 'T'),
('2019/ASP/30', 30, 20, 35, 'CSC3222', 'T'),
('2019/ASP/31', 56, 78, 34, 'CSC3222', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `subjectassignment` (`sub_code`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`reg_no`,`date`,`time`,`hour`,`sub_type`),
  ADD KEY `subjectattendance` (`sub_code`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `departmentcourse` (`dep_id`),
  ADD KEY `facultycourse` (`f_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`index_no`),
  ADD KEY `subjectexam` (`sub_code`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `gpa`
--
ALTER TABLE `gpa`
  ADD PRIMARY KEY (`index`);

--
-- Indexes for table `gpa_factor`
--
ALTER TABLE `gpa_factor`
  ADD PRIMARY KEY (`year`);

--
-- Indexes for table `hod`
--
ALTER TABLE `hod`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `facultyhod` (`f_id`),
  ADD KEY `departmenthod` (`dep_id`),
  ADD KEY `adminhod` (`admin_id`);

--
-- Indexes for table `ica_1`
--
ALTER TABLE `ica_1`
  ADD PRIMARY KEY (`reg_no`,`sub_type`),
  ADD KEY `subjectica_1` (`sub_code`);

--
-- Indexes for table `ica_2`
--
ALTER TABLE `ica_2`
  ADD PRIMARY KEY (`reg_no`,`sub_type`),
  ADD KEY `subjectica_2` (`sub_code`);

--
-- Indexes for table `ica_3`
--
ALTER TABLE `ica_3`
  ADD PRIMARY KEY (`reg_no`,`sub_type`),
  ADD KEY `subjectica_3` (`sub_code`);

--
-- Indexes for table `ica_4`
--
ALTER TABLE `ica_4`
  ADD PRIMARY KEY (`reg_no`,`sub_type`),
  ADD KEY `subjectica_4` (`sub_code`);

--
-- Indexes for table `index_no`
--
ALTER TABLE `index_no`
  ADD PRIMARY KEY (`index_no`),
  ADD KEY `studentindex_no` (`reg_no`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`lec_id`),
  ADD KEY `facultylecture` (`f_id`),
  ADD KEY `departmentlecture` (`dep_id`);

--
-- Indexes for table `lecture_type`
--
ALTER TABLE `lecture_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `preference`
--
ALTER TABLE `preference`
  ADD PRIMARY KEY (`column_key`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`admin_type`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `coursestudent` (`course_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_code`),
  ADD KEY `coursessubject` (`course_id`),
  ADD KEY `lecturee` (`lec_id`);

--
-- Indexes for table `tutorial`
--
ALTER TABLE `tutorial`
  ADD PRIMARY KEY (`reg_no`,`sub_type`),
  ADD KEY `subjecttutorial` (`sub_code`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `subjectassignment` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `studentattendance` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `subjectattendance` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `departmentcourse` FOREIGN KEY (`dep_id`) REFERENCES `department` (`dep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `facultycourse` FOREIGN KEY (`f_id`) REFERENCES `faculty` (`f_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `subjectexam` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hod`
--
ALTER TABLE `hod`
  ADD CONSTRAINT `adminhod` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `departmenthod` FOREIGN KEY (`dep_id`) REFERENCES `department` (`dep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `facultyhod` FOREIGN KEY (`f_id`) REFERENCES `faculty` (`f_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ica_1`
--
ALTER TABLE `ica_1`
  ADD CONSTRAINT `subjectica_1` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ica_2`
--
ALTER TABLE `ica_2`
  ADD CONSTRAINT `subjectica_2` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ica_3`
--
ALTER TABLE `ica_3`
  ADD CONSTRAINT `subjectica_3` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ica_4`
--
ALTER TABLE `ica_4`
  ADD CONSTRAINT `subjectica_4` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `index_no`
--
ALTER TABLE `index_no`
  ADD CONSTRAINT `studentindex_no` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lecture`
--
ALTER TABLE `lecture`
  ADD CONSTRAINT `departmentlecture` FOREIGN KEY (`dep_id`) REFERENCES `department` (`dep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `facultylecture` FOREIGN KEY (`f_id`) REFERENCES `faculty` (`f_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `coursestudent` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `coursessubject` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lecturee` FOREIGN KEY (`lec_id`) REFERENCES `lecture` (`lec_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tutorial`
--
ALTER TABLE `tutorial`
  ADD CONSTRAINT `subjecttutorial` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
