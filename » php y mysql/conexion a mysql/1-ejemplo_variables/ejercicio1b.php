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

<h2>Paso 2: se accede a la variable de sesión almacenada y se destruye</h2>

<?php
// con register_globals on
//   print ("<p>valor de la variable de sesión: $var</p>\n");
//   session_unregister ("var");

// con register_globals off
   $var = $_SESSION['var'];
   print ("<p>Valor de la variable de sesión: $var</p>\n");
//elimina la variable de sesion   
   unset ($_SESSION['var']);
?>

<a href="ejercicio1c.php">paso 3</a>.

</body>
</html>

