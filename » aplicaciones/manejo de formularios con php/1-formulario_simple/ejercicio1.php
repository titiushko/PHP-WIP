<html lang="es">

<head>
   <title>Formulario Simple</title>
   <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>

<h1>Formulario Simple</h1>

<h2>B�squeda de canciones</h2>

<form class="borde" action="ejercicio1-resultados.php" method="post">

<p><label>Texto a buscar:</label>
<input type="text" size="40" name="texto"></p>

<p><label>Buscar en:</label>
<input type="radio" name="donde" value="titulo">T�tulos de canci�n
<input type="radio" name="donde" value="album">Nombres de �lbum
<input type="radio" name="donde" value="ambos" checked>Ambos campos</p>

<p><label>G�nero musical:</label>
<select name="genero">
   <option selected>Todos
   <option>Ac�stica
   <option>Banda sonora
   <option>Blues
   <option>Electr�nica
   <option>Folk
   <option>Jazz
   <option>New age
   <option>Pop
   <option>Rock
</select></p>

<p><input type="submit" name="buscar" value="Buscar"></p>

</form>

</body>
</html>
