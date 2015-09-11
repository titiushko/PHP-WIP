<?
/*Antes de mostrar aplicacion.php, voy a mostrarles en que consiste el bloque de seguridad que estar� dentro de 
aplicacion.php en forma de un include.

En �sta parte s�lo se verifica que exista la variable de sesion (autenticado). Si existe no hace nada y contin�a, 
y si no existe, redirige la p�gina a login.php*/


//Inicio la sesi�n
session_start();
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if($_SESSION["autenticado"] != "nivelUno" and $_SESSION["autenticado"] != "nivelDos" and $_SESSION["autenticado"] != "nivelTres"){
	//si no existe, envio a la p�gina de autenticacion
	header("Location: login.php");
	//ademas salgo de este script
	exit();
}
?>