<html lang="es">

<head>
   <title>Validación de Formularios</title>
   <link rel="stylesheet" type="text/css" href="../3-Procesa_form_en_mismo_file/estilo.css">
</head>

<body>

<?php
   //////////////////////////////////////////////////////////////////////////
   // si el formulario ha sido enviado
   //    validar formulario
   // fsi
   // si el formulario ha sido enviado y los datos son correctos
   //    procesar formulario
   // si no
   //    mostrar formulario
   // fsi
   //////////////////////////////////////////////////////////////////////////

// obtener valores introducidos en el formulario
   $texto = $_REQUEST['texto'];
   $donde = $_REQUEST['donde'];
   $genero = $_REQUEST['genero'];
   $buscar = $_REQUEST['buscar'];

// comprobar errores
   $error = false;
   if (isset($buscar))
   {
   // texto de búsqueda
      if (trim($texto) == "")
      {
         $errores["texto"] = "¡Campo Obligatorio!";
         $error = true;
      }
      else
         $errores["texto"] = "";
   }

// si los datos son correctos, procesar formulario
   if (isset($buscar) && $error==false)
   {
      print ("<h1>Validación de formularios. Resultados del formulario</h1>\n");
      print ("<p>Estos son los datos introducidos:</p>\n");
      print ("<ul>\n");
      print ("   <li>Texto de búsqueda: $texto\n");
      print ("   <li>Buscar en: $donde\n");
      print ("   <li>Género: $genero\n");
      print ("</ul>\n");
      print ("<p>[ <a href='ejercicio5.php'>Nueva búsqueda</a> ]</p>\n");
   }
   else
   {
?>

<h1>Validación de formularios</h1>

<h2>Búsqueda de canciones</h2>

<form class="borde" action="ejercicio5.php" method="post">

<p><label>texto a buscar:</label>
<input type="text" size="40" name="texto">

<?php
   if ($errores["texto"] != "")
      print ("<span class='error'>" . $errores["texto"] . "</span>");
?>

</p>

<p><label>buscar en:</label>
<input type="radio" name="donde" value="titulo">títulos de canción
<input type="radio" name="donde" value="album">nombres de álbum
<input type="radio" name="donde" value="ambos" checked>ambos campos</p>

<p><label>género musical:</label>
<select name="genero">
   <option selected>Todos
   <option>Acústica
   <option>Banda Sonora
   <option>Blues
   <option>Electrónica
   <option>Folk
   <option>Jazz
   <option>New Age
   <option>Pop
   <option>Rock
</select></p>

<p><input type="submit" name="buscar" value="Buscar"></p>

</form>

<?php
   }
?>

</body>
</html>
