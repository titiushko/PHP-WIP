-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.11-log - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para mis_contactos
DROP DATABASE IF EXISTS `mis_contactos`;
CREATE DATABASE IF NOT EXISTS `mis_contactos` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `mis_contactos`;


-- Volcando estructura para tabla mis_contactos.contactos
DROP TABLE IF EXISTS `contactos`;
CREATE TABLE IF NOT EXISTS `contactos` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_email` varchar(120) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `con_nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `con_telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT '',
  `con_edad` int(11) NOT NULL DEFAULT '0',
  `con_estatus` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`con_id`),
  UNIQUE KEY `con_email` (`con_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla mis_contactos.contactos: ~0 rows (aproximadamente)
DELETE FROM `contactos`;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` (`con_id`, `con_email`, `con_nombre`, `con_telefono`, `con_edad`, `con_estatus`) VALUES
	(1, 'akdemico1@jbachi.com', 'Joel Codeigniter', '999.00.99.00', 20, 1),
	(3, 'joel@jbachi.com', 'Joel Bachi', '555.55.55', 20, 0);
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
