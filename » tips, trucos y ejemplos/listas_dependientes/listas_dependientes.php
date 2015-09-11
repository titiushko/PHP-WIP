<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<head>
		<title>Listas dependientes con PHP y mySQL</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<?php
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database = "listas_dependientes";
		$conexion = mysql_connect($hostname, $username, $password) or die ("No se puede conectar con el servidor!!".mysql_error());
		$abrebase = mysql_select_db($database, $conexion) or die ("No se puede seleccionar la base de datos!!".mysql_error());		
		?>
		<script type="text/javascript">
		function slctr(texto,valor){
			this.texto = texto
			this.valor = valor
		}
		function slctryole(cual,donde){
			if(cual.selectedIndex != 0){
				donde.length=0
				cual = eval(cual.value)
				for(m=0;m<cual.length;m++){
					var nuevaOpcion = new Option(cual[m].texto);
					donde.options[m] = nuevaOpcion;
					if(cual[m].valor != null){
						donde.options[m].value = cual[m].valor
					}
					else{
						donde.options[m].value = cual[m].texto
					}
				}
			}
		}
		<?php
		$consulta = mysql_query("select * from categorias_productos order by id_categoria_padre",$conexion);
		$categoria_padre = array();
		while($registros = mysql_fetch_assoc($consulta)){
			$contador = 0;
			if($registros['id_categoria_padre'] != 0) $categoria_padre["cat_".$registros['id_categoria']] = $registros['nombre_categoria'];			
			echo "
			var cat_".$registros['id_categoria']." = new Array();
			cat_".$registros['id_categoria'][$contador++]." = new slctr('- -".$registros['nombre_categoria']."- -');
			";
			if($registros["id_categoria_padre"] == 0){
				$consulta2 = mysql_query("select id_categoria, nombre_categoria as 'nombre' from categorias_productos where id_categoria_padre = ". $registros["id_categoria"]. " order by nombre_categoria",$conexion);
			}
			else{
				$consulta2 = mysql_query("select id_categoria, nombre_producto as 'nombre' from productos where id_categoria = ". $registros["id_categoria"]. " order by nombre_producto",$conexion);
			}
			while($registros2 = mysql_fetch_assoc($consulta2)){
				echo "
				cat_".$registros['id_categoria'][$contador++]." = new slctr(".$registros2['nombre'].",cat_".$registros2['id_categoria'].");
				";				
			}
		}		
		?>
		</script>
		<?php
		mysql_close($conexion);
		?>
	</head>
	<body>
		<form>
			<fieldset>
				<select name="select" onchange="slctryole(this,this.form.select2)">
					<option>- - Seleccionar - -</option>
					<?php
					foreach($categoria_padre as $id_categoria => $nombre_categoria){
						echo "
						<option value='".$id_categoria."'>".$nombre_categoria."</option>
						";
					}
					?>
				</select>
				<select name="select2" onchange="slctryole(this,this.form.select3)">
					<option>- - - - - -</option>
				</select>
				<select name="select3">
					<option>- - - - - -</option>
				</select>
			</fieldset>
		</form>
	</body>
</html>