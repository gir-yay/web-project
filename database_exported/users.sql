-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 16 mai 2023 à 12:57
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

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
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Structure de la table `admin_messages`
--

CREATE TABLE `admin_messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `sender_type` varchar(255) NOT NULL,
  `message_text` longtext NOT NULL,
  `time_stamp` datetime NOT NULL,
  `read_` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin_messages`
--

INSERT INTO `admin_messages` (`message_id`, `user_id`, `user_type`, `sender_type`, `message_text`, `time_stamp`, `read_`) VALUES
(10, 4, 'entreprise', 'entreprise', 'hello admin', '2023-05-15 17:56:21', 1),
(11, 4, 'entreprise', 'admin', 'hi kiko entreprise', '2023-05-15 17:57:39', 1),
(12, 5, 'entreprise', 'entreprise', 'bonjour M.Admin', '2023-05-16 10:26:37', 1),
(13, 2, 'entreprise', 'entreprise', 'bonjour admin', '2023-05-16 10:46:45', 1);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
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
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nom`, `telephone`, `email`, `logo`, `site`, `ca`, `domaine`, `password`) VALUES
(2, 'gushi', '066666***', 'gushi@gmail.com', 'hh.jpeg', 'www.google.com', 5000.00, 'Fashion', '1fbfbe3f88f29ffdf50e2caaacfa5d4857b1af64'),
(4, 'KIKO', '0655885577', 'kiko@gmail.com', 'kiko.jpg', 'http://google.com', 6890000.00, 'autre', '3b55b765725f874ac5421250a71175623ee325f9'),
(5, 'shein', '05622321221', 'shein@gmail.com', 'Shein-logo.png', 'http://google.com', 900000.00, 'Fashion', '3327e7b8309c8f91833261d8ebea5d6f37a0b725'),
(6, 'sports', '0877766699', 'sports@gmail.com', 'sports.png', 'http://google.com', 8887774.00, 'Sport', '150a8af76a92892f269dead204d533cbfad5cd7f');

-- --------------------------------------------------------

--
-- Structure de la table `influencer`
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
-- Déchargement des données de la table `influencer`
--

INSERT INTO `influencer` (`id`, `nom`, `prenom`, `age`, `telephone`, `email`, `insta`, `fcbk`, `youtube`, `domaine`, `abonne`, `password`, `pfp`) VALUES
(8, 'Yazan', 'Outhman', 23, '0789659968', 'outhman@gmail.com', 'http://instagram.com', 'http://www.facebook.com', 'http://www.youtube.com', 'Sport', '60k-90k', 'd94ed771bcecb16e12dc1fd0292358020368b22b', 'influenceur2.png'),
(9, 'Jad', 'Mounia', 22, '0688958874', 'mounia.jad@gmail.com', 'http://instagram.com', 'http://www.facebook.com', 'http://www.youtube.com', 'Art', '30k-60k', '14a13b18d164b9fd46181cfc744cda679c942f9a', 'inluenceur1.jpg'),
(10, 'ghizlane', 'ra', 20, '0666667777', 'ghi@gmail.com', 'http://instagram.com', 'http://www.facebook.com', 'http://www.youtube.com', 'Fashion', '90k-150k', 'cfa1150f1787186742a9a884b73a43d8cf219f9b', 'panda.jfif'),
(11, 'manel', 'manel', 23, '066666', 'manel@gmail.com', 'http://instagram.com', 'http://www.facebook.com', 'http://www.youtube.com', 'Sport', '60k-90k', 'ed4ca94954ef9cc771b604988a6a496d5d3935f8', 'windows.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `receiver_type` varchar(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`message_id`, `sender`, `receiver`, `message`, `receiver_type`, `time_stamp`, `read_`) VALUES
(17, 2, 10, 'bonjour', 'inf', '2023-05-16 10:50:42', 1),
(18, 10, 2, 'gg', 'ent', '2023-05-16 10:51:09', 1),
(19, 2, 10, 'hh', 'inf', '2023-05-16 10:51:50', 1),
(20, 2, 10, 'hhhhh', 'inf', '2023-05-16 11:14:39', 1),
(21, 10, 2, 'hhheeello', 'ent', '2023-05-16 11:15:17', 1),
(22, 2, 10, 'Bien sûr ! Je suis prêt à collaborer avec vous. Pouvez-vous me donner plus de détails sur le type de collaboration que vous recherchez ? Que souhaitez-vous réaliser ensemble ?', 'inf', '2023-05-16 11:16:45', 1),
(23, 2, 10, 'j&#039;ess', 'inf', '2023-05-16 11:18:15', 1),
(24, 10, 2, 'La collaboration est une composante essentielle du succès dans de nombreux domaines, que ce soit dans le milieu professionnel, éducatif ou artistique. En travaillant ensemble, les individus peuvent combiner leurs compétences, leurs idées et leurs ressources pour atteindre des objectifs communs. La collaboration favorise la créativité, la résolution de problèmes et la prise de décisions éclairées. Elle permet également de renforcer les relations interpersonnelles, d&#039;encourager le partage des connaissances et de promouvoir un environnement de travail harmonieux et productif.\r\n\r\nDans un monde de plus en plus connecté, la collaboration prend une dimension nouvelle grâce aux technologies de communication et de partage de fichiers en ligne. Les équipes peuvent collaborer', 'ent', '2023-05-16 11:22:04', 1),
(25, 2, 10, 'La collaboration est une composante essentielle du succès dans de nombreux domaines, que ce soit dans le milieu professionnel, éducatif ou artistique. En travaillant ensemble, les individus peuvent combiner leurs compétences, leurs idées et leurs ressources pour atteindre des objectifs communs. La collaboration favorise la créativité, la résolution de problèmes et la prise de décisions éclairées. Elle permet également de renforcer les relations interpersonnelles, d&#039;encourager le partage des connaissances et de promouvoir un environnement de travail harmonieux et productif.  Dans un monde de plus en plus connecté, la collaboration prend une dimension nouvelle grâce aux technologies de communication et de partage de fichiers en ligne. Les équipes peuvent collaborer', 'inf', '2023-05-16 11:26:38', 0),
(26, 2, 10, 'hhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'inf', '2023-05-16 11:35:41', 0),
(27, 2, 10, 'Cher(e) [Nom de la marque de fashion],\r\n\r\nEn tant qu&#039;influenceur spécialisé dans le domaine du sport et de la condition physique, j&#039;apprécie grandement votre marque et son esthétique unique. Votre style moderne et tendance me correspond parfaitement, et je pense que notre collaboration pourrait être bénéfique pour nous deux.\r\n\r\nJ&#039;aimerais vous proposer une collaboration où je mettrais en avant vos produits de mode sportive sur mes plateformes de médias sociaux. Avec ma communauté d&#039;adeptes passionnés de sport et de mode, je pourrais créer du contenu attrayant et engageant mettant en valeur vos vêtements, chaussures et accessoires.\r\n\r\nVoici quelques idées de collaboration que nous pourrions envisager :\r\n\r\nPublications sponsorisées sur les réseaux sociaux : Je pourrais créer du contenu de haute qualité mettant en scène vos produits de manière créative et authentique. Des photos, des vidéos ou même des tutoriels d&#039;entraînement en portant vos vêtements pourraient être réalisés et partagés avec ma communauté.\r\n\r\nArticles de blog ou de site Web : Je pourrais rédiger des articles dédiés à vos produits de mode sportive sur mon blog ou mon site Web. Ces articles pourraient inclure des revues, des conseils de style et des recommandations pour différents types d&#039;activités sportives.\r\n\r\nÉvénements et collaborations spéciales : Nous pourrions organiser des événements en ligne ou hors ligne, tels que des séances de photos, des défilés de mode ou des séances d&#039;entraînement, où vos produits seraient mis en valeur. Ces événements pourraient être partagés en direct sur les réseaux sociaux pour toucher un public plus large.\r\n\r\nCodes promotionnels et partenariats d&#039;affiliation : Je pourrais vous aider à promouvoir vos produits en offrant à ma communauté des codes promotionnels exclusifs ou en établissant des partenariats d&#039;affiliation, ce qui permettrait à mes adeptes d&#039;obtenir des remises spéciales tout en générant des ventes pour votre marque.\r\n\r\nJe suis ouvert(e) à discuter davantage de ces idées de collaboration et à en explorer de nouvelles. Je suis convaincu(e) que notre association serait bénéfique pour nos deux marques et qu&#039;elle permettrait de toucher un public plus large, combinant le monde du sport et de la mode.\r\n\r\nJ&#039;attends avec impatience votre réponse et l&#039;opportunité de travailler ensemble. Merci pour votre considération.\r\n\r\nCordialement,\r\n[Votre nom d&#039;influenceur]', 'inf', '2023-05-16 11:40:21', 0),
(28, 2, 10, 'hhhh hhhh hhhh hhhhh hhhhh hhhhh hhhhh hhhhh hhhhh hhhhhh hhhhh hhhhhh hhhhh hhhh hhhhh bhhhh bhhhhhh hhhhh hh\r\njjjjjj jjjjjjjjjjjjj jjjjjjjjjjjjjjjjjjjjj jjjjjjjjjjjjjjjjjjjj jjjjjjjjjjjjjjjjjj jjjjjjjjjjjjjjjjjjjjjjj  jjjjjjjjjjjjjjjjjjjjjjjjjjj jjjjjjjjjjjjjjjjjjjjjjjjjj         jjjjjjjjjjjjjjjjjj      nnnnnnnnnnnnnnnnn        nnnnnnnnnnnnn nnnnnnnnnnnnn          nnnnnnnnnnnn\r\nmmmmmmmmmmm pppppppppp jjjjjjjj jjjjjjjjjj jjjjjjjjjj jjjjjjjjjjj jjjjjjjjjjjjj jjjjjjjjjjjjjjjj jjjjjjjjjj\r\n', 'inf', '2023-05-16 11:46:46', 0);

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
(3, 2, 11, 'des vidéos sponsorisées', 500, 3, 'accepted', '2023-05-16 09:28:04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `admin_messages`
--
ALTER TABLE `admin_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `influencer`
--
ALTER TABLE `influencer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

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
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `admin_messages`
--
ALTER TABLE `admin_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `influencer`
--
ALTER TABLE `influencer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
