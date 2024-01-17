-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 02, 2023 at 12:54 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasktracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `adminId` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `emailId` varchar(50) NOT NULL,
  PRIMARY KEY (`adminId`),
  UNIQUE KEY `emailId` (`emailId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminId`, `name`, `password`, `emailId`) VALUES
(1, 'Yash Chauhan', 'admin@1234', 'admin@gmail.com'),
(2, 'Nikul Hirani', 'nikul@1234', 'nikul@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `allocatetasks`
--

DROP TABLE IF EXISTS `allocatetasks`;
CREATE TABLE IF NOT EXISTS `allocatetasks` (
  `allocateId` int(5) NOT NULL AUTO_INCREMENT,
  `taskId` int(5) NOT NULL,
  `empId` int(5) NOT NULL,
  `allocateDate` date NOT NULL,
  `percentage` int(3) DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `remark` mediumtext,
  `projectId` int(5) NOT NULL,
  PRIMARY KEY (`allocateId`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allocatetasks`
--

INSERT INTO `allocatetasks` (`allocateId`, `taskId`, `empId`, `allocateDate`, `percentage`, `status`, `remark`, `projectId`) VALUES
(15, 23, 3, '2023-10-01', 0, 'Pending', '10%', 6),
(17, 20, 6, '2023-08-08', 100, 'Completed', 'complete', 7),
(18, 21, 2, '2023-08-26', 100, 'Completed', 'complete task', 7),
(19, 25, 3, '2023-08-12', 40, 'Pending', '40%work complete', 5),
(20, 26, 2, '2023-08-24', 100, 'Completed', 'Work Is Completed', 5),
(23, 41, 1, '2023-10-11', 100, 'Completed', 'complete', 7),
(24, 42, 2, '2023-08-09', 10, 'Pending', 'xya', 8),
(25, 37, 3, '2023-08-20', 0, 'Pending', NULL, 4),
(26, 44, 1, '2023-08-17', 50, 'Pending', 'Template Is Ready', 8),
(27, 39, 1, '2023-08-20', 51, 'Pending', '', 5),
(30, 46, 5, '2024-01-01', 0, 'Pending', NULL, 8),
(31, 47, 5, '2024-01-02', 0, 'Pending', NULL, 7),
(32, 48, 1, '2023-08-29', 100, 'Completed', 'Complete Task', 10);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `empId` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `birthDate` date NOT NULL,
  `joiningDate` date NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobileNo` varchar(50) NOT NULL,
  `address` mediumtext,
  `salary` decimal(10,0) DEFAULT NULL,
  `emailId` varchar(50) NOT NULL,
  `deptName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`empId`),
  UNIQUE KEY `emailId` (`emailId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`empId`, `name`, `birthDate`, `joiningDate`, `password`, `mobileNo`, `address`, `salary`, `emailId`, `deptName`) VALUES
(1, 'Chauhan Yash', '2004-08-24', '2023-08-01', 'yash@1234', '8156060143', 'Limbdi', '50000', 'yash@gmail.com', 'Programming'),
(2, 'Nikul Hirani', '2004-09-20', '2023-07-30', 'nikul@1234', '1234567891', 'Limbdi,363421', '35000', 'nikul@gmail.com', 'Designing'),
(3, 'Koshiya Nitin', '2002-08-22', '2023-08-03', 'nitin@1234', '5689748589', 'Botad', '15000', 'nitin@gmail.com', 'System Analyst'),
(5, 'Kartik Dabhi', '2004-08-22', '2023-08-11', 'kartik@1234', '8745694895', 'Limbdi', '65000', 'kartik@gmail.com', 'Testing'),
(6, 'Dipak Parmar', '2004-05-22', '2023-08-03', 'dipak@1234', '4789568987', 'Dhangadhara', '20000', 'dipak@gmail.com', 'System Analyst'),
(10, 'Nirav Chauhan', '2004-08-22', '2023-08-30', 'nirav@1234', '8765412394', 'Limbdi', '25700', 'nirav@gmail.com', 'Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `projectId` int(5) NOT NULL AUTO_INCREMENT,
  `discription` mediumtext,
  `title` varchar(50) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `plateform` varchar(50) NOT NULL,
  `completionPer` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`projectId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projectId`, `discription`, `title`, `startDate`, `endDate`, `status`, `plateform`, `completionPer`) VALUES
(4, 'Make Movie Ticket Booking System', 'Movie Ticket Booking', '2023-09-20', '2024-05-05', 'Pending', 'C#', 0),
(5, 'Make Hospital Management System', 'Hospital Management System', '2023-08-12', '2024-02-11', 'Pending', 'PHP', 64),
(6, 'make Website For Nilkanth School', 'School Management Website', '2023-10-01', '2023-05-01', 'Pending', 'ASP.NET', 10),
(7, 'Make Vegitable Selling Website', 'Vegitable Selling Website', '2023-08-05', '2024-02-02', 'Pending', 'JSP', 75),
(8, 'Make Website For Vegitable Selling and Fruits Selling', 'Fesh Bazar', '2023-08-09', '2023-02-02', 'Pending', 'PHP', 20),
(10, 'Make YC Banking System', 'Banking System', '2023-08-29', '2024-08-22', 'Completed', 'JSP', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `taskId` int(5) NOT NULL AUTO_INCREMENT,
  `projectId` int(5) NOT NULL,
  `taskTitle` varchar(50) NOT NULL,
  `discription` mediumtext,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`taskId`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`taskId`, `projectId`, `taskTitle`, `discription`, `startDate`, `endDate`, `status`) VALUES
(20, 7, 'System Analysis ', 'vegitable selling website', '2023-08-06', '2023-08-20', 'Completed'),
(21, 7, 'Design', 'Make Design For This Website', '2023-08-25', '2023-09-20', 'Completed'),
(23, 6, 'Analysis', 'Analysis on This Website', '2023-10-01', '2023-10-20', 'Pending'),
(25, 5, 'System Analysis', 'Analysis on Hospital Management System', '2023-08-12', '2023-08-22', 'Pending'),
(26, 5, 'Designing', 'make template for hospital management', '2023-08-25', '2023-09-10', 'Completed'),
(37, 4, 'analyasis', 'analysis', '2023-09-22', '2023-09-25', 'Pending'),
(39, 5, 'Programming', 'write code for hospital management system', '2023-10-20', '2023-11-20', 'Pending'),
(41, 7, 'programming', 'write code', '2023-10-11', '2023-10-20', 'Completed'),
(42, 8, 'Create Front End Tempate', 'Create Admin Panel & Website For Users', '2023-08-09', '2023-08-22', 'Pending'),
(44, 8, 'Create Login Page', 'write Authentication Code for Login page', '2023-08-19', '2023-08-20', 'Pending'),
(46, 8, 'Test login system', 'test the login syste and registeration', '2024-01-01', '2024-01-03', 'Pending'),
(47, 7, 'Test', 'Test The All form of the website', '2024-01-02', '2024-02-02', 'Pending'),
(48, 10, 'create Login System', 'write code for login system', '2023-08-29', '2023-09-05', 'Completed');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
