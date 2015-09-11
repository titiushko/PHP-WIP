<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
       <title>Title here!</title>
</head>
<body>
<body bgcolor="#cccccc">
<?include("cabeza.htm");?>
<br>
<table align='center' border='0' bordercolor="#FFffff" >
<tr bgcolor='#666666'>
<td>
<p align="center"><a href='index.php'><font size='4' color='white'>Volver Foro</font> </a></p>
</td>
 <?$pp=$var;?>
<td>
<? print ("<p align='center'><a href='altamensaje.php?var1=$pp'><font size='4' color='white'>Responder Mensaje</font> </a></p>");?>
</td>
<td>
<p align="center"><a href='altatema.php'><font size='4' color='white'>Agregar Nuevo Tema</font> </a></p>
</td>
 </tr>
<?php

if ($abierto = mysql_connect ("localhost","root","123456")){

$leer = "SELECT ID,Autor,Fecha,Email,Mensaje FROM TEMAS WHERE Padre=$var";

$datos = mysql_db_query ("Foro",$leer);

print("<table align='center' width='50%' border='0'>");

while ($fila = mysql_fetch_array ($datos)) {

print ("<tr><td ><font size='4' color='white'>Autor :</font></td><td > ".$fila[1]."</td></tr>
      <tr><td ><font size='4' color='white'>Fecha : </font></td><td>".$fila[2]."</td></tr>
      <tr><td ><font size='4' color='white'>E-mail : </font></td><td>".$fila[3]."</td></tr>
      <tr><td ><font size='4' color='white'>Mensaje : </font></td><td>".$fila[4]."</td></tr><tr ><td colspan='2'><hr></td></tr>");

}
print ("</table>");
} else {
print ("No se puede conectar. Intente nuevamente");
}
?>
<hr>
</body>
</html>

