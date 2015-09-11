CREATE DATABASE JODER DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE JODER;

CREATE TABLE foro (
  id int(7) NOT NULL auto_increment,
  autor varchar(200) NOT NULL default '',
  titulo varchar(200) NOT NULL default '',
  mensaje text NOT NULL,
  fecha datetime NOT NULL default '0000-00-00 00:00:00',
  respuestas int(11) NOT NULL default '0',
  identificador int(7) NOT NULL default '0',
  ult_respuesta datetime default NULL,
  KEY id (id)
) TYPE=MyISAM;

--
-- Dumping data for table 'foro'
--

INSERT INTO foro VALUES (1,'pablo','probando','Este es un mensaje de prueba','0000-00-00 00:00:00',2,0,'0000-00-00 00:00:00');
INSERT INTO foro VALUES (2,'federico','Otra prueba bedelesca','SEguimos metiendo mensajes que no sirven para una mierda','2003-05-02 00:14:47',3,0,'2003-05-02 00:14:47');

