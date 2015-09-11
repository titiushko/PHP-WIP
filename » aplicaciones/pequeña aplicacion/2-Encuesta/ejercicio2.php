<html lang="es">

<head>
   <title>Encuesta</title>
   <link rel="stylesheet" type="text/css" href="../estilo.css">
</head>

<body>

<?php
   $enviar = $_REQUEST['enviar'];
   if (isset($enviar))
   {
      print ("<h1>Encuesta. Voto registrado</h1>\n");

   // Conectar con la base de datos
      $connection = mysql_connect ("localhost", "root", "")
         or die ("no se puede conectar al servidor");
      mysql_select_db ("noticias")
         or die ("no se puede seleccionar bd");

   // Obtener numero de votos actuales
      $instruccion = "select votos1, votos2 from votos";
      $consulta = mysql_query ($instruccion, $connection)
         or die ("fallo en la selección");
      $resultado = mysql_fetch_array ($consulta);

  
     $votos1 = $resultado["votos1"];
     $votos2 = $resultado["votos2"];
// Actualizar votos de acuerdo a la opción seleccionada  
   $voto = $_REQUEST['voto'];
     if ($voto == "si")
        $votos1 = $votos1 + 1;
     else if ($voto == "no")
        $votos2 = $votos2 + 1;
     $instruccion = "update votos set votos1=$votos1, votos2=$votos2";
     $actualizacion = mysql_query ($instruccion, $connection)
        or die ("fallo en la modificación");

   // desconectar
      mysql_close ($connection);

   // mostrar mensaje de agradecimiento
      print ("<p>Su voto ha sido registrado. Gracias por participar</p>\n");
      print ("<a href='ejercicio2-resultados.php'>Ver resultados</a>\n");
   }
   else
   {
?>

<h1>Encuesta</h1>

<p>¿Utiliza PHP y MySQL?</p>

<form action="ejercicio2.php" method="post">
   <input type="radio" name="voto" value="si" checked>Sí<br>
   <input type="radio" name="voto" value="no">No<br><br>
   <input type="submit" name="enviar" value="votar">
</form>

<a href="ejercicio2-resultados.php">Ver resultados</a>

<?php
   }
?>

</body>
</html>
