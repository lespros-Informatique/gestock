-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 17 fév. 2026 à 13:57
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
  `adresse_boutique` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `email_boutique` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telephone_boutique` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telephone2_boutique` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `logo_boutique` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `etat_boutique` int DEFAULT '1',
  `boutique_created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_boutique`),
  UNIQUE KEY `code_boutique` (`code_boutique`),
  KEY `compte_code` (`compte_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `boutiques`
--

INSERT INTO `boutiques` (`id_boutique`, `code_boutique`, `compte_code`, `libelle_boutique`, `adresse_boutique`, `email_boutique`, `telephone_boutique`, `telephone2_boutique`, `logo_boutique`, `etat_boutique`, `boutique_created_at`) VALUES
(1, 'BTQ_001', 'CMP_001', 'BOUTIQUE CENTRALE', 'Abidjan Cocody', 'contact@boutique.ci', '0101010101', '+1 (642) 921-5139', 'logo.png', 1, '2026-01-31 16:28:28'),
(2, 'BTQ_002', 'CMP_002', 'Boutique du Marché', 'Abidjan Yopougon', 'contact@marche.ci', '0202020202', NULL, 'logo_btq2.png', 1, '2026-01-31 16:32:32'),
(3, '3IB5biEDbV', 'CMP_001', 'ACCUSAMUS CONSEQUAT', 'Consequuntur dolor u', 'zylepopyn@mailinator.com', '0102030405', '+1 (802) 813-9428', NULL, 1, '2026-02-04 14:42:01');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `code_categorie`, `boutique_code`, `libelle_categorie`, `description_categorie`, `etat_categorie`, `compte_code`) VALUES
(1, 'CAT_001', 'BTQ_001', 'Boissons', 'Boissons chic', 1, 'CMP_001'),
(2, 'CAT_101', 'BTQ_002', 'Fruits et légumes', 'Fruits frais', 1, 'CMP_002'),
(3, 'CAT_102', 'BTQ_002', 'Céréales', 'cereales doux', 1, 'CMP_002'),
(4, 'CAT_103', 'BTQ_002', 'Produits locaux', 'produits de tous genre', 1, 'CMP_002'),
(5, 'CAT-S36OV5JY', 'BTQ_001', 'LUXE', 'Sa', 1, 'CMP_001'),
(6, 'CAT-9B2SCXPV', 'BTQ_001', 'LUXE;,', 'B,bvbjq', 0, 'CMP_001'),
(7, 'CAT-123EH1VK', 'BTQ_001', 'AUCTUS QUASI SUPPONO', 'Auctus quasi suppono', 1, 'CMP_001');

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
  `sexe_client` varchar(10) NOT NULL,
  `etat_client` int DEFAULT '1',
  `compte_code` varchar(50) NOT NULL,
  `client_created_at` date NOT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `code_client` (`code_client`),
  KEY `compte_code` (`compte_code`),
  KEY `boutique_code` (`boutique_code`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_client`, `code_client`, `boutique_code`, `nom_client`, `telephone_client`, `email_client`, `sexe_client`, `etat_client`, `compte_code`, `client_created_at`) VALUES
(1, 'tF0mpgjJUtc2123NY4QAvvXOJaxC', 'BTQ_001', 'CLIENT 4', '0646546464', '', 'Mr', 1, 'CMP_001', '2026-02-02'),
(2, 'No4TJqx4MAKSd', 'BTQ_001', 'MOMO FAR', '0654564646', NULL, 'Mr', 1, 'CMP_001', '2026-02-02'),
(3, 'A2ULMF7SIFL', 'BTQ_001', 'TESTYSJSJ', '0102030405', '', 'Mme', 1, 'CMP_001', '2026-02-02'),
(4, 'scgSRkpxPOjljKXlfah', 'BTQ_001', 'MOMO FAR', '0678765456', '', 'Mlle', 1, 'CMP_001', '2026-02-02'),
(5, 'vxLsr7nv4XwSBQklowrtLrptYS4a', 'BTQ_001', 'MOMO FAR', '0666765455', NULL, 'Mlle', 1, 'CMP_001', '2026-02-02'),
(6, 'eFK2popT03', 'BTQ_001', 'MOMO FAR', '0565656565', NULL, 'Mlle', 1, 'CMP_001', '2026-02-02'),
(7, 'PFZS4h6dYRS0XHDbfyEKLKUIhZi6zg', 'BTQ_001', 'MOMO FAR', '0654594646', NULL, 'Mlle', 1, 'CMP_001', '2026-02-04'),
(8, 'dofNIrTonBi1wWo1d38ttsjbVl', 'BTQ_001', 'MOMO FAR', '0659956466', NULL, 'Mlle', 1, 'CMP_001', '2026-02-04'),
(9, 'p1T13OnWvwgttQvcA9AYdK1n0Z', 'BTQ_001', 'MOMO FAR', '0699956464', NULL, 'Mr', 1, 'CMP_001', '2026-02-04'),
(10, 'tVPaaTCdcZW0yqmoV3', 'BTQ_001', 'OPPJ KJD', '0465454654', '', 'Mr', 1, 'CMP_001', '2026-02-04');

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
-- Structure de la table `fonctions`
--

