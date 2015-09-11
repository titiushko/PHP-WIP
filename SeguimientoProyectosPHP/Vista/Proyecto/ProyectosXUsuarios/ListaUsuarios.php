<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Usuario.php";
	
	$tm_usuario = consultarUsuario();
?>
<html>
	<head>
		<title>Seguimiento de Proyectos</title>
		<link rel="stylesheet" href="../../_Recursos/CSS/patron.css" type="text/css"></link>
		<script type="text/javascript" src="../../_Recursos/JS/funciones.js"></script>
	</head>
	<body id="medio_formato" onLoad="document.forms[0].user1.focus();">
		<div id="medio_cuerpo">
			<table border="1" class="cuadricula">
				<tr>
					<th>Usuario</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Fecha de Nacimiento</th>
				</tr>
				<form>
				<?php for($i=1; $i <= count($tm_usuario); $i++){ ?>
				<tr>
					<td><input size="13" name="user<?php echo $i; ?>" onKeyPress="return soloFlechas(event), movimientoVertical(event,<?php echo $i; ?>);" onFocus="mostrarProyectosXUsuarios('<?php echo $tm_usuario[$i]['codigo_usuario']; ?>');" onClick="mostrarProyectosXUsuarios('<?php echo $tm_usuario[$i]['codigo_usuario']; ?>');" type="text" value="<?php echo $tm_usuario[$i]['codigo_usuario']; ?>"></td>
					<td><?php echo $tm_usuario[$i]['nombres_usuario']; ?></td>
					<td><?php echo $tm_usuario[$i]['apellidos_usuario']; ?></td>
					<td><?php echo $tm_usuario[$i]['nacimiento_usuario']; ?></td>
				</tr>
				<?php } ?>
				</form>
			</table>
		</div>
	</body>
</html>