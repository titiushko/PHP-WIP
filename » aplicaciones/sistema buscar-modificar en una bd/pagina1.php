<html>
	<head>
		<title>Problema</title>
	</head>
	<body>
		<form action="pagina2.php" method="post">
			Ingrese el mail del alumno:
			<input type="text" name="mail"><br>
			<input type="submit" value="buscar">
		</form>
	</body>
</html>

<!--
CREATE TABLE alumnos ( 
  codigo int(11) NOT NULL auto_increment, 
  nombre varchar(40) default NULL, 
  mail varchar(50) default NULL, 
  codigocurso int(11) default NULL, 
PRIMARY KEY (`codigo`) 
)  
-->