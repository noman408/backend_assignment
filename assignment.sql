-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 07, 2024 at 11:55 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(34, 3, 12),
(35, 3, 13),
(36, 3, 14);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `post_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `description`, `post_status`, `user_id`, `created_at`, `updated_at`) VALUES
(12, '122', '123', 1, 1, '2024-07-06 14:09:53', '2024-07-06 15:35:08'),
(13, 'Hi2', 'Published', 1, 1, '2024-07-06 15:11:31', '2024-07-06 15:57:37'),
(14, 'hi', 'unpublished', 0, 1, '2024-07-06 15:11:47', '2024-07-06 15:11:47'),
(15, 'My Test 2', 'Hello', 1, 1, '2024-07-07 11:24:30', '2024-07-07 11:24:36'),
(16, 'Testing Post', 'Test Content', 1, 3, '2024-07-07 11:35:10', '2024-07-07 11:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `email`, `auth_key`, `verification_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'noman', '$2y$13$mUx2uEc3XpF.ErRfRpeOf.VEk/F6E3HK5/zSWsEIRl8GZZYAuFL3C', 'noman.aslam408@gmail.com', NULL, 'DQGobF5K3S96TvO2DHQ8Y6bbjOm5Zggi_1720268772', 1, 1720268772, 1720268783),
(2, 'noman123', '$2y$13$V6cnCYHnVMlAW8h4Xcd7runt/n/fopkFpTioUEwXmt2vKYQ3cTBu.', 'noman@aslam.com', NULL, 'gPjHyQmIQ4MiUJrPuYBpyw5-IMbLzmRL_1720351512', 1, 1720351512, 1720351527),
(3, 'noman.aslam', '$2y$13$BB/sq6HXaJ0DqkrT6ADrQuJAHkb2FnFpgwcnQKSaIo5xFFf4Ug0pq', 'noman.aslam409@gmail.com', NULL, 'zjpaGFZYWAH7_vA2PXXB4qFWOu0ivrMO_1720352032', 1, 1720352032, 1720352062);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
