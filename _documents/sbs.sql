-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 11 août 2022 à 15:35
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
(7, '3333333333', '33333333333333', '333333333333333', 'draft', '2022-08-10 11:34:41', '2022-08-10 13:34:41'),
(8, '333333333333333', '333333333333333333333', '333333333333333333', 'draft', '2022-08-10 11:28:49', '2022-08-10 13:28:49'),
(9, '333333333333333', '333333333333333333333', '333333333333333333', 'draft', '2022-08-10 11:28:49', '2022-08-10 13:28:49'),
(10, '333333333333333', '333333333333333333333', '333333333333333333', 'draft', '2022-08-10 11:28:50', '2022-08-10 13:28:50'),
(12, '333333333333333', '333333333333333333333', '333333333333333333', 'draft', '2022-08-10 11:28:51', '2022-08-10 13:28:51'),
(13, '333333333333333', '333333333333333333333', '333333333333333333', 'draft', '2022-08-10 11:28:51', '2022-08-10 13:28:51'),
(14, '9999999999999', '333333333333333333333', '333333333333333333', 'draft', '2022-08-11 02:25:43', '2022-08-11 04:25:43'),
(15, '333333333333333', '333333333333333333333', '333333333333333333', 'draft', '2022-08-10 11:28:52', '2022-08-10 13:28:52'),
(16, '2222222222222222222', '2222222222222222222222', '22222222222222222222', 'draft', '2022-08-10 11:33:32', '2022-08-10 13:33:32');

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

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
