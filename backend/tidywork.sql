-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2021 at 02:21 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tidywork`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `boardId` int(11) NOT NULL,
  `boardData` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`boardId`, `boardData`) VALUES
(1, '{\"name\": \"First Board \"}'),
(2, '{\"name\": \"Second Board \"}');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `cardId` int(11) NOT NULL,
  `cardData` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`cardId`, `cardData`) VALUES
(1, '{\"name\": \"Design UX \", \"tags\": [1], \"color\": \"F5F5F5\", \"order\": 1, \"columnId\": 1, \"deadline\": \"2021-03-13T09:07\", \"priority\": \"\", \"assignedTo\": [1, 2], \"checklists\": \"[{name:todo1, status: COMPLETE}, {name:todo2, status: INCOMPLETE}]\", \"description\": \"Have to figure out the UX Design...\"}'),
(2, '{\"name\": \"Design UI \", \"tags\": [2], \"color\": \"F5F5F5\", \"order\": 1, \"columnId\": 2, \"deadline\": \"2021-03-13T02:07\", \"priority\": \"\", \"assignedTo\": [2], \"checklists\": [], \"description\": \"The Design is essential\"}'),
(3, '{\"name\": \"Survey Time\", \"tags\": [], \"color\": \"F5F5F5\", \"order\": 3, \"columnId\": 1, \"deadline\": \"2021-03-14T09:07\", \"priority\": \"\", \"assignedTo\": [2], \"checklists\": [], \"description\": \"\"}'),
(4, '{\"name\": \"Art Concept\", \"tags\": [], \"color\": \"FAFAFA\", \"order\": 2, \"columnId\": 2, \"deadline\": \"2021-03-13T09:07\", \"priority\": \"\", \"assignedTo\": [], \"checklists\": [], \"description\": \"\"}'),
(5, '{\"name\": \"Meeting\", \"tags\": [], \"color\": \"FAFAFA\", \"order\": 1, \"columnId\": 3, \"deadline\": \"2021-03-13T09:07\", \"priority\": \"\", \"assignedTo\": [], \"checklists\": [], \"description\": \"\"}'),
(6, '{\"name\": \"Code ViewMap Component\", \"tags\": [1, 2], \"color\": \"FAFAFA\", \"order\": 1, \"columnId\": 7, \"deadline\": \"2021-03-13T09:07\", \"priority\": \"\", \"assignedTo\": [], \"checklists\": [], \"description\": \"Revisit the view map tasks\"}'),
(7, '{\"name\": \"QA\", \"tags\": [], \"color\": \"FAFAFA\", \"order\": 1, \"columnId\": 8, \"deadline\": \"2021-03-13T09:07\", \"priority\": \"\", \"assignedTo\": [1], \"checklists\": [], \"description\": \"Quality Assurance\"}');

-- --------------------------------------------------------

--
-- Table structure for table `columns`
--

CREATE TABLE `columns` (
  `columnId` int(11) NOT NULL,
  `columnData` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `columns`
--

INSERT INTO `columns` (`columnId`, `columnData`) VALUES
(1, '{\"name\": \"Checkout \", \"boardId\": 1, \"description\": \"Here you can checkout\"}'),
(2, '{\"name\": \"Daily Habit \", \"boardId\": 1, \"description\": \"Daily habits will be recreated on a daily manner\"}'),
(3, '{\"name\": \"Todo\", \"boardId\": 1, \"description\": \"Here you can write the todos\"}'),
(4, '{\"name\": \"Doing\", \"boardId\": 1, \"description\": \"What are you working on...\"}'),
(5, '{\"name\": \"Done\", \"boardId\": 1, \"description\": \"Finished congratulations!\"}'),
(6, '{\"name\": \"Todo\", \"boardId\": 2, \"description\": \"To work on the future...\"}'),
(7, '{\"name\": \"Doing\", \"boardId\": 2, \"description\": \"What are you working on?\"}'),
(8, '{\"name\": \"Done\", \"boardId\": 2, \"description\": \"Completed!!!\"}'),
(9, '{\"name\": \"Design UX\", \"tags\": [1], \"color\": \"F5F5F5\", \"order\": 1, \"columnId\": 1, \"deadline\": \"2021-03-13T09:07\", \"priority\": \"\", \"assignedTo\": [1, 2], \"checklists\": \"[{name:todo1, status: COMPLETE}, {name:todo2, status: INCOMPLETE}]\", \"description\": \"Have to figure out the UX Design...\"}'),
(10, '{\"name\": \"Design UI\", \"tags\": [2], \"color\": \"F5F5F5\", \"order\": 1, \"columnId\": 2, \"deadline\": \"2021-03-13T02:07\", \"priority\": \"\", \"assignedTo\": [2], \"checklists\": \"[]\", \"description\": \"The Design is essential\"}'),
(11, '{\"name\": \"Market Research\", \"tags\": [], \"color\": \"F5F5F5\", \"order\": 2, \"columnId\": 1, \"deadline\": \"2021-03-14T09:07\", \"priority\": \"\", \"assignedTo\": [2], \"checklists\": \"[]\", \"description\": \"Conduct market research\"}'),
(12, '{\"name\": \"Survey Time\", \"tags\": [], \"color\": \"F5F5F5\", \"order\": 3, \"columnId\": 1, \"deadline\": \"2021-03-14T09:07\", \"priority\": \"\", \"assignedTo\": [2], \"checklists\": \"[]\", \"description\": \"\"}'),
(13, '{\"name\": \"Art Concept\", \"tags\": [], \"color\": \"FAFAFA\", \"order\": 2, \"columnId\": 2, \"deadline\": \"2021-03-13T09:07\", \"priority\": \"\", \"assignedTo\": [], \"checklists\": \"[]\", \"description\": \"\"}'),
(14, '{\"name\": \"Meeting\", \"tags\": [], \"color\": \"FAFAFA\", \"order\": 1, \"columnId\": 3, \"deadline\": \"2021-03-13T09:07\", \"priority\": \"\", \"assignedTo\": [], \"checklists\": \"[]\", \"description\": \"\"}'),
(15, '{\"name\": \"Code ViewMap Component\", \"tags\": [1, 2], \"color\": \"FAFAFA\", \"order\": 1, \"columnId\": 7, \"deadline\": \"2021-03-13T09:07\", \"priority\": \"\", \"assignedTo\": [], \"checklists\": \"[]\", \"description\": \"Revisit the view map tasks\"}'),
(16, '{\"name\": \"QA\", \"tags\": [], \"color\": \"FAFAFA\", \"order\": 1, \"columnId\": 8, \"deadline\": \"2021-03-13T09:07\", \"priority\": \"\", \"assignedTo\": [1], \"checklists\": \"[]\", \"description\": \"Quality Assurance\"}');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `commentData` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `commentData`) VALUES
(1, '{\"cardid\": 1, \"timestamp\": \"2021-03-13T09:07\", \"description\": \"Hey I will be joining a little late! \"}'),
(2, '{\"cardid\": 2, \"timestamp\": \"2021-03-13T09:07\", \"description\": \"I found a website it may help... \"}'),
(3, '{\"cardid\": 1, \"timestamp\": \"2021-03-13T09:072021-03-13T09:07\", \"description\": \"Protip:....\"}'),
(4, '{\"cardid\": 3, \"timestamp\": \"2021-03-13T09:07\", \"description\": \"Here!\"}');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tagId` int(11) NOT NULL,
  `tagData` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagId`, `tagData`) VALUES
(1, '{\"color\": \"ffcccb\", \"boardId\": 1, \"description\": \"highPriority \"}'),
(2, '{\"color\": \"99ff99\", \"boardId\": 1, \"description\": \"lowPriority \"}'),
(3, '{\"color\": \"afeeee\", \"boardId\": 1, \"description\": \"MidPriority\"}'),
(4, '{\"color\": \"ff99ff\", \"boardId\": 1, \"description\": \"Meh\"}'),
(5, '{\"color\": \"ffcccb\", \"boardId\": 2, \"description\": \"highPriority\"}'),
(6, '{\"color\": \"99ff99\", \"boardId\": 2, \"description\": \"lowPriority\"}'),
(7, '{\"color\": \"afeeee\", \"boardId\": 2, \"description\": \"MidPriority\"}'),
(8, '{\"color\": \"ffcccb\", \"boardId\": 1, \"description\": \"Urgent!!\"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userData` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userData`) VALUES
(1, '{\"name\": \"nelson \", \"tables\": [1, 2]}'),
(2, '{\"name\": \"zeroguy \", \"tables\": []}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`boardId`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`cardId`);

--
-- Indexes for table `columns`
--
ALTER TABLE `columns`
  ADD PRIMARY KEY (`columnId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `boardId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `cardId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `columns`
--
ALTER TABLE `columns`
  MODIFY `columnId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
