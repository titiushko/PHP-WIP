<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Usuario.php";
?>
<html>
	<head>
		<title>Seguimiento de Proyectos</title>
		<link rel="stylesheet" href="../../_Recursos/CSS/patron.css" type="text/css"></link>
		<link rel="stylesheet" href="../../_Recursos/Plugins/Calendario/calendario.css" type="text/css"></link>
		<script type="text/javascript" src="../../_Recursos/Plugins/Calendario/calendario.js"></script>
	</head>
	<body id="formato">
		<div id="cabeza">
			<h1>SEGUIMIENTO DE PROYECTOS</h1>
		</div>
		<div id="cuerpo">
			<h2>AGREGAR USUARIO</h2>
			<form name="formulario" action="AgregarUsuario.php" method="POST">
			<table border="0" class="cuadricula">
				<tr><th align="right">Usuario:</th><td><input name="codigo" type="text"></td></tr>
				<tr><th align="right">Nombres:</th><td><input name="nombres" type="text"></td></tr>
				<tr><th align="right">Apellidos:</th><td><input name="apellidos" type="text"></td></tr>
				<tr><th align="right">Fecha de Nacimiento:</th><td><input name="nacimiento" type="text" onClick="displayCalendar(document.formulario.nacimiento,'dd/mm/yyyy',this);" readonly="readonly"></td></tr>
				<tr><th align="right">Password:</th><td><input name="password" type="text"></td></tr>
				<tr><td align="center"><input type="submit" value="Guardar"></td><td align="center"><input type="button" value="Cancelar" onClick="location.href = '../Consultar';" title="Volver al Catalogo de Usuarios"></td></tr>
			</table>
			</form>
		</div>
	</body>
</html>