<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "GoogleMaps";
$conexion = new mysqli($hostname, $username, $password, $database) or die ("No se puede conectar a la base de datos!!".$conexion->error);
?>
