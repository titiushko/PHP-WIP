<?php
   session_start ();
?>

<html lang="es">

<head>
   <title>Manejo de Sesiones</title>
   <link rel="stylesheet" type="text/css" href="../estilo.css">
</head>

<body>

<h1>Manejo de sesiones</h1>

<h2>Paso 3: la variable ya ha sido destruida y su valor se ha perdido</h2>

<?php
// con register_globals on
//   print ("<p>valor de la variable de sesión: $var</p>\n");
//   session_destroy ();

// con register_globals off
   $var = $_SESSION['var'];
   print ("<p>Valor de la variable de sesión: $var</p>\n");
//cierra una sesion
   session_destroy ();
?>

<a href="ejercicio1.php">Volver al paso 1</a>.

</body>
</html>
