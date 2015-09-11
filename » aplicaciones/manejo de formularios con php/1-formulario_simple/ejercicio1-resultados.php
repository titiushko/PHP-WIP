<html lang="es">

<head>
   <title>Formulario simple. Resultados del formulario</title>
   <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>

<h1>Formulario simple. Resultados del formulario</h1>

<p>Estos son los datos introducidos:</p>

<?php
   $texto = $_REQUEST['texto'];
   $donde = $_REQUEST['donde'];
   $genero = $_REQUEST['genero'];

   print ("<ul>\n");
   print ("   <li>Texto de búsqueda: $texto\n");
   print ("   <li>Buscar en: $donde\n");
   print ("   <li>Género: $genero\n");
   print ("</ul>\n");
?>

<p>[ <a href='ejercicio1.php'>nueva búsqueda</a> ]</p>

</body>
</html>