-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 01:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) NOT NULL DEFAULT 'photos/placeholder.jpg',
  `posts` int(11) NOT NULL,
  `comments` int(11) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `email`, `password`, `date`, `profile_pic`, `posts`, `comments`, `likes`) VALUES
(3, 'alpha9584', 'alpha95849584@gmail.com', '$2y$10$PIDQF8yPwYkBF1jwOlX1jOBBiscDRs2HUlql/Y8wC4szpL5iK1geW', '2023-03-28', 'photos/ezgif-4-70118e4222.gif', 0, 0, 0),
(4, 'yessir', 'moli@gmail.com', '$2y$10$IFtbNkFp3gjiZlukHF.SM.wPMDIJCXRezAlfGZaW7psyG2Z/zyp/y', '2023-04-22', 'photos/6ed6bc.jpg', 0, 0, 0),
(5, 'rani', 'charradi@gmail.com', '$2y$10$k4T1XXoikWqKzCchO.XXsuaB./x5uBqJXyBvFYG7ewNbu41NPzoVy', '2023-04-24', 'photos/90472442_1309274962796309_6319703660603375616_n.png', 0, 0, 0),
(6, 'nagham', 'nagham@gmail.com', '$2y$10$3YHAmOL.2QMWniIPfV87feVnodZURKgU3yFyIg5uIqrghQHTrWbiS', '2023-04-24', 'photos/269000373_1581154572235223_2686152679652883734_n.jpg', 0, 0, 0),
(7, 'mohmoh', 'mohmoh@gmail.com', '$2y$10$7HRwqu6BkBF9FDnllHY9oephMlNYkNJpAL6.NjvF8bHtBmnCdNada', '2023-04-25', 'photos/291336219_2604393363031057_2141379813813761414_n.jpg', 0, 0, 0),
(8, 'wael', 'wael@gmail.com', '$2y$10$AXKZUz1qM6zD2yFA7Y8qAOMR6t7WSnDOsFbyIwrL.hKttJYDacrEW', '2023-05-04', 'photos/placeholder.jpg', 0, 0, 0),
(9, 'mren', 'mren@gmail.com', '$2y$10$ALAdvVYDHRlgDM2DY3I0jevnGatoSKSItz0X0U4g7dX6AaxaKgdDK', '2023-05-04', 'photos/placeholder.jpg', 0, 0, 0),
(10, 'mohamed', 'mohamed.jemai@etudiant-isi.utm.tn', '$2y$10$KFpgNcPXwkdESJXb6gVGpu36kGA/Gu9bA2oHL7kgHNZL.nTKVhxrq', '2023-05-04', 'photos/placeholder.jpg', 0, 0, 0),
(11, 'khaled', 'khaled@gmail.com', '$2y$10$bdcFSz9Tw9tAT7re6Xew1.8jL/Eba0yXUtchOZ8i1SNz60/q85L/e', '2023-05-05', 'photos/364D1F51-B67A-4FA5-83E6-1F32D62B6A78.gif', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `idp` int(11) NOT NULL,
  `under` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `content` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `id_topic` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`idp`, `under`, `id`, `username`, `title`, `content`, `created_at`, `id_topic`) VALUES
(42, NULL, 3, 'alpha9584', 'Question', 'What\'s your favorite smart home device and why?', '2023-05-03 21:36:32', 6),
(43, NULL, 4, 'yessir', 'The future of Virtual Reality (VR) gaming', 'Discuss your predictions and hopes.', '2023-05-03 21:36:32', 6),
(44, NULL, 4, 'yessir', 'Hello', 'Hello everyone I\'m new here!', '2023-05-03 21:49:10', 4),
(45, NULL, 4, 'yessir', 'Hello', 'Hello everyone I\'m new here!', '2023-05-03 21:49:30', 4),
(46, NULL, 4, 'yessir', 'Hello', 'Hello everyone!', '2023-05-03 21:50:40', 4),
(47, NULL, 4, 'yessir', 'NASA NEWS', 'NASA just launched a new rocket to uranus!!', '2023-05-04 03:12:51', 5),
(58, 42, 4, 'yessir', NULL, 'a laptop obviously', '2023-05-04 03:19:54', NULL),
(59, 46, 3, 'alpha9584', NULL, 'hello', '2023-05-04 13:45:13', NULL),
(60, 58, 3, 'alpha9584', NULL, 'test', '2023-05-04 13:50:23', NULL),
(61, 59, 11, 'khaled', NULL, 'whatsup', '2023-05-05 15:20:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `description`) VALUES
(3, 'General Discussion', 'A place for users to talk about anything that doesn\'t fit in other categories.'),
(4, 'Introductions', 'A section for new users to introduce themselves and get acquainted with the community.'),
(5, 'Science Fiction and Fantasy', 'Discuss your favorite sci-fi and fantasy books, movies, TV shows, and comics.'),
(6, 'Technology and Gadgets', 'Discuss the latest tech news, gadgets, and devices relevant to the geek community.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uu` (`username`),
  ADD UNIQUE KEY `ue` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`idp`),
  ADD KEY `fku` (`username`),
  ADD KEY `fki` (`id`),
  ADD KEY `fkun` (`under`),
  ADD KEY `fkt` (`id_topic`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fki` FOREIGN KEY (`id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkt` FOREIGN KEY (`id_topic`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fku` FOREIGN KEY (`username`) REFERENCES `accounts` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkun` FOREIGN KEY (`under`) REFERENCES `posts` (`idp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
