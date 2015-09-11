<?
/*Como habrán visto, se hace uso de sesiones para manejar una variable que se utilizará para indicar si el usuario se 
logeó en forma exitosa o no.

En estos scripts no trabajo con una base de datos para no alargar demasiado este post, pero lo que aquí sí interesa es 
la recuperación de las variables de usuario y la clave correctas para compararlas con las que se ingresan desde el formulario. 
Aquí directamente comparamos los campos ingresados del formulario con dos variables ya definidas.

En caso de ingresar los datos correctos, se crea una variable de sesion (autenticado -que será leída más tarde desde 
los scripts de la aplicación segura-) y se redirigirá la página a aplicacion.php. En caso de ingresar datos incorrectos, 
no se crea esa variable de sesion y se pasa una variable de error a login.php que sirve para mostrar en pantalla que 
ingresamos mal los datos.*/

//vemos si el usuario y contraseña son válidos
if($_POST["usuario"]=="usuario" && $_POST["contrasena"]=="123"){
	//usuario y contraseña válidos
	//se define una sesion y se guarda el dato session_start();
	$_SESSION["autenticado"]= "SI";
	header ("Location: aplicacion.php");
}
else{
	//si no existe se va a login.php
	header("Location: login.php?errorusuario=si");
}
?>