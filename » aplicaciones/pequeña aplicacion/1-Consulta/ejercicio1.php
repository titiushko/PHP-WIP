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

<h1>Consulta de Noticias</h1>

<?php

   // Conectar con el servidor de base de datos
      $conexion = mysql_connect ("localhost", "root", "") 
	  	or die ("no se puede conectar con el servidor");

   // Seleccionar base de datos
      mysql_select_db ("noticias", $conexion)
	  	or die ("no se puede seleccionar la base de datos");

   // Enviar consulta
      $instruccion = "select * from tblnoticias order by fecha desc";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("fallo en la consulta");

   // Mostrar resultados de la consulta
      $nfilas = mysql_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<table>\n");
         print ("<tr>\n");
         print ("<th>título</th>\n");
         print ("<th>texto</th>\n");
         print ("<th>categoría</th>\n");
         print ("<th>fecha</th>\n");
         print ("<th>imagen</th>\n");
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
                      "'><img border='0' src='img/ico-fichero.gif' alt='imagen asociada'></a></td>\n");
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

</body>
</html>

