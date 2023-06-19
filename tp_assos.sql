-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 18 juin 2023 à 13:55
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
-- Base de données : `tp_assos`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Identifiant livre',
  `title` varchar(100) NOT NULL COMMENT 'Titre livre',
  `author` varchar(80) DEFAULT NULL COMMENT 'Auteur livre',
  `genre` varchar(50) DEFAULT NULL COMMENT 'Genre livre',
  `available` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Réservé, 1: Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des livres';

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `genre`, `available`) VALUES
(1, 'Eragon', 'Christopher Paolini', 'Fantasy', 0),
(2, 'Le Seigneur des Anneaux', 'J. R. R. Tolkien', 'Fantasy', 1),
(3, 'Le Parfum', 'Patrick Süskind', 'Mystère/Horreur', 1),
(4, 'Germinal', 'Emile Zola', 'Fiction', 0),
(6, 'Le Dernier Templier', 'Raymond Khoury', 'Thriller/Fiction', 1);

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE `emprunt` (
  `id_emprunt` bigint(20) UNSIGNED NOT NULL,
  `id_membre` bigint(20) UNSIGNED NOT NULL,
  `id_livre` bigint(20) UNSIGNED NOT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour_prevu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table des emprunts de livre';

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id_emprunt`, `id_membre`, `id_livre`, `date_emprunt`, `date_retour_prevu`) VALUES
(1, 1, 1, '2023-06-18', '2023-06-29'),
(2, 1, 4, '2023-06-22', '2023-06-30');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'identifiant membre',
  `nom` varchar(40) NOT NULL COMMENT 'nom membre',
  `prenom` varchar(40) NOT NULL COMMENT 'prenom membre',
  `telephone` int(11) NOT NULL COMMENT 'telephone membre',
  `email` varchar(50) NOT NULL COMMENT 'email membre',
  `password` varchar(50) NOT NULL COMMENT 'mot de passe membre',
  `question_secrete` varchar(200) NOT NULL COMMENT 'question secrete',
  `reponse_secrete` varchar(200) NOT NULL COMMENT 'reponse secrete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des membres';

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `telephone`, `email`, `password`, `question_secrete`, `reponse_secrete`) VALUES
(1, 'MAI VAN Y', 'Mavrick', 465798, 'mackslight@gmail.com', 'Motdepass3@cd', 'Test ?', 'Test'),
(2, 'SOMNY', 'Jonathan', 123465, 'ulrichpolech@gmail.com', 'test', 'Test2 ?', 'Test2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `uni_book_title` (`title`) USING BTREE;

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id_emprunt`),
  ADD UNIQUE KEY `id` (`id_emprunt`),
  ADD KEY `c_fk_id_membre` (`id_membre`),
  ADD KEY `c_fk_id_livre` (`id_livre`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant livre', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id_emprunt` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'identifiant membre', AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `c_fk_id_livre` FOREIGN KEY (`id_livre`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `c_fk_id_membre` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
