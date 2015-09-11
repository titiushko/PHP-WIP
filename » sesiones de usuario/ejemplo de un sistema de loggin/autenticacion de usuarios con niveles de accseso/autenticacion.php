<?
/*Aquí, básicamente, le asignamos a la variable de session tantos valores posibles como niveles de usuarios tengamos. 
Podrás ver que al principio de éste script, obtengo las variables $user, $pass y $nivel por medio de una consulta a una base 
de datos. Es interesante comentar que aquí podríamos recibir otras variables de un usuario en particular, como pueden ser la 
dirección, el mail, etc. Una vez discriminado un usuario y al moverse por el sitio, si éste desea mandar un mail a otro 
usuario, al haber ya tomado sus datos en la consulta, los valores de su dirección de correo y sus datos personales se pueden 
escribir “automáticamente” sin necesidad de “molestar” al usuario pidiéndole que los ingrese…. se entiende? son sólo algunas ideas.*/


// Valores que se obtienen de una consulta a una bd.
// variando a voluntad el valor de la variable $nivel por 1, 2 o 3, cambiará el contenido
// en el script "aplicacion.php"
$user="usuario";
$pass="123";
$nivel=1;
echo $_POST["usuario"]."-".$_POST["contrasena"];
//vemos si el usuario y contraseña es válido
if($_POST["usuario"]==$user && $_POST["contrasena"]==$pass){
	//usuario y contraseña válidos
	//defino una sesion y guardo datos
	session_start();
	switch($nivel){
		case 1:
				$_SESSION["autenticado"]= "nivelUno";
				break;
		case 2:
				$_SESSION["autenticado"]= "nivelDos";
				break;
		case 3:
				$_SESSION["autenticado"]= "nivelTres";
				break;
	}
	header ("Location: aplicacion.php");
}
else{
//si no existe le mando otra vez a la portada
header("Location: login.php?errorusuario=si");
}
?>