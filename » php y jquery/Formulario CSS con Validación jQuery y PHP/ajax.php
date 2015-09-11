<?php
include 'includes/configuration.php';
if (isset($_POST['accion'])){
	switch ($_POST['accion']){
		case 'login':
			login();
			break;
	}
}

function login(){
	require_once 'includes/objects/class.database.php';
	require_once 'includes/objects/class.usuario.php';
	global $configuration;
	
	
	$usuario = new usuario();
	$lista = $usuario->GetList(array(array('login','=',$_POST['usuario']),array('password','=',$_POST['password'])));
	if (count($lista)){
		$_SESSION['logeado'] = $usuario->usuarioId;
		echo '<p>El usuario se ha logeado correctamente.</p>';
	}
	else
		echo '<p>Los datos introducidos son incorrectos.</p>';				
}
?>