-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2021 at 06:28 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `list-to-do`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `email`, `PASSWORD`) VALUES
(1, 'admin', 'maipha1230@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id_todo` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `task` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `due_date` datetime DEFAULT NULL,
  `status_active` int(1) UNSIGNED ZEROFILL DEFAULT NULL,
  `priority` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id_todo`, `user_id`, `task`, `create_date`, `due_date`, `status_active`, `priority`) VALUES
(29, 2, 'meering with Art', '2021-08-13 18:38:48', '2021-08-28 18:38:00', 1, 'HIGH'),
(39, 5, 'meeting with PS', '2021-09-09 19:45:00', '2021-09-17 19:44:00', 3, 'LOW'),
(40, 5, 'meeting with mr.T', '2021-09-09 21:32:57', '2021-09-10 21:32:00', 3, 'HIGH'),
(42, 5, 'meeting with SW', '2021-09-09 22:00:23', '2021-09-24 22:00:00', 1, 'HIGH'),
(43, 5, 'swiming at pool', '2021-09-09 22:07:39', '2021-09-23 22:07:00', 2, 'LOW'),
(44, 5, 'mid exam DBMS', '2021-09-09 22:07:56', '2021-10-01 19:28:00', 2, 'HIGH'),
(46, 2, 'dddd', '2021-09-09 22:11:31', '2021-09-24 22:11:00', 3, 'LOW'),
(64, 1, 'test2', '2021-09-13 17:07:54', '2021-09-13 20:07:00', 1, 'HIGH');

-- --------------------------------------------------------

--
-- Table structure for table `todo_expire`
--

CREATE TABLE `todo_expire` (
  `id_todo_expire` int(11) NOT NULL,
  `expire_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_todo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todo_expire`
--

INSERT INTO `todo_expire` (`id_todo_expire`, `expire_date`, `id_todo`) VALUES
(10, '2021-10-05 14:39:54', 40),
(11, '2021-10-05 14:39:58', 39);

-- --------------------------------------------------------

--
-- Table structure for table `todo_finish`
--

CREATE TABLE `todo_finish` (
  `id_todo_finish` int(11) NOT NULL,
  `finish_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_todo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todo_finish`
--

INSERT INTO `todo_finish` (`id_todo_finish`, `finish_date`, `id_todo`) VALUES
(24, '2021-10-05 14:39:52', 44),
(25, '2021-10-05 14:39:55', 43);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'maipha1230@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'notty', 'notty_superman@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(5, 'test_user', 'maipha1230@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id_todo`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `todo_expire`
--
ALTER TABLE `todo_expire`
  ADD PRIMARY KEY (`id_todo_expire`),
  ADD KEY `todo_expire_ibfk_1` (`id_todo`);

--
-- Indexes for table `todo_finish`
--
ALTER TABLE `todo_finish`
  ADD PRIMARY KEY (`id_todo_finish`),
  ADD KEY `todo_finish_ibfk_1` (`id_todo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id_todo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `todo_expire`
--
ALTER TABLE `todo_expire`
  MODIFY `id_todo_expire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `todo_finish`
--
ALTER TABLE `todo_finish`
  MODIFY `id_todo_finish` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `todo`
--
ALTER TABLE `todo`
  ADD CONSTRAINT `todo_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `todo_expire`
--
ALTER TABLE `todo_expire`
  ADD CONSTRAINT `todo_expire_ibfk_1` FOREIGN KEY (`id_todo`) REFERENCES `todo` (`id_todo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `todo_finish`
--
ALTER TABLE `todo_finish`
  ADD CONSTRAINT `todo_finish_ibfk_1` FOREIGN KEY (`id_todo`) REFERENCES `todo` (`id_todo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
