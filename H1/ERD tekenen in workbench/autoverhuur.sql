-- MySQL dump 10.13  Distrib 5.7.36, for Win64 (x86_64)
--
-- Host: localhost    Database: autoverhuur
-- ------------------------------------------------------
-- Server version	5.7.36

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
-- Table structure for table `autos`
--

DROP TABLE IF EXISTS `autos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autos` (
  `kenteken` varchar(8) DEFAULT NULL,
  `merk` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `datumAPK` date DEFAULT NULL,
  `kilometerstand` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autos`
--

LOCK TABLES `autos` WRITE;
/*!40000 ALTER TABLE `autos` DISABLE KEYS */;
INSERT INTO `autos` VALUES ('AB-12-CD','Mercedes-Benz','SUV','2022-11-01',25000),('EF-34-GH','BMW','Coupe','2022-07-15',35000),('IJ-56-KL','Ford','Hatchback','2022-03-28',20000),('MN-78-OP','Volkswagen','Sedan','2021-12-31',30000),('QR-90-ST','Renault','Convertible','2021-09-01',40000);
/*!40000 ALTER TABLE `autos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `huurders`
--

DROP TABLE IF EXISTS `huurders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `huurders` (
  `huurdernr` int(11) DEFAULT NULL,
  `naam` varchar(45) DEFAULT NULL,
  `adres` varchar(25) DEFAULT NULL,
  `postcode` varchar(7) DEFAULT NULL,
  `plaats` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `huurders`
--

LOCK TABLES `huurders` WRITE;
/*!40000 ALTER TABLE `huurders` DISABLE KEYS */;
INSERT INTO `huurders` VALUES (1,'Johan','Kerkstraat 23','1234AB','Amsterdam'),(2,'Marieke','Marktplein 17','5678CD','Den Haag'),(3,'Pieter','Poststraat 11','9012EF','Rotterdam'),(4,'Annie','Koningstraat 5','3456GH','Utrecht'),(5,'Bart','Burgemeesterstraat 9','7890IJ','Tilburg');
/*!40000 ALTER TABLE `huurders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prijzen`
--

DROP TABLE IF EXISTS `prijzen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prijzen` (
  `merk` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `prijs_per_dag` int(11) DEFAULT NULL,
  `prijs_per_dag_deel` int(11) DEFAULT NULL,
  `prijs_per_week` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prijzen`
--

LOCK TABLES `prijzen` WRITE;
/*!40000 ALTER TABLE `prijzen` DISABLE KEYS */;
INSERT INTO `prijzen` VALUES ('Mercedes-Benze','SUV',100,50,700),('BMW','Coupe',85,45,600),('Ford','Hatchback',75,40,500),('Volkswagen','Sedan',80,40,550),('Renault','Convertible',90,50,650);
/*!40000 ALTER TABLE `prijzen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verhuur`
--

DROP TABLE IF EXISTS `verhuur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verhuur` (
  `kenteken` varchar(8) DEFAULT NULL,
  `datum_verhuur` date DEFAULT NULL,
  `huurdernr` int(11) DEFAULT NULL,
  `identificatie` varchar(20) DEFAULT NULL,
  `datum_retour` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verhuur`
--

LOCK TABLES `verhuur` WRITE;
/*!40000 ALTER TABLE `verhuur` DISABLE KEYS */;
INSERT INTO `verhuur` VALUES ('AB-12CD','2023-01-09',1,'AB1','2023-02-02'),('EF-34-GH','2023-01-11',2,'CD2','2023-02-03'),('IJ-56-KL','2023-01-12',3,'EF3','2023-02-07'),('MN-78-OP','2023-01-13',4,'GH4','2023-02-13'),('QR-90-ST','2023-01-17',5,'IJ5','2023-02-28');
/*!40000 ALTER TABLE `verhuur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-20 18:25:55
