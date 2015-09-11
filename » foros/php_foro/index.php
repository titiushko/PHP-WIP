<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
       <title>Title here!</title>
<meta http-equiv="" content="text/html; charset=iso-8859-1"></head>
<body text="#0000FF">
<body bgcolor="#cccccc">
<?include("cabeza.htm");?>
<br>
<table align='center' border='0' bordercolor="#FFffff" >
<tr bgcolor='#666666'><td bgcolor="#CCCCCC">
<p align="center"><a href='altatema.php'><font size='4' color='#0000FF'>Agregar Temas</font> </a></p>
 </td></tr>
<?php

if ($abierto = mysql_connect ("localhost","root","")){

$leer = "SELECT id,tema,autor,hijos,fecha FROM TEMAS  WHERE tema<>' '";

$datos = mysql_db_query ("Foro",$leer);

print("<table width='100%' border='0'>");
print ("<tr bgcolor='#000000'><td align='center'><font size='4' color='#ffffff'>Tema</font></td><td align='center'><font size='4' color='#ffffff'>Autor</font></td><td align='center'>
<font size='4' color='#ffffff'>Mensajes</font></td><td align='center'><font size='4' color='#ffffff'>Ult.Act.</font></td>");

while ($fila = mysql_fetch_array ($datos)) {
print ("<tr><td bgcolor='#ffffff' align='center'><a href='listahijos.php?var=$fila[0]'>".$fila[1]."</a></td><td bgcolor='#ffffff' align='center'>".$fila[2]."</td><td bgcolor='#ffffff' align='center'>".$fila[3].
"</td><td bgcolor='#ffffff' align='center'>".$fila[4]."</td></tr>");
}
print ("</table>");
} else {
print ("No se puede conectar. Intente nuevamente");
}
?>
<hr>
</body>
</html>
