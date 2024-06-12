-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 06:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8mb4;

CREATE DATABASE `exam_result_management`;
USE `exam_result_management`;

CREATE TABLE `admin` (
  `admin_id` varchar(255) NOT NULL,
  `admin_type` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `assignment` (
  `reg_no` varchar(255) NOT NULL,
  `ass1_marks` int(11) DEFAULT 0,
  `ass2_marks` int(11) DEFAULT 0,
  `ass3_marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `attendance` (
  `reg_no` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `hour` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `course` (
  `cource_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dep_id` varchar(255) DEFAULT NULL,
  `f_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `department` (
  `dep_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `f_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `exam` (
  `index_no` varchar(255) NOT NULL,
  `marks_att1` int(11) DEFAULT 0,
  `marks_att2` int(11) DEFAULT 0,
  `marks_att3` int(11) DEFAULT 0,
  `marks_attsp` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `faculty` (
  `f_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `gpa` (
  `index` varchar(255) NOT NULL,
  `marks` int(11) DEFAULT 0,
  `gpa` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `gpa_factor` (
  `year` int(11) NOT NULL DEFAULT 0,
  `gpa` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hod` (
  `reg_no` varchar(255) NOT NULL,
  `lec_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `f_id` varchar(255) DEFAULT NULL,
  `dep_id` varchar(255) DEFAULT NULL,
  `admin_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `ica_1` (
  `reg_no` varchar(255) NOT NULL,
  `marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `ica_2` (
  `reg_no` varchar(255) NOT NULL,
  `marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `ica_3` (
  `reg_no` varchar(255) NOT NULL,
  `marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `ica_4` (
  `reg_no` varchar(255) NOT NULL,
  `marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `index_no` (
  `index_no` varchar(255) NOT NULL,
  `reg_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `lecture` (
  `lec_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `f_id` varchar(255) DEFAULT NULL,
  `dep_id` varchar(255) DEFAULT NULL,
  `type_of_lecture` varchar(255) DEFAULT NULL,
  `admin_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `preference` (
  `column_key` varchar(255) NOT NULL,
  `column_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `roles` (
  `admin_type` varchar(255) NOT NULL,
  `role_of_access` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `student` (
  `reg_no` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nic_no` varchar(255) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `course_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `subject` (
  `sub_code` varchar(255) NOT NULL,
  `sub_name` varchar(255) DEFAULT NULL,
  `total_credit` int(11) DEFAULT 0,
  `practical_credit` int(11) DEFAULT 0,
  `theory_credit` int(11) DEFAULT 0,
  `pra_ica_ratio` int(11) DEFAULT 0,
  `theo_ica_ratio` int(11) DEFAULT 0,
  `course_id` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT 0,
  `semester` varchar(255) DEFAULT NULL,
  `lec_id` varchar(255) DEFAULT NULL,
  `preference_column` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tutorial` (
  `reg_no` varchar(255) NOT NULL,
  `tut1_marks` int(11) DEFAULT 0,
  `tut2_marks` int(11) DEFAULT 0,
  `tut3_marks` int(11) DEFAULT 0,
  `sub_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `rolesadmin` (`admin_type`);

ALTER TABLE `assignment`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `subjectassignment` (`sub_code`);

ALTER TABLE `attendance`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `subjectattendance` (`sub_code`);

ALTER TABLE `course`
  ADD PRIMARY KEY (`cource_id`),
  ADD KEY `departmentcourse` (`dep_id`),
  ADD KEY `facultycourse` (`f_id`);

ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

ALTER TABLE `exam`
  ADD PRIMARY KEY (`index_no`),
  ADD KEY `subjectexam` (`sub_code`);

ALTER TABLE `faculty`
  ADD PRIMARY KEY (`f_id`);

ALTER TABLE `gpa`
  ADD PRIMARY KEY (`index`);

ALTER TABLE `gpa_factor`
  ADD PRIMARY KEY (`year`);

ALTER TABLE `hod`
  ADD PRIMARY KEY (`reg_no`);

ALTER TABLE `ica_1`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `subjectica_1` (`sub_code`);

ALTER TABLE `ica_2`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `subjectica_2` (`sub_code`);

ALTER TABLE `ica_3`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `subjectica_3` (`sub_code`);

ALTER TABLE `ica_4`
  ADD PRIMARY KEY (`

reg_no`),
  ADD KEY `subjectica_4` (`sub_code`);

ALTER TABLE `index_no`
  ADD PRIMARY KEY (`index_no`),
  ADD KEY `studentindex_no` (`reg_no`);

ALTER TABLE `lecture`
  ADD PRIMARY KEY (`lec_id`),
  ADD KEY `facultylecture` (`f_id`),
  ADD KEY `departmentlecture` (`dep_id`),
  ADD KEY `adminlecture` (`admin_id`);

ALTER TABLE `preference`
  ADD PRIMARY KEY (`column_key`);

ALTER TABLE `roles`
  ADD PRIMARY KEY (`admin_type`);

ALTER TABLE `student`
  ADD PRIMARY KEY (`reg_no`);

ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_code`),
  ADD KEY `coursessubject` (`course_id`),
  ADD KEY `lecturee` (`lec_id`);

ALTER TABLE `tutorial`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `subjecttutorial` (`sub_code`);

ALTER TABLE `admin`
  ADD CONSTRAINT `rolesadmin` FOREIGN KEY (`admin_type`) REFERENCES `roles` (`admin_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `assignment`
  ADD CONSTRAINT `subjectassignment` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `attendance`
  ADD CONSTRAINT `studentattendance` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `subjectattendance` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `course`
  ADD CONSTRAINT `departmentcourse` FOREIGN KEY (`dep_id`) REFERENCES `department` (`dep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `facultycourse` FOREIGN KEY (`f_id`) REFERENCES `faculty` (`f_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `exam`
  ADD CONSTRAINT `subjectexam` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `hod`
  ADD CONSTRAINT `facultyhod` FOREIGN KEY (`f_id`) REFERENCES `faculty` (`f_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `departmenthod` FOREIGN KEY (`dep_id`) REFERENCES `department` (`dep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `adminhod` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `ica_1`
  ADD CONSTRAINT `subjectica_1` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `ica_2`
  ADD CONSTRAINT `subjectica_2` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `ica_3`
  ADD CONSTRAINT `subjectica_3` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `ica_4`
  ADD CONSTRAINT `subjectica_4` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `index_no`
  ADD CONSTRAINT `studentindex_no` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `lecture`
  ADD CONSTRAINT `facultylecture` FOREIGN KEY (`f_id`) REFERENCES `faculty` (`f_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `departmentlecture` FOREIGN KEY (`dep_id`) REFERENCES `department` (`dep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `adminlecture` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `student`
  ADD CONSTRAINT `coursestudent` FOREIGN KEY (`course_id`) REFERENCES `course` (`cource_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `subject`
  ADD CONSTRAINT `coursessubject` FOREIGN KEY (`course_id`) REFERENCES `course` (`cource_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lecturee` FOREIGN KEY (`lec_id`) REFERENCES `lecture` (`lec_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `tutorial`
  ADD CONSTRAINT `subjecttutorial` FOREIGN KEY (`sub_code`) REFERENCES `subject` (`sub_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

COMMIT;

SET @OLD_CHARACTER_SET_CLIENT=NULL;
SET @OLD_CHARACTER_SET_RESULTS=NULL;
SET @OLD_COLLATION_CONNECTION=NULL;
```
