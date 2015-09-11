<?
/*Antes de mostrar aplicacion.php, voy a mostrarles en que consiste el bloque de seguridad que estará dentro de 
aplicacion.php en forma de un include.

En ésta parte sólo se verifica que exista la variable de sesion (autenticado). Si existe no hace nada y continúa, 
y si no existe, redirige la página a login.php*/

//Inicio la sesión
session_start();
//COMPRUEBA QUE EL USUARIO ESTA AUTENTICADO
if($_SESSION["autenticado"] != "SI"){
	//si no existe, va a la página de autenticacion
	header("Location: login.php");
	//salimos de este script
	exit();
}
?>