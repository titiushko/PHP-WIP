<!-- W.I.P. (Warning Idiot Programmer): Codigo Elvadorado por Titiushko -->
<?php
function abrirConexion(){
	$hostname = 'localhost';
	$username = 'adfcapa';
	$password = 'adfcapa';
	$database = 'XE';
	
	/*
	$hostname = 'ws2008r264-ora';
	$username = 'adfcapa';
	$password = 'adfcapa';
	$database = 'ora11db';
	*/

	$conexion = oci_connect($username, $password, $hostname.'/'.$database);
	if (!$conexion){
		$error = oci_error();
		echo $error['message'].'<br>';
		exitexit;
	}
	return $conexion;
}
?>