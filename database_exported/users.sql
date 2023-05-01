-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 30 avr. 2023 à 15:21
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `users`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
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
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `Name`, `logo`, `ca`, `email`, `password`) VALUES
(14, 'PROJET CP', 'aa.jpg', 2022023, 'lma@gmail.com', 'HEY'),
(15, 'gushi', 'panda.jfif', 4515121, 'gushi@gmail.com', 'gushi');

-- --------------------------------------------------------

--
-- Structure de la table `influencer`
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
-- Déchargement des données de la table `influencer`
--

INSERT INTO `influencer` (`id`, `lastname`, `firstname`, `email`, `password`, `age`) VALUES
(6, 'Mo', 'LASTNAME', 'ezzouak2001@gmail.com', 'HEY', 26),
(7, 'Ra', 'Gigg', 'ghi@gmail.com', '555', 20);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `message`, `type`, `timestamp`) VALUES
(1, 11, 6, 'hey', 'ent', '2023-04-25 20:06:50'),
(2, 11, 6, 'hello', 'ent', '2023-04-25 20:06:56'),
(3, 14, 6, 'HEELLO MR ', 'ent', '2023-04-27 22:00:06'),
(4, 14, 6, 'HOW ARE U \r\n', 'ent', '2023-04-27 22:00:12'),
(5, 6, 14, 'HELLO FUCKER \r\n', 'inf', '2023-04-27 22:01:15'),
(6, 14, 6, 'ACCEPT PLZ\r\n', 'ent', '2023-04-27 22:03:06'),
(7, 14, 6, 'mom help\r\n', 'ent', '2023-04-28 09:51:21'),
(9, 6, 14, 'hhhh working ', 'inf', '2023-04-29 23:56:34'),
(10, 6, 14, '', 'inf', '2023-04-29 23:56:35');

-- --------------------------------------------------------

--
-- Structure de la table `offer`
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
-- Déchargement des données de la table `offer`
--

INSERT INTO `offer` (`id`, `id_influencer`, `id_entreprise`, `terms`, `amount`, `duration`, `reg_date`, `state`) VALUES
(6, 12, 6, 'ONE INSTA POST PAIR DAY', '2300 MAD', '2MOIS', '2023-04-18 16:44:37', 'waiting'),
(9, 6, 14, 'LMAO', '87777', '30 MONTH', '2023-04-28 16:19:36', 'accepted'),
(11, 6, 14, 'hello 2 insta pic per day', '6942022', '69 day', '2023-04-29 18:06:34', 'accepted');

-- --------------------------------------------------------

--
-- Structure de la table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `request`
--

INSERT INTO `request` (`id`, `user_id`, `type`, `state`) VALUES
(6, 11, 'entreprise', 'deleted'),
(7, 13, 'entreprise', 'deleted'),
(8, 12, 'entreprise', 'deleted'),
(9, 14, 'entreprise', 'pending'),
(10, 14, 'entreprise', 'pending'),
(11, 6, 'influencer', 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `suggestion`
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
-- Déchargement des données de la table `suggestion`
--

INSERT INTO `suggestion` (`id`, `id_entreprise`, `id_influencer`, `terms`, `amount`, `duration`, `state`, `reg_date`) VALUES
(1, 11, 6, 'ONE INSTA POST PAIR DAY', 29881, 2, 'accepted', '2023-04-26 22:04:19'),
(2, 11, 6, 'ONE INSTA POST PAIR DAY', 2245678, 30, 'refused', '2023-04-26 22:04:19'),
(4, 11, 6, 'LMAO', 87777, 30, 'refused', '2023-04-26 22:06:47'),
(5, 14, 6, 'This is a suggestion', 69420, 29, 'accepted', '2023-04-27 21:03:43');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Index pour la table `influencer`
--
ALTER TABLE `influencer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `influencer`
--
ALTER TABLE `influencer`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