DROP TABLE IF EXISTS `fonctions`;
CREATE TABLE IF NOT EXISTS `fonctions` (
  `id_fonction` int NOT NULL AUTO_INCREMENT,
  `libelle_fonction` varchar(50) NOT NULL,
  `code_fonction` varchar(50) NOT NULL,
  `etat_fonction` int NOT NULL,
  `description_fonction` text,
  `user_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `boutique_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_fonction`),
  UNIQUE KEY `code_fonction` (`code_fonction`),
  KEY `hotel_id` (`boutique_code`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fonctions`
--

INSERT INTO `fonctions` (`id_fonction`, `libelle_fonction`, `code_fonction`, `etat_fonction`, `description_fonction`, `user_code`, `boutique_code`, `compte_code`) VALUES
(1, 'Super Administrateur', '5wBEh2OfI00frxk8ITPf', 2, NULL, NULL, 'BTQ_001', 'CMP_001'),
(2, 'Super Administrateur', 'Khec7SoqZWja1rUJksqbUQTsKqo', 2, NULL, NULL, 'BTQ_001', 'CMP_001'),
(3, 'RECEPTION', 'NmUukWPBi6uFc5SGNzv855sE', 1, '', 'Khec7SoqZWja1rUJksqbUQTsKqo', 'BTQ_001', 'CMP_001'),
(4, 'COMPTABLE', 'tuUV5fNExGRrnSVeN3fpLhcrvROR6Ka', 1, '', 'Khec7SoqZWja1rUJksqbUQTsKqo', 'BTQ_001', 'CMP_001'),
(5, 'MANAGER', 'qkmDBGDnL63BhvauhZTNPI', 1, '', '5wBEh2OfI00frxk8ITPf', 'BTQ_001', 'CMP_001'),
(6, 'COMPTA', 'y6Lfk6bC9dBDKI', 1, '', '5wBEh2OfI00frxk8ITPf', 'BTQ_001', 'CMP_001'),
(14, 'Super Administrateur', 'tIT3raq', 2, NULL, NULL, 'BTQ_001', 'CMP_001');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id_fournisseur` int NOT NULL AUTO_INCREMENT,
  `code_fournisseur` varchar(50) NOT NULL,
  `nom_fournisseur` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telephone_fournisseur` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email_fournisseur` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sexe_fournisseur` varchar(20) NOT NULL,
  `fournisseur_created_at` date NOT NULL,
  `etat_fournisseur` int DEFAULT '1',
  `boutique_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_fournisseur`),
  UNIQUE KEY `code_fournisseur` (`code_fournisseur`),
  KEY `compte_code` (`compte_code`),
  KEY `fournisseurs_ibfk_1` (`boutique_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id_fournisseur`, `code_fournisseur`, `nom_fournisseur`, `telephone_fournisseur`, `email_fournisseur`, `sexe_fournisseur`, `fournisseur_created_at`, `etat_fournisseur`, `boutique_code`, `compte_code`) VALUES
