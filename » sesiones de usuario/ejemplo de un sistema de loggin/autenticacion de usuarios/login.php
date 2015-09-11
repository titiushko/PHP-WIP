<html>
	<head>
		<title>Autenticación PHP</title>
	</head>
	<body>
		<h1>Formulario de autenticación</h1>
		<?if ($_GET["errorusuario"]=="si"){?>
		<font color="red"><b>Datos incorrectos</b></font>
		<?}else{?>
		Introduce tu nombre de usuario y contraseña
		<?}?>
		<form action="autenticacion.php" method="POST">
			<table border="0">
				<tr><td>Nombre de usuario:</td><td><input name="usuario" size="25" value=""/></td></tr>
				<tr><td>Contraseña:</td><td><input name="contrasena" size="25" type="password"/></td></tr>
				<tr><td/><td><input type="submit" value="Inicio de sesión"/></td></tr>
			</table>
		</form>
		Para ingresar, debés ingresar <b>usuario</b> en el 1er campo y <b>123</b> en el 2do.
	</body>
</html>