<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Usuario.php";
	
	$tm_usuario = buscarUsuario($_REQUEST['codigo_usuario']);
	eliminarUsuario($_REQUEST['codigo_usuario']);
?>
<html>
	<head>
		<title>Seguimiento de Proyectos</title>
		<link rel="stylesheet" href="../../_Recursos/CSS/patron.css" type="text/css"></link>
	</head>
	<body id="formato">
		<div id="cabeza">
			<h1>SEGUIMIENTO DE PROYECTOS</h1>
		</div>
		<div id="cuerpo">
			<h2>ELIMINAR USUARIO</h2>
			<table border="0" class="cuadricula">
				<tr><th align="right">Usuario:</th><td><input name="codigo" type="text" value="<?php echo $_REQUEST['codigo_usuario']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Nombres:</th><td><input name="nombres" type="text" value="<?php echo $tm_usuario['nombres_usuario']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Apellidos:</th><td><input name="apellidos" type="text" value="<?php echo $tm_usuario['apellidos_usuario']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Fecha de Nacimiento:</th><td><input name="nacimiento" type="text" value="<?php echo $tm_usuario['nacimiento_usuario']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Password:</th><td><input name="password" type="text" value="<?php echo $tm_usuario['password_usuario']; ?>" disabled="disabled"></td></tr>
			</table>
			<p>Se elimino el usuario exitosamente.</p>
			<a href="../Consultar/" title="Volver al Catalogo de Usuarios">Volver</a>
		</div>
	</body>
</html>