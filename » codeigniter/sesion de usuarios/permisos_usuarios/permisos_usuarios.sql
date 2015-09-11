DROP DATABASE IF EXISTS permisos_usuarios;
-- -------------------------------------------------------------------------------------
CREATE DATABASE permisos_usuarios DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE permisos_usuarios;

--
-- TABLE STRUCTURE FOR: ci_sessions
--

DROP TABLE IF EXISTS ci_sessions;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) CHARACTER SET latin1 NOT NULL,
  `ip_address` varchar(16) CHARACTER SET latin1 NOT NULL,
  `user_agent` varchar(100) CHARACTER SET latin1 NOT NULL,
  `last_activity` int(11) NOT NULL,
  `user_data` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- TABLE STRUCTURE FOR: miembros
--

DROP TABLE IF EXISTS miembros;

CREATE TABLE `miembros` (
  `id_miembro` smallint(6) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lastname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `username` varchar(30) CHARACTER SET latin1 NOT NULL,
  `password` varchar(200) CHARACTER SET latin1 NOT NULL,
  `id_privilegio` smallint(6) NOT NULL,
  PRIMARY KEY (`id_miembro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO miembros (`id_miembro`, `firstname`, `lastname`, `username`, `password`, `id_privilegio`) VALUES (1, 'Luis', 'Ramírez Calle', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);
INSERT INTO miembros (`id_miembro`, `firstname`, `lastname`, `username`, `password`, `id_privilegio`) VALUES (2, 'Jose', 'Morales García', 'consultor', '33d3a1b450a9fe871cabdfc13db2c2e0', 2);


--
-- TABLE STRUCTURE FOR: privilegios
--

DROP TABLE IF EXISTS privilegios;

CREATE TABLE `privilegios` (
  `id_privilegio` smallint(6) NOT NULL AUTO_INCREMENT,
  `name_privilegio` varchar(20) CHARACTER SET latin1 NOT NULL,
  `description_privilegio` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_privilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO privilegios (`id_privilegio`, `name_privilegio`, `description_privilegio`) VALUES (1, 'Administrador', 'Usted como Administrador tiene acceso a los módulos de Usuarios, Trazas, y Salvar Base de Datos.');
INSERT INTO privilegios (`id_privilegio`, `name_privilegio`, `description_privilegio`) VALUES (2, 'Consultor', 'Usted como Consultor tiene acceso al módulo Productos y solo puede listarlos.');


--
-- TABLE STRUCTURE FOR: productos
--

DROP TABLE IF EXISTS productos;

CREATE TABLE `productos` (
  `id_producto` smallint(6) NOT NULL AUTO_INCREMENT,
  `codigo_producto` varchar(8) CHARACTER SET latin1 NOT NULL,
  `nombre_producto` varchar(30) CHARACTER SET latin1 NOT NULL,
  `precio_producto` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO productos (`id_producto`, `codigo_producto`, `nombre_producto`, `precio_producto`) VALUES (1, 'CHP-01', 'Monitor LG', '200.00');
INSERT INTO productos (`id_producto`, `codigo_producto`, `nombre_producto`, `precio_producto`) VALUES (2, 'CHP-02', 'Mouse Óptico LOGITEC', '15.00');
INSERT INTO productos (`id_producto`, `codigo_producto`, `nombre_producto`, `precio_producto`) VALUES (3, 'CHP-03', 'Motherboard ASUS', '200.39');


--
-- TABLE STRUCTURE FOR: trazas
--

DROP TABLE IF EXISTS trazas;

CREATE TABLE `trazas` (
  `id_traza` smallint(6) NOT NULL AUTO_INCREMENT,
  `fecha_hora` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tabla` varchar(30) CHARACTER SET latin1 NOT NULL,
  `operacion` varchar(20) CHARACTER SET latin1 NOT NULL,
  `nomenclador` varchar(50) CHARACTER SET latin1 NOT NULL,
  `usuario` varchar(30) CHARACTER SET latin1 NOT NULL,
  `fullname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ip_usuario` varchar(25) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_traza`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO trazas (`id_traza`, `fecha_hora`, `tabla`, `operacion`, `nomenclador`, `usuario`, `fullname`, `ip_usuario`) VALUES (1, '02/02/2013 - 12:49am', 'miembros', 'Insertar', 'Usuario', 'admin', 'Luis Ramírez Calle', '127.0.0.1');
INSERT INTO trazas (`id_traza`, `fecha_hora`, `tabla`, `operacion`, `nomenclador`, `usuario`, `fullname`, `ip_usuario`) VALUES (2, '02/02/2013 - 12:56am', 'productos', 'Insertar', 'Producto', 'admin', 'Luis Ramírez Calle', '127.0.0.1');
INSERT INTO trazas (`id_traza`, `fecha_hora`, `tabla`, `operacion`, `nomenclador`, `usuario`, `fullname`, `ip_usuario`) VALUES (3, '02/02/2013 - 12:57am', 'productos', 'Insertar', 'Producto', 'admin', 'Luis Ramírez Calle', '127.0.0.1');
INSERT INTO trazas (`id_traza`, `fecha_hora`, `tabla`, `operacion`, `nomenclador`, `usuario`, `fullname`, `ip_usuario`) VALUES (4, '02/02/2013 - 12:57am', 'productos', 'Insertar', 'Producto', 'admin', 'Luis Ramírez Calle', '127.0.0.1');


