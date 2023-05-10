-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 02:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE Database IF NOT EXISTS `users`;
--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `admin_messages`
--

CREATE TABLE `admin_messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `sender_type` varchar(255) NOT NULL,
  `message_text` text NOT NULL,
  `time_stamp` datetime NOT NULL,
  `read_` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_messages`
--

INSERT INTO `admin_messages` (`message_id`, `user_id`, `user_type`, `sender_type`, `message_text`, `time_stamp`, `read_`) VALUES
(2, 3, 'entreprise', 'entreprise', 'HI i want to delete my account ', '2023-05-03 21:04:26', 1),
(3, 3, 'entreprise', 'admin', 'sure hello i can help send a request using the website and i will delete in 3 days', '2023-05-03 21:05:19', 1),
(4, 3, 'influenceur', 'influenceur', 'hello mr admin', '2023-05-03 21:07:56', 1),
(5, 3, 'influenceur', 'admin', 'hello fucker ', '2023-05-03 21:08:47', 1),
(6, 3, 'entreprise', 'entreprise', 'HELLO', '2023-05-06 18:28:23', 1),
(7, 3, 'entreprise', 'entreprise', 'fucker ', '2023-05-06 18:28:29', 1),
(8, 3, 'influenceur', 'influenceur', 'hello asshole', '2023-05-06 18:29:40', 1),
(9, 3, 'influenceur', 'admin', 'hello asshole', '2023-05-06 18:30:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE `entreprise` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `ca` decimal(20,2) DEFAULT NULL,
  `domaine` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nom`, `telephone`, `email`, `logo`, `site`, `ca`, `domaine`, `password`) VALUES
(2, 'gushi', '066666***', 'gushi@gmail.com', 'hh.jpeg', 'www.google.com', 5000.00, 'Fashion', '1fbfbe3f88f29ffdf50e2caaacfa5d4857b1af64'),
(3, 'pathetic otaku1king', '0602037451', 'swixagang@gmail.com', 'BB.jpg', 'www.google.com', 69420.00, 'Art', 'a880c390a6cf41f70f9a43af2b194442bbe8c615');

-- --------------------------------------------------------

--
-- Table structure for table `influencer`
--

CREATE TABLE `influencer` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `insta` varchar(50) DEFAULT NULL,
  `fcbk` varchar(50) DEFAULT NULL,
  `youtube` varchar(50) DEFAULT NULL,
  `domaine` varchar(50) DEFAULT NULL,
  `abonne` text DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `pfp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `influencer`
--

INSERT INTO `influencer` (`id`, `nom`, `prenom`, `age`, `telephone`, `email`, `insta`, `fcbk`, `youtube`, `domaine`, `abonne`, `password`, `pfp`) VALUES
(2, 'ghizlane', 'ra', 20, '066666', 'ghi@gmail.com', 'www.instagram.com', 'www.facebook.com', '', 'Fashion', '', 'cfa1150f1787186742a9a884b73a43d8cf219f9b', NULL),
(4, 'cop', 'pathetic', 26, '0602037451', 'ezzouak2001@gmail.coma', 'https://www.instagram.com/ezzouakmohamed/', 'https://www.facebook.com/mohamed.c.ezzouak/', 'https://www.youtube.com/channel/UClzjz0b_U42besX_D', 'Sport', '+150k', 'a880c390a6cf41f70f9a43af2b194442bbe8c615', 'BB.jpg'),
(7, 'test', 'test', 26, '0602037451', 'ezzouak2001@gmail.com', 'https://www.instagram.com/ezzouakmohamed/', 'https://www.facebook.com/mohamed.c.ezzouak/', 'https://www.youtube.com/channel/UClzjz0b_U42besX_D', 'Art', '90k-150k', '7f550a9f4c44173a37664d938f1355f0f92a47a7', 'cc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` text NOT NULL,
  `receiver_type` varchar(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender`, `receiver`, `message`, `receiver_type`, `time_stamp`, `read_`) VALUES
(5, 3, 2, 'hey', 'ent', '2023-05-03 17:12:54', 0);

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
(1, 1, 1, 'post a day', '50', '1 month', '2023-05-03 13:38:40', 'accepted'),
(2, 3, 3, 'hello 2 insta pic per day', '6942022', '30 MONTH', '2023-05-06 22:51:34', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `state` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`id`, `id_entreprise`, `id_influencer`, `terms`, `amount`, `duration`, `state`, `reg_date`) VALUES
(1, 1, 1, 'two posts a day', 70, 2, 'waiting', '2023-05-03 13:39:28'),
(2, 2, 3, 'hello 2 insta pic per day', 69420, 30, 'waiting', '2023-05-06 22:49:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_messages`
--
ALTER TABLE `admin_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Indexes for table `influencer`
--
ALTER TABLE `influencer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_messages`
--
ALTER TABLE `admin_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `influencer`
--
ALTER TABLE `influencer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
