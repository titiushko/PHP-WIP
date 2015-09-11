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
	
	mysql_query("DELETE FROM markers WHERE id='$id'", $connection) or die ("<SPAN CLASS='error'>Fallo en consulta_eliminar_destino!!</SPAN>".mysql_error());
	
	echo '<script>alert("Su destino ha sido Eliminado con Exito ")</script>';
	echo "<script>window.location='mantenimientoprincipal.html'</script>";
mysql_close($connection);
?>			
