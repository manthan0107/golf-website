-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2026 at 09:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `golfweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `date`, `image`, `content`, `reg_date`) VALUES
(1, 'Ten features of golf that make everyone love it.', 'March 17, 2025', '../image/blog-01.jpg', 'It had such high applause that a few golf players guaranteed Waterville to be the best fairway on the planet.', '2026-02-10 08:49:32'),
(2, 'Learn all about golf from this politician.', 'March 12, 2025', '../image/blog-02.jpg', 'It had such high applause that a few golf players guaranteed Waterville to be the best fairway on the planet.', '2026-02-10 08:49:32'),
(3, 'The truth about golf is about to be revealed.', 'March 10, 2021', '../image/blog-03.jpg', 'It had such high applause that a few golf players guaranteed Waterville to be the best fairway on the planet.', '2026-02-10 08:49:32'),
(4, 'Seven facts that nobody told you about sports.', 'March 03, 2025', '../image/blog-04.jpg', 'It had such high applause that a few golf players guaranteed Waterville to be the best fairway on the planet.', '2026-02-10 08:49:32'),
(5, 'Learn how to make more money with golf.', 'June 10, 2025', '../image/blog-05.jpg', 'It had such high applause that a few golf players guaranteed Waterville to be the best fairway on the planet.', '2026-02-10 08:49:32'),
(6, 'Simple ways to teach kids how to play golf', 'August 01, 2025', '../image/blog-06.jpg', 'It had such high applause that a few golf players guaranteed Waterville to be the best fairway on the planet.', '2026-02-10 08:49:32');

-- --------------------------------------------------------

--
-- Table structure for table `coaching`
--

CREATE TABLE `coaching` (
  `id` int(20) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `cno` int(20) NOT NULL,
  `age` varchar(25) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL,
  `timeslot` varchar(25) NOT NULL,
  `message` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coaching`
--

INSERT INTO `coaching` (`id`, `name`, `email`, `cno`, `age`, `gender`, `level`, `timeslot`, `message`) VALUES
(7, 'harshit', 'variya@gmail.com', 2147483647, '99', 'male', 'Intermediate', 'Morning', 'hyyyyyyyyyyyyyyyyyy'),
(11, 'manthan', 'munjanimanthan02@gmail.co', 2147483647, '18', 'male', 'Beginner', 'Morning', 'good one');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `contact` int(11) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `contact`, `message`) VALUES
(1, 'fsfd', 'fas@gmail', 'hello', 9823, 'hello '),
(2, 'Rahul', 'rahul@gmail.com', 'Joker', 98252, 'Hello From Rahul'),
(3, 'Aaryan', 'romaliya@gmail.com', 'Bayu Veda', 98252, 'Checking aleat box'),
(4, 'Aaryan', 'romaliya@gmail.com', 'Bayu Veda', 98252, 'Checking aleat box'),
(6, 'man', 'man@gmail.com', 'good', 2147483647, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `contact` int(11) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `name`, `email`, `subject`, `contact`, `message`) VALUES
(1, 'Harshit', 'variya@gmail.com', 'Maths', 98252, 'Hello from Harshit'),
(4, 'meet', 'meet@gmail.com', 'Maths', 2147483647, 'Hello from meet'),
(5, 'raj', 'raj@gmail.com', 'science', 2147483647, 'Checking Aleartbox '),
(6, 'munjain', 'munjanimanthan02@gmail.com', 'golf', 2147483647, 'good one');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(25) NOT NULL,
  `title` varchar(25) NOT NULL,
  `price` varchar(25) NOT NULL,
  `duration` varchar(25) NOT NULL,
  `image` varchar(25) NOT NULL,
  `features` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `title`, `price`, `duration`, `image`, `features`) VALUES
