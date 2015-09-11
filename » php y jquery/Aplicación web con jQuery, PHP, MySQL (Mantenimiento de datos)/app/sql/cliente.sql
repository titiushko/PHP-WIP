--
-- Estructura de tabla para la tabla `cliente`
--

DROP DATABASE IF EXISTS empresa;
CREATE DATABASE empresa DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE empresa;

CREATE TABLE IF NOT EXISTS `cliente` (
  `id` tinyint(7) NOT NULL auto_increment,
  `nombres` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `sexo` char(1) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `fecha_nacimiento` datetime NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
