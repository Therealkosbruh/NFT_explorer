CREATE DATABASE  IF NOT EXISTS `nft_explorer` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `nft_explorer`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: nft_explorer
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artists` (
  `artist_id` int NOT NULL,
  `artist_name` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `artist_avatar` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (1,'Threshold Art','img/sticker.webp'),(2,'Eclypse','img/avatar2.jpg');
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nft`
--

DROP TABLE IF EXISTS `nft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nft` (
  `collection_address` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `collection_name` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `descr` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `IMG` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Owner_address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0QDeAgG1txqri6ZkYNY_bizlSR1DprJf7EM-YumHS9xeeuNt',
  `Status` int NOT NULL DEFAULT '1',
  `Nft_price` int NOT NULL,
  `Creator` int NOT NULL,
  `Nft_kind` int NOT NULL,
  PRIMARY KEY (`collection_address`),
  KEY `Status` (`Status`),
  KEY `Nft_kind` (`Nft_kind`),
  KEY `Creator` (`Creator`),
  CONSTRAINT `nft_ibfk_1` FOREIGN KEY (`Status`) REFERENCES `statuses` (`status_id`),
  CONSTRAINT `nft_ibfk_2` FOREIGN KEY (`Nft_kind`) REFERENCES `nft_kind` (`kind_id`),
  CONSTRAINT `nft_ibfk_3` FOREIGN KEY (`Creator`) REFERENCES `artists` (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nft`
--

LOCK TABLES `nft` WRITE;
/*!40000 ALTER TABLE `nft` DISABLE KEYS */;
INSERT INTO `nft` VALUES ('1XmC-KKHDZgP2YNoc8_uxQKjolSP5l52CpIaubwyzmn98Yn2','Прибой Нежности','\"Прибой Нежности\" — изображение девушки, окутанной волнами. В её взгляде — спокойствие, а волны, словно нежные руки, обнимают её, воплощая гармонию с природой.','https://raw.githubusercontent.com/Therealkosbruh/nft-s_images/master/front_bg_nft-PhotoRoom.png-PhotoRoom.png','0QDeAgG1txqri6ZkYNY_bizlSR1DprJf7EM-YumHS9xeeuNt',1,2,2,1),('aBc-DJFEjS8UrBn4h_exPqAtU8Ln7pRtsWbxkdiKjg43DvS6','Шторм в глазах','На картины изображена женская фигура в море, окруженная взволнованными волнами. Ее глаза светятся тайным огнем, словно отражают внутреннюю бурю. Стратегия возмужания красота поглощена силой стихии, но лицо остается непоколебимым.','https://raw.githubusercontent.com/Therealkosbruh/nft-s_images/master/nft5.jpg','0QDeAgG1txqri6ZkYNY_bizlSR1DprJf7EM-YumHS9xeeuNt',1,1,2,1),('iCy-ZGHWsVm1xMkLb3_jpKrFq3Hc8oRuySaefnu54pBzBhT9','Восточная красота','Эта загадочная женщина с искристыми глазами и нежными чертами лица окружена ароматными белыми цветами, что добавляет ей еще больше очарования. Ее таинственный взгляд и грация заставляют вас замирать от восторга.','https://raw.githubusercontent.com/Therealkosbruh/nft-s_images/master/nft7.jpg','0QDeAgG1txqri6ZkYNY_bizlSR1DprJf7EM-YumHS9xeeuNt',1,2,2,1),('kQD-JJEGYgM1XMnc7_vwPLholTP4k41BoHaubxyjni87XvM1','Взгляд Эллины','Эллина: воплощение грации и загадочности, её взгляд улавливает суть красоты и интриги, оставляя вечный след в душе зрителя.','https://raw.githubusercontent.com/Therealkosbruh/nft-s_images/master/front_part-transformed.png','0',3,2,1,1),('mF2-ZZFGHgN2YNod8_uxQMjklUP5l52CpIbvcdezkli98yN2','Мысли Акрополя','\"Статуя девушки, в уме которой заложены основы классической архитектуры, символизирует мудрость и вечность греческих идеалов. Экспозиция объединяет красоту и интеллект.','https://raw.githubusercontent.com/Therealkosbruh/nft-s_images/master/31ebf0de57893474de3ae96e762e3458.jpg','0QDeAgG1txqri6ZkYNY_bizlSR1DprJf7EM-YumHS9xeeuNt',1,3,2,1),('pZL-KKDFZgN2YNoc8_uxQMjklMP5l52CpIaebcdmkl98YnN2','Фотиос','Бюст Фотиоса, бога света, с величественным взглядом, направленным вдаль. Красная подсветка мягко очерчивает контуры, добавляя таинственности и силы образу.','https://raw.githubusercontent.com/Therealkosbruh/nft-s_images/master/nft-4.jpg','0QDeAgG1txqri6ZkYNY_bizlSR1DprJf7EM-YumHS9xeeuNt',1,3,2,1);
/*!40000 ALTER TABLE `nft` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nft_kind`
--

DROP TABLE IF EXISTS `nft_kind`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nft_kind` (
  `kind_id` int NOT NULL AUTO_INCREMENT,
  `kind_name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`kind_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nft_kind`
--

LOCK TABLES `nft_kind` WRITE;
/*!40000 ALTER TABLE `nft_kind` DISABLE KEYS */;
INSERT INTO `nft_kind` VALUES (1,'Статическое'),(2,'Анимированное');
/*!40000 ALTER TABLE `nft_kind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `receiver_address` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nft_address` varchar(90) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `receiver_address` (`receiver_address`),
  KEY `nft_address` (`nft_address`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`receiver_address`) REFERENCES `users` (`wallet_id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`nft_address`) REFERENCES `nft` (`collection_address`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'0QD7xTXSW8JX1u912sf69JXNXnBeAg1mRHGS_YoXy8ZXqk1X','kQD-JJEGYgM1XMnc7_vwPLholTP4k41BoHaubxyjni87XvM1');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` tinytext COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Пользователь'),(2,'Администратор');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statuses` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status_name` tinytext COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (1,'В продаже'),(2,'Оплачен'),(3,'Продан');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `wallet_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_login` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_mail` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_role` int DEFAULT '1',
  PRIMARY KEY (`wallet_id`),
  KEY `user_role` (`user_role`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `roles` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('0QD7xTXSW8JX1u912sf69JXNXnBeAg1mRHGS_YoXy8ZXqk1X','usr1','qwe1','user@mail.com',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-14 15:38:44
