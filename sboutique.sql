-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 24 nov. 2017 à 15:15
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sboutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idClient` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_32EB52E8A455ACCF` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Article_Categorie_idx` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `designation`, `imageUrl`, `description`, `idCategorie`) VALUES
(1, 'test', 'Koala.jpg', 'tedtetetvze', 1),
(2, 'tedt', 'Jellyfish.jpg', 'aze', 1);

-- --------------------------------------------------------

--
-- Structure de la table `articlevendeur`
--

DROP TABLE IF EXISTS `articlevendeur`;
CREATE TABLE IF NOT EXISTS `articlevendeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) DEFAULT NULL,
  `vendeur_id` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `payableNFois` int(11) NOT NULL,
  `prix` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E900E9957294869C` (`article_id`),
  KEY `IDX_E900E995858C065E` (`vendeur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `articlevendeur`
--

INSERT INTO `articlevendeur` (`id`, `article_id`, `vendeur_id`, `quantite`, `payableNFois`, `prix`) VALUES
(3, 2, 6, 14, 0, 23.3),
(4, 1, 6, 12, 0, 112.1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Ordinateur'),
(2, 'Téléphone');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `googleIdentifier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendeur_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C7440455858C065E` (`vendeur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `email`, `adresse`, `telephone`, `googleIdentifier`, `vendeur_id`) VALUES
(1, 'tamoo', 'tra', 'gdfgr@pot.fr', NULL, NULL, NULL, NULL),
(2, 'test', NULL, 'rere@mlk.fr', NULL, NULL, NULL, NULL),
(3, 'azerty', NULL, 'fnac@vendeur.com', NULL, NULL, NULL, 6),
(4, 'rert', NULL, 'fnac2@vendeur.com', NULL, NULL, NULL, 6),
(5, 'tamoo', NULL, 'tamoo@hotmail.fr', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` tinyint(1) DEFAULT NULL,
  `etat` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datePrevue` datetime DEFAULT NULL,
  `dateRecue` int(11) DEFAULT NULL,
  `idClient` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Commande_Client_idx` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandearticle`
--

DROP TABLE IF EXISTS `commandearticle`;
CREATE TABLE IF NOT EXISTS `commandearticle` (
  `commande_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`commande_id`,`article_id`),
  KEY `IDX_F95D123082EA2E54` (`commande_id`),
  KEY `IDX_F95D12307294869C` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_article`
--

DROP TABLE IF EXISTS `commande_article`;
CREATE TABLE IF NOT EXISTS `commande_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) DEFAULT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `datePrevue` datetime DEFAULT NULL,
  `dateRecue` datetime DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F4817CC682EA2E54` (`commande_id`),
  KEY `IDX_F4817CC67294869C` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`),
  UNIQUE KEY `UNIQ_957A647919EB6921` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `nom`, `client_id`) VALUES
