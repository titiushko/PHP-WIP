<html lang="es">

<head>
   <title>Inserci�n de nueva noticia</title>
   <link rel="stylesheet" type="text/css" href="../estilo.css">

<?php
// Incluir bibliotecas de funciones
   include ("../lib/fecha.php");
?>

</head>

<body>

<?php
   //////////////////////////////////////////////////////////////////////////
   // Si el formulario ha sido enviado
   //    Validar formulario
   // fsi
   // Si el formulario ha sido enviado y los datos son correctos
   //    Procesar formulario
   // Si no
   //    Mostrar formulario
   // fsi
   //////////////////////////////////////////////////////////////////////////

// Obtener valores introducidos en el formulario
   $insertar = $_REQUEST['insertar'];
   $titulo = $_REQUEST['titulo'];
   $texto = $_REQUEST['texto'];
   $categoria = $_REQUEST['categoria'];

   $error = false;
   if (isset($insertar))
   {

   // Comprobar que se han introducido todos los datos obligatorios
   // T�tulo
      if (trim($titulo) == "")
      {
         $errores ["titulo"] = "�debe introducir el t�tulo de la noticia!";
         $error = true;
      }
      else
         $errores["titulo"] = "";

   // texto
      if (trim($texto) == "")
      {
         $errores["texto"] = "�debe introducir el texto de la noticia!";
         $error = true;
      }
      else
         $errores["texto"] = "";

   // subir fichero
      $copiarfichero = false;

   // copiar fichero en directorio de ficheros subidos
   // se renombra para evitar que sobreescriba un fichero existente
   // para garantizar la unicidad del nombre se a�ade una marca de tiempo
      if (is_uploaded_file ($_FILES['imagen']['tmp_name']))
      {
         $nombredirectorio = "../img/";
         $nombrefichero = $_FILES['imagen']['name'];
         $copiarfichero = true;

      // si ya existe un fichero con el mismo nombre, renombrarlo
         $nombrecompleto = $nombredirectorio . $nombrefichero;
         if (is_file($nombrecompleto))
         {
            $idunico = time();
            $nombrefichero = $idunico . "-" . $nombrefichero;
         }
      }
   // el fichero introducido supera el l�mite de tama�o permitido
      else if ($_FILES['imagen']['error'] == upload_err_form_size)
      {
      	 $maxsize = $_REQUEST['max_file_size'];
         $errores["imagen"] = "�El tama�o del fichero supera el l�mite permitido ($maxsize bytes)!";
         $error = true;
      }
   // no se ha introducido ning�n fichero
      else if ($_FILES['imagen']['name'] == "")
         $nombrefichero = '';
   // el fichero introducido no se ha podido subir
      else
      {
         $errores["imagen"] = "�no se ha podido subir el fichero!";
         $error = true;
      }
   }

// si los datos son correctos, procesar formulario
   if (isset($insertar) && $error==false)
   {

   // insertar la noticia en la base de datos
      $conexion = mysql_connect ("localhost", "root", "")
         or die ("no se puede conectar con el servidor");
      mysql_select_db ("noticias")
         or die ("no se puede seleccionar la base de datos");

      $fecha = date ("y-m-d"); // fecha actual
      $instruccion = "insert into tblnoticias (titulo, texto, categoria, fecha, imagen) values ('$titulo', '$texto', '$categoria', '$fecha', '$nombrefichero')";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      mysql_close ($conexion);

   // mover fichero de imagen a su ubicaci�n definitiva
      if ($copiarfichero)
         move_uploaded_file ($_FILES['imagen']['tmp_name'],
         $nombredirectorio . $nombrefichero);

   // mostrar datos introducidos
      print ("<h1>Gesti�n de noticias</h1>\n");
      print ("<h2>Resultado de la inserci�n de nueva noticia</h2>\n");

      print ("La noticia ha sido recibida correctamente:");
      print ("<ul>");
      print ("<li>T�tulo: " . $titulo);
      print ("<li>Texto: " . $texto);
      print ("<li>Categor�a: " . $categoria);
      print ("<li>Fecha: " . date2string($fecha));
      if ($nombrefichero != "")
         print ("<li>imagen: <a target='_blank' href='" . $nombredirectorio . $nombrefichero . "'>" . $nombrefichero . "</a>");
      else
         print ("<li>imagen: (No hay)");
      print ("</ul>");

      print ("<br>");
      print ("[ <a href='inserta_noticia.php'>insertar otra noticia</a> ]");

   }
   else
   {
?>

<h1>inserci�n de nueva noticia</h1>

<form class="borde" action="inserta_noticia.php" name="inserta" method="post"
   enctype="multipart/form-data">

<!-- t�tulo de la noticia -->
<p><label>T�tulo: *</label>
<input type="text" name="titulo" size="50" maxlength="50"

<?php
   if (isset($insertar))
      print ("value='$titulo'>\n");
   else
      print (">\n");
   if ($errores["titulo"] != "")
      print ("<br><span class='error'>" . $errores["titulo"] . "</span>");
?>
</p>

<!-- texto de la noticia-->
<p><label>Texto: *</label>
<textarea cols="45" rows="5" name="texto">
<?php
   if (isset($insertar))
      print ("$texto");
   print ("</textarea>");
   if ($errores["texto"] != "")
      print ("<br><span class='error'>" . $errores["texto"] . "</span>");
?>
</p>

<!-- categor�a de la noticia-->
<p><label>Categor�a:</label>
<select name="categoria">
   <option selected>Promociones
   <option>Ofertas
   <option>Costas
</select></p>

<!-- imagen asociada a la noticia -->
<p><label>Imagen:</label>
<input type="hidden" name="max_file_size" value="102400">
<input type="file" size="44" name="imagen">

<?php
   if ($errores["imagen"] != "")
      print ("<br><span class='error'>" . $errores["imagen"] . "</span>");
?>
</p>

<!-- bot�n de env�o -->
<p><input type="submit" name="insertar" value="Insertar noticia"></p>

</form>

<p>Nota: los datos marcados con (*) deben ser rellenados obligatoriamente</p>

<?php
   }
?>

</body>
</html>
