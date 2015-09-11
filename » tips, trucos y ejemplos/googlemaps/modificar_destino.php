<?php
require("habre_conexion.php");

$connection=mysql_connect ($hostname, $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());} 

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
} 
$id=($_GET['id']);
$nombre=($_POST['nombre'.$id]);
$direccion=$_POST['direccion'.$id];
$latitud=$_POST['latitud'.$id];
$longitud=$_POST['longitud'.$id];
$tipo=$_POST['tipo'.$id];

if($nombre<>"" AND $direccion<>"" AND $latitud<>"" AND $longitud<>""){	
	
	mysql_query("UPDATE markers SET name='$nombre', address='$direccion',lat='$latitud', lng='$longitud', type='$tipo' WHERE id='$id'", $connection) or die ("<SPAN CLASS='error'>Fallo en consulta_modificar_destino!!</SPAN>".mysql_error());
	
	echo '<script>alert("Su destino ha sido Modificado con Exito ")</script>';
	echo "<script>window.location='mantenimientoprincipal.html'</script>";
}
mysql_close($connection);
?>			
