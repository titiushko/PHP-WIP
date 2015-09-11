<?php
   session_start ();
?>
<html lang="es">

<head>
   <title>Gestión de Noticias - Eliminación de noticias</title>
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

<h1>Eliminación de noticias</h1>

<?php

   $eliminar = $_REQUEST['eliminar'];
   if (isset($eliminar))
   {

   // conectar con el servidor de base de datos
      $conexion = mysql_connect ("servdef.net", "root", "")
         or die ("No se puede conectar con el servidor");

   // seleccionar base de datos
      mysql_select_db ("noticias")
         or die ("No se puede seleccionar la base de datos");

   // obtener número de noticias a borrar
      $borrar = $_REQUEST['borrar'];
      $nfilas = count ($borrar);

   // mostrar noticias a borrar
      for ($i=0; $i<$nfilas; $i++)
      {

      // obtener datos de la noticia i-ésima
         $instruccion = "select * from tblnoticias where id = $borrar[$i]";
         $consulta = mysql_query ($instruccion, $conexion)
            or die ("Fallo en la consulta");
         $resultado = mysql_fetch_array ($consulta);

      // mostrar datos de la noticia i-ésima
         print ("Noticia eliminada:\n");
         print ("<ul>\n");
         print ("   <li>Título: " . $resultado['titulo']);
         print ("   <li>Texto: " . $resultado['texto']);
         print ("   <li>Categoría: " . $resultado['categoria']);
         print ("   <li>Fecha: " . date2string($resultado['fecha']));
         if ($resultado['imagen'] != "")
            print ("   <li>Imagen: " . $resultado['imagen']);
         else
            print ("   <li>Imagen: (No hay)");
         print ("</ul>\n");

      // eliminar noticia
         $instruccion = "delete from tblnoticias where id = $borrar[$i]";
         $consulta = mysql_query ($instruccion, $conexion)
            or die ("Fallo en la eliminación");

      // borrar imagen asociada si existe
         if ($resultado['imagen'] != "")
         {
            $nombrefichero = "../img/" . $resultado['imagen'];
            unlink ($nombrefichero);
         }

      }
      print ("<p>Número total de noticias eliminadas: " . $nfilas . "</p>\n");

   // cerrar conexión
      mysql_close ($conexion);

      print ("<p>[ <a href='elimina_noticia.php'>Eliminar más noticias</a> | ");
      print ("<a href='login.php'>Menú principal</a> ]</p>\n");

   }
   else
   {

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
         print ("<form class='eliminar' action='elimina_noticia.php' method='post'>\n");

         print ("<table>\n");
         print ("<tr>\n");
         print ("<th>Título</th>\n");
         print ("<th>Texto</th>\n");
         print ("<th>Categoría</th>\n");
         print ("<th>Fecha</th>\n");
         print ("<th>Imagen</th>\n");
         print ("<th>Borrar</th>\n");
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

            print ("<td><input type='checkbox' name='borrar[]' value='" .
               $resultado['id'] . "'></td>\n");

            print ("</tr>\n");
         }

         print ("</table>\n");

         print ("<br>\n");
         print ("<input type='submit' name='eliminar' value='eliminar noticias marcadas'>\n");
         print ("</form>\n");
      }
      else
         print ("No hay noticias disponibles");

   // cerrar conexión
      mysql_close ($conexion);

      print ("<p>[ <a href='login.php'>Menú Principal</a> ]</p>\n");

   }

?>

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
