<?
/*Por último para salir de la sesion, es decir para destruir la variable de sesion, se puede hacer clik en salir.php. 
La razón por la que podríamos desear destruir esa variable es que no quisiéramos que algún intruso aproveche el descuido 
de un usuario válido, que al retirarse momentáneamente de su computadora, aquél utilice ésa misma computadora para 
acceder a contenidos seguros.*/
session_start();
session_destroy();
?>
<html>
	<head>
		<title>Contenido no seguro</title>
	</head>
	<body>
		Ahora estás fuera de la aplicación segura.
		<br>
		<br>
		<a href="login.php">Autenticar usuario</a>
	</body>
</html>
<!--Se debe saber que la forma en se implementó este sistema de seguridad es bastante discutible. 
Por ejemplo, la variable de sesion (autenticado) es bastante simple de “adivinar” y por lo tanto, tendríamos que crear una 
variable de sesion con un nombre un poco mas complejo, como ser “HjkrTS3986Yg444aASds”.-->