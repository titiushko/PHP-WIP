<html lang="es">

<head>
   <title>Consulta de noticias</title>
   <link rel="stylesheet" type="text/css" href="../estilo.css">

<?php
// Incluir bibliotecas de funciones
   include ("../lib/fecha.php");
?>

</head>

<body>

<h1>Consulta de noticias</h1>

<form name="selecciona" action="consulta_noticias3.php" method="post">
<p>Mostrar noticias de la categoría:
<select name="categoria">
   <option value="todas" selected>Todas
   <option value="promociones">Promociones
   <option value="ofertas">Ofertas
   <option value="costas">Costas
</select>
<input type="submit" name="actualizar" value="actualizar"></p>
</form>

<?php

   // Conectar con el servidor de base de datos
      $conexion = mysql_connect ("localhost", "root", "")
         or die ("no se puede conectar con el servidor");

   // seleccionar base de datos
      mysql_select_db ("noticias")
         or die ("no se puede seleccionar la base de datos");

   // enviar consulta
      $instruccion = "select * from tblnoticias";

      $actualizar = $_REQUEST['actualizar'];
      $categoria = $_REQUEST['categoria'];
      if (isset($actualizar) && $categoria != "todas")
         $instruccion = $instruccion . " where categoria='$categoria'";

      $instruccion = $instruccion . " order by fecha desc";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("fallo en la consulta");

   // Mostrar resultados de la consulta
      $nfilas = mysql_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<table>\n");
         print ("<tr>\n");
         print ("<th>Título</th>\n");
         print ("<th>Texto</th>\n");
         print ("<th>Categoría</th>\n");
         print ("<th>Fecha</th>\n");
         print ("<th>Imagen</th>\n");
         print ("</tr>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mysql_fetch_array ($consulta);
            print ("<tr>\n");
            print ("<td>" . $resultado['titulo'] . "</td>\n");
            print ("<td>" . $resultado['texto'] . "</td>\n");
            print ("<td>" . $resultado['categoria'] . "</td>\n");
            print ("<td>" . date2string($resultado['fecha']) . "</td>\n");

            if ($resultado['imagen'] != "")
               print ("<td><a target='_blank' href='../img/" . $resultado['imagen'] .
                      "'><img border='0' src='../img/ico-fichero.gif' alt='Imagen Asociada'></a></td>\n");
            else
               print ("<td>&nbsp;</td>\n");

            print ("</tr>\n");
         }

         print ("</table>\n");
      }
      else
         print ("No hay noticias disponibles");

// cerrar conexión
   mysql_close ($conexion);

?>

</body>
</html>
