-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2013 at 5:38 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carrito_compras`
--

DROP DATABASE IF EXISTS carrito_compras;
-- -------------------------------------------------------------------------------------
CREATE DATABASE carrito_compras DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE carrito_compras;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pantalla` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ram` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `procesador` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `disco_duro` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` double(11,0) NOT NULL,
  `opcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `valores` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `marca`, `pantalla`, `ram`, `procesador`, `disco_duro`, `precio`, `opcion`, `valores`, `imagen`) VALUES
(1, 'Portatil Mac', '14''', '4 Gb', 'Core i3', '300 Gb', 990000, 'color', 'blanco,verde,morado,negro', 'portatil_mac.jpg'),
(2, 'Lenovo', '10''', '3 Gb', 'Intel Pentium', '750 Gb', 1100000, 'color', 'negro,verde,morado,', 'lenovo.jpg'),
(3, 'Sony Vaió', '14''', '4 Gb', 'Core i3', '500 Gb', 1000000, 'color', 'negro,blanco,verde,morado', 'sony_vaio.jpg'),
(4, 'Compaq', '10''', '2 Gb', 'AMD', '300 Gb', 700000, 'color', 'negro,verde,morado', 'compaq.jpg'),
(5, 'Dell', '14''', '4 Gb', 'Core i3', '500 Gb', 1000000, 'color', 'gris,negro', 'dell.jpg'),
(6, 'Toshiba', '14''', '4 Gb', 'Core i3', '500 Gb', 990000, 'color', '', 'toshiba.jpg'),
(7, 'Acer', '18''', '3 Gb', 'Intel Pentium', '500 Gb', 650000, 'color', 'gris,verde,blanco', 'acer.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `username`, `password`) VALUES
(11, 'Felipe', 'Cortés', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(20, 'test', 'test', 'test', '098f6bcd4621d373cade4e832627b4f6'),
(23, 'test2', 'test2', 'test2', 'ad0234829205b9033196ba818f7a872b');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
