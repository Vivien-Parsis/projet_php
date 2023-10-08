create database project_php;

use project_php;

CREATE TABLE `todo` (
  `id_todo` int NOT NULL AUTO_INCREMENT,
  `objectif_todo` varchar(1000) NOT NULL,
  `done` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_todo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
