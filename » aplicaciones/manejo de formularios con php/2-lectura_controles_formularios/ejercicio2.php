<html lang="es">

<head>
   <title>Elementos de entrada</title>
   <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>

<h1>elementos de entrada</h1>

<form action="ejercicio2-resultados.php" method="post" enctype="multipart/form-data">

<h2>Elementos  de tipo Input</h2>

<h3>TEXT</h3>
<p>Introduzca la cadena a buscar:
<input type="text" name="cadena" value="valor por defecto" size="20">
</p>
<hr/>

<h3>RADIO</h3>
<p>Sexo:
<input type="radio" name="sexo" value="mujer" checked>Mujer
<input type="radio" name="sexo" value="hombre">Hombre
</p>
<hr/>

<h3>CHECKBOX</h3>
<p>Extras:
<input type="checkbox" name="extras[]" value="garaje" checked>Garaje
<input type="checkbox" name="extras[]" value="piscina">Piscina
<input type="checkbox" name="extras[]" value="jardin">Jardín
</p>
<hr/>

<h3>BUTTON</h3>
<input type="button" name="actualizar" value="Actualizar Datos">
<hr/>

<h3>FILE</h3>
<p>
Fichero:
<input type="file" name="fichero">
</p>
<hr/>

<h3>HIDDEN</h3>
<?php
   $usuario = "mariano";
   print ("<input type='hidden' name='username' value='$usuario'>\n");
?>
<hr/>

<h3>PASSWORD</h3>
<p>
Contraseña: <input type="password" name="clave">
</p>
<hr/>

<h3>SUBMIT</h3>
<input type="submit" name="enviar" value="Enviar datos">
<hr/>

<h2>Elemento SELECT</h2>

<h3>SELECT SIMPLE</h3>
<p>
Color:
<select name="color">
   <option value="rojo" selected>rojo
   <option value="verde">verde
   <option value="azul">azul
</select>
</p>
<hr/>

<h3>SELECT MÚLTIPLE</h3>
<p>
idiomas:
<select multiple size="3" name="idiomas[]">
   <option value="ingles" selected>Inglés
   <option value="frances">Francés
   <option value="aleman">Alemán
   <option value="holandes">Holandés
</select>
</p>
<hr/>

<h2>elemento textarea</h2>
comentario:
<textarea cols="50" rows="5" name="comentario">
Introduzca el texto del textarea ...
</textarea>
<br/><br/>
<hr/>

<br/>
<input type="submit" name="enviar" value="Enviar">
<input type="reset" value="Borrar datos">

</form>

</body>
</html>
