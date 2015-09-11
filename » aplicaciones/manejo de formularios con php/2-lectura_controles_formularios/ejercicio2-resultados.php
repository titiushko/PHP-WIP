<html lang="es">

<head>
   <title>Elementos de entrada. Resultados del formulario</title>
   <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>

<h1>Elementos de entrada. Resultados del formulario</h1>

<h2>Elementos  de tipo INPUT</h2>

<h3>TEXT</h3>
<?php
   //print ($cadena);
   print ($_REQUEST ['cadena']);
?>
<hr/>

<h3>RADIO</h3>
<?php
   //print ($sexo);
   print ($_REQUEST ['sexo']);
?>
<hr/>

<h3>CHECKBOX</h3>
<?php
   $n = count ($extras);
   //for ($i=0; $i<$n; $i++)
      //print ("$extras[$i]<br/>\n");
   foreach ($_REQUEST['extras'] as $extra)
      print ("$extra<br/>\n");
?>
<hr/>

<h3>BUTTON</h3>
<?php
   //if ($actualizar)
      //print ("Se han actualizado los datos");
   if ($_REQUEST ['actualizar'])
      print ("Se han actualizado los datos");
?>
<hr/>

<h3>FILE</h3>
<p>(Ver <A HREF="ejercicio4.php">ejercicio 4</A> para la subida de ficheros)</p>
<hr>

<h3>HIDDEN</h3>
<?php
   //print ($username);
   print ($_REQUEST ['username']);
?>
<hr/>

<H3>PASSWORD</H3>
<?php
   //print ($clave);
   print ($_REQUEST ['clave']);
?>
<hr/>

<h3>SUBMIT</h3>
<?php
   //if ($enviar)
      //print ("Se ha pulsado el botón de enviar");
   if ($_REQUEST ['enviar'])
      print ("Se ha pulsado el botón de enviar");
?>
<hr/>

<h2>Elemento SELECT</h2>

<h3>SELECT SIMPLE</h3>
<?php
   //print ($color);
   print ($_REQUEST ['color']);
?>
<hr/>

<h3>SELECT MÚLTIPLE</h3>
<?php
   $n = count ($idiomas);
   //for ($i=0; $i<$n; $i++)
      //print ("$idiomas[$i]<BR>\n");
   foreach ($_REQUEST['idiomas'] as $idioma)
      print ("$idioma<br/>\n");
?>
<hr/>

<h2>Elemento TEXTAREA</h2>
<?php
   //print ($comentario);
   print ($_REQUEST ['comentario']);
?>
<hr/>
<br/><br/>
<p>[ <a href='javascript:history.back()'>Volver</a> ]</p>

</body>
</html>
