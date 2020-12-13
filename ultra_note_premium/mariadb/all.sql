-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : Dim 13 déc. 2020 à 13:18
-- Version du serveur :  10.5.4-MariaDB
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ultranote`
--

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_bin DEFAULT NULL,
  `niveau` text COLLATE utf8_bin DEFAULT NULL,
  `eleves` text COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `nom`, `niveau`, `eleves`) VALUES
(1, '2A', 'seconde', '[]'),
(2, '2B', 'seconde', '[]'),
(3, '2C', 'seconde', '[]'),
(4, '2D', 'seconde', '[]'),
(5, '2E', 'seconde', '[]'),
(6, '2F', 'seconde', '[]'),
(7, '1A', 'premiere', '[]'),
(8, '1B', 'premiere', '[]'),
(9, '1C', 'premiere', '[]'),
(10, '1D', 'premiere', '[]'),
(11, '1E', 'premiere', '[]'),
(12, 'TA', 'terminale', '[]'),
(13, 'TB', 'terminale', '[]'),
(14, 'TC', 'terminale', '[]'),
(15, 'TD', 'terminale', '[]'),
(16, 'TE', 'terminale', '[]');

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_` text COLLATE utf8_bin DEFAULT NULL,
  `etablissement` text COLLATE utf8_bin DEFAULT NULL,
  `pseudo` text COLLATE utf8_bin DEFAULT NULL,
  `password_` text COLLATE utf8_bin DEFAULT NULL,
  `nom` text COLLATE utf8_bin DEFAULT NULL,
  `prenom` text COLLATE utf8_bin DEFAULT NULL,
  `classe` text COLLATE utf8_bin DEFAULT NULL,
  `classes` text COLLATE utf8_bin DEFAULT NULL,
  `matiere` int(11) DEFAULT NULL,
  `profs` text COLLATE utf8_bin DEFAULT NULL,
  `amis` text COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `devoirs`
--

DROP TABLE IF EXISTS `devoirs`;
CREATE TABLE IF NOT EXISTS `devoirs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prof` int(11) DEFAULT NULL,
  `type_` text COLLATE utf8_bin DEFAULT NULL,
  `titre` text COLLATE utf8_bin DEFAULT NULL,
  `description_` text COLLATE utf8_bin DEFAULT NULL,
  `jour` date DEFAULT NULL,
  `fichiers` text COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etablissements`
--

DROP TABLE IF EXISTS `etablissements`;
CREATE TABLE IF NOT EXISTS `etablissements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_bin DEFAULT NULL,
  `pays` text COLLATE utf8_bin DEFAULT NULL,
  `region` text COLLATE utf8_bin DEFAULT NULL,
  `ville` text COLLATE utf8_bin DEFAULT NULL,
  `adresse` text COLLATE utf8_bin DEFAULT NULL,
  `lien_maps` text COLLATE utf8_bin DEFAULT NULL,
  `email` text COLLATE utf8_bin DEFAULT NULL,
  `phone` text COLLATE utf8_bin DEFAULT NULL,
  `academie` text COLLATE utf8_bin DEFAULT NULL,
  `membres` text COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `etablissements`
--

INSERT INTO `etablissements` (`id`, `nom`, `pays`, `region`, `ville`, `adresse`, `lien_maps`, `email`, `phone`, `academie`, `membres`) VALUES
(1, 'Lycée Henri Poincaré', 'France', 'Grand-Est', 'Nancy', '2 Rue de la Visitation, 54000 Nancy', 'https://www.google.fr/maps/place/2+Rue+de+la+Visitation,+54000+Nancy/@48.6910198,6.1775567,18z/data=!3m1!4b1!4m5!3m4!1s0x479498727bb0495b:0xb68f2f7a82969331!8m2!3d48.6909808!4d6.1781678', 'ce.0540038@ac-nancy-metz.fr', '03 83 17 39 40', 'Nancy-Metz', '');

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

DROP TABLE IF EXISTS `fichiers`;
CREATE TABLE IF NOT EXISTS `fichiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_bin DEFAULT NULL,
  `fichier` mediumblob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

DROP TABLE IF EXISTS `matieres`;
CREATE TABLE IF NOT EXISTS `matieres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_bin DEFAULT NULL,
  `couleur` text COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`id`, `nom`, `couleur`) VALUES
(1, 'Mathématiques', '#bd0404'),
(2, 'Mathématiques Expertes', '#ff0000'),
(3, 'Mathématiques Complémentaires', '#ff3636'),
(4, 'NSI', '#0b4685'),
(5, 'Physique-Chimie', '#2fccb2'),
(6, 'SVT', '#0cfa7f'),
(7, 'Histoire-Géo', '#fabe0c'),
(8, 'Spé Géopo', '#fae034'),
(9, 'SVT', '#0cfa7f'),
(10, 'Francais', '#00b7ff'),
(11, 'Philosophie', '#080bbd'),
(12, 'Anglais', '#5ea7db'),
(13, 'Spé Anglais', '#5e92b8'),
(14, 'Espagnol', '#ffe100'),
(15, 'Allemand', '#821032'),
(16, 'ES-physique', '#609c8f'),
(17, 'ES-SVT', '#609c81'),
(18, 'EPS', '#d6baf5'),
(19, 'Histoire des Arts', '#f2821f'),
(20, 'Musique', '#aff21f'),
(21, 'Grec', '#055eb0'),
(22, 'Latin', '#e0bb96'),
(23, 'Hébreux', '#f4ba7e'),
(24, '', '#ffffff');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auteur` int(11) DEFAULT NULL,
  `texte` text COLLATE utf8_bin DEFAULT NULL,
  `salon` int(11) DEFAULT NULL,
  `cible` text COLLATE utf8_bin DEFAULT NULL,
  `important` tinyint(1) DEFAULT NULL,
  `fichiers` text COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matiere` int(11) DEFAULT NULL,
  `prof` int(11) DEFAULT NULL,
  `classe` int(11) DEFAULT NULL,
  `coef` float DEFAULT NULL,
  `jour` date DEFAULT NULL,
  `jour_visible` date DEFAULT NULL,
  `trimestre` int(11) DEFAULT NULL,
  `titre` text COLLATE utf8_bin DEFAULT NULL,
  `description_` text COLLATE utf8_bin DEFAULT NULL,
  `notes` text COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `salons`
--

DROP TABLE IF EXISTS `salons`;
CREATE TABLE IF NOT EXISTS `salons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_bin DEFAULT NULL,
  `membres` text COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
