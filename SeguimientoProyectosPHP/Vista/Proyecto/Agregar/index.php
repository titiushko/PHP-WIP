<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
	include "../../../ModeloControlador/Proyecto.php";
	
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
			<h2>AGREGAR PROYECTO</h2>
			<form name="formulario" action="AgregarProyecto.php" method="POST">
			<table border="0" class="cuadricula">
				<tr><th align="right">Responsable:</th><td>
					<select name="responsable">
						<option selected></option>
						<?php for($i=1; $i < count($tm_usuario); $i++){ ?>
						<option><?php echo $tm_usuario[$i]; ?></option>
						<?php } ?>
					<select>
				</td></tr>
				<tr><th align="right">Nombre:</th><td><input name="nombre" type="text"></td></tr>
				<tr><th align="right">Descripcion:</th><td><textarea name="descripcion"></textarea></td></tr>
				<tr><th align="right">Fecha de Inicio:</th><td><input name="inicio" type="text" onClick="displayCalendar(document.formulario.inicio,'dd/mm/yyyy',this);" readonly="readonly"></td></tr>
				<tr><th align="right">Fecha de Finalizacion:</th><td><input name="fin" type="text" onClick="displayCalendar(document.formulario.fin,'dd/mm/yyyy',this);" readonly="readonly"></td></tr>
				<tr><td align="center"><input type="submit" value="Guardar"></td><td align="center"><input type="button" value="Cancelar" onClick="location.href = '../Consultar';" title="Volver al Catalogo de Proyectos"></td></tr>
			</table>
			</form>
		</div>
	</body>
</html>