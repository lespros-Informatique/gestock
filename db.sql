-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 23 fév. 2026 à 14:23
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_site_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--

DROP TABLE IF EXISTS `abonnements`;
CREATE TABLE IF NOT EXISTS `abonnements` (
  `id_abonnement` int NOT NULL AUTO_INCREMENT,
  `code_abonnement` varchar(50) NOT NULL,
  `compte_code` varchar(50) NOT NULL,
  `type_abonnement_code` varchar(50) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `etat_abonnement` int DEFAULT '1',
  PRIMARY KEY (`id_abonnement`),
  UNIQUE KEY `code_abonnement` (`code_abonnement`),
  KEY `compte_code` (`compte_code`),
  KEY `type_abonnement_code` (`type_abonnement_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `abonnements`
--

INSERT INTO `abonnements` (`id_abonnement`, `code_abonnement`, `compte_code`, `type_abonnement_code`, `date_debut`, `date_fin`, `etat_abonnement`) VALUES
(1, 'AB-123228JS', 'COMPEZA7', 'SS-STARTER', '2026-02-17', '2026-02-20', 1),
(3, 'AB-12K3228JS', 'COMPEZAA7', 'SS-BUSINESS', '2026-02-17', '2026-03-17', 1);

-- --------------------------------------------------------

--
-- Structure de la table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `id_application` int NOT NULL AUTO_INCREMENT,
  `code_application` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `libelle_application` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `slug_application` varchar(100) DEFAULT NULL,
  `icon_application` varchar(100) DEFAULT NULL,
  `image_application` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `link_video_application` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `link_application` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description_application` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `etat_application` int DEFAULT '1',
  PRIMARY KEY (`id_application`),
  UNIQUE KEY `code_categorie` (`code_application`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `applications`
--

INSERT INTO `applications` (`id_application`, `code_application`, `libelle_application`, `slug_application`, `icon_application`, `image_application`, `link_video_application`, `link_application`, `description_application`, `etat_application`) VALUES
(1, 'SMARTSTOCK', 'SmartStock', 'smartstock', 'home', 'uploads/applications/app_6995d06cc1e7b.png', '', 'https://smartstock.app', 'Gestion intelligente de stock pour PME.', 1),
(2, 'SMARTSCHOOL', 'SmartSchool', 'smartschool', 'home', 'uploads/applications/app_6995d05bf2a6c.png', '', 'https://smartschool.app', 'Gestion scolaire moderne et simplifiée.', 1),
(3, 'SMARTFACTURE', 'SmartFacture', 'smartfacture', 'book', 'uploads/applications/app_6995d041818aa.jpeg', '', 'https://smartfacture.app', 'Facturation et gestion commerciale.', 1),
(4, 'SMARTRH', 'SmartRH', 'smartrh', 'user', 'uploads/applications/app_6995d07959c3d.png', '', 'https://smartrh.app', 'Gestion des ressources humaines.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `avantages`
--

DROP TABLE IF EXISTS `avantages`;
CREATE TABLE IF NOT EXISTS `avantages` (
  `id_avantage` int NOT NULL AUTO_INCREMENT,
  `code_avantage` varchar(50) NOT NULL,
  `type_abonnement_code` varchar(50) NOT NULL,
  `description_avantage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `valeur_avantage` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at_avantage` datetime DEFAULT NULL,
  `etat_avantage` int DEFAULT '1',
  PRIMARY KEY (`id_avantage`),
  UNIQUE KEY `code_avantage` (`code_avantage`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `avantages`
--

INSERT INTO `avantages` (`id_avantage`, `code_avantage`, `type_abonnement_code`, `description_avantage`, `valeur_avantage`, `created_at_avantage`, `etat_avantage`) VALUES
(1, 'SS-ST-USER', 'SS-STARTER', 'Utilisateurs maximum', '2', '2026-02-18 14:40:53', 1),
(2, 'SS-ST-PROD', 'SS-STARTER', 'Produits maximum', '100', '2026-02-18 14:40:53', 1),
(3, 'SS-ST-SUP', 'SS-STARTER', 'Support email', 'Inclus', '2026-02-18 14:40:53', 1),
(4, 'SS-BU-USER', 'SS-BUSINESS', 'Utilisateurs maximum', '10', '2026-02-18 14:41:18', 1),
(5, 'SS-BU-PROD', 'SS-BUSINESS', 'Produits illimités', 'Illimité', '2026-02-18 14:41:18', 1),
(6, 'SS-BU-REP', 'SS-BUSINESS', 'Rapports avancés', 'Inclus', '2026-02-18 14:41:18', 1),
(13, 'SS-BU-USER2', 'SS-BUSINESS', 'Utilisateurs maximum', '10', '2026-02-18 14:42:08', 1),
(14, 'SS-BU-PROD2', 'SS-BUSINESS', 'Produits illimités', 'Illimité', '2026-02-18 14:42:08', 1),
(15, 'SS-BU-REP2', 'SS-BUSINESS', 'Rapports avancés', 'Inclus', '2026-02-18 14:42:08', 1),
(16, 'SS-BU-USER3', 'SS-BUSINESS', 'Utilisateurs maximum', '10', '2026-02-18 14:42:23', 1),
(17, 'SS-BU-PROD3', 'SS-BUSINESS', 'Produits illimités', 'Illimité', '2026-02-18 14:42:23', 1),
(18, 'SS-BU-REP3', 'SS-BUSINESS', 'Rapports avancés', 'Inclus', '2026-02-18 14:42:23', 1);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `code_client` varchar(50) NOT NULL,
  `partner_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nom_client` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telephone_client` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email_client` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sexe_client` varchar(10) NOT NULL,
  `etat_client` int DEFAULT '1',
  `created_at_client` date NOT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `code_client` (`code_client`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_client`, `code_client`, `partner_code`, `nom_client`, `telephone_client`, `email_client`, `sexe_client`, `etat_client`, `created_at_client`) VALUES
(11, 'CLIENT-CODE2', 'PART-9GDHSDPV', 'konate mariam', '0566015517', 'client@gmail.com', 'Homme', 1, '2026-02-17');

-- --------------------------------------------------------

--
-- Structure de la table `compte_partner`
--

DROP TABLE IF EXISTS `compte_partner`;
CREATE TABLE IF NOT EXISTS `compte_partner` (
  `id_compte` int NOT NULL AUTO_INCREMENT,
  `code_compte_partner` varchar(50) NOT NULL,
  `montant_compte` float NOT NULL,
  `sous_compte` float NOT NULL,
  `etat_compte` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_compte`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `compte_partner`
--

INSERT INTO `compte_partner` (`id_compte`, `code_compte_partner`, `montant_compte`, `sous_compte`, `etat_compte`) VALUES
(1, 'css', 10000, 100, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fonctions`
--

DROP TABLE IF EXISTS `fonctions`;
CREATE TABLE IF NOT EXISTS `fonctions` (
  `id_fonction` int NOT NULL AUTO_INCREMENT,
  `libelle_fonction` varchar(50) NOT NULL,
  `code_fonction` varchar(50) NOT NULL,
  `etat_fonction` int NOT NULL,
  `description_fonction` text,
  PRIMARY KEY (`id_fonction`),
  UNIQUE KEY `code_fonction` (`code_fonction`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fonctions`
--

INSERT INTO `fonctions` (`id_fonction`, `libelle_fonction`, `code_fonction`, `etat_fonction`, `description_fonction`) VALUES
(1, 'Super Administrateur', '5wBEh2OfI00frxk8ITPf', 2, NULL),
(2, 'Administrateur', 'Khec7SoqZWja1rUJksqbUQTsKqo', 2, NULL),
(3, 'RECEPTION', 'NmUukWPBi6uFc5SGNzv855sE', 1, ''),
(4, 'COMPTABLE', 'tuUV5fNExGRrnSVeN3fpLhcrvROR6Ka', 1, ''),
(5, 'MANAGER', 'qkmDBGDnL63BhvauhZTNPI', 1, ''),
(6, 'COMPTA', 'y6Lfk6bC9dBDKIughjfutdioou', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `images_applications`
--

DROP TABLE IF EXISTS `images_applications`;
CREATE TABLE IF NOT EXISTS `images_applications` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `link_image` varchar(100) NOT NULL,
  `etat_image` int NOT NULL DEFAULT '1',
  `application_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `images_applications`
--

INSERT INTO `images_applications` (`id_image`, `link_image`, `etat_image`, `application_code`) VALUES
(1, 'uploads/applications/app_img_6994810b0f2ac.png', 0, 'SMARTSTOCK'),
(2, 'uploads/applications/app_img_6994812b7a7a6.png', 1, 'SMARTSTOCK'),
(3, 'uploads/applications/app_img_6994813b9a0d1.png', 1, 'SMARTSCHOOL'),
(4, 'uploads/applications/app_img_699481497bb6a.png', 1, 'SMARTSCHOOL'),
(5, 'uploads/applications/app_img_6994816f2714c.jpg', 1, 'SMARTFACTURE'),
(6, 'uploads/applications/app_img_699481abf3251.jpeg', 1, 'SMARTFACTURE'),
(7, 'uploads/applications/app_img_699482d6301f9.jpeg', 1, 'SMARTFACTURE');

-- --------------------------------------------------------

--
-- Structure de la table `paiement_abonnements`
--

DROP TABLE IF EXISTS `paiement_abonnements`;
CREATE TABLE IF NOT EXISTS `paiement_abonnements` (
  `id_paiement_abonnement` int NOT NULL AUTO_INCREMENT,
  `code_paiement_abonnement` varchar(50) NOT NULL,
  `abonnement_code` varchar(50) DEFAULT NULL,
  `montant_paiement_abonnement` decimal(10,2) DEFAULT NULL,
  `date_paiement_abonnement` datetime DEFAULT NULL,
  `etat_paiement_abonnement` int DEFAULT '1',
  `etat_partner` int DEFAULT '1',
  PRIMARY KEY (`id_paiement_abonnement`),
  UNIQUE KEY `code_paiement_abonnement` (`code_paiement_abonnement`),
  KEY `abonnement_code` (`abonnement_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `paiement_abonnements`
--

INSERT INTO `paiement_abonnements` (`id_paiement_abonnement`, `code_paiement_abonnement`, `abonnement_code`, `montant_paiement_abonnement`, `date_paiement_abonnement`, `etat_paiement_abonnement`, `etat_partner`) VALUES
(1, 'DPIOS', 'AB-123228JS', 19000.00, '2026-02-18 00:44:08', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `paiement_partner`
--

DROP TABLE IF EXISTS `paiement_partner`;
CREATE TABLE IF NOT EXISTS `paiement_partner` (
  `id_paiement_partner` int NOT NULL AUTO_INCREMENT,
  `montant_paiement_partner` float NOT NULL,
  `created_at_paiement_partner` datetime NOT NULL,
  `etat_paiement_partner` int NOT NULL DEFAULT '1',
  `user_code` varchar(50) NOT NULL,
  `telephone_paiement_partner` varchar(100) NOT NULL,
  `created_at_reception` datetime NOT NULL,
  `code_paiement_partner` varchar(50) NOT NULL,
  PRIMARY KEY (`id_paiement_partner`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `paiement_partner`
--

INSERT INTO `paiement_partner` (`id_paiement_partner`, `montant_paiement_partner`, `created_at_paiement_partner`, `etat_paiement_partner`, `user_code`, `telephone_paiement_partner`, `created_at_reception`, `code_paiement_partner`) VALUES
(1, 20000, '2026-02-18 00:45:42', 1, 'qsq', '0132442278', '2026-02-18 00:45:42', 'kkkkkkkkkkkk');

-- --------------------------------------------------------

--
-- Structure de la table `partners`
--

DROP TABLE IF EXISTS `partners`;
CREATE TABLE IF NOT EXISTS `partners` (
  `id_partner` int NOT NULL AUTO_INCREMENT,
  `code_partner` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nom_partner` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prenom_partner` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email_partner` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telephone_partner` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password_partner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `token_partner` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `etat_partner` int DEFAULT '0',
  `created_at_partner` datetime DEFAULT NULL,
  PRIMARY KEY (`id_partner`),
  UNIQUE KEY `code_user` (`code_partner`),
  UNIQUE KEY `email` (`email_partner`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `partners`
--

INSERT INTO `partners` (`id_partner`, `code_partner`, `nom_partner`, `prenom_partner`, `email_partner`, `telephone_partner`, `password_partner`, `token_partner`, `etat_partner`, `created_at_partner`) VALUES
(2, 'PART-9GDHSDPV', 'CAMARA', 'LesPros', 'camara.georges1f313@gmail.com', '0599009988', '$2y$10$Cjh90YYXwtO42kaSKqjKbObqhUtiYB7zaxWn2nuawUoCiA1VE9zea', NULL, 1, NULL),
(3, 'PART-QZO3ZRPA', 'CAMARA RASS', 'Camaratom', 'camara.georges1g313@gmail.com', '0599009988', NULL, NULL, 1, '2026-02-17 23:23:28');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `libelle_role` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `code_role` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `groupe` varchar(50) NOT NULL,
  `etat_role` int NOT NULL DEFAULT '0',
  `description` text,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `code_role` (`code_role`),
  KEY `groupe` (`groupe`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id_role`, `libelle_role`, `code_role`, `module`, `groupe`, `etat_role`, `description`) VALUES
(1, 'ADMIN', 'ga1', 'ADMIN', 'GADMIN', 1, 'SUPPER ADMINISTRATEUR'),
(3, 'DASHBOARD ', 'ga3', 'ADMIN', 'GADMIN', 1, NULL),
(5, 'COMPTABLE ', 'gcom1', 'COMPTABLE', 'GCOMPT', 1, NULL),
(7, 'MANAGER ', 'gh1', 'MANAGER', 'GHOT', 1, NULL),
(8, 'SALAIRE ', 'gcom2', 'COMPTABLE', 'GCOMPT', 1, NULL),
(9, 'DEPENSE ', 'gh2', 'DEPENSE', 'GHOT', 1, NULL),
(12, 'COMMERCIAL ', 'grecp1', 'COMMERCIAL', 'GRECP', 1, NULL),
(15, 'SUPER', 'SUPER', 'SUPER', 'SUPER', 2, NULL),
(23, 'PARAMETRE', 'para1', '', 'PARA', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_abonnements`
--

DROP TABLE IF EXISTS `type_abonnements`;
CREATE TABLE IF NOT EXISTS `type_abonnements` (
  `id_type_abonnement` int NOT NULL AUTO_INCREMENT,
  `code_type_abonnement` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `application_code` varchar(50) NOT NULL,
  `libelle_type_abonnement` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prix_type_abonnement` decimal(10,2) DEFAULT NULL,
  `periode_type_abonnement` varchar(100) DEFAULT NULL,
  `etat_type_abonnement` int DEFAULT '1',
  PRIMARY KEY (`id_type_abonnement`),
  UNIQUE KEY `code_type_abonement` (`code_type_abonnement`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `type_abonnements`
--

INSERT INTO `type_abonnements` (`id_type_abonnement`, `code_type_abonnement`, `application_code`, `libelle_type_abonnement`, `prix_type_abonnement`, `periode_type_abonnement`, `etat_type_abonnement`) VALUES
(13, 'SS-STARTER', 'SMARTSTOCK', 'Starter', 10000.00, 'monthly', 1),
(14, 'SS-BUSINESS', 'SMARTSTOCK', 'Business', 25000.00, 'monthly', 1),
(15, 'SS-ENTERPRISE', 'SMARTSTOCK', 'Enterprise', 60000.00, 'monthly', 1),
(16, 'SCH-STARTER', 'SMARTSCHOOL', 'Starter', 15000.00, 'monthly', 1),
(17, 'SCH-BUSINESS', 'SMARTSCHOOL', 'Business', 30000.00, 'monthly', 1),
(18, 'SCH-ENTERPRISE', 'SMARTSCHOOL', 'Enterprise', 70000.00, 'monthly', 1),
(19, 'SF-STARTER', 'SMARTFACTURE', 'Starter', 12000.00, 'monthly', 1),
(20, 'SF-BUSINESS', 'SMARTFACTURE', 'Business', 28000.00, 'monthly', 1),
(21, 'SF-ENTERPRISE', 'SMARTFACTURE', 'Enterprise', 65000.00, 'monthly', 1),
(22, 'RH-STARTER', 'SMARTRH', 'Starter', 18000.00, 'monthly', 1),
(23, 'RH-BUSINESS', 'SMARTRH', 'Business', 35000.00, 'monthly', 1),
(24, 'RH-ENTERPRISE', 'SMARTRH', 'Enterprise', 80000.00, 'monthly', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `code_user` varchar(50) NOT NULL,
  `fonction_code` varchar(50) NOT NULL,
  `nom_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prenom_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sexe_user` varchar(50) DEFAULT NULL,
  `email_user` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telephone_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `token_user` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `etat_user` int DEFAULT '0',
  `created_at_user` datetime DEFAULT NULL,
  `lastime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `code_user` (`code_user`),
  UNIQUE KEY `email` (`email_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `code_user`, `fonction_code`, `nom_user`, `prenom_user`, `sexe_user`, `email_user`, `telephone_user`, `password_user`, `token_user`, `etat_user`, `created_at_user`, `lastime`) VALUES
(1, 'US-12345', '5wBEh2OfI00frxk8ITPf', 'USER1', 'USER', NULL, 'user@gmail.com', '01663773888', '$2y$10$tI/ZB5akROUgbIXJ2JA.Huit1u5Dz1mWbUjY1NCH3lNGfxRA.NqnC', '3', 1, NULL, '2026-02-23 11:00:43'),
(6, 'jntAteTNqP1iCAQbkcgduUs8', 'Khec7SoqZWja1rUJksqbUQTsKqo', 'JOEL', 'NORMANDI', 'Mr', 'lespros1313@gmail.com', '0122334422', '$2y$10$kAYHv99F8R4xZ1paxzYYM.KrUj6081KnlTujPhRBYldO5x0nUpbma', '', 1, '2026-02-23 00:00:00', '2026-02-23 00:00:00'),
(7, 'dAyPDy25a9MVY5BItOrPh0vsp1TFIOja', '5wBEh2OfI00frxk8ITPf', 'SANOGO', 'ABOU', 'Mr', 'absanogo9@gmail.com', '0787461137', '$2y$10$n70FzN5.9K6vkQMgqGMq5uReb2.DF8iUB.Q2Ut36xbqfxdxlLyIqq', 'PjZ8ECJDKkxtoGMXG1YYc2gv3sk4Xfrq1Kq7N6mS1mB74emY5hYtf4', 0, '2026-02-23 00:00:00', '2026-02-23 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id_user_role` int NOT NULL AUTO_INCREMENT,
  `user_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `create_permission` int NOT NULL DEFAULT '0',
  `edit_permission` int NOT NULL DEFAULT '0',
  `show_permission` int NOT NULL DEFAULT '0',
  `delete_permission` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user_role`),
  UNIQUE KEY `user_id_2` (`user_code`,`role_code`),
  KEY `user_id` (`user_code`),
  KEY `role_id` (`role_code`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user_roles`
--

INSERT INTO `user_roles` (`id_user_role`, `user_code`, `role_code`, `create_permission`, `edit_permission`, `show_permission`, `delete_permission`) VALUES
(9, 'US-12345', 'ga1', 1, 1, 1, 1),
(10, 'US-12345', 'ga3', 1, 1, 1, 1),
(11, 'US-12345', 'gcom1', 1, 1, 1, 1),
(14, 'US-12345', 'gcom2', 1, 1, 1, 1),
(15, 'US-12345', 'gh1', 1, 1, 1, 1),
(16, 'US-12345', 'gh2', 1, 1, 1, 1),
(17, 'US-12345', 'grecp1', 1, 1, 1, 1),
(18, 'US-12345', 'para1', 0, 1, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
