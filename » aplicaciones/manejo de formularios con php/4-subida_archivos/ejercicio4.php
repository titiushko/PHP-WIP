<html lang="es">
	
<head>
   <title>Subida de Archivos</title>
   <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>

<?php
// si se ha enviado el formulario
   if (isset($_REQUEST['enviar']))
   {
   // mostrar noticia
?>

<h1>Subida de Archivos. Resultados del formulario</h1>

<h2>Resultado de la inserci�n de nueva noticia</h2>

<?php

   // obtener valores introducidos en el formulario
      $titulo = $_REQUEST['titulo'];
      $texto = $_REQUEST['texto'];
      $categoria = $_REQUEST['categoria'];

   // comprobar que se han introducido todos los datos obligatorios
      $errores = "";
      if (trim($titulo) == "")
         $errores = $errores . "   <li>se requiere el t�tulo de la noticia\n";
      if (trim($texto) == "")
         $errores = $errores . "   <li>se requiere el texto de la noticia\n";

   // subir Archivo
      $copiarArchivo = false;

   // copiar Archivo en directorio de Archivos subidos
   // se renombra para evitar que sobreescriba un Archivo existente
   // para garantizar la unicidad del nombre se a�ade una marca de tiempo
      if (is_uploaded_file ($_FILES['imagen']['tmp_name']))
      {
         $nombredirectorio = "img/";
         $nombreArchivo = $_FILES['imagen']['name'];
         $copiarArchivo = true;

      // si ya existe un Archivo con el mismo nombre, renombrarlo
	  //ruta completa + nombre file
         $nombrecompleto = $nombredirectorio . $nombreArchivo; 
	  //Si el archivo existe, hay que renombrarlo...
         if (is_file($nombrecompleto))
         {
            $idunico = time(); //retorna referencia de la hora actual
            $nombreArchivo = $idunico . "-" . $nombreArchivo;
         }
      }
   // el Archivo introducido supera el l�mite de tama�o permitido
      else if ($_FILES['imagen']['error'] == upload_err_form_size)
      {
      	 $maxsize = $_REQUEST['max_file_size'];
         $errores = $errores . "   <li>el tama�o del Archivo supera el l�mite permitido ($maxsize bytes)\n";
      }
   // Si no se ha introducido en el control FILE ning�n Archivo....
      else if ($_FILES['imagen']['name'] == "")
         $nombreArchivo = '';
   // el Archivo introducido no se ha podido subir
      else
         $errores = $errores . "   <li>no se ha podido subir el Archivo\n";

   // mostrar errores encontrados
      if ($errores != "")
      {
         print ("<p>no se ha podido realizar la inserci�n debido a los siguientes errores:</p>\n");
         print ("<ul>\n");
         print ($errores);
         print ("</ul>\n");
         print ("<p>[ <a href='javascript:history.back()'>volver</a> ]</p>\n");
      }
      else
      {

      // aqu� vendr�a la inserci�n de la noticia en la base de datos

      // mover Archivo de imagen a su ubicaci�n definitiva
         if ($copiarArchivo)
            move_uploaded_file ($_FILES['imagen']['tmp_name'],
            $nombredirectorio . $nombreArchivo);

      // mostrar datos introducidos
         print ("<p>la noticia ha sido recibida correctamente:</p>\n");
         print ("<ul>\n");
         print ("   <li>t�tulo: $titulo\n");
         print ("   <li>texto: $texto\n");
         print ("   <li>categor�a: $categoria\n");
         if ($copiarArchivo)
            print ("   <li>imagen: <a target='_blank' href='" . $nombredirectorio . $nombreArchivo . "'>" . $nombreArchivo . "</a>\n");
         else
            print ("   <li>imagen: (no hay)\n");
         print ("</ul>\n");

         print ("<p>[ <a href='ejercicio4.php'>insertar otra noticia</a> ]</p>\n");
      }
   }
   else
   {
   // introducir noticia
?>

<h1>subida de Archivos</h1>

<h2>insertar nueva noticia</h2>

<form class="borde" action="ejercicio4.php" method="post" enctype="multipart/form-data">

<!-- t�tulo de la noticia -->
<p><label>t�tulo: *</label>
<input type="text" name="titulo" size="50" maxlength="50"></p>

<!-- texto de la noticia-->
<p><label>texto: *</label>
<textarea cols="45" rows="5" name="texto"></textarea></p>

<!-- categor�a de la noticia-->
<p><label>categor�a:</label>
<select name="categoria">
   <option selected>promociones
   <option>ofertas
   <option>costas
</select></p>

<!-- imagen asociada a la noticia.  tama�o m�ximo: 100 kb -->
<p><label>imagen:</label>
<input type="hidden" name="max_file_size" value="102400">
<input type="file" size="44" name="imagen"></p>

<!-- bot�n de env�o -->
<p><input type="submit" name="enviar" value="insertar noticia"></p>

</form>

<p>nota: los datos marcados con (*) deben ser rellenados obligatoriamente</p>

<?php
   }
?>

</body>
</html>
