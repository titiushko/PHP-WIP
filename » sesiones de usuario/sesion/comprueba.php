<?php 
session_start();
// modificacion de codigo Xombra (www.xombra.com) 21/03/2009 para sectorweb.net
    include("config.php");
    $login = htmlspecialchars(trim($_POST['login']));
    $pass = sha1(md5(trim($_POST['pass']))); // encriptamos en MD5 para despues comprar (Modificado)
    // $query="SELECT * FROM usuarios WHERE login='$login'"; Antes
	$link=mysql_connect($server,$dbuser,$dbpass);
 
    $query = sprintf("SELECT usuarios.login,
	                         usuarios.nombre,
	 					     usuarios.apaterno, 
							 usuarios.amaterno,
							 usuarios.email
	                   FROM usuarios WHERE usuarios.login='%s' && usuarios.password = '%s'",  // Ahora
               mysql_real_escape_string($login),mysql_real_escape_string($pass)); 	  
      $result=mysql_db_query($database,$query,$link);
      // if(mysql_num_rows($result)==0){ // antes
      if(mysql_num_rows($result)){ // nos devuelve 1 si encontro el usuario y el password
	  
		$array=mysql_fetch_array($result);
     	//  if($array["password"]==crypt($pass,"semilla") ){ // Antes
     	 /* Comprobamos que el password encriptado en la BD coincide con el password que nos han dado al encriptarlo. Recuerda usar semilla para encriptar los dos passwords. */
         $_SESSION["login"]=$array["login"];
         $_SESSION["nombre"]=$array["nombre"];
         $_SESSION["apaterno"]=$array["apaterno"];
         $_SESSION["amaterno"]=$array["amaterno"];
		 $_SESSION["email"]=$array["email"]; // Agrgado Nuevo
         header("Location:user.php");
       }  else {
		 echo "Login o Password Incorrectos";  // Ahora
      } 
       
?>