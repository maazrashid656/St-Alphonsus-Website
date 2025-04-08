-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 08:11 AM
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
-- Database: `st_alphonsus`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `ClassID` int(11) NOT NULL,
  `ClassName` varchar(50) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `TeacherID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`ClassID`, `ClassName`, `Capacity`, `TeacherID`) VALUES
(1, 'Class One', 55, 2),
(2, 'Class Two', 50, 5),
(3, 'Class Three', 50, 4),
(4, 'Class Four', 50, 3);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `ParentID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Address` text NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`ParentID`, `FirstName`, `LastName`, `Address`, `Email`, `Phone`) VALUES
(2, 'Brain', 'Corner', 'ad123', 'Brain@gmail.com', '12456987'),
(3, 'Lara', 'Acosta', 'Add2', 'Lara@gmail.com', '142142142'),
(4, 'Haroon', 'Snyder', 'Add3', 'Haroon@gmail.com', '142142555'),
(5, 'Terry', 'Escobar', 'Add4', 'Terry@gmail.com', '142142666'),
(6, 'Billie', 'Waller', 'Add6', 'Waller@gmail.com', '142142886'),
(7, 'Aoife', 'Conway', 'Add7', 'Conway@gmail.com', '142144848'),
(8, 'Alisha', 'Wright', 'Add8', 'Wright@gmail.com', '142199849'),
(9, 'Nikhil', 'Wagner', 'Add9', 'Wagner@gmail.com', '202199849');

-- --------------------------------------------------------

--
-- Table structure for table `pupilparent`
--

CREATE TABLE `pupilparent` (
  `ParentID` int(11) DEFAULT NULL,
  `PupilID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pupils`
--

CREATE TABLE `pupils` (
  `PupilID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `Address` text NOT NULL,
  `MedicalInfo` text DEFAULT NULL,
  `ClassID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pupils`
--

INSERT INTO `pupils` (`PupilID`, `FirstName`, `LastName`, `DOB`, `Address`, `MedicalInfo`, `ClassID`) VALUES
(1, 'Sam', 'Wit', '2016-01-01', 'add123', 'Positive1', 1),
(2, 'Shane', 'Koch', '2015-04-01', 'Add2', 'Positive', 2),
(3, 'Dillan', 'Hardy', '2015-05-01', 'Add3', 'Positive', 3),
(4, 'Bernice', 'Donnelly', '2014-09-12', 'Add4', 'Positive', 4),
(5, 'Kaya', 'Carlson', '2015-08-12', 'Add5', 'Positive', 1),
(6, 'Ciara', 'Gould', '2015-04-12', 'Add6', 'Positive', 2),
(7, 'Samir', 'Munoz', '2016-04-12', 'Add7', 'Positive', 3),
(8, 'Isobel', 'Powell', '2015-08-16', 'Add8', 'Positive', 3),
(9, 'Rahim', 'Wang', '2015-09-16', 'Add9', 'Positive', 4);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `TeacherID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Address` text NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `AnnualSalary` decimal(10,2) NOT NULL,
  `BackgroundCheckStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`TeacherID`, `FirstName`, `LastName`, `Address`, `PhoneNumber`, `AnnualSalary`, `BackgroundCheckStatus`) VALUES
(2, 'Paul', 'Tyson', 'address12', '123456789', 500000.00, 'Approved'),
(3, 'Claude', 'Yang', 'Sydney', '258258258', 60000.00, 'Approved'),
(4, 'Brayden', 'Sykes', 'NY', '258258358', 700000.00, 'Approved'),
(5, 'Lawrence', 'Michael', 'NY', '258258444', 440000.00, 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`ClassID`),
  ADD UNIQUE KEY `TeacherID` (`TeacherID`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`ParentID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `pupilparent`
--
ALTER TABLE `pupilparent`
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `PupilID` (`PupilID`);

--
-- Indexes for table `pupils`
--
ALTER TABLE `pupils`
  ADD PRIMARY KEY (`PupilID`),
  ADD KEY `ClassID` (`ClassID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`TeacherID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `ClassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `ParentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pupils`
--
ALTER TABLE `pupils`
  MODIFY `PupilID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `TeacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `FK_Teacher` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`TeacherID`) ON DELETE SET NULL;

--
-- Constraints for table `pupilparent`
--
ALTER TABLE `pupilparent`
  ADD CONSTRAINT `pupilparent_ibfk_1` FOREIGN KEY (`ParentID`) REFERENCES `parents` (`ParentID`),
  ADD CONSTRAINT `pupilparent_ibfk_2` FOREIGN KEY (`PupilID`) REFERENCES `pupils` (`PupilID`);

--
-- Constraints for table `pupils`
--
ALTER TABLE `pupils`
  ADD CONSTRAINT `pupils_ibfk_1` FOREIGN KEY (`ClassID`) REFERENCES `classes` (`ClassID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
