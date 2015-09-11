<?
/*
En pocas palabras lo que sucede aqu� es lo siguiente:

    * 	Primero preguntamos si la bandera recibida "n" es igual a 2, significa que el ususario esta 
		cerrando sesion, as� que eliminamos las cookies y redireccionamos nuevamente a checar.php
    * 	Asignamos a $n y $p las cookies (si las cookies ya existian, $n y $p contendran los datos del 
		ultimo user y pass que se habia logueado, Asi que solo se imprimir� mensaje de bienvenida; 
		de lo contrario se verificar� si los nuevos datos que estan llegando son correctos)
    * 	Si la bandera "n" es igual a 1 entonces significa que el user esta enviando el formulario con 
		sus datos; por lo tanto se verifica que sus datos sean correctos; si son correctos, se crean 
		las cookies con esos datos y se imprime mensaje de bienvenida, si son incorrectos se imprime 
		mensaje de error.
    * 	Si la bandera "n" es igual a 0 y no se ha iniciado sesion entonces se imprime el formulario.
    * 	Si ya se inicio sesion, entonces se imprime mensaje de bienvenida.
*/
ob_start(); //esto es para habilitar el buffer de salida. Esto para poder enviar las cookies al navegador sin que te marque error
//Desconectar
if ($_POST["n"]=='2') //si n=2 significa que el usuario ya habia iniciado sesion y ahora esta cerrando sesion
{
	setcookie("Nick"); //borramos el valor de las cookies
	setcookie("Pass"); 
	$aux="'login','0'";
	header("location: checar.php"); //redireccionamos a este mismo archivo nuevamente
}
$n=$_COOKIE["Nick"]; //s� el usuario ya habia iniciado sesion, $n y $p contendran el user y pass de ese usuario
$p=$_COOKIE["Pass"];
/*
NOTA: esta sentencia SQL es un ejemplo de lo que puedes hacer para checar que sea correcto el user y pass. Yo por el momento lo har� manualmente con el user=admin y pass=123456
$sql=mysql_query("SELECT * FROM usuarios1 WHERE user='$n' AND pass='$p'") or die (mysql_error());
$total=mysql_num_rows($sql);
if (mysql_num_rows($sql)==0) //si NO ha iniciado sesion   
*/
if ($n!='admin' or $p!='123456') //si NO ha iniciado sesion [NOTA: esta linea borrala y sustituyela por las de arriba pero con la sentencia SQL con tu tabla y campos]
{
	if ($_POST["n"]=='1') //si el user ya envio el formulario
	{
		$usuario=$_POST["user"];  //recivimos datos enviados desde login.php mediante post usando ajax
		$contrase�a=$_POST["pass"];
		/*
		NOTA: este seria un ejemplo de la sentencia SQL que va aqui. Por el momento yo lo hare manualmente usando user=admin y pass=123456
		$cad=mysql_query("SELECT * FROM usuarios1 WHERE user='$usuario' AND pass_md5='$contrase�a'") or die (mysql_error());
		if (mysql_num_rows($cad)==0) //Si es INCORRECTO el user y pass
		*/
		if ($usuario!='admin' or $contrase�a!='123456') //Si es INCORRECTO el user y pass
		{
			//echo '3';  //el usuario o pass son incorrectos... imprimimos formulario y mensaje de error
			echo '<form action="javascript: enviar(\'login\',\'1\');" name="login" id="login">
			<div id="labels">
			<div id="lbl_user"><label>Usuario</label></div>
			<div id="lbl_pass"><label>Password</label></div>
			</div>
			<div id="inputs">
			<div id="inp_user"><input name="user" class="MC_input" id="user" type="text" maxlength="30" /></div>
			<div id="inp_pass"><input name="pass" class="MC_input" id="pass" type="password" maxlength="30" /></div>
			<div id="inp_enviar"><input type="submit" class="MC_enviar" name="enviar" value="Enviar"/></div>
			</div>
			<div style="clear:both;"></div>
			<div id="inp_r"><label id="r" class="res">Usuario o password incorrectos</label></div>
			</form>';   
		}
		else //si todo salio bien
		{
			setcookie("Nick", $usuario, time()+604800); //enviamos las cookies al navegador [expiraran dentro de una semana]
			setcookie("Pass", $contrase�a, time()+604800); 
			//echo '1'; //damos bienvenida
			echo '<form action="javascript: enviar(\'login\',\'1\');" name="login" id="login">
			<div id="inp_r"><label>Bienvenid@ '.$usuario.'</label></div>
			<div id="salir"><a href="javascript: enviar(\'login\',\'2\');">Cerrar sesion</a></div>
			</form>';   
		}
	}
	else //si NO ha enviado el formulario      
	{
		//echo '2'; //no ha enviado formulario... imprimimos formulario
		echo '<form action="javascript: enviar(\'login\',\'1\');" name="login" id="login">
		<div id="labels">
		<div id="lbl_user"><label>Usuario</label></div>
		<div id="lbl_pass"><label>Password</label></div>
		</div>
		<div id="inputs">
		<div id="inp_user"><input name="user" class="MC_input" id="user" type="text" maxlength="30" /></div>
		<div id="inp_pass"><input name="pass" class="MC_input" id="pass" type="password" maxlength="30" /></div>
		<div id="inp_enviar"><input type="submit" class="MC_enviar" name="enviar" value="Enviar"/></div>
		</div>
		<div style="clear:both;"></div>
		<div id="inp_r"><label id="r" class="res"></label></div>
		</form>';   
	}
}
else //si ya inicio sesion
{
	//echo '1'; //damos bienvenida
	echo '<form action="javascript: enviar(\'login\',\'1\');" name="login" id="login">
	<div id="inp_r"><label>Bienvenid@ '.$_COOKIE["Nick"].'</label></div>
	<div id="salir"><a href="javascript: enviar(\'login\',\'2\');">Cerrar sesion</a></div>
	</form>';
}
ob_end_flush(); //esto va para poder enviar headers al navegador sin tener problemas
?>