<?php
   session_start ();
?>
<html lang="es">

<head>
   <title>Gestión de noticias - Consulta de noticias</title>
   <link rel="stylesheet" type="text/css" href="../estilo.css">

<?php
// incluir bibliotecas de funciones
   include ("../lib/fecha.php");
?>

</head>

<body>

<?php
   if (isset($_SESSION["usuario_valido"]))
   {
?>

<h1>Gestión de Noticias</h1>

<h2>Consulta de noticias</h2>

<?php

   // conectar con el servidor de base de datos
      $conexion = mysql_connect ("servdef.net", "root", "")
         or die ("No se puede conectar con el servidor");

   // seleccionar base de datos
      mysql_select_db ("noticias")
         or die ("No se puede seleccionar la base de datos");

   // enviar consulta
      $instruccion = "select * from tblnoticias order by fecha desc";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");

   // mostrar resultados de la consulta
      $nfilas = mysql_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<table>\n");
         print ("<tr>\n");
         print ("<th>Título</th>\n");
         print ("<th>Texto</th>\n");
         print ("<th>Categoría</th>\n");
         print ("<th>Fecha</th>\n");
         print ("<th>Imagen</th>\n");
         print ("</tr>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mysql_fetch_array ($consulta);
            print ("<tr>\n");
            print ("<td>" . $resultado['titulo'] . "</td>\n");
            print ("<td>" . $resultado['texto'] . "</td>\n");
            print ("<td>" . $resultado['categoria'] . "</td>\n");
            print ("<td>" . date2string($resultado['fecha']) . "</td>\n");

            if ($resultado['imagen'] != "")
               print ("<td><a target='_blank' href='../img/" . $resultado['imagen'] .
                      "'><img border='0' src='../img/ico-fichero.gif' alt='imagen asociada'></a></td>\n");
            else
               print ("<td>&nbsp;</td>\n");

            print ("</tr>\n");
         }

         print ("</table>\n");
      }
      else
         print ("No hay noticias disponibles");

// cerrar conexión
   mysql_close ($conexion);

?>

<p>[ <a href='login.php'>Menú principal</a> ]</p>

<?php

   }
   else
   {
      print ("<br><br>\n");
      print ("<p align='center'>Acceso no autorizado</p>\n");
      print ("<p align='center'>[ <a href='login.php' target='_top'>Conectar</a> ]</p>\n");
   }
   
?>

</body>
</html>
