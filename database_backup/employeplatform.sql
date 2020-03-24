-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2019 at 05:01 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employeplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `employe_data`
--

CREATE TABLE `employe_data` (
  `em_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employe_data`
--

INSERT INTO `employe_data` (`em_id`, `name`, `email`, `phone`) VALUES
(1, 'Mahfuzur Rahman', 'mahfuzur@gmail.com', '123456789'),
(2, 'Irfan Chowdhury', 'irfan@gmail.com', '0123456789'),
(3, 'Raysul Kabir', 'raysul@gmail.com', '01234567890'),
(7, 'Sajib Chakborty', 'sajib@gmail.com', '0123456789'),
(10, 'Raj', '', ''),
(11, 'Tommy', '', ''),
(12, '\'); DROP DATABASE employeplatform;', 'faisal.hamid.hemel.1992@gmail.com', '1715234605');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employe_data`
--
ALTER TABLE `employe_data`
  ADD PRIMARY KEY (`em_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employe_data`
--
ALTER TABLE `employe_data`
  MODIFY `em_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