(1, 'gold', '298', '6 month', 'Screenshot 2024-07-28 092', '20per'),
(3, 'silver', '299', '6 month', 'Screenshot (242).png', '10 good bols');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `email`, `password`) VALUES
(1, 'manthan munjani', 'munjanimanthan02@gmail.co', '$2y$10$iKEQ8hHDTBfCiXcQA1aOiOw9pcGLhaiGa.isxgT8K.kRp7YLkdiDa'),
(2, 'manthan munjani', 'munjanimanthan02@gmail.co', '$2y$10$Br.iWwkdZ9p/UXkLlDYqLe41STszIzkp1acPtJfM8fgYiN1k5YNcC'),
(3, 'manthan munjani', 'munjanimanthan02@gmail.co', '$2y$10$OpEva33AJV7L2PKn66Q48eAC0ZGSzQfziMQMw2n0YPT5wNffIbsYy'),
(4, 'manthan munjani', 'munjanimanthan02@gmail.co', 'm.m.k.306'),
(5, 'manthan munjani', 'munjanimanthan02@gmail.co', 'm.m.k.306'),
(6, 'manthan munjani', 'man1409@gmail.com', 'm.m.k.0107'),
(7, 'manthan munjani', 'munjanimanthan02@gmail.co', '$2y$10$BfxsQt4eU1gkG0723AvDN.fl.blyTcrKnEkEcZgCpw0Vkll2d5MT.'),
(8, 'manthan munjani', 'munjanimanthan02@gmail.co', '$2y$10$GNKVIWW3yA7u8/FZv21u8udt/vfolcyxCRC9fFTz5AL4NdZ03Jtwi'),
(9, 'manthan munjani', 'munjanimanthan02@gmail.co', '$2y$10$k/uijBGjB2pEJ4tb3Bb7tei9rTE7rg0JBUX.cSDU6j7gzZY2kjzyC'),
(10, 'manthan munjani', 'munjanimanthan02@gmail.co', '$2y$10$BYAKWMCl9VSpnMkDZnj9dObAXDnN8TY.bRN6ZI9xJWMoAl5Eq8hTu'),
(11, 'manthan munjani', 'munjanimanthan02@gmail.co', '$2y$10$JHTTdXtUCplC52OaSf6JqudzLsRLR5loY8jMyPOTL42miXaZRG7sm'),
(12, 'manthan munjani', 'munjanimanthan02@gmail.co', '$2y$10$VAQtWRuyV.H7Lq0SqZ9NEOeHRuHLNWtdvQBV6fEqhE35O9SWVza.K'),
(13, 'manthan munjani', 'munjanimanthan02@gmail.co', '$2y$10$oV0mtwY4v2B1Un2TBWA.de4gUFR0mB4be5ozHoT6bjnNQD4TNShfW'),
(14, 'manthan munjani', 'munjanimanthan02@gmail.co', '$2y$10$wh0.JyvFKfSyU71PxTE/CuyliAb2uMgIl..ZirJG/HGEB3IoPMrZO'),
(15, 'manthan munjani', 'munjanimanthan02@gmail.com', '$2y$10$5tjwv36UMjRqC2wPVUtkq.4p1n8HCvRNAxYkiioQEamN3UxS4B3..'),
(16, 'manthan munjani', 'mycollage110@gmail.com', '$2y$10$K.yCyk8oXcazFEjTXKoQ9.ocq0Fa2BG03CFIpfL4u2NHvQAQ7ahNW');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `username`, `email`, `password`) VALUES
(1, 'ram', 'ram@gmail', '456'),
(2, 'ram', 'ram@gmail', '456');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(50) NOT NULL,
  `name` varchar(25) NOT NULL,
  `designation` varchar(25) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `experience` int(2) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `designation`, `gender`, `experience`, `image`) VALUES
(3, 'aryan', 'coath', 'Male', 3, 'r1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tee_time`
--

CREATE TABLE `tee_time` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `players` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` int(11) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tee_time`
--

INSERT INTO `tee_time` (`id`, `name`, `players`, `date`, `time`, `email`, `contact`, `message`) VALUES
(1, 'Harshit', 2, '2025-09-07', '16:04:00', 'variya@gmail.com', 98252, 'I have no query or message for you...'),
(2, 'Rahul', 4, '2025-09-07', '16:25:00', 'rahul@gmail.com', 982343, 'Hello From Rahul'),
(3, 'Rahul', 4, '2025-09-07', '16:25:00', 'rahul@gmail.com', 982343, 'Hello From Rahul'),
(4, 'Rahul', 4, '2025-09-07', '16:25:00', 'rahul@gmail.com', 982343, 'Hello From Rahul'),
(5, 'Dhanani', 3, '2000-01-01', '05:34:00', 'rahul@gmail.com', 98252, 'Aleart box is not working so i am checking it '),
(6, 'Dhanani', 3, '2000-01-01', '05:34:00', 'rahul@gmail.com', 98252, 'Aleart box is not working so i am checking it '),
(17, 'Dhanani', 3, '2000-01-01', '05:34:00', 'rahul@gmail.com', 98252, 'Aleart box is not working so i am checking it '),
(19, 'Dhanani', 3, '2000-01-01', '05:34:00', 'rahul@gmail.com', 98252, 'Aleart box is not working so i am checking it '),
(21, 'Manthan Munjani', 3, '2026-02-14', '16:00:00', 'mycollage110@gmail.com', 2147483647, 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `tounament`
--

CREATE TABLE `tounament` (
  `id` int(25) NOT NULL,
  `tname` varchar(25) NOT NULL,
  `oname` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `otherd` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tounament`
--

INSERT INTO `tounament` (`id`, `tname`, `oname`, `date`, `location`, `email`, `otherd`) VALUES
(2, 'bca club', 'rahul dhanani', '2025-09-23', 'surat', 'rahuldhanani2121@gmail.co', 'AAAAA'),
(6, 'manthan', 'mahakal', '2026-02-08', 'amroli', 'munjanimanthan02@gmail.co', 'good one');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coaching`
--
ALTER TABLE `coaching`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tee_time`
--
ALTER TABLE `tee_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tounament`
--
ALTER TABLE `tounament`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coaching`
--
ALTER TABLE `coaching`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tee_time`
--
ALTER TABLE `tee_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tounament`
--
ALTER TABLE `tounament`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
