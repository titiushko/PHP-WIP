<?
/*Por �ltimo para salir de la sesion, es decir para destruir la variable de sesion, se puede hacer clik en salir.php. 
La raz�n por la que podr�amos desear destruir esa variable es que no quisi�ramos que alg�n intruso aproveche el descuido 
de un usuario v�lido, que al retirarse moment�neamente de su computadora, aqu�l utilice �sa misma computadora para 
acceder a contenidos seguros.*/
session_start();
session_destroy();
?>
<html>
	<head>
		<title>Contenido no seguro</title>
	</head>
	<body>
		Ahora est�s fuera de la aplicaci�n segura.
		<br>
		<br>
		<a href="login.php">Autenticar usuario</a>
	</body>
</html>
<!--Se debe saber que la forma en se implement� este sistema de seguridad es bastante discutible. 
Por ejemplo, la variable de sesion (autenticado) es bastante simple de �adivinar� y por lo tanto, tendr�amos que crear una 
variable de sesion con un nombre un poco mas complejo, como ser �HjkrTS3986Yg444aASds�.-->