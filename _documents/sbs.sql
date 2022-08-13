-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 13 août 2022 à 15:27
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sbs`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(70) NOT NULL,
  `content` longtext NOT NULL,
  `auteur` varchar(70) NOT NULL,
  `status` varchar(70) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `auteur`, `status`, `created_at`, `modified_at`) VALUES
(1, 'article 1', 'rgtdhgthdt', 'moi', 'draft', '2022-08-09 15:40:52', '2022-08-09 17:40:52'),
(4, 'Article 4', '4 -ème article de test pour SBS', 'Wam', 'draft', '2022-08-09 18:12:34', '2022-08-09 20:12:34'),
(6, '1111111111111111', '2222222222222222222222', '111111111111111111111', 'draft', '2022-08-10 11:28:26', '2022-08-10 13:28:26'),
(7, 'article 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius elementum diam, id euismod enim feugiat ullamcorper. Praesent ante ante, placerat et elit vel, suscipit mattis nunc. Sed vehicula sapien luctus turpis pretium egestas. Praesent ut convallis justo. Donec a turpis vitae ex tristique sollicitudin. Nullam a egestas urna. Pellentesque sit amet velit odio. Cras sit amet placerat leo. Aenean dolor mi, dapibus quis nulla id, tristique eleifend mauris. Integer vitae leo orci.', '333333333333333', 'draft', '2022-08-11 21:38:39', '2022-08-11 23:38:39'),
(12, '333333333333333', '333333333333333333333', '333333333333333333', 'draft', '2022-08-10 11:28:51', '2022-08-10 13:28:51'),
(13, '333333333333333', '333333333333333333333', '333333333333333333', 'draft', '2022-08-10 11:28:51', '2022-08-10 13:28:51'),
(14, 'article 2', 'Etiam vehicula justo sapien, nec porttitor nulla interdum ultrices. In sit amet purus augue. Maecenas bibendum odio felis, quis vestibulum eros facilisis sit amet. Aenean fringilla nisi lectus, eu lacinia est volutpat eu. Maecenas eleifend sem ac eros posuere convallis. Quisque convallis, libero interdum euismod accumsan, purus ipsum varius arcu, eget feugiat nisi lorem at massa. Mauris imperdiet eu justo id malesuada.', '333333333333333333', 'draft', '2022-08-11 21:39:05', '2022-08-11 23:39:05'),
(15, 'Les logiciels libres recommandés par l\'État', 'Il existe un catalogue des logiciels libres recommandés par l\'État pour toute l\'administration. C\'est le SILL qui vient de bénéficier d\'une mise à jour.', 'Jérôme G.', 'draft', '2022-08-13 09:37:29', '2022-08-13 11:37:29'),
(16, 'article 3', 'Ut sit amet sapien at massa aliquet luctus nec ac dui. Praesent semper facilisis nisi sit amet tincidunt. Praesent ut elit tempus, vehicula eros nec, vestibulum leo. Proin rutrum lectus id volutpat pretium. Sed luctus diam sollicitudin quam consequat aliquam. Nulla facilisi. Suspendisse hendrerit odio sem, vel tincidunt ligula tempus eget. Aenean ut sapien nec mi pharetra consectetur ac in sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec mattis nec elit nec rhoncus. Phasellus finibus et risus vel porttitor.', '22222222222222222222', 'draft', '2022-08-11 21:39:30', '2022-08-11 23:39:30');

-- --------------------------------------------------------

--
-- Structure de la table `articles_has_categories`
--

CREATE TABLE `articles_has_categories` (
  `articles_id_articles` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles_has_categories`
--

INSERT INTO `articles_has_categories` (`articles_id_articles`, `categories_id`) VALUES
(6, 1),
(6, 8),
(7, 1),
(7, 7),
(7, 8),
(10, 1),
(13, 8),
(14, 1),
(15, 0),
(16, 0);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `id_parent` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `id_parent`) VALUES
(0, 'NUMÉRIQUE', 0),
(1, 'JEUX VIDEO', 0),
(7, 'A.V./PHOTO & CINÉ/SÉRIE/MANGA', 0),
(8, 'MOBILE/TÉLÉCOM & SYSTÈME', 7);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `date_commentaires` datetime DEFAULT current_timestamp(),
  `articles_id_articles` int(11) NOT NULL,
  `utilisateurs_id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `titre`, `description`, `date_commentaires`, `articles_id_articles`, `utilisateurs_id_utilisateur`) VALUES
(3, 'test', 'test de validate', '2022-08-12 13:15:35', 1, 3),
(6, 'aaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaa', '2022-08-12 14:39:29', 6, 1),
(7, 'bbbbbbbbbbbbbbbbb', 'bbbbbbbbbbbbbbbbbbbbb', '2022-08-12 14:39:43', 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id_note` int(11) NOT NULL,
  `note` int(11) DEFAULT NULL,
  `articles_id_articles` int(11) NOT NULL,
  `utilisateurs_id_utilisateurs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id_note`, `note`, `articles_id_articles`, `utilisateurs_id_utilisateurs`) VALUES
