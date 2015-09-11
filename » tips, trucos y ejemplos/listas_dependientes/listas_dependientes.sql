DROP DATABASE IF EXISTS listas_dependientes;
CREATE DATABASE listas_dependientes DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE listas_dependientes;

CREATE TABLE categorias_productos (
	id_categoria int(11) NOT NULL auto_increment,
	nombre_categoria varchar(255) NOT NULL default '',
	id_categoria_padre int(11) NOT NULL default '0',
	PRIMARY KEY (id_categoria)
);
INSERT INTO categorias_productos(id_categoria,nombre_categoria,id_categoria_padre)
VALUES
(NULL,'herramientas', '1'),
(NULL,'muebles','2');

CREATE TABLE productos (
	id_producto int(11) NOT NULL auto_increment,
	nombre_producto  varchar(255) NOT NULL default '',
	id_categoria int(11) NOT NULL default '0',
	PRIMARY KEY (id_producto ),
	KEY id_categoria (id_categoria)
);
INSERT INTO productos(id_producto,nombre_producto,id_categoria)
VALUES
(NULL,'tenaza', '1'),
(NULL,'martillo','1'),
(NULL,'silla', '2'),
(NULL,'mesa','2');