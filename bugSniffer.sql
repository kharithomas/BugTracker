-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 09:05 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bugSniffer`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `p_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `role`, `p_id`) VALUES
(1, 'John Smith', 'johnsmith@hotmail.com', '2', 1),
(2, 'Dan Stevenson', 'danstevenson@aol.com', '1', 2),
(3, 'Jane Doe', 'janedoe@ymail.com', '3', 2),
(4, 'Erika Peterson', 'erikapeterson@gmail.com', '3', 3),
(5, 'Matt Greene', 'mattgreene@yahoo.com', '3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`) VALUES
(1, 'Half Life 3', 'A totally awesome game that will never come to light, thanks Gaben.'),
(2, 'Bully 2', 'One could only hope Rockstar does not ruin this with microtransactions.'),
(3, 'Dead Space 4', 'Should this even come out? Hmm hopefully its better than 3.'),
(4, 'GTA 6', 'Yep, you know its coming soon. '),
(9, 'Gun Blaster 3', 'The newest game to never hit market');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'project manager'),
(3, 'developer'),
(4, 'submitter');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `p_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `submitter` int(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  `priority` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `p_id`, `name`, `submitter`, `status`, `priority`, `type`, `date_created`, `date_modified`) VALUES
(1, 2, 'Fix AI auto aim bug', 1, 'open', 'Low', 'bug', '2020-04-21 19:00:40', '2020-04-21 19:00:40'),
(2, 4, 'Remove hidden mission', 4, 'open', 'Low', 'bug', '2020-04-21 19:00:40', '2020-04-21 19:00:40'),
(3, 1, 'Change end game boss', 5, 'open', 'Low', 'bug', '2020-04-21 19:00:40', '2020-04-21 19:00:40'),
(4, 1, 'fix dem bugs', 3, 'open', 'low', 'type', '2020-04-22 00:00:00', '2020-04-22 00:00:00'),
(5, 2, 'Add more GUNS!', 2, 'open', 'Med', 'exploit', '2020-04-22 14:46:13', '2020-04-22 14:46:13'),
(9, 1, 'Broken Code', 5, 'open', 'Low', 'bug', '2020-04-22 18:27:32', '2020-04-22 18:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachment`
--

CREATE TABLE `ticket_attachment` (
  `id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `uploader` int(11) NOT NULL,
  `image_text` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_attachment`
--

INSERT INTO `ticket_attachment` (`id`, `t_id`, `image`, `uploader`, `image_text`, `date_created`) VALUES
(9, 1, 'milkiyas.JPG', 1, '', '2020-04-24 15:46:25'),
(10, 1, '', 1, '', '2020-04-24 15:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comment`
--

CREATE TABLE `ticket_comment` (
  `id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `commenter` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_comment`
--

INSERT INTO `ticket_comment` (`id`, `t_id`, `commenter`, `message`, `date_created`) VALUES
(1, 2, 3, 'Looking good', '2020-04-23 00:00:00'),
(2, 2, 2, 'Add more color to the game', '2020-04-24 18:28:02'),
(4, 1, 2, 'I will work on this right now', '2020-04-24 18:37:58'),
(5, 2, 2, 'Hey there', '2020-04-24 20:31:59'),
(6, 1, 2, 'Here\'s my comment', '2020-04-24 20:46:46'),
(7, 1, 2, 'Here\'s my comment', '2020-04-24 20:47:09'),
(8, 1, 2, 'Here\'s my comment', '2020-04-24 20:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_history`
--

CREATE TABLE `ticket_history` (
  `id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `submitter` varchar(100) NOT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(100) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `role`) VALUES
(1, 'test', '$2y$10$cvrYdMaVqPRGWHMBjVsne.NBgYJlGmW8vNczfm1POlxvJg19yIKLC', '2020-04-23 12:39:30', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_attachment`
--
ALTER TABLE `ticket_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_comment`
--
ALTER TABLE `ticket_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_history`
--
ALTER TABLE `ticket_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ticket_attachment`
--
ALTER TABLE `ticket_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ticket_comment`
--
ALTER TABLE `ticket_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ticket_history`
--
ALTER TABLE `ticket_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
