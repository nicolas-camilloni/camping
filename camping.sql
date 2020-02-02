-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 02 fév. 2020 à 15:23
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
CREATE DATABASE IF NOT EXISTS `camping` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `camping`;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `lieu`, `type`, `sejour`, `debut`, `fin`, `option1`, `option2`, `option3`, `prix`, `id_utilisateur`) VALUES
(1, 'Pins', 'Campingcar', 4, '2020-01-25 00:00:00', '2020-01-29 00:00:00', 1, 1, 1, 276, 1),
(2, 'Plage', 'Campingcar', 3, '2020-01-22 00:00:00', '2020-01-24 00:00:00', 1, 0, 1, 20, 1),
(3, 'Pins', 'Campingcar', 3, '2020-01-22 00:00:00', '2020-01-24 00:00:00', 1, 0, 1, 20, 1),
(4, 'Maquis', 'Tente', 3, '2020-01-22 00:00:00', '2020-01-24 00:00:00', 1, 0, 1, 20, 1),
(5, 'Maquis', 'Campingcar', 3, '2020-01-24 00:00:00', '2020-01-24 00:00:00', 1, 0, 1, 20, 1),
(6, 'Maquis', 'Campingcar', 3, '2020-01-25 00:00:00', '2020-01-26 00:00:00', 1, 0, 1, 20, 1),
(7, 'Plage', 'Campingcar', 2, '2020-01-30 00:00:00', '2020-01-31 00:00:00', 1, 1, 0, 20, 5),
(8, 'Pins', 'Campingcar', 6, '2020-02-19 00:00:00', '2020-02-24 00:00:00', 1, 0, 0, 1000, 5),
(9, 'Pins', 'Campingcar', 1, '2020-02-24 00:00:00', '2020-02-25 00:00:00', 1, 1, 1, 0, 5),
(10, 'Pins', 'Campingcar', 1, '2020-02-20 00:00:00', '2020-02-21 00:00:00', 1, 1, 1, 69, 5),
(11, 'Pins', 'Campingcar', 1, '2020-02-20 00:00:00', '2020-02-21 00:00:00', 0, 0, 0, 20, 5),
(12, 'Pins', 'Tente', 1, '2020-01-30 00:00:00', '2020-01-31 00:00:00', 1, 0, 0, 12, 5),
(13, 'Pins', 'Tente', 1, '2020-01-30 00:00:00', '2020-01-31 00:00:00', 1, 0, 0, 12, 5),
(14, 'Pins', 'Tente', 2, '2020-01-30 00:00:00', '2020-01-31 00:00:00', 1, 0, 0, 24, 5),
(15, 'Pins', 'Tente', 2, '2020-01-30 00:00:00', '2020-01-31 00:00:00', 1, 0, 0, 24, 5),
(16, 'Plage', 'Tente', 2, '2020-02-01 00:00:00', '2020-02-02 00:00:00', 1, 0, 0, 24, 5),
(17, 'Plage', 'Tente', 2, '2020-02-01 00:00:00', '2020-02-02 00:00:00', 1, 0, 0, 24, 5),
(18, 'Plage', 'Tente', 2, '2020-02-01 00:00:00', '2020-02-02 00:00:00', 1, 1, 1, 118, 5),
(19, 'Plage', 'Tente', 2, '2020-02-01 00:00:00', '2020-02-02 00:00:00', 1, 1, 1, 118, 5),
(20, 'Plage', 'Tente', 2, '2020-02-15 00:00:00', '2020-02-16 00:00:00', 0, 0, 0, 20, 5),
(21, 'Plage', 'Tente', 2, '2020-01-30 00:00:00', '2020-01-31 00:00:00', 0, 0, 0, 20, 6),
(22, 'Plage', 'Tente', 2, '2020-01-30 00:00:00', '2020-01-31 00:00:00', 0, 0, 0, 20, 6),
(23, 'Maquis', 'Campingcar', 2, '2020-01-30 00:00:00', '2020-01-31 00:00:00', 0, 0, 0, 40, 6),
(24, 'Plage', 'Campingcar', 1, '2020-02-21 00:00:00', '2020-02-22 00:00:00', 0, 1, 1, 67, 7);

-- --------------------------------------------------------

--
-- Structure de la table `tarifs`
--

DROP TABLE IF EXISTS `tarifs`;
CREATE TABLE IF NOT EXISTS `tarifs` (
  `tarifo1` int(11) NOT NULL,
  `tarifo2` int(11) NOT NULL,
  `tarifo3` int(11) NOT NULL,
  `tarifemplacement` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tarifs`
--

INSERT INTO `tarifs` (`tarifo1`, `tarifo2`, `tarifo3`, `tarifemplacement`) VALUES
(2, 17, 30, 10);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'nico', 'nico'),
(2, 'Paulette', 'chinois'),
(3, 'test', '$2y$12$7Pyj8z4RGB7KcvH22ZpDEOHsQvFXjy2ELQVAedmSMQB5vvQeuiVvK'),
(4, 'Pascalette', '$2y$12$lDqqJDZhO8Ms5BZg815VBeciw02kGTlhv1mbm9x6I5Hv7vijoG8yW'),
(5, 'nicolas', '$2y$12$8czNNil8/lYF5LtN2C7YyugQv08b7z9xv4MmuRaOJ.Wi96pu.d0Wi'),
(6, 'salut', '$2y$12$hJVH02Y8nzJUjo4vGuSFneIwuU.j2HPOMScmHKeZYLe7ShllR.nCK'),
(7, 'admin', '$2y$12$J.Sp9g7nzNPS0VoaRBPSNuuTFoVvUoBPHCuDraZrmrAIfW33akPGq'),
(8, 'test3', '$2y$12$LK4gQvsWRr4K5/ohn320DOpahrG3XTTy48O5a8ipqRoBpbK4PMbPm');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
