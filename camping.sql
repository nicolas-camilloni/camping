-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 24 jan. 2020 à 16:59
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camping`
--
CREATE DATABASE IF NOT EXISTS `dbs781078` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbs781078`;

-- --------------------------------------------------------

--
-- Structure de la table `camping_reservations`
--

DROP TABLE IF EXISTS `camping_reservations`;
CREATE TABLE IF NOT EXISTS `camping_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sejour` int(11) NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `option1` int(11) NOT NULL,
  `option2` int(11) NOT NULL,
  `option3` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `camping_reservations`
--

INSERT INTO `camping_reservations` (`id`, `lieu`, `type`, `sejour`, `debut`, `fin`, `option1`, `option2`, `option3`, `prix`, `id_utilisateur`) VALUES
(1, 'plage', 'tente', 3, '2020-01-22 00:00:00', '2020-01-24 00:00:00', 1, 0, 1, 20, 1),
(2, 'plage', 'campingcar', 3, '2020-01-22 00:00:00', '2020-01-24 00:00:00', 1, 0, 1, 20, 1),
(3, 'pins', 'campingcar', 3, '2020-01-22 00:00:00', '2020-01-24 00:00:00', 1, 0, 1, 20, 1),
(4, 'maquis', 'tente', 3, '2020-01-22 00:00:00', '2020-01-24 00:00:00', 1, 0, 1, 20, 1),
(5, 'maquis', 'campingcar', 3, '2020-01-24 00:00:00', '2020-01-24 00:00:00', 1, 0, 1, 20, 1),
(6, 'maquis', 'campingcar', 3, '2020-01-25 00:00:00', '2020-01-26 00:00:00', 1, 0, 1, 20, 1);

-- --------------------------------------------------------

--
-- Structure de la table `camping_utilisateurs`
--

DROP TABLE IF EXISTS `camping_utilisateurs`;
CREATE TABLE IF NOT EXISTS `camping_utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `camping_utilisateurs`
--

INSERT INTO `camping_utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'nico', 'nico'),
(2, 'Paulette', 'chinois'),
(3, 'test', '$2y$12$7Pyj8z4RGB7KcvH22ZpDEOHsQvFXjy2ELQVAedmSMQB5vvQeuiVvK');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
