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
  `creationDate` datetime NOT NULL,
  `user_id` int DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `user_id` (`user_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forumalim.post : ~3 rows (environ)
INSERT INTO `post` (`id_post`, `message`, `creationDate`, `user_id`, `topic_id`) VALUES
	(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam excepturi officiis esse incidunt. Iste debitis totam sapiente officiis, cupiditate quas ratione consequatur esse quia iure numquam praesentium voluptatem, amet dignissimos.', '2024-04-23 10:35:07', 1, 1),
	(2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam excepturi officiis esse incidunt. Iste debitis totam sapiente officiis, cupiditate quas ratione consequatur esse quia iure numquam praesentium voluptatem, amet dignissimos.', '2024-04-23 10:37:17', 3, 1),
	(10, 'premier message test', '2024-04-23 14:06:53', 3, 26);

-- Listage de la structure de table forumalim. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `creationDate` datetime NOT NULL,
  `lock` tinyint NOT NULL DEFAULT '0',
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forumalim.topic : ~3 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `lock`, `user_id`, `category_id`) VALUES
	(1, 'Quel est le meilleur jeu des années 2000 ?', '2024-04-23 08:38:01', 0, 1, 1),
	(2, 'Marios Bros est-il encore populaire ?', '2024-04-23 09:46:23', 0, 2, 1),
	(26, 'test', '2024-04-23 14:06:53', 0, 3, 1);

-- Listage de la structure de table forumalim. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `pseudo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `dateInscription` datetime NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forumalim.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `mail`, `pseudo`, `password`, `dateInscription`, `role`, `avatar`) VALUES
	(1, 'admin000admin@forum.fr', 'admin', 'Admin000nimdA000&', '2024-04-22 16:41:50', 'admin', './public/img/avatar_mouton.png'),
	(2, 'ali.marzak@forum.fr', 'AliM', 'aliMarzak$0000', '2024-04-22 16:43:07', 'moderateur', './public/img/avatar_man.png'),
	(3, 'eren@live.fr', 'ErN', 'Eren00001111$', '2024-04-22 16:45:02', 'membre', './public/img/avatar_batman.png');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
