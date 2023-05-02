-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 04:02 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lovejoy_customer_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `email`, `password`, `active`, `admin`) VALUES
(0, 'noaccount', '', '', 0, 0),
(1, 'user', 'violet@gmail.com', 'user', 0, 0),
(2, 'admin', 'violet.thn.karlsson@gmail.com', 'admin123', 0, 1),
(3, 'test', 'test@test.com', 'test123', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `timeofday` text DEFAULT NULL,
  `town` text DEFAULT NULL,
  `center` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `mail` text DEFAULT NULL,
  `phone_number` text DEFAULT NULL,
  `ticket_amount` int(11) DEFAULT NULL,
  `UID` int(11) DEFAULT NULL,
  `xmlID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `timeofday`, `town`, `center`, `name`, `mail`, `phone_number`, `ticket_amount`, `UID`, `xmlID`) VALUES
(63, 'Mar. 24, 2023', 'Newcastle Upon Tyne', 'Newcastle University Student Union', 'Violet Karlsson', 'violet.thn.karlsson@gmail.com', '0727061821', 2, 2, 1),
(64, 'Mar. 24, 2023', 'Newcastle Upon Tyne', 'Newcastle University Student Union', 'Violet Karlsson', 'violet.thn.karlsson@gmail.com', '0727061821', 4, 1, 1),
(65, ' Mar. 25, 2023', 'Glasgow', 'SWG3 Poetry Club', 'Violet Karlsson', 'violet.thn.karlsson@gmail.com', '0727061821', 1, 2, 2),
(66, ' Mar. 29, 2023', 'Machester', 'Q2 Ritz Manchester', 'Violet Karlsson', 'violet.thn.karlsson@gmail.com', '0727061821', 3, 2, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id` (`UID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `userID` FOREIGN KEY (`UID`) REFERENCES `accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
