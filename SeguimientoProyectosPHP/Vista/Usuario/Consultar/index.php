<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Usuario.php";
	
	$tm_usuario = consultarUsuario();
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
			<h2>MANTENIMIENTO DE USUARIOS</h2>
			<a href="../Agregar/" title="Agregar Nuevo Usuario">Agregar</a><br><br>
			<table border="1" class="cuadricula">
				<tr>
					<th>Usuario</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Fecha de Nacimiento</th>
					<th colspan="2">Mantenimiento</th>
				</tr>
				<?php for($i=1; $i <= count($tm_usuario); $i++){ ?>
				<tr>
					<td><?php echo $tm_usuario[$i]['codigo_usuario']; ?></td>
					<td><?php echo $tm_usuario[$i]['nombres_usuario']; ?></td>
					<td><?php echo $tm_usuario[$i]['apellidos_usuario']; ?></td>
					<td><?php echo $tm_usuario[$i]['nacimiento_usuario']; ?></td>
					<td><a href="../Modificar/index.php?codigo_usuario=<?php echo $tm_usuario[$i]['codigo_usuario']; ?>">Editar</a></td>
					<td><a href="../Eliminar/index.php?codigo_usuario=<?php echo $tm_usuario[$i]['codigo_usuario']; ?>">Eliminar</a></td>
				</tr>
				<?php } ?>
			</table>
			<br><a href="../../../" title="Volver a la Pagina de Inicio">Volver</a>
		</div>
	</body>
</html>