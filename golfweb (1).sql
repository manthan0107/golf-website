-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 08:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(7, 'harshit', 'variya@gmail.com', 2147483647, '99', 'male', 'Intermediate', 'Morning', 'hyyyyyyyyyyyyyyyyyy');

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
(4, 'Aaryan', 'romaliya@gmail.com', 'Bayu Veda', 98252, 'Checking aleat box');

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
(5, 'raj', 'raj@gmail.com', 'science', 2147483647, 'Checking Aleartbox ');

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
(1, 'gold', '298', '6 month', 'Screenshot 2024-07-28 092', '20per');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `email`, `password`) VALUES
(1, 'rahul', 'rahul@gmail.com', 123),
(2, 'har', 'harshit@gmail.com', 123),
(3, 'ram', 'ram@gmail', 852);

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
(19, 'Dhanani', 3, '2000-01-01', '05:34:00', 'rahul@gmail.com', 98252, 'Aleart box is not working so i am checking it ');

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
(2, 'bca club', 'rahul dhanani', '2025-09-23', 'surat', 'rahuldhanani2121@gmail.co', 'AAAAA');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `coaching`
--
ALTER TABLE `coaching`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tounament`
--
ALTER TABLE `tounament`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
