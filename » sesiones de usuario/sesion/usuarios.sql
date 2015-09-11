CREATE TABLE usuarios(
`id` int( 4 ) NOT NULL AUTO_INCREMENT ,
`nombre` text,
`apaterno` text,
`amaterno` text,
`login` varchar( 40 ) NOT NULL ,
`password` varchar( 80 ) NOT NULL ,
`email` text,
UNIQUE KEY ( id )
);