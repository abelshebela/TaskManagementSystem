-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 07:11 PM
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
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_title` varchar(255) NOT NULL,
  `task_description` text NOT NULL,
  `task_duedate` date NOT NULL,
  `task_status` varchar(20) DEFAULT 'Pending',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_title`, `task_description`, `task_duedate`, `task_status`, `user_id`) VALUES
(1, 'Creating Report Automation System', ' Its automating the current report system in Nedamco. Moreover the system will allow them to track individual learner career growth.', '2024-01-01', 'Pending', 0),
(2, 'Tire Selling', 'I would like to sell 100 tires in this month', '2023-10-01', 'Pending', 5),
(3, 'Tire Selling', 'I would like to sell 100 tires in this month', '2023-10-01', 'Pending', 5),
(4, 'x', 'y', '2222-02-22', 'In Progress', 2),
(5, 'a', 'b', '2222-11-22', 'In Progress', 2),
(6, 'Tire selling', 'I would like to sell 100 tire in this month.', '2023-11-01', 'Completed', 9),
(7, 'Rim selling', 'I want to sell 1000 rim in September.', '2023-12-01', 'Completed', 9),
(8, 'Assisting Borche', 'I would like to assist borche to reduce his obesity', '2024-01-01', 'In Progress', 9),
(9, 'Color and Powder Coating Rim', 'I\'m planning to color and powder different rims in 2024.', '2024-01-01', 'In Progress', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_phoneno` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_email`, `user_phoneno`) VALUES
(1, 'abelshebela@gmail.com', '$2y$10$tPq6k6PSbvcMXSQZC.JDRuh2D3WpzAtHtQ5A48KqegLotlVSp67UW', NULL, NULL),
(2, 'avel', '$2y$10$UbUygwzGZG02trApLlVCCuNnLTLNC/hXmu10N1xhiI/GuoXOzsypS', NULL, NULL),
(3, 'test', '$2y$10$X/XFA1k/yi9661m5S3fPf.dSHyUSmVkj3nnp3wPBa.XnJmlezTb96', NULL, NULL),
(4, 'unknown', '$2y$10$arexsm8jd6hI11IoS29Dyu.1MI7IZBVZlH5gngNmwSWrp6hminHmq', NULL, NULL),
(5, 'nahom_abebe', '$2y$10$CgjPk9ptXyYgzOvcz32Rw.Qds7EJn1tUVaZXh8yT.Nz4nGhgcJHDO', NULL, NULL),
(6, 'mrbeast', '$2y$10$Y6f4h0kIhCjpIlBbSfS87.svVTIdPOzzYFIQ6WwbCcNcqczBfhuN6', NULL, NULL),
(7, 'jojo', '$2y$10$HZNpx4jQs8lOuTjf6koIq.ti3/JqMrZ8RxI63jNXNatjeXp/AFFya', NULL, NULL),
(8, 'leul_fro', '$2y$10$FkHKQWznO43nT2IjZxUuwu/4dRUSI1DlQ4xpxme6My/9c7ojF1R5S', 'leulfro@gmail.com', NULL),
(9, 'nahomabebe', '$2y$10$q6wcUK4XKu9oBFA.CNLOj.WU8mdLnSSG518m.ePtwApkvvhdRM4S6', 'nahomabebe@gmail.com', NULL),
(10, 'czarabysinyawiw', '$2y$10$m.h2tJyPN49tQynImjvtbOyek44YPlDM/6Uo3Rt2DTimatiDKIuuq', 'czarabysinyawiw@gmail.com', NULL),
(11, 'biruk', '$2y$10$b4Ux8z1ZBb5ZCigPYkk/iuJ2FOVwWSwEtD2CnqsPmmPJ/v2uzFGsS', 'birukabebe@gmail.com', NULL),
(12, 'pesco', '$2y$10$cqcZVnXtKUDx1ll9a/g3COfl21klN0/GiJSE/QczkZBOStwvL1UnC', 'pescopriest@gmail.com', '0941947715'),
(13, 'leul', '$2y$10$2ReVtNs7TAfsngMek5QhK.5cRvZQltvB6zdbSDpoBvvtt8CcxjYne', 'leultamriekg@gmail.com', '0931309130');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
