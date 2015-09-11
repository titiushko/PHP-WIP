<!--Ahora pasamos a ver el script aplicacion.php. Este contiene el bloque de seguridad al principio, 
de tal manera de que sea lo primero que se ejecute en el script… El contenido de la aplicación segura es trivial.-->
<?include ("bloqueDeSeguridad.php");?>
<html>
	<head>
		<title>Aplicación segura</title>
	</head>
	<body>
		<h1>Ahora estás en una aplicación segura</h1>
		<br>
		<br>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
		Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
		dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		<br>
		<br>
		<br>
		<a href="salir.php">Hacé click aquí para salir</a>
	</body>
</html>
<!--Es interesante comprobar que pasa si se tipea en el browser directamente aplicacion.php. 
Podremos comprobar que no accede a la misma. Esto es porque en este script, al princio está el bloque de seguridad que, 
al no ver la variable de sesion porque no existe o porque si existe su valor es incorrecto, en vez de continuar con 
el script de aplicacion.php, corta todo ahí mismo y redirige a login.php-->