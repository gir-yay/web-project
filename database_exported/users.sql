-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 09:25 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE `entreprise` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `ca` int(11) DEFAULT NULL,
  `email` char(255) NOT NULL,
  `password` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entreprise`
--

INSERT INTO `entreprise` (`id`, `Name`, `logo`, `ca`, `email`, `password`) VALUES
(11, 'xila3ba', 'java-program-for-tower-of-hanoi-problem-2.png', 26000, 'ezzouak2001@gmail.com', 'HEY'),
(12, 'lmao', 'WhatsApp Image 2023-03-11 at 17.07.06.jpeg', 2999999, 'ezzouak2001@gmail.coma', 'HEY');

-- --------------------------------------------------------

--
-- Table structure for table `influencer`
--

CREATE TABLE `influencer` (
  `id` int(6) UNSIGNED NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `age` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `influencer`
--

INSERT INTO `influencer` (`id`, `lastname`, `firstname`, `email`, `password`, `age`) VALUES
(6, 'Mo', 'LASTNAME', 'ezzouak2001@gmail.com', 'HEY', 26);

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_influencer` int(6) NOT NULL,
  `id_entreprise` int(6) NOT NULL,
  `terms` text NOT NULL,
  `amount` tinytext NOT NULL,
  `duration` text NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `id_influencer`, `id_entreprise`, `terms`, `amount`, `duration`, `reg_date`, `state`) VALUES
(2, 6, 11, 'ONE INSTA POST PAIR DAY', '29881 MAD', '30 MOIS', '2023-04-18 02:31:53', 'accepted'),
(3, 6, 11, 'GFFGJJY', '200000', '3 MOIS', '2023-04-18 16:21:23', 'refused'),
(4, 6, 12, 'GFFGJJY', '29881 MAD', '30 MOIS', '2023-04-18 16:42:37', 'waiting'),
(5, 6, 12, 'KAHAH', '2300 MAD', '30 MOIS', '2023-04-18 16:43:50', 'waiting'),
(6, 12, 6, 'ONE INSTA POST PAIR DAY', '2300 MAD', '2MOIS', '2023-04-18 16:44:37', 'waiting');

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE `suggestion` (
  `id` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL,
  `id_influencer` int(11) NOT NULL,
  `terms` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`id`, `id_entreprise`, `id_influencer`, `terms`, `amount`, `duration`, `state`) VALUES
(1, 11, 6, 'ONE INSTA POST PAIR DAY', 29881, 2, 'accepted'),
(2, 11, 6, 'ONE INSTA POST PAIR DAY', 2245678, 30, 'refused'),
(3, 12, 6, 'GFFGJJY', 29881, 2, 'waiting');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `influencer`
--
ALTER TABLE `influencer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `influencer`
--
ALTER TABLE `influencer`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
