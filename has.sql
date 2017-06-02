-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 17, 2017 at 09:11 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `has`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewFuture` (IN `branchArg` VARCHAR(20))  NO SQL
SELECT appointment.Time, doctor.Name, patient.Username
FROM appointment
INNER JOIN patient ON appointment.PatientID = patient.ID
INNER JOIN doctor ON appointment.DoctorID = doctor.ID
INNER JOIN branch ON doctor.BranchID = branch.ID
WHERE appointment.Time > CURRENT_TIMESTAMP
AND (branchArg = 'ALL' OR branchArg = branch.Name)
ORDER BY Time ASC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `viewPast` (IN `branchArg` VARCHAR(20))  NO SQL
SELECT appointment.Time, doctor.Name, patient.Username
FROM appointment
INNER JOIN patient ON appointment.PatientID = patient.ID
INNER JOIN doctor ON appointment.DoctorID = doctor.ID
INNER JOIN branch ON doctor.BranchID = branch.ID
WHERE appointment.Time < CURRENT_TIMESTAMP
AND (branchArg = 'ALL' OR branchArg = branch.Name)
ORDER BY Time ASC$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `Username` char(128) NOT NULL,
  `Password` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Username`, `Password`) VALUES
(1, '77C1852BAEC5588124B113C7D85C32F7078DDFEF4F71419CA7FD92D4D014BE696CE21F22549C42BD01C4BFE70D86BA307F3E11F5E074545FD870D618C9B59453', 'BA3253876AED6BC22D4A6FF53D8406C6AD864195ED144AB5C87621B6C233B548BAEAE6956DF346EC8C17F5EA10F35EE3CBC514797ED7DDD3145464E2A0BAB413');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `Time` datetime NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`Time`, `DoctorID`, `PatientID`) VALUES
('2017-04-29 11:20:00', 1, 1),
('2017-05-03 14:20:00', 2, 1),
('2017-05-08 14:25:00', 3, 1),
('2017-05-14 13:00:00', 4, 1),
('2017-05-22 13:00:00', 5, 1),
('2017-05-30 14:00:00', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `ID` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`ID`, `Name`) VALUES
(1, 'cardiology'),
(2, 'ent'),
(3, 'gynaecology'),
(4, 'neurology'),
(5, 'oncology'),
(6, 'orthopaedics');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `ID` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `BranchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`ID`, `Name`, `BranchID`) VALUES
(1, 'Matthew Manning', 1),
(2, 'April Mosley', 2),
(3, 'Esteban Morrison', 3),
(4, 'Harvey Zimmerman', 4),
(5, 'Clinton Marshall', 5),
(6, 'Kristin Miller', 6);

--
-- Triggers `doctor`
--
DELIMITER $$
CREATE TRIGGER `delete appointments of deleted doctors` BEFORE DELETE ON `doctor` FOR EACH ROW DELETE FROM appointment WHERE DoctorID = OLD.ID AND appointment.Time > CURRENT_TIMESTAMP
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `ID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`ID`, `Username`, `Password`) VALUES
(1, 'berk', 'D404559F602EAB6FD602AC7680DACBFAADD13630335E951F097AF3900E9DE176B6DB28512F2E000B9D04FBA5133E8B1C6E8DF59DB3A8AB9D60BE4B97CC9E81DB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`Time`,`DoctorID`),
  ADD KEY `patient` (`PatientID`) USING BTREE,
  ADD KEY `doctor` (`DoctorID`) USING BTREE;

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `branch` (`BranchID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `doctor's id` FOREIGN KEY (`DoctorID`) REFERENCES `doctor` (`ID`),
  ADD CONSTRAINT `patient's id` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`ID`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `Doctor's branch` FOREIGN KEY (`BranchID`) REFERENCES `branch` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
