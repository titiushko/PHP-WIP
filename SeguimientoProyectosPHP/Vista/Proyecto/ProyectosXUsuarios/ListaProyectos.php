<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Proyecto.php";
	
	$tm_proyecto = consultarProyectoXUsuarios($_REQUEST['busqueda']);
?>
<html>
	<head>
		<title>Seguimiento de Proyectos</title>
		<link rel="stylesheet" href="../../_Recursos/CSS/patron.css" type="text/css"></link>
		<script type="text/javascript" src="../../_Recursos/JS/funciones.js"></script>
	</head>
	<body id="medio_formato">
		<div id="medio_cuerpo">
			<table border="1" class="cuadricula">
				<tr>
					<!--<th>Usuario</th>-->
					<th>Nombre Proyecto</th>
					<th>Descripcion Proyecto</th>
					<th>Fecha de Inicio</th>
					<th>Fecha de Finalizacion</th>
				</tr>
				<?php for($i=1; $i <= count($tm_proyecto); $i++){ ?>
				<tr>
					<!--<td><?php echo $tm_proyecto[$i]['responsable_proyecto']; ?></td>-->
					<td><?php echo $tm_proyecto[$i]['nombre_proyecto']; ?></td>
					<td><?php echo $tm_proyecto[$i]['descripcion_proyecto']; ?></td>
					<td><?php echo $tm_proyecto[$i]['inicio_proyecto']; ?></td>
					<td><?php echo $tm_proyecto[$i]['fin_proyecto']; ?></td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</body>
</html>