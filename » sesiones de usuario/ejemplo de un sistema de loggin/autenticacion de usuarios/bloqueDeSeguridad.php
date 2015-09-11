<?
/*Antes de mostrar aplicacion.php, voy a mostrarles en que consiste el bloque de seguridad que estar� dentro de 
aplicacion.php en forma de un include.

En �sta parte s�lo se verifica que exista la variable de sesion (autenticado). Si existe no hace nada y contin�a, 
y si no existe, redirige la p�gina a login.php*/

//Inicio la sesi�n
session_start();
//COMPRUEBA QUE EL USUARIO ESTA AUTENTICADO
if($_SESSION["autenticado"] != "SI"){
	//si no existe, va a la p�gina de autenticacion
	header("Location: login.php");
	//salimos de este script
	exit();
}
?>