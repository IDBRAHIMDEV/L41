-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.5.20-log - MySQL Community Server (GPL)
-- Serveur OS:                   Win32
-- HeidiSQL Version:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la base pour ecg_sav_virtuel
DROP DATABASE IF EXISTS `ecg_sav_virtuel`;
CREATE DATABASE IF NOT EXISTS `ecg_sav_virtuel` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ecg_sav_virtuel`;


-- Export de la structure de table ecg_sav_virtuel. actions
DROP TABLE IF EXISTS `actions`;
CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.actions: ~0 rows (environ)
/*!40000 ALTER TABLE `actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `actions` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. attributes
DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.attributes: ~0 rows (environ)
/*!40000 ALTER TABLE `attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `attributes` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. compagnies
DROP TABLE IF EXISTS `compagnies`;
CREATE TABLE IF NOT EXISTS `compagnies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.compagnies: ~0 rows (environ)
/*!40000 ALTER TABLE `compagnies` DISABLE KEYS */;
/*!40000 ALTER TABLE `compagnies` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. comptes
DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `civilite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailpro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailpers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `connexion` datetime NOT NULL,
  `compteur` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.comptes: ~1 rows (environ)
/*!40000 ALTER TABLE `comptes` DISABLE KEYS */;
INSERT INTO `comptes` (`id`, `civilite`, `nom`, `prenom`, `emailpro`, `emailpers`, `password`, `etat`, `connexion`, `compteur`, `created_at`, `updated_at`) VALUES
	(1, 'M', 'IDBRAHIM', 'Mohamed', '', '', '123', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `comptes` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. contratattributes
DROP TABLE IF EXISTS `contratattributes`;
CREATE TABLE IF NOT EXISTS `contratattributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contrat_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `valeur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.contratattributes: ~0 rows (environ)
/*!40000 ALTER TABLE `contratattributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `contratattributes` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. contrats
DROP TABLE IF EXISTS `contrats`;
CREATE TABLE IF NOT EXISTS `contrats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contratecg` int(11) NOT NULL,
  `avenant` int(11) NOT NULL,
  `contratcie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `compagnie_id` int(11) NOT NULL,
  `formule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateeffet` date NOT NULL,
  `dateecheance` date NOT NULL,
  `situation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datesituation` date NOT NULL,
  `prime` float(8,2) NOT NULL,
  `datecontrat` date NOT NULL,
  `conseiller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datevalidation` date NOT NULL,
  `dernieravenant` tinyint(1) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `compte_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.contrats: ~0 rows (environ)
/*!40000 ALTER TABLE `contrats` DISABLE KEYS */;
/*!40000 ALTER TABLE `contrats` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. docs
DROP TABLE IF EXISTS `docs`;
CREATE TABLE IF NOT EXISTS `docs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `obligatoire` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.docs: ~0 rows (environ)
/*!40000 ALTER TABLE `docs` DISABLE KEYS */;
/*!40000 ALTER TABLE `docs` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. docsmotifs
DROP TABLE IF EXISTS `docsmotifs`;
CREATE TABLE IF NOT EXISTS `docsmotifs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `motif_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.docsmotifs: ~0 rows (environ)
/*!40000 ALTER TABLE `docsmotifs` DISABLE KEYS */;
/*!40000 ALTER TABLE `docsmotifs` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. documents
DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reclamation_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.documents: ~0 rows (environ)
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `destinataire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `type_message_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.messages: ~0 rows (environ)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.migrations: ~18 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2013_09_10_082815_help', 1),
	('2013_10_07_115412_create_users_table', 1),
	('2013_10_08_115836_create_produits_table', 1),
	('2013_10_08_120410_create_comptes_table', 1),
	('2013_10_08_121503_create_typesmessage_table', 1),
	('2013_10_08_121724_create_typesdemandes_table', 2),
	('2013_10_08_122016_create_motifsdemandes_table', 2),
	('2013_10_08_122424_create_docs_table', 2),
	('2013_10_08_142656_create_contrats_table', 2),
	('2013_10_08_143652_create_messages_table', 2),
	('2013_10_08_144254_create_documents_table', 2),
	('2013_10_08_144641_create_reclamations_table', 2),
	('2013_10_08_144954_create_actions_table', 2),
	('2013_10_08_145145_create_traces_table', 2),
	('2013_10_08_153231_create_compagnies_table', 2),
	('2013_10_09_105233_create_docsmotifs_table', 3),
	('2013_10_09_112417_create_attributes_table', 4),
	('2013_10_09_112538_create_contratattributes_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. motifsdemandes
DROP TABLE IF EXISTS `motifsdemandes`;
CREATE TABLE IF NOT EXISTS `motifsdemandes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `type_demande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.motifsdemandes: ~0 rows (environ)
/*!40000 ALTER TABLE `motifsdemandes` DISABLE KEYS */;
/*!40000 ALTER TABLE `motifsdemandes` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. produits
DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.produits: ~1 rows (environ)
/*!40000 ALTER TABLE `produits` DISABLE KEYS */;
INSERT INTO `produits` (`id`, `label`, `description`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'Santé', 'Produit Santé', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `produits` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. reclamations
DROP TABLE IF EXISTS `reclamations`;
CREATE TABLE IF NOT EXISTS `reclamations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lu` tinyint(1) NOT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motif_id` int(11) NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.reclamations: ~0 rows (environ)
/*!40000 ALTER TABLE `reclamations` DISABLE KEYS */;
/*!40000 ALTER TABLE `reclamations` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. traces
DROP TABLE IF EXISTS `traces`;
CREATE TABLE IF NOT EXISTS `traces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.traces: ~0 rows (environ)
/*!40000 ALTER TABLE `traces` DISABLE KEYS */;
/*!40000 ALTER TABLE `traces` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. typesdemandes
DROP TABLE IF EXISTS `typesdemandes`;
CREATE TABLE IF NOT EXISTS `typesdemandes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.typesdemandes: ~0 rows (environ)
/*!40000 ALTER TABLE `typesdemandes` DISABLE KEYS */;
/*!40000 ALTER TABLE `typesdemandes` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. typesmessages
DROP TABLE IF EXISTS `typesmessages`;
CREATE TABLE IF NOT EXISTS `typesmessages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `indice` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.typesmessages: ~0 rows (environ)
/*!40000 ALTER TABLE `typesmessages` DISABLE KEYS */;
/*!40000 ALTER TABLE `typesmessages` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.users: ~1 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
	(3, 'IDBRAHIM', '$2y$08$XI47MgVuGHUj67xn7Bp.kuOqD6LFaYlAQS87QdJT5tUsckDKKXTFu', '2013-10-31 11:50:05', '2013-10-31 11:50:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
