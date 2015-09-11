<?include ("bloqueDeSeguridad.php");?>
<html>
	<head>
		<title>Aplicación segura</title>
	</head>
	<body>
		<h1>Ahora estás en una aplicación segura</h1>
		<br>
		<?php
		session_start();
		// Muestra texto sólo para usuarios de nivel uno.
		if($_SESSION["autenticado"] == "nivelUno"){
			echo '<font color="red"><b>Este texto es sólo para usuarios de nivel UNO</b></font>';
		}
		// Muestra texto sólo para usuarios de nivel dos.
		if($_SESSION["autenticado"] == "nivelDos"){
			echo '<font color="red"><b>Este texto es sólo para usuarios de nivel DOS</b></font>';
		}
		// Muestra texto sólo para usuarios de nivel tres.
		if($_SESSION["autenticado"] == "nivelTres"){
			echo '<font color="red"><b>Este texto es sólo para usuarios de nivel TRES</b></font>';
		}
		?>
		<br>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
		Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
		dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
		non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		<br>
		<a href="salir.php">Hacé click aquí para salir</a>
	</body>
</html>