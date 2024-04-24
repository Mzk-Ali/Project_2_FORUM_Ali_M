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

-- Listage des données de la table forumalim.category : ~6 rows (environ)
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forumalim.post : ~3 rows (environ)
INSERT INTO `post` (`id_post`, `message`, `creationDate`, `user_id`, `topic_id`) VALUES
	(1, 'J\'ai joué mario pendant ma jeunesse et je voulais avoir votre avis', '2024-04-24 16:41:25', 4, 1);

-- Listage de la structure de table forumalim. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lock` tinyint NOT NULL DEFAULT '0',
  `category_id` int DEFAULT '0',
  `user_id` int DEFAULT '0',
  PRIMARY KEY (`id_topic`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forumalim.topic : ~3 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `lock`, `category_id`, `user_id`) VALUES
	(1, 'Mario Bros est-il encore un grand jeu ?', '2024-04-24 16:39:42', 0, 1, 4),
	(2, 'C\'est un topic Test !!!!!', '2024-04-24 16:40:17', 0, 1, 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forumalim.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `mail`, `pseudo`, `password`, `dateInscription`, `role`, `avatar`) VALUES
	(1, 'admin@admin.fr', 'ADMIN', '$2y$10$4YC0GZ1Oj6AQfqgLy7SM0eRPn9EMOrqkUJvd2/wy1wtNKZspXojIa', '2024-04-24 11:58:00', 'admin', './public/img/avatar_mouton.png'),
	(2, 'ali.marzak@forum.fr', 'AliM', '$10$R0rwuLKlVi6mRjkjq3DbC.5AByxutgyO3iQZJyvenAPBgx46BAZD6', '2024-04-22 16:43:07', 'moderateur', './public/img/avatar_man.png'),
	(3, 'eren@live.fr', 'ErN', 'Eren00001111$', '2024-04-22 16:45:02', 'membre', './public/img/avatar_batman.png'),
	(4, 'test@live.fr', 'test', '$2y$10$R0rwuLKlVi6mRjkjq3DbC.5AByxutgyO3iQZJyvenAPBgx46BAZD6', '2024-04-24 09:54:08', 'membre', './public/img/avatar_mouton.png');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
