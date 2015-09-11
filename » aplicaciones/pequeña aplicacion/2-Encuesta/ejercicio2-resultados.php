<html lang="es">

<head>
   <title>Encuesta. Resultados de la votación</title>
   <link rel="stylesheet" type="text/css" href="../estilo.css">
</head>

<body>

<h1>Encuesta. Resultados de la votación</h1>

<?php

   // Conectar con la base de datos
      $connection = mysql_connect ("localhost", "root", "")
         or die ("no se puede conectar al servidor");
      mysql_select_db ("noticias")
         or die ("no se puede seleccionar bd");

   // Obtener datos actuales de la votación
      $instruccion = "select * from votos";
      $consulta = mysql_query ($instruccion, $connection)
         or die ("fallo en la selección");
      $resultado = mysql_fetch_array ($consulta);

      $votos1 = $resultado["votos1"];
      $votos2 = $resultado["votos2"];
      $totalvotos = $votos1 + $votos2;

   // Mostrar resultados
      print ("<table>\n");

      print ("<tr>\n");
      print ("<th>Respuesta</th>\n");
      print ("<th>Votos</th>\n");
      print ("<th>Porcentaje</th>\n");
      print ("<th>Representación gráfica</th>\n");
      print ("</tr>\n");

      $porcentaje = round (($votos1/$totalvotos)*100,2); //Redondea a dos decimales
      print ("<tr>\n");
      print ("<td class='izquierda'>Sí</td>\n");
      print ("<td class='derecha'>$votos1</td>\n");
      print ("<td class='derecha'>$porcentaje%</td>\n");
      print ("<td class='izquierda'><img src='../img/puntoamarillo.gif' height='10' width='" .
         $porcentaje*4 . "'></td>\n");
      print ("</tr>\n");

      $porcentaje = round (($votos2/$totalvotos)*100,2);
      print ("<tr>\n");
      print ("<td class='izquierda'>No</td>\n");
      print ("<td class='derecha'>$votos2</td>\n");
      print ("<td class='derecha'>$porcentaje%</td>\n");
      print ("<td class='izquierda'><img src='../img/puntoamarillo.gif' height='10' width='" .
         $porcentaje*4 . "'></td>\n");
      print ("</tr>\n");

      print ("</table>\n");

      print ("<p>Número total de votos emitidos: $totalvotos </p>\n");

      print ("<p><a href='ejercicio2.php'>Página de votación</a></p>\n");

   // Desconectar
      mysql_close ($connection);

?>

</body>
</html>
