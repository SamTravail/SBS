-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 09 août 2022 à 12:46
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
(1, 'titre 1', 'rgtdhgthdt', 'moi', 'draft', '2022-08-08 07:40:42', '2022-08-08 09:40:42'),
(2, 'titre 23', 'rgtdhgthdtytrjnytrjntrjyrt-', 'moi2', 'draft', '2022-08-08 07:45:36', '2022-08-08 09:45:36'),
(3, 'article3', '123lorem 20jugouguglgj', 'Wam', 'draft', '2022-08-08 09:06:17', '2022-08-08 11:06:17'),
(4, 'Article 4', '4 -ème article de test pour SBS', 'Wam', 'draft', '2022-08-08 16:42:52', '2022-08-08 18:42:52');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `titre` varchar(70) NOT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `titre`, `description`) VALUES
(1, 'Visiteur', 'Pas de compte en soi, est en capacité de lire les articles publics, mais ne\r\npeut ni leur affecter une note, ni écrire un commentaire, ni répondre à un\r\ncommentaire'),
(2, 'Utilisateur inscrit', 'Possède un compte, peut mettre une note à un article, rédiger un\r\ncommentaire et répondre à un commentaire'),
(3, 'Modérateur', 'A les mêmes droit que l’utilisateur inscrit, mais peut en plus modifier ou\r\nsupprimer un commentaire ou une réponse à un commentaire d’un autre\r\nutilisateur (mais pas d’un autre modérateur)'),
(4, 'Rédacteur', 'A les mêmes droits que le modérateur, mais peut rédiger et publier des\r\narticles.'),
(5, 'Administrateur', 'Possède la totalité des droits, incluant l’ajout, la suppression, la gestion ou le\r\nbannissement temporaire d’un utilisateur.');

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
