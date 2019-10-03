-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2018 at 11:26 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(15) NOT NULL,
  `a_from` int(15) NOT NULL,
  `a_to` int(15) NOT NULL,
  `a_time` varchar(15) NOT NULL,
  `status` int(1) NOT NULL,
  `request_on` varchar(20) NOT NULL,
  `m_history` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `a_from`, `a_to`, `a_time`, `status`, `request_on`, `m_history`) VALUES
(1, 1, 3, '1522725990', 1, '5-4-18', 'uploads/Chrysanthemum.jpg'),
(2, 4, 3, '1522729600', 0, '5-4-18', 'uploads/Desert.jpg'),
(3, 4, 7, '1522742620', 1, '6-4-18', 'uploads/Penguins.jpg'),
(4, 9, 8, '1522743647', 1, '12-1-2019', 'uploads/Hydrangeas.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(15) NOT NULL,
  `p_id` int(15) NOT NULL,
  `doc_id` int(15) NOT NULL,
  `m_to` int(15) NOT NULL,
  `message` text NOT NULL,
  `sent_at` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `p_id`, `doc_id`, `m_to`, `message`, `sent_at`) VALUES
(1, 5, 1, 3, 'your medicine is ready', '1522744267'),
(2, 5, 4, 7, 'your medicine is ready', '1522744426');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE IF NOT EXISTS `prescriptions` (
  `id` int(15) NOT NULL,
  `pharmacy` int(15) NOT NULL,
  `prescription` text NOT NULL,
  `doc_id` int(15) NOT NULL,
  `pat_id` int(15) NOT NULL,
  `file` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `pharmacy`, `prescription`, `doc_id`, `pat_id`, `file`) VALUES
(1, 5, '', 1, 3, 'uploads/prescriptions/image-1.jpeg'),
(2, 5, '', 4, 7, 'uploads/prescriptions/Tulips.jpg'),
(3, 5, '', 9, 8, 'uploads/prescriptions/Penguins.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(15) NOT NULL,
  `registerAs` varchar(10) NOT NULL,
  `i_am` varchar(50) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(25) NOT NULL,
  `mobile` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `registerAs`, `i_am`, `pname`, `name`, `address`, `city`, `gender`, `email`, `password`, `mobile`) VALUES
(1, 'doctor', 'cardiologist', '', 'dbkr', 'dbkr@gmail.com', 'hyderabad', 'male', 'dbkr@gmail.com', '123456', '9866163987'),
(2, 'patient', '', '', 'siva  charan', 'vidhyaanagar', 'hyderabad', 'male', 'sivacharan.3987@gmail.com', '123456', '9866163987'),
(3, 'patient', '', '', 'sivaa charaan', 'vidhyaanagar', 'hyderabad', 'male', 'sivacharan.39872@gmail.com', '123456', '9866163987'),
(4, 'doctor', 'orthopedician', '', 'mdv', 'raayachur', 'hyderabad', 'male', 'mdv@gmail.com', '123456', '9866163987'),
(5, 'pharmacy', '', 'apollo', 'apollo charan', 'vidhyaanagar', 'hyderabad', 'male', 'sivacharan.pharmacy@gmail.com', '123456', '9876543210'),
(6, 'pharmacy', '', 'midicity', 'charan', 'vidyanagar', 'hyderabad', 'male', 'charan@gmail.com', '123456', '9866163987'),
(7, 'patient', '', '', 'booom', 'vidyanagar', 'hyderabad', 'male', 'boom@gmail.com', '123456', '9866163987'),
(8, 'patient', '', '', 'anwesh', 'kachiguda', 'hyderabad', 'male', 'anvesh@gmail.com', '123456', '9966996699'),
(9, 'doctor', 'dentist', '', 'sai', 'adarsh nagar', 'hyderabad', 'male', 'sai@gmail.com', '1234567', '9966996699');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_from` (`a_from`),
  ADD KEY `a_to` (`a_to`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
