<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Proyecto.php";
	
	$tm_proyecto = buscarProyecto($_REQUEST['codigo_proyecto']);
	$tm_usuario = listaUsuarios();
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
			<h2>MODIFICAR PROYECTO</h2>
			<form name="formulario" action="ModificarProyecto.php" method="POST">
			<table border="0" class="cuadricula">
				<input name="codigo" type="text" value="<?php echo $_REQUEST['codigo_proyecto']; ?>" style="display: none;">
				<tr><th align="right">Responsable:</th><td>
					<select name="responsable">
						<?php
						for($i=1; $i < count($tm_usuario); $i++){
							if($tm_proyecto['responsable_proyecto'] == $tm_usuario[$i]){
						?>
						<option selected><?php echo $tm_usuario[$i]; ?></option>
						<?php
							}
							else{
						?>
						<option><?php echo $tm_usuario[$i]; ?></option>
						<?php
							}
						}
						?>
					<select>
				</td></tr>
				<tr><th align="right">Nombre:</th><td><input name="nombre" type="text" value="<?php echo $tm_proyecto['nombre_proyecto']; ?>"></td></tr>
				<tr><th align="right">Descripcion:</th><td><textarea name="descripcion"><?php echo $tm_proyecto['descripcion_proyecto']; ?></textarea></td></tr>
				<tr><th align="right">Fecha de Inicio:</th><td><input name="inicio" type="text" value="<?php echo $tm_proyecto['inicio_proyecto']; ?>" onClick="displayCalendar(document.formulario.inicio,'dd/mm/yyyy',this);" readonly="readonly"></td></tr>
				<tr><th align="right">Fecha de Finalizacion:</th><td><input name="fin" type="text" value="<?php echo $tm_proyecto['fin_proyecto']; ?>" onClick="displayCalendar(document.formulario.fin,'dd/mm/yyyy',this);" readonly="readonly"></td></tr>
				<tr><td align="center"><input type="submit" value="Guardar"></td><td align="center"><input type="button" value="Cancelar" onClick="location.href = '../Consultar';" title="Volver al Catalogo de Proyectos"></td></tr>
			</table>
			</form>
		</div>
	</body>
</html>