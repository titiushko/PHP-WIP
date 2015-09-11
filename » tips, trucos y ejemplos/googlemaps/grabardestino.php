<?php
require("habre_conexion.php");

$connection=mysql_connect ($hostname, $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());} 

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
} 

$nombre=$_POST['nombre_nuevo'];
$direccion=$_POST['direccion_nuevo'];
$latitud=$_POST['latitud_nuevo'];
$longitud=$_POST['longitud_nuevo'];
$tipo=$_POST['tipo_nuevo'];
$band_id=0;
$cont_id=0;

if($nombre<>"" AND $direccion<>"" AND $latitud<>"" AND $longitud<>""){
	//calcular el numero de ID
	while($band_id==0)// OR $contlibro<999999999999
			{
				$cont_id=$cont_id+1;
				$consulta_destino = mysql_query("SELECT * FROM markers WHERE id='$cont_id'", $connection) or die ("<SPAN CLASS='error'>Fallo en consulta_existedestino!!</SPAN>".mysql_error());
				$cantdestinos = mysql_num_rows($consulta_destino);
				if($cantdestinos==0)
				{
					$band_id=1;
				}
			}
	
	mysql_query("INSERT INTO markers(id,name,address,lat,lng,type) VALUES('$cont_id','$nombre','$direccion','$latitud','$longitud','$tipo')", $connection) or die ("<SPAN CLASS='error'>Fallo en consulta_insercion_markers!!</SPAN>".mysql_error());
	
	echo '<script>alert("Su destino ha sido Ingresado con Exito ")</script>';
	echo "<script>window.location='mantenimientoprincipal.html'</script>";
}
else
{
	echo '<script>alert("Todos los campos son requeridos")</script>';
	echo "<script>window.location='mantenimientoprincipal.html'</script>";
}
mysql_close($connection);
?>			
