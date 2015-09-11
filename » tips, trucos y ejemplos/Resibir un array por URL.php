<?php
echo '<head>
            <title>Resibir un array por URL</title>
      </head>
      <html>
      <body>';
// mostramos el array recibido
if (isset($_GET['mi_var_array'])){
      $a=stripslashes ($_GET['mi_var_array']);
      $mi_array=unserialize($a);
      foreach ($mi_array AS $clave => $valor)
              echo "$clave ----> $valor <br>";
}
echo '</body>
      </html>';
?>