(1, 'VDqYoCFtFmQKgcrdvd7LRHj', 'COMMODO RATIONE NON 2', '0102030405', '', 'Mlle', '2026-02-04', 1, 'BTQ_001', 'CMP_001'),
(2, 'SJsL1xckxBRMUemY6ir4HqMjT1QKoJx', 'VENTOSUS ADIUVO DERIDEO', '0102030605', NULL, 'Mr', '2026-02-04', 1, 'BTQ_001', 'CMP_001'),
(3, 'tcdxEKAHSNplJliYun', 'CUM DESERUNT VEL ET', '0002350405', NULL, 'Mlle', '2026-02-04', 1, 'BTQ_001', 'CMP_001');

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
  `libelle_mark` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
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
-- Structure de la table `paiement_fournisseurs`
--

DROP TABLE IF EXISTS `paiement_fournisseurs`;
CREATE TABLE IF NOT EXISTS `paiement_fournisseurs` (
  `id_paiement_fournisseur` int NOT NULL AUTO_INCREMENT,
  `code_paiement_fournisseur` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fournisseur_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `montant_paiement_fournisseur` decimal(10,2) DEFAULT NULL,
  `created_at_paienment_fournisseur` datetime DEFAULT NULL,
  `etat_paiement_fournisseur` int DEFAULT '1',
  `user_code` varchar(50) NOT NULL,
  `compte_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_paiement_fournisseur`),
  UNIQUE KEY `code_paiement_abonnement` (`code_paiement_fournisseur`),
  KEY `compte_code` (`compte_code`),
  KEY `abonnement_code` (`fournisseur_code`)
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
-- Structure de la table `roletest`
--

DROP TABLE IF EXISTS `roletest`;
CREATE TABLE IF NOT EXISTS `roletest` (
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
-- Déchargement des données de la table `roletest`
--

INSERT INTO `roletest` (`id_role`, `libelle_role`, `code_role`, `module`, `groupe`, `etat_role`, `description`) VALUES
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
  `libelle_unite` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
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
  `nom_user` varchar(100) NOT NULL,
  `prenom_user` varchar(100) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `code_user` varchar(50) NOT NULL,
  `etat_user` int NOT NULL,
  `telephone_user` varchar(20) NOT NULL,
  `matricule_user` varchar(50) NOT NULL,
  `sexe_user` varchar(20) NOT NULL,
  `password_user` varchar(100) NOT NULL,
  `fonction_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_created_at` datetime NOT NULL,
  `token` text NOT NULL,
  `lastime` datetime NOT NULL,
  `boutique_code` varchar(50) DEFAULT NULL,
  `compte_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom_user`, `prenom_user`, `email_user`, `code_user`, `etat_user`, `telephone_user`, `matricule_user`, `sexe_user`, `password_user`, `fonction_code`, `user_created_at`, `token`, `lastime`, `boutique_code`, `compte_code`) VALUES
