<html>
	<head>
		<title>Problema</title>
	</head>
	<body>
		<?php
		$conexion=mysql_connect("localhost","root","") or die("Problemas en la conexion");
		mysql_select_db("phpfacil",$conexion) or die("Problemas en la selección de la base de datos");
		$registros=mysql_query("select * from alumnos where mail='$_REQUEST[mail]'",$conexion) or die("Problemas en el select:".mysql_error());
		if ($regalu=mysql_fetch_array($registros)){
			?>
			<form action="pagina3.php" method="post">
				<input type="hidden" name="mailviejo" value="<?php echo $regalu['mail'] ?>">
				<select name="codigocurso">
					<?php
					$registros=mysql_query("select * from cursos",$conexion) or die("Problemas en el select:".mysql_error());
					while ($reg=mysql_fetch_array($registros)){
						if ($regalu['codigocurso']==$reg['codigo'])
							echo "<option value=\"$reg[codigo]\" selected>$reg[nombrecurso]</option>";
						else
							echo "<option value=\"$reg[codigo]\">$reg[nombrecurso]</option>";
					}
					?>
				</select>
				<br>
				<input type="submit" value="Modificar">
			</form>
			<?php
		}
		else
		echo "No existe alumno con dicho mail";
		?>
	</body>
</html>