<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Proyecto.php";
	
	agregarProyecto($_POST['responsable'],$_POST['nombre'],$_POST['descripcion'],$_POST['inicio'],$_POST['fin']);
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
			<h2>AGREGAR PROYECTO</h2>
			<table border="0" class="cuadricula">
				<tr><th align="right">Responsable:</th><td><input type="text" value="<?php echo $_POST['responsable']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Nombre:</th><td><input type="text" value="<?php echo $_POST['nombre']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Descripcion:</th><td><textarea disabled="disabled"><?php echo $_POST['descripcion']; ?></textarea></td></tr>
				<tr><th align="right">Fecha de Inicio:</th><td><input type="text" value="<?php echo $_POST['inicio']; ?>" disabled="disabled"></td></tr>
				<tr><th align="right">Fecha de Finalizacion:</th><td><input type="text" value="<?php echo $_POST['fin']; ?>" disabled="disabled"></td></tr>
			</table>
			<p>Se agrego el proyecto exitosamente.</p>
			<a href="../Consultar/" title="Volver al Catalogo de Proyectos">Volver</a>
		</div>
	</body>
</html>