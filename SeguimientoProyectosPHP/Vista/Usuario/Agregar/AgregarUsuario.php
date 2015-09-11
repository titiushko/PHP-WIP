<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Usuario.php";
	
	agregarUsuario($_POST['codigo'],$_POST['nombres'],$_POST['apellidos'],$_POST['nacimiento'],$_POST['password']);
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
			<h2>AGREGAR USUARIO</h2>
			<table border="0" class="cuadricula">
				<tr><th align="right">Usuario:</th><td><input type="text" value="<?php echo $_POST['codigo']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Nombres:</th><td><input type="text" value="<?php echo $_POST['nombres']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Apellidos:</th><td><input type="text" value="<?php echo $_POST['apellidos']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Fecha de Nacimiento:</th><td><input type="text" value="<?php echo $_POST['nacimiento']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Password:</th><td><input type="text" value="<?php echo $_POST['password']; ?>" disabled="disabled"></td></tr>
			</table>
			<p>Se agrego el usuario exitosamente.</p>
			<a href="../Consultar/" title="Volver al Catalogo de Usuarios">Volver</a>
		</div>
	</body>
</html>