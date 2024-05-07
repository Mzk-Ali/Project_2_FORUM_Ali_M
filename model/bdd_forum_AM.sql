-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forumalim
CREATE DATABASE IF NOT EXISTS `forumalim` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forumalim`;

-- Listage de la structure de table forumalim. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forumalim.category : ~8 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'Jeux video'),
	(2, 'Sports'),
	(3, 'Informatique'),
	(4, 'Cuisine'),
	(5, 'Politique'),
	(6, 'Actualités'),
	(7, 'Voyages'),
	(8, 'Sciences');

-- Listage de la structure de table forumalim. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT '0',
  `topic_id` int DEFAULT '0',
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `user_id` (`user_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forumalim.post : ~10 rows (environ)
INSERT INTO `post` (`id_post`, `message`, `creationDate`, `user_id`, `topic_id`) VALUES
	(1, '1er message de test!', '2024-04-25 14:22:57', 3, 1),
	(2, '1er message de test', '2024-04-25 14:23:23', 3, 2),
	(3, '1er message de test', '2024-04-25 14:23:43', 3, 3),
	(4, '1er message admin test', '2024-04-25 14:24:36', 1, 4),
	(5, '2eme message de test\r\n', '2024-04-25 14:25:02', 3, 4),
	(7, 'oui c&#039;est un test admin', '2024-05-02 13:49:42', 1, 4),
	(8, 'Ajout message admin', '2024-05-02 14:06:49', 1, 1),
	(9, 'test ', '2024-05-02 16:31:59', 3, 4),
	(10, 'Bonjour, \r\nJe voudrais savoir ce qui est enseign&eacute; chez Elan Formation. Je sais qu&#039;il y a beaucoup d&#039;anciens stagiaires de Elan dans ce forum.\r\n\r\nMerci d&#039;avance', '2024-05-07 09:14:46', 3, 6),
	(11, 'Bonjour,\r\nJe souhaiterai connaitre l&#039;atome le plus connu et le plus utilis&eacute; en physique\r\n\r\nMerci d&#039;avance', '2024-05-07 11:38:21', 3, 7),
	(12, 'test_modif', '2024-05-07 14:02:47', 2, 1);

-- Listage de la structure de table forumalim. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` tinyint NOT NULL DEFAULT '0',
  `category_id` int DEFAULT '0',
  `user_id` int DEFAULT '0',
  PRIMARY KEY (`id_topic`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forumalim.topic : ~6 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `lock`, `category_id`, `user_id`) VALUES
	(1, '1er topic de test', '2024-04-25 14:22:57', 0, 1, 3),
	(2, '2eme topic de test', '2024-04-25 14:23:23', 1, 1, 3),
	(3, '3eme topic de test', '2024-04-25 14:23:43', 0, 7, 3),
	(4, '1er topic admin', '2024-04-25 14:24:36', 0, 1, 1),
	(6, 'Qu&#039;est-ce qui est enseign&eacute; chez Elan Formation?', '2024-05-07 09:14:46', 0, 3, 3),
	(7, 'Quel est l&#039;atome le plus connu?', '2024-05-07 11:38:21', 0, 8, 3);

-- Listage de la structure de table forumalim. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `pseudo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forumalim.user : ~5 rows (environ)
INSERT INTO `user` (`id_user`, `mail`, `pseudo`, `password`, `dateInscription`, `role`, `avatar`) VALUES
	(1, 'admin@admin.fr', 'ADMIN', '$2y$10$4YC0GZ1Oj6AQfqgLy7SM0eRPn9EMOrqkUJvd2/wy1wtNKZspXojIa', '2024-04-24 11:58:00', 'admin', './public/img/avatar_admin.png'),
	(2, 'ali.marzak@forum.fr', 'AliM', '$2y$10$sU/KwEiFJkc/K5dKDIgtIedxcWYaqxzoxcXB0ndubSXA4zFhFT63W', '2024-04-22 16:43:07', 'moderateur', './public/img/avatar_man.png'),
	(3, '$2y$10$mZZPYEcC0GV1P8LN.Fu1V.spMa5M8OfHj7ouT5NRv1blVvxqTFYJy', 'unknown15', '$2y$10$nJZuHUeXjQ5SUwZD.9byFuvW.HuFehoP6NXFnd1qLtIF4IeUst.T6', '2024-04-25 14:22:25', 'delete', './public/img/avatar_mouton.png'),
	(4, '$2y$10$Dka9l27ZKLhrQbbGnm6pVOtoSLdkj3PTqlc5gg/RUtjhKtjNSKOEW', 'unknown', '$2y$10$WTASk8q4gpMkvYVtIskny.hVuJBeJfDicLsNELrzD0XUyvDOaIOjq', '2024-05-02 13:35:25', 'delete', './public/img/avatar_mouton.png'),
	(6, '$2y$10$zfOXNNUCuDf3YoqLpoJww.6nMspvdEJQfYHKIRzfLkSiyXY6zvIhO', 'unknown30', '$2y$10$9SJx1/fadz.ylEst3eZci.glJI.aKVWlo6NwzMiHb0Pphxk.TtiTW', '2024-05-07 11:42:03', 'delete', './public/img/avatar_mouton.png');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