(1, 'tamoo', 'tamoo', 'tamooo@yopmail.com', 'tamooo@yopmail.com', 1, NULL, '$2y$13$u0y6ST57HIgBF/Ntn.jel.i92krmC379U0m.Y9OA9MfHMjX9Tma9K', '2017-11-22 13:23:56', NULL, NULL, 'a:0:{}', '', NULL),
(2, 'tamoo2', 'tamoo2', 'tamooo1@yopmail.com', 'tamooo1@yopmail.com', 1, NULL, '$2y$13$OIrZWXC.60vOgSNwJMxNiOfbXA9NkA5UBDQ8n2LYKf1AW19R6WQ3e', NULL, 'SpqpjmO124xOj5tSFmvsd8Qhs7x9kQZoRXoqR8qD92E', NULL, 'a:0:{}', '', NULL),
(3, 'moi', 'moi', 'poi@mlk.fr', 'poi@mlk.fr', 1, NULL, '$2y$13$SKUnRHI4kSKe.xQTxJbN0e8tmzIvLRnCDiyGwUoG.pmHZPlFM00zS', NULL, NULL, NULL, 'a:0:{}', '', NULL),
(4, 'azerty@mlg.fr', 'azerty@mlg.fr', 'azerty@mlg.fr', 'azerty@mlg.fr', 1, NULL, '$2y$13$5iXYGowYqJbFCC5bnJW/c.er97qC1xjTN0CZSAwILc5EMvV7YRZZW', NULL, NULL, NULL, 'a:0:{}', 'tamoo', NULL),
(5, 'abcd@or.de', 'abcd@or.de', 'abcd@or.de', 'abcd@or.de', 1, NULL, '$2y$13$GzNZiB7sy0ZIj9e0inPegeITVcb5C0aoqJpcVeQUz2X6H1otvOpvC', '2017-11-22 14:38:41', NULL, NULL, 'a:0:{}', 'tamoo', NULL),
(6, 'gdfgr@pot.fr', 'gdfgr@pot.fr', 'gdfgr@pot.fr', 'gdfgr@pot.fr', 1, NULL, '$2y$13$4N4HyFBvc2xkj6M6J3V9pO9s1Q2dg8V6AaUX8JEc2i5C9XLr6vc7e', '2017-11-22 14:41:09', NULL, NULL, 'a:0:{}', 'tamoo', NULL),
(7, 'vendeur@vendeur.com', 'vendeur@vendeur.com', 'vendeur@vendeur.com', 'vendeur@vendeur.com', 1, NULL, '$2y$13$4N4HyFBvc2xkj6M6J3V9pO9s1Q2dg8V6AaUX8JEc2i5C9XLr6vc7e', '2017-11-23 09:08:13', NULL, NULL, 'a:1:{i:0;s:12:\"ROLE_VENDEUR\";}', 'vendeur', NULL),
(8, 'rere@mlk.fr', 'rere@mlk.fr', 'rere@mlk.fr', 'rere@mlk.fr', 1, NULL, '$2y$13$gFeYiVqEzEhTnY5pAAgmUeg/jfysj9rOgf9Qj79sg1ymp10m9cqo2', '2017-11-22 15:37:14', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'test', NULL),
(9, 'fnac@vendeur.com', 'fnac@vendeur.com', 'fnac@vendeur.com', 'fnac@vendeur.com', 1, NULL, '$2y$13$aUwx8PK.OcyMfpkGZMhEtOnkFgVumCo5gvZNn5unLffx5x23l9TAK', '2017-11-23 09:12:46', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'azerty', NULL),
(10, 'fnac2@vendeur.com', 'fnac2@vendeur.com', 'fnac2@vendeur.com', 'fnac2@vendeur.com', 1, NULL, '$2y$13$hkLDHPb6h/k2xzHYniEvpOJcotqYrvtLgPGfMROG2NhGHf841gmoG', '2017-11-23 15:31:52', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'rert', 4),
(11, 'tamoo@hotmail.fr', 'tamoo@hotmail.fr', 'tamoo@hotmail.fr', 'tamoo@hotmail.fr', 1, NULL, '$2y$13$2ga4hOUxfkZ5m1cfCI/eJuJh3aWRvXbhTwTWnBF4WUdnQdcjIKqOW', '2017-11-24 14:10:56', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'tamoo', 5);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci,
  `vendeur` tinyint(1) DEFAULT NULL,
  `reclamation` tinyint(1) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL,
  `idArticle` int(11) DEFAULT NULL,
  `idPersonne` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Message_Article_idx` (`idArticle`),
  KEY `FK_Message_Vendeur_idx` (`idPersonne`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `date`, `contenu`, `vendeur`, `reclamation`, `visible`, `idArticle`, `idPersonne`) VALUES
(1, '2017-11-23 00:00:00', 'sdgvd dfhdfb', NULL, NULL, 1, 3, 1),
(2, '2017-11-24 08:29:28', 'test', NULL, NULL, 1, 3, 5),
(3, '2017-11-24 14:16:59', 'ettt', NULL, NULL, 1, 4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `reduction`
--

DROP TABLE IF EXISTS `reduction`;
CREATE TABLE IF NOT EXISTS `reduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pourcentage` double NOT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  `idClient` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reduction_Categorie_idx` (`idCategorie`),
  KEY `FK_Reduction_Client_idx` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `datePrevue` datetime NOT NULL,
  `dateRecue` int(11) DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idArticle` int(11) DEFAULT NULL,
  `idClient` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C8495512836594` (`idArticle`),
  KEY `IDX_42C84955A455ACCF` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `retour`
--

DROP TABLE IF EXISTS `retour`;
CREATE TABLE IF NOT EXISTS `retour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `etat` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idArticle` int(11) DEFAULT NULL,
  `idClient` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Retour_Article_idx` (`idArticle`),
  KEY `FK_Retour_Client_idx` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresseVendeur` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomVendeur` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idClient` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7AF49996A455ACCF` (`idClient`),
  KEY `FK_Vendeur_Client` (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`id`, `adresseVendeur`, `nomVendeur`, `idClient`) VALUES
(6, 'rue de la rue', 'fnac', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `FK_32EB52E8A455ACCF` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E66B597FD62` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `articlevendeur`
--
ALTER TABLE `articlevendeur`
  ADD CONSTRAINT `FK_E900E9957294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_E900E995858C065E` FOREIGN KEY (`vendeur_id`) REFERENCES `vendeur` (`id`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_C7440455858C065E` FOREIGN KEY (`vendeur_id`) REFERENCES `vendeur` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67DA455ACCF` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `commandearticle`
--
ALTER TABLE `commandearticle`
  ADD CONSTRAINT `FK_F95D12307294869C` FOREIGN KEY (`article_id`) REFERENCES `articlevendeur` (`id`),
  ADD CONSTRAINT `FK_F95D123082EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `commande_article`
--
ALTER TABLE `commande_article`
  ADD CONSTRAINT `FK_F4817CC67294869C` FOREIGN KEY (`article_id`) REFERENCES `articlevendeur` (`id`),
  ADD CONSTRAINT `FK_F4817CC682EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD CONSTRAINT `FK_957A647919EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307F12836594` FOREIGN KEY (`idArticle`) REFERENCES `articlevendeur` (`id`),
  ADD CONSTRAINT `FK_B6BD307F5C6DE3B4` FOREIGN KEY (`idPersonne`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `reduction`
--
ALTER TABLE `reduction`
  ADD CONSTRAINT `FK_B1E75468A455ACCF` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_B1E75468B597FD62` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C8495512836594` FOREIGN KEY (`idArticle`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_42C84955A455ACCF` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `retour`
--
ALTER TABLE `retour`
  ADD CONSTRAINT `FK_ED6FD32112836594` FOREIGN KEY (`idArticle`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_ED6FD321A455ACCF` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD CONSTRAINT `FK_7AF49996A455ACCF` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
