<html lang="es">

<head>
   <title>El formulario de php</title>
   <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>

<?php
   if (isset($_REQUEST['buscar']))
   {
      print ("<h1>El formulario de PHP. Resultados del formulario</h1>\n");

      $texto = $_REQUEST['texto'];
      $donde = $_REQUEST['donde'];
      $genero = $_REQUEST['genero'];

      print ("<p>Estos son los datos introducidos:</p>\n");
      print ("<ul>\n");
      print ("   <li>Texto de b�squeda: $texto\n");
      print ("   <li>Buscar en: $donde\n");
      print ("   <li>G�nero: $genero\n");
      print ("</ul>\n");
      print ("<p>[ <a href='ejercicio3.php'>Nueva b�squeda</a> ]</p>\n");
   }
   else
   {
?>

<h1>El formulario de PHP</h1>

<h2>B�squeda de canciones</h2>

<form class="borde" action="ejercicio3.php" method="post">

<p><label>Texto a buscar:</label>
<input type="text" size="40" name="texto"></p>

<p><label>Buscar en:</label>
<input type="radio" name="donde" value="titulo">T�tulos de canci�n
<input type="radio" name="donde" value="album">Nombres de �lbum
<input type="radio" name="donde" value="ambos" checked>Ambos campos</p>

<p><label>G�nero musical:</label>
<select name="genero">
   <option selected>Todos
   <option>Ac�stica
   <option>Banda Sonora
   <option>Blues
   <option>Electr�nica
   <option>Folk
   <option>Jazz
   <option>New Age
   <option>Pop
   <option>Rock
</select></p>

<p><input type="submit" name="buscar" value="Buscar�"></p>

</form>

<?php
   }
?>

</body>
</html>
