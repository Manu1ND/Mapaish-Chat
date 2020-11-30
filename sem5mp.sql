-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 02:42 PM
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
  `groupName` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `groupPicture` text COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`roomID`, `isGroup`, `groupName`, `groupPicture`) VALUES
(1, 0, NULL, NULL),
(2, 0, NULL, NULL),
(3, 0, NULL, NULL),
(4, 1, 'Founders', 'profilePicture/group/4-1606726338.png');

-- --------------------------------------------------------

--
-- Table structure for table `chatroommembers`
--

CREATE TABLE `chatroommembers` (
  `roomID` int(11) NOT NULL,
  `Username` varchar(50) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chatroommembers`
--

INSERT INTO `chatroommembers` (`roomID`, `Username`) VALUES
(1, 'Manu1ND'),
(1, 'parthmundhe'),
(2, 'Manu1ND'),
(2, 'ishwar20'),
(3, 'ishwar20'),
(3, 'parthmundhe'),
(4, 'Manu1ND'),
(4, 'ishwar20'),
(4, 'parthmundhe');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `Username` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `Password` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `imgLink` text COLLATE utf8mb4_bin DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_bin NOT NULL DEFAULT 'Hey, I am using MAPAISH!'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Name`, `Username`, `Password`, `Email`, `imgLink`, `status`) VALUES
('Manjunath Naik', 'Manu1ND', 'qwer5678', 'manjunath.naik@sakec.ac.in', 'profilePicture/member/Manu1ND-1606724744.jpg', 'It\'s not who I am underneath but what I do that defines me.'),
('Ishwar Palav', 'ishwar20', 'I12345678', 'ishwar.palav@sakec.ac.in', 'profilePicture/member/ishwar20-1606725613.jpg', 'Keep Smiling😀'),
('Parth Mundhe', 'parthmundhe', 'Parth1604', 'parthmundhe@gmail.com', 'profilePicture/member/parthmundhe-1606724578.png', 'Hey, I am using MAPAISH!');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `Username` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `message` text COLLATE utf8mb4_bin NOT NULL,
  `time` bigint(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `roomID`, `Username`, `message`, `time`) VALUES
(1, 1, 'Manu1ND', 'Chatroom Created', 1606724248),
(2, 1, 'Manu1ND', 'Hello', 1606724253),
(3, 1, 'parthmundhe', 'yo', 1606724276),
(4, 1, 'Manu1ND', 'Let\'s complete the report asap!', 1606724301),
(5, 1, 'parthmundhe', 'yes', 1606724312),
(6, 2, 'ishwar20', 'Chatroom Created', 1606724433),
(7, 3, 'parthmundhe', 'Chatroom Created', 1606724434),
(8, 4, 'Manu1ND', 'Chatroom Created', 1606724446),
(9, 3, 'parthmundhe', 'yo', 1606724451),
(10, 4, 'parthmundhe', 'report almost done', 1606724468),
(11, 3, 'ishwar20', 'Hey!', 1606724484),
(12, 4, 'Manu1ND', 'good', 1606724510),
(13, 4, 'ishwar20', 'Hey Everyone', 1606724517),
(14, 3, 'parthmundhe', 'wassup', 1606724526),
(15, 2, 'Manu1ND', 'Hola!', 1606725110),
(16, 1, 'Manu1ND', 'Please check the changes I have made', 1606727004),
(17, 4, 'Manu1ND', 'Hello Ishwar', 1606727096);

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
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chatroommembers`
--
ALTER TABLE `chatroommembers`
  ADD CONSTRAINT `chatroommembers_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `members` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chatroommembers_ibfk_2` FOREIGN KEY (`roomID`) REFERENCES `chatroom` (`roomID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `members` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`roomID`) REFERENCES `chatroom` (`roomID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
