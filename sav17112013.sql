-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.6.12-log - MySQL Community Server (GPL)
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


-- Export de la structure de table ecg_sav_virtuel. compagnies
DROP TABLE IF EXISTS `compagnies`;
CREATE TABLE IF NOT EXISTS `compagnies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `chemin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.compagnies: ~2 rows (environ)
/*!40000 ALTER TABLE `compagnies` DISABLE KEYS */;
INSERT INTO `compagnies` (`id`, `libelle`, `code`, `chemin`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'CEGEMA', 'CGM', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'ASAF', 'ASF', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'ALPTIS', 'ALP', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `compagnies` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. conjoints
DROP TABLE IF EXISTS `conjoints`;
CREATE TABLE IF NOT EXISTS `conjoints` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `datenaissance` date NOT NULL,
  `sexe` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `regime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.conjoints: ~0 rows (environ)
/*!40000 ALTER TABLE `conjoints` DISABLE KEYS */;
INSERT INTO `conjoints` (`id`, `nom`, `prenom`, `datenaissance`, `sexe`, `regime`, `contrat_id`, `created_at`, `updated_at`) VALUES
	(1, 'MEDGHALI', 'Samira', '1986-04-23', 'F', 'Sécurité Sociale', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `conjoints` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. contrats
DROP TABLE IF EXISTS `contrats`;
CREATE TABLE IF NOT EXISTS `contrats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contratecg` int(11) NOT NULL,
  `avenant` int(11) NOT NULL,
  `contratcie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gamme_id` int(11) NOT NULL,
  `formule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateeffet` date NOT NULL,
  `dateecheance` date NOT NULL,
  `situation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datesituation` date NOT NULL,
  `prime` float(8,2) NOT NULL,
  `offert` int(2) NOT NULL DEFAULT '0',
  `datecontrat` date NOT NULL,
  `conseiller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datevalidation` date NOT NULL,
  `dernieravenant` tinyint(1) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.contrats: ~2 rows (environ)
/*!40000 ALTER TABLE `contrats` DISABLE KEYS */;
INSERT INTO `contrats` (`id`, `contratecg`, `avenant`, `contratcie`, `gamme_id`, `formule`, `dateeffet`, `dateecheance`, `situation`, `datesituation`, `prime`, `offert`, `datecontrat`, `conseiller`, `datevalidation`, `dernieravenant`, `produit_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 600045871, 0, 'SER5487RR', 1, 'DSL', '2013-11-16', '0000-00-00', '', '0000-00-00', 1458.52, 0, '0000-00-00', '', '0000-00-00', 0, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 800014785, 0, 'CDFR6985GT', 2, 'VTN', '2014-01-14', '2014-12-31', '', '0000-00-00', 890.25, 0, '0000-00-00', '', '0000-00-00', 0, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.docs: ~6 rows (environ)
/*!40000 ALTER TABLE `docs` DISABLE KEYS */;
INSERT INTO `docs` (`id`, `label`, `description`, `obligatoire`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'Prise en charge', 'Prise en charge', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'Allocation familiale', 'Allocation familiale', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'Carte d\'identité', 'Carte d\'identité nationale', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 'Carte bleue', 'Carte bleue', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 'Certificat médical', 'Certificat médical', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 'Attestation de travail', 'Attestation de travail', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.docsmotifs: ~37 rows (environ)
/*!40000 ALTER TABLE `docsmotifs` DISABLE KEYS */;
INSERT INTO `docsmotifs` (`id`, `motif_id`, `doc_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 2, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(7, 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, 3, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(9, 3, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(10, 3, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(11, 3, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(12, 4, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(13, 4, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(14, 5, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(15, 5, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(16, 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(17, 6, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(18, 6, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(19, 6, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(20, 7, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(21, 8, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(22, 8, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(23, 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(24, 9, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(25, 9, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(26, 9, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(27, 9, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(28, 9, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(29, 10, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(30, 10, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(31, 11, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(32, 75, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(33, 76, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(34, 77, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(35, 78, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(36, 79, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(37, 80, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.documents: ~7 rows (environ)
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` (`id`, `doc_id`, `path`, `observation`, `reclamation_id`, `created_at`, `updated_at`) VALUES
	(72, 1, 'uploads/2/40/161109336-Laravel-Starter-eBook.pdf', '', 40, '2013-11-16 19:38:40', '2013-11-16 19:38:40'),
	(73, 2, 'uploads/2/40/Copie De Id Brahim Bouchra cv.doc', '', 40, '2013-11-16 19:38:40', '2013-11-16 19:38:40'),
	(74, 6, 'uploads/2/40/laravel4cookbook-sample (1).pdf', '', 40, '2013-11-16 19:38:40', '2013-11-16 19:38:40'),
	(75, 1, 'uploads/2/41/Copie De Id Brahim Bouchra cv.doc', '', 41, '2013-11-16 19:39:45', '2013-11-16 19:39:45'),
	(79, 2, 'uploads/500074102/43/l4.pdf', '', 43, '2013-11-16 19:57:03', '2013-11-16 19:57:03'),
	(80, 3, 'uploads/500074102/42/l4.pdf', '', 42, '2013-11-16 19:57:47', '2013-11-16 19:57:47'),
	(81, 1, 'uploads/1/38/MOTIF.csv', '', 38, '2013-11-16 20:01:19', '2013-11-16 20:01:19'),
	(82, 1, 'uploads/2/39/Copie De Id Brahim Bouchra cv.doc', '', 39, '2013-11-16 20:05:02', '2013-11-16 20:05:02');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. enfants
DROP TABLE IF EXISTS `enfants`;
CREATE TABLE IF NOT EXISTS `enfants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `datenaissance` date NOT NULL,
  `sexe` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.enfants: ~2 rows (environ)
/*!40000 ALTER TABLE `enfants` DISABLE KEYS */;
INSERT INTO `enfants` (`id`, `nom`, `prenom`, `datenaissance`, `sexe`, `contrat_id`, `created_at`, `updated_at`) VALUES
	(1, 'IDBRAHIM', 'Basma', '2013-09-30', 'F', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'IDBRAHIM', 'Walid', '2013-11-16', 'M', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `enfants` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. gammes
DROP TABLE IF EXISTS `gammes`;
CREATE TABLE IF NOT EXISTS `gammes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `compagnie_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.gammes: ~2 rows (environ)
/*!40000 ALTER TABLE `gammes` DISABLE KEYS */;
INSERT INTO `gammes` (`id`, `libelle`, `code`, `active`, `compagnie_id`, `created_at`, `updated_at`) VALUES
	(1, 'Dosilia', 'DSL', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'VITANIO', 'VTN', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `gammes` ENABLE KEYS */;


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


-- Export de la structure de table ecg_sav_virtuel. motifs
DROP TABLE IF EXISTS `motifs`;
CREATE TABLE IF NOT EXISTS `motifs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `nature_id` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.motifs: ~66 rows (environ)
/*!40000 ALTER TABLE `motifs` DISABLE KEYS */;
INSERT INTO `motifs` (`id`, `libelle`, `code`, `nature_id`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'Changement de régime', 17, 'AV', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'Changement RIB', 18, 'AV', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'Changement de garantie', 9, 'AV', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 'Retrait de bénéficiaire', 19, 'AV', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 'Ajout nouveau né/bénéficiaire', 1, 'AV', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 'Double prélèvement', 32, 'DP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(7, 'Pas de prélèvement', 33, 'DP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, 'Erreur sur la date prélèvement', 10, 'DP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(9, 'Erreur montant', 5, 'DP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(10, 'Gestion double compte R/P', 25, 'DP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(11, 'Prélèvement', 13, 'DP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(75, 'Promo : Mois Gratuit', 45, 'EC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(76, 'Erreur tarifaire', 52, 'EC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(77, 'Promo : Geste Commerciale', 48, 'EC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(78, 'Promo : Chèque Parrainage', 44, 'EC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(79, 'Demande de Changement de date d’effet', 47, 'EC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(80, 'Demande validation crédit d’impôt', 62, 'EC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(81, 'Erreur tarifaire', 63, 'EC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(82, 'Retard Accord Crédit d’Impôt', 46, 'EC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(83, 'Absence N° de Contrat', 40, 'EC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(84, 'Demande validation crédit d’impôt', 51, 'EC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(85, 'Pas de Contrepartie Cgnie', 41, 'IM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(86, 'Contentieux', 43, 'IM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(87, 'Chq régul non reçu chez ECG', 42, 'IM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(88, 'Choisir un thème', 31, 'O', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(89, 'Accord non reçu', 29, 'PC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(90, 'Demande de PEC', 28, 'PC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(91, 'Refus date entrée < date d effet', 27, 'PC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(92, 'Refus Hospi < une nuité', 4, 'PC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(93, 'demande de suppression délai de carence', 61, 'PC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(94, 'GARANTIE ASSISTANCE', 71, 'PC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(95, 'demande de suppression délai de carence', 50, 'PC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(96, 'Refus délais d\'attente Gnie', 26, 'PC', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(97, 'Demande de PEC Dentaire', 57, 'PO', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(98, 'Refus CG Cgnie', 37, 'PO', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(99, 'Demande de PEC Dentaire', 68, 'PO', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(100, 'Demande de PEC Optique', 69, 'PO', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(101, 'Demande de PEC Optique', 58, 'PO', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(102, 'Refus Abs devis détaillé', 36, 'PO', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(103, 'demande de remboursement', 60, 'RM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(104, 'Incomplet', 34, 'RM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(105, 'Absence Rembmts', 22, 'RM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(106, 'demande de remboursement', 49, 'RM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(107, 'Changement infos perso assuré', 23, 'RM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(108, 'Abs Décomptes originaux', 3, 'RM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(109, 'Retard Rembmts', 24, 'RM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(110, 'Pas de télétransmission', 35, 'RM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(111, 'Abs facture', 38, 'RM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(112, 'Retrait Télétrans suite Resil', 67, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(113, 'Demande de résiliation', 66, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(114, 'Contestation d’adhésion', 65, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(115, 'Demande Infos ou pièces', 39, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(116, 'Recevable', 14, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(117, 'Retrait Télétrans suite Resil', 56, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(118, 'En instance', 30, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(119, 'Irrecevable motif non valable', 16, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(120, 'Irrecevable hors délai', 15, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(121, 'Demande de sans effet', 53, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(122, 'Contestation d’adhésion', 54, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(123, 'Demande de résiliation', 55, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(124, 'Demande de sans effet', 64, 'RS', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(125, 'Carte Non reçu', 8, 'TP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(126, 'Echéancier non reçu', 20, 'TP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(127, 'Erreur infos perso', 21, 'TP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(128, 'Carte non envoyée', 2, 'TP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(129, 'demande de duplicata CTP', 59, 'TP', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `motifs` ENABLE KEYS */;


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


-- Export de la structure de table ecg_sav_virtuel. natures
DROP TABLE IF EXISTS `natures`;
CREATE TABLE IF NOT EXISTS `natures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.natures: ~6 rows (environ)
/*!40000 ALTER TABLE `natures` DISABLE KEYS */;
INSERT INTO `natures` (`id`, `code`, `libelle`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'AV', 'Avenant', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'DP', 'Prélèvement', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'RM', 'Remboursement', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 'PC', 'Prise en charge', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 'RS', 'Résiliation', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 'EC', 'Enregistrement Contrat', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `natures` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.produits: ~0 rows (environ)
/*!40000 ALTER TABLE `produits` DISABLE KEYS */;
INSERT INTO `produits` (`id`, `label`, `description`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'Santé', 'Produit Santé', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'Auto', 'Produit Auto', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `produits` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. reclamations
DROP TABLE IF EXISTS `reclamations`;
CREATE TABLE IF NOT EXISTS `reclamations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lu` tinyint(1) NOT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gestionnaire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motif_id` int(11) NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.reclamations: ~6 rows (environ)
/*!40000 ALTER TABLE `reclamations` DISABLE KEYS */;
INSERT INTO `reclamations` (`id`, `description`, `lu`, `etat`, `gestionnaire`, `motif_id`, `contrat_id`, `created_at`, `updated_at`) VALUES
	(38, 'test de nouvelle demande 6 ghghg', 0, 'E', '', 8, 1, '2013-11-12 16:09:08', '2013-11-16 20:01:19'),
	(39, 'ffffffffffffffffffffffffffffffffffffffffffffffffssssss', 0, 'E', '', 9, 2, '2013-11-16 19:13:52', '2013-11-16 20:05:02'),
	(40, 'QQQQQQQQQQQQQSSSSSSS', 0, 'T', '', 8, 2, '2013-11-16 19:38:40', '2013-11-16 19:38:40'),
	(41, 'DDDDDDDDDDDDDDDDDDDD', 0, 'E', '', 3, 2, '2013-11-16 19:39:45', '2013-11-16 19:39:45'),
	(42, 'FFFFFFFFFFFFFxxxxxxxxxx', 0, 'T', '', 5, 1, '2013-11-16 19:40:33', '2013-11-16 19:57:47'),
	(43, 'FFFFFFFFFFFFF', 0, 'T', '', 75, 1, '2013-11-16 19:41:15', '2013-11-16 19:57:03');
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
  `numclient` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `regime` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `sexe` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datenaissance` date NOT NULL,
  `emailpro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailpers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `connexion` datetime NOT NULL,
  `compteur` int(11) NOT NULL,
  `type` char(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'CLI',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.users: ~2 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `numclient`, `username`, `regime`, `sexe`, `nom`, `prenom`, `datenaissance`, `emailpro`, `emailpers`, `password`, `etat`, `connexion`, `compteur`, `type`, `created_at`, `updated_at`) VALUES
	(2, 0, 'samira', 'Sécurité Sociale', 'F', 'MEDGHALI', 'Samira', '1986-04-16', '', '', '$2y$08$HyAK7WTMYSY4ZzffVdLgfeklpOQUOfqve2Pq4XWrg4ZjerB8Nv4mW', 0, '0000-00-00 00:00:00', 0, 'CLI', '2013-11-16 14:41:54', '2013-11-16 14:41:54'),
	(3, 0, 'idbrahim', 'Travailleur Non Salarié', 'M', 'IDBRAHIM', 'Mohamed', '1984-08-16', '', '', '$2y$08$syo9ca.J2e4dfKI0NIyIxODsjOSbHqAfe3q6DDLKL.2bYzzVS3z56', 0, '0000-00-00 00:00:00', 0, 'CLI', '2013-11-16 18:27:21', '2013-11-16 18:27:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Export de la structure de table ecg_sav_virtuel. userss
DROP TABLE IF EXISTS `userss`;
CREATE TABLE IF NOT EXISTS `userss` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table ecg_sav_virtuel.userss: ~0 rows (environ)
/*!40000 ALTER TABLE `userss` DISABLE KEYS */;
INSERT INTO `userss` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
	(3, 'IDBRAHIM', '$2y$08$XI47MgVuGHUj67xn7Bp.kuOqD6LFaYlAQS87QdJT5tUsckDKKXTFu', '2013-10-31 11:50:05', '2013-10-31 11:50:05');
/*!40000 ALTER TABLE `userss` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
