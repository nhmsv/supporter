-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2018 at 12:25 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dscdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_preferences`
--

CREATE TABLE `tb_preferences` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `lang` varchar(10) DEFAULT 'Arabic',
  `reply_start` int(11) DEFAULT NULL,
  `reply_end` int(11) DEFAULT NULL,
  `reply_start_eng` int(11) DEFAULT NULL,
  `reply_end_eng` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_preferences`
--

INSERT INTO `tb_preferences` (`id`, `uid`, `lang`, `reply_start`, `reply_end`, `reply_start_eng`, `reply_end_eng`) VALUES
(1, 26, 'Arabic', 1, 3, 13, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_preferences`
--
ALTER TABLE `tb_preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_preferences`
--
ALTER TABLE `tb_preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_preferences`
--
ALTER TABLE `tb_preferences`
  ADD CONSTRAINT `tb_preferences_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
