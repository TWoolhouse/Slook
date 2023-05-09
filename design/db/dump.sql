-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2023 at 01:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slook`
--

-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE `Message` (
  `uid` bigint(20) UNSIGNED NOT NULL,
  `thread` int(10) UNSIGNED NOT NULL,
  `owner` int(10) UNSIGNED NOT NULL,
  `content` varchar(128) NOT NULL,
  `created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Project`
--

CREATE TABLE `Project` (
  `uid` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `leader` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Project`
--

INSERT INTO `Project` (`uid`, `name`, `leader`) VALUES
(1, 'Spring Cleaning', 1),
(2, 'Destroying the One Ring', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ProjectTask`
--

CREATE TABLE `ProjectTask` (
  `task` int(10) UNSIGNED NOT NULL,
  `project` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ProjectTask`
--

INSERT INTO `ProjectTask` (`task`, `project`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 1),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE `Task` (
  `uid` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `wokerhours` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `started` datetime DEFAULT NULL,
  `completed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Task`
--

INSERT INTO `Task` (`uid`, `name`, `wokerhours`, `created`, `started`, `completed`) VALUES
(1, 'Walking to Mordor', 4368, '2023-05-05 13:44:19', '2023-05-05 15:00:00', NULL),
(2, 'Attend the Council of Elrond', 192, '2023-05-05 13:44:19', '2023-05-06 12:00:00', NULL),
(3, 'Pass through the Mines of Moria', 432, '2023-05-05 13:44:19', '2023-05-05 17:00:00', NULL),
(4, 'Tidy up Room', 2, '2023-05-05 13:44:19', '2023-05-07 11:00:00', '2023-05-07 12:30:00'),
(5, 'Go down to the Tip', 1, '2023-05-05 13:44:19', '2023-05-07 12:00:00', '2023-05-07 13:00:00'),
(6, 'Vacuum House', 2, '2023-05-05 13:44:19', '2023-05-07 10:00:00', '2023-05-07 10:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `TaskUser`
--

CREATE TABLE `TaskUser` (
  `user` int(10) UNSIGNED NOT NULL,
  `task` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `TaskUser`
--

INSERT INTO `TaskUser` (`user`, `task`) VALUES
(1, 5),
(2, 3),
(2, 6),
(3, 1),
(3, 2),
(3, 4),
(4, 1),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Thread`
--

CREATE TABLE `Thread` (
  `uid` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ThreadViewer`
--

CREATE TABLE `ThreadViewer` (
  `thread` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `uid` int(10) UNSIGNED NOT NULL,
  `email` varchar(32) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `password` char(60) DEFAULT NULL,
  `role` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`uid`, `email`, `name`, `password`, `role`) VALUES
(1, 'louiemthomas02@gmail.com', 'Louie Thomas', 'SecurePassword123', 1),
(2, 'adalovelace1@make-it-all.com', 'Ada Lovelace', 'LaceLover01', 3),
(3, 'bertthebuilder@make-it-all.com', 'Bert Smith', 'BertieIsTheBest1!', 2),
(4, 'clarajohnson01@make-it-all.com', 'Clara Johnson', 'MeEncantaEspana2006', 2),
(5, 'dilip-the-dodo@make-it-all.com', 'Dilip Schmidt', 'IAmNotADodo123', 1),
(6, 'emilysgarn1996@make-it-all.com', 'Emily Garn', 'EmmaStone2006', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Message`
--
ALTER TABLE `Message`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `thread` (`thread`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `Project`
--
ALTER TABLE `Project`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `leader` (`leader`);

--
-- Indexes for table `ProjectTask`
--
ALTER TABLE `ProjectTask`
  ADD KEY `task` (`task`),
  ADD KEY `project` (`project`);

--
-- Indexes for table `Task`
--
ALTER TABLE `Task`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `TaskUser`
--
ALTER TABLE `TaskUser`
  ADD PRIMARY KEY (`user`,`task`),
  ADD KEY `task` (`task`);

--
-- Indexes for table `Thread`
--
ALTER TABLE `Thread`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `ThreadViewer`
--
ALTER TABLE `ThreadViewer`
  ADD KEY `thread` (`thread`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Message`
--
ALTER TABLE `Message`
  MODIFY `uid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Project`
--
ALTER TABLE `Project`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Task`
--
ALTER TABLE `Task`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Thread`
--
ALTER TABLE `Thread`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`thread`) REFERENCES `Thread` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`owner`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Project`
--
ALTER TABLE `Project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`leader`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ProjectTask`
--
ALTER TABLE `ProjectTask`
  ADD CONSTRAINT `projecttask_ibfk_1` FOREIGN KEY (`task`) REFERENCES `Task` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projecttask_ibfk_2` FOREIGN KEY (`project`) REFERENCES `Project` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `TaskUser`
--
ALTER TABLE `TaskUser`
  ADD CONSTRAINT `taskuser_ibfk_1` FOREIGN KEY (`user`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `taskuser_ibfk_2` FOREIGN KEY (`task`) REFERENCES `Task` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ThreadViewer`
--
ALTER TABLE `ThreadViewer`
  ADD CONSTRAINT `threadviewer_ibfk_1` FOREIGN KEY (`thread`) REFERENCES `Thread` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `threadviewer_ibfk_2` FOREIGN KEY (`user`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
