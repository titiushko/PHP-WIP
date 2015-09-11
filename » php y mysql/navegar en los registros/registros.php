<?php
$conexion = mysql_connect('localhost','root',''); 
mysql_select_db('vical',$conexion);

$cantidad_mostrar = 10;
if(isset($_GET['pagina'])){
	$comienzo_registro = ($_GET['pagina']-1)*$cantidad_mostrar;
	$pagina_actual = $_GET['pagina'];
}else{
	$comienzo_registro = 0;
	$pagina_actual = 1;	
}
$cantidad_registros = mysql_num_rows(mysql_query("SELECT * FROM proveedores",$conexion));
$pagina_anterior	= $pagina_actual-1;
$pagina_siguiente	= $pagina_actual+1;
$pagina_ultimo		= $cantidad_registros/$cantidad_mostrar;
$residuo 			= $cantidad_registros%$cantidad_mostrar;	//verificamos residuo para ver si llevara decimales
if($residuo > 0) $pagina_ultimo = floor($pagina_ultimo)+1;		//si hay residuo usamos funcion floor para que me devuelva la parte entera, SIN REDONDEAR y le sumamos una unidad para obtener la ultima pagina

$consulta = mysql_query("SELECT codigo_proveedor, nombre_proveedor, departamento, telefono_proveedor1, direccion_proveedor FROM proveedores ORDER BY codigo_proveedor LIMIT $comienzo_registro, $cantidad_mostrar",$conexion);
mysql_close($conexion);
?>
<table border="1">
	<caption>LISTADO DE PROVEEDORES</caption>
	<tr>
		<td align="center" colspan="5">
			<?php echo "MOSTRANDO DE ".($comienzo_registro+1)." A ".($comienzo_registro+$cantidad_mostrar)." DE ".$cantidad_registros." REGISTROS";?>
		</td>
	</tr>
	<tr>
		<td>
			CODIGO
		</td>
		<td>
			NOMBRE
		</td>
		<td>
			DEPARTAMENTO
		</td>
		<td>
			TELEFONO
		</td>
		<td>
			DIRECCION
		</td>
	</tr>
<?php
while($proveedores = mysql_fetch_array($consulta)){
?>
	<tr>
		<td>
			<?php echo $proveedores['codigo_proveedor'];?>
		</td>
		<td>
			<?php echo $proveedores['nombre_proveedor'];?>
		</td>
		<td>
			<?php echo $proveedores['departamento'];?>
		</td>
		<td>
			<?php echo $proveedores['telefono_proveedor1'];?>
		</td>
		<td>
			<?php echo $proveedores['direccion_proveedor'];?>
		</td>
	</tr>
<?php
}
?>
</table>
<table>
	<tr>
		<td align="center">
			<?php if($pagina_actual != 1){?><input type="button" value="PRIMERO" onClick="paginador('<?php echo "1";?>');"><?php } else{?><input type="button" value="PRIMERO" disabled><?php }?>
			<?php if($pagina_actual > 1){?><input type="button" value="ANTERIOR" onClick="paginador('<?php echo $pagina_anterior;?>');"><?php } else{?><input type="button" value="ANTERIOR" disabled><?php }?>
			(PAGINA <?php echo $pagina_actual."/".$pagina_ultimo;?>)
			<?php if($pagina_actual < $pagina_ultimo){?><input type="button" value="SIGUIENTE" onClick="paginador('<?php echo $pagina_siguiente;?>');"><?php } else{?><input type="button" value="SIGUIENTE" disabled><?php }?>
			<?php if($pagina_actual != $pagina_ultimo){?><input type="button" value="ULTIMO" onClick="paginador('<?php echo $pagina_ultimo;?>');"><?php } else{?><input type="button" value="ULTIMO" disabled><?php }?>
		</td>
	</tr>
</table>