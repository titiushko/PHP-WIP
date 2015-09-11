<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Proyecto.php";
	
	$tm_proyecto = buscarProyecto($_REQUEST['codigo_proyecto']);
	eliminarProyecto($_REQUEST['codigo_proyecto']);
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
			<h2>ELIMINAR PROYECTO</h2>
			<table border="0" class="cuadricula">
				<tr><th align="right">Responsable:</th><td><input name="responsable" type="text" value="<?php echo $tm_proyecto['responsable_proyecto']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Nombre:</th><td><input name="nombre" type="text" value="<?php echo $tm_proyecto['nombre_proyecto']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Descripcion:</th><td><input name="descripcion" type="text" value="<?php echo $tm_proyecto['descripcion_proyecto']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Fecha de Inicio:</th><td><input name="inicio" type="text" value="<?php echo $tm_proyecto['inicio_proyecto']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Fecha de Finalizacion:</th><td><input name="fin" type="text" value="<?php echo $tm_proyecto['fin_proyecto']; ?>" disabled="disabled"></td></tr>
			</table>
			<p>Se elimino el proyecto exitosamente.</p>
			<a href="../Consultar/" title="Volver al Catalogo de Proyectos">Volver</a>
		</div>
	</body>
</html>