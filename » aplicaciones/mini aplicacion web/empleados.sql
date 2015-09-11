-- MySQL dump 10.10
--
-- Host: localhost    Database: empleados
-- ------------------------------------------------------
-- Server version	5.0.27-community-nt

DROP DATABASE IF EXISTS empleados;
-- -------------------------------------------------------------------------------------
CREATE DATABASE empleados DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE empleados;

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
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `idempleado` int(11) NOT NULL auto_increment,
  `nombres` varchar(32) NOT NULL default '',
  `departamento` varchar(40) NOT NULL default '',
  `sueldo` double default NULL,
  KEY `id` (`idempleado`)
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (166,'sum 45','Informatica',33),(141,'si se pudo','Informatica',1500),(171,'evelina poot blanco','Informatica',400),(137,'Erik Blanco Bates','Logistica',4300),(128,'Yuliana','Contabilidad',9000),(140,'ssss','Informatica',4000),(169,'ke ondas','Contabilidad',4500),(170,'5pushing','Informatica',300),(162,'www','Contabilidad',32),(159,'xxx','Contabilidad',450),(155,'xx','Contabilidad',33),(168,'lisa','Informatica',222);
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2007-06-29 14:51:51
