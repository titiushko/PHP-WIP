<?php
   session_start ();
?>

<html lang="es">

<head>
   <title>Manejo de Sesiones</title>
   <link rel="stylesheet" type="text/css" href="../estilo.css">
</head>

<body>

<h1>Manejo de Sesiones</h1>

<h2>Paso 1: se crea la variable de sesión y se almacena</h2>

<?php
// con register_globals on
//   $var = "sandra";
//   session_register ("var");
//   print ("<p>valor de la variable de sesión: $var</p>\n");

// con register_globals off
   $var = "sandra";
   $_SESSION['var'] = $var;
   print ("<p>Valor de la variable de sesión: $var</p>\n");
?>

<a href="ejercicio1b.php">paso 2</a>.

</body>
</html>

