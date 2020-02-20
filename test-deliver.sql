-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: 172.19.0.3    Database: test-development
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `age`
--

DROP TABLE IF EXISTS `age`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `age` (
  `id_age` int NOT NULL AUTO_INCREMENT,
  `initial_age` int NOT NULL,
  `final_age` int NOT NULL,
  PRIMARY KEY (`id_age`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `age`
--

LOCK TABLES `age` WRITE;
/*!40000 ALTER TABLE `age` DISABLE KEYS */;
/*!40000 ALTER TABLE `age` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classification_by_age`
--

DROP TABLE IF EXISTS `classification_by_age`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classification_by_age` (
  `id_classification_by_age` int NOT NULL AUTO_INCREMENT,
  `id_runner_race` int NOT NULL,
  `id_age` int NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id_classification_by_age`),
  KEY `fk_age_idx` (`id_age`),
  KEY `fk_classification_by_age_runner_race_idx` (`id_runner_race`),
  CONSTRAINT `fk_classification_by_age_age` FOREIGN KEY (`id_age`) REFERENCES `age` (`id_age`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_classification_by_age_runner_race` FOREIGN KEY (`id_runner_race`) REFERENCES `runner_race` (`id_runner_race`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classification_by_age`
--

LOCK TABLES `classification_by_age` WRITE;
/*!40000 ALTER TABLE `classification_by_age` DISABLE KEYS */;
/*!40000 ALTER TABLE `classification_by_age` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `overall_classification`
--

DROP TABLE IF EXISTS `overall_classification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `overall_classification` (
  `id_overall_classification` int NOT NULL AUTO_INCREMENT,
  `id_runner_race` int NOT NULL,
  `id_age` int NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id_overall_classification`),
  KEY `fk_runner_race_idx` (`id_runner_race`),
  KEY `fk_age_idx` (`id_age`),
  CONSTRAINT `fk_overall_classification_age` FOREIGN KEY (`id_age`) REFERENCES `age` (`id_age`),
  CONSTRAINT `fk_overall_classification_runner_race` FOREIGN KEY (`id_runner_race`) REFERENCES `runner_race` (`id_runner_race`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `overall_classification`
--

LOCK TABLES `overall_classification` WRITE;
/*!40000 ALTER TABLE `overall_classification` DISABLE KEYS */;
/*!40000 ALTER TABLE `overall_classification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proof_types`
--

DROP TABLE IF EXISTS `proof_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proof_types` (
  `id_proof_types` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_proof_types`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proof_types`
--

LOCK TABLES `proof_types` WRITE;
/*!40000 ALTER TABLE `proof_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `proof_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race`
--

DROP TABLE IF EXISTS `race`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race` (
  `id_race` int NOT NULL AUTO_INCREMENT,
  `id_proof_types` int NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_race`),
  KEY `fk_race_proof_types_idx` (`id_proof_types`),
  CONSTRAINT `fk_race_proof_types` FOREIGN KEY (`id_proof_types`) REFERENCES `proof_types` (`id_proof_types`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race`
--

LOCK TABLES `race` WRITE;
/*!40000 ALTER TABLE `race` DISABLE KEYS */;
/*!40000 ALTER TABLE `race` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `runner`
--

DROP TABLE IF EXISTS `runner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `runner` (
  `id_runner` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `CPF` varchar(45) NOT NULL,
  `birth_date` datetime NOT NULL,
  PRIMARY KEY (`id_runner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `runner`
--

LOCK TABLES `runner` WRITE;
/*!40000 ALTER TABLE `runner` DISABLE KEYS */;
/*!40000 ALTER TABLE `runner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `runner_race`
--

DROP TABLE IF EXISTS `runner_race`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `runner_race` (
  `id_runner_race` int NOT NULL AUTO_INCREMENT,
  `id_runner` int NOT NULL,
  `id_race` int NOT NULL,
  PRIMARY KEY (`id_runner_race`),
  KEY `fk_runner_idx` (`id_runner`),
  KEY `fk_race_idx` (`id_race`),
  CONSTRAINT `fk_runner_race_race` FOREIGN KEY (`id_race`) REFERENCES `race` (`id_race`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_runner_race_runner` FOREIGN KEY (`id_runner`) REFERENCES `runner` (`id_runner`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `runner_race`
--

LOCK TABLES `runner_race` WRITE;
/*!40000 ALTER TABLE `runner_race` DISABLE KEYS */;
/*!40000 ALTER TABLE `runner_race` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `runner_result`
--

DROP TABLE IF EXISTS `runner_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `runner_result` (
  `id_runner_result` int NOT NULL AUTO_INCREMENT,
  `id_runner_race` int NOT NULL,
  `race_start_time` datetime NOT NULL,
  `race_completion_time` datetime NOT NULL,
  PRIMARY KEY (`id_runner_result`),
  KEY `fk_runner_race_idx` (`id_runner_race`),
  CONSTRAINT `fk_runner_result_runner_race` FOREIGN KEY (`id_runner_race`) REFERENCES `runner_race` (`id_runner_race`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `runner_result`
--

LOCK TABLES `runner_result` WRITE;
/*!40000 ALTER TABLE `runner_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `runner_result` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-17 15:01:33
