-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2017 at 10:18 
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hirundo`
--

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follower_id` int(11) NOT NULL,
  `followee_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follower_id`, `followee_id`, `id`) VALUES
(2, 3, 12),
(9, 1, 14),
(9, 2, 15),
(3, 1, 16),
(3, 2, 17),
(3, 9, 18),
(10, 2, 20),
(10, 3, 21),
(10, 9, 22),
(10, 1, 23),
(1, 9, 31),
(1, 10, 32);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`sender_id`, `receiver_id`, `message`, `id`) VALUES
(10, 10, 'fdsfsdf', 1),
(10, 10, 'fd', 2),
(10, 10, 'ssss', 3),
(10, 3, 'dsfsdf', 4),
(10, 2, 'new message', 5),
(10, 2, 'dasadsad', 6),
(1, 10, 'sdsd', 7),
(10, 1, 'hi', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `user_id` int(11) NOT NULL,
  `content` varchar(140) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`user_id`, `content`, `id`) VALUES
(2, 'dsds', 56),
(3, 'example3', 63),
(2, 'dfdsf', 67),
(2, 'fdfd', 68),
(2, 'ffff', 69),
(2, 'fff', 70),
(2, 'fff', 71),
(2, 'ffff', 72),
(2, 'fff', 73),
(2, 'ffff', 74),
(2, 'ffff', 75),
(2, 'ffff', 76),
(2, 'fff', 77),
(2, 'fff', 78),
(2, 'ff', 79),
(2, 'f', 80),
(2, 'f', 81),
(2, 'f', 82),
(2, 'f', 83),
(2, 'f', 84),
(2, 'f', 85),
(2, 'f', 86),
(2, 'f', 87),
(2, 'f', 88),
(2, 'f', 89),
(2, 'f', 90),
(2, 'f', 91),
(2, 'f', 92),
(2, 'f', 93),
(2, 'f', 94),
(2, 'f', 95),
(2, 'f', 96),
(2, 'f', 97),
(2, 'f', 98),
(2, 'f', 99),
(2, 'f', 100),
(2, 'f', 101),
(2, 'f', 102),
(2, 'f', 103),
(2, 'dsasf', 104),
(2, 'ddd', 105),
(2, 'ssss', 106),
(2, 'dddd', 107),
(2, 'ddd', 108),
(2, 'ssss', 109),
(3, 'ddd', 110),
(10, 'hi', 111),
(10, 'ddfd', 112),
(1, 'test', 129);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image_url` varchar(140) NOT NULL,
  `address` varchar(30) NOT NULL,
  `website` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_pass`, `description`, `image_url`, `address`, `website`, `created_at`, `user_name`) VALUES
(1, 'example@example.com', '$2y$10$3femrFg4grvGc9tjyxVFmOJ4ENiY4nTsvpoUAyY4cWAjrT3y3H8G2', '', 'http://images.nymag.com/news/business/boom-brands/business130930_grumpycat_2_560.jpg', 'Cattown', 'cats.com', '2017-01-17 22:30:34', 'Grumpy cat'),
(2, 'example2@example.com', '$2y$10$DacKR.JU3bYYEcBwRFm6XeQUSEr.8mIpQevbl5wwjhNfD1j7Opsny', '', 'http://kids.nationalgeographic.com/content/dam/kids/photos/animals/Mammals/H-P/pig-young-closeup.jpg.adapt.945.1.jpg', 'Sofia, Bulgaria', 'github.com/tborisovas', '2017-01-17 22:30:34', 'kjnkjnjj'),
(3, 'example3@example.com', '$2y$10$yJnuRyfBFc7VoQ08.hyNAuxiVWxuY.E85G5/hn8Ff.sz88dWTdPXi', '', 'https://s-media-cache-ak0.pinimg.com/236x/e4/fa/53/e4fa53ab96509501880f20faeac2556a.jpg', '', '', '2017-01-17 22:30:34', ''),
(9, 'ts.borisova3@gmail.com', '$2y$10$rDMlxLuFnChWOq8IDIYVMeRSs8QERV8ac5Tu4CP01q61x3GQIXDzu', 'Described', 'https://avatars1.githubusercontent.com/u/6232425?v=3&s=460', 'Ð¡ÑƒÑ…Ð°Ñ‚Ð° Ñ€ÐµÐºÐ°, j.k.suh', 'example2example.com', '2017-01-28 19:57:13', ''),
(10, 'example4@example.com', '$2y$10$E8mMpivpCNH37YSdq9v9Tuh6KWnpAarD3awZgEAw1GntAmCxtdLQO', 'Love to program', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Athene_cuniculariaa.jpg/170px-Athene_cuniculariaa.jpg', 'j,k. Suhata reka, bl. 95, entr', 'github.com/tborisova', '2017-02-08 17:13:07', 'tsvetelina borisova');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
