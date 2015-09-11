<html lang="es">

<head>
   <title>Consulta de noticias</title>
   <link rel="stylesheet" type="text/css" href="../estilo.css">

<?php
// incluir bibliotecas de funciones
   include ("../lib/fecha.php");
?>

</head>

<body>

<h1>Consulta de noticias</h1>

<?php

   // Conectar con el servidor de base de datos
      $conexion = mysql_connect ("localhost", "root", "")
         or die ("No se puede conectar con el servidor");

   // seleccionar base de datos
      mysql_select_db ("noticias")
         or die ("No se puede seleccionar la base de datos");

   // establecer el número de filas por página y la fila inicial
      $num = 2; // número de filas por página
      $comienzo = $_REQUEST['comienzo'];
      if (!isset($comienzo)) $comienzo = 0;

   // Calcular el número total de filas de la tabla
      $instruccion = "select * from tblnoticias";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("fallo en la consulta");
      $nfilas = mysql_num_rows ($consulta);

      if ($nfilas > 0)
      {

      // Mostrar números inicial y final de las filas a mostrar
         print ("<p>Mostrando noticias " . ($comienzo + 1) . " a ");
         if (($comienzo + $num) < $nfilas)
            print ($comienzo + $num);
         else
            print ($nfilas);
         print (" De un total de $nfilas.\n");

      // mostrar botones anterior y siguiente
         $estapagina = $_SERVER['php_self'];
         if ($nfilas > $num)
         {
            if ($comienzo > 0)
               print ("[ <a href='$estapagina?comienzo=" . ($comienzo - $num) . "'>Anterior</a> | ");
            else
               print ("[ Anterior | ");
            if ($nfilas > ($comienzo + $num))
               print ("<a href='$estapagina?comienzo=" . ($comienzo + $num) . "'>Siguiente</a> ]\n");
            else
               print ("Siguiente ]\n");
         }
         print ("</p>\n");

      }

   // Enviar consulta
      $instruccion = "select * from tblnoticias order by fecha desc limit $comienzo, $num";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("fallo en la consulta");

   // Mostrar resultados de la consulta
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
                      "'><img border='0' src='../img/ico-fichero.gif' alt='Imagen Asociada'></a></td>\n");
            else
               print ("<td>&nbsp;</td>\n");

            print ("</tr>\n");
         }

         print ("</table>\n");
      }
      else
         print ("No hay noticias disponibles");

// Cerrar conexión
   mysql_close ($conexion);

?>

</body>
</html>
