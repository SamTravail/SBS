-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 15 août 2022 à 18:50
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
(15, 'Les logiciels libres recommandés par l\'État', 'Il existe un catalogue des logiciels libres recommandés par l\'État pour toute l\'administration. C\'est le SILL qui vient de bénéficier d\'une mise à jour.', 'Jérôme G.', 'draft', '2022-08-13 09:37:29', '2022-08-13 11:37:29'),
(20, 'R2798 - Chaise de Maurice Pré (1907-1988)', 'Chaise des années 1950 de Maurice pré, au design minimaliste à la fois fonctionnel et esthétique, avec son piétement en portique laissant poindre deux poignées de préhension qui permettent à l\'hôte de se mouvoir et de déplacer la chaise aisément. Dossier et assise recouverts de son skaï rouge d\'origine : quelques traces d\'usage visibles en photos. La toile de jaconas laisse apparaitre la conception en crin végétal sur ressorts zag. Chaise nettoyée et dans son jus pour une utilisation soignée car elle est aussi devenue aujourd\'hui une pièce de collection. Avis aux amateurs.\r\n\r\nDimensions: L45 X P50 X H81. Assise 45', 'HAMdesign', 'publish', '2022-08-15 16:38:16', '2022-08-15 18:38:16'),
(21, 'Tests et Bons Plans pour Consommer Malin', 'Nous avons trouvé un outil intéressant pour les internautes en général, puisque les arnaques ne se limitent pas aux achats en ligne et sont susceptibles de toucher n\'importe qui ayant un accès à internet, sur smartphone aussi d\'ailleurs. Nous vous proposons donc de découvrir le guide de prévention des arnaques qui permet de s\'informer sur les différentes techniques et risques, pour être en mesure de les déjouer.\r\n \r\nLe guide de prévention des arnaques : un outil utile mais incomplet\r\n\r\nNous avons découvert un peu par hasard cet outil qui semble utile aux consommateurs, alors nous le partageons avec vous. Si vous nous lisez régulièrement vous devez déjà avoir les bons réflexes pour vous protéger, mais vous ne faites pas partie de la majorité malheureusement, car comme d\'habitude le plus important pour éviter de se faire arnaquer est de s\'informer.', 'wam', 'draft', '2022-08-15 16:45:16', '2022-08-15 18:45:16');

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
(15, 0),
(15, 1),
(21, 1);

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
(0, 'AUCUNE', 0),
(1, 'High Tech', 0),
(2, 'Deco', 0),
(3, 'Sport', 0),
(4, 'Mode', 0),
(5, 'Musique', 0);

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
  `utilisateurs_id_utilisateur` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `titre`, `description`, `date_commentaires`, `articles_id_articles`, `utilisateurs_id_utilisateur`, `id_parent`) VALUES
(4, 'commentaire sam', 'ca c\'est une bonne chaise', '2022-08-15 18:48:05', 20, 1, 0);

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
(48, 4, 20, 0),
(50, 2, 21, 0),
(51, 2, 21, 0),
(52, 3, 21, 2),
(53, 3, 21, 2);

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
  `mdp` char(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `pseudo`, `email`, `mdp`, `role_id`) VALUES
(0, 'Sam', 'NRV', 'SamNRV', 'samva@free.fr', '$2y$10$kQPtAl9vjLNYpfAoPz8RR.zTgGZXUT/i6E3Ml7fbAPHcVDC7nQpHm', 4),
(1, 'redacteur', 'redacteur', 'redacteur', 'redacteur@none.com', '$2y$10$XxfEkwZPjKL69p4EnO4a7uK3BV6.tyAxhwNp3P9KxGlAO/jFcaLWS', 3),
(2, 'mode', 'rateur', 'moderateur', 'moderateur@none.fr', '$2y$10$thRznMr970.M5GE3DgW3quk/HdduCD2QJivncXjClZOIJx9me2DfS', 2),
(3, 'utilisateur', 'inscrit', 'userinscrit', 'userinscrit@none.fr', '$2y$10$nr9nWdBJuJLlDWV4rAcedu8dasX.n4c.cFczkgZ4uAImV6ICHnYMq', 1);

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
  ADD KEY `commentaires_ibfk_1` (`articles_id_articles`),
  ADD KEY `commentaires_ibfk_2` (`utilisateurs_id_utilisateur`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles_has_categories`
--
ALTER TABLE `articles_has_categories`
  ADD CONSTRAINT `articles_has_categories_ibfk_1` FOREIGN KEY (`articles_id_articles`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_has_categories_ibfk_2` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`articles_id_articles`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`utilisateurs_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `fk_notes_articles1` FOREIGN KEY (`articles_id_articles`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notes_utilisateurs1` FOREIGN KEY (`utilisateurs_id_utilisateurs`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
