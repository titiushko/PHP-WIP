<?
/*Aqu�, b�sicamente, le asignamos a la variable de session tantos valores posibles como niveles de usuarios tengamos. 
Podr�s ver que al principio de �ste script, obtengo las variables $user, $pass y $nivel por medio de una consulta a una base 
de datos. Es interesante comentar que aqu� podr�amos recibir otras variables de un usuario en particular, como pueden ser la 
direcci�n, el mail, etc. Una vez discriminado un usuario y al moverse por el sitio, si �ste desea mandar un mail a otro 
usuario, al haber ya tomado sus datos en la consulta, los valores de su direcci�n de correo y sus datos personales se pueden 
escribir �autom�ticamente� sin necesidad de �molestar� al usuario pidi�ndole que los ingrese�. se entiende? son s�lo algunas ideas.*/


// Valores que se obtienen de una consulta a una bd.
// variando a voluntad el valor de la variable $nivel por 1, 2 o 3, cambiar� el contenido
// en el script "aplicacion.php"
$user="usuario";
$pass="123";
$nivel=1;
echo $_POST["usuario"]."-".$_POST["contrasena"];
//vemos si el usuario y contrase�a es v�lido
if($_POST["usuario"]==$user && $_POST["contrasena"]==$pass){
	//usuario y contrase�a v�lidos
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