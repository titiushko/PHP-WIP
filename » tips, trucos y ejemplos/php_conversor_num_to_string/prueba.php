<?php 
require "conversor.php";
$numero=15.23;
if ($numero)
	 {
	 	$resultado = convertir($numero);
		print("<p>$resultado</p>");
		print("<p>");
		echo number_format($numero);
		print("</p>");
	 }
?>