(10, 3, 14, 1),
(11, 3, 14, 1),
(12, 3, 14, 1),
(13, 3, 14, 1),
(14, 3, 14, 1),
(15, 3, 14, 1),
(16, 3, 14, 1),
(17, 3, 14, 1),
(18, 3, 14, 1),
(19, 3, 14, 1),
(20, 3, 14, 1),
(21, 3, 14, 1),
(22, 3, 14, 1),
(23, 3, 14, 1),
(24, 3, 14, 1),
(25, 3, 14, 1),
(26, 3, 14, 1),
(27, 3, 14, 1),
(28, 5, 14, 1),
(29, 5, 14, 1),
(30, 3, 14, 1),
(31, 5, 15, 1),
(32, 3, 15, 1),
(33, 3, 15, 1),
(34, 3, 15, 1),
(35, 3, 15, 1);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `titre` varchar(70) NOT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id_roles`, `titre`, `description`) VALUES
(0, 'Visiteur', 'Pas de compte en soi, est en capacité de lire les articles publics, mais ne\r\npeut ni leur affecter une note, ni écrire un commentaire, ni répondre à un\r\ncommentaire'),
(1, 'Utilisateur inscrit', 'Possède un compte, peut mettre une note à un article, rédiger un\r\ncommentaire et répondre à un commentaire'),
(2, 'Modérateur', 'A les mêmes droit que l’utilisateur inscrit, mais peut en plus modifier ou\r\nsupprimer un commentaire ou une réponse à un commentaire d’un autre\r\nutilisateur (mais pas d’un autre modérateur)'),
(3, 'Rédacteur', 'A les mêmes droits que le modérateur, mais peut rédiger et publier des\r\narticles.'),
(4, 'Administrateur', 'Possède la totalité des droits, incluant l’ajout, la suppression, la gestion ou le\r\nbannissement temporaire d’un utilisateur.');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` char(40) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `pseudo`, `email`, `mdp`, `role_id`) VALUES
(1, 'sam', 'test', 'wam1', 'samva@free.fr', 'samsbs', 4),
(2, 'redac', 'teur test', 'redac', 'redacteur@none.com', 'redacteur', 4),
(3, 'mode', 'rateur', 'moderateur', 'moderateur@none.com', 'moderateur', 3),
(4, 'utili', 'sateur inscrit', 'utilisateur inscrit', 'utilisateur@none.com', 'utilisateurinscrit', 2),
(5, 'visi', 'teur', 'visiteur', 'visiteur@none.com', 'visiteur', 1),
(15, 'dddd', 'dddddddddddddddd', 'dddddddddddddd', 'dddddddddddddd', 'ddddddddddddddddd', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles_has_categories`
--
ALTER TABLE `articles_has_categories`
  ADD PRIMARY KEY (`articles_id_articles`,`categories_id`),
  ADD KEY `articles_id_articles` (`articles_id_articles`),
  ADD KEY `categories_id` (`categories_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_id_articles` (`articles_id_articles`),
  ADD KEY `utilisateurs_id_utilisateur` (`utilisateurs_id_utilisateur`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `fk_notes_articles1` (`articles_id_articles`),
  ADD KEY `fk_notes_utilisateurs1` (`utilisateurs_id_utilisateurs`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles_has_categories`
--
ALTER TABLE `articles_has_categories`
  ADD CONSTRAINT `articles_has_categories_ibfk_1` FOREIGN KEY (`articles_id_articles`) REFERENCES `articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `articles_has_categories_ibfk_2` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`articles_id_articles`) REFERENCES `articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`utilisateurs_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `fk_notes_articles1` FOREIGN KEY (`articles_id_articles`) REFERENCES `articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notes_utilisateurs1` FOREIGN KEY (`utilisateurs_id_utilisateurs`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
