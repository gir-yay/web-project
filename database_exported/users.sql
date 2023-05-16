-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 16 mai 2023 à 16:24
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
(13, 2, 'entreprise', 'entreprise', 'bonjour admin', '2023-05-16 10:46:45', 1),
(14, 10, 'influenceur', 'influenceur', 'Objet : Demande de soutien technique\r\n\r\nCher(e) administrateur/administratrice,\r\n\r\nJ&#039;espère que ce message vous trouve bien. Je me permets de vous contacter aujourd&#039;hui pour solliciter votre aide et votre expertise en tant qu&#039;administrateur/administratrice du site [nom du site].\r\n\r\nJe rencontre actuellement un problème technique sur le site et je suis dans l&#039;incapacité de le résoudre par moi-même. J&#039;ai remarqué que certaines fonctionnalités ne semblent pas fonctionner correctement, ce qui rend difficile la navigation et l&#039;utilisation du site.\r\n\r\nJe vous serais reconnaissant(e) si vous pouviez examiner cette situation et m&#039;apporter votre soutien pour résoudre ces problèmes techniques. Voici une liste des problèmes que j&#039;ai identifiés jusqu&#039;à présent :\r\n\r\n[Décrivez le premier problème de manière concise]\r\n[Décrivez le deuxième problème de manière concise]\r\n[Décrivez le troisième problème de manière concise]\r\nSi vous avez besoin de plus d&#039;informations ou de captures d&#039;écran pour mieux comprendre les problèmes que je rencontre, je serai ravi(e) de vous les fournir.\r\n\r\nJe comprends que vous êtes probablement très occupé(e), mais j&#039;apprécierais énormément si vous pouviez accorder un peu de votre temps pour m&#039;aider à résoudre ces problèmes. Votre soutien serait d&#039;une grande valeur pour moi, car je tiens énormément à utiliser pleinement les fonctionnalités offertes par votre site.\r\n\r\nJe vous remercie sincèrement pour votre attention et votre diligence. J&#039;attends avec impatience votre réponse et votre assistance.\r\n\r\nCordialement,\r\n[Votre nom]', '2023-05-16 13:39:53', 1),
(17, 10, 'influenceur', 'admin', 'Objet : Réponse à votre demande de soutien technique\r\n\r\nCher(e) [Votre nom],\r\n\r\nMerci d&#039;avoir pris le temps de nous contacter et de nous faire part de vos problèmes techniques sur notre site [nom du site]. Nous comprenons l&#039;importance de pouvoir utiliser pleinement nos fonctionnalités, et nous sommes désolés pour les désagréments que cela a pu causer.\r\n\r\nNous avons bien pris note des problèmes que vous avez mentionnés, et nous allons immédiatement les examiner afin de les résoudre. Notre équipe technique est en train d&#039;analyser les causes de ces dysfonctionnements et de trouver des solutions appropriées.\r\n\r\nPour nous aider à résoudre plus rapidement ces problèmes, pourriez-vous nous fournir davantage de détails ou des captures d&#039;écran pour illustrer les erreurs rencontrées ? Cela nous permettra d&#039;avoir une meilleure compréhension du contexte et d&#039;identifier plus précisément les sources des problèmes.\r\n\r\nNous comprenons que vous attendez une résolution rapide, et nous mettons tout en œuvre pour y parvenir dans les plus brefs délais. Nous vous tiendrons informé(e) de l&#039;avancement de nos investigations et de la mise en place des solutions.\r\n\r\nEncore une fois, nous vous présentons nos excuses pour les désagréments que cela a pu causer. Votre satisfaction est notre priorité, et nous mettons tout en œuvre pour que vous puissiez bénéficier pleinement de notre site.\r\n\r\nSi vous avez d&#039;autres questions ou des problèmes supplémentaires à signaler, n&#039;hésitez pas à nous contacter à tout moment. Nous sommes là pour vous aider.\r\n\r\nCordialement,\r\n[L&#039;administrateur/administratrice du site]', '2023-05-16 13:44:49', 1),
(21, 10, 'influenceur', 'admin', 'merci\r\n', '2023-05-16 13:48:24', 1),
(22, 14, 'influenceur', 'influenceur', 'bonjour admin;', '2023-05-16 14:06:12', 1),
(23, 14, 'influenceur', 'admin', 'comment puis  je vous aider?', '2023-05-16 14:30:17', 1),
(24, 15, 'influenceur', 'influenceur', 'bonjour monsieur l&#039;admin', '2023-05-16 16:11:45', 1),
(25, 15, 'influenceur', 'admin', 'bonjour, comment puis je  vous aider?', '2023-05-16 16:19:05', 1);

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
(6, 'sports', '0877766699', 'sports@gmail.com', 'sports.png', 'http://google.com', 8887774.00, 'Sport', '150a8af76a92892f269dead204d533cbfad5cd7f'),
(11, 'arty', '0789659968', 'arty@gmail.com', 'proxy_form.png', 'http://google.com', 900000.00, 'Art', '6dac586af892ccc5a72dcf2a6b010fc4f15e0489');

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
(11, 'manel', 'manel', 23, '066666', 'manel@gmail.com', 'http://instagram.com', 'http://www.facebook.com', 'http://www.youtube.com', 'Sport', '60k-90k', 'ed4ca94954ef9cc771b604988a6a496d5d3935f8', 'windows.jpg'),
(15, 'helen', 'helena', 23, '05622321221', 'helena@gmail.com', 'http://instagram.com', 'http://www.facebook.com', 'http://www.youtube.com', 'Art', '60k-90k', 'c7a336a5db5f461a6ff58aa4175516a17ec0d018', 'girl.jfif');

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
(25, 2, 10, 'La collaboration est une composante essentielle du succès dans de nombreux domaines, que ce soit dans le milieu professionnel, éducatif ou artistique. En travaillant ensemble, les individus peuvent combiner leurs compétences, leurs idées et leurs ressources pour atteindre des objectifs communs. La collaboration favorise la créativité, la résolution de problèmes et la prise de décisions éclairées. Elle permet également de renforcer les relations interpersonnelles, d&#039;encourager le partage des connaissances et de promouvoir un environnement de travail harmonieux et productif.  Dans un monde de plus en plus connecté, la collaboration prend une dimension nouvelle grâce aux technologies de communication et de partage de fichiers en ligne. Les équipes peuvent collaborer', 'inf', '2023-05-16 11:26:38', 1),
(26, 2, 10, 'hhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'inf', '2023-05-16 11:35:41', 1),
(27, 2, 10, 'Cher(e) [Nom de la marque de fashion],\r\n\r\nEn tant qu&#039;influenceur spécialisé dans le domaine du sport et de la condition physique, j&#039;apprécie grandement votre marque et son esthétique unique. Votre style moderne et tendance me correspond parfaitement, et je pense que notre collaboration pourrait être bénéfique pour nous deux.\r\n\r\nJ&#039;aimerais vous proposer une collaboration où je mettrais en avant vos produits de mode sportive sur mes plateformes de médias sociaux. Avec ma communauté d&#039;adeptes passionnés de sport et de mode, je pourrais créer du contenu attrayant et engageant mettant en valeur vos vêtements, chaussures et accessoires.\r\n\r\nVoici quelques idées de collaboration que nous pourrions envisager :\r\n\r\nPublications sponsorisées sur les réseaux sociaux : Je pourrais créer du contenu de haute qualité mettant en scène vos produits de manière créative et authentique. Des photos, des vidéos ou même des tutoriels d&#039;entraînement en portant vos vêtements pourraient être réalisés et partagés avec ma communauté.\r\n\r\nArticles de blog ou de site Web : Je pourrais rédiger des articles dédiés à vos produits de mode sportive sur mon blog ou mon site Web. Ces articles pourraient inclure des revues, des conseils de style et des recommandations pour différents types d&#039;activités sportives.\r\n\r\nÉvénements et collaborations spéciales : Nous pourrions organiser des événements en ligne ou hors ligne, tels que des séances de photos, des défilés de mode ou des séances d&#039;entraînement, où vos produits seraient mis en valeur. Ces événements pourraient être partagés en direct sur les réseaux sociaux pour toucher un public plus large.\r\n\r\nCodes promotionnels et partenariats d&#039;affiliation : Je pourrais vous aider à promouvoir vos produits en offrant à ma communauté des codes promotionnels exclusifs ou en établissant des partenariats d&#039;affiliation, ce qui permettrait à mes adeptes d&#039;obtenir des remises spéciales tout en générant des ventes pour votre marque.\r\n\r\nJe suis ouvert(e) à discuter davantage de ces idées de collaboration et à en explorer de nouvelles. Je suis convaincu(e) que notre association serait bénéfique pour nos deux marques et qu&#039;elle permettrait de toucher un public plus large, combinant le monde du sport et de la mode.\r\n\r\nJ&#039;attends avec impatience votre réponse et l&#039;opportunité de travailler ensemble. Merci pour votre considération.\r\n\r\nCordialement,\r\n[Votre nom d&#039;influenceur]', 'inf', '2023-05-16 11:40:21', 1),
(28, 2, 10, 'hhhh hhhh hhhh hhhhh hhhhh hhhhh hhhhh hhhhh hhhhh hhhhhh hhhhh hhhhhh hhhhh hhhh hhhhh bhhhh bhhhhhh hhhhh hh\r\njjjjjj jjjjjjjjjjjjj jjjjjjjjjjjjjjjjjjjjj jjjjjjjjjjjjjjjjjjjj jjjjjjjjjjjjjjjjjj jjjjjjjjjjjjjjjjjjjjjjj  jjjjjjjjjjjjjjjjjjjjjjjjjjj jjjjjjjjjjjjjjjjjjjjjjjjjj         jjjjjjjjjjjjjjjjjj      nnnnnnnnnnnnnnnnn        nnnnnnnnnnnnn nnnnnnnnnnnnn          nnnnnnnnnnnn\r\nmmmmmmmmmmm pppppppppp jjjjjjjj jjjjjjjjjj jjjjjjjjjj jjjjjjjjjjj jjjjjjjjjjjjj jjjjjjjjjjjjjjjj jjjjjjjjjj\r\n', 'inf', '2023-05-16 11:46:46', 1),
(32, 15, 11, 'Cher Arty,\r\n\r\nJe me permets de vous contacter en tant qu&#039;artiste passionné et créatif, intéressé par une collaboration avec votre entreprise renommée. Permettez-moi de me présenter : je suis Helena, un artiste visuel.\r\n\r\nJ&#039;ai suivi avec grand intérêt les projets et les réalisations inspirantes de votre entreprise dans le domaine de l&#039;art contemporain. Votre engagement à promouvoir des artistes talentueux et à créer des expériences artistiques uniques a particulièrement attiré mon attention.\r\n\r\nEn explorant votre site web et en découvrant vos précédentes collaborations avec des artistes, j&#039;ai été inspiré à proposer une collaboration artistique qui pourrait être mutuellement bénéfique pour nous. Je crois que ma vision artistique et mon style pourraient apporter une dimension artistique intéressante à votre entreprise.\r\n\r\nMon idée de collaboration serait de créer une série d&#039;œuvres d&#039;art originales qui s&#039;inspirent de votre entreprise et de ses valeurs. Ces œuvres pourraient être exposées dans vos espaces d&#039;exposition, ce qui permettrait de créer une expérience immersive pour les visiteurs tout en renforçant votre identité artistique.\r\n\r\nJe serais ravi de discuter davantage de cette idée avec vous, ainsi que de toute autre opportunité de collaboration que vous pourriez envisager. Je suis ouvert à explorer différentes formes de partenariats, qu&#039;il s&#039;agisse de projets à court terme ou de collaborations à plus long terme.\r\n\r\nJe vous invite à consulter mon portfolio en ligne à l&#039;adresse suivante : [Insérez le lien vers votre portfolio] pour découvrir mon travail et avoir un aperçu de mon style artistique.\r\n\r\nJe suis convaincu que notre collaboration pourrait être fructueuse et enrichissante, et j&#039;espère avoir l&#039;occasion d&#039;en discuter plus en détail. Je suis disponible pour une réunion ou un appel téléphonique à votre convenance.\r\n\r\nJe vous remercie de prendre le temps de considérer ma proposition de collaboration et je reste dans l&#039;attente de votre réponse.\r\n\r\nCordialement,\r\n\r\nHelena', 'ent', '2023-05-16 15:10:58', 1),
(33, 11, 15, 'Cher Helena,\r\n\r\nNous vous remercions d&#039;avoir pris contact avec nous et pour l&#039;intérêt que vous portez à notre entreprise d&#039;art. Nous avons examiné attentivement votre proposition de collaboration artistique et nous apprécions votre vision créative ainsi que votre portfolio en ligne, qui démontre votre talent artistique.\r\n\r\nVotre idée de créer une série d&#039;œuvres d&#039;art originales inspirées de notre entreprise et de nos valeurs nous intéresse vivement. Nous pensons que cette collaboration pourrait offrir une expérience artistique unique à nos visiteurs et renforcer notre identité artistique. Nous sommes enthousiasmés par la possibilité d&#039;explorer davantage cette idée avec vous.\r\n\r\nAvant de poursuivre, nous aimerions organiser une réunion pour discuter plus en détail des aspects pratiques et logistiques de cette collaboration. Nous aimerions également en savoir plus sur votre processus créatif et discuter des détails tels que les délais, les ressources nécessaires et les attentes mutuelles.\r\n\r\nPourriez-vous nous faire savoir vos disponibilités pour une réunion ou un appel téléphonique afin que nous puissions fixer une date qui convienne à tous ? Nous sommes impatients de discuter plus amplement de cette collaboration et d&#039;explorer les opportunités de travail ensemble.\r\n\r\nEncore une fois, nous vous remercions de votre proposition et de l&#039;intérêt que vous portez à notre entreprise. Nous sommes impatients de prendre part à cette collaboration artistique avec vous.\r\n\r\nCordialement,\r\n\r\nArty', 'inf', '2023-05-16 15:14:25', 0);

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
(4, 9, 5, 'utiliser nos produits dans votre videos', '200Dh', '5mois', '2023-05-16 14:17:02', 'refused'),
(5, 14, 10, 'utiliser nos produits dans votre art', '500Dh', '15jours', '2023-05-16 12:25:58', 'refused'),
(6, 9, 11, 'utiliser nos produits dans votre arts', '500Dh', '1mois', '2023-05-16 14:17:06', 'accepted');

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
(1, 9, 'entreprise', 'deleted');

-- --------------------------------------------------------

--
-- Structure de la table `suggestion`
--

CREATE TABLE `suggestion` (
  `id` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL,
  `id_influencer` int(11) NOT NULL,
  `terms` text NOT NULL,
  `amount` tinytext NOT NULL,
  `duration` text NOT NULL,
  `state` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `suggestion`
--

INSERT INTO `suggestion` (`id`, `id_entreprise`, `id_influencer`, `terms`, `amount`, `duration`, `state`, `reg_date`) VALUES
(3, 2, 11, 'des vidéos sponsorisées', '500Dh', '3mois', 'accepted', '2023-05-16 09:28:04'),
(4, 6, 8, 'faire de la publicités pour vos produits', '2000Dh', '1an', 'waiting', '2023-05-16 11:20:14'),
(5, 10, 14, 'utiliser vos produits dans mes arts', '1000dh', '1mois', 'accepted', '2023-05-16 12:26:42'),
(6, 11, 15, 'utiliser vos produits dans mes arts', '500Dh', '1mois', 'accepted', '2023-05-16 14:12:14');

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
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `influencer`
--
ALTER TABLE `influencer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
