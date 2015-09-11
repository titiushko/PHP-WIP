-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generaci�n: 12-10-2009 a las 19:10:57
-- Versi�n del servidor: 5.0.51
-- Versi�n de PHP: 5.2.6

DROP DATABASE IF EXISTS noticias;
-- -------------------------------------------------------------------------------------
CREATE DATABASE noticias DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE noticias;
-- ---------
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `noticias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblnoticias`
--

CREATE TABLE `tblnoticias` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `titulo` varchar(100) NOT NULL default '',
  `texto` text NOT NULL,
  `categoria` enum('promociones','ofertas','costas') NOT NULL default 'promociones',
  `fecha` date NOT NULL default '0000-00-00',
  `imagen` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Noticias de la inmobiliaria' AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `tblnoticias`
--

INSERT INTO `tblnoticias` (`id`, `titulo`, `texto`, `categoria`, `fecha`, `imagen`) VALUES
(1, 'Nueva promoci�n en Nervi�n', '145 viviendas de lujo en urbanizaci�n ajardinada situadas en un entorno privilegiado', 'promociones', '2004-02-04', NULL),
(2, '�ltimas viviendas junto al r�o', 'Apartamentos de 1 y 2 dormitorios, con fant�sticas vistas. Excelentes condiciones de financiaci�n.', 'ofertas', '2004-02-05', NULL),
(4, 'Casa reformada en el barrio de la Juder�a', 'Dos plantas y �tico, 5 habitaciones, patio interior, amplio garaje. Situada en una calle tranquila y a un paso del centro hist�rico.', 'promociones', '2004-02-07', NULL),
(5, 'Promoci�n en Costa Ballena', 'Con vistas al campo de golf, magn�ficas calidades, entorno ajardinado con piscina y servicio de vigilancia.', 'costas', '2004-02-09', 'apartamento9.jpg'),
(3, 'Apartamentos en el Puerto de Sta Mar�a', 'En la playa de Valdelagrana, en primera l�nea de playa. Pisos reformados y completamente amueblados.', 'costas', '2004-02-06', 'apartamento8.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos`
--

CREATE TABLE `votos` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `votos1` int(10) unsigned NOT NULL default '0',
  `votos2` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Votos registrados en la encuesta' AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `votos`
--

INSERT INTO `votos` (`id`, `votos1`, `votos2`) VALUES
(1, 0, 0);
