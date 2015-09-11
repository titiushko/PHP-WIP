<?php
echo '<head>
            <title>Pasar un array por URL</title>
      </head>
      <html>
      <body>';
// Creamos un array
$mi_pasa_array=array("Spiderman" =>354, "Shrek2" =>462, "CatWoman" => 286);
$compactada=serialize($mi_pasa_array);
$compactada=urlencode($compactada);
echo "<p>";
echo "<a href=Resibir.php?mi_var_array=$compactada>Recargar la Página</a>";
echo '</body>
      </html>';
?>