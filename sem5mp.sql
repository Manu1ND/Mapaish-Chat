-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2020 at 06:32 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sem5mp`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `roomID` int(11) NOT NULL,
  `isGroup` tinyint(1) NOT NULL,
  `groupName` varchar(50) DEFAULT NULL,
  `groupPicture` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`roomID`, `isGroup`, `groupName`, `groupPicture`) VALUES
(1, 1, 'First Group', 'http://localhost/sem5mp/profilePicture/group/1-1606083903.png'),
(2, 0, NULL, NULL),
(24, 0, NULL, NULL),
(25, 1, 'Final', NULL),
(26, 0, NULL, NULL),
(27, 1, 'Final', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chatroommembers`
--

CREATE TABLE `chatroommembers` (
  `roomID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatroommembers`
--

INSERT INTO `chatroommembers` (`roomID`, `Username`) VALUES
(1, 'ishwar777'),
(1, 'Manu1ND'),
(1, 'parth16'),
(2, 'ishwar777'),
(2, 'Manu1ND'),
(24, 'Manu1ND'),
(24, 'parth16'),
(25, 'ishwar777'),
(26, '21ND'),
(26, 'Manu1ND'),
(27, '21ND'),
(27, 'ishwar777'),
(27, 'Manu1ND');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Name` varchar(50) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `imgLink` text DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'Hey, I am using MAPAISH!'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Name`, `Username`, `Password`, `Email`, `imgLink`, `status`) VALUES
('Manjunath', '21ND', '1234', 'manjunath2000@hotmail.com', NULL, 'It\'s not who I am underneath but what I do that defines me.'),
('Ishwar', 'ishwar777', '1234', 'ishwar.palav@sakec.ac.in', NULL, 'Hey, I am using MAPAISH!'),
('Manu', 'Manu1ND', '1234', 'manjunath.naik@sakec.ac.in', 'http://localhost/sem5mp/profilePicture/member/Manu1ND-1606083951.png', 'It\'s not who I am underneath but what I do that defines me'),
('Parth', 'parth16', '1234', 'parth.mundhe@sakec.ac.in', NULL, 'Hey, I am using MAPAISH!');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `time` bigint(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `roomID`, `Username`, `message`, `time`) VALUES
(1, 1, 'Manu1ND', 'Hey!', 1604033103),
(2, 1, 'ishwar777', 'Hola!', 1604100103),
(3, 2, 'Manu1ND', 'Personal', 1604100003),
(4, 2, 'ishwar777', 'DM', 1604140103),
(5, 1, 'parth16', 'Boys!', 1604143803),
(6, 2, 'Manu1ND', 'Hey!', 1604254100),
(7, 1, 'parth16', 'Yo!', 1604216350),
(12, 1, 'Manu1ND', 'Hii!', 1604033103),
(22, 2, 'Manu1ND', 'final', 1604267679),
(23, 2, 'Manu1ND', 'goodnight', 1604267968),
(24, 2, 'Manu1ND', 'check', 1604268078),
(26, 2, 'Manu1ND', 'hello', 1604268144),
(28, 1, 'Manu1ND', 'test', 1604305066),
(32, 1, 'ishwar777', 'bye', 1604308639),
(38, 1, 'Manu1ND', 'gey', 1604478191),
(40, 1, 'Manu1ND', 'goodnight', 1604478900),
(42, 2, 'Manu1ND', 'final', 1604478984),
(45, 1, 'parth16', 'hi', 1604479531),
(48, 2, 'Manu1ND', 'I am leaving', 1604480481),
(50, 1, 'parth16', 'Parth here!', 1604496894),
(51, 2, 'ishwar777', 'Ishwar here!', 1604496994),
(53, 2, 'Manu1ND', 'HI', 1604850707),
(54, 1, 'Manu1ND', 'final', 1604870670),
(55, 1, 'Manu1ND', 'goodnight', 1604870676),
(56, 1, 'Manu1ND', 'final', 1604938068),
(74, 24, 'Manu1ND', 'Chatroom Created', 1605528994),
(75, 25, 'Manu1ND', 'Chatroom Created', 1605529017),
(76, 25, 'Manu1ND', 'Hz', 1605529054),
(77, 1, 'Manu1ND', 'HIIII', 1605641250),
(78, 26, 'Manu1ND', 'Chatroom Created', 1606054412),
(79, 27, 'Manu1ND', 'Chatroom Created', 1606054427);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`roomID`);

--
-- Indexes for table `chatroommembers`
--
ALTER TABLE `chatroommembers`
  ADD PRIMARY KEY (`roomID`,`Username`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `Username` (`Username`),
  ADD KEY `roomID` (`roomID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chatroommembers`
--
ALTER TABLE `chatroommembers`
  ADD CONSTRAINT `chatroommembers_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `members` (`Username`),
  ADD CONSTRAINT `chatroommembers_ibfk_2` FOREIGN KEY (`roomID`) REFERENCES `chatroom` (`roomID`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `members` (`Username`),
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`roomID`) REFERENCES `chatroom` (`roomID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
