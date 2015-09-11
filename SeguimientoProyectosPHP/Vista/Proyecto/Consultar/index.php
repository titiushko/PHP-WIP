<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Proyecto.php";
	
	$tm_proyecto = consultarProyecto();
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
			<h2>MANTENIMIENTO DE PROYECTOS</h2>
			<a href="../Agregar/" title="Agregar Nuevo Proyecto">Agregar</a><br><br>
			<table border="1" class="cuadricula">
				<tr>
					<th>Responsable Proyecto</th>
					<th>Nombre Proyecto</th>
					<th>Descripcion Proyecto</th>
					<th>Fecha de Inicio</th>
					<th>Fecha de Finalizacion</th>
					<th colspan="2">Mantenimiento</th>
				</tr>
				<?php for($i=1; $i <= count($tm_proyecto); $i++){ ?>
				<tr>
					<td><?php echo $tm_proyecto[$i]['responsable_proyecto']; ?></td>
					<td><?php echo $tm_proyecto[$i]['nombre_proyecto']; ?></td>
					<td><?php echo $tm_proyecto[$i]['descripcion_proyecto']; ?></td>
					<td><?php echo $tm_proyecto[$i]['inicio_proyecto']; ?></td>
					<td><?php echo $tm_proyecto[$i]['fin_proyecto']; ?></td>
					<td><a href="../Modificar/index.php?codigo_proyecto=<?php echo $tm_proyecto[$i]['codigo_proyecto']; ?>">Editar</a></td>
					<td><a href="../Eliminar/index.php?codigo_proyecto=<?php echo $tm_proyecto[$i]['codigo_proyecto']; ?>">Eliminar</a></td>
				</tr>
				<?php } ?>
			</table>
			<br><a href="../../../" title="Volver a la Pagina de Inicio">Volver</a>
		</div>
	</body>
</html>