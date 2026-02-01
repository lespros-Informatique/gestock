-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 01 fév. 2026 à 17:27
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
-- Base de données : `db_gestocks`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

DROP TABLE IF EXISTS `achats`;
CREATE TABLE IF NOT EXISTS `achats` (
  `id_achat` int NOT NULL AUTO_INCREMENT,
  `code_achat` varchar(50) NOT NULL,
  `boutique_code` varchar(50) DEFAULT NULL,
  `fournisseur_code` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `etat_achat` int DEFAULT '1',
  `statut_achat` int DEFAULT '0',
  `reception` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_achat`),
  UNIQUE KEY `code_achat` (`code_achat`),
  KEY `compte_code` (`compte_code`),
  KEY `boutique_code` (`boutique_code`),
  KEY `fournisseur_code` (`fournisseur_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avantages`
--

DROP TABLE IF EXISTS `avantages`;
CREATE TABLE IF NOT EXISTS `avantages` (
  `id_avantage` int NOT NULL AUTO_INCREMENT,
  `code_avantage` varchar(50) NOT NULL,
  `type_abonnement_code` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `valeur` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `etat_avantage` int DEFAULT '1',
  PRIMARY KEY (`id_avantage`),
  UNIQUE KEY `code_avantage` (`code_avantage`),
  KEY `type_abonnement_code` (`type_abonnement_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `boutiques`
--

DROP TABLE IF EXISTS `boutiques`;
CREATE TABLE IF NOT EXISTS `boutiques` (
  `id_boutique` int NOT NULL AUTO_INCREMENT,
  `code_boutique` varchar(50) NOT NULL,
  `compte_code` varchar(50) NOT NULL,
  `libelle_boutique` varchar(150) DEFAULT NULL,
  `adresse` text,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `etat_boutique` int DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_boutique`),
  UNIQUE KEY `code_boutique` (`code_boutique`),
  KEY `compte_code` (`compte_code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `boutiques`
--

INSERT INTO `boutiques` (`id_boutique`, `code_boutique`, `compte_code`, `libelle_boutique`, `adresse`, `email`, `telephone`, `logo`, `etat_boutique`, `created_at`) VALUES
(1, 'BTQ_001', 'CMP_001', 'Boutique Centrale', 'Abidjan Cocody', 'contact@boutique.ci', '0101010101', 'logo.png', 1, '2026-01-31 16:28:28'),
(2, 'BTQ_002', 'CMP_002', 'Boutique du Marché', 'Abidjan Yopougon', 'contact@marche.ci', '0202020202', 'logo_btq2.png', 1, '2026-01-31 16:32:32');

-- --------------------------------------------------------

--
-- Structure de la table `caisses`
--

DROP TABLE IF EXISTS `caisses`;
CREATE TABLE IF NOT EXISTS `caisses` (
  `id_caisse` int NOT NULL AUTO_INCREMENT,
  `code_caisse` varchar(50) NOT NULL,
  `user_code` varchar(50) DEFAULT NULL,
  `ouverture` datetime DEFAULT NULL,
  `cloture` datetime DEFAULT NULL,
  `montant_total_caisse` int DEFAULT NULL,
  `montant_cloture_caisse` int DEFAULT NULL,
  `date_confirme` datetime DEFAULT NULL,
  `user_confrime` varchar(50) DEFAULT NULL,
  `etat_caisse` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_caisse`),
  UNIQUE KEY `code_caisse` (`code_caisse`),
  KEY `compte_code` (`compte_code`),
  KEY `user_code` (`user_code`),
  KEY `user_confrime` (`user_confrime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `code_categorie` varchar(50) NOT NULL,
  `boutique_code` varchar(50) NOT NULL,
  `libelle_categorie` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description_categorie` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `etat_categorie` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`),
  UNIQUE KEY `code_categorie` (`code_categorie`),
  KEY `compte_code` (`compte_code`),
  KEY `boutique_code` (`boutique_code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `code_categorie`, `boutique_code`, `libelle_categorie`, `description_categorie`, `etat_categorie`, `compte_code`) VALUES
(1, 'CAT_001', 'BTQ_001', 'Boissons', 'Boissons chic', 1, 'CMP_001'),
(2, 'CAT_101', 'BTQ_002', 'Fruits et légumes', 'Fruits frais', 1, 'CMP_002'),
(3, 'CAT_102', 'BTQ_002', 'Céréales', 'cereales doux', 1, 'CMP_002'),
(4, 'CAT_103', 'BTQ_002', 'Produits locaux', 'produits de tous genre', 1, 'CMP_002'),
(5, 'CAT-S36OV5JY', 'BTQ_001', 'LUXE', 'Sa', 1, 'CMP_001'),
(6, 'CAT-9B2SCXPV', 'BTQ_001', 'LUXE;,', 'B,bvbjq', 0, 'CMP_001');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `code_client` varchar(50) NOT NULL,
  `boutique_code` varchar(50) NOT NULL,
  `nom_client` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telephone_client` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email_client` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `etat_client` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `code_client` (`code_client`),
  KEY `compte_code` (`compte_code`),
  KEY `boutique_code` (`boutique_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id_compte` int NOT NULL AUTO_INCREMENT,
  `code_compte` varchar(50) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(225) DEFAULT NULL,
  `etat_compte` int DEFAULT '0',
  `created_at_compte` datetime DEFAULT NULL,
  PRIMARY KEY (`id_compte`),
  UNIQUE KEY `code_compte` (`code_compte`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id_compte`, `code_compte`, `nom`, `prenom`, `email`, `telephone`, `password`, `token`, `etat_compte`, `created_at_compte`) VALUES
(1, 'CMP_001', 'KOUAME', 'Jean', 'jean.kouame@email.com', '0700000000', 'hashed_password_here', 'token_example_123', 1, '2026-01-31 16:28:15'),
(2, 'CMP_002', 'TRAORE', 'Moussa', 'moussa.traore@email.com', '0755555555', 'hashed_password_here_2', 'token_example_456', 1, '2026-01-31 16:32:22');

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

DROP TABLE IF EXISTS `depenses`;
CREATE TABLE IF NOT EXISTS `depenses` (
  `id_depense` int NOT NULL AUTO_INCREMENT,
  `code_depense` varchar(50) NOT NULL,
  `boutique_code` varchar(50) DEFAULT NULL,
  `type_depense_code` varchar(50) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `date_depense` datetime DEFAULT NULL,
  `etat_depense` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_depense`),
  UNIQUE KEY `code_depense` (`code_depense`),
  KEY `compte_code` (`compte_code`),
  KEY `boutique_code` (`boutique_code`),
  KEY `type_depense_code` (`type_depense_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id_fournisseur` int NOT NULL AUTO_INCREMENT,
  `code_fournisseur` varchar(50) NOT NULL,
  `nom` varchar(150) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `etat_fournisseur` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_fournisseur`),
  UNIQUE KEY `code_fournisseur` (`code_fournisseur`),
  KEY `compte_code` (`compte_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_achats`
--

DROP TABLE IF EXISTS `ligne_achats`;
CREATE TABLE IF NOT EXISTS `ligne_achats` (
  `id_ligne_achat` int NOT NULL AUTO_INCREMENT,
  `code_ligne_achat` varchar(50) NOT NULL,
  `achat_code` varchar(50) NOT NULL,
  `produit_code` varchar(50) NOT NULL,
  `quantite` int NOT NULL,
  `prix_achat` decimal(10,2) NOT NULL,
  `total_achat` decimal(12,2) GENERATED ALWAYS AS ((`quantite` * `prix_achat`)) STORED,
  `etat_ligne_achat` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ligne_achat`),
  UNIQUE KEY `code_ligne_achat` (`code_ligne_achat`),
  KEY `compte_code` (`compte_code`),
  KEY `achat_code` (`achat_code`),
  KEY `produit_code` (`produit_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_ventes`
--

DROP TABLE IF EXISTS `ligne_ventes`;
CREATE TABLE IF NOT EXISTS `ligne_ventes` (
  `id_ligne_vente` int NOT NULL AUTO_INCREMENT,
  `code_ligne_vente` varchar(50) NOT NULL,
  `vente_code` varchar(50) NOT NULL,
  `produit_code` varchar(50) NOT NULL,
  `quantite` int NOT NULL,
  `prix_vente` decimal(10,2) NOT NULL,
  `total` decimal(12,2) GENERATED ALWAYS AS ((`quantite` * `prix_vente`)) STORED,
  `etat_ligne_vente` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ligne_vente`),
  UNIQUE KEY `code_ligne_vente` (`code_ligne_vente`),
  KEY `compte_code` (`compte_code`),
  KEY `vente_code` (`vente_code`),
  KEY `produit_code` (`produit_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `marks`
--

DROP TABLE IF EXISTS `marks`;
CREATE TABLE IF NOT EXISTS `marks` (
  `id_mark` int NOT NULL AUTO_INCREMENT,
  `code_mark` varchar(50) NOT NULL,
  `boutique_code` varchar(50) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `etat_mark` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mark`),
  UNIQUE KEY `code_mark` (`code_mark`),
  KEY `compte_code` (`compte_code`),
  KEY `boutique_code` (`boutique_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement_abonnements`
--

DROP TABLE IF EXISTS `paiement_abonnements`;
CREATE TABLE IF NOT EXISTS `paiement_abonnements` (
  `id_paiement_abonnement` int NOT NULL AUTO_INCREMENT,
  `code_paiement_abonnement` varchar(50) NOT NULL,
  `abonnement_code` varchar(50) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `date_paiement` datetime DEFAULT NULL,
  `etat_abonnement` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_paiement_abonnement`),
  UNIQUE KEY `code_paiement_abonnement` (`code_paiement_abonnement`),
  KEY `compte_code` (`compte_code`),
  KEY `abonnement_code` (`abonnement_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `code_produit` varchar(50) NOT NULL,
  `code_bar` varchar(100) DEFAULT NULL,
  `boutique_code` varchar(50) NOT NULL,
  `categorie_code` varchar(50) DEFAULT NULL,
  `mark_code` varchar(50) DEFAULT NULL,
  `unite_code` varchar(50) DEFAULT NULL,
  `libelle_produit` varchar(150) DEFAULT NULL,
  `prix_achat` decimal(10,2) DEFAULT NULL,
  `prix_vente` decimal(10,2) DEFAULT NULL,
  `garantie_produit` int DEFAULT NULL,
  `stock_produit` int DEFAULT NULL,
  `etat_produit` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_produit`),
  UNIQUE KEY `code_produit` (`code_produit`),
  KEY `compte_code` (`compte_code`),
  KEY `boutique_code` (`boutique_code`),
  KEY `categorie_code` (`categorie_code`),
  KEY `mark_code` (`mark_code`),
  KEY `unite_code` (`unite_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `code_role` varchar(50) NOT NULL,
  `libelle_role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `code_role` (`code_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
CREATE TABLE IF NOT EXISTS `role_users` (
  `id_role_user` int NOT NULL AUTO_INCREMENT,
  `code_role_user` varchar(50) NOT NULL,
  `user_code` varchar(50) NOT NULL,
  `role_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role_user`),
  UNIQUE KEY `code_role_user` (`code_role_user`),
  KEY `user_code` (`user_code`),
  KEY `role_code` (`role_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_abonements`
--

DROP TABLE IF EXISTS `type_abonements`;
CREATE TABLE IF NOT EXISTS `type_abonements` (
  `id_type_abonement` int NOT NULL AUTO_INCREMENT,
  `code_type_abonement` varchar(50) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `duree_mois` int DEFAULT NULL,
  `etat_type_abonnement` int DEFAULT '1',
  PRIMARY KEY (`id_type_abonement`),
  UNIQUE KEY `code_type_abonement` (`code_type_abonement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_depenses`
--

DROP TABLE IF EXISTS `type_depenses`;
CREATE TABLE IF NOT EXISTS `type_depenses` (
  `id_type_depense` int NOT NULL AUTO_INCREMENT,
  `code_type_depense` varchar(50) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `etat_type_depense` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type_depense`),
  UNIQUE KEY `code_type_depense` (`code_type_depense`),
  KEY `compte_code` (`compte_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

DROP TABLE IF EXISTS `unites`;
CREATE TABLE IF NOT EXISTS `unites` (
  `id_unite` int NOT NULL AUTO_INCREMENT,
  `code_unite` varchar(50) NOT NULL,
  `boutique_code` varchar(50) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `etat_unite` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_unite`),
  UNIQUE KEY `code_unite` (`code_unite`),
  KEY `compte_code` (`compte_code`),
  KEY `boutique_code` (`boutique_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `code_user` varchar(50) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(225) DEFAULT NULL,
  `etat_user` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `code_user` (`code_user`),
  UNIQUE KEY `email` (`email`),
  KEY `compte_code` (`compte_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

DROP TABLE IF EXISTS `ventes`;
CREATE TABLE IF NOT EXISTS `ventes` (
  `id_vente` int NOT NULL AUTO_INCREMENT,
  `code_vente` varchar(50) NOT NULL,
  `boutique_code` varchar(50) DEFAULT NULL,
  `client_code` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `etat_vente` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_vente`),
  UNIQUE KEY `code_vente` (`code_vente`),
  KEY `compte_code` (`compte_code`),
  KEY `boutique_code` (`boutique_code`),
  KEY `client_code` (`client_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `versements_ventes`
--

DROP TABLE IF EXISTS `versements_ventes`;
CREATE TABLE IF NOT EXISTS `versements_ventes` (
  `id_versement_vente` int NOT NULL AUTO_INCREMENT,
  `code_versement_vente` varchar(50) NOT NULL,
  `vente_code` varchar(50) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `date_versement` datetime DEFAULT NULL,
  `user_code` varchar(50) DEFAULT NULL,
  `boutique_code` varchar(50) DEFAULT NULL,
  `compte_code` varchar(50) DEFAULT NULL,
  `etat_versement_vente` int DEFAULT '1',
  PRIMARY KEY (`id_versement_vente`),
  UNIQUE KEY `code_versement_vente` (`code_versement_vente`),
  KEY `vente_code` (`vente_code`),
  KEY `user_code` (`user_code`),
  KEY `boutique_code` (`boutique_code`),
  KEY `compte_code` (`compte_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD CONSTRAINT `abonnements_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `abonnements_ibfk_2` FOREIGN KEY (`type_abonnement_code`) REFERENCES `type_abonements` (`code_type_abonement`);

--
-- Contraintes pour la table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `achats_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `achats_ibfk_2` FOREIGN KEY (`boutique_code`) REFERENCES `boutiques` (`code_boutique`),
  ADD CONSTRAINT `achats_ibfk_3` FOREIGN KEY (`fournisseur_code`) REFERENCES `fournisseurs` (`code_fournisseur`);

--
-- Contraintes pour la table `avantages`
--
ALTER TABLE `avantages`
  ADD CONSTRAINT `avantages_ibfk_1` FOREIGN KEY (`type_abonnement_code`) REFERENCES `type_abonements` (`code_type_abonement`);

--
-- Contraintes pour la table `boutiques`
--
ALTER TABLE `boutiques`
  ADD CONSTRAINT `boutiques_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`);

--
-- Contraintes pour la table `caisses`
--
ALTER TABLE `caisses`
  ADD CONSTRAINT `caisses_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `caisses_ibfk_2` FOREIGN KEY (`user_code`) REFERENCES `users` (`code_user`),
  ADD CONSTRAINT `caisses_ibfk_3` FOREIGN KEY (`user_confrime`) REFERENCES `users` (`code_user`);

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`boutique_code`) REFERENCES `boutiques` (`code_boutique`);

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`boutique_code`) REFERENCES `boutiques` (`code_boutique`);

--
-- Contraintes pour la table `depenses`
--
ALTER TABLE `depenses`
  ADD CONSTRAINT `depenses_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `depenses_ibfk_2` FOREIGN KEY (`boutique_code`) REFERENCES `boutiques` (`code_boutique`),
  ADD CONSTRAINT `depenses_ibfk_3` FOREIGN KEY (`type_depense_code`) REFERENCES `type_depenses` (`code_type_depense`);

--
-- Contraintes pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD CONSTRAINT `fournisseurs_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`);

--
-- Contraintes pour la table `ligne_achats`
--
ALTER TABLE `ligne_achats`
  ADD CONSTRAINT `ligne_achats_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `ligne_achats_ibfk_2` FOREIGN KEY (`achat_code`) REFERENCES `achats` (`code_achat`),
  ADD CONSTRAINT `ligne_achats_ibfk_3` FOREIGN KEY (`produit_code`) REFERENCES `produits` (`code_produit`);

--
-- Contraintes pour la table `ligne_ventes`
--
ALTER TABLE `ligne_ventes`
  ADD CONSTRAINT `ligne_ventes_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `ligne_ventes_ibfk_2` FOREIGN KEY (`vente_code`) REFERENCES `ventes` (`code_vente`),
  ADD CONSTRAINT `ligne_ventes_ibfk_3` FOREIGN KEY (`produit_code`) REFERENCES `produits` (`code_produit`);

--
-- Contraintes pour la table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`boutique_code`) REFERENCES `boutiques` (`code_boutique`);

--
-- Contraintes pour la table `paiement_abonnements`
--
ALTER TABLE `paiement_abonnements`
  ADD CONSTRAINT `paiement_abonnements_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `paiement_abonnements_ibfk_2` FOREIGN KEY (`abonnement_code`) REFERENCES `abonnements` (`code_abonnement`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`boutique_code`) REFERENCES `boutiques` (`code_boutique`),
  ADD CONSTRAINT `produits_ibfk_3` FOREIGN KEY (`categorie_code`) REFERENCES `categories` (`code_categorie`),
  ADD CONSTRAINT `produits_ibfk_4` FOREIGN KEY (`mark_code`) REFERENCES `marks` (`code_mark`),
  ADD CONSTRAINT `produits_ibfk_5` FOREIGN KEY (`unite_code`) REFERENCES `unites` (`code_unite`);

--
-- Contraintes pour la table `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_ibfk_1` FOREIGN KEY (`user_code`) REFERENCES `users` (`code_user`),
  ADD CONSTRAINT `role_users_ibfk_2` FOREIGN KEY (`role_code`) REFERENCES `roles` (`code_role`);

--
-- Contraintes pour la table `type_depenses`
--
ALTER TABLE `type_depenses`
  ADD CONSTRAINT `type_depenses_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`);

--
-- Contraintes pour la table `unites`
--
ALTER TABLE `unites`
  ADD CONSTRAINT `unites_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `unites_ibfk_2` FOREIGN KEY (`boutique_code`) REFERENCES `boutiques` (`code_boutique`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`);

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `ventes_ibfk_1` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`),
  ADD CONSTRAINT `ventes_ibfk_2` FOREIGN KEY (`boutique_code`) REFERENCES `boutiques` (`code_boutique`),
  ADD CONSTRAINT `ventes_ibfk_3` FOREIGN KEY (`client_code`) REFERENCES `clients` (`code_client`);

--
-- Contraintes pour la table `versements_ventes`
--
ALTER TABLE `versements_ventes`
  ADD CONSTRAINT `versements_ventes_ibfk_1` FOREIGN KEY (`vente_code`) REFERENCES `ventes` (`code_vente`),
  ADD CONSTRAINT `versements_ventes_ibfk_2` FOREIGN KEY (`user_code`) REFERENCES `users` (`code_user`),
  ADD CONSTRAINT `versements_ventes_ibfk_3` FOREIGN KEY (`boutique_code`) REFERENCES `boutiques` (`code_boutique`),
  ADD CONSTRAINT `versements_ventes_ibfk_4` FOREIGN KEY (`compte_code`) REFERENCES `comptes` (`code_compte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
