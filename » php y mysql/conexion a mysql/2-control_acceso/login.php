<?php

// Iniciar sesión
   session_start();

// Si se ha enviado el formulario
   $usuario = $_REQUEST['usuario'];
   $clave = $_REQUEST['clave'];
   if (isset($usuario) && isset($clave))
   {

   // Comprobar que el usuario está autorizado a entrar
      $conexion = mysql_connect ("servdef.net", "root", "")
         or die ("No se puede conectar con el servidor");
      mysql_select_db ("noticias")
         or die ("No se puede seleccionar la base de datos");
      $salt = substr ($usuario, 0, 2);
//      $salt = substr ("user1", 0, 2);
//	  print($salt."<br/>");
      $clave_crypt = crypt ($clave, $salt);
//      $clave_crypt = crypt('pass1', $salt);	
//		print($clave_crypt);
      $instruccion = "select usuario, clave from usuarios where usuario = '$usuario'" .
         " and clave = '$clave_crypt'";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      $nfilas = mysql_num_rows ($consulta);
      mysql_close ($conexion);

   // Los datos introducidos son correctos
      if ($nfilas > 0)
      {
         $usuario_valido = $usuario;
         // con register_globals on
         // session_register ("usuario_valido");

         // con register_globals off
         $_SESSION["usuario_valido"] = $usuario_valido;
      }
   }
?>

<!DOCTYPE HTML PUBLIC "-//W3C/DTD HTML 4.0//EN"
   "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="es">
<head>
<title>Gestión de Noticias. Página de entrada</title>
<link rel="stylesheet" type="text/css" href="../estilo.css">
</head>

<body>

<?php
// Sesión iniciada
   if (isset($_SESSION["usuario_valido"]))
   {
?>

<h1>Gestión de noticias</h1>
<hr>

<ul>
   <li><a href="consulta_noticias.php">Consultar noticias</a>
   <li><a href="inserta_noticia.php">Insertar nueva noticia</a>
   <li><a href="elimina_noticia.php">Eliminar noticias</a>
</ul>

<hr>

<p>[ <a href='logout.php'>Desconectar</a> ]</p>

<?php
   }

// Intento de entrada fallido
   else if (isset ($usuario))
   {
      print ("<br><br>\n");
      print ("<p align='center'>Acceso no autorizado</p>\n");
      print ("<p align='center'>[ <a href='login.php'>Conectar</a> ]</p>\n");
   }

// Sesión no iniciada
   else
   {
      print("<br><br>\n");
      print("<p class='parrafocentrado'>Esta zona tiene el acceso restringido.<br> " .
         " para entrar debe identificarse</p>\n");

      print("<form class='entrada' name='login' action='login.php' method='post'>\n");

      print("<p><label class='etiqueta-entrada'>Usuario:</label>\n");
      print("   <input type='text' name='usuario' size='15'></p>\n");
      print("<p><label class='etiqueta-entrada'>Clave:</label>\n");
      print("   <input type='password' name='clave' size='15'></p>\n");
      print("<p><input type='submit' value='entrar'></p>\n");

      print("</form>\n");

      print("<p class='parrafocentrado'>nota: Si no dispone de identificación o tiene problemas " .
         "para entrar<br>póngase en contacto con el " .
         "<a href='mailto:webmaster@servdef.net'>Administrador</a> del sitio</p>\n");
   }
?>

</body>
</html>

