DROP DATABASE IF EXISTS geograficos;
-- -------------------------------------------------------------------------------------
CREATE DATABASE geograficos DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE geograficos;
--
-- Base de datos: `geograficos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `markers`
--

CREATE TABLE IF NOT EXISTS `markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE latin1_bin NOT NULL,
  `address` varchar(80) COLLATE latin1_bin NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(1, 'Cerro Verde', 'Santa Ana, calle al cerro', 13.835080, -89.653160, 'Montana'),
(2, 'Juayua', 'ruta de las flores', 13.844414, -89.746330, 'Lagos'),
(3, 'La', 'la', 13.351876, -89.007851, 'Playas'),
(4, 'Termos del Rio', 'la libertad, calle 25', 13.870080, -89.451141, 'Balneario'),
(5, 'Cerro', 'El', 13.671842, -89.158875, 'Montana');