(1, 'REGISTER', 'First', 'a@g.com', '5wBEh2OfI00frxk8ITPf', 1, '0102030405', '5wBEh2OfI00frxk8ITPf', 'F', '$2y$10$pCnWLG5axIrjeLbQm9wxL.gd3Iisw/rf/UHs647.5IWr0tGiiZhsC', '5wBEh2OfI00frxk8ITPf', '2025-09-25 00:00:57', '', '2026-02-13 20:18:14', 'BTQ_001', 'CMP_001'),
(2, 'ELIGENDI REGISTER  EXPEDITA SI', 'FACILIS ET QUI TEMPO', 'a1@g.com', 'TRTlf4csv6ffDa3cLvPeb7wxBaDv', 1, '(+225) 01 43 91 71 9', 'RERUM SIT SIT REPRE', 'Mlle', '$2y$10$pCnWLG5axIrjeLbQm9wxL.gd3Iisw/rf/UHs647.5IWr0tGiiZhsC', 'qkmDBGDnL63BhvauhZTNPI', '2026-02-08 00:00:00', '5V9Mb4Cf8GX6qikaMcysU2ZonGfT6OuXsFxMhpP0tLInQu5pfYw9B269oim1', '2026-02-08 00:00:00', 'BTQ_001', 'CMP_001'),
(3, 'ODIO CUMQUE NON SIT', 'EST IMPEDIT ADIPISC', 'a2@g.com', 'QkkGHS69JByaYwUWlCJTVYFGOVFJPi', 1, '(+225) 01 29 62 54 9', 'PROVIDENT UT SUNT', 'Mr', '$2y$10$pCnWLG5axIrjeLbQm9wxL.gd3Iisw/rf/UHs647.5IWr0tGiiZhsC', 'y6Lfk6bC9dBDKI', '2026-02-08 00:00:00', 'nJRIPXz2Npx1Z8AqtYkRzl958O9GHzQRC3RmIQ2COAYs9xJUuI1Om6soBgYNx', '2026-02-08 00:00:00', 'BTQ_001', 'CMP_001'),
(4, 'ULLAMCO VOLUPTATEM B', 'EXCEPTEUR AUT AUTEM', 'a3@g.com', 'sSIpufrVz', 1, '(+225) 01 79 75 14 6', 'APERIAM EXCEPTEUR SU', 'Mme', '$2y$10$pCnWLG5axIrjeLbQm9wxL.gd3Iisw/rf/UHs647.5IWr0tGiiZhsC', 'qkmDBGDnL63BhvauhZTNPI', '2026-02-08 00:00:00', 'saPhBgm5PI5XPemK4oz1T6g73VCUxi8owk6vhoQXcjp8zjzsghqcr1zJ1QvmPkGeGwjT6C', '2026-02-08 00:00:00', 'BTQ_001', 'CMP_001'),
(5, 'AUTE DOLORES QUOD PR', 'DICTA REGISTER NIHIL ET ASSUM', 'jycohapiry@mailinator.com', 'M0nb38co8A2fkbjz', 1, '(+225) 01 32 86 17 3', 'FUGIT CUM NESCIUNT', 'Mr', '$2y$10$CPfOB1zqraUEiM3nHxUHgu0bw6PWG3KJJseoElyGcPpb2CZ/5Odri', 'qkmDBGDnL63BhvauhZTNPI', '2026-02-08 00:00:00', 'gi0bf0O6SdP7G6GAB01wOXRsbd3XnKEaX1AOeFHcTBWv90tr8ZwHeNwvL', '2026-02-08 00:00:00', 'BTQ_001', 'CMP_001'),
(6, 'POSSIMUS EUM REGISTER NULLA', 'CONSECTETUR SED TEMP', 'qajikawe@mailinator.com', 'Cy6YUuVWf4qP4ay', 1, '(+225) 01 26 24 84 4', 'EOS NISI OPTIO ELIT', 'Mr', '$2y$10$1ZVhDxIG6f8SCGNKC7SUnO.C3sSqISmT50Ko9jQkPmwYKK0CER8Am', 'NmUukWPBi6uFc5SGNzv855sE', '2026-02-08 00:00:00', 'JhFNiNC0ly5VKvZKEPxJKbc2pXNCqqPgw5mb35Fs80QhMZDFtapH8Seks9eLoZxjsfzQY', '2026-02-08 00:00:00', 'BTQ_001', 'CMP_001');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user_roles`
--

INSERT INTO `user_roles` (`id_user_role`, `user_code`, `role_code`, `create_permission`, `edit_permission`, `show_permission`, `delete_permission`) VALUES
(1, '5wBEh2OfI00frxk8ITPf', 'sup1', 1, 1, 1, 1),
(2, '5wBEh2OfI00frxk8ITPf', 'para1', 1, 1, 1, 1),
(3, '5wBEh2OfI00frxk8ITPf', 'ga1', 1, 1, 1, 1),
(4, '5wBEh2OfI00frxk8ITPf', 'ga2', 1, 1, 1, 1),
(5, 'Khec7SoqZWja1rUJksqbUQTsKqo', 'sup1', 1, 1, 1, 1),
(6, 'Khec7SoqZWja1rUJksqbUQTsKqo', 'ga1', 1, 0, 0, 0),
(7, 'Khec7SoqZWja1rUJksqbUQTsKqo', 'ga2', 1, 1, 1, 1),
(8, 'Khec7SoqZWja1rUJksqbUQTsKqo', 'ga3', 1, 0, 0, 0);

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
-- Structure de la table `versement_ventes`
--

DROP TABLE IF EXISTS `versement_ventes`;
CREATE TABLE IF NOT EXISTS `versement_ventes` (
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
